<x-layouts.vendor activeNav="billing" title="Subscription Billing & Invoices - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Payment Confirmed</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Billing Notice</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- ================= PAGE HEADER & PRIMARY ACTIONS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                    <rect x="2" y="7" width="20" height="5"></rect>
                    <line x1="12" y1="22" x2="12" y2="7"></line>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Financial Administration • Page 34</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Billing Center Active
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Tenant: {{ $tenant['brand_name'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Billing
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Review subscription invoices, billing periods, amounts due, and billing payment history.
                </p>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Refresh Action -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Billing Records"
                    aria-label="Refresh Live Billing Records">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Export Billing Ledger -->
            <a href="/vendor/billing/export" 
               class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
               title="Export full billing statement ledger to CSV">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export Ledger CSV</span>
            </a>
        </div>
    </div>

    <!-- ================= CURRENT SUBSCRIPTION CONTEXT BANNER ================= -->
    <div class="p-5 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-sm space-y-4">
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-500/20 text-blue-300 border border-blue-400/30">
                        {{ $subscription['plan_badge'] }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        {{ $subscription['status_label'] }}
                    </span>
                    <span class="text-xs text-slate-400">• {{ $subscription['billing_interval'] }} Cycle</span>
                </div>
                <h2 class="text-lg sm:text-xl font-extrabold text-white mt-1">
                    {{ $subscription['plan_name'] }}
                </h2>
                <p class="text-xs text-slate-300 mt-0.5">
                    Current Billing Cycle: <strong>{{ $subscription['current_period_start'] }} - {{ $subscription['current_period_end'] }}</strong>
                </p>
            </div>

            <!-- Renewal & Payment Method Details -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 lg:text-right">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Next Renewal & Billing</span>
                    <div class="text-sm font-bold text-white mt-0.5">
                        {{ $subscription['next_billing_date'] }}
                    </div>
                    <div class="text-[11px] text-emerald-400 flex items-center lg:justify-end gap-1 mt-0.5">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>{{ $subscription['renewal_status'] }}</span>
                    </div>
                </div>

                <div class="sm:border-l sm:border-slate-700 sm:pl-3 lg:border-l-0 lg:pl-0">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Monthly Rate (incl. 11% PPN)</span>
                    <div class="text-base sm:text-lg font-extrabold text-blue-300 mt-0.5">
                        {{ $subscription['formatted_total_monthly'] }}
                    </div>
                    <div class="text-[10px] text-slate-400">
                        {{ $subscription['payment_method_summary'] }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Entitlements Breakdown Chips -->
        <div class="pt-3 border-t border-slate-700/60 flex flex-wrap items-center justify-between gap-3 text-xs">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[11px] font-semibold text-slate-400">Active Entitlements:</span>
                <span class="px-2 py-0.5 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-[11px]">
                    1 Multi-Facility Core License
                </span>
                <span class="px-2 py-0.5 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-[11px]">
                    3 Managed Facilities Active
                </span>
                <span class="px-2 py-0.5 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-[11px]">
                    18 Hardware Cloud Gateways (Gates + ANPR)
                </span>
                <span class="px-2 py-0.5 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-[11px]">
                    24/7 Field SLA Support Pack
                </span>
            </div>

            <!-- Page 33 Subscription Notice link -->
            <a href="/vendor/dashboard?notice=subscription_planned" 
               class="text-xs font-bold text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 transition-colors">
                <span>Manage Plan & Entitlements</span>
                <span>&rarr;</span>
            </a>
        </div>

    </div>

    <!-- ================= BILLING SUMMARY STRIP (4 KPIS) ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
        
        <!-- 1. Outstanding Balance -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Outstanding Balance</span>
                <div class="text-xl sm:text-2xl font-extrabold mt-1 {{ $summary['outstanding_balance'] > 0 ? 'text-amber-700' : 'text-emerald-700' }}">
                    {{ $summary['formatted_outstanding_balance'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    @if($summary['unpaid_count'] > 0)
                        {{ $summary['unpaid_count'] }} unpaid invoice due
                    @else
                        All statements settled
                    @endif
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl {{ $summary['outstanding_balance'] > 0 ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700' }} flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
        </div>

        <!-- 2. Most Recent Invoice -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Latest Invoice</span>
                <div class="text-base sm:text-lg font-extrabold text-slate-900 mt-1 truncate max-w-[160px]">
                    {{ $summary['latest_invoice']['invoice_number'] ?? 'N/A' }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    {{ $summary['latest_invoice']['formatted_total'] ?? 'Rp 0' }} • 
                    <span class="font-bold {{ ($summary['latest_invoice']['status'] ?? '') === 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ strtoupper($summary['latest_invoice']['status'] ?? 'N/A') }}
                    </span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[var(--accent)] flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
            </div>
        </div>

        <!-- 3. Most Recent Payment -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Last Payment Settled</span>
                <div class="text-base sm:text-lg font-extrabold text-emerald-700 mt-1">
                    {{ $summary['last_payment']['formatted_amount'] ?? 'Rp 0' }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    {{ $summary['last_payment']['payment_date'] ?? 'No prior payment' }}
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
        </div>

        <!-- 4. Next Renewal Date -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Scheduled Renewal</span>
                <div class="text-base sm:text-lg font-extrabold text-slate-900 mt-1">
                    {{ $subscription['next_billing_date'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    BCA Corporate Auto-Debit
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
        </div>

    </div>

    <!-- ================= INVOICE SEARCH & FILTERS BAR ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <form method="GET" action="/vendor/billing" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            
            <!-- 1. Search Query -->
            <div class="lg:col-span-2">
                <label for="filter-q" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Search Invoices
                </label>
                <div class="relative">
                    <input type="text" 
                           id="filter-q"
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search by invoice number (e.g. INV-2026), period, or settlement ref..." 
                           class="w-full pl-9 pr-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all">
                    <div class="absolute left-3 top-2.5 text-slate-400 pointer-events-none">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </div>
            </div>

            <!-- 2. Status Filter -->
            <div>
                <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Invoice Status
                </label>
                <select id="filter-status" 
                        name="status" 
                        class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Statuses</option>
                    <option value="unpaid" {{ ($filters['status'] === 'unpaid') ? 'selected' : '' }}>Unpaid / Due Soon</option>
                    <option value="overdue" {{ ($filters['status'] === 'overdue') ? 'selected' : '' }}>Overdue</option>
                    <option value="paid" {{ ($filters['status'] === 'paid') ? 'selected' : '' }}>Paid</option>
                </select>
            </div>

            <!-- 3. Sort & Submit Controls -->
            <div>
                <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Sort Order
                </label>
                <div class="flex items-center gap-2">
                    <select id="filter-sort" 
                            name="sort" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="date_desc" {{ ($filters['sort'] === 'date_desc') ? 'selected' : '' }}>Newest Issue Date</option>
                        <option value="date_asc" {{ ($filters['sort'] === 'date_asc') ? 'selected' : '' }}>Oldest Issue Date</option>
                        <option value="amount_desc" {{ ($filters['sort'] === 'amount_desc') ? 'selected' : '' }}>Highest Amount</option>
                        <option value="amount_asc" {{ ($filters['sort'] === 'amount_asc') ? 'selected' : '' }}>Lowest Amount</option>
                    </select>

                    <button type="submit" 
                            class="px-3.5 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold transition-colors cursor-pointer shrink-0">
                        Filter
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/billing" 
                       class="px-2.5 py-2 rounded-xl border border-slate-200 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition-colors shrink-0" 
                       title="Reset filters">
                        Reset
                    </a>
                    @endif
                </div>
            </div>

        </form>
    </div>

    <!-- ================= INVOICE LIST TABLE ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <!-- Table Topbar -->
        <div class="px-5 py-3.5 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div>
                <span class="font-bold text-slate-800">Subscription Invoices Ledger</span>
                <span class="text-slate-500 ml-1.5">• Showing {{ $pagination['from'] }} - {{ $pagination['to'] }} of {{ $pagination['total'] }} recorded statements</span>
            </div>

            <div class="text-slate-500 text-[11px]">
                Tax ID: <strong class="text-slate-800 font-mono">NPWP 01.234.567.8-012.000</strong>
            </div>
        </div>

        <!-- Table Responsive Container -->
        <div class="overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse text-xs min-w-[850px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Invoice Reference</th>
                        <th class="py-3.5 px-4">Billing Period</th>
                        <th class="py-3.5 px-4">Due Date</th>
                        <th class="py-3.5 px-4 text-right">Amount (IDR)</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4">Payment Reference</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($invoices as $inv)
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        
                        <!-- 1. Invoice Reference & Issue Date -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                    {{ $inv['invoice_number'] }}
                                </span>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5">
                                Issued: {{ $inv['formatted_issue_date'] }}
                            </div>
                        </td>

                        <!-- 2. Billing Period -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="font-semibold text-slate-800">{{ $inv['billing_period'] }}</div>
                            <div class="text-[10px] text-slate-400">Monthly Entitlement Run</div>
                        </td>

                        <!-- 3. Due Date -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="font-semibold text-slate-800">{{ $inv['formatted_due_date'] }}</div>
                            @if($inv['status'] === 'unpaid')
                            <div class="text-[10px] text-amber-700 font-bold">Net 14 Terms</div>
                            @elseif($inv['status'] === 'overdue')
                            <div class="text-[10px] text-rose-700 font-bold">Past Due</div>
                            @else
                            <div class="text-[10px] text-emerald-700">Settled on {{ date('d M Y', strtotime($inv['paid_at'])) }}</div>
                            @endif
                        </td>

                        <!-- 4. Total Amount -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="font-mono font-bold text-slate-900 text-sm">
                                {{ $inv['formatted_total'] }}
                            </div>
                            <div class="text-[10px] text-slate-400 font-mono">
                                Subtotal {{ $inv['formatted_subtotal'] }} + PPN
                            </div>
                        </td>

                        <!-- 5. Payment Status -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold {{ $inv['status_meta']['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $inv['status_meta']['dot'] }}"></span>
                                {{ $inv['status_meta']['label'] }}
                            </span>
                        </td>

                        <!-- 6. Payment Reference -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if(!empty($inv['payment_reference']))
                            <div class="font-mono text-[11px] font-semibold text-slate-700">
                                {{ $inv['payment_reference'] }}
                            </div>
                            <div class="text-[10px] text-slate-400 truncate max-w-[150px]" title="{{ $inv['payment_method'] }}">
                                {{ $inv['payment_method'] }}
                            </div>
                            @else
                            <span class="text-slate-400 font-mono text-xs">Pending Settlement</span>
                            @endif
                        </td>

                        <!-- 7. Actions -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Pay Now Button (if unpaid/overdue) -->
                                @if($inv['status'] !== 'paid')
                                <button type="button" 
                                        onclick="openPayModal({{ json_encode($inv) }})"
                                        class="px-2.5 py-1.5 rounded-lg bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold transition-colors cursor-pointer shadow-xs flex items-center gap-1"
                                        title="Pay invoice via Corporate Virtual Account">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    <span>Pay Invoice</span>
                                </button>
                                @endif

                                <!-- View Details Modal Trigger -->
                                <button type="button" 
                                        onclick="openInvoiceModal({{ json_encode($inv) }})"
                                        class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-2xs"
                                        title="View itemized invoice breakdown & tax receipt">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Export / Download Single Invoice CSV -->
                                <a href="/vendor/billing/invoices/{{ $inv['id'] }}/export" 
                                   class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-2xs"
                                   title="Download RFC-compliant CSV invoice document">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </a>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="max-w-sm mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900">No invoice records found</h4>
                                <p class="text-xs text-slate-500 mt-1">
                                    No invoices matched your filter or search query. Try clearing the filters.
                                </p>
                                <a href="/vendor/billing" class="mt-3 px-3 py-1.5 rounded-lg bg-[var(--primary)] text-white text-xs font-bold">
                                    Reset Filters
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Pagination Footer -->
        <div class="px-5 py-3.5 border-t border-[var(--border)] bg-slate-50/75 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div class="text-slate-500">
                Showing <span class="font-bold text-slate-800">{{ $pagination['from'] }}</span> to <span class="font-bold text-slate-800">{{ $pagination['to'] }}</span> of <span class="font-bold text-slate-800">{{ $pagination['total'] }}</span> subscription statements
            </div>
            
            <div class="flex items-center gap-2">
                @if($pagination['current_page'] > 1)
                <a href="/vendor/billing?q={{ urlencode($filters['q']) }}&status={{ $filters['status'] }}&year={{ $filters['year'] }}&sort={{ $filters['sort'] }}&page={{ $pagination['current_page'] - 1 }}" 
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
                <a href="/vendor/billing?q={{ urlencode($filters['q']) }}&status={{ $filters['status'] }}&year={{ $filters['year'] }}&sort={{ $filters['sort'] }}&page={{ $pagination['current_page'] + 1 }}" 
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

    <!-- ================= BILLING PAYMENT HISTORY AUDIT LOG ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <div class="px-5 py-4 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-sm sm:text-base font-bold text-slate-900">
                    Subscription Payment History
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Verified settlement records for SaaS subscription license invoices (distinct from customer parking transactions).
                </p>
            </div>
            <span class="text-[11px] font-semibold text-slate-400">
                Idempotency Verified • Audit Sealed
            </span>
        </div>

        <div class="overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse text-xs min-w-[750px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Settlement Reference</th>
                        <th class="py-3.5 px-4">Invoice Ref</th>
                        <th class="py-3.5 px-4">Payment Date & Time</th>
                        <th class="py-3.5 px-4">Payment Channel</th>
                        <th class="py-3.5 px-4 text-right">Settled Amount</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4">Gateway Reference</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($payments as $pay)
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-3 px-4 font-mono font-bold text-slate-900">
                            {{ $pay['payment_reference'] }}
                        </td>
                        <td class="py-3 px-4 font-mono font-semibold text-slate-700">
                            {{ $pay['invoice_number'] }}
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            {{ $pay['payment_date'] }}
                        </td>
                        <td class="py-3 px-4 text-slate-700">
                            {{ $pay['payment_method'] }}
                        </td>
                        <td class="py-3 px-4 text-right font-mono font-bold text-emerald-700">
                            {{ $pay['formatted_amount'] }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                {{ $pay['status_label'] ?? 'Settled' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-mono text-[11px] text-slate-500">
                            {{ $pay['provider_reference'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-500">
                            No billing payment settlements recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= MODAL 1: INVOICE DETAIL & LINE ITEMS BREAKDOWN ================= -->
    <div id="modal-invoice-detail" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" onclick="closeInvoiceModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-10 animate-fade-in" id="printable-invoice-container">
                
                <!-- Modal Topbar -->
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between no-print">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[var(--primary)] text-white flex items-center justify-center font-bold text-xs">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Official Tax Invoice</h3>
                            <p class="text-[11px] text-slate-500" id="inv-modal-header-sub">Invoice Details</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Print Button -->
                        <button type="button" 
                                onclick="window.print()" 
                                class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors cursor-pointer flex items-center gap-1 shadow-2xs">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                            <span>Print</span>
                        </button>

                        <!-- Close Modal -->
                        <button type="button" onclick="closeInvoiceModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                </div>

                <!-- Printable Invoice Document Body -->
                <div class="p-6 sm:p-8 space-y-6">
                    
                    <!-- Document Header -->
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-6 border-b border-slate-200">
                        <div>
                            <div class="font-extrabold text-xl text-[var(--primary)] tracking-tight">
                                Nusa<span class="text-[var(--accent)]">Park</span>
                            </div>
                            <div class="text-xs font-bold text-slate-800 mt-1" id="inv-issuer-company">PT NusaPark Digital Indonesia</div>
                            <div class="text-[11px] text-slate-500 mt-0.5" id="inv-issuer-address">Cyber 2 Tower, Lantai 18, Jakarta Selatan</div>
                            <div class="text-[11px] text-slate-500 font-mono mt-0.5" id="inv-issuer-tax">NPWP: 02.456.789.1-015.000</div>
                        </div>

                        <div class="sm:text-right">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Tax Invoice / Faktur Pajak</div>
                            <div class="text-lg font-extrabold font-mono text-slate-900 mt-0.5" id="inv-number">INV-2026-10-0042</div>
                            <div class="mt-1">
                                <span id="inv-status-badge" class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold">UNPAID</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient & Period Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Billed To (Recipient)</span>
                            <div class="font-bold text-slate-900 text-sm" id="inv-recipient-company">PT Parkir Cipta Nusantara</div>
                            <div class="text-slate-600 mt-0.5" id="inv-recipient-attn">Attn: Budi Santoso</div>
                            <div class="text-slate-500 mt-0.5" id="inv-recipient-address">Jakarta Selatan</div>
                            <div class="text-slate-500 font-mono mt-0.5" id="inv-recipient-tax">NPWP: 01.234.567.8-012.000</div>
                        </div>

                        <div class="sm:text-right space-y-1">
                            <div>
                                <span class="text-slate-400 text-[11px]">Billing Period:</span>
                                <strong class="text-slate-800 ml-1" id="inv-period">01 Oct 2026 - 31 Oct 2026</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px]">Issue Date:</span>
                                <strong class="text-slate-800 ml-1" id="inv-issue-date">01 Oct 2026</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px]">Payment Due Date:</span>
                                <strong class="text-slate-800 ml-1" id="inv-due-date">15 Oct 2026</strong>
                            </div>
                            <div id="inv-settled-info" class="hidden">
                                <span class="text-slate-400 text-[11px]">Settlement Ref:</span>
                                <strong class="text-emerald-700 ml-1 font-mono" id="inv-settlement-ref">BILL-PAY</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Line Items Table -->
                    <div>
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-slate-200 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    <th class="py-2.5">Item & Entitlement Description</th>
                                    <th class="py-2.5 text-center">Qty</th>
                                    <th class="py-2.5 text-right">Unit Price</th>
                                    <th class="py-2.5 text-right">Line Total</th>
                                </tr>
                            </thead>
                            <tbody id="inv-line-items-body" class="divide-y divide-slate-100 font-medium">
                                <!-- Populated dynamically via JS -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Totals & Calculation Summary -->
                    <div class="pt-4 border-t border-slate-200 flex justify-end">
                        <div class="w-full sm:w-64 space-y-1.5 text-xs">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal:</span>
                                <span class="font-mono font-bold text-slate-800" id="inv-subtotal">Rp 15.000.000</span>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span>PPN (11% VAT):</span>
                                <span class="font-mono font-bold text-slate-800" id="inv-tax">Rp 1.650.000</span>
                            </div>
                            <div id="inv-discount-row" class="hidden flex items-center justify-between text-emerald-600 font-medium">
                                <span>Promo Credit:</span>
                                <span class="font-mono" id="inv-discount">-Rp 0</span>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-slate-200 text-sm font-extrabold text-slate-900">
                                <span>Total Amount:</span>
                                <span class="font-mono text-base text-[var(--primary)]" id="inv-total">Rp 16.650.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions Bar (hidden when printing) -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3 no-print">
                        <div class="text-[11px] text-slate-400">
                            Bank BCA Corporate VA: <strong class="text-slate-700 font-mono">8277 0811 9876 5432</strong>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" 
                                    onclick="closeInvoiceModal()" 
                                    class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold cursor-pointer">
                                Close
                            </button>
                            <button type="button" 
                                    id="inv-modal-pay-btn" 
                                    class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold cursor-pointer shadow-xs">
                                Pay This Invoice
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ================= MODAL 2: PAY INVOICE / CHECKOUT CONFIRMATION ================= -->
    <div id="modal-pay-invoice" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" onclick="closePayModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-10 animate-fade-in">
                
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[var(--primary)] text-white flex items-center justify-center font-bold text-xs">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Settle Subscription Invoice</h3>
                            <p class="text-[11px] text-slate-500">Corporate Payment Gateway</p>
                        </div>
                    </div>
                    <button type="button" onclick="closePayModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="pay-invoice-form" method="POST" action="" class="p-6 space-y-4">
                    @csrf

                    <!-- Invoice Summary Card -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Statement Number</span>
                            <span class="font-mono font-extrabold text-slate-900 text-sm" id="pay-modal-inv-num">INV-2026-10-0042</span>
                            <p class="text-[10px] text-slate-500 mt-0.5" id="pay-modal-inv-period">01 Oct - 31 Oct 2026</p>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Total Due</span>
                            <span class="font-mono font-extrabold text-base text-[var(--primary)]" id="pay-modal-inv-amount">Rp 16.650.000</span>
                            <p class="text-[10px] text-slate-500 mt-0.5">Incl. 11% PPN</p>
                        </div>
                    </div>

                    <!-- Payment Method Selector -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">
                            Select Payment Channel
                        </label>

                        <div class="space-y-2 text-xs">
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white cursor-pointer transition-colors">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="Bank BCA Corporate Virtual Account" 
                                       checked 
                                       class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                <div class="flex-1">
                                    <strong class="text-slate-900 block">Bank BCA Corporate Virtual Account</strong>
                                    <span class="text-[11px] font-mono text-slate-500">VA No: 8277 0811 9876 5432</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)]">Instant</span>
                            </label>

                            <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white cursor-pointer transition-colors">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="Bank Mandiri Corporate Virtual Account" 
                                       class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                <div class="flex-1">
                                    <strong class="text-slate-900 block">Bank Mandiri Corporate Virtual Account</strong>
                                    <span class="text-[11px] font-mono text-slate-500">VA No: 8910 1198 7654 3210</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)]">Instant</span>
                            </label>

                            <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white cursor-pointer transition-colors">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="Corporate QRIS / B2B Settlement" 
                                       class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                <div class="flex-1">
                                    <strong class="text-slate-900 block">QRIS Dynamic B2B Settlement</strong>
                                    <span class="text-[11px] text-slate-500">National QRIS network barcode clearance</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Safeguard Notice -->
                    <div class="p-3 rounded-xl bg-blue-50 border border-blue-200 text-blue-900 text-[11px] flex items-start gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5 text-blue-700"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span>
                            Payment will immediately generate a confirmed transaction reference and update this statement status to <strong>Paid</strong> in the tenant ledger.
                        </span>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" 
                                onclick="closePayModal()" 
                                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold cursor-pointer shadow-xs">
                            Confirm & Settle Payment
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-invoice-container, #printable-invoice-container * {
            visibility: visible;
        }
        #printable-invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    /**
     * Invoice Detail Modal Helpers
     */
    function openInvoiceModal(inv) {
        document.getElementById('inv-modal-header-sub').innerText = 'Statement ' + inv.invoice_number;
        document.getElementById('inv-number').innerText = inv.invoice_number;
        document.getElementById('inv-period').innerText = inv.billing_period;
        document.getElementById('inv-issue-date').innerText = inv.formatted_issue_date;
        document.getElementById('inv-due-date').innerText = inv.formatted_due_date;

        // Issuer & Recipient
        if (inv.issuer) {
            document.getElementById('inv-issuer-company').innerText = inv.issuer.company;
            document.getElementById('inv-issuer-address').innerText = inv.issuer.address + ', ' + inv.issuer.city;
            document.getElementById('inv-issuer-tax').innerText = inv.issuer.tax_id;
        }
        if (inv.recipient) {
            document.getElementById('inv-recipient-company').innerText = inv.recipient.company;
            document.getElementById('inv-recipient-attn').innerText = 'Attn: ' + inv.recipient.attention;
            document.getElementById('inv-recipient-address').innerText = inv.recipient.address + ', ' + inv.recipient.city;
            document.getElementById('inv-recipient-tax').innerText = inv.recipient.tax_id;
        }

        // Status badge
        const badgeEl = document.getElementById('inv-status-badge');
        badgeEl.innerText = (inv.status || 'unpaid').toUpperCase();
        if (inv.status === 'paid') {
            badgeEl.className = 'inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200';
            document.getElementById('inv-settled-info').classList.remove('hidden');
            document.getElementById('inv-settlement-ref').innerText = inv.payment_reference || '-';
            document.getElementById('inv-modal-pay-btn').classList.add('hidden');
        } else {
            badgeEl.className = 'inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300';
            document.getElementById('inv-settled-info').classList.add('hidden');
            const payBtn = document.getElementById('inv-modal-pay-btn');
            payBtn.classList.remove('hidden');
            payBtn.onclick = function() {
                closeInvoiceModal();
                openPayModal(inv);
            };
        }

        // Line Items Table
        const tbody = document.getElementById('inv-line-items-body');
        tbody.innerHTML = '';
        (inv.line_items || []).forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2.5">
                    <strong class="text-slate-900 block">${item.name}</strong>
                    <span class="text-[10px] text-slate-500 leading-tight block mt-0.5">${item.description}</span>
                </td>
                <td class="py-2.5 text-center font-bold text-slate-700">${item.quantity}</td>
                <td class="py-2.5 text-right font-mono text-slate-700">${item.formatted_unit_price}</td>
                <td class="py-2.5 text-right font-mono font-bold text-slate-900">${item.formatted_total}</td>
            `;
            tbody.appendChild(tr);
        });

        // Totals
        document.getElementById('inv-subtotal').innerText = inv.formatted_subtotal;
        document.getElementById('inv-tax').innerText = inv.formatted_tax;
        document.getElementById('inv-total').innerText = inv.formatted_total;

        const discountRow = document.getElementById('inv-discount-row');
        if (inv.discount_amount > 0) {
            discountRow.classList.remove('hidden');
            document.getElementById('inv-discount').innerText = '-' + inv.formatted_discount;
        } else {
            discountRow.classList.add('hidden');
        }

        document.getElementById('modal-invoice-detail').classList.remove('hidden');
    }

    function closeInvoiceModal() {
        document.getElementById('modal-invoice-detail').classList.add('hidden');
    }

    /**
     * Pay Invoice Modal Helpers
     */
    function openPayModal(inv) {
        document.getElementById('pay-invoice-form').action = '/vendor/billing/invoices/' + inv.id + '/pay';
        document.getElementById('pay-modal-inv-num').innerText = inv.invoice_number;
        document.getElementById('pay-modal-inv-period').innerText = inv.billing_period;
        document.getElementById('pay-modal-inv-amount').innerText = inv.formatted_total;
        document.getElementById('modal-pay-invoice').classList.remove('hidden');
    }

    function closePayModal() {
        document.getElementById('modal-pay-invoice').classList.add('hidden');
    }
</script>
@endpush

</x-layouts.vendor>
