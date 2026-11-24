<x-layouts.vendor activeNav="gates" title="Barrier Gates Management - NusaPark Enterprise">

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
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100" aria-label="Dismiss alert">
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
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100" aria-label="Dismiss alert">
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
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    <line x1="12" y1="15" x2="12" y2="17"></line>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Device Fleet • Page 25</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        PLC Telemetry Active
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Barrier Gates
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Monitor and manage physical barrier gate devices across your authorized parking facilities.
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
                        onchange="window.location.href = '/vendor/gates?facility=' + this.value"
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

            <!-- Refresh Fleet State -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer flex items-center gap-1.5 text-xs font-semibold"
                    title="Refresh telemetry state from controllers">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>

            <!-- Add Gate Action -->
            <button type="button" 
                    onclick="openAddGateModal()" 
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold flex items-center gap-2 shadow-xs transition-colors cursor-pointer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Add Gate</span>
            </button>
        </div>

    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <section aria-labelledby="gate-metrics-heading">
        <h2 id="gate-metrics-heading" class="sr-only">Fleet Operational Metrics</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5">
            
            <!-- 1. Total Configured Gates -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Fleet Total</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-[var(--text)] tracking-tight">
                        {{ $metrics['total_gates'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        Configured devices
                    </div>
                </div>
            </div>

            <!-- 2. Online Controllers -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Online PLC</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-emerald-600 tracking-tight flex items-baseline gap-1.5">
                        <span>{{ $metrics['online_count'] }}</span>
                        <span class="text-xs font-semibold text-emerald-700/80">/ {{ $metrics['total_gates'] }}</span>
                    </div>
                    <div class="text-[11px] text-emerald-700 mt-0.5 font-medium flex items-center gap-1">
                        <span>{{ $metrics['health_rate'] }}%</span>
                        <span class="text-slate-400">• Heartbeat OK</span>
                    </div>
                </div>
            </div>

            <!-- 3. Offline / Degraded -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Offline / Lag</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ ($metrics['offline_count'] > 0 || $metrics['degraded_count'] > 0) ? 'text-amber-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['offline_count'] + $metrics['degraded_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['offline_count'] }} offline • {{ $metrics['degraded_count'] }} degraded
                    </div>
                </div>
            </div>

            <!-- 4. Operational Normal -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Ready / Active</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-blue-600 tracking-tight">
                        {{ $metrics['operational_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['maintenance_count'] }} in maintenance
                    </div>
                </div>
            </div>

            <!-- 5. Active Faults -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Faults / Alerts</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ $metrics['fault_count'] > 0 ? 'text-rose-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['fault_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['fault_count'] > 0 ? 'Requires attention' : 'All beams aligned' }}
                    </div>
                </div>
            </div>

            <!-- 6. Total Cycles Today -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Cycles Today</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-indigo-600 tracking-tight">
                        {{ number_format($metrics['today_cycles_total']) }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        Arm actuations logged
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= SEARCH, FILTERS & SORTING TOOLBAR ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        
        <form method="GET" action="/vendor/gates" id="gate-filter-form" class="space-y-4">
            <!-- Hidden Facility Preserve -->
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <!-- Primary Search Row -->
            <div class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search gate code, name, controller ID (e.g. CTR-XYZ-IN01), IP, or lane..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all">
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Apply Filter</span>
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/gates?facility={{ $facilityId }}" 
                       class="px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5"
                       title="Reset all active search and filter options">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Clear</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Granular Filter Dropdowns Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-2.5 pt-2 border-t border-slate-100">
                
                <!-- Direction Filter -->
                <div>
                    <label for="filter-direction" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Direction</label>
                    <select id="filter-direction" 
                            name="direction" 
                            onchange="document.getElementById('gate-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['direction'] === 'all') ? 'selected' : '' }}>All Directions</option>
                        <option value="entry" {{ ($filters['direction'] === 'entry') ? 'selected' : '' }}>Entry (Inbound)</option>
                        <option value="exit" {{ ($filters['direction'] === 'exit') ? 'selected' : '' }}>Exit (Outbound)</option>
                        <option value="bidirectional" {{ ($filters['direction'] === 'bidirectional') ? 'selected' : '' }}>Bidirectional Lane</option>
                    </select>
                </div>

                <!-- Connectivity Status Filter -->
                <div>
                    <label for="filter-connectivity" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Connectivity</label>
                    <select id="filter-connectivity" 
                            name="connectivity" 
                            onchange="document.getElementById('gate-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['connectivity'] === 'all') ? 'selected' : '' }}>All Connectivity</option>
                        <option value="online" {{ ($filters['connectivity'] === 'online') ? 'selected' : '' }}>Online (Heartbeat OK)</option>
                        <option value="offline" {{ ($filters['connectivity'] === 'offline') ? 'selected' : '' }}>Offline (Unreachable)</option>
                        <option value="degraded" {{ ($filters['connectivity'] === 'degraded') ? 'selected' : '' }}>Degraded (High Latency)</option>
                    </select>
                </div>

                <!-- Operational State Filter -->
                <div>
                    <label for="filter-operational" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Operational State</label>
                    <select id="filter-operational" 
                            name="operational_status" 
                            onchange="document.getElementById('gate-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['operational_status'] === 'all') ? 'selected' : '' }}>All States</option>
                        <option value="Operational" {{ ($filters['operational_status'] === 'Operational') ? 'selected' : '' }}>Operational (Normal)</option>
                        <option value="Maintenance" {{ ($filters['operational_status'] === 'Maintenance') ? 'selected' : '' }}>Maintenance Mode</option>
                        <option value="Fault Detected" {{ ($filters['operational_status'] === 'Fault Detected') ? 'selected' : '' }}>Fault Detected</option>
                        <option value="Emergency Open" {{ ($filters['operational_status'] === 'Emergency Open') ? 'selected' : '' }}>Emergency Open</option>
                    </select>
                </div>

                <!-- Barrier Mechanism Type -->
                <div>
                    <label for="filter-barrier-type" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Barrier Type</label>
                    <select id="filter-barrier-type" 
                            name="barrier_type" 
                            onchange="document.getElementById('gate-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['barrier_type'] === 'all') ? 'selected' : '' }}>All Mechanism Types</option>
                        <option value="Servo" {{ ($filters['barrier_type'] === 'Servo') ? 'selected' : '' }}>High-Speed Servo</option>
                        <option value="Hydraulic" {{ ($filters['barrier_type'] === 'Hydraulic') ? 'selected' : '' }}>Hydraulic Industrial</option>
                        <option value="Telescopic" {{ ($filters['barrier_type'] === 'Telescopic') ? 'selected' : '' }}>Telescopic Boom</option>
                        <option value="Heavy" {{ ($filters['barrier_type'] === 'Heavy') ? 'selected' : '' }}>Heavy-Duty Barrier</option>
                    </select>
                </div>

                <!-- Sorting Criteria -->
                <div>
                    <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Sort By</label>
                    <select id="filter-sort" 
                            name="sort" 
                            onchange="document.getElementById('gate-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="code_asc" {{ ($filters['sort'] === 'code_asc') ? 'selected' : '' }}>Gate Code (A &rarr; Z)</option>
                        <option value="code_desc" {{ ($filters['sort'] === 'code_desc') ? 'selected' : '' }}>Gate Code (Z &rarr; A)</option>
                        <option value="name_asc" {{ ($filters['sort'] === 'name_asc') ? 'selected' : '' }}>Gate Name (A &rarr; Z)</option>
                        <option value="cycles_desc" {{ ($filters['sort'] === 'cycles_desc') ? 'selected' : '' }}>Today's Cycles (High)</option>
                        <option value="connectivity_asc" {{ ($filters['sort'] === 'connectivity_asc') ? 'selected' : '' }}>Connectivity State</option>
                        <option value="status_asc" {{ ($filters['sort'] === 'status_asc') ? 'selected' : '' }}>Operational Status</option>
                    </select>
                </div>

            </div>
        </form>

        <!-- Filter Count Banner -->
        <div class="flex items-center justify-between text-xs text-[var(--text-muted)] pt-1">
            <div class="flex items-center gap-2">
                <span>Showing <strong>{{ count($gates) }}</strong> of <strong>{{ $pagination['total'] }}</strong> matching devices</span>
                @if($hasActiveFilters)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Filtered Query
                </span>
                @endif
            </div>
            <div class="hidden sm:block text-[11px] text-slate-400">
                PLC Telemetry Poll: <strong>Real-Time (5s)</strong>
            </div>
        </div>

    </div>

    <!-- ================= GATES FLEET DATA TABLE / CARDS ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        @if(count($gates) > 0)
        <!-- DESKTOP TABLE (Hidden on Mobile) -->
        <div class="hidden lg:block overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse min-w-[960px]">
                <colgroup>
                    <col class="w-[22%]"> <!-- Gate & Lane -->
                    <col class="w-[15%]"> <!-- Facility & Area -->
                    <col class="w-[13%]"> <!-- Controller & IP -->
                    <col class="w-[10%]"> <!-- Connectivity -->
                    <col class="w-[15%]"> <!-- Operational Status -->
                    <col class="w-[10%]"> <!-- Sensors & Loops -->
                    <col class="w-[5%]">  <!-- Cycles Today -->
                    <col class="w-[10%]"> <!-- Actions -->
                </colgroup>
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Gate & Lane</th>
                        <th class="py-3.5 px-3">Facility & Area</th>
                        <th class="py-3.5 px-3">Controller & IP</th>
                        <th class="py-3.5 px-3">Connectivity</th>
                        <th class="py-3.5 px-3">Operational Status</th>
                        <th class="py-3.5 px-3">Sensors & Loops</th>
                        <th class="py-3.5 px-3 text-center">Cycles</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-xs font-medium">
                    @foreach($gates as $gate)
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        
                        <!-- 1. Gate Code & Name -->
                        <td class="py-3.5 px-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100/90 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap tracking-tight group-hover:border-[var(--primary)] group-hover:text-[var(--primary)] transition-colors">
                                        {{ $gate['code'] }}
                                    </span>
                                    @if(($gate['direction'] ?? '') === 'entry')
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="7 13 12 18 17 13"></polyline><line x1="12" y1="6" x2="12" y2="18"></line></svg>
                                        Entry
                                    </span>
                                    @elseif(($gate['direction'] ?? '') === 'exit')
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 whitespace-nowrap">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="17 11 12 6 7 11"></polyline><line x1="12" y1="18" x2="12" y2="6"></line></svg>
                                        Exit
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 whitespace-nowrap">
                                        Bidir
                                    </span>
                                    @endif
                                </div>
                                <div class="font-bold text-xs text-slate-900 group-hover:text-[var(--primary)] transition-colors truncate mt-1" title="{{ $gate['name'] }}">
                                    {{ $gate['name'] }}
                                </div>
                                <div class="text-[11px] text-slate-500 truncate" title="{{ $gate['lane_name'] }}">
                                    {{ $gate['lane_name'] }}
                                </div>
                            </div>
                        </td>

                        <!-- 2. Facility & Parking Area -->
                        <td class="py-3.5 px-3">
                            <div class="font-semibold text-slate-800 text-xs truncate" title="{{ $gate['facility_name'] }}">
                                {{ $gate['facility_name'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5" title="{{ $gate['area_name'] }}">
                                {{ $gate['area_name'] }}
                            </div>
                        </td>

                        <!-- 3. Controller ID & IP -->
                        <td class="py-3.5 px-3 font-mono text-[11px]">
                            <div class="font-bold text-slate-800 flex items-center gap-1.5 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 shrink-0"></span>
                                <span class="truncate" title="{{ $gate['controller_id'] }}">{{ $gate['controller_id'] }}</span>
                            </div>
                            <div class="text-slate-500 text-[10px] mt-0.5 whitespace-nowrap flex items-center gap-1">
                                <span>{{ $gate['ip_address'] }}</span>
                                <span class="text-slate-400 font-sans truncate text-[9px]" title="{{ $gate['barrier_model'] }}">({{ $gate['barrier_model'] }})</span>
                            </div>
                        </td>

                        <!-- 4. Separate Connectivity -->
                        <td class="py-3.5 px-3">
                            @if(strtolower($gate['connectivity']) === 'online')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Online
                                <span class="text-[9px] text-emerald-600/80 font-mono">({{ $gate['ping_latency_ms'] ?? 18 }}ms)</span>
                            </span>
                            <div class="text-[10px] text-slate-400 mt-0.5 whitespace-nowrap">
                                {{ $gate['last_heartbeat'] ?? 'Just now' }}
                            </div>
                            @elseif(strtolower($gate['connectivity']) === 'degraded')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Degraded
                                <span class="text-[9px] text-amber-600/80 font-mono">({{ $gate['ping_latency_ms'] ?? 240 }}ms)</span>
                            </span>
                            <div class="text-[10px] text-amber-600 mt-0.5 whitespace-nowrap font-medium">High latency</div>
                            @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Offline
                            </span>
                            <div class="text-[10px] text-rose-600 font-semibold mt-0.5 whitespace-nowrap">Unreachable</div>
                            @endif
                        </td>

                        <!-- 5. Operational Readiness & Physical Position -->
                        <td class="py-3.5 px-3">
                            <div class="space-y-1">
                                <div>
                                    @if($gate['operational_status'] === 'Operational')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Operational
                                    </span>
                                    @elseif($gate['operational_status'] === 'Maintenance')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                        Maintenance
                                    </span>
                                    @elseif($gate['operational_status'] === 'Emergency Open')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-800 border border-purple-200 whitespace-nowrap">
                                        Emergency Open
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        Fault Detected
                                    </span>
                                    @endif
                                </div>

                                <!-- Arm Mechanical Position -->
                                <div class="text-[10px] text-slate-500 font-medium whitespace-nowrap flex items-center gap-1">
                                    @if(($gate['barrier_position'] ?? '') === 'open')
                                    <span class="text-amber-700 font-bold flex items-center gap-0.5">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                                        Arm Raised (Open)
                                    </span>
                                    @else
                                    <span class="text-slate-600 flex items-center gap-0.5">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        Arm Lowered (Closed)
                                    </span>
                                    @endif
                                </div>

                                @if(!empty($gate['fault_description']))
                                <div class="text-[10px] font-semibold text-rose-600 truncate max-w-[150px]" title="{{ $gate['fault_description'] }}">
                                    ⚠️ {{ $gate['fault_description'] }}
                                </div>
                                @endif
                            </div>
                        </td>

                        <!-- 6. Inductive Loops & Optical Beam -->
                        <td class="py-3.5 px-3 text-[11px]">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1.5 whitespace-nowrap">
                                    <span class="text-slate-400 font-mono text-[10px]">Loop A:</span>
                                    @if(($gate['loop_detector_a'] ?? '') === 'Occupied')
                                    <span class="px-1.5 py-0.2 rounded font-bold text-[9px] bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        Occupied
                                    </span>
                                    @else
                                    <span class="text-slate-500 text-[10px]">Clear</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1.5 whitespace-nowrap">
                                    <span class="text-slate-400 font-mono text-[10px]">Beam:</span>
                                    @if(str_contains(strtolower($gate['safety_beam'] ?? ''), 'obstruct'))
                                    <span class="px-1.5 py-0.2 rounded font-bold text-[9px] bg-rose-50 text-rose-700 border border-rose-200" title="{{ $gate['safety_beam'] }}">Obstructed</span>
                                    @else
                                    <span class="text-emerald-700 text-[10px] font-semibold">Aligned</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- 7. Today Cycles -->
                        <td class="py-3.5 px-3 text-center">
                            <div class="font-mono font-bold text-xs text-slate-800 tabular-nums">
                                {{ number_format($gate['today_cycles'] ?? 0) }}
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5 tabular-nums">
                                Total: {{ number_format($gate['total_lifetime_cycles'] ?? 0) }}
                            </div>
                        </td>

                        <!-- 8. Actions Group -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5 whitespace-nowrap">
                                
                                <!-- Inspect Diagnostic Profile -->
                                <button type="button" 
                                        onclick="openGateDetailDrawer('{{ $gate['id'] }}')" 
                                        class="p-1.5 rounded-lg border border-[var(--border)] text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer"
                                        title="View device diagnostics and live telemetry">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                </button>

                                <!-- Remote Physical Control Modal -->
                                <button type="button" 
                                        onclick="openCommandModal('{{ $gate['id'] }}', '{{ $gate['code'] }}', '{{ $gate['name'] }}', '{{ $gate['barrier_position'] ?? 'closed' }}', '{{ $gate['connectivity'] }}')" 
                                        class="px-2.5 py-1.5 rounded-lg bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-[11px] font-bold flex items-center gap-1 transition-colors cursor-pointer shadow-2xs"
                                        title="Trigger remote barrier commands with safety interlock">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                    <span>Control</span>
                                </button>

                                <!-- Secondary Actions Menu -->
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <button type="button" 
                                            onclick="toggleGateRowMenu('menu-{{ $gate['id'] }}')" 
                                            class="p-1.5 rounded-lg border border-[var(--border)] text-slate-500 hover:bg-slate-100 transition-colors cursor-pointer"
                                            aria-label="More options for gate {{ $gate['code'] }}">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>

                                    <!-- Dropdown Popover -->
                                    <div id="menu-{{ $gate['id'] }}" 
                                         class="hidden absolute right-0 mt-1 w-44 rounded-xl bg-white border border-[var(--border)] shadow-xl z-20 py-1.5 text-xs text-left">
                                        
                                        <!-- Edit Config -->
                                        <button type="button" 
                                                onclick="openEditGateModal('{{ $gate['id'] }}'); toggleGateRowMenu('menu-{{ $gate['id'] }}');" 
                                                class="w-full px-3 py-2 text-slate-700 hover:bg-slate-50 flex items-center gap-2 cursor-pointer">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            <span>Edit Configuration</span>
                                        </button>

                                        <!-- Toggle Maintenance State -->
                                        <form method="POST" action="/vendor/gates/{{ $gate['id'] }}/status">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $gate['operational_status'] === 'Maintenance' ? 'Operational' : 'Maintenance' }}">
                                            <button type="submit" class="w-full px-3 py-2 text-slate-700 hover:bg-slate-50 flex items-center gap-2 cursor-pointer">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                                <span>{{ $gate['operational_status'] === 'Maintenance' ? 'Restore Operational' : 'Set Maintenance' }}</span>
                                            </button>
                                        </form>

                                        <div class="my-1 border-t border-slate-100"></div>

                                        <!-- Decommission Gate -->
                                        <button type="button" 
                                                onclick="openDecommissionModal('{{ $gate['id'] }}', '{{ $gate['code'] }}', '{{ $gate['loop_detector_a'] ?? '' }}'); toggleGateRowMenu('menu-{{ $gate['id'] }}');" 
                                                class="w-full px-3 py-2 text-rose-600 hover:bg-rose-50 flex items-center gap-2 cursor-pointer">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            <span>Decommission</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- MOBILE / TABLET CARDS VIEW (Hidden on Desktop) -->
        <div class="lg:hidden p-4 divide-y divide-slate-100 space-y-4">
            @foreach($gates as $gate)
            <div class="pt-4 first:pt-0 space-y-3">
                
                <!-- Card Header -->
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100/90 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap">
                                {{ $gate['code'] }}
                            </span>
                            @if(($gate['direction'] ?? '') === 'entry')
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Entry</span>
                            @elseif(($gate['direction'] ?? '') === 'exit')
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">Exit</span>
                            @else
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">Bidir</span>
                            @endif
                        </div>
                        <h4 class="font-bold text-sm text-[var(--text)] mt-1 truncate" title="{{ $gate['name'] }}">
                            {{ $gate['name'] }}
                        </h4>
                        <div class="text-[11px] text-[var(--text-muted)] truncate">
                            {{ $gate['facility_name'] }} • {{ $gate['lane_name'] }}
                        </div>
                    </div>

                    <!-- Connectivity Pill -->
                    <div class="shrink-0">
                        @if(strtolower($gate['connectivity']) === 'online')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online
                        </span>
                        @elseif(strtolower($gate['connectivity']) === 'degraded')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                            Degraded
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200 whitespace-nowrap">
                            Offline
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Attributes Grid -->
                <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Operational State</span>
                        <span class="font-semibold {{ $gate['operational_status'] === 'Operational' ? 'text-emerald-700' : ($gate['operational_status'] === 'Maintenance' ? 'text-amber-700' : 'text-rose-700') }}">
                            {{ $gate['operational_status'] }}
                        </span>
                        <div class="text-[10px] text-slate-500">
                            {{ ($gate['barrier_position'] ?? '') === 'open' ? 'Arm Raised (Open)' : 'Arm Lowered (Closed)' }}
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Sensors</span>
                        <div class="text-[11px] text-slate-700">
                            Loop: <strong>{{ $gate['loop_detector_a'] ?? 'Clear' }}</strong>
                        </div>
                        <div class="text-[11px] {{ str_contains(strtolower($gate['safety_beam'] ?? ''), 'obstruct') ? 'text-rose-600 font-bold' : 'text-emerald-700' }}">
                            Beam: {{ str_contains(strtolower($gate['safety_beam'] ?? ''), 'obstruct') ? 'Obstructed' : 'Aligned' }}
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Controller & IP</span>
                        <span class="font-mono text-[11px] text-slate-800">{{ $gate['controller_id'] }}</span>
                        <div class="text-[10px] font-mono text-slate-500">{{ $gate['ip_address'] }}</div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Actuation Cycles</span>
                        <div class="font-mono font-bold text-slate-800 tabular-nums">{{ number_format($gate['today_cycles'] ?? 0) }} today</div>
                        <div class="text-[10px] text-slate-400 tabular-nums">Total: {{ number_format($gate['total_lifetime_cycles'] ?? 0) }}</div>
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="flex items-center gap-2 pt-1">
                    <button type="button" 
                            onclick="openGateDetailDrawer('{{ $gate['id'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors">
                        Diagnostic Profile
                    </button>
                    <button type="button" 
                            onclick="openCommandModal('{{ $gate['id'] }}', '{{ $gate['code'] }}', '{{ $gate['name'] }}', '{{ $gate['barrier_position'] ?? 'closed' }}', '{{ $gate['connectivity'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl bg-[var(--primary)] text-white text-xs font-bold text-center hover:bg-[var(--primary-dark)] transition-colors flex items-center justify-center gap-1 shadow-2xs">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        <span>Control</span>
                    </button>
                </div>

            </div>
            @endforeach
        </div>

        <!-- PAGINATION BAR -->
        <div class="px-5 py-3.5 border-t border-[var(--border)] bg-slate-50/75 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="text-slate-600 font-medium">
                Showing <strong class="text-slate-900 font-semibold">{{ $pagination['from'] }}</strong> to <strong class="text-slate-900 font-semibold">{{ $pagination['to'] }}</strong> of <strong class="text-slate-900 font-semibold">{{ $pagination['total'] }}</strong> gates
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-2">
                <!-- Previous Page -->
                @if($pagination['current_page'] > 1)
                <a href="/vendor/gates?facility={{ $facilityId }}&page={{ $pagination['current_page'] - 1 }}&q={{ urlencode($filters['q']) }}&direction={{ $filters['direction'] }}&connectivity={{ $filters['connectivity'] }}&operational_status={{ $filters['operational_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200/80 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed flex items-center gap-1 opacity-70">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Previous
                </span>
                @endif

                <!-- Page Indicator Badge -->
                <span class="px-3 py-1.5 text-xs font-semibold text-slate-600 bg-white border border-[var(--border)] rounded-lg">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                <!-- Next Page -->
                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/gates?facility={{ $facilityId }}&page={{ $pagination['current_page'] + 1 }}&q={{ urlencode($filters['q']) }}&direction={{ $filters['direction'] }}&connectivity={{ $filters['connectivity'] }}&operational_status={{ $filters['operational_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                    Next
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200/80 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed flex items-center gap-1 opacity-70">
                    Next
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
                @endif
            </div>
            @endif
        </div>

        @else
        <!-- NO RESULTS EMPTY STATE -->
        <div class="py-16 px-4 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <h3 class="text-base font-extrabold text-[var(--text)]">
                No Barrier Gates Found
            </h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] max-w-md mx-auto mt-1">
                @if($hasActiveFilters)
                No configured barrier gates matched your search or status filters. Try clearing filters to view all devices.
                @else
                No barrier gates are currently provisioned for this facility. Add your first barrier device using the button below.
                @endif
            </p>
            <div class="mt-5 flex items-center justify-center gap-3">
                @if($hasActiveFilters)
                <a href="/vendor/gates?facility={{ $facilityId }}" 
                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors">
                    Clear Active Filters
                </a>
                @endif
                <button type="button" 
                        onclick="openAddGateModal()" 
                        class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors">
                    Add Gate Device
                </button>
            </div>
        </div>
        @endif

    </div>

    <!-- ================= RECENT GATE ACTIVITY & TELEMETRY LOGS ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs p-5 space-y-4">
        
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <div>
                    <h2 class="text-sm sm:text-base font-extrabold text-[var(--text)]">
                        Recent Gate Telemetry & Command Events
                    </h2>
                    <p class="text-[11px] text-[var(--text-muted)]">
                        Authoritative hardware actuation logs, vehicle loop triggers, and safety interlock audit records.
                    </p>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-medium hidden sm:inline">
                Last 15 recorded events
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-2.5 px-3">Timestamp</th>
                        <th class="py-2.5 px-3">Gate Code</th>
                        <th class="py-2.5 px-3">Event Type</th>
                        <th class="py-2.5 px-3">Description & Context</th>
                        <th class="py-2.5 px-3">Source / Actor</th>
                        <th class="py-2.5 px-3 text-right">Result</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentLogs as $log)
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-2.5 px-3 font-mono text-[11px] text-slate-500 whitespace-nowrap">
                            {{ $log['timestamp'] }}
                        </td>
                        <td class="py-2.5 px-3 font-mono font-bold text-slate-900">
                            {{ $log['gate_code'] }}
                        </td>
                        <td class="py-2.5 px-3">
                            @if($log['event_type'] === 'barrier_raise')
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                Barrier Raised
                            </span>
                            @elseif($log['event_type'] === 'barrier_lower')
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                Barrier Lowered
                            </span>
                            @elseif($log['event_type'] === 'vehicle_pass' || $log['event_type'] === 'vehicle_entry' || $log['event_type'] === 'vehicle_exit')
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                Vehicle Passage
                            </span>
                            @elseif($log['event_type'] === 'sensor_fault' || $log['event_type'] === 'fault_detected')
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                Sensor Alarm
                            </span>
                            @else
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                {{ ucwords(str_replace('_', ' ', $log['event_type'])) }}
                            </span>
                            @endif
                        </td>
                        <td class="py-2.5 px-3 font-medium text-slate-800">
                            {{ $log['description'] ?? $log['event_label'] ?? 'Operational event recorded' }}
                        </td>
                        <td class="py-2.5 px-3 text-slate-500 text-[11px]">
                            {{ $log['source'] ?? $log['trigger_method'] ?? 'Controller PLC' }}
                            @if(!empty($log['actor']))
                            <span class="text-slate-400">({{ $log['actor'] }})</span>
                            @elseif(!empty($log['operator']))
                            <span class="text-slate-400">({{ $log['operator'] }})</span>
                            @endif
                        </td>
                        <td class="py-2.5 px-3 text-right">
                            @php
                                $resText = $log['result'] ?? $log['status'] ?? 'Success';
                            @endphp
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono text-[10px] font-bold {{ str_contains(strtolower($resText), 'fail') || str_contains(strtolower($resText), 'alarm') ? 'bg-rose-100 text-rose-800' : 'bg-emerald-50 text-emerald-700' }}">
                                {{ $resText }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400 text-xs">
                            No telemetry events recorded yet for this facility.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= SLIDE-OVER GATE DIAGNOSTIC DRAWER ================= -->
    <div id="gate-detail-drawer" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="drawer-gate-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeGateDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-md w-full bg-[var(--surface)] shadow-2xl flex flex-col z-10 animate-slide-left">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                <div class="flex items-center gap-3">
                    <div class="px-2.5 py-1 rounded-lg bg-[var(--primary)] text-white font-mono font-bold text-xs shadow-xs shrink-0 whitespace-nowrap" id="drawer-gate-badge">
                        --
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">PLC Telemetry Profile</div>
                        <h2 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="drawer-gate-title">
                            Gate Details
                        </h2>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeGateDetailDrawer()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                        aria-label="Close drawer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Body -->
            <div class="flex-1 overflow-y-auto p-5 space-y-5" id="drawer-gate-body">
                <div class="text-center py-12 text-slate-400 text-xs">
                    Loading controller telemetry...
                </div>
            </div>

            <!-- Drawer Footer Actions -->
            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center gap-2" id="drawer-gate-footer">
                <button type="button" 
                        onclick="closeGateDetailDrawer()" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-bold text-center transition-colors">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- ================= SAFETY-CRITICAL REMOTE COMMAND MODAL ================= -->
    <div id="gate-command-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-command-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeCommandModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 font-mono">Safety-Critical Action</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-command-title">
                                Gate Control Console
                            </h3>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="closeCommandModal()" 
                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                            aria-label="Close command modal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Form -->
                <form id="gate-command-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    
                    <!-- Target Gate Banner -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Target Hardware Device</div>
                            <div class="text-sm font-extrabold text-slate-900" id="cmd-gate-name">Loading...</div>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-0.5 rounded font-mono text-xs font-bold bg-slate-200 text-slate-800" id="cmd-gate-code">--</span>
                            <div class="text-[10px] text-slate-500 mt-0.5" id="cmd-gate-status">Current: Closed</div>
                        </div>
                    </div>

                    <!-- Safety Warning -->
                    <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-2.5">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-600 shrink-0 mt-0.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <div class="leading-relaxed">
                            <strong>Safety Interlock Active:</strong> Physical barrier commands immediately trigger electro-mechanical motors in active traffic lanes. Never lower a barrier when vehicles or pedestrians are in the path.
                        </div>
                    </div>

                    <!-- Command Selection -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Select Hardware Command <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 gap-2">
                            
                            <label class="p-3 rounded-xl border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50/30 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="command" value="raise" checked class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Raise Barrier Arm (Open)</div>
                                        <div class="text-[11px] text-slate-500">Manual vehicle pass-through or emergency clearance</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Raise</span>
                            </label>

                            <label class="p-3 rounded-xl border border-slate-200 hover:border-slate-400 hover:bg-slate-50 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="command" value="lower" class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Lower Barrier Arm (Close)</div>
                                        <div class="text-[11px] text-slate-500">Restore normal cycle (interlock checks Loop Detector A)</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-200 text-slate-800">Lower</span>
                            </label>

                            <label class="p-3 rounded-xl border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/30 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="command" value="test_cycle" class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Execute Diagnostic Self-Test</div>
                                        <div class="text-[11px] text-slate-500">Ping controller & check safety sensor alignment</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-800">Test (Ping)</span>
                            </label>

                        </div>
                    </div>

                    <!-- Operational Reason (Mandatory for Audit Trail) -->
                    <div>
                        <label for="cmd-reason" class="block text-xs font-bold text-slate-800 mb-1">
                            Operational Reason <span class="text-red-500">*</span>
                        </label>
                        <textarea id="cmd-reason" 
                                  name="reason" 
                                  rows="2" 
                                  required 
                                  placeholder="State mandatory operational justification (e.g. VIP convoy escort, RFID reader sync, loop sensor test)..." 
                                  class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                    </div>

                    <!-- Safety Confirmation Checkbox -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <label class="flex items-start gap-2.5 cursor-pointer">
                            <input type="checkbox" 
                                   name="safety_acknowledged" 
                                   value="1" 
                                   required 
                                   class="mt-0.5 rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                            <span class="text-[11px] text-slate-700 font-medium leading-relaxed">
                                I confirm visual verification (in-person or via live CCTV) that the gate clearance area is completely free of vehicles, pedestrians, and obstacles.
                            </span>
                        </label>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-2 flex items-center justify-end gap-2.5">
                        <button type="button" 
                                onclick="closeCommandModal()" 
                                class="px-4 py-2.5 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold flex items-center gap-2 shadow-xs transition-colors">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            <span>Execute Command</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= ADD GATE MODAL ================= -->
    <div id="add-gate-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-add-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeAddGateModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-xl w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in my-8">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Hardware Fleet Provisioning</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-add-title">
                                Add Barrier Gate
                            </h3>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="closeAddGateModal()" 
                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                            aria-label="Close modal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Add Form -->
                <form method="POST" action="/vendor/gates" class="p-5 space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <!-- Facility Selection -->
                        <div>
                            <label for="add-facility" class="block text-xs font-bold text-slate-800 mb-1">
                                Facility <span class="text-red-500">*</span>
                            </label>
                            <select id="add-facility" 
                                    name="facility_id" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                @foreach($facilities as $fac)
                                    <option value="{{ $fac['id'] }}" {{ ($facilityId === $fac['id']) ? 'selected' : '' }}>
                                        {{ $fac['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Area Concourse -->
                        <div>
                            <label for="add-area" class="block text-xs font-bold text-slate-800 mb-1">
                                Parking Area / Concourse
                            </label>
                            <select id="add-area" 
                                    name="area_id" 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="">Default Main Entrance Concourse</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area['id'] }}">{{ $area['name'] }} ({{ $area['floor'] }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gate Code -->
                        <div>
                            <label for="add-code" class="block text-xs font-bold text-slate-800 mb-1">
                                Gate Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-code" 
                                   name="code" 
                                   required 
                                   placeholder="e.g. IN-04, EX-03" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono uppercase text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Gate Name -->
                        <div>
                            <label for="add-name" class="block text-xs font-bold text-slate-800 mb-1">
                                Gate Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-name" 
                                   name="name" 
                                   required 
                                   placeholder="e.g. North Concourse Gate 4" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Lane Name -->
                        <div>
                            <label for="add-lane" class="block text-xs font-bold text-slate-800 mb-1">
                                Lane Label
                            </label>
                            <input type="text" 
                                   id="add-lane" 
                                   name="lane_name" 
                                   placeholder="e.g. Lane 4 (Visitor Express)" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Direction -->
                        <div>
                            <label for="add-direction" class="block text-xs font-bold text-slate-800 mb-1">
                                Direction Role <span class="text-red-500">*</span>
                            </label>
                            <select id="add-direction" 
                                    name="direction" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="entry">Entry (Inbound)</option>
                                <option value="exit">Exit (Outbound)</option>
                                <option value="bidirectional">Bidirectional Lane</option>
                            </select>
                        </div>

                        <!-- Barrier Type -->
                        <div>
                            <label for="add-barrier-type" class="block text-xs font-bold text-slate-800 mb-1">
                                Barrier Mechanism Type <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-barrier-type" 
                                   name="barrier_type" 
                                   required 
                                   value="High-Speed Servo Boom (1.2s)" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Barrier Model -->
                        <div>
                            <label for="add-barrier-model" class="block text-xs font-bold text-slate-800 mb-1">
                                Hardware Model
                            </label>
                            <input type="text" 
                                   id="add-barrier-model" 
                                   name="barrier_model" 
                                   value="ServoDrive B-120 Pro" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Controller ID -->
                        <div>
                            <label for="add-controller" class="block text-xs font-bold text-slate-800 mb-1">
                                Controller ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-controller" 
                                   name="controller_id" 
                                   required 
                                   placeholder="e.g. CTR-XYZ-IN04" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono uppercase text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- IP Address -->
                        <div>
                            <label for="add-ip" class="block text-xs font-bold text-slate-800 mb-1">
                                Controller IP Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-ip" 
                                   name="ip_address" 
                                   required 
                                   placeholder="e.g. 192.168.10.14" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                    </div>

                    <!-- Initial Operational Status -->
                    <div>
                        <label for="add-status" class="block text-xs font-bold text-slate-800 mb-1">
                            Initial Operational Status <span class="text-red-500">*</span>
                        </label>
                        <select id="add-status" 
                                name="operational_status" 
                                required 
                                class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            <option value="Operational">Operational (Ready for Active Traffic)</option>
                            <option value="Maintenance">Maintenance (Held in Servicing Mode)</option>
                        </select>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                        <button type="button" 
                                onclick="closeAddGateModal()" 
                                class="px-4 py-2.5 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors">
                            Provision Gate
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= EDIT GATE MODAL ================= -->
    <div id="edit-gate-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-edit-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeEditGateModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-xl w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in my-8">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Device Configuration</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-edit-title">
                                Edit Barrier Gate
                            </h3>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="closeEditGateModal()" 
                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                            aria-label="Close edit modal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Edit Form -->
                <form id="edit-gate-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <!-- Gate Code -->
                        <div>
                            <label for="edit-code" class="block text-xs font-bold text-slate-800 mb-1">
                                Gate Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit-code" 
                                   name="code" 
                                   required 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono uppercase text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Gate Name -->
                        <div>
                            <label for="edit-name" class="block text-xs font-bold text-slate-800 mb-1">
                                Gate Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit-name" 
                                   name="name" 
                                   required 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Lane Name -->
                        <div>
                            <label for="edit-lane" class="block text-xs font-bold text-slate-800 mb-1">
                                Lane Label
                            </label>
                            <input type="text" 
                                   id="edit-lane" 
                                   name="lane_name" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Direction -->
                        <div>
                            <label for="edit-direction" class="block text-xs font-bold text-slate-800 mb-1">
                                Direction Role <span class="text-red-500">*</span>
                            </label>
                            <select id="edit-direction" 
                                    name="direction" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="entry">Entry (Inbound)</option>
                                <option value="exit">Exit (Outbound)</option>
                                <option value="bidirectional">Bidirectional Lane</option>
                            </select>
                        </div>

                        <!-- Barrier Type -->
                        <div>
                            <label for="edit-barrier-type" class="block text-xs font-bold text-slate-800 mb-1">
                                Mechanism Type <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit-barrier-type" 
                                   name="barrier_type" 
                                   required 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Barrier Model -->
                        <div>
                            <label for="edit-barrier-model" class="block text-xs font-bold text-slate-800 mb-1">
                                Hardware Model
                            </label>
                            <input type="text" 
                                   id="edit-barrier-model" 
                                   name="barrier_model" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Controller ID -->
                        <div>
                            <label for="edit-controller" class="block text-xs font-bold text-slate-800 mb-1">
                                Controller ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit-controller" 
                                   name="controller_id" 
                                   required 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono uppercase text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- IP Address -->
                        <div>
                            <label for="edit-ip" class="block text-xs font-bold text-slate-800 mb-1">
                                IP Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit-ip" 
                                   name="ip_address" 
                                   required 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-mono text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                    </div>

                    <!-- Operational Status -->
                    <div>
                        <label for="edit-status" class="block text-xs font-bold text-slate-800 mb-1">
                            Operational Status <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-status" 
                                name="operational_status" 
                                required 
                                class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            <option value="Operational">Operational (Normal)</option>
                            <option value="Maintenance">Maintenance Mode</option>
                            <option value="Fault Detected">Fault Detected</option>
                            <option value="Emergency Open">Emergency Open</option>
                        </select>
                    </div>

                    <!-- Fault Description (if any) -->
                    <div>
                        <label for="edit-fault" class="block text-xs font-bold text-slate-800 mb-1">
                            Fault / Maintenance Notes
                        </label>
                        <input type="text" 
                               id="edit-fault" 
                               name="fault_description" 
                               placeholder="e.g. Safety beam cleaning required, motor calibration" 
                               class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                        <button type="button" 
                                onclick="closeEditGateModal()" 
                                class="px-4 py-2.5 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= DECOMMISSION CONFIRMATION MODAL ================= -->
    <div id="decommission-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-decommission-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeDecommissionModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-md w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in">
                
                <div class="p-6 text-center space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>

                    <div>
                        <h3 class="text-base font-extrabold text-[var(--text)]" id="modal-decommission-title">
                            Decommission Barrier Gate?
                        </h3>
                        <p class="text-xs text-[var(--text-muted)] mt-1.5 leading-relaxed">
                            Are you sure you want to remove gate <strong id="decommission-gate-code" class="text-slate-900">--</strong> from the active facility fleet?
                        </p>
                    </div>

                    <div id="decommission-interlock-notice" class="hidden p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs text-left">
                        ⚠️ <strong>Safety Interlock:</strong> Cannot decommission gate while a vehicle is present on the inductive loop detector.
                    </div>

                    <form id="decommission-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex items-center justify-center gap-2.5 pt-2">
                            <button type="button" 
                                    onclick="closeDecommissionModal()" 
                                    class="flex-1 py-2.5 px-4 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                    id="decommission-submit-btn" 
                                    class="flex-1 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-colors">
                                Decommission
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= CLIENT JAVASCRIPT ================= -->
    @push('scripts')
    <script>
        // Toggle Row Actions Dropdown
        function toggleGateRowMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (!menu) return;
            const isHidden = menu.classList.contains('hidden');
            
            // Close all other open row menus first
            document.querySelectorAll('[id^="menu-gate-"]').forEach(m => m.classList.add('hidden'));
            
            if (isHidden) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="menu-"]') && !e.target.closest('button[aria-label^="More options"]')) {
                document.querySelectorAll('[id^="menu-gate-"]').forEach(m => m.classList.add('hidden'));
            }
        });

        // ================= SLIDE-OVER DIAGNOSTIC DRAWER =================
        function openGateDetailDrawer(gateId) {
            const drawer = document.getElementById('gate-detail-drawer');
            const title = document.getElementById('drawer-gate-title');
            const badge = document.getElementById('drawer-gate-badge');
            const body = document.getElementById('drawer-gate-body');
            const footer = document.getElementById('drawer-gate-footer');

            drawer.classList.remove('hidden');
            body.innerHTML = `
                <div class="text-center py-16 text-slate-400 text-xs space-y-2">
                    <div class="w-8 h-8 border-2 border-[var(--primary)] border-t-transparent rounded-full animate-spin mx-auto"></div>
                    <div>Fetching real-time controller telemetry...</div>
                </div>
            `;

            fetch('/api/vendor/gates/' + gateId)
                .then(r => r.json())
                .then(data => {
                    if (!data.success || !data.gate) {
                        body.innerHTML = '<div class="text-rose-600 text-xs p-4">Device profile could not be loaded.</div>';
                        return;
                    }

                    const g = data.gate;
                    title.innerText = g.name;
                    badge.innerText = g.code;

                    const isOnline = (g.connectivity || '').toLowerCase() === 'online';
                    const isDegraded = (g.connectivity || '').toLowerCase() === 'degraded';
                    const connClass = isOnline ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : (isDegraded ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200');

                    body.innerHTML = `
                        <!-- Top State Badges -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-slate-400 block">Connectivity</span>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold border ${connClass}">
                                    <span class="w-2 h-2 rounded-full ${isOnline ? 'bg-emerald-500' : (isDegraded ? 'bg-amber-500' : 'bg-red-500')}"></span>
                                    ${g.connectivity_label || g.connectivity}
                                    <span class="font-mono text-[10px]">(${g.ping_latency_ms || 18}ms)</span>
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-bold uppercase text-slate-400 block">Arm Position</span>
                                <span class="text-xs font-extrabold ${g.barrier_position === 'open' ? 'text-amber-600' : 'text-slate-800'}">
                                    ${g.barrier_position === 'open' ? '▲ RAISED (OPEN)' : '▼ LOWERED (CLOSED)'}
                                </span>
                            </div>
                        </div>

                        <!-- Hardware Controller Profile -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">PLC Hardware Details</div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Controller ID:</span>
                                    <span class="font-mono font-bold text-slate-900">${g.controller_id}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">IP Address:</span>
                                    <span class="font-mono font-bold text-slate-900">${g.ip_address}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">MAC Address:</span>
                                    <span class="font-mono text-slate-700">${g.mac_address || '70:B3:D5:A4:12:88'}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Firmware Version:</span>
                                    <span class="font-mono text-slate-700">${g.firmware_version || 'v4.8.2-PRO'}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Barrier Model:</span>
                                    <span class="font-medium text-slate-800">${g.barrier_model}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sensors & Interlocks -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Sensors & Safety Interlocks</div>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Loop Detector A</div>
                                    <div class="font-bold mt-1 ${g.loop_detector_a === 'Occupied' ? 'text-indigo-700' : 'text-slate-700'}">
                                        ${g.loop_detector_a || 'Clear'}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Approach induction</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Loop Detector B</div>
                                    <div class="font-bold mt-1 text-slate-700">
                                        ${g.loop_detector_b || 'Clear'}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Departure clearance</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Optical Safety Beam</div>
                                    <div class="font-bold mt-1 ${g.safety_beam && g.safety_beam.includes('Obstruct') ? 'text-rose-600' : 'text-emerald-700'}">
                                        ${g.safety_beam || 'Aligned (OK)'}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Infrared curtain</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Controller Temp</div>
                                    <div class="font-bold mt-1 text-slate-700">
                                        ${g.thermal_status || 'Normal (30°C)'}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Internal sensor</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actuation Cycle Stats -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Movement Volume</div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                                <div>
                                    <div class="text-slate-500">Today's Cycles:</div>
                                    <div class="text-base font-extrabold text-slate-900">${(g.today_cycles || 0).toLocaleString()}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-slate-500">Lifetime Motor Cycles:</div>
                                    <div class="text-sm font-mono font-bold text-slate-700">${(g.total_lifetime_cycles || 0).toLocaleString()}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Location Metadata -->
                        <div class="p-3 rounded-xl bg-blue-50/50 border border-blue-100 text-xs text-blue-900 space-y-1">
                            <div><strong>Facility:</strong> ${g.facility_name}</div>
                            <div><strong>Lane:</strong> ${g.lane_name} (${g.direction_label})</div>
                            <div><strong>Parking Area:</strong> ${g.area_name}</div>
                            <div class="text-[10px] text-blue-700/80 mt-1">Last Sync: ${g.last_updated}</div>
                        </div>
                    `;

                    footer.innerHTML = `
                        <button type="button" 
                                onclick="closeGateDetailDrawer(); openCommandModal('${g.id}', '${g.code}', '${g.name}', '${g.barrier_position}', '${g.connectivity}')" 
                                class="flex-1 py-2.5 px-4 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold text-center transition-colors">
                            Remote Control
                        </button>
                        <button type="button" 
                                onclick="closeGateDetailDrawer()" 
                                class="py-2.5 px-4 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors">
                            Close
                        </button>
                    `;
                })
                .catch(() => {
                    body.innerHTML = '<div class="text-rose-600 text-xs p-4">Error communicating with API endpoint.</div>';
                });
        }

        function closeGateDetailDrawer() {
            document.getElementById('gate-detail-drawer').classList.add('hidden');
        }

        // ================= SAFETY COMMAND MODAL =================
        function openCommandModal(gateId, code, name, position, connectivity) {
            const modal = document.getElementById('gate-command-modal');
            const form = document.getElementById('gate-command-form');
            const gateName = document.getElementById('cmd-gate-name');
            const gateCode = document.getElementById('cmd-gate-code');
            const gateStatus = document.getElementById('cmd-gate-status');

            form.action = '/vendor/gates/' + gateId + '/command';
            gateName.innerText = name;
            gateCode.innerText = code;
            gateStatus.innerText = 'Position: ' + (position === 'open' ? 'Raised (Open)' : 'Lowered (Closed)') + ' • ' + (connectivity || 'Online');

            modal.classList.remove('hidden');
        }

        function closeCommandModal() {
            document.getElementById('gate-command-modal').classList.add('hidden');
        }

        // ================= ADD GATE MODAL =================
        function openAddGateModal() {
            document.getElementById('add-gate-modal').classList.remove('hidden');
        }

        function closeAddGateModal() {
            document.getElementById('add-gate-modal').classList.add('hidden');
        }

        // ================= EDIT GATE MODAL =================
        function openEditGateModal(gateId) {
            const modal = document.getElementById('edit-gate-modal');
            const form = document.getElementById('edit-gate-form');

            form.action = '/vendor/gates/' + gateId;

            fetch('/api/vendor/gates/' + gateId)
                .then(r => r.json())
                .then(data => {
                    if (!data.success || !data.gate) return;
                    const g = data.gate;

                    document.getElementById('edit-code').value = g.code || '';
                    document.getElementById('edit-name').value = g.name || '';
                    document.getElementById('edit-lane').value = g.lane_name || '';
                    document.getElementById('edit-direction').value = g.direction || 'entry';
                    document.getElementById('edit-barrier-type').value = g.barrier_type || '';
                    document.getElementById('edit-barrier-model').value = g.barrier_model || '';
                    document.getElementById('edit-controller').value = g.controller_id || '';
                    document.getElementById('edit-ip').value = g.ip_address || '';
                    document.getElementById('edit-status').value = g.operational_status || 'Operational';
                    document.getElementById('edit-fault').value = g.fault_description || '';

                    modal.classList.remove('hidden');
                });
        }

        function closeEditGateModal() {
            document.getElementById('edit-gate-modal').classList.add('hidden');
        }

        // ================= DECOMMISSION MODAL =================
        function openDecommissionModal(gateId, code, loopA) {
            const modal = document.getElementById('decommission-modal');
            const form = document.getElementById('decommission-form');
            const codeEl = document.getElementById('decommission-gate-code');
            const notice = document.getElementById('decommission-interlock-notice');
            const submitBtn = document.getElementById('decommission-submit-btn');

            form.action = '/vendor/gates/' + gateId;
            codeEl.innerText = code;

            if (loopA === 'Occupied') {
                notice.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                notice.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            modal.classList.remove('hidden');
        }

        function closeDecommissionModal() {
            document.getElementById('decommission-modal').classList.add('hidden');
        }

        // ESC Key Global Listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeGateDetailDrawer();
                closeCommandModal();
                closeAddGateModal();
                closeEditGateModal();
                closeDecommissionModal();
                document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
            }
        });
    </script>
    @endpush

</x-layouts.vendor>
