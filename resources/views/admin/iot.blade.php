<x-layouts.admin activeNav="iot" title="IoT Monitoring — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Diagnostic Operation Successful</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Hardware Communication Exception</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- Dynamic In-Page Ping Feedback Toast (AJAX) -->
    <div id="pingToast" class="fixed bottom-6 right-6 z-50 max-w-md hidden transition-all duration-300">
        <div id="pingToastContent" class="p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white">
            <div id="pingToastIcon" class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0"></div>
            <div class="flex-1 pr-2">
                <p id="pingToastTitle" class="text-xs font-bold uppercase tracking-wider"></p>
                <p id="pingToastMessage" class="text-xs mt-0.5 text-slate-600 leading-relaxed font-mono"></p>
            </div>
            <button type="button" onclick="hidePingToast()" class="text-slate-400 hover:text-slate-600 p-1">
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
                <span class="font-semibold text-slate-700">IoT Monitoring</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>National IoT Telemetry Active</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Last Telemetry Cycle: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        IoT Monitoring
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-xs font-mono">
                        {{ $pagination['total'] }} {{ Str::plural('device', $pagination['total']) }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    Centralized platform-wide monitoring of IoT equipment, gate controllers, ANPR cameras, bay sensors, and telemetry gateways across all authorized tenant parking facilities.
                </p>
            </div>

            <!-- Header Action Controls -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.iot.export', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                </a>

                <a href="{{ route('admin.iot', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"></path><path d="M1 20v-6h6"></path><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                    <span>Refresh Telemetry</span>
                </a>
            </div>

        </div>

    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 mb-6">
        
        <!-- Metric 1: Total Registered Devices -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Registered Devices</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ number_format($summary['total_devices']) }}</span>
                    <span class="text-xs font-semibold text-slate-500">units</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-slate-700">{{ $summary['operational_count'] }}</strong> nominal · <strong class="text-amber-600">{{ $summary['attention'] }}</strong> warning
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
            </div>
        </div>

        <!-- Metric 2: Online & Connected -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Online & Connected</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-emerald-700 font-mono tracking-tight">{{ number_format($summary['online']) }}</span>
                    <span class="text-xs font-semibold text-emerald-600">{{ $summary['availability_rate'] }}%</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Avg ping latency: <strong class="text-slate-800 font-mono">{{ $summary['avg_ping_ms'] }}ms</strong>
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
            </div>
        </div>

        <!-- Metric 3: Offline Disconnected -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-rose-600">Offline Disconnected</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-rose-700 font-mono tracking-tight">{{ number_format($summary['offline']) }}</span>
                    <span class="text-xs font-semibold text-rose-600">{{ $summary['offline'] > 0 ? 'Action Req' : 'Zero Drops' }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Zero heartbeat or link dropped
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="1" y1="1" x2="23" y2="23"></line><path d="M16.72 11.06A10.94 10.94 0 0 1 19 12.55"></path><path d="M5 12.55a10.94 10.94 0 0 1 5.17-2.39"></path><path d="M10.71 5.05A16 16 0 0 1 22.58 9"></path><path d="M1.42 9a15.91 15.91 0 0 1 4.7-2.88"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
            </div>
        </div>

        <!-- Metric 4: Degraded & High Latency -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Degraded & Latency</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-amber-700 font-mono tracking-tight">{{ number_format($summary['degraded']) }}</span>
                    <span class="text-xs font-semibold text-amber-600">packets lag</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Ping &gt;150ms or cellular fallback
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            </div>
        </div>

        <!-- Metric 5: Stale & Health Exceptions -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Stale & Faulted</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $summary['fault'] + $summary['stale'] }}</span>
                    <span class="text-xs font-semibold text-slate-500">exceptions</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-rose-600">{{ $summary['fault'] }}</strong> faults · <strong class="text-sky-600">{{ $summary['maintenance'] }}</strong> in maint
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            </div>
        </div>

    </div>

    <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.iot') }}" class="space-y-3">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
                
                <!-- Text Search -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Search Fleet</label>
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search device code, name, IP, MAC, serial..."
                               class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <span class="absolute left-3 top-2.5 text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </div>
                </div>

                <!-- Tenant / Operator Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Tenant Operator</label>
                    <select name="vendor" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Tenants (Platform-wide)</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                                {{ $t['company_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location / Facility Filter -->
                <div class="lg:col-span-2">
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

                <!-- Equipment Type Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Equipment Type</label>
                    <select name="type" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($types as $tKey => $tLabel)
                            <option value="{{ $tKey }}" {{ $filters['type'] === $tKey ? 'selected' : '' }}>
                                {{ $tLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Connectivity Status Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Connectivity & Freshness</label>
                    <div class="grid grid-cols-2 gap-2">
                        <select name="connectivity" onchange="this.form.submit()" class="w-full px-2.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($connectivities as $cKey => $cLabel)
                                <option value="{{ $cKey }}" {{ $filters['connectivity'] === $cKey ? 'selected' : '' }}>
                                    {{ $cLabel }}
                                </option>
                            @endforeach
                        </select>

                        <select name="freshness" onchange="this.form.submit()" class="w-full px-2.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($freshnessOptions as $fKey => $fLabel)
                                <option value="{{ $fKey }}" {{ $filters['freshness'] === $fKey ? 'selected' : '' }}>
                                    {{ $fLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <!-- Second Filter Row: Health, Sorting, Reset -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 border-t border-slate-100">
                <div class="flex flex-wrap items-center gap-3">
                    
                    <!-- Operational Health -->
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Health State:</span>
                        <select name="health" onchange="this.form.submit()" class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($healths as $hKey => $hLabel)
                                <option value="{{ $hKey }}" {{ $filters['health'] === $hKey ? 'selected' : '' }}>
                                    {{ $hLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sorting Order -->
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Sort By:</span>
                        <select name="sort" onchange="this.form.submit()" class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="status" {{ $filters['sort'] === 'status' ? 'selected' : '' }}>Faults & Offline First</option>
                            <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Device Name (A-Z)</option>
                            <option value="name_desc" {{ $filters['sort'] === 'name_desc' ? 'selected' : '' }}>Device Name (Z-A)</option>
                            <option value="code_asc" {{ $filters['sort'] === 'code_asc' ? 'selected' : '' }}>Device Code (A-Z)</option>
                            <option value="ping_asc" {{ $filters['sort'] === 'ping_asc' ? 'selected' : '' }}>Lowest Ping Latency</option>
                            <option value="ping_desc" {{ $filters['sort'] === 'ping_desc' ? 'selected' : '' }}>Highest Ping Latency</option>
                            <option value="last_seen_desc" {{ $filters['sort'] === 'last_seen_desc' ? 'selected' : '' }}>Freshest Heartbeat First</option>
                        </select>
                    </div>

                </div>

                <!-- Submit & Clear Controls -->
                <div class="flex items-center gap-2 self-end sm:self-auto">
                    @if($filters['q'] || $filters['vendor'] !== 'all' || $filters['location'] !== 'all' || $filters['type'] !== 'all' || $filters['connectivity'] !== 'all' || $filters['health'] !== 'all' || $filters['freshness'] !== 'all' || $filters['sort'] !== 'status')
                        <a href="{{ route('admin.iot') }}" class="px-3 py-1.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition-colors">
                            Clear Filters
                        </a>
                    @endif

                    <button type="submit" class="px-4 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-colors">
                        Apply Filter
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- ================= DEVICE INVENTORY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <!-- Table Top Meta Header -->
        <div class="px-5 py-3.5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-800">Hardware Fleet Inventory</span>
                <span class="text-slate-400">·</span>
                <span class="text-slate-500">Showing <strong class="text-slate-700">{{ $pagination['from'] }}-{{ $pagination['to'] }}</strong> of <strong class="text-slate-700">{{ $pagination['total'] }}</strong> units</span>
            </div>
            
            <div class="flex items-center gap-3 text-[11px] text-slate-500 font-mono">
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Online</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Degraded</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Offline</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Maintenance</span>
            </div>
        </div>

        @if(count($devices) > 0)
        <!-- Desktop Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">Device Identity</th>
                        <th class="py-3 px-4">Equipment Type</th>
                        <th class="py-3 px-4">Facility & Tenant</th>
                        <th class="py-3 px-4">Connectivity</th>
                        <th class="py-3 px-4">Operational Health</th>
                        <th class="py-3 px-4">Telemetry Freshness</th>
                        <th class="py-3 px-4">Network & Protocol</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($devices as $d)
                    <tr class="hover:bg-slate-50/70 transition-colors group {{ $d['health'] === 'Fault' ? 'bg-rose-50/20' : '' }}">
                        
                        <!-- Col 1: Identity & Hardware -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-start gap-2.5">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 mt-0.5 {{ $d['connectivity'] === 'Online' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : ($d['connectivity'] === 'Degraded' ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'bg-rose-50 text-rose-600 border border-rose-200') }}">
                                    @if(str_contains($d['type'], 'Gate'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16"></path><path d="M2 20h20"></path><line x1="14" y1="12" x2="14.01" y2="12"></line></svg>
                                    @elseif(str_contains($d['type'], 'Camera'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                    @elseif(str_contains($d['type'], 'Sensor'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><path d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14"></path></svg>
                                    @elseif(str_contains($d['type'], 'Gateway'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                    @elseif(str_contains($d['type'], 'Display'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                    @elseif(str_contains($d['type'], 'Payment'))
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    @else
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <button type="button" 
                                                onclick="openDeviceDetail('{{ $d['id'] }}')" 
                                                class="font-mono font-bold text-slate-900 hover:text-indigo-600 transition-colors text-xs text-left">
                                            {{ $d['code'] }}
                                        </button>
                                        @if($d['is_maintenance'])
                                            <span class="px-1.5 py-0.2 rounded bg-purple-100 text-purple-700 font-bold text-[9px] uppercase tracking-wider font-mono">MAINT</span>
                                        @endif
                                    </div>
                                    <p class="font-medium text-slate-700 line-clamp-1 text-[11px] mt-0.5" title="{{ $d['name'] }}">
                                        {{ $d['name'] }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5">
                                        {{ $d['model'] }} · SN: {{ $d['serial_number'] }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <!-- Col 2: Equipment Type -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-slate-100 text-slate-800 text-[11px] font-semibold border border-slate-200">
                                <span>{{ $d['type'] }}</span>
                            </span>
                            <div class="text-[10px] text-slate-400 mt-1 font-mono">
                                Zone: {{ $d['zone'] }}
                            </div>
                        </td>

                        <!-- Col 3: Facility & Tenant -->
                        <td class="py-3.5 px-4">
                            <div>
                                <a href="/admin/locations?q={{ urlencode($d['location_name']) }}" 
                                   class="font-semibold text-slate-900 hover:text-indigo-600 transition-colors line-clamp-1"
                                   title="Inspect {{ $d['location_name'] }} in Location Management">
                                    {{ $d['location_name'] }}
                                </a>
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-500 mt-0.5">
                                    <span class="font-medium">{{ $d['location_city'] }}</span>
                                    <span>•</span>
                                    <a href="/admin/tenants?q={{ urlencode($d['vendor_name']) }}" 
                                       class="text-slate-500 hover:text-slate-800 truncate max-w-[140px]" 
                                       title="{{ $d['vendor_name'] }}">
                                        {{ $d['vendor_name'] }}
                                    </a>
                                </div>
                            </div>
                        </td>

                        <!-- Col 4: Connectivity -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($d['connectivity'] === 'Online')
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Online</span>
                                </div>
                                <div class="text-[10px] font-mono text-emerald-700 font-semibold mt-1">
                                    {{ $d['ping_ms'] }}ms latency
                                </div>
                            @elseif($d['connectivity'] === 'Degraded')
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-amber-50 text-amber-800 border border-amber-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <span>Degraded</span>
                                </div>
                                <div class="text-[10px] font-mono text-amber-700 font-semibold mt-1">
                                    {{ $d['ping_ms'] }}ms latency
                                </div>
                            @else
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-rose-50 text-rose-800 border border-rose-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    <span>Offline</span>
                                </div>
                                <div class="text-[10px] font-mono text-rose-700 font-semibold mt-1">
                                    Connection Timeout
                                </div>
                            @endif
                        </td>

                        <!-- Col 5: Operational Health -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($d['health'] === 'Operational')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100/70 text-emerald-800 text-[11px] font-bold">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>Operational</span>
                                </span>
                            @elseif($d['health'] === 'Attention Required')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 text-[11px] font-bold" title="{{ $d['error_message'] }}">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                    <span>Attention</span>
                                </span>
                                @if(!empty($d['error_code']) && $d['error_code'] !== 'ERR_NONE')
                                    <div class="text-[9px] font-mono text-amber-700 mt-0.5 truncate max-w-[130px]" title="{{ $d['error_message'] }}">
                                        {{ $d['error_code'] }}
                                    </div>
                                @endif
                            @elseif($d['health'] === 'Maintenance')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-sky-100 text-sky-900 text-[11px] font-bold">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                    <span>Maintenance</span>
                                </span>
                            @elseif($d['health'] === 'Fault')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-900 text-[11px] font-bold" title="{{ $d['error_message'] }}">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                    <span>Fault</span>
                                </span>
                                @if(!empty($d['error_code']))
                                    <div class="text-[9px] font-mono text-rose-700 font-bold mt-0.5 truncate max-w-[130px]" title="{{ $d['error_message'] }}">
                                        {{ $d['error_code'] }}
                                    </div>
                                @endif
                            @endif
                        </td>

                        <!-- Col 6: Telemetry Freshness -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="font-mono text-slate-700 text-xs">
                                {{ $d['last_heartbeat_at'] }}
                            </div>
                            <div class="mt-1 flex items-center gap-1.5">
                                @if(($d['freshness'] ?? '') === 'fresh')
                                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-mono text-[10px] font-bold border border-emerald-200">
                                        FRESH (&lt;5m)
                                    </span>
                                @elseif(($d['freshness'] ?? '') === 'delayed')
                                    <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 font-mono text-[10px] font-bold border border-amber-200">
                                        DELAYED ({{ round(($d['heartbeat_seconds_ago'] ?? 0) / 60) }}m)
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-mono text-[10px] font-bold border border-rose-200">
                                        STALE ({{ round(($d['heartbeat_seconds_ago'] ?? 0) / 60) }}m)
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Col 7: Network & Protocol -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="font-mono text-slate-800 font-medium text-xs">
                                {{ $d['ip_address'] }}
                            </div>
                            <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                                {{ $d['protocol'] }} · FW: {{ $d['firmware_version'] }}
                            </div>
                        </td>

                        <!-- Col 8: Actions -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Inspect Button -->
                                <button type="button" 
                                        onclick="openDeviceDetail('{{ $d['id'] }}')"
                                        title="Inspect device telemetry & diagnostics"
                                        class="px-2.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition-colors flex items-center gap-1">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span>Inspect</span>
                                </button>

                                <!-- Diagnostic Ping Button -->
                                <button type="button" 
                                        onclick="triggerDiagnosticPing('{{ $d['id'] }}', '{{ $d['code'] }}', this)"
                                        title="Send diagnostic echo ping packet"
                                        class="p-1.5 rounded-xl border border-indigo-200 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
                                </button>

                                <!-- Maintenance Mode Toggle -->
                                <button type="button" 
                                        onclick="openStatusModal('{{ $d['id'] }}', '{{ $d['code'] }}', '{{ $d['connectivity'] }}', '{{ $d['health'] }}')"
                                        title="Administrative status & maintenance control"
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
            @foreach($devices as $d)
            <div class="bg-slate-50/70 p-3.5 rounded-xl border border-slate-200/80 space-y-2.5">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-mono font-bold text-slate-900 text-xs">{{ $d['code'] }}</span>
                            @if($d['is_maintenance'])
                                <span class="px-1.5 py-0.2 rounded bg-purple-100 text-purple-700 font-bold text-[9px] font-mono">MAINT</span>
                            @endif
                        </div>
                        <p class="font-medium text-slate-700 text-xs mt-0.5">{{ $d['name'] }}</p>
                    </div>

                    @if($d['connectivity'] === 'Online')
                        <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Online</span>
                    @elseif($d['connectivity'] === 'Degraded')
                        <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">Degraded</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">Offline</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-2 text-[11px] text-slate-600 font-mono">
                    <div>
                        <span class="text-slate-400 block text-[10px]">Type:</span>
                        <span>{{ $d['type'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Health:</span>
                        <span class="font-bold {{ $d['health'] === 'Fault' ? 'text-rose-600' : ($d['health'] === 'Attention Required' ? 'text-amber-600' : 'text-emerald-600') }}">
                            {{ $d['health'] }}
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Facility:</span>
                        <span class="truncate block text-slate-800">{{ $d['location_name'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">IP / Latency:</span>
                        <span>{{ $d['ip_address'] }} · {{ $d['ping_ms'] !== null ? $d['ping_ms'] . 'ms' : 'Timeout' }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-200">
                    <button type="button" 
                            onclick="openDeviceDetail('{{ $d['id'] }}')"
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 text-xs font-bold">
                        Inspect
                    </button>
                    <button type="button" 
                            onclick="triggerDiagnosticPing('{{ $d['id'] }}', '{{ $d['code'] }}', this)"
                            class="px-3 py-1.5 rounded-lg bg-indigo-600 text-white text-xs font-bold">
                        Ping
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="px-5 py-4 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-slate-50/50">
            <div class="text-slate-500">
                Page <strong class="text-slate-800 font-mono">{{ $pagination['current_page'] }}</strong> of <strong class="text-slate-800 font-mono">{{ $pagination['last_page'] }}</strong>
                ({{ $pagination['total'] }} total devices)
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
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </div>
            <h3 class="text-base font-bold text-slate-800">No IoT Devices Match Query</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                No equipment records matched the specified filters (tenant, facility, status, or freshness). Try broadening your search criteria.
            </p>
            <div class="mt-4">
                <a href="{{ route('admin.iot') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white font-bold text-xs hover:bg-indigo-700 transition-colors">
                    Reset All Filters
                </a>
            </div>
        </div>
        @endif

    </div>

    <!-- ================= SLIDE-OVER DEVICE INSPECTION DRAWER ================= -->
    <div id="deviceDetailDrawer" class="fixed inset-0 z-50 overflow-hidden {{ $selectedDevice ? '' : 'hidden' }}">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-2xs transition-opacity" 
             onclick="closeDeviceDetail()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-xl bg-white border-l border-slate-200 shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="drawerDeviceCode" class="font-mono font-bold text-sm text-slate-900 bg-slate-200/80 px-2 py-0.5 rounded">
                                {{ $selectedDevice['code'] ?? 'GATE-000' }}
                            </span>
                            <span id="drawerDeviceTypeBadge" class="px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 border border-indigo-200 text-[11px] font-semibold">
                                {{ $selectedDevice['type'] ?? 'Device' }}
                            </span>
                        </div>
                        <h2 id="drawerDeviceName" class="text-base font-bold text-slate-900 mt-1">
                            {{ $selectedDevice['name'] ?? 'Device Details' }}
                        </h2>
                        <p id="drawerDeviceLocation" class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $selectedDevice['location_name'] ?? '' }} · {{ $selectedDevice['zone'] ?? '' }}
                        </p>
                    </div>

                    <button type="button" 
                            onclick="closeDeviceDetail()" 
                            class="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-200/50 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Scrollable Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 text-xs">
                    
                    <!-- Top Status Strip -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Connectivity</span>
                            <span id="drawerConnectivityBadge" class="font-bold text-xs {{ ($selectedDevice['connectivity'] ?? '') === 'Online' ? 'text-emerald-700' : (($selectedDevice['connectivity'] ?? '') === 'Degraded' ? 'text-amber-700' : 'text-rose-700') }}">
                                {{ $selectedDevice['connectivity'] ?? 'Unknown' }}
                            </span>
                        </div>

                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Operational</span>
                            <span id="drawerHealthBadge" class="font-bold text-xs {{ ($selectedDevice['health'] ?? '') === 'Fault' ? 'text-rose-700' : (($selectedDevice['health'] ?? '') === 'Attention Required' ? 'text-amber-700' : 'text-emerald-700') }}">
                                {{ $selectedDevice['health'] ?? 'Operational' }}
                            </span>
                        </div>

                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Ping Latency</span>
                            <span id="drawerPingBadge" class="font-mono font-bold text-xs text-slate-800">
                                {{ ($selectedDevice['ping_ms'] ?? null) !== null ? $selectedDevice['ping_ms'] . 'ms' : 'Timeout' }}
                            </span>
                        </div>

                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Freshness</span>
                            <span id="drawerFreshnessBadge" class="font-mono font-bold text-xs uppercase text-slate-700">
                                {{ $selectedDevice['freshness'] ?? 'FRESH' }}
                            </span>
                        </div>
                    </div>

                    <!-- Exception Alert Banner if Faulted or Attention -->
                    <div id="drawerExceptionBanner" class="{{ in_array($selectedDevice['health'] ?? '', ['Fault', 'Attention Required']) ? '' : 'hidden' }} p-3.5 rounded-xl border bg-rose-50 border-rose-200 text-rose-900">
                        <div class="flex items-start gap-2.5">
                            <svg class="shrink-0 mt-0.5 text-rose-600" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            <div>
                                <span id="drawerErrorCode" class="font-mono font-bold text-[11px] uppercase tracking-wider block text-rose-700">
                                    {{ $selectedDevice['error_code'] ?? 'ERR_FAULT' }}
                                </span>
                                <p id="drawerErrorMessage" class="text-xs mt-0.5 leading-relaxed font-medium">
                                    {{ $selectedDevice['error_message'] ?? 'Hardware exception reported by edge node.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1: Hardware & Network Specifications -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Hardware & Network Technical Specs
                        </h4>

                        <div class="grid grid-cols-2 gap-3 bg-slate-50/70 p-3.5 rounded-xl border border-slate-200/80">
                            <div>
                                <span class="text-slate-400 block text-[10px]">Model & Manufacturer:</span>
                                <span id="drawerModel" class="font-semibold text-slate-800 text-xs">
                                    {{ $selectedDevice['model'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Hardware Serial No:</span>
                                <span id="drawerSerial" class="font-mono font-bold text-slate-800 text-xs">
                                    {{ $selectedDevice['serial_number'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">IP Address (Local Subnet):</span>
                                <span id="drawerIp" class="font-mono font-bold text-slate-800 text-xs">
                                    {{ $selectedDevice['ip_address'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">MAC Address:</span>
                                <span id="drawerMac" class="font-mono text-slate-700 text-xs">
                                    {{ $selectedDevice['mac_address'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Communication Protocol:</span>
                                <span id="drawerProtocol" class="font-mono text-slate-800 text-xs">
                                    {{ $selectedDevice['protocol'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Firmware Version:</span>
                                <span id="drawerFirmware" class="font-mono font-semibold text-slate-700 text-xs">
                                    {{ $selectedDevice['firmware_version'] ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Facility & Tenant Linkage -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Tenant & Facility Placement
                        </h4>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Tenant / Operator:</span>
                                <a id="drawerTenantLink" 
                                   href="/admin/tenants?q={{ urlencode($selectedDevice['vendor_name'] ?? '') }}" 
                                   class="font-semibold text-indigo-600 hover:underline">
                                    {{ $selectedDevice['vendor_name'] ?? '-' }}
                                </a>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Parking Facility:</span>
                                <a id="drawerLocationLink" 
                                   href="/admin/locations?q={{ urlencode($selectedDevice['location_name'] ?? '') }}" 
                                   class="font-semibold text-indigo-600 hover:underline">
                                    {{ $selectedDevice['location_name'] ?? '-' }} ({{ $selectedDevice['location_city'] ?? '' }})
                                </a>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Assigned Zone / Lane:</span>
                                <span id="drawerZone" class="font-semibold text-slate-800">
                                    {{ $selectedDevice['zone'] ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Last Telemetry Echo:</span>
                                <span id="drawerLastHeartbeat" class="font-mono text-slate-700">
                                    {{ $selectedDevice['last_heartbeat_at'] ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Telemetry Diagnostics -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-1">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                Diagnostic Telemetry Metrics
                            </h4>
                            <span class="text-[10px] text-slate-400 font-mono">Edge Poll Cycle 30s</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="text-slate-400 block text-[10px]">CPU Load</span>
                                <span id="drawerCpu" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ ($selectedDevice['telemetry']['cpu_load'] ?? null) !== null ? $selectedDevice['telemetry']['cpu_load'] . '%' : '-' }}
                                </span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="text-slate-400 block text-[10px]">Core Temp</span>
                                <span id="drawerTemp" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ ($selectedDevice['telemetry']['temp_c'] ?? null) !== null ? $selectedDevice['telemetry']['temp_c'] . '°C' : '-' }}
                                </span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="text-slate-400 block text-[10px]">Packet Loss</span>
                                <span id="drawerPacketLoss" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ ($selectedDevice['telemetry']['packet_loss'] ?? null) !== null ? $selectedDevice['telemetry']['packet_loss'] . '%' : '-' }}
                                </span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="text-slate-400 block text-[10px]">Uptime</span>
                                <span id="drawerUptime" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ ($selectedDevice['telemetry']['uptime_days'] ?? null) !== null ? $selectedDevice['telemetry']['uptime_days'] . 'd' : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Recent Diagnostic Event History -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Recent Diagnostic Events & Heartbeats
                        </h4>

                        <div id="drawerEventList" class="space-y-2">
                            @if(!empty($selectedDevice['recent_events']))
                                @foreach($selectedDevice['recent_events'] as $evt)
                                <div class="p-2.5 rounded-xl border text-xs {{ $evt['severity'] === 'critical' ? 'bg-rose-50/60 border-rose-200 text-rose-900' : ($evt['severity'] === 'warning' ? 'bg-amber-50/60 border-amber-200 text-amber-900' : 'bg-slate-50 border-slate-200 text-slate-700') }}">
                                    <div class="flex items-center justify-between text-[10px] font-mono mb-0.5">
                                        <span class="font-bold">{{ $evt['category'] }}</span>
                                        <span class="text-slate-400">{{ $evt['timestamp'] }}</span>
                                    </div>
                                    <p class="leading-relaxed">{{ $evt['summary'] }}</p>
                                </div>
                                @endforeach
                            @else
                                <p class="text-slate-400 text-xs italic">No event history recorded.</p>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between gap-3 shrink-0">
                    <button type="button" 
                            id="drawerPingButton"
                            onclick="triggerDrawerDiagnosticPing()"
                            class="px-3.5 py-2 rounded-xl bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 text-indigo-700 text-xs font-bold transition-colors flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
                        <span>Diagnostic Ping</span>
                    </button>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                onclick="openStatusFromDrawer()"
                                class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-bold transition-colors">
                            Change Status
                        </button>
                        <button type="button" 
                                onclick="closeDeviceDetail()"
                                class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-colors">
                            Close
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= STATUS OVERRIDE & MAINTENANCE MODAL ================= -->
    <div id="statusModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Manage Hardware Status</h3>
                    <p id="statusModalSubtitle" class="text-xs text-slate-500 mt-0.5">Override device status or toggle Maintenance Mode.</p>
                </div>
                <button type="button" onclick="closeStatusModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="statusOverrideForm" method="POST" action="" class="my-4 space-y-4 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Network Connectivity *</label>
                    <select id="modalConnectivity" name="connectivity" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="Online">Online (Connected)</option>
                        <option value="Degraded">Degraded (High Latency / Intermittent)</option>
                        <option value="Offline">Offline (Disconnected)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Operational Health *</label>
                    <select id="modalHealth" name="health" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="Operational">Operational (Nominal)</option>
                        <option value="Attention Required">Attention Required (Telemetry Warning)</option>
                        <option value="Maintenance">Maintenance Mode (Servicing in Progress)</option>
                        <option value="Fault">Fault (Hardware / Sensor Exception)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Audit Log Reason / Technician Note</label>
                    <textarea name="note" rows="3" placeholder="e.g. Cleared safety beam obstruction; tested 5 gate barrier cycles." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 border border-slate-200 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-xs">
                        Update Status
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= CLIENT JAVASCRIPT ================= -->
    <script>
        let currentActiveDeviceId = '{{ $selectedDevice['id'] ?? '' }}';
        let currentActiveDeviceCode = '{{ $selectedDevice['code'] ?? '' }}';

        /**
         * Open slide-over device inspection drawer with asynchronous payload fetch.
         */
        function openDeviceDetail(deviceId) {
            currentActiveDeviceId = deviceId;
            const drawer = document.getElementById('deviceDetailDrawer');
            drawer.classList.remove('hidden');

            fetch(`/api/admin/iot/${deviceId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.device) {
                        renderDeviceDetail(data.device);
                    }
                })
                .catch(err => {
                    console.error('Failed to load device details:', err);
                });
        }

        /**
         * Render loaded device object into drawer DOM elements.
         */
        function renderDeviceDetail(device) {
            currentActiveDeviceId = device.id;
            currentActiveDeviceCode = device.code;

            document.getElementById('drawerDeviceCode').textContent = device.code;
            document.getElementById('drawerDeviceName').textContent = device.name;
            document.getElementById('drawerDeviceTypeBadge').textContent = device.type;
            document.getElementById('drawerDeviceLocation').textContent = `${device.location_name} · ${device.zone}`;

            // Top Status Badges
            const connBadge = document.getElementById('drawerConnectivityBadge');
            connBadge.textContent = device.connectivity;
            connBadge.className = `font-bold text-xs ${device.connectivity === 'Online' ? 'text-emerald-700' : (device.connectivity === 'Degraded' ? 'text-amber-700' : 'text-rose-700')}`;

            const healthBadge = document.getElementById('drawerHealthBadge');
            healthBadge.textContent = device.health;
            healthBadge.className = `font-bold text-xs ${device.health === 'Fault' ? 'text-rose-700' : (device.health === 'Attention Required' ? 'text-amber-700' : 'text-emerald-700')}`;

            document.getElementById('drawerPingBadge').textContent = device.ping_ms !== null ? `${device.ping_ms}ms` : 'Timeout';
            document.getElementById('drawerFreshnessBadge').textContent = (device.freshness || 'FRESH').toUpperCase();

            // Exception Banner
            const banner = document.getElementById('drawerExceptionBanner');
            if (device.health === 'Fault' || device.health === 'Attention Required') {
                banner.classList.remove('hidden');
                document.getElementById('drawerErrorCode').textContent = device.error_code || 'ERR_EXCEPTION';
                document.getElementById('drawerErrorMessage').textContent = device.error_message || 'Operational exception flagged.';
            } else {
                banner.classList.add('hidden');
            }

            // Specs
            document.getElementById('drawerModel').textContent = device.model || '-';
            document.getElementById('drawerSerial').textContent = device.serial_number || '-';
            document.getElementById('drawerIp').textContent = device.ip_address || '-';
            document.getElementById('drawerMac').textContent = device.mac_address || '-';
            document.getElementById('drawerProtocol').textContent = device.protocol || '-';
            document.getElementById('drawerFirmware').textContent = device.firmware_version || '-';

            // Facility
            document.getElementById('drawerTenantLink').textContent = device.vendor_name || '-';
            document.getElementById('drawerTenantLink').href = `/admin/tenants?q=${encodeURIComponent(device.vendor_name || '')}`;
            document.getElementById('drawerLocationLink').textContent = `${device.location_name} (${device.location_city})`;
            document.getElementById('drawerLocationLink').href = `/admin/locations?q=${encodeURIComponent(device.location_name || '')}`;
            document.getElementById('drawerZone').textContent = device.zone || '-';
            document.getElementById('drawerLastHeartbeat').textContent = device.last_heartbeat_at || '-';

            // Telemetry
            const tel = device.telemetry || {};
            document.getElementById('drawerCpu').textContent = tel.cpu_load !== null && tel.cpu_load !== undefined ? `${tel.cpu_load}%` : '-';
            document.getElementById('drawerTemp').textContent = tel.temp_c !== null && tel.temp_c !== undefined ? `${tel.temp_c}°C` : '-';
            document.getElementById('drawerPacketLoss').textContent = tel.packet_loss !== null && tel.packet_loss !== undefined ? `${tel.packet_loss}%` : '-';
            document.getElementById('drawerUptime').textContent = tel.uptime_days !== null && tel.uptime_days !== undefined ? `${tel.uptime_days}d` : '-';

            // Events List
            const list = document.getElementById('drawerEventList');
            list.innerHTML = '';
            if (device.recent_events && device.recent_events.length > 0) {
                device.recent_events.forEach(evt => {
                    const card = document.createElement('div');
                    card.className = `p-2.5 rounded-xl border text-xs ${evt.severity === 'critical' ? 'bg-rose-50/60 border-rose-200 text-rose-900' : (evt.severity === 'warning' ? 'bg-amber-50/60 border-amber-200 text-amber-900' : 'bg-slate-50 border-slate-200 text-slate-700')}`;
                    card.innerHTML = `
                        <div class="flex items-center justify-between text-[10px] font-mono mb-0.5">
                            <span class="font-bold">${evt.category}</span>
                            <span class="text-slate-400">${evt.timestamp}</span>
                        </div>
                        <p class="leading-relaxed">${evt.summary}</p>
                    `;
                    list.appendChild(card);
                });
            } else {
                list.innerHTML = '<p class="text-slate-400 text-xs italic">No event history recorded.</p>';
            }
        }

        /**
         * Close slide-over device inspection drawer.
         */
        function closeDeviceDetail() {
            document.getElementById('deviceDetailDrawer').classList.add('hidden');
        }

        /**
         * Run diagnostic ping via AJAX with instant toast feedback.
         */
        function triggerDiagnosticPing(deviceId, deviceCode, btn) {
            const originalHtml = btn ? btn.innerHTML : null;
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<svg class="animate-spin" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>`;
            }

            fetch(`/admin/iot/${deviceId}/ping`, {
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
                showPingToast(data.success, data.message);
                if (currentActiveDeviceId === deviceId && data.device) {
                    renderDeviceDetail(data.device);
                }
            })
            .catch(err => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
                showPingToast(false, `Diagnostic ping failed: network request error.`);
            });
        }

        /**
         * Run diagnostic ping from inside drawer.
         */
        function triggerDrawerDiagnosticPing() {
            if (!currentActiveDeviceId) return;
            const btn = document.getElementById('drawerPingButton');
            triggerDiagnosticPing(currentActiveDeviceId, currentActiveDeviceCode, btn);
        }

        /**
         * Display non-intrusive bottom-right toast message.
         */
        function showPingToast(success, message) {
            const toast = document.getElementById('pingToast');
            const content = document.getElementById('pingToastContent');
            const icon = document.getElementById('pingToastIcon');
            const title = document.getElementById('pingToastTitle');
            const msg = document.getElementById('pingToastMessage');

            if (success) {
                content.className = 'p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white border-emerald-200 text-emerald-950';
                icon.className = 'w-8 h-8 rounded-xl flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600 font-bold';
                icon.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
                title.textContent = 'Diagnostic Ping Acknowledged';
                title.className = 'text-xs font-bold uppercase tracking-wider text-emerald-800';
            } else {
                content.className = 'p-4 rounded-2xl border shadow-xl flex items-start gap-3 bg-white border-rose-200 text-rose-950';
                icon.className = 'w-8 h-8 rounded-xl flex items-center justify-center shrink-0 bg-rose-100 text-rose-600 font-bold';
                icon.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
                title.textContent = 'Diagnostic Ping Failed';
                title.className = 'text-xs font-bold uppercase tracking-wider text-rose-800';
            }

            msg.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                hidePingToast();
            }, 6000);
        }

        function hidePingToast() {
            document.getElementById('pingToast').classList.add('hidden');
        }

        /**
         * Open administrative status modal.
         */
        function openStatusModal(deviceId, deviceCode, connectivity, health) {
            const form = document.getElementById('statusOverrideForm');
            form.action = `/admin/iot/${deviceId}/status`;
            document.getElementById('statusModalSubtitle').textContent = `Target: ${deviceCode}`;
            document.getElementById('modalConnectivity').value = connectivity;
            document.getElementById('modalHealth').value = health;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function openStatusFromDrawer() {
            if (!currentActiveDeviceId) return;
            const conn = document.getElementById('drawerConnectivityBadge').textContent.trim();
            const health = document.getElementById('drawerHealthBadge').textContent.trim();
            openStatusModal(currentActiveDeviceId, currentActiveDeviceCode, conn, health);
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }
    </script>

</x-layouts.admin>
