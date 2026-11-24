<x-layouts.admin activeNav="transactions" title="Transaction Monitoring — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Financial Operation Completed</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Transaction Exception</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- Dynamic In-Page Gateway Verification Feedback Toast (AJAX) -->
    <div id="verifyToast" class="fixed bottom-6 right-6 z-50 max-w-md hidden transition-all duration-300">
        <div id="verifyToastContent" class="p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white">
            <div id="verifyToastIcon" class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0"></div>
            <div class="flex-1 pr-2">
                <p id="verifyToastTitle" class="text-xs font-bold uppercase tracking-wider"></p>
                <p id="verifyToastMessage" class="text-xs mt-0.5 text-slate-600 leading-relaxed font-mono"></p>
            </div>
            <button type="button" onclick="hideVerifyToast()" class="text-slate-400 hover:text-slate-600 p-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
    </div>

    <!-- ================= PAGE HEADER ================= -->
    <div class="space-y-4 mb-6">
        
        <!-- Breadcrumbs & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-medium text-slate-400">Financial Operations</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">Transaction Monitoring</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>National PG Settlement Ledger Active</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Ledger Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Transaction Monitoring
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-xs font-mono">
                        {{ $pagination['total'] }} {{ Str::plural('record', $pagination['total']) }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    Platform-wide payment transaction oversight, gateway processing outcomes, settlement reconciliations, and refund traceability across all registered tenant parking facilities.
                </p>
            </div>

            <!-- Header Action Controls -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.transactions.export', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                </a>

                <a href="{{ route('admin.transactions', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"></path><path d="M1 20v-6h6"></path><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                    <span>Refresh Ledger</span>
                </a>
            </div>

        </div>

    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 mb-6">
        
        <!-- Metric 1: Total Gross Volume -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Transaction Value</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-xl sm:text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $summary['formatted_gross_volume'] }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-slate-800 font-mono">{{ number_format($summary['total_transactions_count']) }}</strong> transactions recorded
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
            </div>
        </div>

        <!-- Metric 2: Successful Payments -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Successful Captured</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-xl sm:text-2xl font-black text-emerald-700 font-mono tracking-tight">{{ $summary['formatted_success_volume'] }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-emerald-700">{{ $summary['successful_count'] }}</strong> paid · <strong class="text-emerald-700">{{ $summary['success_rate'] }}%</strong> success rate
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
        </div>

        <!-- Metric 3: Pending & In-Flight -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Pending & Clearing</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-xl sm:text-2xl font-black text-amber-700 font-mono tracking-tight">{{ $summary['formatted_pending_volume'] }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-amber-700 font-mono">{{ $summary['pending_count'] }}</strong> in-flight or audit hold
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
        </div>

        <!-- Metric 4: Failed & Expired -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-rose-600">Failed & Expired</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-xl sm:text-2xl font-black text-rose-700 font-mono tracking-tight">{{ $summary['formatted_failed_volume'] }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-rose-700 font-mono">{{ $summary['failed_count'] }}</strong> rejected or QR timeouts
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            </div>
        </div>

        <!-- Metric 5: Refunds & Net Settled -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-purple-600">Refunded & Reversals</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-xl sm:text-2xl font-black text-purple-700 font-mono tracking-tight">{{ $summary['formatted_refunded_volume'] }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Net: <strong class="text-slate-800 font-mono">{{ $summary['formatted_net_settled_volume'] }}</strong>
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
            </div>
        </div>

    </div>

    <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.transactions') }}" class="space-y-3">
            
            <!-- Date Preset Quick Filters -->
            <div class="flex flex-wrap items-center gap-1.5 pb-2 border-b border-slate-100 text-xs">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mr-1.5">Period:</span>
                @foreach($datePresets as $pKey => $pLabel)
                    <a href="{{ request()->fullUrlWithQuery(['period' => $pKey, 'date_from' => null, 'date_to' => null, 'page' => 1]) }}"
                       class="px-2.5 py-1 rounded-xl font-medium transition-colors {{ $filters['period'] === $pKey && empty($filters['date_from']) ? 'bg-indigo-600 text-white font-bold shadow-2xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        {{ $pLabel }}
                    </a>
                @endforeach
            </div>

            <!-- Primary Filter Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 pt-1">
                
                <!-- Text Search -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Search Ledger</label>
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="TRX reference, PG ref, plate, session..."
                               class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <span class="absolute left-3 top-2.5 text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </div>
                </div>

                <!-- Payment Status Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Payment Status</label>
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($statuses as $sKey => $sLabel)
                            <option value="{{ $sKey }}" {{ $filters['status'] === $sKey ? 'selected' : '' }}>
                                {{ $sLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Payment Method Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Payment Method</label>
                    <select name="payment_method" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($methods as $mKey => $mLabel)
                            <option value="{{ $mKey }}" {{ $filters['payment_method'] === $mKey ? 'selected' : '' }}>
                                {{ $mLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tenant Operator Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Tenant Operator</label>
                    <select name="vendor" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Tenants ({{ count($tenants) }})</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                                {{ $t['company_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Parking Facility Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Parking Facility</label>
                    <select name="location" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Facilities ({{ count($locations) }})</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc['id'] }}" {{ $filters['location'] === $loc['id'] ? 'selected' : '' }}>
                                {{ $loc['name'] }} ({{ $loc['city'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Advanced Filter Row: Provider, Settlement, Payable Type, Custom Date, Sorting -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 pt-2 border-t border-slate-100">
                
                <!-- Gateway Provider -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Gateway Provider</label>
                    <select name="provider" onchange="this.form.submit()" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($providers as $prKey => $prLabel)
                            <option value="{{ $prKey }}" {{ $filters['provider'] === $prKey ? 'selected' : '' }}>
                                {{ $prLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Settlement Status -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Settlement State</label>
                    <select name="settlement" onchange="this.form.submit()" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($settlementStatuses as $stKey => $stLabel)
                            <option value="{{ $stKey }}" {{ $filters['settlement'] === $stKey ? 'selected' : '' }}>
                                {{ $stLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Payable Type -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Payable Type</label>
                    <select name="payable_type" onchange="this.form.submit()" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($payableTypes as $ptKey => $ptLabel)
                            <option value="{{ $ptKey }}" {{ $filters['payable_type'] === $ptKey ? 'selected' : '' }}>
                                {{ $ptLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Custom Date Range -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Custom Date Range</label>
                    <div class="flex items-center gap-1.5">
                        <input type="date" 
                               name="date_from" 
                               value="{{ $filters['date_from'] }}" 
                               class="w-1/2 px-2 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <span class="text-slate-400 text-xs">to</span>
                        <input type="date" 
                               name="date_to" 
                               value="{{ $filters['date_to'] }}" 
                               class="w-1/2 px-2 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <!-- Sort & Controls -->
                <div class="lg:col-span-3 flex items-end justify-between gap-2">
                    <div class="flex-1">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Sort Order</label>
                        <select name="sort" onchange="this.form.submit()" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Newest Timestamp First</option>
                            <option value="date_asc" {{ $filters['sort'] === 'date_asc' ? 'selected' : '' }}>Oldest Timestamp First</option>
                            <option value="amount_desc" {{ $filters['sort'] === 'amount_desc' ? 'selected' : '' }}>Highest Amount (Rp)</option>
                            <option value="amount_asc" {{ $filters['sort'] === 'amount_asc' ? 'selected' : '' }}>Lowest Amount (Rp)</option>
                            <option value="status" {{ $filters['sort'] === 'status' ? 'selected' : '' }}>Status Classification</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-1.5 shrink-0">
                        @if($filters['q'] || $filters['period'] !== 'today' || $filters['date_from'] || $filters['date_to'] || $filters['status'] !== 'all' || $filters['payment_method'] !== 'all' || $filters['vendor'] !== 'all' || $filters['location'] !== 'all' || $filters['provider'] !== 'all' || $filters['settlement'] !== 'all' || $filters['payable_type'] !== 'all')
                            <a href="{{ route('admin.transactions') }}" class="px-2.5 py-1.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition-colors">
                                Reset
                            </a>
                        @endif

                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-colors">
                            Apply
                        </button>
                    </div>
                </div>

            </div>

        </form>
    </div>

    <!-- ================= TRANSACTION INVENTORY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <!-- Table Top Meta Header -->
        <div class="px-5 py-3.5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-800">Platform Payment Ledger</span>
                <span class="text-slate-400">·</span>
                <span class="text-slate-500">Showing <strong class="text-slate-700">{{ $pagination['from'] }}-{{ $pagination['to'] }}</strong> of <strong class="text-slate-700">{{ $pagination['total'] }}</strong> records</span>
            </div>
            
            <div class="flex items-center gap-3 text-[11px] text-slate-500 font-mono">
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Captured</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> In Flight</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Failed</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Refunded</span>
            </div>
        </div>

        @if(count($transactions) > 0)
        <!-- Desktop Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">Transaction Reference</th>
                        <th class="py-3 px-4">Payable & Vehicle</th>
                        <th class="py-3 px-4">Facility & Tenant</th>
                        <th class="py-3 px-4">Payment Method & Gateway</th>
                        <th class="py-3 px-4 text-right">Amount (IDR)</th>
                        <th class="py-3 px-4">Payment Status</th>
                        <th class="py-3 px-4">Settlement State</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($transactions as $t)
                    <tr class="hover:bg-slate-50/70 transition-colors group {{ $t['transaction_status'] === 'failed' ? 'bg-rose-50/15' : ($t['transaction_status'] === 'refunded' ? 'bg-purple-50/15' : '') }}">
                        
                        <!-- Col 1: Reference & Timestamps -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-start gap-2">
                                <button type="button" 
                                        onclick="openTransactionDetail('{{ $t['id'] }}')" 
                                        class="font-mono font-bold text-slate-900 hover:text-indigo-600 transition-colors text-xs text-left">
                                    {{ $t['transaction_reference'] }}
                                </button>
                            </div>
                            <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                                {{ $t['created_at'] }}
                            </div>
                            @if(!empty($t['provider_reference']))
                                <div class="text-[9px] text-slate-400 font-mono mt-0.5 truncate max-w-[150px]" title="{{ $t['provider_reference'] }}">
                                    PG: {{ $t['provider_reference'] }}
                                </div>
                            @endif
                        </td>

                        <!-- Col 2: Payable & Vehicle -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider font-mono {{ $t['payable_type'] === 'session' ? 'bg-blue-50 text-blue-700 border border-blue-200' : ($t['payable_type'] === 'reservation' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-amber-50 text-amber-700 border border-amber-200') }}">
                                    {{ $t['payable_type_label'] }}
                                </span>
                            </div>
                            <div class="text-[11px] font-mono text-slate-700 font-semibold mt-1">
                                {{ $t['payable_reference'] }}
                            </div>
                            @if(!empty($t['vehicle_plate']) && $t['vehicle_plate'] !== '-')
                                <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                                    {{ $t['vehicle_plate'] }} · {{ $t['vehicle_model'] }}
                                </div>
                            @endif
                        </td>

                        <!-- Col 3: Facility & Tenant -->
                        <td class="py-3.5 px-4">
                            <div>
                                <a href="/admin/locations?q={{ urlencode($t['facility_name']) }}" 
                                   class="font-semibold text-slate-900 hover:text-indigo-600 transition-colors line-clamp-1"
                                   title="Inspect {{ $t['facility_name'] }} in Location Management">
                                    {{ $t['facility_name'] }}
                                </a>
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-500 mt-0.5">
                                    <span class="font-medium">{{ $t['location_city'] }}</span>
                                    <span>•</span>
                                    <a href="/admin/tenants?q={{ urlencode($t['vendor_name']) }}" 
                                       class="text-slate-500 hover:text-slate-800 truncate max-w-[130px]" 
                                       title="{{ $t['vendor_name'] }}">
                                        {{ $t['vendor_name'] }}
                                    </a>
                                </div>
                                <div class="text-[9px] text-slate-400 font-mono mt-0.5">
                                    Lane: {{ $t['terminal_lane'] }}
                                </div>
                            </div>
                        </td>

                        <!-- Col 4: Payment Method & Gateway -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5 font-semibold text-slate-800 text-xs">
                                @if($t['payment_method'] === 'qris')
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-rose-600"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                @elseif($t['payment_method'] === 'ewallet')
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="M7 15h0M2 9.5h20"></path></svg>
                                @elseif($t['payment_method'] === 'nfc_card')
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-600"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                @elseif($t['payment_method'] === 'credit_card')
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-indigo-600"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                @else
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                @endif
                                <span>{{ $t['payment_method_label'] }}</span>
                            </div>
                            <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                                {{ $t['gateway_provider_label'] }} · {{ $t['gateway_acquirer'] }}
                            </div>
                        </td>

                        <!-- Col 5: Amount (IDR) -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="font-mono font-bold text-slate-900 text-sm">
                                {{ $t['formatted_amount'] }}
                            </div>
                            @if(($t['refunded_amount'] ?? 0) > 0)
                                <div class="text-[10px] font-mono text-purple-700 font-semibold mt-0.5">
                                    Ref: -{{ $t['formatted_refunded_amount'] }}
                                </div>
                            @else
                                <div class="text-[10px] font-mono text-slate-400 mt-0.5">
                                    Fee: Rp {{ number_format($t['platform_fee'] ?? 0, 0, ',', '.') }} (3.5%)
                                </div>
                            @endif
                        </td>

                        <!-- Col 6: Payment Status -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($t['transaction_status'] === 'successful')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Successful</span>
                                </span>
                            @elseif($t['transaction_status'] === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-amber-50 text-amber-800 border border-amber-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>Pending</span>
                                </span>
                            @elseif($t['transaction_status'] === 'failed')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-rose-50 text-rose-800 border border-rose-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Failed</span>
                                </span>
                            @elseif($t['transaction_status'] === 'refunded')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-purple-50 text-purple-800 border border-purple-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                    <span>Refunded</span>
                                </span>
                            @elseif($t['transaction_status'] === 'partially_refunded')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-purple-50 text-purple-800 border border-purple-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                    <span>Part Refund</span>
                                </span>
                            @elseif($t['transaction_status'] === 'expired')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-slate-100 text-slate-700 border border-slate-200 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>Expired</span>
                                </span>
                            @endif
                        </td>

                        <!-- Col 7: Settlement State -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($t['settlement_status'] === 'settled')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold font-mono">
                                    Settled T+1
                                </span>
                            @elseif($t['settlement_status'] === 'pending_settlement')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-100 text-amber-900 text-[10px] font-bold font-mono">
                                    In Clearing
                                </span>
                            @elseif($t['settlement_status'] === 'on_hold')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-100 text-rose-900 text-[10px] font-bold font-mono">
                                    Audit Hold
                                </span>
                            @elseif($t['settlement_status'] === 'refunded')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-purple-100 text-purple-900 text-[10px] font-bold font-mono">
                                    Reversed
                                </span>
                            @endif

                            @if(!empty($t['settlement_batch_ref']) && $t['settlement_batch_ref'] !== '-')
                                <div class="text-[9px] text-slate-400 font-mono mt-0.5">
                                    {{ $t['settlement_batch_ref'] }}
                                </div>
                            @endif
                        </td>

                        <!-- Col 8: Actions -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Inspect Button -->
                                <button type="button" 
                                        onclick="openTransactionDetail('{{ $t['id'] }}')"
                                        title="Inspect transaction financial details & audit timeline"
                                        class="px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition-colors flex items-center gap-1">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span>Inspect</span>
                                </button>

                                <!-- Verify Gateway Button -->
                                <button type="button" 
                                        onclick="triggerGatewayVerify('{{ $t['id'] }}', '{{ $t['transaction_reference'] }}', this)"
                                        title="Re-verify status with payment gateway API"
                                        class="p-1.5 rounded-xl border border-indigo-200 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path></svg>
                                </button>

                                <!-- Settlement State Override Button -->
                                <button type="button" 
                                        onclick="openSettlementModal('{{ $t['id'] }}', '{{ $t['transaction_reference'] }}', '{{ $t['settlement_status'] }}')"
                                        title="Manage settlement reconciliation state"
                                        class="p-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card List View -->
        <div class="sm:hidden divide-y divide-slate-100 p-3 space-y-3">
            @foreach($transactions as $t)
            <div class="bg-slate-50/70 p-3.5 rounded-xl border border-slate-200/80 space-y-2.5">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <span class="font-mono font-bold text-slate-900 text-xs">{{ $t['transaction_reference'] }}</span>
                        <p class="text-[10px] text-slate-500 font-mono mt-0.5">{{ $t['created_at'] }}</p>
                    </div>

                    <div class="text-right">
                        <span class="font-mono font-black text-slate-900 text-sm">{{ $t['formatted_amount'] }}</span>
                        <div class="mt-0.5">
                            @if($t['transaction_status'] === 'successful')
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Successful</span>
                            @elseif($t['transaction_status'] === 'pending')
                                <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">Pending</span>
                            @elseif($t['transaction_status'] === 'failed')
                                <span class="px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">Failed</span>
                            @elseif($t['transaction_status'] === 'refunded')
                                <span class="px-2 py-0.5 rounded-full bg-purple-100 text-purple-800 text-[10px] font-bold">Refunded</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-200 text-slate-700 text-[10px] font-bold">{{ ucfirst($t['transaction_status']) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 text-[11px] text-slate-600 font-mono">
                    <div>
                        <span class="text-slate-400 block text-[10px]">Method / PG:</span>
                        <span class="truncate block">{{ $t['payment_method_label'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Settlement:</span>
                        <span class="font-bold text-slate-800">{{ $t['settlement_status_label'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Facility:</span>
                        <span class="truncate block text-slate-800">{{ $t['facility_name'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Payable / Plate:</span>
                        <span>{{ $t['payable_reference'] }} · {{ $t['vehicle_plate'] }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-200">
                    <button type="button" 
                            onclick="openTransactionDetail('{{ $t['id'] }}')"
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 text-xs font-bold">
                        Inspect
                    </button>
                    <button type="button" 
                            onclick="triggerGatewayVerify('{{ $t['id'] }}', '{{ $t['transaction_reference'] }}', this)"
                            class="px-3 py-1.5 rounded-lg bg-indigo-600 text-white text-xs font-bold">
                        Verify PG
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="px-5 py-4 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-slate-50/50">
            <div class="text-slate-500">
                Page <strong class="text-slate-800 font-mono">{{ $pagination['current_page'] }}</strong> of <strong class="text-slate-800 font-mono">{{ $pagination['last_page'] }}</strong>
                ({{ $pagination['total'] }} total records)
            </div>

            <div class="flex items-center gap-1.5 self-end sm:self-auto">
                @if($pagination['current_page'] > 1)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1]) }}"
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                        Previous
                    </a>
                @else
                    <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed">
                        Previous
                    </span>
                @endif

                @for($p = 1; $p <= $pagination['last_page']; $p++)
                    @if($p == $pagination['current_page'])
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center font-mono">
                            {{ $p }}
                        </span>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['page' => $p]) }}"
                           class="w-8 h-8 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold flex items-center justify-center font-mono transition-colors">
                            {{ $p }}
                        </a>
                    @endif
                @endfor

                @if($pagination['current_page'] < $pagination['last_page'])
                    <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1]) }}"
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
        </div>

        @else
        <!-- Empty State -->
        <div class="p-12 text-center">
            <div class="w-14 h-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center mx-auto text-slate-400 mb-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
            </div>
            <h3 class="text-base font-bold text-slate-800">No Transactions Found</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                No payment transaction records matched the active filters for the selected date period. Try clearing filters or adjusting your date range.
            </p>
            <div class="mt-4">
                <a href="{{ route('admin.transactions') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white font-bold text-xs hover:bg-indigo-700 transition-colors">
                    Reset Filter to Today
                </a>
            </div>
        </div>
        @endif

    </div>

    <!-- ================= SLIDE-OVER TRANSACTION DETAIL DRAWER ================= -->
    <div id="transactionDetailDrawer" class="fixed inset-0 z-50 overflow-hidden {{ $selectedTransaction ? '' : 'hidden' }}">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-2xs transition-opacity" 
             onclick="closeTransactionDetail()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-xl bg-white border-l border-slate-200 shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="drawerTrxReference" class="font-mono font-bold text-sm text-slate-900 bg-slate-200/80 px-2 py-0.5 rounded">
                                {{ $selectedTransaction['transaction_reference'] ?? 'TRX-00000000-0000' }}
                            </span>
                            <span id="drawerStatusBadge" class="px-2 py-0.5 rounded text-[11px] font-bold">
                                {{ $selectedTransaction['transaction_status_label'] ?? 'Status' }}
                            </span>
                        </div>
                        <h2 id="drawerAmountTitle" class="text-xl font-black text-slate-900 font-mono mt-1">
                            {{ $selectedTransaction['formatted_amount'] ?? 'Rp 0' }}
                        </h2>
                        <p id="drawerFacilitySubtitle" class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $selectedTransaction['facility_name'] ?? '' }} · {{ $selectedTransaction['terminal_lane'] ?? '' }}
                        </p>
                    </div>

                    <button type="button" 
                            onclick="closeTransactionDetail()" 
                            class="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-200/50 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Scrollable Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 text-xs">
                    
                    <!-- Section 1: Financial & Fee Breakdown -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Financial Fee & Settlement Breakdown
                        </h4>

                        <div class="bg-slate-50 rounded-xl border border-slate-200 p-3.5 space-y-2 font-mono">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-600">Gross Amount (Paid by Customer):</span>
                                <span id="drawerGrossAmount" class="font-bold text-slate-900">
                                    {{ $selectedTransaction['formatted_amount'] ?? 'Rp 0' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-500">
                                <span>Base Parking Tariff:</span>
                                <span id="drawerBaseFee">
                                    Rp {{ number_format($selectedTransaction['base_fee'] ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-500">
                                <span>Payment Gateway Processing Fee:</span>
                                <span id="drawerServiceFee">
                                    Rp {{ number_format($selectedTransaction['service_fee'] ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-indigo-700">
                                <span>NusaPark Platform Commission (3.5%):</span>
                                <span id="drawerPlatformFee">
                                    Rp {{ number_format($selectedTransaction['platform_fee'] ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-xs font-bold text-emerald-800">
                                <span>Net Disbursable to Tenant Operator:</span>
                                <span id="drawerNetOperator">
                                    Rp {{ number_format($selectedTransaction['net_operator_amount'] ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                            @if(($selectedTransaction['refunded_amount'] ?? 0) > 0)
                            <div class="pt-2 border-t border-purple-200 flex items-center justify-between text-xs font-bold text-purple-700 bg-purple-50 p-2 rounded-lg">
                                <span>Reversed / Refunded Amount:</span>
                                <span id="drawerRefundedAmount">
                                    -{{ $selectedTransaction['formatted_refunded_amount'] ?? 'Rp 0' }}
                                </span>
                            </div>
                            <div class="text-[10px] text-purple-800 leading-relaxed font-sans">
                                <strong>Refund Reason:</strong> <span id="drawerRefundReason">{{ $selectedTransaction['refund_reason'] ?? 'Not specified' }}</span>
                                <br>
                                <strong>Refund Ref:</strong> <span id="drawerRefundRef">{{ $selectedTransaction['refund_reference'] ?? '-' }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Section 2: Payment Instrument & Gateway -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Payment Instrument & Gateway Response
                        </h4>

                        <div class="grid grid-cols-2 gap-3 bg-slate-50/70 p-3.5 rounded-xl border border-slate-200/80">
                            <div>
                                <span class="text-slate-400 block text-[10px]">Payment Method:</span>
                                <span id="drawerPaymentMethod" class="font-bold text-slate-800 text-xs">
                                    {{ $selectedTransaction['payment_method_label'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Channel / Instrument:</span>
                                <span id="drawerPaymentChannel" class="font-medium text-slate-800 text-xs">
                                    {{ $selectedTransaction['payment_channel'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Gateway Provider:</span>
                                <span id="drawerProvider" class="font-semibold text-slate-800 text-xs">
                                    {{ $selectedTransaction['gateway_provider_label'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Acquirer / Bank:</span>
                                <span id="drawerAcquirer" class="font-medium text-slate-800 text-xs">
                                    {{ $selectedTransaction['gateway_acquirer'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Provider PG Reference:</span>
                                <span id="drawerProviderRef" class="font-mono font-bold text-slate-800 text-xs truncate block" title="{{ $selectedTransaction['provider_reference'] ?? '' }}">
                                    {{ $selectedTransaction['provider_reference'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Auth Approval Code:</span>
                                <span id="drawerAuthCode" class="font-mono text-slate-700 text-xs">
                                    {{ $selectedTransaction['auth_approval_code'] ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Gateway Response Summary -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-center justify-between text-[11px] mb-1">
                                <span class="font-bold text-slate-700">Gateway Response Payload</span>
                                <span id="drawerHttpCode" class="font-mono font-bold px-1.5 py-0.2 rounded bg-slate-200 text-slate-800">
                                    HTTP {{ $selectedTransaction['gateway_response_code'] ?? '200' }}
                                </span>
                            </div>
                            <p id="drawerGatewayMessage" class="text-slate-600 text-[11px] leading-relaxed">
                                {{ $selectedTransaction['gateway_response_message'] ?? 'Nominal response.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Section 3: Facility & Tenant Placement -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Tenant, Facility & Payable Scope
                        </h4>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Tenant / Operator:</span>
                                <a id="drawerTenantLink" 
                                   href="/admin/tenants?q={{ urlencode($selectedTransaction['vendor_name'] ?? '') }}" 
                                   class="font-semibold text-indigo-600 hover:underline">
                                    {{ $selectedTransaction['vendor_name'] ?? '-' }}
                                </a>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Parking Facility:</span>
                                <a id="drawerLocationLink" 
                                   href="/admin/locations?q={{ urlencode($selectedTransaction['facility_name'] ?? '') }}" 
                                   class="font-semibold text-indigo-600 hover:underline">
                                    {{ $selectedTransaction['facility_name'] ?? '-' }} ({{ $selectedTransaction['location_city'] ?? '' }})
                                </a>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Payable Type / Reference:</span>
                                <span id="drawerPayableRef" class="font-mono font-bold text-slate-800">
                                    {{ $selectedTransaction['payable_type_label'] ?? '' }} · {{ $selectedTransaction['payable_reference'] ?? '' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Vehicle Plate & Model:</span>
                                <span id="drawerVehicle" class="font-mono text-slate-700">
                                    {{ $selectedTransaction['vehicle_plate'] ?? '-' }} · {{ $selectedTransaction['vehicle_model'] ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Payer Masked Profile:</span>
                                <span id="drawerCustomer" class="text-slate-700">
                                    {{ $selectedTransaction['customer_mask'] ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Settlement & Reconciliation -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-1">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                Settlement & Reconciliation Audit
                            </h4>
                            <span id="drawerSettlementBadge" class="font-mono font-bold text-[10px] uppercase text-emerald-700">
                                {{ $selectedTransaction['settlement_status_label'] ?? 'Settled' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-xl border border-slate-200 font-mono">
                            <div>
                                <span class="text-slate-400 block text-[10px]">Settlement Batch ID:</span>
                                <span id="drawerBatchRef" class="font-bold text-slate-800 text-xs">
                                    {{ $selectedTransaction['settlement_batch_ref'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Last Gateway Ledger Sync:</span>
                                <span id="drawerVerifiedAt" class="text-slate-700 text-xs">
                                    {{ $selectedTransaction['verified_at'] ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Timeline -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Transaction Event Audit Trail
                        </h4>

                        <div id="drawerTimelineList" class="space-y-2 font-mono">
                            @if(!empty($selectedTransaction['timeline']))
                                @foreach($selectedTransaction['timeline'] as $item)
                                <div class="p-2.5 rounded-xl border text-xs {{ $item['status'] === 'success' ? 'bg-emerald-50/60 border-emerald-200 text-emerald-950' : ($item['status'] === 'warning' ? 'bg-amber-50/60 border-amber-200 text-amber-950' : ($item['status'] === 'critical' ? 'bg-rose-50/60 border-rose-200 text-rose-950' : 'bg-slate-50 border-slate-200 text-slate-700')) }}">
                                    <div class="flex items-center justify-between text-[10px] mb-0.5">
                                        <span class="font-bold">{{ $item['event'] }}</span>
                                        <span class="text-slate-400">{{ $item['time'] }}</span>
                                    </div>
                                    <p class="leading-relaxed font-sans text-xs text-slate-700">{{ $item['details'] }}</p>
                                </div>
                                @endforeach
                            @else
                                <p class="text-slate-400 text-xs italic">No timeline entries available.</p>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between gap-3 shrink-0">
                    <button type="button" 
                            id="drawerVerifyButton"
                            onclick="triggerDrawerVerify()"
                            class="px-3.5 py-2 rounded-xl bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 text-indigo-700 text-xs font-bold transition-colors flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path></svg>
                        <span>Re-verify Gateway</span>
                    </button>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                onclick="openSettlementFromDrawer()"
                                class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-bold transition-colors">
                            Settlement State
                        </button>
                        <button type="button" 
                                onclick="closeTransactionDetail()"
                                class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-colors">
                            Close
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= SETTLEMENT STATE MODAL ================= -->
    <div id="settlementModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Manage Settlement Lifecycle</h3>
                    <p id="settlementModalSubtitle" class="text-xs text-slate-500 mt-0.5">Override settlement clearing state or release audit hold.</p>
                </div>
                <button type="button" onclick="closeSettlementModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="settlementForm" method="POST" action="" class="my-4 space-y-4 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Target Settlement State *</label>
                    <select id="modalSettlementSelect" name="settlement_status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="settled">Settled (Funds Cleared to Operator)</option>
                        <option value="pending_settlement">In Clearing (Pending T+1 Batch)</option>
                        <option value="on_hold">Audit Hold (Flagged for Risk Investigation)</option>
                        <option value="refunded">Reversed / Refunded</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Reconciliation Audit Note</label>
                    <textarea name="notes" rows="3" placeholder="e.g. Audit dispute resolved with vendor NOC; released from hold for nightly clearing batch." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeSettlementModal()" class="px-4 py-2 border border-slate-200 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-xs">
                        Update Settlement
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= CLIENT JAVASCRIPT ================= -->
    <script>
        let currentActiveTrxId = '{{ $selectedTransaction['id'] ?? '' }}';
        let currentActiveTrxRef = '{{ $selectedTransaction['transaction_reference'] ?? '' }}';

        /**
         * Open slide-over transaction inspection drawer with asynchronous payload fetch.
         */
        function openTransactionDetail(trxId) {
            currentActiveTrxId = trxId;
            const drawer = document.getElementById('transactionDetailDrawer');
            drawer.classList.remove('hidden');

            fetch(`/api/admin/transactions/${trxId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.transaction) {
                        renderTransactionDetail(data.transaction);
                    }
                })
                .catch(err => {
                    console.error('Failed to load transaction details:', err);
                });
        }

        /**
         * Render loaded transaction object into drawer DOM elements.
         */
        function renderTransactionDetail(trx) {
            currentActiveTrxId = trx.id;
            currentActiveTrxRef = trx.transaction_reference;

            document.getElementById('drawerTrxReference').textContent = trx.transaction_reference;
            document.getElementById('drawerAmountTitle').textContent = trx.formatted_amount;
            document.getElementById('drawerFacilitySubtitle').textContent = `${trx.facility_name} · ${trx.terminal_lane}`;

            // Top Status Badge
            const statusBadge = document.getElementById('drawerStatusBadge');
            statusBadge.textContent = trx.transaction_status_label;
            if (trx.transaction_status === 'successful') {
                statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800';
            } else if (trx.transaction_status === 'pending') {
                statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800';
            } else if (trx.transaction_status === 'failed') {
                statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-rose-100 text-rose-800';
            } else if (trx.transaction_status === 'refunded' || trx.transaction_status === 'partially_refunded') {
                statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-purple-100 text-purple-800';
            } else {
                statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-slate-200 text-slate-700';
            }

            // Fee breakdown
            document.getElementById('drawerGrossAmount').textContent = trx.formatted_amount;
            document.getElementById('drawerBaseFee').textContent = `Rp ${Number(trx.base_fee || 0).toLocaleString('id-ID')}`;
            document.getElementById('drawerServiceFee').textContent = `Rp ${Number(trx.service_fee || 0).toLocaleString('id-ID')}`;
            document.getElementById('drawerPlatformFee').textContent = `Rp ${Number(trx.platform_fee || 0).toLocaleString('id-ID')}`;
            document.getElementById('drawerNetOperator').textContent = `Rp ${Number(trx.net_operator_amount || 0).toLocaleString('id-ID')}`;

            // Specs
            document.getElementById('drawerPaymentMethod').textContent = trx.payment_method_label;
            document.getElementById('drawerPaymentChannel').textContent = trx.payment_channel;
            document.getElementById('drawerProvider').textContent = trx.gateway_provider_label;
            document.getElementById('drawerAcquirer').textContent = trx.gateway_acquirer;
            document.getElementById('drawerProviderRef').textContent = trx.provider_reference || '-';
            document.getElementById('drawerAuthCode').textContent = trx.auth_approval_code || '-';

            // Gateway Response
            document.getElementById('drawerHttpCode').textContent = `HTTP ${trx.gateway_response_code || '200'}`;
            document.getElementById('drawerGatewayMessage').textContent = trx.gateway_response_message || 'Nominal execution.';

            // Placement
            document.getElementById('drawerTenantLink').textContent = trx.vendor_name || '-';
            document.getElementById('drawerTenantLink').href = `/admin/tenants?q=${encodeURIComponent(trx.vendor_name || '')}`;
            document.getElementById('drawerLocationLink').textContent = `${trx.facility_name} (${trx.location_city})`;
            document.getElementById('drawerLocationLink').href = `/admin/locations?q=${encodeURIComponent(trx.facility_name || '')}`;
            document.getElementById('drawerPayableRef').textContent = `${trx.payable_type_label} · ${trx.payable_reference}`;
            document.getElementById('drawerVehicle').textContent = `${trx.vehicle_plate || '-'} · ${trx.vehicle_model || '-'}`;
            document.getElementById('drawerCustomer').textContent = trx.customer_mask || '-';

            // Settlement
            document.getElementById('drawerSettlementBadge').textContent = trx.settlement_status_label;
            document.getElementById('drawerBatchRef').textContent = trx.settlement_batch_ref || '-';
            document.getElementById('drawerVerifiedAt').textContent = trx.verified_at || '-';

            // Timeline List
            const list = document.getElementById('drawerTimelineList');
            list.innerHTML = '';
            if (trx.timeline && trx.timeline.length > 0) {
                trx.timeline.forEach(item => {
                    const card = document.createElement('div');
                    card.className = `p-2.5 rounded-xl border text-xs ${item.status === 'success' ? 'bg-emerald-50/60 border-emerald-200 text-emerald-950' : (item.status === 'warning' ? 'bg-amber-50/60 border-amber-200 text-amber-950' : (item.status === 'critical' ? 'bg-rose-50/60 border-rose-200 text-rose-950' : 'bg-slate-50 border-slate-200 text-slate-700'))}`;
                    card.innerHTML = `
                        <div class="flex items-center justify-between text-[10px] mb-0.5">
                            <span class="font-bold">${item.event}</span>
                            <span class="text-slate-400">${item.time}</span>
                        </div>
                        <p class="leading-relaxed font-sans text-xs text-slate-700">${item.details}</p>
                    `;
                    list.appendChild(card);
                });
            } else {
                list.innerHTML = '<p class="text-slate-400 text-xs italic">No timeline entries available.</p>';
            }
        }

        /**
         * Close slide-over transaction inspection drawer.
         */
        function closeTransactionDetail() {
            document.getElementById('transactionDetailDrawer').classList.add('hidden');
        }

        /**
         * Re-verify transaction status with gateway provider API via AJAX.
         */
        function triggerGatewayVerify(trxId, trxRef, btn) {
            const originalHtml = btn ? btn.innerHTML : null;
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<svg class="animate-spin" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>`;
            }

            fetch(`/admin/transactions/${trxId}/verify`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
                showVerifyToast(data.success, data.message);
                if (currentActiveTrxId === trxId && data.transaction) {
                    renderTransactionDetail(data.transaction);
                }
            })
            .catch(err => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
                showVerifyToast(false, `Gateway verification check failed.`);
            });
        }

        function triggerDrawerVerify() {
            if (!currentActiveTrxId) return;
            const btn = document.getElementById('drawerVerifyButton');
            triggerGatewayVerify(currentActiveTrxId, currentActiveTrxRef, btn);
        }

        function showVerifyToast(success, message) {
            const toast = document.getElementById('verifyToast');
            const content = document.getElementById('verifyToastContent');
            const icon = document.getElementById('verifyToastIcon');
            const title = document.getElementById('verifyToastTitle');
            const msg = document.getElementById('verifyToastMessage');

            if (success) {
                content.className = 'p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white border-emerald-200 text-emerald-950';
                icon.className = 'w-8 h-8 rounded-xl flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600 font-bold';
                icon.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
                title.textContent = 'Gateway Verification Acknowledged';
                title.className = 'text-xs font-bold uppercase tracking-wider text-emerald-800';
            } else {
                content.className = 'p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white border-rose-200 text-rose-950';
                icon.className = 'w-8 h-8 rounded-xl flex items-center justify-center shrink-0 bg-rose-100 text-rose-600 font-bold';
                icon.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
                title.textContent = 'Gateway Verification Notice';
                title.className = 'text-xs font-bold uppercase tracking-wider text-rose-800';
            }

            msg.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                hideVerifyToast();
            }, 6000);
        }

        function hideVerifyToast() {
            document.getElementById('verifyToast').classList.add('hidden');
        }

        /**
         * Open settlement state modal.
         */
        function openSettlementModal(trxId, trxRef, settlementStatus) {
            const form = document.getElementById('settlementForm');
            form.action = `/admin/transactions/${trxId}/settlement`;
            document.getElementById('settlementModalSubtitle').textContent = `Transaction: ${trxRef}`;
            document.getElementById('modalSettlementSelect').value = settlementStatus;
            document.getElementById('settlementModal').classList.remove('hidden');
        }

        function openSettlementFromDrawer() {
            if (!currentActiveTrxId) return;
            const currentSettlement = document.getElementById('drawerSettlementBadge').textContent.trim().toLowerCase();
            let statusVal = 'settled';
            if (currentSettlement.includes('clearing')) statusVal = 'pending_settlement';
            else if (currentSettlement.includes('hold')) statusVal = 'on_hold';
            else if (currentSettlement.includes('reversed')) statusVal = 'refunded';

            openSettlementModal(currentActiveTrxId, currentActiveTrxRef, statusVal);
        }

        function closeSettlementModal() {
            document.getElementById('settlementModal').classList.add('hidden');
        }
    </script>

</x-layouts.admin>
