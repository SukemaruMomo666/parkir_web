<x-layouts.admin activeNav="billing" title="Billing Platform — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Success</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 text-rose-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Action Restricted</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-5 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 shadow-xs" role="alert">
        <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-800 mb-1">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            <span>Validation Error</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-0.5 text-amber-800">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- ================= PAGE HEADER & BREADCRUMBS ================= -->
    <div class="space-y-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">Billing Platform</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>Platform-Wide Subscription Billing & Invoicing</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Audit Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Billing Platform
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 46
                    </span>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">
                        {{ $globalSummary['total_invoices_count'] }} Invoices Issued
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Platform-wide subscription invoice administration, payment reconciliation, outstanding balances, and billing audit records.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.billing', request()->query()) }}" 
                   title="Refresh billing telemetry"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                    </svg>
                    <span class="hidden sm:inline">Refresh</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.billing.export', request()->query()) }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export Invoices CSV</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS BANNER ================= -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
        
        <!-- Total Invoiced Amount -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Total Invoiced</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-slate-900 font-mono tracking-tight">
                {{ $summary['formatted_total_invoiced'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ $summary['total_invoices_count'] }} issued subscription invoices
            </div>
        </div>

        <!-- Paid / Collected Amount -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Paid & Cleared</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-emerald-600 font-mono tracking-tight">
                {{ $summary['formatted_paid_amount'] }}
            </div>
            <div class="text-[11px] text-emerald-700 font-medium mt-1">
                {{ $summary['paid_invoices_count'] }} invoices settled ({{ $summary['collection_rate_pct'] }}%)
            </div>
        </div>

        <!-- Total Outstanding Balance -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Outstanding Balance</span>
                <span class="w-2 h-2 rounded-full {{ $summary['total_outstanding_amount'] > 0 ? 'bg-amber-500' : 'bg-slate-300' }}"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold {{ $summary['total_outstanding_amount'] > 0 ? 'text-amber-600' : 'text-slate-800' }} font-mono tracking-tight">
                {{ $summary['formatted_outstanding_amount'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ $summary['outstanding_invoices_count'] }} unpaid/open balances
            </div>
        </div>

        <!-- Overdue Invoices -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Overdue Invoices</span>
                <span class="w-2 h-2 rounded-full {{ $summary['overdue_invoices_count'] > 0 ? 'bg-rose-500 animate-pulse' : 'bg-slate-300' }}"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold {{ $summary['overdue_invoices_count'] > 0 ? 'text-rose-600' : 'text-slate-900' }} font-mono tracking-tight">
                {{ $summary['formatted_overdue_amount'] }}
            </div>
            <div class="text-[11px] text-rose-700 font-medium mt-1">
                {{ $summary['overdue_invoices_count'] }} past-due invoices
            </div>
        </div>

        <!-- Collection Health -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs col-span-2 sm:col-span-1">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Collection Rate</span>
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-purple-700 font-mono tracking-tight">
                {{ $summary['collection_rate_pct'] }}%
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ $summary['failed_attempts_count'] }} failed payment attempts
            </div>
        </div>

    </div>

    <!-- ================= FILTERS & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.billing') }}" class="space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">
                
                <!-- Search Query -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Search Invoices
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Invoice #, tenant, contact, ref..."
                               class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                    </div>
                </div>

                <!-- Tenant Selector -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Tenant / Operator
                    </label>
                    <select name="vendor" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        <option value="all" {{ $filters['vendor'] === 'all' ? 'selected' : '' }}>All Tenants</option>
                        @foreach($tenants as $t)
                        <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                            {{ $t['company_name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Plan Tier Selector -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Plan Tier
                    </label>
                    <select name="plan" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        <option value="all" {{ $filters['plan'] === 'all' ? 'selected' : '' }}>All Plans</option>
                        @foreach($plans as $p)
                        <option value="{{ $p['slug'] }}" {{ $filters['plan'] === $p['slug'] ? 'selected' : '' }}>
                            {{ $p['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Invoice Status Filter -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Invoice Status
                    </label>
                    <select name="status" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        @foreach($statuses as $k => $label)
                        <option value="{{ $k }}" {{ $filters['status'] === $k ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Billing Cycle / Period Filter -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Billing Period
                    </label>
                    <select name="period" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        <option value="all" {{ $filters['period'] === 'all' ? 'selected' : '' }}>All Billing Cycles</option>
                        <option value="current_cycle" {{ $filters['period'] === 'current_cycle' ? 'selected' : '' }}>October 2026 (Current Cycle)</option>
                        <option value="2026-09" {{ $filters['period'] === '2026-09' ? 'selected' : '' }}>September 2026</option>
                    </select>
                </div>

            </div>

            <div class="flex items-center justify-between gap-3 pt-2 border-t border-slate-100 flex-wrap">
                <!-- Sorting Selector -->
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-500 font-medium">Sort by:</span>
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="px-2.5 py-1 text-xs rounded-lg border border-slate-200 bg-white font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                        <option value="due_desc" {{ $filters['sort'] === 'due_desc' ? 'selected' : '' }}>Newest Due Date</option>
                        <option value="due_asc" {{ $filters['sort'] === 'due_asc' ? 'selected' : '' }}>Oldest Due Date</option>
                        <option value="amount_desc" {{ $filters['sort'] === 'amount_desc' ? 'selected' : '' }}>Highest Total Amount</option>
                        <option value="amount_asc" {{ $filters['sort'] === 'amount_asc' ? 'selected' : '' }}>Lowest Total Amount</option>
                        <option value="inv_asc" {{ $filters['sort'] === 'inv_asc' ? 'selected' : '' }}>Invoice Number (A-Z)</option>
                        <option value="vendor_asc" {{ $filters['sort'] === 'vendor_asc' ? 'selected' : '' }}>Tenant Name (A-Z)</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.billing') }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold transition-colors">
                        Reset Filters
                    </a>
                    <button type="submit" 
                            class="px-4 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs shadow-indigo-600/20">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- ================= INVOICE INVENTORY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4">Invoice Reference</th>
                        <th class="py-3.5 px-3">Tenant / Operator</th>
                        <th class="py-3.5 px-3">Plan Tier</th>
                        <th class="py-3.5 px-3">Billing Cycle & Dates</th>
                        <th class="py-3.5 px-3">Invoiced Total</th>
                        <th class="py-3.5 px-3">Outstanding Balance</th>
                        <th class="py-3.5 px-3">Invoice & Payment Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($invoices as $inv)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <!-- Invoice Number & Quick Trigger -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        onclick="openInvoiceDrawer('{{ $inv['id'] }}')"
                                        class="font-mono font-bold text-indigo-600 hover:text-indigo-800 hover:underline">
                                    {{ $inv['invoice_number'] }}
                                </button>
                            </div>
                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                Ref: {{ $inv['payment_reference'] }}
                            </div>
                        </td>

                        <!-- Tenant Info -->
                        <td class="py-3.5 px-3">
                            <div class="font-bold text-slate-900">
                                {{ $inv['vendor_name'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                                <span class="font-mono text-slate-400">{{ $inv['vendor_id'] }}</span>
                                <span>•</span>
                                <span>{{ $inv['recipient']['city'] ?? 'Indonesia' }}</span>
                            </div>
                        </td>

                        <!-- Plan Tier -->
                        <td class="py-3.5 px-3">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold font-mono
                                {{ $inv['plan_slug'] === 'enterprise' ? 'bg-purple-50 text-purple-700 border border-purple-200' : '' }}
                                {{ $inv['plan_slug'] === 'growth' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                {{ $inv['plan_slug'] === 'standard' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                {{ $inv['plan_slug'] === 'starter' ? 'bg-slate-100 text-slate-700 border border-slate-200' : '' }}">
                                {{ $inv['plan_name'] }}
                            </span>
                        </td>

                        <!-- Billing Cycle & Dates -->
                        <td class="py-3.5 px-3">
                            <div class="font-semibold text-slate-800">
                                {{ $inv['billing_period'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5 font-mono">
                                <span>Due: <strong>{{ date('d M Y', strtotime($inv['due_date'])) }}</strong></span>
                                @if(($inv['days_overdue'] ?? 0) > 0)
                                <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-1 rounded">
                                    +{{ $inv['days_overdue'] }}d overdue
                                </span>
                                @endif
                            </div>
                        </td>

                        <!-- Invoiced Total -->
                        <td class="py-3.5 px-3">
                            <div class="font-extrabold text-slate-900 font-mono text-[13px]">
                                Rp {{ number_format($inv['total_amount'], 0, ',', '.') }}
                            </div>
                            <div class="text-[10px] text-slate-400">
                                Incl. 11% PPN (Rp {{ number_format($inv['tax_amount'], 0, ',', '.') }})
                            </div>
                        </td>

                        <!-- Outstanding Balance -->
                        <td class="py-3.5 px-3">
                            @if($inv['outstanding_balance'] === 0)
                            <span class="inline-flex items-center gap-1 font-mono font-bold text-emerald-600 text-xs">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Rp 0 (Cleared)</span>
                            </span>
                            @else
                            <div class="font-mono font-bold text-rose-600 text-[13px]">
                                Rp {{ number_format($inv['outstanding_balance'], 0, ',', '.') }}
                            </div>
                            <div class="text-[10px] text-slate-400">
                                Paid: Rp {{ number_format($inv['amount_paid'], 0, ',', '.') }}
                            </div>
                            @endif
                        </td>

                        <!-- Invoice & Payment Status -->
                        <td class="py-3.5 px-3">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                @if($inv['status'] === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Paid</span>
                                </span>
                                @elseif($inv['status'] === 'overdue')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                    <span>Overdue</span>
                                </span>
                                @elseif($inv['status'] === 'unpaid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>Unpaid (Open)</span>
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>{{ ucfirst($inv['status']) }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="text-[10px] text-slate-500 mt-1 truncate max-w-[170px]" title="{{ $inv['payment_method'] }}">
                                {{ $inv['payment_method'] }}
                            </div>
                        </td>

                        <!-- Administrative Actions -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- Inspect Drawer Button -->
                                <button type="button" 
                                        onclick="openInvoiceDrawer('{{ $inv['id'] }}')"
                                        title="View Full Invoice Specification & Payment Audit"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-indigo-50 hover:border-indigo-200 text-slate-600 hover:text-indigo-600 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Reconcile Payment Action (if not paid) -->
                                @if($inv['status'] !== 'paid' && $inv['status'] !== 'void')
                                <button type="button" 
                                        onclick="openReconcileModal('{{ $inv['id'] }}', '{{ $inv['invoice_number'] }}', '{{ $inv['vendor_name'] }}', {{ $inv['outstanding_balance'] }})"
                                        title="Record Verified Settlement / Reconcile"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-emerald-50 hover:border-emerald-200 text-slate-600 hover:text-emerald-700 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>

                                <!-- Send Reminder Action -->
                                <button type="button" 
                                        onclick="openReminderModal('{{ $inv['id'] }}', '{{ $inv['invoice_number'] }}', '{{ $inv['recipient']['billing_email'] }}')"
                                        title="Dispatch Payment Reminder"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-amber-50 hover:border-amber-200 text-slate-600 hover:text-amber-700 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                </button>
                                @endif

                                <!-- Void Invoice Action (if open or overdue) -->
                                @if($inv['status'] === 'unpaid' || $inv['status'] === 'overdue')
                                <button type="button" 
                                        onclick="openVoidModal('{{ $inv['id'] }}', '{{ $inv['invoice_number'] }}', '{{ $inv['vendor_name'] }}')"
                                        title="Void Invoice"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-rose-50 hover:border-rose-200 text-slate-600 hover:text-rose-700 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 px-4 text-center">
                            <div class="max-w-md mx-auto">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">No Invoices Found</h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    No subscription billing records match your current filter parameters. Try clearing your search query or resetting filters.
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('admin.billing') }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                                        Reset All Filters
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        @if($pagination['total'] > 0)
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="text-slate-500">
                Showing <strong class="text-slate-800">{{ $pagination['from'] }}</strong> to <strong class="text-slate-800">{{ $pagination['to'] }}</strong> of <strong class="text-slate-800">{{ $pagination['total'] }}</strong> invoice records
            </div>

            <div class="flex items-center gap-1">
                @if($pagination['current_page'] > 1)
                <a href="{{ route('admin.billing', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                    &larr; Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                    &larr; Previous
                </span>
                @endif

                <span class="px-3 py-1.5 text-slate-600 font-mono font-medium">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="{{ route('admin.billing', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                    Next &rarr;
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- ========================================================================= -->
    <!-- SLIDE-OVER DRAWER: INVOICE DETAILS & PAYMENT RECONCILIATION AUDIT         -->
    <!-- ========================================================================= -->
    <div id="invoiceDrawer" 
         class="fixed inset-0 z-50 overflow-hidden hidden" 
         aria-labelledby="drawer-title" 
         role="dialog" 
         aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
             onclick="closeInvoiceDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-2xl bg-white shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 flex items-start justify-between bg-slate-50/70">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="drawer-invoice-num" class="text-base font-bold text-slate-900 font-mono">
                                INV-2026-10-0042
                            </span>
                            <span id="drawer-status-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Paid
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1" id="drawer-recipient-company">
                            PT Parkir Cipta Nusantara
                        </p>
                    </div>

                    <button type="button" 
                            onclick="closeInvoiceDrawer()"
                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200/60">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 text-xs">
                    
                    <!-- Top Financial Banner -->
                    <div class="p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100 space-y-3">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <div>
                                <span class="text-slate-500 text-[11px]">Total Invoiced</span>
                                <div id="drawer-total-amount" class="text-lg font-extrabold text-indigo-950 font-mono">Rp 0</div>
                            </div>
                            <div>
                                <span class="text-slate-500 text-[11px]">Outstanding Balance</span>
                                <div id="drawer-outstanding" class="text-lg font-extrabold text-rose-600 font-mono">Rp 0</div>
                            </div>
                            <div>
                                <span class="text-slate-500 text-[11px]">Payment Due Date</span>
                                <div id="drawer-due-date" class="text-sm font-bold text-slate-800 font-mono mt-0.5">-</div>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-indigo-100/70 flex items-center justify-between text-[11px] text-slate-600">
                            <span>Billing Cycle: <strong id="drawer-billing-period" class="font-mono">-</strong></span>
                            <span>Payment Status: <strong id="drawer-payment-status" class="uppercase font-mono text-emerald-700">Settled</strong></span>
                        </div>
                    </div>

                    <!-- Issuer vs Recipient Dual Card -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Issuer -->
                        <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 space-y-1.5">
                            <div class="font-bold text-[10px] uppercase tracking-wider text-slate-400">Issuer / Creditor</div>
                            <div class="font-bold text-slate-800" id="drawer-issuer-name">PT Nusa Solusi Parkir</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-issuer-tax">NPWP: 01.234.567.8-012.000</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-issuer-address">Gedung Cyber 2 Lt. 21, Jakarta Selatan</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-issuer-email">billing-platform@nusapark.id</div>
                        </div>

                        <!-- Recipient -->
                        <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 space-y-1.5">
                            <div class="font-bold text-[10px] uppercase tracking-wider text-slate-400">Recipient / Debtor</div>
                            <div class="font-bold text-slate-800" id="drawer-recipient-name">-</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-recipient-npwp">NPWP: -</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-recipient-address">-</div>
                            <div class="text-slate-500 text-[11px]" id="drawer-recipient-email">-</div>
                        </div>
                    </div>

                    <!-- Itemized Line Items Table -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-2">
                            Subscription Line Items
                        </h4>
                        <div class="rounded-xl border border-slate-200 overflow-hidden">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="bg-slate-50 text-[10px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                                        <th class="py-2.5 px-3">Description</th>
                                        <th class="py-2.5 px-2 text-center">Qty</th>
                                        <th class="py-2.5 px-3 text-right">Unit Price</th>
                                        <th class="py-2.5 px-3 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="drawer-line-items" class="divide-y divide-slate-100">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Commercial Breakdown Summary -->
                        <div class="mt-3 p-3.5 rounded-xl bg-slate-50/80 border border-slate-200 space-y-1.5 text-xs max-w-xs ml-auto">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal:</span>
                                <strong id="drawer-subtotal" class="font-mono">Rp 0</strong>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span>PPN (11% Tax):</span>
                                <strong id="drawer-tax" class="font-mono">Rp 0</strong>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Discount / Credit:</span>
                                <strong id="drawer-discount" class="font-mono text-emerald-600">Rp 0</strong>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-slate-200 text-sm font-extrabold text-slate-900">
                                <span>Total Invoiced:</span>
                                <span id="drawer-calc-total" class="font-mono">Rp 0</span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-emerald-700">
                                <span>Amount Paid:</span>
                                <strong id="drawer-calc-paid" class="font-mono">Rp 0</strong>
                            </div>
                            <div class="flex items-center justify-between text-xs text-rose-700 font-bold pt-1 border-t border-slate-200">
                                <span>Balance Remaining:</span>
                                <strong id="drawer-calc-balance" class="font-mono">Rp 0</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Attempts & Provider Records -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-2">
                            Gateway Payment Attempts & Reconciliations
                        </h4>
                        <div id="drawer-payment-attempts" class="space-y-2">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                    <!-- Audit Timeline Feed -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-2">
                            Billing Audit Trail & Lifecycle History
                        </h4>
                        <div id="drawer-timeline" class="space-y-3 relative pl-4 border-l-2 border-slate-200">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between gap-2 flex-wrap">
                    <button type="button" 
                            id="drawer-btn-remind"
                            class="px-3 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-xs transition-colors">
                        Send Reminder
                    </button>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                id="drawer-btn-void"
                                class="px-3 py-2 rounded-xl border border-rose-300 hover:bg-rose-50 text-rose-700 font-bold text-xs transition-colors">
                            Void Invoice
                        </button>
                        <button type="button" 
                                id="drawer-btn-reconcile"
                                class="px-3.5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors shadow-xs">
                            Record Payment / Reconcile
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 1: RECONCILE / CONFIRM PAYMENT RECEIPT                              -->
    <!-- ========================================================================= -->
    <div id="reconcilePaymentModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="recon-modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeReconcileModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 id="recon-modal-title" class="text-base font-bold text-slate-900">
                                Reconcile Subscription Payment
                            </h3>
                            <p class="text-xs text-slate-500" id="recon-modal-inv-num">
                                Invoice Settlement
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeReconcileModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="reconcilePaymentForm" method="POST" action="">
                    @csrf
                    <div class="space-y-4 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Debtor Tenant:</span>
                                <strong id="recon-modal-tenant-name" class="text-slate-800">-</strong>
                            </div>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-slate-500">Amount to Settle:</span>
                                <strong id="recon-modal-amount" class="text-emerald-700 font-mono text-sm">Rp 0</strong>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Settlement Method *</label>
                            <select name="payment_method" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs">
                                <option value="Bank BCA Corporate Virtual Account (Reconciled)">Bank BCA Corporate Virtual Account (H2H)</option>
                                <option value="Bank Mandiri Corporate Virtual Account (Reconciled)">Bank Mandiri Corporate Virtual Account</option>
                                <option value="Direct Corporate Bank Transfer (Verified)">Direct Corporate Bank Transfer (Verified Statement)</option>
                                <option value="Corporate Direct Debit / Auto-Collection">Corporate Direct Debit / Auto-Collection</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Bank Settlement Reference / Ref Code *</label>
                            <input type="text" 
                                   name="payment_reference" 
                                   id="recon-input-ref"
                                   required 
                                   placeholder="e.g., RECON-20261024-9901"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Administrative Reconciliation Note</label>
                            <textarea name="notes" 
                                      rows="2" 
                                      placeholder="e.g., Cleared via manual corporate bank statement check..."
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeReconcileModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-colors shadow-xs shadow-emerald-600/20">
                            Confirm Reconciliation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 2: VOID INVOICE                                                     -->
    <!-- ========================================================================= -->
    <div id="voidInvoiceModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="void-modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeVoidModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                        </div>
                        <div>
                            <h3 id="void-modal-title" class="text-base font-bold text-slate-900">
                                Void Subscription Invoice
                            </h3>
                            <p class="text-xs text-slate-500" id="void-modal-inv-num">
                                Compliance Cancellation
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeVoidModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="voidInvoiceForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4 text-xs">
                        <p class="text-slate-600">
                            Voiding this invoice will cancel the outstanding receivable balance and mark the document as invalid for accounting.
                        </p>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Reason for Voiding *</label>
                            <textarea name="reason" 
                                      rows="3" 
                                      required
                                      placeholder="State reason (e.g. Duplicated billing cycle, Contract adjustment, Reissued under new entity)..."
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeVoidModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs transition-colors shadow-xs shadow-rose-600/20">
                            Confirm Void Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 3: SEND BILLING REMINDER                                            -->
    <!-- ========================================================================= -->
    <div id="reminderModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="reminder-modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeReminderModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <div>
                            <h3 id="reminder-modal-title" class="text-base font-bold text-slate-900">
                                Dispatch Payment Reminder
                            </h3>
                            <p class="text-xs text-slate-500" id="reminder-modal-inv-num">
                                Email Notification
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeReminderModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="reminderForm" method="POST" action="">
                    @csrf
                    <div class="space-y-4 text-xs">
                        <p class="text-slate-600">
                            Send payment reminder with Virtual Account payment link to: <strong id="reminder-modal-email" class="text-slate-800 font-mono">finance@tenant.co.id</strong>
                        </p>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Custom Operational Memo (Optional)</label>
                            <input type="text" 
                                   name="memo" 
                                   placeholder="e.g., Friendly reminder regarding upcoming billing cycle due date..."
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs">
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeReminderModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs transition-colors shadow-xs shadow-amber-600/20">
                            Dispatch Notice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Drawer & Modal Controller
        function openInvoiceDrawer(invoiceId) {
            const drawer = document.getElementById('invoiceDrawer');
            if (!drawer) return;

            drawer.classList.remove('hidden');

            fetch(`/api/admin/billing/invoices/${invoiceId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success || !data.invoice) return;
                    const inv = data.invoice;

                    document.getElementById('drawer-invoice-num').textContent = inv.invoice_number;
                    document.getElementById('drawer-status-badge').textContent = inv.status_label;
                    document.getElementById('drawer-recipient-company').textContent = `${inv.vendor_name} (${inv.brand_name})`;

                    document.getElementById('drawer-total-amount').textContent = 'Rp ' + Number(inv.total_amount).toLocaleString('id-ID');
                    document.getElementById('drawer-outstanding').textContent = 'Rp ' + Number(inv.outstanding_balance).toLocaleString('id-ID');
                    document.getElementById('drawer-due-date').textContent = inv.due_date;
                    document.getElementById('drawer-billing-period').textContent = inv.billing_period;
                    document.getElementById('drawer-payment-status').textContent = (inv.payment_status || 'none').toUpperCase();

                    // Issuer & Recipient
                    document.getElementById('drawer-issuer-name').textContent = inv.issuer.name;
                    document.getElementById('drawer-issuer-tax').textContent = `NPWP: ${inv.issuer.tax_id}`;
                    document.getElementById('drawer-issuer-address').textContent = inv.issuer.address;
                    document.getElementById('drawer-issuer-email').textContent = inv.issuer.billing_email;

                    document.getElementById('drawer-recipient-name').textContent = inv.recipient.company_name;
                    document.getElementById('drawer-recipient-npwp').textContent = `NPWP: ${inv.recipient.npwp || '-'}`;
                    document.getElementById('drawer-recipient-address').textContent = `${inv.recipient.address || ''}, ${inv.recipient.city || ''}`;
                    document.getElementById('drawer-recipient-email').textContent = inv.recipient.billing_email || '-';

                    // Line Items
                    const tbody = document.getElementById('drawer-line-items');
                    tbody.innerHTML = '';
                    (inv.line_items || []).forEach(li => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="py-2.5 px-3">
                                <div class="font-bold text-slate-800">${li.name}</div>
                                <div class="text-[10px] text-slate-500 mt-0.5">${li.description}</div>
                            </td>
                            <td class="py-2.5 px-2 text-center font-mono">${li.quantity}</td>
                            <td class="py-2.5 px-3 text-right font-mono">Rp ${Number(li.unit_price).toLocaleString('id-ID')}</td>
                            <td class="py-2.5 px-3 text-right font-mono font-bold">Rp ${Number(li.total).toLocaleString('id-ID')}</td>
                        `;
                        tbody.appendChild(tr);
                    });

                    // Summary Calculations
                    document.getElementById('drawer-subtotal').textContent = 'Rp ' + Number(inv.subtotal).toLocaleString('id-ID');
                    document.getElementById('drawer-tax').textContent = 'Rp ' + Number(inv.tax_amount).toLocaleString('id-ID');
                    document.getElementById('drawer-discount').textContent = 'Rp ' + Number(inv.discount_amount).toLocaleString('id-ID');
                    document.getElementById('drawer-calc-total').textContent = 'Rp ' + Number(inv.total_amount).toLocaleString('id-ID');
                    document.getElementById('drawer-calc-paid').textContent = 'Rp ' + Number(inv.amount_paid).toLocaleString('id-ID');
                    document.getElementById('drawer-calc-balance').textContent = 'Rp ' + Number(inv.outstanding_balance).toLocaleString('id-ID');

                    // Payment Attempts
                    const payContainer = document.getElementById('drawer-payment-attempts');
                    payContainer.innerHTML = '';
                    if (inv.payments_history && inv.payments_history.length > 0) {
                        inv.payments_history.forEach(pa => {
                            const d = document.createElement('div');
                            d.className = 'p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between';
                            d.innerHTML = `
                                <div>
                                    <div class="font-mono font-bold text-slate-800">${pa.reference}</div>
                                    <div class="text-[11px] text-slate-500">${pa.method} • <span class="font-mono">${pa.timestamp}</span></div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold uppercase font-mono ${pa.status === 'settled' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${pa.status}</span>
                                    <div class="font-mono font-bold text-slate-900 mt-0.5">Rp ${Number(pa.amount).toLocaleString('id-ID')}</div>
                                </div>
                            `;
                            payContainer.appendChild(d);
                        });
                    } else {
                        payContainer.innerHTML = `<div class="text-slate-400 italic text-[11px] py-1">No payment transactions recorded for this invoice yet.</div>`;
                    }

                    // Timeline
                    const tlContainer = document.getElementById('drawer-timeline');
                    tlContainer.innerHTML = '';
                    (inv.timeline || []).forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full ${item.status === 'success' ? 'bg-emerald-500' : (item.status === 'warning' ? 'bg-amber-500' : 'bg-indigo-500')} ring-4 ring-white"></span>
                            <div class="font-bold text-slate-800 text-[11px]">${item.event}</div>
                            <div class="text-[10px] text-slate-400 font-mono">${item.time}</div>
                            <div class="text-slate-600 mt-0.5 text-[11px]">${item.details}</div>
                        `;
                        tlContainer.appendChild(div);
                    });

                    // Footer actions
                    const btnReconcile = document.getElementById('drawer-btn-reconcile');
                    const btnVoid = document.getElementById('drawer-btn-void');
                    const btnRemind = document.getElementById('drawer-btn-remind');

                    if (inv.status === 'paid' || inv.status === 'void') {
                        btnReconcile.style.display = 'none';
                        btnVoid.style.display = 'none';
                        btnRemind.style.display = 'none';
                    } else {
                        btnReconcile.style.display = 'inline-flex';
                        btnVoid.style.display = 'inline-flex';
                        btnRemind.style.display = 'inline-flex';

                        btnReconcile.onclick = () => {
                            closeInvoiceDrawer();
                            openReconcileModal(inv.id, inv.invoice_number, inv.vendor_name, inv.outstanding_balance);
                        };
                        btnVoid.onclick = () => {
                            closeInvoiceDrawer();
                            openVoidModal(inv.id, inv.invoice_number, inv.vendor_name);
                        };
                        btnRemind.onclick = () => {
                            closeInvoiceDrawer();
                            openReminderModal(inv.id, inv.invoice_number, inv.recipient.billing_email);
                        };
                    }
                })
                .catch(err => console.error("Could not fetch invoice detail:", err));
        }

        function closeInvoiceDrawer() {
            const drawer = document.getElementById('invoiceDrawer');
            if (drawer) drawer.classList.add('hidden');
        }

        function openReconcileModal(invId, invNumber, vendorName, outstandingBalance) {
            const modal = document.getElementById('reconcilePaymentModal');
            if (!modal) return;

            document.getElementById('reconcilePaymentForm').action = `/admin/billing/invoices/${invId}/reconcile`;
            document.getElementById('recon-modal-inv-num').textContent = `Reconciling ${invNumber}`;
            document.getElementById('recon-modal-tenant-name').textContent = vendorName;
            document.getElementById('recon-modal-amount').textContent = 'Rp ' + Number(outstandingBalance).toLocaleString('id-ID');
            document.getElementById('recon-input-ref').value = `RECON-${new Date().toISOString().slice(0,10).replace(/-/g,'')}-${Math.floor(100+Math.random()*900)}`;

            modal.classList.remove('hidden');
        }

        function closeReconcileModal() {
            const modal = document.getElementById('reconcilePaymentModal');
            if (modal) modal.classList.add('hidden');
        }

        function openVoidModal(invId, invNumber, vendorName) {
            const modal = document.getElementById('voidInvoiceModal');
            if (!modal) return;

            document.getElementById('voidInvoiceForm').action = `/admin/billing/invoices/${invId}/void`;
            document.getElementById('void-modal-inv-num').textContent = `Voiding ${invNumber} (${vendorName})`;

            modal.classList.remove('hidden');
        }

        function closeVoidModal() {
            const modal = document.getElementById('voidInvoiceModal');
            if (modal) modal.classList.add('hidden');
        }

        function openReminderModal(invId, invNumber, email) {
            const modal = document.getElementById('reminderModal');
            if (!modal) return;

            document.getElementById('reminderForm').action = `/admin/billing/invoices/${invId}/remind`;
            document.getElementById('reminder-modal-inv-num').textContent = `Invoice ${invNumber}`;
            document.getElementById('reminder-modal-email').textContent = email;

            modal.classList.remove('hidden');
        }

        function closeReminderModal() {
            const modal = document.getElementById('reminderModal');
            if (modal) modal.classList.add('hidden');
        }

        // Close Modals & Drawer on Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeInvoiceDrawer();
                closeReconcileModal();
                closeVoidModal();
                closeReminderModal();
            }
        });

        // Auto-open drawer if requested by query parameter (e.g. ?detail=inv-2026-10-0042)
        @if(!empty($selectedInvoice))
        document.addEventListener('DOMContentLoaded', function() {
            openInvoiceDrawer('{{ $selectedInvoice['id'] }}');
        });
        @endif
    </script>
    @endpush

</x-layouts.admin>
