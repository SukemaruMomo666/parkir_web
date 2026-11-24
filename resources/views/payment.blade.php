<x-layouts.app activeNav="payment">
    <div class="w-full">
        
        @if($paymentState === 'not_found')
            <!-- ================= ERROR / NOT FOUND STATE ================= -->
            <div class="max-w-xl mx-auto py-12 md:py-20 text-center">
                <div class="w-20 h-20 bg-red-50 text-[var(--danger)] rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-[var(--text)] mb-3">Item Not Found</h1>
                <p class="text-[var(--text-muted)] mb-8">{{ $error ?? 'The requested parking session or reservation could not be found or has expired.' }}</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="/active-parking" class="bg-[var(--primary)] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors shadow-md shadow-blue-500/20">
                        View Active Parking
                    </a>
                    <a href="/dashboard" class="bg-[var(--background)] text-[var(--text)] px-6 py-3 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] transition-colors">
                        Return to Dashboard
                    </a>
                </div>
            </div>

        @elseif($paymentState === 'successful')
            <!-- ================= SUCCESS RECEIPT STATE ================= -->
            <div class="max-w-2xl mx-auto py-8 md:py-12">
                <div class="dashboard-card p-6 md:p-10 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-[var(--success)]"></div>
                    
                    <div class="w-20 h-20 bg-green-100 text-[var(--success)] rounded-full flex items-center justify-center mx-auto mb-6 shadow-md shadow-emerald-500/10">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-emerald-700 text-xs font-bold rounded-full border border-green-200 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--success)]"></span>
                        Payment Verified & Confirmed
                    </span>
                    <h1 class="text-2xl md:text-3xl font-bold text-[var(--text)] mb-2">Payment Successful</h1>
                    <p class="text-[var(--text-muted)] text-sm mb-8">Your parking session has been settled. Exit barrier is now authorized for departure.</p>

                    <!-- Receipt Card -->
                    <div class="bg-[var(--background)] rounded-xl border border-[var(--border)] p-6 text-left mb-8 space-y-4">
                        <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
                            <div>
                                <span class="text-xs text-[var(--text-muted)] uppercase tracking-wider font-semibold block">Total Amount Paid</span>
                                <span class="text-2xl font-bold text-[var(--primary)]">{{ $transaction['formatted_amount'] ?? $payable['formatted_total'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs text-[var(--text-muted)] uppercase tracking-wider font-semibold block">Payment Method</span>
                                <span class="text-sm font-bold text-[var(--text)] uppercase">QRIS Instant Pay</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-1">
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Transaction ID</span>
                                <span class="font-mono font-bold text-[var(--text)]">{{ $transaction['transaction_id'] ?? 'TRX-9482A1B029' }}</span>
                            </div>
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Receipt Reference</span>
                                <span class="font-mono font-bold text-[var(--text)]">{{ $transaction['receipt_ref'] ?? 'RCP-20261011-0421' }}</span>
                            </div>
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Facility</span>
                                <span class="font-semibold text-[var(--text)]">{{ $payable['facility']['name'] }}</span>
                            </div>
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Vehicle Plate</span>
                                <span class="font-semibold text-[var(--text)]">{{ $payable['vehicle']['plate'] }}</span>
                            </div>
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Payment Timestamp</span>
                                <span class="font-semibold text-[var(--text)]">{{ $transaction['paid_timestamp_formatted'] ?? date('d M Y, H:i') . ' WIB' }}</span>
                            </div>
                            <div>
                                <span class="text-[var(--text-muted)] block mb-0.5">Session Reference</span>
                                <span class="font-mono font-semibold text-[var(--text)]">{{ $payable['reference'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Exit Barrier Notice -->
                    <div class="p-4 bg-blue-50/70 border border-blue-100 rounded-xl mb-8 flex items-start gap-3.5 text-left">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[var(--accent)] flex items-center justify-center shrink-0 mt-0.5">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[var(--primary)]">15-Minute Exit Grace Period</h4>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                Automatic barrier recognition is active. Please proceed to the exit gate within 15 minutes to avoid additional progressive duration charges.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="/active-parking" class="bg-[var(--primary)] text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors shadow-lg shadow-blue-500/20">
                            Return to Active Parking
                        </a>
                        <a href="/dashboard" class="bg-[var(--background)] text-[var(--text)] px-8 py-3.5 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] transition-colors">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

        @else
            <!-- ================= ACTIVE PAYMENT FLOW ================= -->

            <!-- HEADER -->
            <header class="flex flex-col gap-1 mb-6 md:mb-8">
                <a href="{{ $payable['back_url'] }}" class="inline-flex items-center gap-1.5 text-xs md:text-sm font-semibold text-[var(--text-muted)] hover:text-[var(--primary)] transition-colors w-fit mb-1">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ $payable['back_label'] }}
                </a>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)]">Payment</h1>
                        <p class="text-[var(--text-muted)] text-sm md:text-base">
                            {{ $payable['type'] === 'reservation' ? 'Settle advance reservation deposit for guaranteed parking spot.' : 'Settle current parking session fee prior to exit.' }}
                        </p>
                    </div>
                    @if($paymentState === 'already_paid')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 w-fit">
                            <span class="w-2 h-2 rounded-full bg-[var(--success)]"></span>
                            Already Paid
                        </span>
                    @elseif($paymentState === 'awaiting_payment')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 w-fit">
                            <span class="w-2 h-2 rounded-full bg-[var(--accent)] animate-pulse"></span>
                            Awaiting QR Scan
                        </span>
                    @elseif($paymentState === 'failed')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-700 w-fit">
                            <span class="w-2 h-2 rounded-full bg-[var(--danger)]"></span>
                            Payment Incomplete
                        </span>
                    @elseif($paymentState === 'expired')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700 w-fit">
                            <span class="w-2 h-2 rounded-full bg-[var(--warning)]"></span>
                            Intent Expired
                        </span>
                    @endif
                </div>
            </header>

            <!-- EXCEPTION NOTICES -->
            @if($paymentState === 'already_paid')
                <div class="p-5 bg-green-50/80 border border-green-200 rounded-2xl mb-8 flex items-start gap-4">
                    <div class="w-10 h-10 bg-green-100 text-[var(--success)] rounded-xl flex items-center justify-center shrink-0">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-[var(--text)] text-base">This session has already been settled</h3>
                        <p class="text-sm text-[var(--text-muted)] mt-1">Payment is recorded in our system. You are cleared for barrier gate exit.</p>
                        <div class="mt-4 flex gap-3">
                            <a href="/active-parking" class="bg-[var(--primary)] text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-[var(--accent)] transition-colors">View Active Session</a>
                        </div>
                    </div>
                </div>
            @elseif($paymentState === 'expired')
                <div class="p-5 bg-amber-50/80 border border-amber-200 rounded-2xl mb-8 flex items-start gap-4">
                    <div class="w-10 h-10 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center shrink-0">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-[var(--text)] text-base">Payment Intent Expired</h3>
                        <p class="text-sm text-[var(--text-muted)] mt-1">The previous QRIS session exceeded the 15-minute verification window. Please generate a fresh payment intent below.</p>
                        <div class="mt-4">
                            <a href="/payment?type={{ $payable['type'] }}" class="bg-[var(--primary)] text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-[var(--accent)] transition-colors">Refresh Payment</a>
                        </div>
                    </div>
                </div>
            @elseif($paymentState === 'failed')
                <div class="p-5 bg-red-50/80 border border-red-200 rounded-2xl mb-8 flex items-start gap-4">
                    <div class="w-10 h-10 bg-red-100 text-[var(--danger)] rounded-xl flex items-center justify-center shrink-0">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-[var(--text)] text-base">Payment Failed or Cancelled</h3>
                        <p class="text-sm text-[var(--text-muted)] mt-1">The payment transaction was not completed. No funds have been deducted from your account. Please retry or choose another method.</p>
                        <div class="mt-4">
                            <a href="/payment?type={{ $payable['type'] }}" class="bg-[var(--primary)] text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-[var(--accent)] transition-colors">Retry Payment</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TWO-COLUMN LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

                <!-- LEFT COLUMN: PAYMENT METHOD OR QRIS -->
                <div class="lg:col-span-8 flex flex-col gap-6">

                    <!-- CONTEXT DETAILS BANNER -->
                    <section class="dashboard-card p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs uppercase font-bold tracking-wider text-[var(--text-muted)]">
                                        {{ $payable['type'] === 'reservation' ? 'Reservation Order' : 'Active Parking Session' }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-[var(--primary)] bg-slate-100 px-2 py-0.5 rounded">
                                        {{ $payable['reference'] }}
                                    </span>
                                </div>
                                <h2 class="text-xl font-bold text-[var(--text)]">{{ $payable['facility']['name'] }}</h2>
                                <p class="text-xs text-[var(--text-muted)] mt-0.5">{{ $payable['facility']['address'] }}</p>
                            </div>
                            
                            <div class="bg-[var(--background)] px-4 py-3 rounded-xl border border-[var(--border)] shrink-0">
                                <span class="text-[10px] text-[var(--text-muted)] uppercase tracking-wider font-semibold block">Vehicle Registered</span>
                                <span class="text-sm font-bold text-[var(--text)]">{{ $payable['vehicle']['plate'] }}</span>
                                <span class="text-[11px] text-[var(--text-muted)] block">{{ $payable['vehicle']['name'] }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-4 mt-4 border-t border-[var(--border)] text-xs">
                            @if($payable['type'] === 'session')
                                <div>
                                    <span class="text-[var(--text-muted)] block">Entry Time</span>
                                    <span class="font-bold text-[var(--text)] text-sm">{{ $payable['entry_time'] }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block">Duration</span>
                                    <span class="font-bold text-[var(--text)] text-sm">{{ $payable['duration'] }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block">Parking Zone</span>
                                    <span class="font-bold text-[var(--text)] text-sm">{{ $payable['facility']['zone'] }}</span>
                                </div>
                            @else
                                <div>
                                    <span class="text-[var(--text-muted)] block">Schedule</span>
                                    <span class="font-bold text-[var(--text)] text-sm">{{ $payable['schedule'] }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block">Spot Allocation</span>
                                    <span class="font-bold text-[var(--text)] text-sm">{{ $payable['facility']['zone'] }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block">Deposit Requirement</span>
                                    <span class="font-bold text-[var(--text)] text-sm">Full Pre-Payment</span>
                                </div>
                            @endif
                        </div>
                    </section>

                    @if($paymentState === 'awaiting_payment' && $transaction)
                        <!-- ================= QRIS PAYMENT DISPLAY PANEL ================= -->
                        <section class="dashboard-card p-6 md:p-8" id="qrisPanel">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-6 border-b border-[var(--border)] gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center font-bold text-lg border border-red-100">
                                        Q
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-[var(--text)]">QRIS Instant Payment</h3>
                                        <p class="text-xs text-[var(--text-muted)]">National Standard Cashless Payment (ASPI / Bank Indonesia)</p>
                                    </div>
                                </div>
                                <div class="bg-amber-50 text-amber-800 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span>Expires in: <strong id="timerText">14:59</strong></span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 py-8 items-center">
                                <!-- QR Display Box -->
                                <div class="md:col-span-5 flex flex-col items-center">
                                    <div class="p-4 bg-white rounded-2xl border-2 border-[var(--primary)] shadow-md relative group">
                                        <!-- QRIS Graphic Representation -->
                                        <div class="w-52 h-52 bg-white flex flex-col items-center justify-center relative p-2">
                                            <!-- QR Border Patterns -->
                                            <div class="w-full h-full border-4 border-slate-900 rounded-lg p-2 flex flex-col justify-between relative bg-slate-50">
                                                <div class="flex justify-between">
                                                    <div class="w-10 h-10 border-4 border-slate-900 p-1 flex items-center justify-center bg-white"><div class="w-4 h-4 bg-slate-900"></div></div>
                                                    <div class="w-10 h-10 border-4 border-slate-900 p-1 flex items-center justify-center bg-white"><div class="w-4 h-4 bg-slate-900"></div></div>
                                                </div>
                                                <!-- Center NusaPark Badge -->
                                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[var(--primary)] text-white p-2 rounded-lg shadow font-extrabold text-xs tracking-wider flex items-center gap-1">
                                                    <span>N</span><span class="text-[var(--accent)]">P</span>
                                                </div>
                                                <div class="flex justify-between items-end">
                                                    <div class="w-10 h-10 border-4 border-slate-900 p-1 flex items-center justify-center bg-white"><div class="w-4 h-4 bg-slate-900"></div></div>
                                                    <div class="flex flex-col gap-1 items-end">
                                                        <div class="w-6 h-1.5 bg-slate-800"></div>
                                                        <div class="w-4 h-1.5 bg-slate-800"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-2">
                                            <span class="text-[10px] uppercase font-bold tracking-widest text-[var(--text-muted)]">QRIS · ASPI</span>
                                        </div>
                                    </div>

                                    <p class="text-xs text-[var(--text-muted)] mt-3 font-mono">
                                        Ref: {{ $transaction['transaction_id'] }}
                                    </p>
                                </div>

                                <!-- Payment Instructions -->
                                <div class="md:col-span-7 flex flex-col justify-between">
                                    <div class="space-y-4">
                                        <div class="bg-[var(--background)] p-4 rounded-xl border border-[var(--border)]">
                                            <span class="text-xs text-[var(--text-muted)] block mb-0.5">Payable Amount</span>
                                            <span class="text-2xl font-bold text-[var(--primary)]">{{ $transaction['formatted_amount'] }}</span>
                                            <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">Merchant: NusaPark · {{ $payable['facility']['name'] }}</span>
                                        </div>

                                        <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">How to Complete Payment</h4>
                                        <ol class="space-y-2.5 text-xs text-[var(--text)]">
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-5 h-5 rounded-full bg-slate-100 font-bold text-[var(--primary)] flex items-center justify-center shrink-0">1</span>
                                                <span>Open your preferred mobile banking (BCA, Mandiri, BRI, BNI) or e-wallet app (GoPay, OVO, DANA).</span>
                                            </li>
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-5 h-5 rounded-full bg-slate-100 font-bold text-[var(--primary)] flex items-center justify-center shrink-0">2</span>
                                                <span>Choose <strong>Scan QR / QRIS</strong> and scan the code displayed on the left.</span>
                                            </li>
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-5 h-5 rounded-full bg-slate-100 font-bold text-[var(--primary)] flex items-center justify-center shrink-0">3</span>
                                                <span>Verify merchant <strong>NusaPark</strong> and the payable amount.</span>
                                            </li>
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-5 h-5 rounded-full bg-slate-100 font-bold text-[var(--primary)] flex items-center justify-center shrink-0">4</span>
                                                <span>Enter PIN to confirm. This page will automatically update once verified.</span>
                                            </li>
                                        </ol>
                                    </div>

                                    <!-- Interactive Polling / Verification Control -->
                                    <div class="mt-6 pt-4 border-t border-[var(--border)] flex flex-col sm:flex-row items-center gap-3">
                                        <button type="button" 
                                                id="btnCheckStatus" 
                                                onclick="checkPaymentStatus('{{ $transaction['transaction_id'] }}')" 
                                                class="w-full sm:w-auto bg-[var(--primary)] text-white text-xs font-bold px-6 py-3 rounded-xl hover:bg-[var(--accent)] transition-all flex items-center justify-center gap-2 shadow-sm">
                                            <svg id="statusSpinner" class="hidden animate-spin w-4 h-4 text-white" viewBox="0 0 24 24" fill="none">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                            </svg>
                                            <span>Check Payment Status</span>
                                        </button>

                                        <a href="/payment?type={{ $payable['type'] }}" class="w-full sm:w-auto text-center text-xs font-semibold text-[var(--text-muted)] hover:text-[var(--danger)] py-3 px-3 transition-colors">
                                            Cancel & Change Method
                                        </a>
                                    </div>

                                    <!-- Development Testing Adapter Helper -->
                                    <div class="mt-4 p-3 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-left">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold text-[var(--text-muted)]">Local Development Sandbox</span>
                                            <button type="button" 
                                                    onclick="simulatePayment('{{ $transaction['transaction_id'] }}')" 
                                                    class="text-[11px] font-bold text-[var(--accent)] hover:underline">
                                                Simulate Success Callback &rarr;
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                    @else
                        <!-- ================= PAYMENT METHOD SELECTION ================= -->
                        <section class="dashboard-card p-6 md:p-8">
                            <div class="mb-6">
                                <h3 class="font-bold text-lg text-[var(--text)]">Select Payment Method</h3>
                                <p class="text-xs text-[var(--text-muted)] mt-0.5">Supported cashless options available at this facility.</p>
                            </div>

                            <form id="paymentMethodForm" onsubmit="handlePaymentSubmit(event)">
                                @csrf
                                <input type="hidden" name="type" value="{{ $payable['type'] }}">
                                <input type="hidden" name="reference" value="{{ $payable['reference'] }}">

                                <div class="space-y-3.5">
                                    @foreach($methods as $method)
                                        <label class="relative block border rounded-2xl p-4 transition-all cursor-pointer group
                                            {{ $method['available'] ? 'hover:border-[var(--primary)]' : 'opacity-65 cursor-not-allowed bg-slate-50/60' }}
                                            {{ $selectedMethod === $method['id'] && $method['available'] ? 'border-2 border-[var(--primary)] bg-blue-50/20 shadow-xs' : 'border-[var(--border)]' }}"
                                            id="method-card-{{ $method['id'] }}">
                                            
                                            <div class="flex items-start gap-4">
                                                <div class="pt-0.5">
                                                    <input type="radio" 
                                                           name="method" 
                                                           value="{{ $method['id'] }}" 
                                                           {{ $selectedMethod === $method['id'] && $method['available'] ? 'checked' : '' }}
                                                           {{ !$method['available'] ? 'disabled' : '' }}
                                                           onchange="updateSelectedMethod('{{ $method['id'] }}')"
                                                           class="w-4 h-4 text-[var(--primary)] focus:ring-[var(--primary)] border-[var(--border)]">
                                                </div>

                                                <div class="flex-1">
                                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                                        <span class="font-bold text-sm text-[var(--text)]">{{ $method['name'] }}</span>
                                                        @if($method['badge_type'] === 'success')
                                                            <span class="px-2 py-0.5 bg-green-50 text-emerald-700 text-[10px] font-bold rounded-md border border-green-200">
                                                                {{ $method['badge'] }}
                                                            </span>
                                                        @elseif($method['badge_type'] === 'warning')
                                                            <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-md border border-amber-200">
                                                                {{ $method['badge'] }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md border border-slate-200">
                                                                {{ $method['badge'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <p class="text-xs text-[var(--text-muted)] mb-2">{{ $method['description'] }}</p>

                                                    @if(!$method['available'] && isset($method['unavailable_reason']))
                                                        <p class="text-[11px] text-amber-700 bg-amber-50 p-2 rounded-lg border border-amber-200/60 mt-1">
                                                            {{ $method['unavailable_reason'] }}
                                                        </p>
                                                    @endif

                                                    @if($method['id'] === 'nfc_card')
                                                        <div class="mt-2 flex items-center gap-2">
                                                            <span class="text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wide">Compatible:</span>
                                                            <span class="px-1.5 py-0.5 bg-white border border-[var(--border)] rounded text-[10px] font-bold text-slate-700">Flazz</span>
                                                            <span class="px-1.5 py-0.5 bg-white border border-[var(--border)] rounded text-[10px] font-bold text-slate-700">e-Money</span>
                                                            <span class="px-1.5 py-0.5 bg-white border border-[var(--border)] rounded text-[10px] font-bold text-slate-700">TapCash</span>
                                                            <span class="px-1.5 py-0.5 bg-white border border-[var(--border)] rounded text-[10px] font-bold text-slate-700">Brizzi</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                <!-- Dynamic Method Guidance Note -->
                                <div class="mt-6 p-4 rounded-xl bg-[var(--background)] border border-[var(--border)] text-xs text-[var(--text-muted)]" id="methodGuidance">
                                    <div class="flex items-start gap-2.5">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--accent)] shrink-0 mt-0.5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        <p id="guidanceText">
                                            Click <strong>Generate QRIS Payment</strong> to create an instant dynamic QR code. Once scanned with your banking or wallet app, your parking exit barrier opens automatically.
                                        </p>
                                    </div>
                                </div>

                                <!-- Submit Action Button (Desktop Form) -->
                                <div class="mt-6">
                                    <button type="submit" 
                                            id="btnProceedPayment" 
                                            class="w-full bg-[var(--primary)] text-white font-bold py-3.5 px-6 rounded-xl hover:bg-[var(--accent)] transition-all shadow-[0_8px_16px_rgba(37,99,235,0.25)] flex items-center justify-center gap-2 active:scale-[0.99] cursor-pointer">
                                        <svg id="submitSpinner" class="hidden animate-spin w-4 h-4 text-white" viewBox="0 0 24 24" fill="none">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                        </svg>
                                        <span id="btnSubmitText">Generate QRIS Payment &rarr;</span>
                                    </button>
                                </div>
                            </form>
                        </section>
                    @endif

                </div>

                <!-- RIGHT COLUMN: STICKY PRICING & SUMMARY -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 dashboard-card p-6 space-y-6">
                        
                        <div class="border-b border-[var(--border)] pb-4">
                            <span class="text-xs uppercase font-bold tracking-wider text-[var(--text-muted)] block">Summary</span>
                            <h3 class="text-lg font-bold text-[var(--text)] mt-0.5">Payment Details</h3>
                        </div>

                        <!-- Itemized Pricing Breakdown -->
                        <div class="space-y-3 text-sm">
                            <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)] block mb-1">Pricing Breakdown</span>
                            
                            @if($payable['type'] === 'session')
                                <div class="flex justify-between items-center text-[var(--text-muted)]">
                                    <span>Base Rate (First 2h)</span>
                                    <span class="font-semibold text-[var(--text)]">Rp {{ number_format($payable['rates']['base'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[var(--text-muted)]">
                                    <span>Progressive Duration</span>
                                    <span class="font-semibold text-[var(--text)]">Rp {{ number_format($payable['rates']['hourly'], 0, ',', '.') }}</span>
                                </div>
                            @else
                                <div class="flex justify-between items-center text-[var(--text-muted)]">
                                    <span>Parking Duration Fee</span>
                                    <span class="font-semibold text-[var(--text)]">Rp {{ number_format($payable['rates']['parking_fee'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[var(--text-muted)]">
                                    <span>Reservation Slot Service</span>
                                    <span class="font-semibold text-[var(--text)]">Rp {{ number_format($payable['rates']['reservation_fee'], 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center text-[var(--text-muted)]">
                                <span>Facility Service Fee</span>
                                <span class="font-semibold text-[var(--text)]">Rp {{ number_format($payable['rates']['service'], 0, ',', '.') }}</span>
                            </div>

                            @if($payable['rates']['discount'] > 0)
                                <div class="flex justify-between items-center text-emerald-600">
                                    <span>Promotional Discount</span>
                                    <span class="font-semibold">-Rp {{ number_format($payable['rates']['discount'], 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <div class="border-t border-[var(--border)] pt-4 mt-2 flex justify-between items-baseline">
                                <div>
                                    <span class="font-bold text-[var(--text)] block text-base">Total Amount Due</span>
                                    <span class="text-[11px] text-[var(--text-muted)]">Authoritative Rate</span>
                                </div>
                                <span class="text-2xl font-bold text-[var(--primary)]">{{ $payable['formatted_total'] }}</span>
                            </div>
                        </div>

                        <!-- Trust and Security Badges -->
                        <div class="pt-4 border-t border-[var(--border)] space-y-2.5">
                            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)]">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--success)] shrink-0">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <span>256-Bit SSL Encrypted Transaction</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)]">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--accent)] shrink-0">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                <span>Licensed Bank Indonesia Standard</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        @endif

    </div>

    @push('scripts')
    <script>
        // Track selected method
        let currentMethod = '{{ $selectedMethod }}';

        function updateSelectedMethod(methodId) {
            currentMethod = methodId;
            const btnText = document.getElementById('btnSubmitText');
            const guidanceText = document.getElementById('guidanceText');
            
            // Highlight selected card
            document.querySelectorAll('[id^="method-card-"]').forEach(card => {
                card.classList.remove('border-2', 'border-[var(--primary)]', 'bg-blue-50/20', 'shadow-xs');
                card.classList.add('border-[var(--border)]');
            });
            const activeCard = document.getElementById(`method-card-${methodId}`);
            if (activeCard) {
                activeCard.classList.remove('border-[var(--border)]');
                activeCard.classList.add('border-2', 'border-[var(--primary)]', 'bg-blue-50/20', 'shadow-xs');
            }

            if (methodId === 'qris') {
                if (btnText) btnText.innerHTML = 'Generate QRIS Payment &rarr;';
                if (guidanceText) guidanceText.innerHTML = "Click <strong>Generate QRIS Payment</strong> to create an instant dynamic QR code. Once scanned with your banking or wallet app, your parking exit barrier opens automatically.";
            } else if (methodId === 'nfc_card') {
                if (btnText) btnText.innerHTML = 'Confirm Pay at Exit Barrier &rarr;';
                if (guidanceText) guidanceText.innerHTML = "No in-app charge is required. Simply drive to any exit barrier lane and tap your physical prepaid card (Flazz, e-Money, TapCash, Brizzi) on the gate scanner.";
            }
        }

        // Handle Payment Generation Form
        async function handlePaymentSubmit(event) {
            event.preventDefault();
            const btn = document.getElementById('btnProceedPayment');
            const spinner = document.getElementById('submitSpinner');
            const btnText = document.getElementById('btnSubmitText');

            if (!btn) return;
            btn.disabled = true;
            if (spinner) spinner.classList.remove('hidden');

            const form = event.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('/payment/process', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    if (data.status === 'on_site') {
                        alert(data.message);
                        window.location.href = '/active-parking';
                    } else if (data.status === 'awaiting_payment') {
                        // Reload with awaiting_payment state
                        window.location.href = `/payment?type=${formData.get('type')}&status=awaiting_payment&method=${formData.get('method')}`;
                    }
                } else {
                    alert(data.message || 'Payment processing failed. Please try again.');
                    btn.disabled = false;
                    if (spinner) spinner.classList.add('hidden');
                }
            } catch (err) {
                console.error(err);
                alert('Connection error. Please try again.');
                btn.disabled = false;
                if (spinner) spinner.classList.add('hidden');
            }
        }

        // Live Countdown Timer for QRIS
        @if($paymentState === 'awaiting_payment')
            let secondsLeft = 15 * 60; // 15 mins
            const timerElem = document.getElementById('timerText');

            const countdownInterval = setInterval(() => {
                secondsLeft--;
                if (secondsLeft <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = '/payment?type={{ $payable['type'] ?? 'session' }}&status=expired';
                    return;
                }
                const m = Math.floor(secondsLeft / 60);
                const s = secondsLeft % 60;
                if (timerElem) {
                    timerElem.innerText = `${m}:${s < 10 ? '0' : ''}${s}`;
                }
            }, 1000);

            // Real-time polling check
            let pollTimer = setInterval(() => {
                checkPaymentStatus('{{ $transaction['transaction_id'] ?? '' }}', false);
            }, 6000);
        @endif

        // Check Payment Status via AJAX
        async function checkPaymentStatus(transactionId, userInitiated = true) {
            if (!transactionId) return;

            const btn = document.getElementById('btnCheckStatus');
            const spinner = document.getElementById('statusSpinner');

            if (userInitiated && btn) {
                btn.disabled = true;
                if (spinner) spinner.classList.remove('hidden');
            }

            try {
                const res = await fetch(`/payment/status/${transactionId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();

                if (data.status === 'successful') {
                    window.location.href = `/payment?type={{ $payable['type'] ?? 'session' }}&status=successful`;
                } else if (data.status === 'expired') {
                    window.location.href = `/payment?type={{ $payable['type'] ?? 'session' }}&status=expired`;
                } else if (userInitiated) {
                    alert('Payment is still awaiting scan or verification. Please complete payment on your banking app.');
                }
            } catch (e) {
                console.error(e);
            } finally {
                if (userInitiated && btn) {
                    btn.disabled = false;
                    if (spinner) spinner.classList.add('hidden');
                }
            }
        }

        // Developer Simulation Hook for Testing
        async function simulatePayment(transactionId) {
            if (!transactionId) return;

            try {
                const res = await fetch('/payment/simulate', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ transaction_id: transactionId, action: 'pay' }),
                });
                const data = await res.json();
                if (data.success) {
                    window.location.href = `/payment?type={{ $payable['type'] ?? 'session' }}&status=successful`;
                }
            } catch (e) {
                console.error(e);
            }
        }
    </script>
    @endpush
</x-layouts.app>
