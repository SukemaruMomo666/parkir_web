<x-layouts.vendor activeNav="transactions" title="Vendor Transactions - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Success</p>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center shrink-0 text-red-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Operational Notice</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-start gap-3 shadow-xs" role="alert">
        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center shrink-0 text-amber-600">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        </div>
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-amber-900">Validation Notice</p>
            <ul class="text-sm list-disc list-inside space-y-0.5 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- ================= FACILITY CONTEXT & PAGE HEADER ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Metadata -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Financial Operations • Page 29</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Payment Gateway Live Sync
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Transactions
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Monitor payment activity and transaction outcomes across your facilities.
                </p>
            </div>
        </div>

        <!-- Facility Switcher & Primary Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Facility Context Switcher -->
            @if(count($facilities) > 1)
            <div class="relative min-w-[210px]">
                <label for="facility-selector" class="sr-only">Switch Facility Scope</label>
                <select id="facility-selector" 
                        onchange="window.location.href = '/vendor/transactions?facility=' + this.value + '&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&settlement_status={{ $filters['settlement_status'] }}&sort={{ $filters['sort'] }}'"
                        class="w-full pl-3 pr-8 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($facilityId === 'all') ? 'selected' : '' }}>All Authorized Facilities ({{ count($facilities) }})</option>
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($facilityId === $f['id']) ? 'selected' : '' }}>
                            {{ $f['name'] }} ({{ $f['city'] }})
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            <!-- Refresh Button -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer" 
                    title="Refresh Live Transaction Records"
                    aria-label="Refresh Live Transaction Records">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Export to CSV Action -->
            <a href="/vendor/transactions/export?facility={{ $facilityId }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&settlement_status={{ $filters['settlement_status'] }}&sort={{ $filters['sort'] }}&q={{ urlencode($filters['q']) }}" 
               class="px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
               title="Export filtered transactions as RFC-compliant CSV spreadsheet">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export CSV</span>
            </a>
        </div>
    </div>

    <!-- ================= FINANCIAL SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4">
        
        <!-- Metric 1: Total Transactions -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Total Transactions</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $metrics['total_transactions_count'] }}
                </div>
                <div class="flex items-center gap-1.5 mt-1 text-[11px] font-semibold text-slate-600">
                    <span>Recorded payment events</span>
                </div>
            </div>
        </div>

        <!-- Metric 2: Successful Processed Volume -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Processed Volume</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-xl sm:text-2xl font-extrabold text-emerald-700 leading-tight">
                    {{ $metrics['formatted_gross_volume'] }}
                </div>
                <div class="text-[11px] font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                    <span>{{ $metrics['successful_count'] }} successful</span>
                    <span>•</span>
                    <span>{{ $metrics['success_rate'] }}% rate</span>
                </div>
            </div>
        </div>

        <!-- Metric 3: Pending Authorizations -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Pending</span>
                <div class="w-8 h-8 rounded-lg {{ $metrics['pending_count'] > 0 ? 'bg-amber-100 text-amber-700 animate-pulse' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold {{ $metrics['pending_count'] > 0 ? 'text-amber-700' : 'text-slate-900' }} leading-tight">
                    {{ $metrics['pending_count'] }}
                </div>
                <div class="text-[11px] font-medium {{ $metrics['pending_count'] > 0 ? 'text-amber-700' : 'text-slate-500' }} mt-1">
                    Awaiting gateway webhook
                </div>
            </div>
        </div>

        <!-- Metric 4: Requires Reconciliation -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Requires Attention</span>
                <div class="w-8 h-8 rounded-lg {{ $metrics['attention_count'] > 0 ? 'bg-rose-100 text-rose-700 animate-pulse' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold {{ $metrics['attention_count'] > 0 ? 'text-rose-700' : 'text-slate-900' }} leading-tight">
                    {{ $metrics['attention_count'] }}
                </div>
                <div class="text-[11px] font-medium {{ $metrics['attention_count'] > 0 ? 'text-rose-700' : 'text-slate-500' }} mt-1">
                    Failed or disputed charges
                </div>
            </div>
        </div>

        <!-- Metric 5: Refunded Amount -->
        <div class="col-span-2 lg:col-span-1 p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Refunded Volume</span>
                <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-xl sm:text-2xl font-extrabold text-purple-700 leading-tight">
                    {{ $metrics['formatted_refunded_volume'] }}
                </div>
                <div class="text-[11px] font-medium text-slate-500 mt-1">
                    {{ $metrics['refunded_count'] }} processed refund(s)
                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
        
        <form id="transactions-filter-form" method="GET" action="/vendor/transactions" class="space-y-3.5">
            <!-- Hidden Facility field to preserve when using this form -->
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <!-- Search Bar + Quick Submit Row -->
            <div class="flex flex-col sm:flex-row gap-2.5">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search by transaction reference, provider ref, session ref, plate, or gateway..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white focus:bg-white text-xs sm:text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all">
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" 
                            class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center justify-center gap-1.5 shadow-xs shrink-0">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Filter</span>
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/transactions?facility={{ $facilityId }}" 
                       class="px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs sm:text-sm font-semibold transition-colors cursor-pointer flex items-center justify-center gap-1 shrink-0" 
                       title="Reset all search filters">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Clear</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Granular Filter Dropdowns Row -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 pt-2 border-t border-slate-100">
                
                <!-- Period / Date Range -->
                <div>
                    <label for="filter-period" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Time Period</label>
                    <select id="filter-period" 
                            name="period" 
                            onchange="document.getElementById('transactions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['period'] === 'all') ? 'selected' : '' }}>All Time (All Records)</option>
                        <option value="today" {{ ($filters['period'] === 'today') ? 'selected' : '' }}>Today (11 Oct 2026)</option>
                        <option value="yesterday" {{ ($filters['period'] === 'yesterday') ? 'selected' : '' }}>Yesterday (10 Oct 2026)</option>
                        <option value="7days" {{ ($filters['period'] === '7days') ? 'selected' : '' }}>Last 7 Days (Oct 2026)</option>
                    </select>
                </div>

                <!-- Transaction Status Filter -->
                <div>
                    <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Payment Status</label>
                    <select id="filter-status" 
                            name="status" 
                            onchange="document.getElementById('transactions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Statuses</option>
                        <option value="successful" {{ ($filters['status'] === 'successful') ? 'selected' : '' }}>Successful (Paid)</option>
                        <option value="pending" {{ ($filters['status'] === 'pending') ? 'selected' : '' }}>Pending Authorization</option>
                        <option value="failed" {{ ($filters['status'] === 'failed') ? 'selected' : '' }}>Failed Payment</option>
                        <option value="refunded" {{ ($filters['status'] === 'refunded') ? 'selected' : '' }}>Refunded</option>
                        <option value="disputed" {{ ($filters['status'] === 'disputed') ? 'selected' : '' }}>Disputed / Chargeback</option>
                    </select>
                </div>

                <!-- Payment Method Filter -->
                <div>
                    <label for="filter-payment-method" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Payment Method</label>
                    <select id="filter-payment-method" 
                            name="payment_method" 
                            onchange="document.getElementById('transactions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['payment_method'] === 'all') ? 'selected' : '' }}>All Methods</option>
                        <option value="qris" {{ ($filters['payment_method'] === 'qris') ? 'selected' : '' }}>QRIS Dynamic</option>
                        <option value="nfc_card" {{ ($filters['payment_method'] === 'nfc_card') ? 'selected' : '' }}>NFC Contactless Card</option>
                        <option value="auto_pay" {{ ($filters['payment_method'] === 'auto_pay') ? 'selected' : '' }}>In-App Auto-Pay</option>
                        <option value="ewallet" {{ ($filters['payment_method'] === 'ewallet') ? 'selected' : '' }}>E-Wallet / Direct Debit</option>
                        <option value="cashless_kiosk" {{ ($filters['payment_method'] === 'cashless_kiosk') ? 'selected' : '' }}>Cashless Kiosk / POS</option>
                    </select>
                </div>

                <!-- Settlement Status Filter -->
                <div>
                    <label for="filter-settlement" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Settlement State</label>
                    <select id="filter-settlement" 
                            name="settlement_status" 
                            onchange="document.getElementById('transactions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['settlement_status'] === 'all') ? 'selected' : '' }}>All Settlement States</option>
                        <option value="settled" {{ ($filters['settlement_status'] === 'settled') ? 'selected' : '' }}>Settled (Funds Cleared)</option>
                        <option value="pending_settlement" {{ ($filters['settlement_status'] === 'pending_settlement') ? 'selected' : '' }}>Pending Settlement (T+1)</option>
                        <option value="on_hold" {{ ($filters['settlement_status'] === 'on_hold') ? 'selected' : '' }}>On Hold (Investigation)</option>
                        <option value="refunded" {{ ($filters['settlement_status'] === 'refunded') ? 'selected' : '' }}>Refund Reconciled</option>
                    </select>
                </div>

                <!-- Sorting Criteria -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Sort By</label>
                    <select id="filter-sort" 
                            name="sort" 
                            onchange="document.getElementById('transactions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="date_desc" {{ ($filters['sort'] === 'date_desc') ? 'selected' : '' }}>Timestamp (Newest First)</option>
                        <option value="date_asc" {{ ($filters['sort'] === 'date_asc') ? 'selected' : '' }}>Timestamp (Oldest First)</option>
                        <option value="amount_desc" {{ ($filters['sort'] === 'amount_desc') ? 'selected' : '' }}>Highest Amount</option>
                        <option value="amount_asc" {{ ($filters['sort'] === 'amount_asc') ? 'selected' : '' }}>Lowest Amount</option>
                        <option value="status_asc" {{ ($filters['sort'] === 'status_asc') ? 'selected' : '' }}>Status (Alphabetical)</option>
                    </select>
                </div>

            </div>
        </form>

    </div>

    <!-- ================= TRANSACTION LEDGER TABLE CONTAINER ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <!-- Table Header Bar -->
        <div class="px-5 py-4 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900">
                    Payment Transaction Records
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Showing {{ $pagination['from'] }}-{{ $pagination['to'] }} of {{ $pagination['total'] }} recorded transactions across authorized facilities.
                </p>
            </div>

            <!-- Active Filters Pill Summary -->
            @if($hasActiveFilters)
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-[11px] font-bold text-slate-400">Active Filters:</span>
                @if($filters['q'])
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-200">
                        Query: "{{ $filters['q'] }}"
                    </span>
                @endif
                @if($filters['period'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Period: {{ ucfirst($filters['period']) }}
                    </span>
                @endif
                @if($filters['status'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Status: {{ ucfirst($filters['status']) }}
                    </span>
                @endif
                @if($filters['payment_method'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Method: {{ ucfirst(str_replace('_', ' ', $filters['payment_method'])) }}
                    </span>
                @endif
                @if($filters['settlement_status'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Settlement: {{ ucfirst(str_replace('_', ' ', $filters['settlement_status'])) }}
                    </span>
                @endif
            </div>
            @endif
        </div>

        <!-- Desktop View Table (Fixed colgroup budgeting to prevent character-level wrap) -->
        <div class="hidden lg:block overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse min-w-[1040px]">
                <colgroup>
                    <col class="w-[20%]"> <!-- Transaction & Provider Reference -->
                    <col class="w-[14%]"> <!-- Date & Time -->
                    <col class="w-[16%]"> <!-- Facility & Terminal -->
                    <col class="w-[16%]"> <!-- Related Session / Plate -->
                    <col class="w-[12%]"> <!-- Payment Method & Channel -->
                    <col class="w-[12%]"> <!-- Amount & Settlement -->
                    <col class="w-[10%]"> <!-- Status & Action -->
                </colgroup>
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Transaction Reference</th>
                        <th class="py-3.5 px-3">Date & Time</th>
                        <th class="py-3.5 px-3">Facility & Terminal</th>
                        <th class="py-3.5 px-3">Related Record</th>
                        <th class="py-3.5 px-3">Payment Method</th>
                        <th class="py-3.5 px-3 text-right">Amount</th>
                        <th class="py-3.5 px-4 text-right">Status & Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-xs font-medium">
                    @forelse($transactions as $t)
                    <tr class="hover:bg-slate-50/60 transition-colors group {{ !empty($t['reconciliation_flag']) ? 'bg-rose-50/20' : '' }}">
                        
                        <!-- 1. Transaction Reference & Provider Ref -->
                        <td class="py-3.5 px-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-mono text-xs font-bold text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap tracking-tight group-hover:border-[var(--primary)] group-hover:text-[var(--primary)] transition-colors">
                                        {{ $t['transaction_reference'] }}
                                    </span>
                                    @if(!empty($t['reconciliation_flag']))
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-300 whitespace-nowrap" title="{{ $t['reconciliation_notes'] ?? 'Investigation needed' }}">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                                        Flagged
                                    </span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-500 truncate mt-1 flex items-center gap-1 font-mono">
                                    <span class="text-slate-400">GW:</span>
                                    <span class="truncate" title="{{ $t['provider_reference'] ?? '-' }}">{{ $t['provider_reference'] ?? '-' }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- 2. Date & Time -->
                        <td class="py-3.5 px-3 whitespace-nowrap">
                            <div class="text-slate-900 font-semibold">{{ $t['created_at'] }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">Automated Capture</div>
                        </td>

                        <!-- 3. Facility & Terminal / Lane -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                <div class="font-bold text-slate-800 truncate" title="{{ $t['facility_name'] }}">
                                    {{ $t['facility_name'] }}
                                </div>
                                <div class="text-[11px] text-slate-500 truncate mt-0.5 flex items-center gap-1">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <span class="truncate" title="{{ $t['terminal_lane'] }}">{{ $t['terminal_lane'] }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- 4. Related Parking Session / Reservation -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    @if(($t['payable_type'] ?? '') === 'session' && !empty($t['payable_reference']))
                                    <a href="/vendor/parking-sessions?q={{ urlencode($t['payable_reference']) }}" 
                                       class="font-mono text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-1.5 py-0.5 rounded transition-colors whitespace-nowrap"
                                       title="View related session in Parking Sessions page">
                                        {{ $t['payable_reference'] }} &rarr;
                                    </a>
                                    @elseif(!empty($t['payable_reference']))
                                    <span class="font-mono text-xs font-bold text-purple-700 bg-purple-50 border border-purple-200 px-1.5 py-0.5 rounded whitespace-nowrap">
                                        {{ $t['payable_reference'] }}
                                    </span>
                                    @else
                                    <span class="text-slate-400 italic">Direct Kiosk</span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-600 truncate mt-1 flex items-center gap-1.5">
                                    @if(!empty($t['vehicle_plate']))
                                    <span class="font-mono font-bold text-slate-800 bg-slate-100 px-1.5 py-0.2 rounded border border-slate-200">{{ $t['vehicle_plate'] }}</span>
                                    @endif
                                    <span class="text-slate-400 text-[10px]">{{ $t['payable_type_label'] }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- 5. Payment Method & Channel -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                @if(($t['payment_method'] ?? '') === 'qris')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200 whitespace-nowrap">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                    QRIS
                                </span>
                                @elseif(($t['payment_method'] ?? '') === 'nfc_card')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200 whitespace-nowrap">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    NFC Tap
                                </span>
                                @elseif(($t['payment_method'] ?? '') === 'auto_pay')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 whitespace-nowrap">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                    Auto-Pay
                                </span>
                                @elseif(($t['payment_method'] ?? '') === 'ewallet')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 whitespace-nowrap">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="4" width="20" height="16" rx="2"></rect><circle cx="12" cy="12" r="3"></circle></svg>
                                    E-Wallet
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200 whitespace-nowrap">
                                    {{ $t['payment_method_label'] ?? 'Cashless' }}
                                </span>
                                @endif
                                <div class="text-[10px] text-slate-500 truncate mt-1" title="{{ $t['gateway_provider'] ?? '' }}">
                                    {{ $t['gateway_provider'] ?? '-' }}
                                </div>
                            </div>
                        </td>

                        <!-- 6. Amount & Settlement Status -->
                        <td class="py-3.5 px-3 text-right whitespace-nowrap">
                            <div class="font-mono text-sm font-extrabold text-slate-900 tracking-tight">
                                {{ $t['formatted_amount'] }}
                            </div>
                            <div class="mt-0.5">
                                @if(($t['settlement_status'] ?? '') === 'settled')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Settled
                                </span>
                                @elseif(($t['settlement_status'] ?? '') === 'pending_settlement')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-600 bg-slate-100 px-1.5 py-0.2 rounded border border-slate-200">
                                    T+1 Clearing
                                </span>
                                @elseif(($t['settlement_status'] ?? '') === 'on_hold')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-rose-700 bg-rose-50 px-1.5 py-0.2 rounded border border-rose-200">
                                    On Hold
                                </span>
                                @elseif(($t['settlement_status'] ?? '') === 'refunded')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-purple-700 bg-purple-50 px-1.5 py-0.2 rounded border border-purple-200">
                                    Refunded
                                </span>
                                @endif
                            </div>
                        </td>

                        <!-- 7. Status Badge & Actions -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex flex-col items-end gap-1.5">
                                <!-- Status Badge -->
                                @if($t['transaction_status'] === 'successful')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Successful
                                </span>
                                @elseif($t['transaction_status'] === 'pending')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                    Pending
                                </span>
                                @elseif($t['transaction_status'] === 'failed')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-red-50 text-red-700 border border-red-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    Failed
                                </span>
                                @elseif($t['transaction_status'] === 'refunded')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-purple-50 text-purple-700 border border-purple-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                                    Refunded
                                </span>
                                @elseif($t['transaction_status'] === 'disputed')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-rose-100 text-rose-800 border border-rose-300">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                    Disputed
                                </span>
                                @endif

                                <!-- Inspect Details Button -->
                                <button type="button" 
                                        onclick="openTransactionDetails('{{ $t['id'] }}')" 
                                        class="px-2.5 py-1 rounded-lg border border-slate-200 hover:border-[var(--primary)] bg-white hover:bg-slate-50 text-slate-700 text-[11px] font-bold transition-colors cursor-pointer flex items-center gap-1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span>Inspect</span>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="max-w-sm mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">No payment transactions found</h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    @if($hasActiveFilters)
                                        No transaction records matched your filter criteria. Try adjusting your search query, status, or date range.
                                    @else
                                        No financial transaction activity recorded yet for the selected facility scope.
                                    @endif
                                </p>
                                @if($hasActiveFilters)
                                <a href="/vendor/transactions?facility={{ $facilityId }}" 
                                   class="mt-4 px-3.5 py-2 rounded-xl bg-[var(--primary)] text-white text-xs font-bold hover:bg-[var(--primary-light)] transition-colors">
                                    Reset Filters
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile View Card List (<lg) -->
        <div class="lg:hidden divide-y divide-[var(--border)]">
            @forelse($transactions as $t)
            <div class="p-4 space-y-3 hover:bg-slate-50/50 transition-colors {{ !empty($t['reconciliation_flag']) ? 'bg-rose-50/20' : '' }}">
                
                <!-- Card Header: Reference & Amount -->
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="font-mono text-xs font-bold text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md">
                                {{ $t['transaction_reference'] }}
                            </span>
                            @if(!empty($t['reconciliation_flag']))
                            <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-rose-100 text-rose-800 border border-rose-300">
                                Flagged
                            </span>
                            @endif
                        </div>
                        <div class="text-[11px] text-slate-500 mt-0.5">
                            {{ $t['created_at'] }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-mono text-base font-extrabold text-slate-900">
                            {{ $t['formatted_amount'] }}
                        </div>
                        <div class="text-[10px] font-bold text-emerald-700">
                            {{ $t['settlement_status_label'] }}
                        </div>
                    </div>
                </div>

                <!-- Card Meta: Facility, Lane & Method -->
                <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Facility / Gate</div>
                        <div class="font-semibold text-slate-800 truncate">{{ $t['facility_name'] }}</div>
                        <div class="text-[10px] text-slate-500 truncate">{{ $t['terminal_lane'] }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Payment Method</div>
                        <div class="font-semibold text-slate-800">{{ $t['payment_method_label'] }}</div>
                        <div class="text-[10px] text-slate-500 truncate">{{ $t['gateway_provider'] }}</div>
                    </div>
                </div>

                <!-- Card Footer: Status & Inspect Button -->
                <div class="flex items-center justify-between pt-1">
                    <div>
                        @if($t['transaction_status'] === 'successful')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Successful
                        </span>
                        @elseif($t['transaction_status'] === 'pending')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-300">
                            Pending
                        </span>
                        @elseif($t['transaction_status'] === 'failed')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-red-50 text-red-700 border border-red-200">
                            Failed
                        </span>
                        @elseif($t['transaction_status'] === 'refunded')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-purple-50 text-purple-700 border border-purple-200">
                            Refunded
                        </span>
                        @elseif($t['transaction_status'] === 'disputed')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded bg-rose-100 text-rose-800 border border-rose-300">
                            Disputed
                        </span>
                        @endif
                    </div>
                    <button type="button" 
                            onclick="openTransactionDetails('{{ $t['id'] }}')" 
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 text-xs font-bold shadow-xs">
                        Inspect Dossier &rarr;
                    </button>
                </div>

            </div>
            @empty
            <div class="p-8 text-center text-xs text-slate-500">
                No payment transactions found matching filter criteria.
            </div>
            @endforelse
        </div>

        <!-- Table Pagination Footer -->
        <div class="px-5 py-3.5 border-t border-[var(--border)] bg-slate-50/75 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div class="text-slate-500">
                Showing <span class="font-bold text-slate-800">{{ $pagination['from'] }}</span> to <span class="font-bold text-slate-800">{{ $pagination['to'] }}</span> of <span class="font-bold text-slate-800">{{ $pagination['total'] }}</span> transactions
            </div>
            
            <div class="flex items-center gap-2">
                @if($pagination['current_page'] > 1)
                <a href="/vendor/transactions?facility={{ $facilityId }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&settlement_status={{ $filters['settlement_status'] }}&sort={{ $filters['sort'] }}&q={{ urlencode($filters['q']) }}&page={{ $pagination['current_page'] - 1 }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold transition-colors cursor-pointer shadow-2xs">
                    &larr; Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 font-bold cursor-not-allowed">
                    &larr; Previous
                </span>
                @endif

                <span class="px-2 text-slate-600 font-semibold">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/transactions?facility={{ $facilityId }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&settlement_status={{ $filters['settlement_status'] }}&sort={{ $filters['sort'] }}&q={{ urlencode($filters['q']) }}&page={{ $pagination['current_page'] + 1 }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold transition-colors cursor-pointer shadow-2xs">
                    Next &rarr;
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 font-bold cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif
            </div>
        </div>

    </div>

    <!-- ================= TRANSACTION DOSSIER SLIDE-OVER DRAWER ================= -->
    <div id="transaction-drawer" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="drawer-title">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeTransactionDetails()"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md md:max-w-xl bg-[var(--surface)] shadow-2xl flex flex-col border-l border-[var(--border)]">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-start justify-between gap-3 bg-slate-50/50">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Transaction Dossier</span>
                            <span id="drawer-status-pill" class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Successful
                            </span>
                            <span id="drawer-settlement-pill" class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-700 border border-slate-200">
                                Settled
                            </span>
                        </div>
                        <h2 id="drawer-trx-ref" class="text-base sm:text-lg font-mono font-extrabold text-slate-900 tracking-tight mt-1">
                            TRX-NUSA-...
                        </h2>
                        <p id="drawer-created-at" class="text-xs text-slate-500 mt-0.5">--</p>
                    </div>

                    <button type="button" 
                            onclick="closeTransactionDetails()" 
                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors"
                            aria-label="Close drawer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Scrollable Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 scrollbar-thin">
                    
                    <!-- Alert if flagged for reconciliation -->
                    <div id="drawer-flag-banner" class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs hidden">
                        <div class="flex items-start gap-2.5">
                            <svg class="shrink-0 mt-0.5 text-rose-600" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                            <div>
                                <span class="font-bold uppercase tracking-wider text-[10px]">Reconciliation Investigation</span>
                                <p id="drawer-flag-reason" class="mt-0.5 font-medium text-slate-700">Flagged for manual investigation</p>
                            </div>
                        </div>
                    </div>

                    <!-- 1. Monetary Breakdown Hierarchy -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2.5">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Financial Breakdown (IDR)</div>
                        <div class="flex items-baseline justify-between border-b border-slate-200 pb-2">
                            <span class="text-xs text-slate-600">Total Billed Amount:</span>
                            <span id="drawer-amount" class="font-mono text-xl font-extrabold text-slate-900">Rp 0</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 pt-1">
                            <div>Base Parking Fee: <span id="drawer-base-fee" class="font-semibold text-slate-900 font-mono">Rp 0</span></div>
                            <div>Gateway Fee: <span id="drawer-service-fee" class="font-semibold text-slate-900 font-mono">Rp 0</span></div>
                            <div>Refunded Amount: <span id="drawer-refunded" class="font-semibold text-purple-700 font-mono">Rp 0</span></div>
                            <div>Net Captured: <span id="drawer-net-captured" class="font-semibold text-emerald-700 font-mono">Rp 0</span></div>
                        </div>
                    </div>

                    <!-- 2. Gateway & Provider Telemetry -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">
                            Payment Gateway Diagnostics
                        </h3>
                        <div class="grid grid-cols-2 gap-3 text-xs bg-white p-3.5 rounded-xl border border-[var(--border)]">
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Gateway Host</span>
                                <span id="drawer-gateway-host" class="font-semibold text-slate-800">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Acquirer / Channel</span>
                                <span id="drawer-acquirer" class="font-semibold text-slate-800">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Provider Reference</span>
                                <span id="drawer-provider-ref" class="font-mono font-semibold text-slate-800 break-all">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Approval Code</span>
                                <span id="drawer-approval-code" class="font-mono font-semibold text-emerald-700">--</span>
                            </div>
                            <div class="col-span-2 pt-1 border-t border-slate-100">
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Customer Mask</span>
                                <span id="drawer-customer-mask" class="font-mono text-slate-700">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Operational Placement & Payable Association -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">
                            Operational Context
                        </h3>
                        <div class="space-y-2.5 bg-white p-3.5 rounded-xl border border-[var(--border)] text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Facility:</span>
                                <span id="drawer-facility" class="font-semibold text-slate-800 text-right">--</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Terminal / Gate Lane:</span>
                                <span id="drawer-lane" class="font-semibold text-slate-800 text-right">--</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Payable Type:</span>
                                <span id="drawer-payable-type" class="font-semibold text-slate-800">--</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Payable Reference:</span>
                                <span id="drawer-payable-ref-container">
                                    <span id="drawer-payable-ref" class="font-mono font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">--</span>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Associated Vehicle:</span>
                                <span id="drawer-vehicle" class="font-mono font-bold text-slate-800">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Gateway Event Audit Timeline -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">
                            Audit & Verification Timeline
                        </h3>
                        <div id="drawer-timeline" class="space-y-3 border-l-2 border-slate-200 ml-2.5 pl-3">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-[var(--border)] bg-slate-50/75 flex items-center justify-between gap-3">
                    <button type="button" 
                            onclick="closeTransactionDetails()" 
                            class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                        Close
                    </button>

                    <div id="drawer-action-container">
                        <!-- Populated dynamically (Reconcile button if attention needed) -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= RECONCILIATION MODAL ================= -->
    <div id="reconcile-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="reconcile-modal-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" onclick="closeReconcileModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-md w-full border border-[var(--border)] overflow-hidden animate-scale-up">
                
                <div class="p-5 border-b border-[var(--border)] bg-slate-50/75 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 id="reconcile-modal-title" class="text-sm font-bold text-slate-900">Confirm Reconciliation</h3>
                            <p class="text-xs text-slate-500">Resolve investigation and clear status</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeReconcileModal()" class="p-1 text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="reconcile-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    <div>
                        <div class="text-xs text-slate-600 mb-1">Transaction Reference:</div>
                        <div id="reconcile-modal-code" class="font-mono text-xs font-extrabold text-slate-900 bg-slate-100 p-2 rounded-lg border border-slate-200">
                            TRX-NUSA-...
                        </div>
                    </div>

                    <div>
                        <label for="reconcile-notes" class="block text-xs font-bold text-slate-700 mb-1">
                            Reconciliation Notes / Resolution Summary
                        </label>
                        <textarea id="reconcile-notes" 
                                  name="notes" 
                                  rows="3" 
                                  required
                                  placeholder="Describe the verification outcome (e.g., Bank host confirmed manual capture approval, discrepancy cleared)..."
                                  class="w-full p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 focus:bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2.5 pt-2 border-t border-slate-100">
                        <button type="button" 
                                onclick="closeReconcileModal()" 
                                class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors flex items-center gap-1.5 shadow-xs">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Mark Reconciled</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@push('scripts')
<script>
    let activeTransactionDossier = null;

    /**
     * Open Slide-Over Drawer with full transaction metadata & timeline.
     */
    async function openTransactionDetails(transactionId) {
        const drawer = document.getElementById('transaction-drawer');
        if (!drawer) return;

        drawer.classList.remove('hidden');

        try {
            const res = await fetch('/api/vendor/transactions/' + encodeURIComponent(transactionId));
            if (!res.ok) throw new Error('Failed to fetch transaction record');
            const data = await res.json();

            if (!data.success || !data.transaction) throw new Error('Transaction record not found');
            const t = data.transaction;
            activeTransactionDossier = t;

            // Header Elements
            document.getElementById('drawer-trx-ref').innerText = t.transaction_reference;
            document.getElementById('drawer-created-at').innerText = 'Timestamp: ' + t.created_at;

            // Status Pill
            const statusPill = document.getElementById('drawer-status-pill');
            if (t.transaction_status === 'successful') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200';
                statusPill.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Successful';
            } else if (t.transaction_status === 'pending') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-300';
                statusPill.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span> Pending';
            } else if (t.transaction_status === 'failed') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-red-50 text-red-700 border border-red-200';
                statusPill.innerHTML = 'Failed';
            } else if (t.transaction_status === 'refunded') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-purple-50 text-purple-700 border border-purple-200';
                statusPill.innerHTML = 'Refunded';
            } else {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-rose-100 text-rose-800 border border-rose-300';
                statusPill.innerHTML = 'Disputed';
            }

            // Settlement Pill
            const settlementPill = document.getElementById('drawer-settlement-pill');
            settlementPill.innerText = t.settlement_status_label || 'Settled';

            // Flag Banner
            const flagBanner = document.getElementById('drawer-flag-banner');
            if (t.reconciliation_flag) {
                flagBanner.classList.remove('hidden');
                document.getElementById('drawer-flag-reason').innerText = t.reconciliation_notes || 'Requires operational review and clearing.';
            } else {
                flagBanner.classList.add('hidden');
            }

            // Financial Breakdown
            document.getElementById('drawer-amount').innerText = t.formatted_amount;
            document.getElementById('drawer-base-fee').innerText = 'Rp ' + Number(t.base_fee || 0).toLocaleString('id-ID');
            document.getElementById('drawer-service-fee').innerText = 'Rp ' + Number(t.service_fee || 0).toLocaleString('id-ID');
            document.getElementById('drawer-refunded').innerText = t.formatted_refunded_amount || 'Rp 0';
            const netAmount = (t.amount || 0) - (t.refunded_amount || 0);
            document.getElementById('drawer-net-captured').innerText = 'Rp ' + netAmount.toLocaleString('id-ID');

            // Diagnostics
            document.getElementById('drawer-gateway-host').innerText = t.gateway_provider || 'Direct Terminal';
            document.getElementById('drawer-acquirer').innerText = (t.gateway_acquirer || '--') + ' (' + (t.payment_channel || '--') + ')';
            document.getElementById('drawer-provider-ref').innerText = t.provider_reference || '--';
            document.getElementById('drawer-approval-code').innerText = t.auth_approval_code || '--';
            document.getElementById('drawer-customer-mask').innerText = t.customer_mask || 'Anonymous Guest';

            // Operational Context
            document.getElementById('drawer-facility').innerText = t.facility_name;
            document.getElementById('drawer-lane').innerText = t.terminal_lane;
            document.getElementById('drawer-payable-type').innerText = t.payable_type_label;

            const payableRefContainer = document.getElementById('drawer-payable-ref-container');
            if (t.payable_type === 'session' && t.payable_reference) {
                payableRefContainer.innerHTML = `<a href="/vendor/parking-sessions?q=${encodeURIComponent(t.payable_reference)}" class="font-mono font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-2 py-0.5 rounded transition-colors">${t.payable_reference} &rarr;</a>`;
            } else {
                payableRefContainer.innerHTML = `<span class="font-mono font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">${t.payable_reference || 'Direct Terminal'}</span>`;
            }

            document.getElementById('drawer-vehicle').innerText = (t.vehicle_plate || '--') + (t.vehicle_model ? ' (' + t.vehicle_model + ')' : '');

            // Timeline
            const timelineContainer = document.getElementById('drawer-timeline');
            if (t.timeline && t.timeline.length > 0) {
                timelineContainer.innerHTML = t.timeline.map(item => `
                    <div class="relative pl-3 pb-1">
                        <div class="absolute -left-[19px] top-1 w-3 h-3 rounded-full ${item.status === 'warning' ? 'bg-amber-400' : (item.status === 'danger' ? 'bg-rose-500' : 'bg-emerald-500')} border-2 border-white shadow-2xs"></div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-slate-800">${item.event}</span>
                            <span class="text-slate-400 font-mono text-[10px]">${item.time}</span>
                        </div>
                        <div class="text-[11px] text-slate-500 mt-0.5">${item.details}</div>
                    </div>
                `).join('');
            } else {
                timelineContainer.innerHTML = '<div class="text-xs text-slate-400 italic">No timeline trace available.</div>';
            }

            // Footer action
            const actionContainer = document.getElementById('drawer-action-container');
            if (t.reconciliation_flag || t.transaction_status === 'disputed' || t.transaction_status === 'failed') {
                actionContainer.innerHTML = `
                    <button type="button" 
                            onclick="closeTransactionDetails(); openReconcileModal('${t.id}', '${t.transaction_reference}')" 
                            class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Reconcile Discrepancy</span>
                    </button>
                `;
            } else {
                actionContainer.innerHTML = `
                    <span class="text-[11px] font-semibold text-slate-400">Reconciliation Verified</span>
                `;
            }

        } catch (err) {
            document.getElementById('drawer-timeline').innerHTML = `<div class="text-xs text-red-600">Error: ${err.message}</div>`;
        }
    }

    function closeTransactionDetails() {
        const drawer = document.getElementById('transaction-drawer');
        if (drawer) drawer.classList.add('hidden');
    }

    /**
     * Modal controls for reconciliation.
     */
    function openReconcileModal(id, code) {
        document.getElementById('reconcile-modal-code').innerText = code;
        document.getElementById('reconcile-form').action = '/vendor/transactions/' + encodeURIComponent(id) + '/reconcile';
        document.getElementById('reconcile-modal').classList.remove('hidden');
    }

    function closeReconcileModal() {
        document.getElementById('reconcile-modal').classList.add('hidden');
    }

    // Keyboard accessibility
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeTransactionDetails();
            closeReconcileModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
