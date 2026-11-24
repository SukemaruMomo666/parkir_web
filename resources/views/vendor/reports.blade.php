<x-layouts.vendor activeNav="reports" title="Vendor Reports - NusaPark Enterprise">

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

    <!-- ================= PAGE HEADER & PRIMARY ACTIONS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Audit & Operations • Page 31</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Reporting Center Active
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Audit ID: {{ $report['report_id'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Reports
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Generate and review operational and financial reports for your parking facilities.
                </p>
            </div>
        </div>

        <!-- Quick Report Actions (Export & Print) -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Refresh Report View -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Report Generation"
                    aria-label="Refresh Live Report Generation">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Print Report Action -->
            <button type="button" 
                    onclick="window.print()" 
                    class="px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
                    title="Print report preview">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                <span>Print</span>
            </button>

            <!-- Export to CSV Action (Streams exact active report configuration) -->
            <a href="/vendor/reports/export?type={{ $reportType }}&facility={{ $facilityId }}&period={{ $period }}&start_date={{ $filters['start_date'] }}&end_date={{ $filters['end_date'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&direction={{ $filters['direction'] }}&q={{ urlencode($filters['q']) }}" 
               class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
               title="Export report dataset as RFC-compliant CSV spreadsheet">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export CSV</span>
            </a>
        </div>
    </div>

    <!-- ================= AREA 1: REPORT CONFIGURATION & FILTERS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-5">
        
        <!-- Report Type Segmented Selector -->
        <div>
            <div class="flex items-center justify-between mb-2.5">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">1. Select Report Type</span>
                <span class="text-xs text-slate-400">5 Authoritative Datasets Available</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2.5">
                
                <!-- Tab 1: Parking Sessions -->
                <a href="/vendor/reports?type=sessions&facility={{ $facilityId }}&period={{ $period }}" 
                   class="p-3 rounded-xl border text-left transition-all {{ $reportType === 'sessions' ? 'bg-blue-50/70 border-[var(--accent)] text-[var(--primary)] ring-2 ring-[var(--accent)]/20 shadow-xs' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-white hover:border-slate-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold">Parking Sessions</span>
                        <div class="w-5 h-5 rounded flex items-center justify-center {{ $reportType === 'sessions' ? 'bg-[var(--accent)] text-white' : 'bg-slate-200 text-slate-500' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1 leading-snug">Turnaround duration, billed fees, and vehicle plate records.</p>
                </a>

                <!-- Tab 2: Financial Transactions -->
                <a href="/vendor/reports?type=transactions&facility={{ $facilityId }}&period={{ $period }}" 
                   class="p-3 rounded-xl border text-left transition-all {{ $reportType === 'transactions' ? 'bg-blue-50/70 border-[var(--accent)] text-[var(--primary)] ring-2 ring-[var(--accent)]/20 shadow-xs' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-white hover:border-slate-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold">Transactions</span>
                        <div class="w-5 h-5 rounded flex items-center justify-center {{ $reportType === 'transactions' ? 'bg-[var(--accent)] text-white' : 'bg-slate-200 text-slate-500' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1 leading-snug">Payment channels, gateway approvals, and settlement states.</p>
                </a>

                <!-- Tab 3: Revenue & Collection Summary -->
                <a href="/vendor/reports?type=revenue&facility={{ $facilityId }}&period={{ $period }}" 
                   class="p-3 rounded-xl border text-left transition-all {{ $reportType === 'revenue' ? 'bg-blue-50/70 border-[var(--accent)] text-[var(--primary)] ring-2 ring-[var(--accent)]/20 shadow-xs' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-white hover:border-slate-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold">Revenue Summary</span>
                        <div class="w-5 h-5 rounded flex items-center justify-center {{ $reportType === 'revenue' ? 'bg-[var(--accent)] text-white' : 'bg-slate-200 text-slate-500' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1 leading-snug">Gross volume, confirmed refunds, and facility portfolio share.</p>
                </a>

                <!-- Tab 4: Facility Performance -->
                <a href="/vendor/reports?type=facility_performance&facility={{ $facilityId }}&period={{ $period }}" 
                   class="p-3 rounded-xl border text-left transition-all {{ $reportType === 'facility_performance' ? 'bg-blue-50/70 border-[var(--accent)] text-[var(--primary)] ring-2 ring-[var(--accent)]/20 shadow-xs' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-white hover:border-slate-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold">Facility Operations</span>
                        <div class="w-5 h-5 rounded flex items-center justify-center {{ $reportType === 'facility_performance' ? 'bg-[var(--accent)] text-white' : 'bg-slate-200 text-slate-500' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1 leading-snug">Live bay capacity, occupancy %, and traffic throughput.</p>
                </a>

                <!-- Tab 5: Barrier Gates & Telemetry -->
                <a href="/vendor/reports?type=gates_operational&facility={{ $facilityId }}&period={{ $period }}" 
                   class="p-3 rounded-xl border text-left transition-all {{ $reportType === 'gates_operational' ? 'bg-blue-50/70 border-[var(--accent)] text-[var(--primary)] ring-2 ring-[var(--accent)]/20 shadow-xs' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-white hover:border-slate-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold">Gates & Hardware</span>
                        <div class="w-5 h-5 rounded flex items-center justify-center {{ $reportType === 'gates_operational' ? 'bg-[var(--accent)] text-white' : 'bg-slate-200 text-slate-500' }}">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1 leading-snug">Boom actuator cycle counts, link SLA, and diagnostics.</p>
                </a>

            </div>
        </div>

        <!-- Filter Controls Form -->
        <form id="report-params-form" method="GET" action="/vendor/reports" class="pt-3 border-t border-slate-100 space-y-3.5">
            <input type="hidden" name="type" value="{{ $reportType }}">

            <!-- Filter Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                
                <!-- 1. Facility Selector -->
                <div>
                    <label for="filter-facility" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Facility Scope
                    </label>
                    <select id="filter-facility" 
                            name="facility" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($facilityId === 'all') ? 'selected' : '' }}>All Authorized Facilities ({{ count($facilities) }})</option>
                        @foreach($facilities as $f)
                            <option value="{{ $f['id'] }}" {{ ($facilityId === $f['id']) ? 'selected' : '' }}>
                                {{ $f['name'] }} ({{ $f['city'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. Reporting Period -->
                <div>
                    <label for="filter-period" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Reporting Period
                    </label>
                    <select id="filter-period" 
                            name="period" 
                            onchange="handlePeriodChange(this.value)"
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="today" {{ ($period === 'today') ? 'selected' : '' }}>Today (11 Oct 2026)</option>
                        <option value="yesterday" {{ ($period === 'yesterday') ? 'selected' : '' }}>Yesterday (10 Oct 2026)</option>
                        <option value="7days" {{ ($period === '7days') ? 'selected' : '' }}>Last 7 Days (05 - 11 Oct)</option>
                        <option value="month" {{ ($period === 'month') ? 'selected' : '' }}>October 2026 (Month to Date)</option>
                        <option value="custom" {{ ($period === 'custom') ? 'selected' : '' }}>Custom Date Range...</option>
                    </select>
                </div>

                <!-- 3. Contextual Filter (Changes based on report type) -->
                @if($reportType === 'sessions')
                <div>
                    <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Session State
                    </label>
                    <select id="filter-status" 
                            name="status" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Session States</option>
                        <option value="active" {{ ($filters['status'] === 'active') ? 'selected' : '' }}>Active On-Site</option>
                        <option value="completed" {{ ($filters['status'] === 'completed') ? 'selected' : '' }}>Completed (Exited)</option>
                        <option value="attention" {{ ($filters['status'] === 'attention') ? 'selected' : '' }}>Attention Required / Flagged</option>
                    </select>
                </div>
                @elseif($reportType === 'transactions')
                <div>
                    <label for="filter-tx-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Payment Status
                    </label>
                    <select id="filter-tx-status" 
                            name="status" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Payment Statuses</option>
                        <option value="successful" {{ ($filters['status'] === 'successful') ? 'selected' : '' }}>Successful (Paid)</option>
                        <option value="pending" {{ ($filters['status'] === 'pending') ? 'selected' : '' }}>Pending Authorization</option>
                        <option value="refunded" {{ ($filters['status'] === 'refunded') ? 'selected' : '' }}>Refunded</option>
                        <option value="disputed" {{ ($filters['status'] === 'disputed') ? 'selected' : '' }}>Disputed / On Hold</option>
                    </select>
                </div>
                @elseif($reportType === 'gates_operational')
                <div>
                    <label for="filter-direction" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Lane Direction
                    </label>
                    <select id="filter-direction" 
                            name="direction" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['direction'] === 'all') ? 'selected' : '' }}>All Lane Directions</option>
                        <option value="inbound" {{ ($filters['direction'] === 'inbound') ? 'selected' : '' }}>Inbound (Entry)</option>
                        <option value="outbound" {{ ($filters['direction'] === 'outbound') ? 'selected' : '' }}>Outbound (Exit)</option>
                    </select>
                </div>
                @else
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Accounting Scope
                    </label>
                    <div class="px-3 py-2 rounded-xl border border-slate-200 bg-slate-100 text-xs text-slate-600 font-semibold truncate">
                        Cashless Cleared Net Receipts
                    </div>
                </div>
                @endif

                <!-- 4. Keyword Query -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-2">
                    <label for="filter-q" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                        Search Keywords
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1">
                            <input type="text" 
                                   id="filter-q"
                                   name="q" 
                                   value="{{ $filters['q'] }}" 
                                   placeholder="Filter by plate, reference code, gate, or provider..." 
                                   class="w-full pl-3 pr-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold transition-colors cursor-pointer flex items-center justify-center gap-1.5 shadow-xs shrink-0">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <span>Generate</span>
                        </button>

                        @if(!empty($filters['q']) || $period !== 'today' || $facilityId !== 'all')
                        <a href="/vendor/reports?type={{ $reportType }}" 
                           class="px-2.5 py-2 rounded-xl border border-slate-200 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition-colors shrink-0" 
                           title="Reset filters">
                            Clear
                        </a>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Custom Date Range Row (Revealed when period === 'custom') -->
            <div id="custom-date-container" class="{{ $period === 'custom' ? '' : 'hidden' }} grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2.5 border-t border-slate-100">
                <div>
                    <label for="start_date" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Start Date</label>
                    <input type="date" 
                           id="start_date" 
                           name="start_date" 
                           value="{{ $filters['start_date'] ?? '2026-10-01' }}" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                </div>
                <div>
                    <label for="end_date" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">End Date</label>
                    <input type="date" 
                           id="end_date" 
                           name="end_date" 
                           value="{{ $filters['end_date'] ?? '2026-10-11' }}" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                </div>
            </div>

        </form>

    </div>

    <!-- ================= AREA 2: REPORT PREVIEW & AUDIT METADATA ================= -->
    <div class="space-y-4">
        
        <!-- Report Metadata Header Ribbon -->
        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-extrabold text-slate-900 text-sm tracking-tight">{{ $report['report_title'] }}</span>
                    <span class="font-mono text-[10px] px-2 py-0.5 rounded bg-slate-200 text-slate-700 font-bold">{{ $report['report_id'] }}</span>
                </div>
                <p class="text-slate-500 mt-0.5">{{ $report['report_description'] }}</p>
            </div>
            <div class="flex items-center gap-3 sm:gap-4 text-[11px] text-slate-600 font-semibold shrink-0">
                <div>Scope: <strong class="text-slate-900">{{ $report['facility_name'] }}</strong></div>
                <span>•</span>
                <div>Period: <strong class="text-slate-900">{{ $report['period_label'] }}</strong></div>
            </div>
        </div>

        <!-- 5-Card Summary Metrics Strip -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4">
            @foreach($report['summary_metrics'] as $metric)
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">{{ $metric['label'] }}</span>
                    <span class="w-2 h-2 rounded-full {{ str_contains($metric['badge'], 'emerald') ? 'bg-emerald-500' : (str_contains($metric['badge'], 'purple') ? 'bg-purple-500' : 'bg-blue-500') }}"></span>
                </div>
                <div class="mt-2.5">
                    <div class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                        {{ $metric['value'] }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 truncate" title="{{ $metric['subtext'] }}">
                        {{ $metric['subtext'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <!-- ================= AREA 3: REPORT PREVIEW TABLE ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <!-- Table Topbar -->
        <div class="px-5 py-4 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-sm sm:text-base font-bold text-slate-900">
                    Tabular Report Preview
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Showing {{ $pagination['from'] }}-{{ $pagination['to'] }} of {{ $pagination['total'] }} recorded entries matching active configuration.
                </p>
            </div>

            <!-- Deep Jump Link to Source Operations Page -->
            @if($reportType === 'sessions')
            <a href="/vendor/parking-sessions?facility={{ $facilityId }}&period={{ $period }}" 
               class="text-xs font-bold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1">
                <span>View Live Parking Sessions Workspace</span>
                <span>&rarr;</span>
            </a>
            @elseif($reportType === 'transactions')
            <a href="/vendor/transactions?facility={{ $facilityId }}&period={{ $period }}" 
               class="text-xs font-bold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1">
                <span>View Live Transactions Ledger</span>
                <span>&rarr;</span>
            </a>
            @elseif($reportType === 'revenue')
            <a href="/vendor/revenue?facility={{ $facilityId }}&period={{ $period }}" 
               class="text-xs font-bold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1">
                <span>View Live Revenue Analytics Dashboard</span>
                <span>&rarr;</span>
            </a>
            @elseif($reportType === 'gates_operational')
            <a href="/vendor/gates?facility={{ $facilityId }}" 
               class="text-xs font-bold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1">
                <span>View Live Barrier Gates Workspace</span>
                <span>&rarr;</span>
            </a>
            @endif
        </div>

        <!-- Table Responsive Container -->
        <div class="overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse text-xs min-w-[750px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        @foreach($report['columns'] as $col)
                        <th class="py-3.5 px-4 text-{{ $col['align'] ?? 'left' }}">
                            {{ $col['label'] }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($records as $rec)
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        @foreach($report['columns'] as $col)
                            @php
                                $val = $rec[$col['key']] ?? '--';
                                $align = $col['align'] ?? 'left';
                            @endphp
                            
                            <td class="py-3.5 px-4 text-{{ $align }} whitespace-nowrap">
                                @if($col['key'] === 'session_code' || $col['key'] === 'transaction_reference' || $col['key'] === 'code')
                                    <span class="font-mono font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                        {{ $val }}
                                    </span>
                                @elseif($col['key'] === 'vehicle_plate')
                                    <span class="font-mono font-bold text-slate-800 bg-slate-50 px-1.5 py-0.5 rounded border border-slate-200">
                                        {{ $val }}
                                    </span>
                                @elseif(str_contains($col['key'], 'status') || str_contains($col['key'], 'connectivity'))
                                    @php
                                        $lowerVal = strtolower((string)$val);
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold {{ str_contains($lowerVal, 'success') || str_contains($lowerVal, 'paid') || str_contains($lowerVal, 'optimal') || str_contains($lowerVal, 'online') ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : (str_contains($lowerVal, 'pending') || str_contains($lowerVal, 'active') ? 'bg-amber-50 text-amber-800 border border-amber-300' : (str_contains($lowerVal, 'refund') ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-700 border border-slate-200')) }}">
                                        {{ $val }}
                                    </span>
                                @elseif(str_contains($col['key'], 'formatted') || str_contains($col['key'], 'fee') || str_contains($col['key'], 'volume'))
                                    <span class="font-mono font-bold text-slate-900">
                                        {{ $val }}
                                    </span>
                                @else
                                    <span class="text-slate-700">
                                        {{ $val }}
                                    </span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($report['columns']) }}" class="py-12 px-4 text-center">
                            <div class="max-w-sm mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900">No report records found</h4>
                                <p class="text-xs text-slate-500 mt-1">
                                    No records matched the selected report type and filter parameters. Try adjusting the period or keyword search.
                                </p>
                                <a href="/vendor/reports?type={{ $reportType }}" class="mt-3 px-3 py-1.5 rounded-lg bg-[var(--primary)] text-white text-xs font-bold">
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
                Showing <span class="font-bold text-slate-800">{{ $pagination['from'] }}</span> to <span class="font-bold text-slate-800">{{ $pagination['to'] }}</span> of <span class="font-bold text-slate-800">{{ $pagination['total'] }}</span> report records
            </div>
            
            <div class="flex items-center gap-2">
                @if($pagination['current_page'] > 1)
                <a href="/vendor/reports?type={{ $reportType }}&facility={{ $facilityId }}&period={{ $period }}&start_date={{ $filters['start_date'] }}&end_date={{ $filters['end_date'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&direction={{ $filters['direction'] }}&q={{ urlencode($filters['q']) }}&page={{ $pagination['current_page'] - 1 }}" 
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
                <a href="/vendor/reports?type={{ $reportType }}&facility={{ $facilityId }}&period={{ $period }}&start_date={{ $filters['start_date'] }}&end_date={{ $filters['end_date'] }}&status={{ $filters['status'] }}&payment_method={{ $filters['payment_method'] }}&direction={{ $filters['direction'] }}&q={{ urlencode($filters['q']) }}&page={{ $pagination['current_page'] + 1 }}" 
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

@push('scripts')
<script>
    /**
     * Reveal or hide custom date range inputs.
     */
    function handlePeriodChange(val) {
        const customContainer = document.getElementById('custom-date-container');
        if (!customContainer) return;

        if (val === 'custom') {
            customContainer.classList.remove('hidden');
        } else {
            customContainer.classList.add('hidden');
            // Auto submit when switching standard periods
            document.getElementById('report-params-form').submit();
        }
    }
</script>
@endpush

</x-layouts.vendor>
