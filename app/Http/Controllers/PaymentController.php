<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display the payment page (Page 15).
     */
    public function index(Request $request): View
    {
        // Simulated auth protection (consistent with existing routes)
        $isAuthenticated = true;
        if (!$isAuthenticated) {
            return redirect('/login');
        }

        $type = $request->query('type', 'session');
        $reference = $request->query('ref');
        $statusOverride = $request->query('status');
        $selectedMethod = $request->query('method', 'qris');

        // Resolve authoritative payable entity
        $payable = $this->paymentService->resolvePayable($type, $reference, $statusOverride);

        if (!$payable['exists']) {
            return view('payment', [
                'payable' => null,
                'error' => $payable['error'] ?? 'Item not found.',
                'paymentState' => 'not_found',
                'methods' => [],
                'selectedMethod' => $selectedMethod,
                'transaction' => null,
            ]);
        }

        $methods = $this->paymentService->getAvailablePaymentMethods($payable['facility']['id']);

        // Determine payment state
        $paymentState = $statusOverride ?: 'initial';

        // Normalize state aliases
        if ($paymentState === 'success') {
            $paymentState = 'successful';
        }

        $transaction = null;

        // If requesting awaiting_payment or already_paid or successful state, generate or fetch transaction
        if ($paymentState === 'awaiting_payment') {
            $transaction = $this->paymentService->createPaymentIntent(
                $payable['type'],
                $payable['reference'],
                $selectedMethod,
                $payable['rates']['total']
            );
        } elseif ($paymentState === 'successful') {
            $transaction = [
                'transaction_id' => 'TRX-' . strtoupper(substr(md5($payable['reference']), 0, 10)),
                'receipt_ref' => 'RCP-' . date('Ymd') . '-0421',
                'type' => $payable['type'],
                'reference' => $payable['reference'],
                'method' => $selectedMethod,
                'amount' => $payable['rates']['total'],
                'formatted_amount' => $payable['formatted_total'],
                'status' => 'successful',
                'paid_timestamp_formatted' => date('d M Y, H:i') . ' WIB',
                'merchant_name' => 'NusaPark — ' . $payable['facility']['name'],
            ];
        }

        return view('payment', [
            'payable' => $payable,
            'methods' => $methods,
            'selectedMethod' => $selectedMethod,
            'paymentState' => $paymentState,
            'transaction' => $transaction,
            'error' => null,
        ]);
    }

    /**
     * Initiate payment processing / generate QR intent.
     */
    public function process(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|string|in:session,reservation',
            'reference' => 'required|string',
            'method' => 'required|string',
        ]);

        $type = $request->input('type');
        $reference = $request->input('reference');
        $method = $request->input('method');

        $payable = $this->paymentService->resolvePayable($type, $reference);

        if (!$payable['exists']) {
            return response()->json([
                'success' => false,
                'message' => 'Payable item not found or expired.',
            ], 404);
        }

        if ($method === 'ewallet') {
            return response()->json([
                'success' => false,
                'message' => 'Direct E-Wallet payment gateway is not configured in this environment. Please choose QRIS.',
            ], 422);
        }

        if ($method === 'nfc_card') {
            return response()->json([
                'success' => true,
                'status' => 'on_site',
                'message' => 'Please tap your physical prepaid card on the exit barrier reader upon departure.',
            ]);
        }

        // Generate authoritative QRIS payment intent
        $intent = $this->paymentService->createPaymentIntent(
            $payable['type'],
            $payable['reference'],
            $method,
            $payable['rates']['total']
        );

        return response()->json([
            'success' => true,
            'status' => 'awaiting_payment',
            'transaction' => $intent,
        ]);
    }

    /**
     * Check authoritative payment status.
     */
    public function status(string $transactionId): JsonResponse
    {
        $result = $this->paymentService->verifyPaymentStatus($transactionId);

        return response()->json($result);
    }

    /**
     * Local development adapter: simulate scan & payment completion.
     */
    public function simulate(Request $request): JsonResponse
    {
        $transactionId = $request->input('transaction_id');
        $action = $request->input('action', 'pay'); // 'pay' or 'fail'

        if ($action === 'fail') {
            return response()->json([
                'success' => true,
                'status' => 'failed',
                'message' => 'Payment transaction was declined by the issuing bank.',
            ]);
        }

        $result = $this->paymentService->markAsPaid($transactionId);

        return response()->json($result);
    }
}
