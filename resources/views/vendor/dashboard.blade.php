<x-layouts.vendor activeNav="dashboard">
    <div class="space-y-6 md:space-y-8">

        <!-- ================= TOP HEADER & OPERATIONAL CONTROLS ================= -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-2 border-b border-[var(--border)]">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Live Operations
                    </span>
                    <span class="text-xs text-[var(--text-muted)]">Tenant ID: {{ $tenant['id'] }}</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)] mt-1">
                    {{ $selectedFacility ? $selectedFacility['name'] : 'Vendor Operations Dashboard' }}
                </h1>
                <p class="text-xs md:text-sm text-[var(--text-muted)] mt-0.5">
                    Real-time barrier telemetry, slot occupancy, gate throughput, and verified revenue.
                </p>
            </div>

            <!-- Operational Controls (Facility Selector, Period & Refresh) -->
            <form method="GET" action="/vendor/dashboard" class="flex flex-wrap items-center gap-2.5 self-start lg:self-auto">
                
                <!-- Facility Filter -->
                <div class="relative">
                    <select name="facility" 
                            onchange="this.form.submit()"
                            class="appearance-none pl-3 pr-8 py-2 bg-[var(--surface)] border border-[var(--border)] rounded-xl text-xs font-semibold text-[var(--text)] hover:border-[var(--primary)] focus:outline-none focus:ring-1 focus:ring-[var(--primary)] transition-all cursor-pointer shadow-xs">
                        <option value="all" {{ $currentFacility === 'all' ? 'selected' : '' }}>
                            All Managed Facilities (3)
                        </option>
                        @foreach($facilities as $fac)
                            <option value="{{ $fac['id'] }}" {{ $currentFacility === $fac['id'] ? 'selected' : '' }}>
                                {{ $fac['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <!-- Date Period Filter -->
                <div class="relative">
                    <select name="period" 
                            onchange="this.form.submit()"
                            class="appearance-none pl-3 pr-8 py-2 bg-[var(--surface)] border border-[var(--border)] rounded-xl text-xs font-semibold text-[var(--text)] hover:border-[var(--primary)] focus:outline-none focus:ring-1 focus:ring-[var(--primary)] transition-all cursor-pointer shadow-xs">
                        <option value="today" {{ $currentPeriod === 'today' ? 'selected' : '' }}>Today (Live)</option>
                        <option value="yesterday" {{ $currentPeriod === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                        <option value="7days" {{ $currentPeriod === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="month" {{ $currentPeriod === 'month' ? 'selected' : '' }}>October 2026</option>
                    </select>
                    <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <!-- Manual Refresh Action -->
                <button type="submit" 
                        title="Fetch latest barrier & sensor telemetry"
                        class="inline-flex items-center gap-1.5 px-3 py-2 bg-[var(--surface)] hover:bg-slate-50 text-slate-700 border border-[var(--border)] rounded-xl text-xs font-semibold transition-all shadow-xs cursor-pointer">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M23 4v6h-6"></path>
                        <path d="M1 20v-6h6"></path>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                    </svg>
                    <span class="hidden sm:inline">Refresh</span>
                </button>
            </form>
        </div>

        <!-- Notification Banner if Roadmap destination clicked -->
        @if(request()->query('notice'))
            <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span>This module is part of the vendor operations roadmap (Phases 21–25). Current active dashboard displays all authoritative metrics.</span>
                </div>
                <a href="/vendor/dashboard" class="font-bold underline">Dismiss</a>
            </div>
        @endif

        <!-- ================= PRIMARY KPI SUMMARY CARDS ================= -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            
            <!-- 1. Live Occupancy Rate -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Live Occupancy</span>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)]">
                        {{ $metrics['occupancy_rate'] }}%
                    </span>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-bold text-[var(--text)]">{{ number_format($metrics['occupied']) }}</span>
                        <span class="text-xs text-slate-400">/ {{ number_format($metrics['total_capacity']) }} slots</span>
                    </div>
                    <!-- Mini Progress Bar -->
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-2">
                        <div class="bg-[var(--accent)] h-full rounded-full" style="width: {{ $metrics['occupancy_rate'] }}%"></div>
                    </div>
                    <span class="text-[11px] font-semibold text-emerald-600 mt-2 block">
                        {{ number_format($metrics['available']) }} spaces available
                    </span>
                </div>
            </div>

            <!-- 2. Active Parking Sessions -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Active Sessions</span>
                    <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="text-2xl font-bold text-[var(--text)]">{{ number_format($metrics['active_sessions']) }}</div>
                    <span class="text-[11px] text-[var(--text-muted)] mt-1 block">Vehicles currently on-site</span>
                    <div class="text-[10px] text-purple-700 font-semibold mt-1">
                        +{{ $metrics['reserved'] }} advance bookings
                    </div>
                </div>
            </div>

            <!-- 3. Today's Gate Traffic -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Gate Traffic</span>
                    <div class="w-6 h-6 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-2">
                        <span class="text-xl font-bold text-emerald-700">+{{ number_format($metrics['today_entries']) }}</span>
                        <span class="text-xs text-slate-400">In</span>
                    </div>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-sm font-semibold text-slate-600">-{{ number_format($metrics['today_exits']) }}</span>
                        <span class="text-[10px] text-slate-400">Out</span>
                    </div>
                    <span class="text-[10px] text-[var(--text-muted)] mt-1.5 block">Net accumulation +{{ number_format($metrics['today_entries'] - $metrics['today_exits']) }}</span>
                </div>
            </div>

            <!-- 4. Confirmed Revenue -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--accent)]">Confirmed Revenue</span>
                    <div class="w-6 h-6 rounded-md bg-blue-50 text-[var(--accent)] flex items-center justify-center">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="text-xl font-bold text-[var(--primary)] truncate">{{ $metrics['formatted_revenue'] }}</div>
                    <span class="text-[10px] text-slate-400 mt-1 block">{{ $metrics['period_label'] }}</span>
                    <span class="text-[10px] font-semibold text-emerald-600 mt-1 block">100% Cashless Verified</span>
                </div>
            </div>

            <!-- 5. Hardware & IoT Telemetry -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">Device Health</span>
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-1.5 py-0.5 rounded {{ $metrics['hardware']['health_rate'] >= 95 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                        {{ $metrics['hardware']['health_rate'] }}%
                    </span>
                </div>
                <div class="mt-3">
                    <div class="text-xs font-semibold text-[var(--text)] flex items-center justify-between">
                        <span>Barrier Gates:</span>
                        <span class="font-bold text-emerald-600">{{ $metrics['hardware']['gates_online'] }}/{{ $metrics['hardware']['gates_total'] }} Online</span>
                    </div>
                    <div class="text-xs font-semibold text-[var(--text)] flex items-center justify-between mt-1">
                        <span>ANPR Cameras:</span>
                        <span class="font-bold {{ $metrics['hardware']['cameras_online'] < $metrics['hardware']['cameras_total'] ? 'text-amber-600' : 'text-emerald-600' }}">
                            {{ $metrics['hardware']['cameras_online'] }}/{{ $metrics['hardware']['cameras_total'] }} Online
                        </span>
                    </div>
                    <span class="text-[10px] text-slate-400 mt-2 block">Ultrasonic sensors active</span>
                </div>
            </div>

        </div>

        <!-- ================= MAIN DASHBOARD BODY (2 COLUMNS on LG) ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
            
            <!-- LEFT COLUMN (7 COLS): Charts & Live Gate Stream -->
            <div class="lg:col-span-7 space-y-6 md:space-y-8">
                
                <!-- OCCUPANCY & VEHICLE TYPE BREAKDOWN -->
                <div class="dashboard-card p-5 md:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text)]">Capacity Allocation & Vehicle Types</h3>
                            <p class="text-[11px] text-[var(--text-muted)]">Current breakdown across active zones</p>
                        </div>
                        <span class="text-xs font-bold text-slate-600">
                            {{ number_format($metrics['total_capacity']) }} Total Spaces
                        </span>
                    </div>

                    <!-- Multi-segment visual bar -->
                    <div class="space-y-2">
                        <div class="h-4 w-full bg-slate-100 rounded-lg overflow-hidden flex shadow-inner">
                            <div class="bg-[var(--accent)] h-full" style="width: {{ ($metrics['occupied'] / $metrics['total_capacity']) * 100 }}%" title="Occupied: {{ $metrics['occupied'] }}"></div>
                            <div class="bg-emerald-500 h-full" style="width: {{ ($metrics['available'] / $metrics['total_capacity']) * 100 }}%" title="Available: {{ $metrics['available'] }}"></div>
                            <div class="bg-purple-500 h-full" style="width: {{ ($metrics['reserved'] / $metrics['total_capacity']) * 100 }}%" title="Reserved: {{ $metrics['reserved'] }}"></div>
                            <div class="bg-slate-300 h-full" style="width: {{ ($metrics['maintenance'] / $metrics['total_capacity']) * 100 }}%" title="Maintenance: {{ $metrics['maintenance'] }}"></div>
                        </div>

                        <!-- Legend -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pt-1 text-[11px]">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded bg-[var(--accent)]"></span>
                                <span class="text-slate-600">Occupied: <strong>{{ number_format($metrics['occupied']) }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded bg-emerald-500"></span>
                                <span class="text-slate-600">Available: <strong>{{ number_format($metrics['available']) }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded bg-purple-500"></span>
                                <span class="text-slate-600">Reserved: <strong>{{ number_format($metrics['reserved']) }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded bg-slate-300"></span>
                                <span class="text-slate-600">Maint: <strong>{{ number_format($metrics['maintenance']) }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Type Cards -->
                    <div class="grid grid-cols-3 gap-3 pt-4 mt-4 border-t border-[var(--border)]">
                        <div class="p-3 bg-slate-50 rounded-xl text-center">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Passenger Cars</span>
                            <div class="text-lg font-bold text-[var(--text)] mt-0.5">{{ number_format($metrics['vehicle_breakdown']['car']) }}</div>
                            <span class="text-[10px] text-slate-400">Standard Bays</span>
                        </div>
                        <div class="p-3 bg-amber-50/50 rounded-xl text-center">
                            <span class="text-[10px] font-bold text-amber-700 uppercase">Motorcycles</span>
                            <div class="text-lg font-bold text-amber-800 mt-0.5">{{ number_format($metrics['vehicle_breakdown']['motorcycle']) }}</div>
                            <span class="text-[10px] text-slate-400">2-Wheeler Zone</span>
                        </div>
                        <div class="p-3 bg-emerald-50/50 rounded-xl text-center">
                            <span class="text-[10px] font-bold text-emerald-700 uppercase">EV Charging</span>
                            <div class="text-lg font-bold text-emerald-800 mt-0.5">{{ number_format($metrics['vehicle_breakdown']['ev']) }}</div>
                            <span class="text-[10px] text-slate-400">8 Bays Charging</span>
                        </div>
                    </div>
                </div>

                <!-- HOURLY PEAK & TRAFFIC FLOW VISUALIZATION -->
                <div class="dashboard-card p-5 md:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text)]">Today's Hourly In/Out Traffic Flow</h3>
                            <p class="text-[11px] text-[var(--text-muted)]">Vehicle volume captured by smart barrier sensors</p>
                        </div>
                        <span class="text-xs font-bold text-[var(--accent)]">Peak: 10:00 - 11:00 AM</span>
                    </div>

                    <!-- Responsive SVG Area Chart -->
                    <div class="w-full h-48 pt-2">
                        <svg class="w-full h-full overflow-visible" viewBox="0 0 600 160">
                            <!-- Background Grid Lines -->
                            <line x1="0" y1="30" x2="600" y2="30" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="70" x2="600" y2="70" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="110" x2="600" y2="110" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="140" x2="600" y2="140" stroke="#E2E8F0" stroke-width="1" />

                            <!-- Gradient Defs -->
                            <defs>
                                <linearGradient id="trafficGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#2563EB" stop-opacity="0.25"/>
                                    <stop offset="100%" stop-color="#2563EB" stop-opacity="0.0"/>
                                </linearGradient>
                            </defs>

                            <!-- Area polygon for Inflow -->
                            <polygon points="
                                20,130 
                                100,80 
                                180,45 
                                260,30 
                                340,35 
                                420,55 
                                500,65 
                                580,60 
                                580,140 
                                20,140" 
                                fill="url(#trafficGradient)" />

                            <!-- Line Path for Inflow (Blue) -->
                            <polyline points="
                                20,130 
                                100,80 
                                180,45 
                                260,30 
                                340,35 
                                420,55 
                                500,65 
                                580,60" 
                                fill="none" 
                                stroke="#2563EB" 
                                stroke-width="2.5" 
                                stroke-linecap="round" />

                            <!-- Line Path for Outflow (Emerald dashed) -->
                            <polyline points="
                                20,138 
                                100,135 
                                180,120 
                                260,105 
                                340,90 
                                420,65 
                                500,75 
                                580,70" 
                                fill="none" 
                                stroke="#10B981" 
                                stroke-width="2" 
                                stroke-dasharray="4 3" 
                                stroke-linecap="round" />

                            <!-- Data Points on Peak -->
                            <circle cx="260" cy="30" r="4" fill="#2563EB" stroke="#FFFFFF" stroke-width="2" />
                            <text x="260" y="20" font-size="10" font-weight="bold" fill="#0F172A" text-anchor="middle">510 In / hr</text>

                            <!-- X Axis Labels -->
                            <text x="20" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">07:00</text>
                            <text x="100" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">08:00</text>
                            <text x="180" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">09:00</text>
                            <text x="260" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">10:00</text>
                            <text x="340" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">11:00</text>
                            <text x="420" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">12:00</text>
                            <text x="500" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">13:00</text>
                            <text x="580" y="155" font-size="9" fill="#94A3B8" text-anchor="middle">Live</text>
                        </svg>
                    </div>

                    <div class="flex items-center justify-between text-xs text-[var(--text-muted)] pt-3 border-t border-[var(--border)]">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 bg-[var(--accent)]"></span> Entry Rate</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 bg-emerald-500 border-dashed"></span> Exit Rate</span>
                        </div>
                        <span class="text-[11px] font-mono">Updated {{ $metrics['last_updated'] }}</span>
                    </div>
                </div>

                <!-- LIVE ANPR GATE EVENTS STREAM -->
                <div class="dashboard-card p-5 md:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            <h3 class="text-sm font-bold text-[var(--text)]">Live Gate Activity Stream</h3>
                        </div>
                        <span class="text-xs text-[var(--text-muted)]">Real-time barrier events</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-[10px] font-bold uppercase tracking-wider text-slate-400 border-b border-[var(--border)] pb-2">
                                    <th class="pb-2">Time</th>
                                    <th class="pb-2">Plate No</th>
                                    <th class="pb-2">Facility & Lane</th>
                                    <th class="pb-2">Type</th>
                                    <th class="pb-2">Method</th>
                                    <th class="pb-2 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                @foreach($gateActivity as $act)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-2.5 text-slate-500 font-mono">{{ $act['time'] }}</td>
                                        <td class="py-2.5">
                                            <span class="bg-slate-900 text-white font-mono font-bold text-[11px] px-2 py-0.5 rounded shadow-xs tracking-wider">
                                                {{ $act['plate'] }}
                                            </span>
                                        </td>
                                        <td class="py-2.5">
                                            <div class="font-bold text-[var(--text)]">{{ $act['facility'] }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $act['gate'] }}</div>
                                        </td>
                                        <td class="py-2.5">
                                            @if($act['type'] === 'entry')
                                                <span class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded text-[10px] font-bold">
                                                    ↓ Entry
                                                </span>
                                            @else
                                                <span class="text-slate-700 bg-slate-100 px-2 py-0.5 rounded text-[10px] font-bold">
                                                    ↑ Exit
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-2.5 text-slate-600">{{ $act['method'] }}</td>
                                        <td class="py-2.5 text-right">
                                            <span class="font-bold text-emerald-600">{{ $act['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (5 COLS): Facility Comparison & Hardware Status -->
            <div class="lg:col-span-5 space-y-6 md:space-y-8">
                
                <!-- OPERATIONAL HARDWARE ALERTS -->
                @if(count($alerts) > 0)
                    <div class="dashboard-card p-5 border-amber-200 bg-amber-50/30">
                        <div class="flex items-center justify-between pb-3 border-b border-amber-200 mb-3">
                            <div class="flex items-center gap-2 text-amber-800 font-bold text-xs">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span>Operational Attention Items ({{ count($alerts) }})</span>
                            </div>
                            <span class="text-[10px] font-bold uppercase text-amber-700 bg-amber-100 px-2 py-0.5 rounded">Active</span>
                        </div>

                        <div class="space-y-3">
                            @foreach($alerts as $alt)
                                <div class="p-3 bg-white rounded-xl border border-amber-200/80 shadow-xs space-y-1.5">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="font-bold text-xs text-slate-900">{{ $alt['title'] }}</div>
                                        <span class="text-[9px] font-mono text-slate-400 shrink-0">{{ $alt['timestamp'] }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-600">{{ $alt['description'] }}</div>
                                    <div class="pt-1 flex items-center justify-between text-[11px]">
                                        <span class="text-slate-400 font-medium">{{ $alt['facility'] }}</span>
                                        <span class="text-[var(--accent)] font-bold">{{ $alt['action_label'] }} &rarr;</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- MANAGED FACILITIES COMPARISON -->
                <div class="dashboard-card p-5 md:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text)]">Managed Facilities Comparison</h3>
                            <p class="text-[11px] text-[var(--text-muted)]">Occupancy & revenue across your tenant portfolio</p>
                        </div>
                        <span class="text-xs text-[var(--accent)] font-semibold">{{ count($facilities) }} Locations</span>
                    </div>

                    <div class="space-y-4">
                        @foreach($facilities as $fac)
                            <div class="p-3.5 rounded-xl border border-[var(--border)] hover:border-[var(--primary)] transition-all bg-white">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="text-xs font-bold text-[var(--text)]">{{ $fac['name'] }}</h4>
                                        <span class="text-[10px] text-slate-400">{{ $fac['city'] }} • {{ $fac['zone'] }}</span>
                                    </div>
                                    <span class="text-xs font-mono font-bold {{ $fac['occupancy_rate'] >= 80 ? 'text-amber-600' : 'text-emerald-600' }}">
                                        {{ $fac['occupancy_rate'] }}%
                                    </span>
                                </div>

                                <!-- Mini Bar -->
                                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-2">
                                    <div class="h-full rounded-full {{ $fac['occupancy_rate'] >= 80 ? 'bg-amber-500' : 'bg-[var(--accent)]' }}" style="width: {{ $fac['occupancy_rate'] }}%"></div>
                                </div>

                                <div class="grid grid-cols-3 gap-2 text-[10px] pt-1 border-t border-slate-100">
                                    <div>
                                        <span class="text-slate-400 block">Available</span>
                                        <span class="font-bold text-emerald-600">{{ $fac['available'] }} slots</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400 block">Today In/Out</span>
                                        <span class="font-bold text-slate-700">{{ $fac['today_entries'] }} / {{ $fac['today_exits'] }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-slate-400 block">Revenue</span>
                                        <span class="font-bold text-[var(--primary)]">{{ $fac['formatted_revenue'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- IOT & HARDWARE STATUS SUMMARY -->
                <div class="dashboard-card p-5 md:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-md bg-blue-50 text-[var(--accent)] flex items-center justify-center font-bold text-xs">
                                IoT
                            </div>
                            <h3 class="text-sm font-bold text-[var(--text)]">Telemetry & Hardware Status</h3>
                        </div>
                        <span class="text-xs text-emerald-600 font-bold">All Systems Operational</span>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="font-semibold text-slate-700">Barrier Gate Controllers</span>
                            </div>
                            <span class="font-bold text-emerald-700">13 / 13 Active</span>
                        </div>

                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span class="font-semibold text-slate-700">ANPR License Plate Cameras</span>
                            </div>
                            <span class="font-bold text-amber-700">12 Active (1 Check)</span>
                        </div>

                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="font-semibold text-slate-700">Ultrasonic Parking Sensors</span>
                            </div>
                            <span class="font-bold text-emerald-700">1,390 / 1,400 Active</span>
                        </div>

                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="font-semibold text-slate-700">Variable Message Signs (VMS)</span>
                            </div>
                            <span class="font-bold text-emerald-700">4 / 4 Online</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-layouts.vendor>
