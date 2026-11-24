<x-layouts.admin activeNav="dashboard" title="National Dashboard — Super Admin NusaPark">

    <!-- ================= PAGE HEADER & CONTROLS ================= -->
    <div class="space-y-4 mb-6">
        
        <!-- Breadcrumb & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <span class="font-medium text-slate-400">NusaPark Platform</span>
                <span>/</span>
                <span class="font-medium text-slate-400">Super Admin</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">National Dashboard</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>All Core Systems Operational</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px] hidden md:inline">
                    Updated: <strong class="text-slate-700 font-mono">{{ $data['last_updated'] }}</strong>
                </span>
            </div>
        </div>

        <!-- Page Title & Reporting Filters Row -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        National Dashboard
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Executive Ops
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    Platform-wide multi-tenant monitoring, national occupancy, IoT telemetry, and revenue oversight across Indonesia.
                </p>
            </div>

            <!-- Filters & Actions -->
            <form method="GET" action="{{ route('admin.dashboard') }}" id="filterForm" class="flex flex-wrap items-center gap-2 sm:gap-3 shrink-0">
                
                <!-- Region Selector -->
                <div class="relative">
                    <label for="regionSelect" class="sr-only">Geographic Region</label>
                    <select name="region" 
                            id="regionSelect"
                            onchange="this.form.submit()"
                            class="bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl px-3 py-2 pr-8 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 appearance-none cursor-pointer">
                        @foreach($regions as $rKey => $rLabel)
                            <option value="{{ $rKey }}" {{ $region === $rKey ? 'selected' : '' }}>
                                {{ $rLabel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Reporting Period Pills -->
                <div class="inline-flex p-1 bg-slate-100 rounded-xl border border-slate-200 text-xs font-semibold">
                    @foreach($periods as $pKey => $pLabel)
                        <button type="submit" 
                                name="period" 
                                value="{{ $pKey }}"
                                class="px-2.5 py-1 rounded-lg transition-all {{ $period === $pKey ? 'bg-white text-indigo-700 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                            {{ match($pKey) { 'today' => 'Today', '7d' => 'Last 7D', '30d' => 'Last 30D', 'mtd' => 'MTD', default => $pKey } }}
                        </button>
                    @endforeach
                </div>

                <!-- Manual Refresh Button -->
                <a href="{{ route('admin.dashboard', ['period' => $period, 'region' => $region, 'refresh' => '1']) }}" 
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors"
                   title="Force recalculation and purge cache">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="hover:rotate-180 transition-transform duration-500">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                    </svg>
                    <span class="hidden sm:inline">Refresh</span>
                </a>

                <!-- Metric Info Trigger -->
                <button type="button" 
                        onclick="document.getElementById('metricDefinitionsModal').classList.remove('hidden')"
                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl border border-slate-200 transition-colors"
                        title="View Metric Calculation Definitions">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- ================= SECTION 1: NATIONAL KPI OVERVIEW ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- KPI 1: Operator Tenant Ecosystem -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-indigo-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Tenant Ecosystem</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                        {{ $data['kpis']['active_vendors'] }} Active
                    </span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $data['kpis']['total_vendors'] }}
                    </span>
                    <span class="text-xs text-slate-500 font-medium">Operators Registered</span>
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Total Locations</div>
                        <div class="font-bold text-slate-800">{{ $data['kpis']['total_locations'] }} Facilities</div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Operational</div>
                        <div class="font-bold text-emerald-600">{{ $data['kpis']['operational_locations'] }} Online ({{ $data['kpis']['location_health_rate'] }}%)</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-slate-400 flex items-center justify-between">
                <span>{{ $data['kpis']['onboarding_vendors'] }} in onboarding / grace</span>
                <span class="text-amber-600 font-medium">{{ $data['kpis']['attention_locations'] }} need review</span>
            </div>
        </div>

        <!-- KPI 2: Live National Occupancy & Capacity -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Live National Occupancy</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        {{ $data['kpis']['occupancy_status'] }}
                    </span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ number_format($data['kpis']['current_occupied'], 0, ',', '.') }}
                    </span>
                    <span class="text-xs text-slate-500 font-medium">/ {{ number_format($data['kpis']['total_capacity'], 0, ',', '.') }} Bays</span>
                </div>

                <!-- Progress bar -->
                <div class="mt-2.5">
                    <div class="flex items-center justify-between text-[11px] font-medium text-slate-500 mb-1">
                        <span>National Saturation</span>
                        <span class="font-bold text-slate-800 font-mono">{{ $data['kpis']['occupancy_rate'] }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" style="width: {{ min(100, $data['kpis']['occupancy_rate']) }}%"></div>
                    </div>
                </div>

                <div class="mt-3 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Available Bays</div>
                        <div class="font-bold text-slate-800 font-mono">{{ number_format($data['kpis']['current_available'], 0, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Active Sessions</div>
                        <div class="font-bold text-indigo-600 font-mono">{{ $data['kpis']['formatted_active_sessions'] }}</div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-[10px] text-slate-400">
                Authoritative real-time sensor & gate telemetry snapshot.
            </div>
        </div>

        <!-- KPI 3: Period Parking Traffic & Sessions -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-blue-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Traffic ({{ $data['period_label'] }})</span>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        {{ $data['kpis']['session_growth'] }}
                    </span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $data['kpis']['formatted_sessions'] }}
                    </span>
                    <span class="text-xs text-slate-500 font-medium">Vehicles Parked</span>
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Avg Dwell Time</div>
                        <div class="font-bold text-slate-800 font-mono">{{ $data['kpis']['avg_dwell_time'] }}</div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Turnover Velocity</div>
                        <div class="font-bold text-slate-800 font-mono">{{ $data['kpis']['turnover_rate'] }}</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-slate-400 flex items-center justify-between">
                <span>{{ number_format($data['kpis']['completed_sessions'], 0, ',', '.') }} completed exits</span>
                <span class="font-mono text-slate-600 font-medium">{{ $data['kpis']['formatted_active_sessions'] }} parked</span>
            </div>
        </div>

        <!-- KPI 4: Financial Overview (GTV & Commission) -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
            <div>
                <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                    <span>Gross Transaction Value</span>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600">
                        {{ $data['kpis']['financial_growth'] }}
                    </span>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono">
                        {{ $data['kpis']['formatted_gtv'] }}
                    </span>
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">Platform Fee (3.5%)</div>
                        <div class="font-bold text-indigo-700 font-mono text-[11px] truncate">
                            {{ $data['kpis']['formatted_platform_fee'] }}
                        </div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-medium">SaaS MRR</div>
                        <div class="font-bold text-slate-800 font-mono text-[11px] truncate">
                            {{ $data['kpis']['formatted_saas_mrr'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-[10px] text-slate-400">
                GTV includes all parking customer payments across {{ $data['kpis']['active_vendors'] }} operators.
            </div>
        </div>

    </div>

    <!-- ================= SECTION 2: NATIONAL ACTIVITY TRENDS ================= -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-base font-bold text-slate-900 tracking-tight">
                        National Activity & Traffic Velocity
                    </h2>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                        {{ match($data['trends']['type']) { 'daily' => 'Daily Interval', 'weekly' => 'Weekly Interval', default => '2-Hour Windows' } }}
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">
                    Correlated parking session entries and Gross Transaction Value distribution across {{ $data['period_label'] }}.
                </p>
            </div>

            <!-- Legend & Stats -->
            <div class="flex items-center gap-4 text-xs">
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-xs bg-indigo-600"></span>
                    <span class="text-slate-600 font-medium">Sessions</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-xs bg-amber-400"></span>
                    <span class="text-slate-600 font-medium">GTV Volume (Mio Rp)</span>
                </div>
            </div>
        </div>

        <!-- Visual Bar Chart -->
        <div class="pt-6">
            <div class="h-64 sm:h-72 w-full flex items-end gap-2 sm:gap-4 px-2 pb-2 border-b border-slate-200 relative">
                
                @php
                    $maxSessions = max($data['trends']['sessions']) ?: 1;
                    $maxGtv = max($data['trends']['gtv_millions']) ?: 1;
                @endphp

                <!-- Gridlines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-20">
                    <div class="border-b border-slate-300 w-full"></div>
                    <div class="border-b border-slate-300 w-full"></div>
                    <div class="border-b border-slate-300 w-full"></div>
                    <div class="border-b border-slate-300 w-full"></div>
                </div>

                @foreach($data['trends']['labels'] as $idx => $lbl)
                    @php
                        $sess = $data['trends']['sessions'][$idx];
                        $gtvM = $data['trends']['gtv_millions'][$idx];
                        $occ = $data['trends']['occupancy_peaks'][$idx] ?? 0;
                        $sessHeight = round(($sess / $maxSessions) * 88);
                        $gtvHeight = round(($gtvM / $maxGtv) * 88);
                    @endphp
                    <div class="flex-1 flex flex-col items-center h-full justify-end group relative cursor-pointer">
                        
                        <!-- Tooltip -->
                        <div class="absolute bottom-full mb-2 hidden group-hover:flex flex-col items-center z-30 pointer-events-none">
                            <div class="bg-slate-900 text-white text-[10px] rounded-lg p-2 shadow-xl whitespace-nowrap space-y-0.5">
                                <div class="font-bold text-slate-300 border-b border-slate-700 pb-1 mb-1 font-mono">
                                    {{ $lbl }}
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-indigo-400">Sessions:</span>
                                    <span class="font-bold font-mono">{{ number_format($sess, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-amber-400">GTV:</span>
                                    <span class="font-bold font-mono">Rp {{ number_format($gtvM, 0, ',', '.') }} M</span>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-emerald-400">Peak Occ:</span>
                                    <span class="font-bold font-mono">{{ $occ }}%</span>
                                </div>
                            </div>
                            <div class="w-2 h-2 bg-slate-900 rotate-45 -mt-1"></div>
                        </div>

                        <!-- Paired Bars -->
                        <div class="w-full flex items-end justify-center gap-1 h-full pb-1">
                            <!-- Sessions Bar -->
                            <div class="w-2.5 sm:w-4 bg-indigo-600 hover:bg-indigo-700 rounded-t-sm transition-all"
                                 style="height: {{ max(4, $sessHeight) }}%"></div>
                            <!-- GTV Bar -->
                            <div class="w-2.5 sm:w-4 bg-amber-400 hover:bg-amber-500 rounded-t-sm transition-all"
                                 style="height: {{ max(4, $gtvHeight) }}%"></div>
                        </div>

                        <!-- X-Axis Label -->
                        <span class="text-[10px] sm:text-[11px] text-slate-500 font-mono mt-2 truncate w-full text-center">
                            {{ $lbl }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Trend Summary Badges -->
        <div class="mt-4 pt-3 border-t border-slate-100 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">
                <div class="text-[10px] text-slate-400 font-medium uppercase">Peak Interval</div>
                <div class="font-bold text-slate-800 mt-0.5 truncate">{{ $data['trends']['summary']['peak_hour'] ?? $data['trends']['summary']['peak_day'] ?? '18:00 - 20:00' }}</div>
            </div>
            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">
                <div class="text-[10px] text-slate-400 font-medium uppercase">Interval GTV Record</div>
                <div class="font-bold text-slate-800 font-mono mt-0.5">{{ $data['trends']['summary']['peak_gtv'] ?? 'Rp 121.200.000' }}</div>
            </div>
            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">
                <div class="text-[10px] text-slate-400 font-medium uppercase">Traffic Pattern</div>
                <div class="font-bold text-indigo-700 mt-0.5">{{ $data['trends']['summary']['lunch_peak'] ?? $data['trends']['summary']['weekday_vs_weekend_delta'] ?? 'Normal Flow' }}</div>
            </div>
            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">
                <div class="text-[10px] text-slate-400 font-medium uppercase">Operations Assessment</div>
                <div class="font-bold text-emerald-700 mt-0.5 truncate">{{ $data['trends']['summary']['current_trend'] ?? 'Stable' }}</div>
            </div>
        </div>
    </div>

    <!-- ================= SECTION 3: TWO-COLUMN OPERATIONS CENTER ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        
        <!-- LEFT COLUMN: Geographic & Vendor Ecosystem (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Regional Breakdown Table -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Geographic Distribution by Province
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Authoritative multi-provincial capacity, live occupancy, and GTV.
                        </p>
                    </div>
                    <span class="text-xs text-slate-400 font-mono">6 Jurisdictions</span>
                </div>

                <div class="divide-y divide-slate-100 mt-3">
                    @foreach($data['geographic'] as $geo)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/80 px-2 rounded-xl transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                                {{ strtoupper(substr($geo['id'], 0, 2)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-900">{{ $geo['name'] }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">({{ $geo['tag'] }})</span>
                                </div>
                                <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                                    <span><strong>{{ $geo['locations_count'] }}</strong> Locations</span>
                                    <span>•</span>
                                    <span><strong>{{ number_format($geo['total_capacity'], 0, ',', '.') }}</strong> Bays</span>
                                    @if($geo['alerts_count'] > 0)
                                    <span>•</span>
                                    <span class="text-amber-600 font-medium">{{ $geo['alerts_count'] }} Alerts</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Occupancy & Revenue -->
                        <div class="flex items-center justify-between sm:justify-end gap-4 shrink-0">
                            <!-- Occupancy Gauge -->
                            <div class="w-28 text-right">
                                <div class="text-[11px] font-bold text-slate-800 font-mono">
                                    {{ $geo['occupancy_rate'] }}% Occ
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-1 overflow-hidden">
                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $geo['occupancy_rate'] }}%"></div>
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ number_format($geo['occupied'], 0, ',', '.') }} bays
                                </div>
                            </div>

                            <!-- Period GTV -->
                            <div class="w-32 text-right">
                                <div class="text-xs font-bold font-mono text-slate-900">
                                    {{ $geo['formatted_gtv'] }}
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    {{ number_format($geo['period_sessions'], 0, ',', '.') }} sessions
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Operator Tenants Summary Table -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Operator Tenant Network
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Active parking management enterprises on NusaPark SaaS platform.
                        </p>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                        {{ count($data['tenants']) }} of {{ $data['kpis']['total_vendors'] }} Displayed
                    </span>
                </div>

                <div class="overflow-x-auto mt-3">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 font-bold uppercase text-[10px] border-b border-slate-100">
                                <th class="pb-2">Operator / Brand</th>
                                <th class="pb-2">Tier & City</th>
                                <th class="pb-2 text-right">Facilities</th>
                                <th class="pb-2 text-right">Active Bays</th>
                                <th class="pb-2 text-right">SLA</th>
                                <th class="pb-2 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($data['tenants'] as $t)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-2.5">
                                    <div class="font-bold text-slate-900">{{ $t['company_name'] }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $t['brand_name'] }} • {{ $t['id'] }}</div>
                                </td>
                                <td class="py-2.5">
                                    <div class="text-slate-700 font-medium">{{ $t['tier'] }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $t['city'] }}</div>
                                </td>
                                <td class="py-2.5 text-right font-mono font-bold text-slate-800">
                                    {{ $t['facilities_count'] }}
                                </td>
                                <td class="py-2.5 text-right">
                                    <div class="font-mono font-bold text-slate-800">{{ number_format($t['active_sessions'], 0, ',', '.') }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">/ {{ number_format($t['total_bays'], 0, ',', '.') }}</div>
                                </td>
                                <td class="py-2.5 text-right font-mono text-emerald-600 font-bold">
                                    {{ $t['sla_health'] }}
                                </td>
                                <td class="py-2.5 text-center">
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold {{ $t['status'] === 'Active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                        {{ $t['status'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Methods & Settlement Breakdown -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Payment Distribution & Settlement Health
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Authoritative national transaction settlement and payment channel breakdown.
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-mono text-emerald-600 font-bold">
                            {{ $data['financials']['settlement']['settled_rate'] }} Settled
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                    @foreach($data['financials']['payment_methods'] as $pm)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold text-slate-800">{{ $pm['method'] }}</div>
                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $pm['amount'] }}</div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-indigo-700 font-mono">{{ $pm['share'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-3 text-[10px] text-slate-400 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    {{ $data['financials']['disclaimer'] }}
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Hardware Fleet, Alerts & Audit Feed (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- IoT Device Fleet Health -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-slate-900 tracking-tight">
                                IoT Fleet Health
                            </h2>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Real-time hardware inventory and telemetry SLA.
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-mono font-bold text-emerald-600">{{ $data['iot_health']['uptime_rate'] }}% Online</div>
                        <div class="text-[10px] text-slate-400 font-mono">{{ $data['iot_health']['average_ping_ms'] }}ms Latency</div>
                    </div>
                </div>

                <!-- Totals Grid -->
                <div class="grid grid-cols-4 gap-2 my-4 text-center">
                    <div class="p-2 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div class="text-[10px] text-slate-400 uppercase font-semibold">Total</div>
                        <div class="font-bold text-slate-800 font-mono text-sm mt-0.5">{{ number_format($data['iot_health']['total_devices'], 0, ',', '.') }}</div>
                    </div>
                    <div class="p-2 bg-emerald-50/60 rounded-xl border border-emerald-200/60">
                        <div class="text-[10px] text-emerald-700 uppercase font-semibold">Online</div>
                        <div class="font-bold text-emerald-700 font-mono text-sm mt-0.5">{{ number_format($data['iot_health']['online'], 0, ',', '.') }}</div>
                    </div>
                    <div class="p-2 bg-amber-50/60 rounded-xl border border-amber-200/60">
                        <div class="text-[10px] text-amber-700 uppercase font-semibold">Warning</div>
                        <div class="font-bold text-amber-700 font-mono text-sm mt-0.5">{{ $data['iot_health']['warning'] }}</div>
                    </div>
                    <div class="p-2 bg-rose-50/60 rounded-xl border border-rose-200/60">
                        <div class="text-[10px] text-rose-700 uppercase font-semibold">Offline</div>
                        <div class="font-bold text-rose-700 font-mono text-sm mt-0.5">{{ $data['iot_health']['offline'] }}</div>
                    </div>
                </div>

                <!-- Hardware Categories -->
                <div class="space-y-2.5">
                    @foreach($data['iot_health']['categories'] as $cat)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between text-xs">
                        <div>
                            <div class="font-bold text-slate-800">{{ $cat['name'] }}</div>
                            <div class="text-[10px] text-slate-400 font-mono">{{ $cat['protocol'] }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-mono font-bold text-slate-900">
                                <span class="text-emerald-600">{{ $cat['online'] }}</span>
                                <span class="text-slate-400 font-normal">/ {{ $cat['total'] }}</span>
                            </div>
                            <div class="text-[10px] font-mono text-slate-500">{{ $cat['availability'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-3 text-[10px] text-slate-400 italic">
                    {{ $data['iot_health']['disclaimer'] }}
                </div>
            </div>

            <!-- Platform Operational Alerts & Attention -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-slate-900 tracking-tight">
                                Platform Alerts & Incidents
                            </h2>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                {{ count($data['alerts']) }} Active
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Cross-tenant hardware anomalies and critical events.
                        </p>
                    </div>
                </div>

                <div class="space-y-3 mt-3">
                    @foreach($data['alerts'] as $al)
                    <div class="p-3.5 rounded-xl border {{ $al['severity'] === 'critical' ? 'bg-rose-50/50 border-rose-200' : ($al['severity'] === 'warning' ? 'bg-amber-50/50 border-amber-200' : 'bg-blue-50/50 border-blue-200') }}">
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-1.5">
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase font-mono {{ $al['severity'] === 'critical' ? 'bg-rose-100 text-rose-800' : ($al['severity'] === 'warning' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ $al['severity'] }}
                                </span>
                                <span class="font-mono text-[10px] text-slate-400">{{ $al['id'] }}</span>
                            </div>
                            <span class="text-[10px] text-slate-400">{{ $al['timestamp'] }}</span>
                        </div>
                        <div class="text-xs font-bold text-slate-900 leading-snug">{{ $al['title'] }}</div>
                        <div class="text-[11px] text-slate-600 mt-1 leading-normal">{{ $al['message'] }}</div>
                        <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px]">
                            <span class="text-slate-500 font-medium truncate max-w-[60%]">{{ $al['location'] }}</span>
                            <span class="text-indigo-600 font-bold hover:underline cursor-pointer" onclick="openAlertModal('{{ $al['id'] }}', '{{ addslashes($al['title']) }}', '{{ addslashes($al['location']) }}', '{{ addslashes($al['message']) }}', '{{ $al['status'] }}')">
                                {{ $al['action_label'] }} &rarr;
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Platform Audit Feed -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Platform Event Stream
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Audit trail of multi-tenant administrative and automated actions.
                        </p>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                </div>

                <div class="divide-y divide-slate-100 mt-2">
                    @foreach($data['audit_feed'] as $evt)
                    <div class="py-2.5 flex items-start gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-1.5 shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-900">{{ $evt['type'] }}</span>
                                <span class="text-[10px] font-mono text-slate-400">{{ $evt['time'] }}</span>
                            </div>
                            <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">{{ $evt['description'] }}</p>
                            <div class="text-[10px] text-slate-400 mt-1 flex items-center gap-1.5 font-mono">
                                <span>Actor: {{ $evt['actor'] }}</span>
                                <span>•</span>
                                <span class="text-indigo-600">{{ $evt['badge'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    <!-- ================= METRIC DEFINITIONS MODAL ================= -->
    <div id="metricDefinitionsModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">National Metric Definitions</h3>
                        <p class="text-xs text-slate-500">Authoritative calculation rules and data standards.</p>
                    </div>
                </div>
                <button type="button" 
                        onclick="document.getElementById('metricDefinitionsModal').classList.add('hidden')"
                        class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="space-y-3.5 my-4 text-xs max-h-[60vh] overflow-y-auto pr-1">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="font-bold text-slate-900">Gross Transaction Value (GTV) vs Platform Revenue</div>
                    <p class="text-slate-600 mt-1">GTV encompasses the cumulative parking payments made by drivers. NusaPark Platform Revenue comprises the 3.5% PG & Platform commission plus tenant SaaS subscription MRR.</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="font-bold text-slate-900">Active Vendor vs Registered Operator</div>
                    <p class="text-slate-600 mt-1">An operator is active when it maintains at least 1 verified facility transmitting live gate or sensor telemetry within the past 24 hours.</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="font-bold text-slate-900">National Live Occupancy</div>
                    <p class="text-slate-600 mt-1">Calculated as currently occupied bays divided by authoritative bay capacity across all operational facilities. Does not infer vehicle occupancy merely from camera online status.</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="font-bold text-slate-900">IoT Hardware Health & Telemetry SLA</div>
                    <p class="text-slate-600 mt-1">Device connectivity is measured via MQTT/RS-485 ping responses. Network connectivity is kept strictly distinct from physical gate barrier mechanics.</p>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-end">
                <button type="button" 
                        onclick="document.getElementById('metricDefinitionsModal').classList.add('hidden')"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors">
                    Close Definitions
                </button>
            </div>
        </div>
    </div>

    <!-- ================= ALERT DETAILS MODAL ================= -->
    <div id="alertDetailModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <span id="modalAlertId" class="text-[10px] font-mono text-slate-400 uppercase">ALT-XXXX</span>
                    <h3 id="modalAlertTitle" class="text-base font-bold text-slate-900">Incident Details</h3>
                </div>
                <button type="button" onclick="closeAlertModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="my-4 space-y-3 text-xs">
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Location / Target</div>
                    <div id="modalAlertLocation" class="font-bold text-slate-800 mt-0.5">-</div>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Diagnostic Message</div>
                    <div id="modalAlertMsg" class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 mt-0.5 leading-relaxed">-</div>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Resolution Status</div>
                    <span id="modalAlertStatus" class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 mt-1">Investigating</span>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <button type="button" onclick="acknowledgeAlert()" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs transition-colors">
                    Acknowledge Incident
                </button>
                <button type="button" onclick="closeAlertModal()" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openAlertModal(id, title, location, msg, status) {
            document.getElementById('modalAlertId').textContent = id;
            document.getElementById('modalAlertTitle').textContent = title;
            document.getElementById('modalAlertLocation').textContent = location;
            document.getElementById('modalAlertMsg').textContent = msg;
            document.getElementById('modalAlertStatus').textContent = status;
            document.getElementById('alertDetailModal').classList.remove('hidden');
        }

        function closeAlertModal() {
            document.getElementById('alertDetailModal').classList.add('hidden');
        }

        function acknowledgeAlert() {
            alert('Incident acknowledged by Super Admin. Telemetry flagged for resolution tracking.');
            closeAlertModal();
        }
    </script>
    @endpush

</x-layouts.admin>
