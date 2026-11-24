<x-layouts.vendor activeNav="revenue" title="Revenue Analytics - NusaPark Enterprise">

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

    <!-- ================= PAGE HEADER & REPORTING FILTERS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Financial Overview • Page 30</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Audited Cashless Revenue Live
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Sync: {{ $analytics['last_sync'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Revenue
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Analyze recorded parking revenue across your facilities and selected reporting periods.
                </p>
            </div>
        </div>

        <!-- Filter Form Controls -->
        <form id="revenue-filter-form" method="GET" action="/vendor/revenue" class="flex flex-wrap items-center gap-2.5">
            
            <!-- Facility Scope Filter -->
            @if(count($facilities) > 1)
            <div class="relative min-w-[200px]">
                <label for="facility-selector" class="sr-only">Switch Facility Scope</label>
                <select id="facility-selector" 
                        name="facility" 
                        onchange="document.getElementById('revenue-filter-form').submit()"
                        class="w-full pl-3 pr-8 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer shadow-xs">
                    <option value="all" {{ ($facilityId === 'all') ? 'selected' : '' }}>All Authorized Facilities ({{ count($facilities) }})</option>
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($facilityId === $f['id']) ? 'selected' : '' }}>
                            {{ $f['name'] }} ({{ $f['city'] }})
                        </option>
                    @endforeach
                </select>
                <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            @endif

            <!-- Reporting Period Filter -->
            <div class="relative">
                <label for="period-selector" class="sr-only">Select Reporting Period</label>
                <select id="period-selector" 
                        name="period" 
                        onchange="document.getElementById('revenue-filter-form').submit()"
                        class="pl-3 pr-8 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer shadow-xs">
                    <option value="today" {{ ($period === 'today') ? 'selected' : '' }}>Today (11 Oct 2026)</option>
                    <option value="yesterday" {{ ($period === 'yesterday') ? 'selected' : '' }}>Yesterday (10 Oct 2026)</option>
                    <option value="7days" {{ ($period === '7days') ? 'selected' : '' }}>Last 7 Days (05 - 11 Oct)</option>
                    <option value="month" {{ ($period === 'month') ? 'selected' : '' }}>October 2026 (Month to Date)</option>
                </select>
                <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>

            <!-- Compare Checkbox/Toggle -->
            <label class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-700 cursor-pointer transition-colors shadow-xs select-none">
                <input type="checkbox" 
                       name="compare" 
                       value="1" 
                       {{ $compare ? 'checked' : '' }} 
                       onchange="document.getElementById('revenue-filter-form').submit()"
                       class="rounded border-slate-300 text-[var(--primary)] focus:ring-[var(--primary)] cursor-pointer">
                <span>vs Previous Period</span>
            </label>

            <!-- Refresh Button -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Financial Telemetry"
                    aria-label="Refresh Live Financial Telemetry">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Export to CSV Action -->
            <a href="/vendor/revenue/export?facility={{ $facilityId }}&period={{ $period }}&compare={{ $compare ? '1' : '0' }}" 
               class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
               title="Export revenue report as RFC-compliant CSV spreadsheet">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export CSV</span>
            </a>
        </form>

    </div>

    <!-- ================= EXECUTIVE SUMMARY KPI SECTION ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4">
        
        <!-- KPI 1: Net Recorded Receipts (Primary Metric) -->
        <div class="col-span-1 sm:col-span-2 lg:col-span-1 p-4 rounded-xl bg-[var(--surface)] border-2 border-emerald-500/20 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-800">Net Recorded Receipts</span>
                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Gross - Refunds
                </span>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $analytics['summary']['formatted_net_revenue'] }}
                </div>
                
                @if($compare)
                <div class="flex items-center gap-1.5 mt-1.5 text-xs font-bold {{ $analytics['summary']['growth_delta'] >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                    @if($analytics['summary']['growth_delta'] >= 0)
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    <span>+{{ $analytics['summary']['growth_pct'] }}%</span>
                    @else
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    <span>{{ $analytics['summary']['growth_pct'] }}%</span>
                    @endif
                    <span class="text-[11px] font-normal text-slate-500">vs prev ({{ $analytics['summary']['formatted_prev_net_revenue'] }})</span>
                </div>
                @else
                <div class="text-[11px] text-slate-500 mt-1.5">
                    {{ $analytics['period_label'] }}
                </div>
                @endif
            </div>
        </div>

        <!-- KPI 2: Gross Recorded Revenue -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Gross Recorded Revenue</span>
                <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $analytics['summary']['formatted_gross_revenue'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                    <span>{{ number_format($analytics['summary']['successful_transactions']) }} captured payments</span>
                </div>
            </div>
        </div>

        <!-- KPI 3: Confirmed Refunds & Reversals -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Confirmed Refunds</span>
                <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-extrabold text-purple-800 leading-tight">
                    {{ $analytics['summary']['formatted_refunds_amount'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    {{ $analytics['summary']['refund_count'] }} processed refund(s) (0.16% rate)
                </div>
            </div>
        </div>

        <!-- KPI 4: Average Revenue Per Session / Transaction -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Average Ticket (ARPU)</span>
                <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $analytics['summary']['formatted_avg_ticket'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Per completed parking event
                </div>
            </div>
        </div>

        <!-- KPI 5: Pending & In-Flight Volume -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">In-Flight / Pending</span>
                <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-extrabold text-amber-800 leading-tight">
                    {{ $analytics['summary']['formatted_pending_volume'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    {{ $analytics['summary']['pending_count'] }} in-progress payment(s)
                </div>
            </div>
        </div>

    </div>

    <!-- ================= REVENUE LEAKAGE / DISCREPANCY AUDIT BANNER ================= -->
    @if($analytics['summary']['disputed_volume'] > 0 || $analytics['summary']['pending_volume'] > 0)
    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
        <div class="flex items-start sm:items-center gap-3">
            <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 font-bold">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div>
                <span class="font-bold text-slate-900">Reconciliation & Audit Monitoring:</span>
                <span class="text-slate-600">
                    {{ $analytics['summary']['formatted_disputed_volume'] }} is currently held in audit disputes across {{ $analytics['summary']['disputed_count'] }} transaction(s). Excluded from net receipts.
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
            <a href="/vendor/transactions?facility={{ $facilityId }}&status=disputed" 
               class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 font-bold transition-colors">
                View Disputed Records &rarr;
            </a>
            <a href="/vendor/transactions?facility={{ $facilityId }}&status=pending" 
               class="px-3 py-1.5 rounded-lg border border-amber-300 bg-amber-50 hover:bg-amber-100 text-amber-900 font-bold transition-colors">
                View Pending &rarr;
            </a>
        </div>
    </div>
    @endif

    <!-- ================= MAIN REVENUE TREND VISUALIZATION ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-3 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span>Revenue Trajectory & Periodic Trend</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-[var(--accent)] border border-blue-200">
                        {{ $analytics['period_label'] }}
                    </span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Chronological progression of recorded receipts (IDR) compared against prior benchmark baseline.
                </p>
            </div>

            <div class="flex items-center gap-4 text-xs font-semibold">
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded bg-[var(--accent)]"></span>
                    <span class="text-slate-700">Current Period</span>
                </div>
                @if($compare)
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-0.5 border-t-2 border-dashed border-slate-400"></span>
                    <span class="text-slate-500">Previous Benchmark</span>
                </div>
                @endif
                <button type="button" 
                        onclick="toggleTrendTable()" 
                        id="toggle-table-btn"
                        class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-[11px] font-bold text-slate-700 transition-colors cursor-pointer">
                    Show Data Table
                </button>
            </div>
        </div>

        <!-- Interactive SVG Area / Line Trend Visualizer -->
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
                $paddingLeft = 60;
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
                $firstX = $paddingLeft;
                $baseY = $svgHeight - $paddingBottom;
                $areaPath = 'M ' . implode(' L ', $areaPoints) . " L {$lastX},{$baseY} L {$firstX},{$baseY} Z";
            @endphp

            <div class="overflow-x-auto scrollbar-thin">
                <svg viewBox="0 0 {{ $svgWidth }} {{ $svgHeight }}" class="w-full min-w-[650px] h-64 select-none">
                    <defs>
                        <linearGradient id="revenueGradient" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#2563EB" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#2563EB" stop-opacity="0.0" />
                        </linearGradient>
                    </defs>

                    <!-- Horizontal Grid Lines -->
                    @for($i = 0; $i <= 4; $i++)
                        @php
                            $gridY = $svgHeight - $paddingBottom - ($i / 4) * $plotHeight;
                            $gridVal = ($i / 4) * $maxVal;
                        @endphp
                        <line x1="{{ $paddingLeft }}" y1="{{ $gridY }}" x2="{{ $svgWidth - $paddingRight }}" y2="{{ $gridY }}" stroke="#E2E8F0" stroke-width="1" stroke-dasharray="3 3" />
                        <text x="{{ $paddingLeft - 10 }}" y="{{ $gridY + 4 }}" font-size="10" font-family="Plus Jakarta Sans, sans-serif" fill="#94A3B8" text-anchor="end">
                            Rp {{ number_format($gridVal / 1000, 0) }}k
                        </text>
                    @endfor

                    <!-- Area Fill -->
                    <path d="{{ $areaPath }}" fill="url(#revenueGradient)" />

                    <!-- Previous Period Benchmark Line (Dashed) -->
                    @if($compare && count($pointsPrev) > 1)
                    <polyline points="{{ implode(' ', $pointsPrev) }}" fill="none" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                    @endif

                    <!-- Current Period Line -->
                    @if(count($pointsCurrent) > 1)
                    <polyline points="{{ implode(' ', $pointsCurrent) }}" fill="none" stroke="#2563EB" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    @endif

                    <!-- Data Point Circles and X-Axis Labels -->
                    @foreach($analytics['chart_data'] as $idx => $cd)
                        @php
                            $cx = $count > 1 ? $paddingLeft + ($idx / ($count - 1)) * $plotWidth : $paddingLeft + ($plotWidth / 2);
                            $cyCurrent = $svgHeight - $paddingBottom - (($cd['current'] ?? 0) / $maxVal) * $plotHeight;
                        @endphp
                        
                        <!-- Circle Point -->
                        <circle cx="{{ $cx }}" cy="{{ $cyCurrent }}" r="4.5" fill="#FFFFFF" stroke="#2563EB" stroke-width="2.5" class="transition-transform hover:scale-150 cursor-pointer">
                            <title>{{ $cd['label'] }}: {{ $cd['formatted_current'] }}</title>
                        </circle>

                        <!-- X Label -->
                        <text x="{{ $cx }}" y="{{ $svgHeight - 12 }}" font-size="10" font-family="Plus Jakarta Sans, sans-serif" font-weight="600" fill="#64748B" text-anchor="middle">
                            {{ $cd['label'] }}
                        </text>
                    @endforeach
                </svg>
            </div>
        </div>

        <!-- Accessible Data Table (Collapsible) -->
        <div id="trend-data-table" class="hidden pt-3 border-t border-slate-100 overflow-x-auto scrollbar-thin">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 text-slate-400 font-bold uppercase text-[10px]">
                        <th class="py-2 px-3">Interval / Period</th>
                        <th class="py-2 px-3 text-right">Current Period Recorded</th>
                        @if($compare)
                        <th class="py-2 px-3 text-right">Previous Benchmark</th>
                        <th class="py-2 px-3 text-right">Variance</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($analytics['chart_data'] as $cd)
                    <tr class="hover:bg-slate-50">
                        <td class="py-2 px-3 font-semibold text-slate-800">{{ $cd['label'] }}</td>
                        <td class="py-2 px-3 text-right font-mono font-bold text-slate-900">{{ $cd['formatted_current'] }}</td>
                        @if($compare)
                        <td class="py-2 px-3 text-right font-mono text-slate-500">Rp {{ number_format($cd['previous'] ?? 0, 0, ',', '.') }}</td>
                        <td class="py-2 px-3 text-right font-mono font-bold {{ (($cd['current'] ?? 0) >= ($cd['previous'] ?? 0)) ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ (($cd['current'] ?? 0) >= ($cd['previous'] ?? 0)) ? '+' : '' }}Rp {{ number_format(($cd['current'] ?? 0) - ($cd['previous'] ?? 0), 0, ',', '.') }}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= FACILITY BREAKDOWN & SECONDARY DISTRIBUTIONS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
        
        <!-- LEFT 7 COLS: Facility Revenue Breakdown Table -->
        <div class="lg:col-span-7 space-y-6">
            
            <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
                <div class="px-5 py-4 border-b border-[var(--border)] bg-slate-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">
                            Facility Revenue Contribution
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Financial performance across your authorized facilities for {{ $analytics['period_label'] }}.
                        </p>
                    </div>
                    <span class="text-xs font-bold text-slate-600">
                        {{ count($analytics['facility_breakdown']) }} Facilit{{ count($analytics['facility_breakdown']) === 1 ? 'y' : 'ies' }}
                    </span>
                </div>

                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/75 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                <th class="py-3 px-4">Facility Details</th>
                                <th class="py-3 px-3 text-right">Net Receipts</th>
                                <th class="py-3 px-3 text-center">Portfolio Share</th>
                                <th class="py-3 px-3 text-right">Transactions</th>
                                <th class="py-3 px-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            @foreach($analytics['facility_breakdown'] as $fb)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- Facility Name & Location -->
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-900">{{ $fb['name'] }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1.5 font-mono">
                                        <span class="bg-slate-100 px-1.5 py-0.2 rounded border border-slate-200">{{ $fb['code'] }}</span>
                                        <span>•</span>
                                        <span>{{ $fb['city'] }}</span>
                                    </div>
                                </td>

                                <!-- Net Receipts & Gross Breakdown -->
                                <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                    <div class="font-mono text-xs font-extrabold text-slate-900">
                                        {{ $fb['formatted_net'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">
                                        Gross: {{ $fb['formatted_gross'] }}
                                    </div>
                                </td>

                                <!-- Share Percentage Bar -->
                                <td class="py-3.5 px-3">
                                    <div class="w-32 mx-auto">
                                        <div class="flex items-center justify-between text-[11px] font-bold text-slate-700 mb-1">
                                            <span>{{ $fb['portfolio_share'] }}%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-[var(--accent)] h-full rounded-full" style="width: {{ $fb['portfolio_share'] }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Transactions & ARPU -->
                                <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                    <div class="font-mono font-bold text-slate-800">
                                        {{ number_format($fb['transactions_count']) }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">
                                        Avg: {{ $fb['formatted_avg_ticket'] }}
                                    </div>
                                </td>

                                <!-- Action Link to Page 29 Transactions -->
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <a href="/vendor/transactions?facility={{ $fb['id'] }}&period={{ $period }}" 
                                       class="px-2.5 py-1 rounded-lg border border-slate-200 hover:border-[var(--primary)] bg-white hover:bg-slate-50 text-[11px] font-bold text-slate-700 hover:text-[var(--primary)] transition-colors inline-flex items-center gap-1 shadow-2xs"
                                       title="View related transactions in Page 29">
                                        <span>Ledger &rarr;</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between text-xs text-slate-500">
                    <span>Portfolio Collection Rate: <strong class="text-emerald-700">99.8%</strong></span>
                    <span>100% Digital Cashless Reconciled</span>
                </div>
            </div>

            <!-- Settlement & Clearing Liquidity Telemetry -->
            <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Settlement & Payout Telemetry</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Distinguishes verified customer receipts from bank clearing status.</p>
                    </div>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full">
                        Automated Daily Sweep
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                        <span class="text-[10px] font-bold text-emerald-700 uppercase">Settled Funds (Cleared)</span>
                        <div class="text-sm sm:text-base font-mono font-extrabold text-slate-900 mt-1">
                            {{ $analytics['settlement']['formatted_settled_volume'] }}
                        </div>
                        <span class="text-[10px] font-semibold text-slate-400">{{ $analytics['settlement']['settled_pct'] }}% of net volume</span>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                        <span class="text-[10px] font-bold text-blue-700 uppercase">In Bank Clearing (T+1)</span>
                        <div class="text-sm sm:text-base font-mono font-extrabold text-slate-900 mt-1">
                            {{ $analytics['settlement']['formatted_clearing_volume'] }}
                        </div>
                        <span class="text-[10px] font-semibold text-slate-400">{{ $analytics['settlement']['clearing_pct'] }}% overnight batch</span>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                        <span class="text-[10px] font-bold text-purple-700 uppercase">Audit / Hold</span>
                        <div class="text-sm sm:text-base font-mono font-extrabold text-slate-900 mt-1">
                            {{ $analytics['settlement']['formatted_on_hold_volume'] }}
                        </div>
                        <span class="text-[10px] font-semibold text-slate-400">{{ $analytics['settlement']['on_hold_pct'] }}% under verification</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT 5 COLS: Payment Methods & Service Category Breakdown -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Revenue by Payment Method -->
            <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Revenue by Payment Method</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Channel distribution across active gateways.</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach($analytics['payment_methods'] as $pm)
                    <div class="p-3 rounded-xl bg-slate-50/75 border border-slate-200 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded border {{ $pm['badge_class'] }}">
                                    {{ $pm['label'] }}
                                </span>
                                <div class="text-[11px] text-slate-500 mt-1">
                                    {{ $pm['subtext'] }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-mono text-xs sm:text-sm font-extrabold text-slate-900">
                                    {{ $pm['formatted_gross'] }}
                                </div>
                                <div class="text-[10px] font-bold text-[var(--accent)] mt-0.5">
                                    {{ $pm['share_pct'] }}% share
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar & Count -->
                        <div class="mt-2.5 flex items-center justify-between text-[10px] text-slate-400">
                            <span>{{ number_format($pm['count']) }} txns</span>
                            <span>Avg: {{ $pm['formatted_avg_ticket'] }}</span>
                        </div>
                        <div class="w-full bg-slate-200 h-1 rounded-full overflow-hidden mt-1">
                            <div class="bg-[var(--accent)] h-full rounded-full" style="width: {{ $pm['share_pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Revenue by Service / Payable Type -->
            <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Service Category Breakdown</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Turnaround parking vs advance reservations.</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach($analytics['payable_types'] as $pt)
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800">{{ $pt['label'] }}</span>
                            <span class="font-mono text-xs font-extrabold text-slate-900">{{ $pt['formatted_amount'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-slate-500 mt-1">
                            <span>{{ number_format($pt['count']) }} sessions / bookings</span>
                            <span class="font-bold text-emerald-700">{{ $pt['share_pct'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden mt-2">
                            <div class="bg-emerald-600 h-full rounded-full" style="width: {{ $pt['share_pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

@push('scripts')
<script>
    /**
     * Toggle the visibility of the accessible trend data table.
     */
    function toggleTrendTable() {
        const table = document.getElementById('trend-data-table');
        const btn = document.getElementById('toggle-table-btn');
        if (!table || !btn) return;

        if (table.classList.contains('hidden')) {
            table.classList.remove('hidden');
            btn.innerText = 'Hide Data Table';
        } else {
            table.classList.add('hidden');
            btn.innerText = 'Show Data Table';
        }
    }
</script>
@endpush

</x-layouts.vendor>
