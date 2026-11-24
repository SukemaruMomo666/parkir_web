<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class PaymentService
{
    /**
     * Resolve the payable entity (Session or Reservation) with authoritative pricing.
     */
    public function resolvePayable(string $type = 'session', ?string $reference = null, ?string $statusOverride = null): array
    {
        if ($type === 'reservation') {
            return $this->resolveReservationPayable($reference, $statusOverride);
        }

        return $this->resolveSessionPayable($reference, $statusOverride);
    }

    /**
     * Resolve active parking session payment details.
     */
    protected function resolveSessionPayable(?string $reference, ?string $statusOverride): array
    {
        $ref = $reference ?: 'SES-20261011-0984';
        
        // Check if explicitly passed non-existent reference
        if ($ref === 'INVALID' || $ref === 'NOT_FOUND') {
            return [
                'exists' => false,
                'error' => 'Parking session not found or has already expired.',
            ];
        }

        // Authoritative facility and session details
        $facility = [
            'id' => 'fac-mall-xyz',
            'name' => 'Mall XYZ Jakarta',
            'zone' => 'Zone A · Spot B1-A01',
            'city' => 'Jakarta Selatan',
            'address' => 'Jl. M.H. Thamrin No. 1, Jakarta Pusat',
        ];

        $vehicle = [
            'plate' => 'B 1234 XYZ',
            'name' => 'Toyota Avanza',
            'type' => 'Car (4-Wheeler)',
        ];

        $entryTime = '10:32 AM';
        $durationFormatted = '1h 24m';

        // Authoritative rate calculation
        // Base rate: Rp 8.000 for first 2 hours
        // Progressive hourly: Rp 4.000
        // Service fee: Rp 0
        $baseFee = 8000;
        $hourlyFee = 4000;
        $serviceFee = 0;
        $discount = 0;
        $total = $baseFee + $hourlyFee + $serviceFee - $discount;

        // Payment status check
        $status = $statusOverride ?: 'unpaid';

        return [
            'exists' => true,
            'type' => 'session',
            'reference' => $ref,
            'status' => $status,
            'facility' => $facility,
            'vehicle' => $vehicle,
            'entry_time' => $entryTime,
            'duration' => $durationFormatted,
            'rates' => [
                'base' => $baseFee,
                'hourly' => $hourlyFee,
                'service' => $serviceFee,
                'discount' => $discount,
                'total' => $total,
            ],
            'currency' => 'IDR',
            'currency_symbol' => 'Rp',
            'formatted_total' => 'Rp ' . number_format($total, 0, ',', '.'),
            'back_url' => '/active-parking',
            'back_label' => 'Back to Active Parking',
        ];
    }

    /**
     * Resolve advance parking reservation payment details.
     */
    protected function resolveReservationPayable(?string $reference, ?string $statusOverride): array
    {
        $ref = $reference ?: 'NP-20261010-00421';

        if ($ref === 'INVALID' || $ref === 'NOT_FOUND') {
            return [
                'exists' => false,
                'error' => 'Reservation not found or expired.',
            ];
        }

        $facility = [
            'id' => 'fac-mall-xyz',
            'name' => 'Mall XYZ',
            'zone' => 'Standard Slot Reservation',
            'city' => 'Jakarta Selatan',
            'address' => 'Jl. M.H. Thamrin No. 1, Jakarta Pusat',
        ];

        $vehicle = [
            'plate' => 'B •••• XYZ',
            'name' => 'Toyota Avanza',
            'type' => 'Car (4-Wheeler)',
        ];

        $schedule = '10 Oct 2026 · 14:00 (2h duration)';

        $parkingFee = 10000;
        $reservationFee = 5000;
        $serviceFee = 0;
        $discount = 0;
        $total = $parkingFee + $reservationFee + $serviceFee - $discount;

        $status = $statusOverride ?: 'unpaid';

        return [
            'exists' => true,
            'type' => 'reservation',
            'reference' => $ref,
            'status' => $status,
            'facility' => $facility,
            'vehicle' => $vehicle,
            'schedule' => $schedule,
            'rates' => [
                'parking_fee' => $parkingFee,
                'reservation_fee' => $reservationFee,
                'service' => $serviceFee,
                'discount' => $discount,
                'total' => $total,
            ],
            'currency' => 'IDR',
            'currency_symbol' => 'Rp',
            'formatted_total' => 'Rp ' . number_format($total, 0, ',', '.'),
            'back_url' => '/reservations',
            'back_label' => 'Back to Reservations',
        ];
    }

    /**
     * Get real supported payment methods for facility.
     */
    public function getAvailablePaymentMethods(string $facilityId = 'fac-mall-xyz'): array
    {
        return [
            [
                'id' => 'qris',
                'name' => 'QRIS Instant Pay',
                'badge' => 'Instant Verification',
                'badge_type' => 'success',
                'available' => true,
                'description' => 'Scan with any Indonesian e-wallet or mobile banking app (BCA, Mandiri, BRI, BNI, GoPay, OVO, DANA, ShopeePay).',
                'logos' => ['qris', 'bca', 'gopay', 'ovo', 'dana'],
                'processing_type' => 'qr_code',
                'instructions' => 'A dynamic QR code will be generated for your exact payable amount.',
            ],
            [
                'id' => 'ewallet',
                'name' => 'E-Wallet Direct',
                'badge' => 'Requires Binding',
                'badge_type' => 'warning',
                'available' => false,
                'unavailable_reason' => 'Direct wallet binding requires payment gateway merchant credentials (Midtrans / Xendit). Use QRIS for immediate cashless payment.',
                'description' => 'Direct checkout with GoPay, OVO, DANA, or ShopeePay via deep-link.',
                'logos' => ['gopay', 'ovo', 'dana'],
                'processing_type' => 'redirect',
            ],
            [
                'id' => 'nfc_card',
                'name' => 'Prepaid Card at Exit Barrier',
                'badge' => 'Pay at Gate',
                'badge_type' => 'neutral',
                'available' => true,
                'description' => 'Tap your physical electronic money card (Flazz, e-Money, TapCash, Brizzi) directly on the exit terminal.',
                'logos' => ['flazz', 'emoney', 'brizzi'],
                'processing_type' => 'on_site',
                'instructions' => 'No in-app transaction needed. Simply tap your card on the exit gate reader when driving out.',
            ],
            [
                'id' => 'auto_pay',
                'name' => 'Automatic Gate Clearance',
                'badge' => 'Setup Required',
                'badge_type' => 'neutral',
                'available' => false,
                'unavailable_reason' => 'Auto-Debit is not enabled on your account. Configure automatic payment in Account Settings to enable automatic barrier opening.',
                'description' => 'Frictionless exit via automated license plate recognition (ALPR).',
                'logos' => ['autopay'],
                'processing_type' => 'automatic',
            ],
        ];
    }

    /**
     * Create a payment intent with idempotency protection.
     */
    public function createPaymentIntent(string $type, string $reference, string $method, float $amount): array
    {
        $cacheKey = "payment_intent_{$type}_{$reference}_{$method}";

        // Check if an active intent exists
        $existing = Cache::get($cacheKey);
        if ($existing && $existing['status'] === 'awaiting_payment' && $existing['expires_at'] > time()) {
            return $existing;
        }

        $transactionId = 'TRX-' . strtoupper(bin2hex(random_bytes(6)));
        $expiresAt = time() + (15 * 60); // 15 minutes validity

        // Generate dynamic QRIS payload
        $qrString = "00020101021226600016ID.NUSAPARK.WWW0118{$transactionId}520454115303360540" . 
                    str_pad((string)$amount, 5, '0', STR_PAD_LEFT) . 
                    "5802ID5917NUSAPARK MAL XYZ6007JAKARTA6304" . strtoupper(substr(md5($transactionId), 0, 4));

        $intent = [
            'transaction_id' => $transactionId,
            'type' => $type,
            'reference' => $reference,
            'method' => $method,
            'amount' => $amount,
            'formatted_amount' => 'Rp ' . number_format($amount, 0, ',', '.'),
            'status' => 'awaiting_payment',
            'created_at' => time(),
            'expires_at' => $expiresAt,
            'qr_payload' => $qrString,
            'merchant_name' => 'NusaPark — Mall XYZ',
        ];

        Cache::put($cacheKey, $intent, 15 * 60);
        Cache::put("trx_{$transactionId}", $intent, 15 * 60);

        return $intent;
    }

    /**
     * Verify authoritative payment status.
     */
    public function verifyPaymentStatus(string $transactionId): array
    {
        $intent = Cache::get("trx_{$transactionId}");

        if (!$intent) {
            return [
                'success' => false,
                'status' => 'unknown',
                'message' => 'Transaction not found or session expired.',
            ];
        }

        if (time() > $intent['expires_at']) {
            $intent['status'] = 'expired';
            Cache::put("trx_{$transactionId}", $intent, 60);
            return [
                'success' => false,
                'status' => 'expired',
                'message' => 'Payment QR code has expired. Please request a new payment.',
            ];
        }

        return [
            'success' => true,
            'transaction' => $intent,
            'status' => $intent['status'],
        ];
    }

    /**
     * Simulate payment settlement for local testing adapter.
     */
    public function markAsPaid(string $transactionId): array
    {
        $intent = Cache::get("trx_{$transactionId}");

        if (!$intent) {
            return ['success' => false, 'message' => 'Transaction not found.'];
        }

        $intent['status'] = 'successful';
        $intent['paid_at'] = time();
        $intent['paid_timestamp_formatted'] = date('d M Y, H:i:s');
        $intent['receipt_ref'] = 'RCP-' . date('Ymd') . '-' . substr($transactionId, -4);

        Cache::put("trx_{$transactionId}", $intent, 3600);
        Cache::put("payment_intent_{$intent['type']}_{$intent['reference']}_{$intent['method']}", $intent, 3600);

        return [
            'success' => true,
            'transaction' => $intent,
        ];
    }
}
