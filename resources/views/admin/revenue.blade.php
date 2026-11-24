<x-layouts.admin activeNav="revenue" title="Revenue Analytics — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Financial Telemetry Synchronized</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Analytics Error</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- ================= PAGE HEADER ================= -->
    <div class="space-y-4 mb-6">
        
        <!-- Breadcrumbs & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-medium text-slate-400">Financial Operations</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">Revenue Analytics</span>
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
                        Revenue Analytics
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-bold text-xs font-mono">
                        {{ $analytics['period_label'] }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    Cross-platform parking revenue analysis, payment rail distribution, tenant yield, and settlement reconciliation across Indonesian smart parking facilities.
                </p>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.revenue.export', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                </a>

                <a href="/admin/transactions" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 text-indigo-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    <span>Transaction Ledger &rarr;</span>
                </a>

                <button type="button" 
                        onclick="window.location.reload()" 
                        class="p-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 hover:text-slate-900 transition-colors"
                        title="Refresh Live Revenue Telemetry"
                        aria-label="Refresh Live Revenue Telemetry">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                </button>
            </div>
        </div>

    </div>

    <!-- ================= CONTEXTUAL DISTINCTION BANNER ================= -->
    <div class="mb-6 p-4 rounded-2xl bg-indigo-50/70 border border-indigo-200 text-indigo-950 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
        <div class="flex items-start sm:items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 text-indigo-700 flex items-center justify-center shrink-0 font-bold">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </div>
            <div>
                <span class="font-bold text-indigo-950">Authoritative Financial Separation:</span>
                <span class="text-indigo-800">
                    Figures below reflect <strong>Gross Customer Parking Receipts</strong> collected at facility gates. NusaPark B2B platform licensing MRR (<strong>{{ $analytics['summary']['formatted_subscription_mrr'] }}</strong>) is strictly separated from parking flow collections in accordance with platform accounting policies.
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-auto shrink-0 font-mono text-[11px] font-bold text-indigo-700">
            <span>Take Rate: 3.5% PG SaaS Commission</span>
        </div>
    </div>

    <!-- ================= GLOBAL FILTER TOOLBAR ================= -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs mb-6 space-y-4">
        
        <form id="revenueFilterForm" method="GET" action="/admin/revenue" class="space-y-4">
            
            <!-- Row 1: Reporting Period Presets & Compare Toggle -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                
                <!-- Quick Period Presets -->
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none text-xs">
                    <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider mr-1">Period:</span>
                    
                    @php
                        $activePeriod = $filters['period'] ?? 'today';
                    @endphp

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => 'today', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === 'today' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        Hari Ini
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => 'yesterday', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === 'yesterday' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        Kemarin
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => '7d', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === '7d' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        7 Hari Terakhir
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => '30d', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === '30d' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        30 Hari
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => 'mtd', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === 'mtd' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        Oktober (MTD)
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => 'prev_month', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === 'prev_month' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        Bulan Lalu
                    </a>

                    <a href="{{ route('admin.revenue', array_merge(request()->query(), ['period' => 'all', 'date_from' => null, 'date_to' => null])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold whitespace-nowrap transition-colors {{ $activePeriod === 'all' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                        Semua Waktu
                    </a>
                </div>

                <!-- Comparison Toggle -->
                <div class="flex items-center gap-3 shrink-0">
                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer select-none">
                        <input type="checkbox" 
                               name="compare" 
                               value="1" 
                               {{ $compare ? 'checked' : '' }} 
                               onchange="document.getElementById('revenueFilterForm').submit()"
                               class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        <span>Compare vs Benchmark ({{ $analytics['previous_period_label'] }})</span>
                    </label>
                </div>
            </div>

            <!-- Row 2: Dimensional Multi-Criteria Selectors -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
                
                <!-- Tenant / Operator Selector -->
                <div>
                    <label for="vendorSelect" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">
                        Tenant Operator
                    </label>
                    <select id="vendorSelect" 
                            name="vendor" 
                            onchange="document.getElementById('revenueFilterForm').submit()"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white text-slate-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
                        <option value="all" {{ ($filters['vendor'] ?? 'all') === 'all' ? 'selected' : '' }}>All Operators ({{ count($tenants) }})</option>
                        @foreach($tenants as $t)
                        <option value="{{ $t['id'] }}" {{ ($filters['vendor'] ?? '') === $t['id'] ? 'selected' : '' }}>
                            {{ $t['company_name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Parking Facility Selector (Cascades) -->
                <div>
                    <label for="locationSelect" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">
                        Parking Facility
                    </label>
                    <select id="locationSelect" 
                            name="location" 
                            onchange="document.getElementById('revenueFilterForm').submit()"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white text-slate-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
                        <option value="all" {{ ($filters['location'] ?? 'all') === 'all' ? 'selected' : '' }}>All Facilities ({{ count($locations) }})</option>
                        @foreach($locations as $loc)
                        <option value="{{ $loc['id'] }}" {{ ($filters['location'] ?? '') === $loc['id'] ? 'selected' : '' }}>
                            {{ $loc['name'] }} ({{ $loc['city'] }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Province / Region -->
                <div>
                    <label for="provinceSelect" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">
                        Province Jurisdiction
                    </label>
                    <select id="provinceSelect" 
                            name="province" 
                            onchange="document.getElementById('revenueFilterForm').submit()"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white text-slate-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
                        <option value="all" {{ ($filters['province'] ?? 'all') === 'all' ? 'selected' : '' }}>National (All Provinces)</option>
                        <option value="DKI Jakarta" {{ ($filters['province'] ?? '') === 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                        <option value="Jawa Barat" {{ ($filters['province'] ?? '') === 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                        <option value="Jawa Timur" {{ ($filters['province'] ?? '') === 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                        <option value="Bali" {{ ($filters['province'] ?? '') === 'Bali' ? 'selected' : '' }}>Bali</option>
                        <option value="Sumatera Utara" {{ ($filters['province'] ?? '') === 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                        <option value="Jawa Tengah" {{ ($filters['province'] ?? '') === 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                    </select>
                </div>

                <!-- Payment Method -->
                <div>
                    <label for="methodSelect" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">
                        Payment Rail
                    </label>
                    <select id="methodSelect" 
                            name="payment_method" 
                            onchange="document.getElementById('revenueFilterForm').submit()"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white text-slate-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
                        <option value="all" {{ ($filters['payment_method'] ?? 'all') === 'all' ? 'selected' : '' }}>All Payment Rails</option>
                        <option value="qris" {{ ($filters['payment_method'] ?? '') === 'qris' ? 'selected' : '' }}>QRIS National Standard</option>
                        <option value="nfc_card" {{ ($filters['payment_method'] ?? '') === 'nfc_card' ? 'selected' : '' }}>Contactless NFC Cards</option>
                        <option value="ewallet" {{ ($filters['payment_method'] ?? '') === 'ewallet' ? 'selected' : '' }}>E-Wallets (GoPay, OVO, ShopeePay)</option>
                        <option value="credit_card" {{ ($filters['payment_method'] ?? '') === 'credit_card' ? 'selected' : '' }}>Credit / Debit Cards (EMV)</option>
                        <option value="cashless_kiosk" {{ ($filters['payment_method'] ?? '') === 'cashless_kiosk' ? 'selected' : '' }}>Cashless Kiosk / Valet</option>
                        <option value="virtual_account" {{ ($filters['payment_method'] ?? '') === 'virtual_account' ? 'selected' : '' }}>Virtual Account & Online</option>
                    </select>
                </div>

                <!-- Settlement Status -->
                <div>
                    <label for="settlementSelect" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">
                        Settlement Outcome
                    </label>
                    <select id="settlementSelect" 
                            name="settlement" 
                            onchange="document.getElementById('revenueFilterForm').submit()"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-white text-slate-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
                        <option value="all" {{ ($filters['settlement'] ?? 'all') === 'all' ? 'selected' : '' }}>All Settlement States</option>
                        <option value="settled" {{ ($filters['settlement'] ?? '') === 'settled' ? 'selected' : '' }}>Settled (T+1 Cleared)</option>
                        <option value="pending_settlement" {{ ($filters['settlement'] ?? '') === 'pending_settlement' ? 'selected' : '' }}>In Clearing (Pending T+1)</option>
                        <option value="on_hold" {{ ($filters['settlement'] ?? '') === 'on_hold' ? 'selected' : '' }}>Audit Hold (Disputed)</option>
                        <option value="refunded" {{ ($filters['settlement'] ?? '') === 'refunded' ? 'selected' : '' }}>Reversed / Returned</option>
                    </select>
                </div>

            </div>

            <!-- Custom Date Range Bar (Collapsible or Active) -->
            <div class="pt-2 flex flex-wrap items-center justify-between gap-3 text-xs border-t border-slate-100">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Custom Range:</span>
                    <input type="date" 
                           name="date_from" 
                           value="{{ $filters['date_from'] ?? '' }}" 
                           class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-700 font-mono text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <span class="text-slate-400">&rarr;</span>
                    <input type="date" 
                           name="date_to" 
                           value="{{ $filters['date_to'] ?? '' }}" 
                           class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-700 font-mono text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <button type="submit" 
                            class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-colors shadow-xs">
                        Apply Dates
                    </button>
                </div>

                @if(!empty($filters['vendor']) && $filters['vendor'] !== 'all' || !empty($filters['location']) && $filters['location'] !== 'all' || !empty($filters['province']) && $filters['province'] !== 'all' || !empty($filters['payment_method']) && $filters['payment_method'] !== 'all' || !empty($filters['settlement']) && $filters['settlement'] !== 'all' || !empty($filters['date_from']))
                <a href="/admin/revenue" 
                   class="text-xs font-bold text-rose-600 hover:text-rose-800 transition-colors inline-flex items-center gap-1">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    <span>Reset All Filters</span>
                </a>
                @endif
            </div>

        </form>

    </div>

    <!-- ================= EXECUTIVE FINANCIAL KPI SUMMARY (6 CARDS) ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-6">
        
        <!-- KPI 1: Gross Parking Receipts -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-slate-900"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Gross Parking Receipts</span>
                    <span class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-bold">
                        Rp
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_gross_receipts'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    Total customer cashless volume
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                @if($compare)
                <span class="font-bold font-mono {{ $analytics['summary']['delta_gross_pct'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $analytics['summary']['delta_gross_pct'] >= 0 ? '+' : '' }}{{ $analytics['summary']['delta_gross_pct'] }}%
                </span>
                <span class="text-slate-400 truncate">vs prior benchmark</span>
                @else
                <span class="text-slate-400 font-mono">100% GTV Baseline</span>
                @endif
            </div>
        </div>

        <!-- KPI 2: Completed Refunds -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-rose-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Refunds & Adjustments</span>
                    <span class="w-6 h-6 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center font-bold">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-rose-700 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_refund_amount'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    {{ $analytics['summary']['refund_count'] }} reversals / cancellations
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                <span class="font-bold text-rose-700 font-mono">0.15% Rate</span>
                <span class="text-slate-400">Strict SLA clearance</span>
            </div>
        </div>

        <!-- KPI 3: Net Parking Receipts -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Net Parking Receipts</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Audited
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-emerald-700 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_net_receipts'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    Recognized net customer receipts
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                @if($compare)
                <span class="font-bold font-mono {{ $analytics['summary']['delta_net_pct'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $analytics['summary']['delta_net_pct'] >= 0 ? '+' : '' }}{{ $analytics['summary']['delta_net_pct'] }}%
                </span>
                <span class="text-slate-400 truncate">vs prior benchmark</span>
                @else
                <span class="text-emerald-700 font-mono">Gross minus Refunds</span>
                @endif
            </div>
        </div>

        <!-- KPI 4: NusaPark SaaS Take Rate (3.5%) -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-indigo-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Platform Commission</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 font-mono">
                        3.5% Fee
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-indigo-900 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_platform_commission'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    NusaPark PG SaaS revenue share
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                <span class="font-bold text-indigo-600 font-mono">Realized Yield</span>
                <span class="text-slate-400">Cashless processing</span>
            </div>
        </div>

        <!-- KPI 5: Volume & Average Ticket -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-blue-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Average Ticket Size</span>
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-blue-900 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_average_ticket'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    Across {{ $analytics['summary']['formatted_successful_transactions_count'] }} paid sessions
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                @if($compare)
                <span class="font-bold font-mono {{ $analytics['summary']['delta_avg_ticket_pct'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $analytics['summary']['delta_avg_ticket_pct'] >= 0 ? '+' : '' }}{{ $analytics['summary']['delta_avg_ticket_pct'] }}%
                </span>
                <span class="text-slate-400 truncate">ticket drift</span>
                @else
                <span class="text-blue-700 font-mono">Per completed exit</span>
                @endif
            </div>
        </div>

        <!-- KPI 6: SaaS Subscription MRR (Separate B2B Recurring) -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden bg-gradient-to-b from-white to-slate-50/50">
            <div class="absolute top-0 left-0 right-0 h-1 bg-purple-600"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Subscription MRR</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                        B2B SaaS
                    </span>
                </div>
                <div class="text-xl sm:text-2xl font-extrabold text-purple-950 tracking-tight font-mono leading-tight">
                    {{ $analytics['summary']['formatted_subscription_mrr'] }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    {{ $analytics['summary']['active_tenants_count'] }} enterprise operators (MRR)
                </div>
            </div>
            
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                <span class="font-bold text-purple-700 font-mono">Distinct Recurring</span>
                <span class="text-slate-400">Non-parking fee</span>
            </div>
        </div>

    </div>

    <!-- ================= MAIN REVENUE TREND VISUALIZER (INTERACTIVE SVG) ================= -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs mb-8 space-y-4">
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-3 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span>Platform Parking Revenue Trajectory</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                        {{ $analytics['period_label'] }}
                    </span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Chronological progression of gross cashless receipts (IDR) across Indonesian parking facilities compared against benchmark baseline.
                </p>
            </div>

            <div class="flex items-center gap-4 text-xs font-semibold">
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded bg-indigo-600"></span>
                    <span class="text-slate-700">Current Scope</span>
                </div>
                @if($compare)
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-0.5 border-t-2 border-dashed border-slate-400"></span>
                    <span class="text-slate-500">Benchmark Baseline</span>
                </div>
                @endif
                <button type="button" 
                        onclick="toggleTrendTable()" 
                        id="toggleTableBtn"
                        class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-[11px] font-bold text-slate-700 transition-colors cursor-pointer">
                    Show Table
                </button>
            </div>
        </div>

        <!-- Responsive Interactive SVG Area/Line Chart -->
        <div class="relative w-full pt-2">
            @php
                $maxVal = 1;
                foreach ($analytics['chart_data'] as $cd) {
                    if (($cd['current'] ?? 0) > $maxVal) $maxVal = $cd['current'];
                    if (($cd['previous'] ?? 0) > $maxVal) $maxVal = $cd['previous'];
                }
                $count = count($analytics['chart_data']);
                $svgWidth = 1000;
                $svgHeight = 260;
                $paddingTop = 20;
                $paddingBottom = 40;
                $paddingLeft = 70;
                $paddingRight = 20;
                $plotWidth = $svgWidth - $paddingLeft - $paddingRight;
                $plotHeight = $svgHeight - $paddingTop - $paddingBottom;

                $pointsCurrent = [];
                $pointsPrev = [];

                foreach ($analytics['chart_data'] as $idx => $cd) {
                    $x = $count > 1 ? $paddingLeft + ($idx / ($count - 1)) * $plotWidth : $paddingLeft + ($plotWidth / 2);
                    $yCurrent = $svgHeight - $paddingBottom - (($cd['current'] ?? 0) / $maxVal) * $plotHeight;
                    $yPrev = $svgHeight - $paddingBottom - (($cd['previous'] ?? 0) / $maxVal) * $plotHeight;
                    $pointsCurrent[] = round($x, 1) . ',' . round($yCurrent, 1);
                    $pointsPrev[] = round($x, 1) . ',' . round($yPrev, 1);
                }

                $areaPoints = $pointsCurrent;
                $lastX = $count > 1 ? $paddingLeft + $plotWidth : $paddingLeft + ($plotWidth / 2);
                $firstX = $count > 1 ? $paddingLeft : $paddingLeft + ($plotWidth / 2);
                $baselineY = $svgHeight - $paddingBottom;
                $areaPath = 'M ' . implode(' L ', $areaPoints) . " L {$lastX},{$baselineY} L {$firstX},{$baselineY} Z";
            @endphp

            <svg viewBox="0 0 {{ $svgWidth }} {{ $svgHeight }}" class="w-full h-56 sm:h-64 overflow-visible select-none" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="revenueGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#4F46E5" stop-opacity="0.28" />
                        <stop offset="100%" stop-color="#4F46E5" stop-opacity="0.0" />
                    </linearGradient>
                </defs>

                <!-- Gridlines & Y-Axis Labels -->
                @for($g = 0; $g <= 4; $g++)
                    @php
                        $yLine = $paddingTop + ($g / 4) * $plotHeight;
                        $valLine = (int)round($maxVal * (1 - ($g / 4)));
                    @endphp
                    <line x1="{{ $paddingLeft }}" y1="{{ $yLine }}" x2="{{ $svgWidth - $paddingRight }}" y2="{{ $yLine }}" stroke="#E2E8F0" stroke-dasharray="3 3" stroke-width="1" />
                    <text x="{{ $paddingLeft - 8 }}" y="{{ $yLine + 4 }}" fill="#64748B" font-size="10" font-family="monospace" text-anchor="end">
                        Rp {{ $valLine >= 1000000 ? round($valLine / 1000000, 1) . 'M' : round($valLine / 1000) . 'k' }}
                    </text>
                @endfor

                <!-- Area Fill (Current) -->
                <path d="{{ $areaPath }}" fill="url(#revenueGrad)" />

                <!-- Previous Benchmark Line (Dashed) -->
                @if($compare)
                <polyline fill="none" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" points="{{ implode(' ', $pointsPrev) }}" />
                @endif

                <!-- Current Period Line (Solid Indigo) -->
                <polyline fill="none" stroke="#4F46E5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" points="{{ implode(' ', $pointsCurrent) }}" />

                <!-- Data Anchor Points & Labels -->
                @foreach($analytics['chart_data'] as $idx => $cd)
                    @php
                        $x = $count > 1 ? $paddingLeft + ($idx / ($count - 1)) * $plotWidth : $paddingLeft + ($plotWidth / 2);
                        $y = $svgHeight - $paddingBottom - (($cd['current'] ?? 0) / $maxVal) * $plotHeight;
                    @endphp
                    <circle cx="{{ $x }}" cy="{{ $y }}" r="4" fill="#4F46E5" stroke="#FFFFFF" stroke-width="2" class="cursor-pointer hover:r-6 transition-all" />
                    
                    <!-- X-Axis Label -->
                    <text x="{{ $x }}" y="{{ $svgHeight - 12 }}" fill="#64748B" font-size="10" font-family="sans-serif" text-anchor="middle">
                        {{ $cd['label'] }}
                    </text>
                @endforeach
            </svg>
        </div>

        <!-- Collapsible Data Table for Trend -->
        <div id="trendTableWrapper" class="hidden pt-4 border-t border-slate-100 overflow-x-auto">
            <table class="w-full text-left text-xs border border-slate-200 rounded-xl overflow-hidden">
                <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-200">
                    <tr>
                        <th class="py-2.5 px-3">Interval / Time Bucket</th>
                        <th class="py-2.5 px-3 text-right">Current Period Receipts (IDR)</th>
                        @if($compare)
                        <th class="py-2.5 px-3 text-right">Previous Benchmark</th>
                        <th class="py-2.5 px-3 text-right">Delta (%)</th>
                        @endif
                        <th class="py-2.5 px-3 text-right">Cumulative Volume</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-mono text-[11px]">
                    @foreach($analytics['chart_data'] as $cd)
                    @php
                        $cur = $cd['current'] ?? 0;
                        $prev = $cd['previous'] ?? 0;
                        $delta = $prev > 0 ? round((($cur - $prev) / $prev) * 100, 1) : 0.0;
                    @endphp
                    <tr class="hover:bg-slate-50/80">
                        <td class="py-2 px-3 font-semibold text-slate-800 font-sans">{{ $cd['label'] }}</td>
                        <td class="py-2 px-3 text-right font-bold text-slate-900">{{ $cd['formatted_current'] }}</td>
                        @if($compare)
                        <td class="py-2 px-3 text-right text-slate-500">{{ $cd['formatted_previous'] }}</td>
                        <td class="py-2 px-3 text-right font-bold {{ $delta >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $delta >= 0 ? '+' : '' }}{{ $delta }}%
                        </td>
                        @endif
                        <td class="py-2 px-3 text-right text-indigo-700 font-bold">{{ $cd['formatted_cumulative'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= TWO-COLUMN DEEP-DIVE ANALYTICS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        
        <!-- LEFT COLUMN: Multi-Tenant & Location Breakdown (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Multi-Tenant Contribution Table -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Tenant / Operator Revenue Contribution
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Cashless parking yield, 3.5% SaaS commission, and separate B2B licensing MRR.
                        </p>
                    </div>
                    <span class="text-xs font-mono font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded-full border border-indigo-200">
                        {{ count($analytics['tenant_breakdown']) }} Operators
                    </span>
                </div>

                <div class="divide-y divide-slate-100 mt-2">
                    @foreach($analytics['tenant_breakdown'] as $tb)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/80 px-2 rounded-xl transition-colors">
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-slate-900 text-white font-bold flex items-center justify-center text-xs shrink-0 font-mono">
                                {{ strtoupper(substr(str_replace('vdr-', '', $tb['tenant_id']), 0, 3)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <a href="/admin/tenants?detail={{ $tb['tenant_id'] }}" 
                                       class="text-xs font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                                        {{ $tb['company_name'] }}
                                    </a>
                                    <span class="text-[10px] px-1.5 py-0.2 rounded font-semibold {{ $tb['tier'] === 'Enterprise Partner' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $tb['tier'] }}
                                    </span>
                                </div>
                                <div class="text-[11px] text-slate-400 flex items-center gap-2 mt-0.5">
                                    <span>{{ $tb['city'] }}, {{ $tb['province'] }}</span>
                                    <span>•</span>
                                    <span><strong>{{ $tb['facilities_count'] }}</strong> Facilities</span>
                                    <span>•</span>
                                    <span class="font-mono text-purple-700 font-bold" title="Distinct B2B SaaS MRR">
                                        MRR: {{ $tb['formatted_subscription_mrr'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Numbers -->
                        <div class="flex items-center justify-between sm:justify-end gap-4 shrink-0">
                            <!-- Share meter -->
                            <div class="w-24 text-right">
                                <div class="text-[11px] font-bold text-slate-800 font-mono">
                                    {{ $tb['share_pct'] }}% Share
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-1 overflow-hidden">
                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ min(100, $tb['share_pct'] * 2.8) }}%"></div>
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $tb['formatted_transaction_count'] }} trx
                                </div>
                            </div>

                            <!-- Net Receipts & Commission -->
                            <div class="w-32 text-right">
                                <div class="text-xs font-bold font-mono text-emerald-700">
                                    {{ $tb['formatted_net_revenue'] }}
                                </div>
                                <div class="text-[10px] text-indigo-600 font-mono font-medium">
                                    +{{ $tb['formatted_platform_fee'] }} Fee
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Parking Facilities Breakdown -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Top Parking Facilities by Cashless Receipts
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            High-volume barrier portals generating major gateway flow.
                        </p>
                    </div>
                    <span class="text-xs text-slate-400 font-mono">Top 8 Facilities</span>
                </div>

                <div class="divide-y divide-slate-100 mt-2">
                    @foreach(array_slice($analytics['location_breakdown'], 0, 8) as $lb)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/80 px-2 rounded-xl transition-colors">
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-xs shrink-0 font-mono">
                                {{ strtoupper(substr($lb['code'] ?? 'FAC', 0, 3)) }}
                            </div>
                            <div>
                                <a href="/admin/locations?q={{ urlencode($lb['name']) }}" 
                                   class="text-xs font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                                    {{ $lb['name'] }}
                                </a>
                                <div class="text-[11px] text-slate-400 flex items-center gap-2 mt-0.5">
                                    <span class="text-slate-600">{{ $lb['vendor_name'] }}</span>
                                    <span>•</span>
                                    <span>{{ $lb['city'] }}</span>
                                    <span>•</span>
                                    <span class="font-mono"><strong>{{ $lb['total_capacity'] }}</strong> Bays</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between sm:justify-end gap-4 shrink-0 text-right">
                            <div>
                                <div class="text-xs font-bold font-mono text-slate-900">
                                    {{ $lb['formatted_net_revenue'] }}
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    {{ $lb['formatted_transaction_count'] }} trx (Avg {{ $lb['formatted_average_ticket'] }})
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Payment Rails & Settlement Statuses (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Payment Rail Distribution -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="pb-3 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-900 tracking-tight">
                        Payment Rail Distribution
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Cashless channel penetration across parking barriers.
                    </p>
                </div>

                <div class="space-y-3.5 mt-4">
                    @foreach($analytics['payment_method_breakdown'] as $pm)
                    <div class="p-3 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors bg-slate-50/50">
                        <div class="flex items-center justify-between text-xs mb-1.5">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-900">{{ $pm['name'] }}</span>
                            </div>
                            <span class="font-bold font-mono text-indigo-700">{{ $pm['share_pct'] }}%</span>
                        </div>
                        
                        <!-- Progress Meter -->
                        <div class="w-full bg-slate-200/80 rounded-full h-2 overflow-hidden">
                            <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500" 
                                 style="width: {{ $pm['share_pct'] }}%"></div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-slate-500 mt-2 font-mono">
                            <span class="text-slate-700 font-bold">{{ $pm['formatted_amount'] }}</span>
                            <span>{{ $pm['formatted_count'] }} transactions</span>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-1 truncate">
                            Rails: {{ $pm['channel'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Settlement & Clearing State Distribution -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="pb-3 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-900 tracking-tight">
                        Settlement & Disbursal State
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Platform clearing lifecycle and audit hold tracking.
                    </p>
                </div>

                <div class="space-y-3 mt-4">
                    @foreach($analytics['settlement_breakdown'] as $sb)
                    <div class="p-3.5 rounded-xl border border-slate-200/80 bg-white shadow-2xs">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full {{ $sb['status'] === 'settled' ? 'bg-emerald-500' : ($sb['status'] === 'pending_settlement' ? 'bg-amber-500' : ($sb['status'] === 'on_hold' ? 'bg-indigo-600' : 'bg-rose-500')) }}"></span>
                                <span class="text-xs font-bold text-slate-900">{{ $sb['label'] }}</span>
                            </div>
                            <span class="text-xs font-bold font-mono text-slate-900">{{ $sb['share_pct'] }}%</span>
                        </div>

                        <div class="text-[11px] text-slate-500 leading-relaxed">
                            {{ $sb['description'] }}
                        </div>

                        <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs font-mono">
                            <span class="font-bold {{ $sb['status'] === 'settled' ? 'text-emerald-700' : ($sb['status'] === 'on_hold' ? 'text-indigo-700' : 'text-slate-800') }}">
                                {{ $sb['formatted_amount'] }}
                            </span>
                            <span class="text-slate-500 font-sans text-[11px]">
                                {{ number_format($sb['count'], 0, ',', '.') }} payments
                            </span>
                        </div>

                        @if($sb['status'] === 'on_hold' && $sb['amount'] > 0)
                        <div class="mt-2 text-right">
                            <a href="/admin/transactions?settlement=on_hold" 
                               class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                Investigate Audit Holds &rarr;
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    <!-- ================= SUPPORTING FINANCIAL BREAKDOWN TABLE ================= -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs mb-8">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 tracking-tight">
                    Facility Financial Performance Breakdown
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Detailed audit ledger across registered locations for the active reporting period.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <input type="text" 
                       id="tableSearchInput" 
                       onkeyup="filterFacilityTable()" 
                       placeholder="Search facility or operator..." 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-xs font-medium focus:ring-2 focus:ring-indigo-500 focus:outline-none w-56">
            </div>
        </div>

        <div class="overflow-x-auto mt-3">
            <table id="facilityFinancialTable" class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-600 font-bold border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-3">Parking Facility</th>
                        <th class="py-3 px-3">Tenant Operator</th>
                        <th class="py-3 px-3">Region</th>
                        <th class="py-3 px-3 text-right">Bays</th>
                        <th class="py-3 px-3 text-right">Gross Receipts</th>
                        <th class="py-3 px-3 text-right">Refunds</th>
                        <th class="py-3 px-3 text-right font-bold text-slate-900">Net Receipts</th>
                        <th class="py-3 px-3 text-right">SaaS Commission</th>
                        <th class="py-3 px-3 text-right">Tx Count</th>
                        <th class="py-3 px-3 text-right">Avg Ticket</th>
                        <th class="py-3 px-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-mono text-[11px]">
                    @foreach($analytics['table_rows'] as $row)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-2.5 px-3 font-sans font-bold text-slate-900">
                            {{ $row['name'] }}
                        </td>
                        <td class="py-2.5 px-3 font-sans text-slate-700">
                            {{ $row['vendor_name'] }}
                        </td>
                        <td class="py-2.5 px-3 font-sans text-slate-500">
                            {{ $row['city'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-slate-600">
                            {{ number_format($row['total_capacity'], 0, ',', '.') }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-slate-700">
                            {{ $row['formatted_gross_revenue'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-rose-600">
                            {{ $row['formatted_refund_amount'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right font-bold text-emerald-700">
                            {{ $row['formatted_net_revenue'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-indigo-700">
                            {{ $row['formatted_platform_fee'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-slate-800">
                            {{ $row['formatted_transaction_count'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right text-slate-600">
                            {{ $row['formatted_average_ticket'] }}
                        </td>
                        <td class="py-2.5 px-3 text-center font-sans">
                            <a href="/admin/transactions?location={{ $row['location_id'] }}" 
                               class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800 underline">
                                Trx &rarr;
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= PAGE JAVASCRIPT ================= -->
    <script>
        function toggleTrendTable() {
            const wrapper = document.getElementById('trendTableWrapper');
            const btn = document.getElementById('toggleTableBtn');
            if (wrapper.classList.contains('hidden')) {
                wrapper.classList.remove('hidden');
                btn.textContent = 'Hide Table';
            } else {
                wrapper.classList.add('hidden');
                btn.textContent = 'Show Table';
            }
        }

        function filterFacilityTable() {
            const input = document.getElementById('tableSearchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('facilityFinancialTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const tdFacility = tr[i].getElementsByTagName('td')[0];
                const tdTenant = tr[i].getElementsByTagName('td')[1];
                const tdCity = tr[i].getElementsByTagName('td')[2];

                if (tdFacility || tdTenant || tdCity) {
                    const txtFacility = tdFacility ? (tdFacility.textContent || tdFacility.innerText).toLowerCase() : '';
                    const txtTenant = tdTenant ? (tdTenant.textContent || tdTenant.innerText).toLowerCase() : '';
                    const txtCity = tdCity ? (tdCity.textContent || tdCity.innerText).toLowerCase() : '';

                    if (txtFacility.includes(filter) || txtTenant.includes(filter) || txtCity.includes(filter)) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>

</x-layouts.admin>
