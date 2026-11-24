<x-layouts.admin activeNav="system-health" title="System Health & Observability — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Health Probes Completed</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- ================= PAGE HEADER & BREADCRUMBS ================= -->
    <div class="space-y-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">System Health</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Observability Node: {{ $telemetry['cluster_node'] }}</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Probed in <strong class="text-slate-700 font-mono">{{ $evalDuration }}ms</strong> ({{ $lastUpdated }})
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        System Health & Infrastructure
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 47
                    </span>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">
                        {{ $counts['total'] }} Services Monitored
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Real-time operational observability of application infrastructure, primary database, async workers, crons, and third-party gateways.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Trigger Real Health Check Probe -->
                <form action="{{ route('admin.system-health.refresh') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            title="Execute live diagnostics across all platform nodes"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-all shadow-xs shadow-indigo-600/30">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        <span>Run Live Diagnostics</span>
                    </button>
                </form>

                <!-- Export Telemetry CSV -->
                <a href="{{ route('admin.system-health.export', request()->query()) }}" 
                   title="Export telemetry records to CSV"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export (CSV)</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= 1. OVERALL PLATFORM HEALTH BANNER ================= -->
    <div class="mb-6">
        @if($overallStatus === 'healthy')
        <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-emerald-950 via-slate-900 to-slate-900 border border-emerald-500/40 text-white shadow-md relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-emerald-500/10 blur-2xl pointer-events-none"></div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/50 flex items-center justify-center shrink-0 text-emerald-400">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <h2 class="text-base sm:text-lg font-bold text-white tracking-tight">
                                {{ $overallLabel }}
                            </h2>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-500/30 text-emerald-300 border border-emerald-500/40">
                                99.98% SLA
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                            {{ $overallSummary }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-6 border-t md:border-t-0 md:border-l border-slate-800 pt-3 md:pt-0 md:pl-6 shrink-0">
                    <div class="text-left">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block">DB Latency</span>
                        <span class="text-base font-bold text-emerald-400 font-mono">{{ $database['latency_ms'] }} ms</span>
                    </div>
                    <div class="text-left">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block">Avg Latency</span>
                        <span class="text-base font-bold text-white font-mono">{{ $counts['avg_latency_ms'] }} ms</span>
                    </div>
                    <div class="text-left">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block">Error Rate</span>
                        <span class="text-base font-bold text-emerald-400 font-mono">{{ $performance['error_rate_pct'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        @elseif($overallStatus === 'degraded')
        <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-amber-950 via-slate-900 to-slate-900 border border-amber-500/50 text-white shadow-md">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-500/50 flex items-center justify-center shrink-0 text-amber-400">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                            <h2 class="text-base sm:text-lg font-bold text-white tracking-tight">
                                {{ $overallLabel }}
                            </h2>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-amber-500/30 text-amber-300 border border-amber-500/40">
                                Warning
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl">
                            {{ $overallSummary }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-rose-950 via-slate-900 to-slate-900 border border-rose-500/50 text-white shadow-md">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/20 border border-rose-500/50 flex items-center justify-center shrink-0 text-rose-400">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-400 animate-ping"></span>
                            <h2 class="text-base sm:text-lg font-bold text-white tracking-tight">
                                {{ $overallLabel }}
                            </h2>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-rose-500/30 text-rose-300 border border-rose-500/40">
                                Outage Alert
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl">
                            {{ $overallSummary }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- ================= 2. 5 COMPACT KPI METRIC CARDS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4 mb-6">
        
        <!-- Card 1: Monitored Services -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Active Services</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-slate-900 font-mono tracking-tight">
                    {{ $counts['healthy'] }} / {{ $counts['total'] }}
                </div>
                <div class="text-[11px] text-emerald-600 font-semibold mt-1 flex items-center gap-1">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>100% of core stack online</span>
                </div>
            </div>
        </div>

        <!-- Card 2: 30-Day SLA Availability -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>30-Day SLA Uptime</span>
                <span class="text-[10px] font-mono text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded font-bold">Goal 99.95%</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-indigo-600 font-mono tracking-tight">
                    {{ $telemetry['sla_uptime_30d'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Exceeds SLA contract target
                </div>
            </div>
        </div>

        <!-- Card 3: Avg Response Latency -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Avg Response Time</span>
                <span class="text-[10px] font-mono text-slate-400">P95</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-slate-900 font-mono tracking-tight">
                    {{ $counts['avg_latency_ms'] }} <span class="text-sm font-normal text-slate-500">ms</span>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Across 11 monitored services
                </div>
            </div>
        </div>

        <!-- Card 4: Error Rate -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>HTTP Error Rate</span>
                <span class="text-[10px] font-mono text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded font-bold">5xx Nominal</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-emerald-600 font-mono tracking-tight">
                    {{ $performance['error_rate_pct'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Success rate: <strong class="text-slate-700">{{ $performance['success_rate_pct'] }}</strong>
                </div>
            </div>
        </div>

        <!-- Card 5: Queue Backlog -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Async Queue Backlog</span>
                <span class="text-[10px] font-mono text-slate-400">Workers Active</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-slate-900 font-mono tracking-tight">
                    {{ $queue['pending_jobs'] }} <span class="text-sm font-normal text-slate-500">pend</span> / {{ $queue['failed_jobs'] }} <span class="text-sm font-normal text-slate-500">fail</span>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Heartbeat: <strong class="text-slate-700">{{ $queue['heartbeat'] }}</strong>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= 3. FILTER & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.system-health') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-end">
            
            <!-- Search Query -->
            <div class="lg:col-span-4">
                <label for="filter-q" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Search Service or Component
                </label>
                <div class="relative">
                    <input type="text" 
                           id="filter-q"
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search service name, driver, or diagnostic phrase..." 
                           class="w-full pl-9 pr-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>

            <!-- Category Selector -->
            <div class="lg:col-span-3">
                <label for="filter-category" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Service Category
                </label>
                <select id="filter-category" 
                        name="category" 
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-slate-700">
                    @foreach($categories as $key => $lbl)
                    <option value="{{ $key }}" {{ $filters['category'] === $key ? 'selected' : '' }}>
                        {{ $lbl }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Health Status Selector -->
            <div class="lg:col-span-3">
                <label for="filter-status" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Health Status
                </label>
                <select id="filter-status" 
                        name="status" 
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-slate-700">
                    @foreach($statuses as $key => $lbl)
                    <option value="{{ $key }}" {{ $filters['status'] === $key ? 'selected' : '' }}>
                        {{ $lbl }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions (Filter & Reset) -->
            <div class="lg:col-span-2 flex items-center gap-2">
                <button type="submit" 
                        class="flex-1 py-2 px-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-colors">
                    Filter
                </button>
                @if(!empty($filters['q']) || $filters['category'] !== 'all' || $filters['status'] !== 'all')
                <a href="{{ route('admin.system-health') }}" 
                   title="Reset filters"
                   class="p-2 text-slate-500 hover:text-slate-800 rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
                @endif
            </div>

        </form>
    </div>

    <!-- ================= 4. CORE SERVICES INVENTORY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-900">
                    Monitored Services & Component Topology
                </h3>
                <p class="text-xs text-slate-500">
                    Authoritative health state, roundtrip latency, and diagnostic heartbeats across national infrastructure.
                </p>
            </div>
            <span class="text-xs text-slate-500 font-mono font-medium">
                Showing {{ count($services) }} of {{ $counts['total'] }} services
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/75 text-[10px] uppercase font-bold text-slate-500 tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">Service & Component</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Health Status</th>
                        <th class="py-3 px-4">Latency</th>
                        <th class="py-3 px-4">30d SLA</th>
                        <th class="py-3 px-4">Diagnostic Summary</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($services as $srv)
                    <tr class="hover:bg-slate-50/60 transition-colors cursor-pointer group" onclick="openServiceDrawer('{{ $srv['id'] }}')">
                        
                        <!-- Service Name & Component -->
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-indigo-50 text-slate-600 group-hover:text-indigo-600 flex items-center justify-center font-mono font-bold text-xs shrink-0 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                        <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                        <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                        <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors block">
                                        {{ $srv['name'] }}
                                    </span>
                                    <span class="text-[11px] text-slate-400 font-mono">
                                        {{ $srv['component'] }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700">
                                {{ $srv['category_label'] }}
                            </span>
                        </td>

                        <!-- Health Status Badge -->
                        <td class="py-3 px-4">
                            @if($srv['status'] === 'healthy')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Operational</span>
                            </span>
                            @elseif($srv['status'] === 'degraded')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Degraded</span>
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                <span>Unavailable</span>
                            </span>
                            @endif
                        </td>

                        <!-- Latency -->
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-slate-800 text-xs">
                                    {{ $srv['latency_ms'] }} ms
                                </span>
                                @if($srv['latency_ms'] < 50)
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400" title="Low latency (<50ms)"></span>
                                @elseif($srv['latency_ms'] < 120)
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400" title="Moderate latency (<120ms)"></span>
                                @else
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400" title="High latency (>120ms)"></span>
                                @endif
                            </div>
                        </td>

                        <!-- 30d SLA -->
                        <td class="py-3 px-4 font-mono font-bold text-slate-700">
                            {{ $srv['uptime_pct'] }}
                        </td>

                        <!-- Diagnostic Summary -->
                        <td class="py-3 px-4 max-w-xs truncate text-[11px] text-slate-500" title="{{ $srv['diagnostic_message'] }}">
                            {{ $srv['diagnostic_message'] }}
                        </td>

                        <!-- Actions -->
                        <td class="py-3 px-4 text-right" onclick="event.stopPropagation()">
                            <button type="button" 
                                    onclick="openServiceDrawer('{{ $srv['id'] }}')"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 text-xs font-semibold transition-colors">
                                <span>Inspect</span>
                                <span class="text-slate-400">&rarr;</span>
                            </button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-sm font-semibold text-slate-600">No monitored services match your criteria.</p>
                            <p class="text-xs text-slate-400 mt-1">Try clearing your search query or reset the category filter.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= 5. DEEP-DIVE DIAGNOSTICS (4-QUADRANT GRID) ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <!-- Quadrant 1: Primary Database Cluster -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Primary Database Engine</h4>
                            <p class="text-[11px] text-slate-500 font-mono">Driver: {{ $database['driver'] }} • Connection: {{ $database['connection_status'] }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        {{ $database['latency_ms'] }} ms
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4 text-xs">
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Query Latency</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $database['latency_ms'] }} ms</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Connection Pool</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $database['pool_status'] }}</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Schema Integrity</span>
                        <strong class="text-slate-800">{{ $database['migrations_status'] }}</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Encoding & Collation</span>
                        <strong class="font-mono text-slate-800">{{ $database['charset'] }}</strong>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                Probe Note: <span class="text-slate-700">{{ $database['message'] }}</span>
            </div>
        </div>

        <!-- Quadrant 2: Async Queue Engine & Workers -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Background Queue & Worker Daemons</h4>
                            <p class="text-[11px] text-slate-500 font-mono">Driver: {{ $queue['driver'] }} • Status: {{ $queue['status'] }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Active Heartbeat
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4 text-xs">
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Pending Jobs</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $queue['pending_jobs'] }}</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Failed Jobs</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $queue['failed_jobs'] }}</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Supervisor Daemons</span>
                        <strong class="text-slate-800">{{ $queue['active_daemons'] }}</strong>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] font-mono text-slate-400 block uppercase">Last Heartbeat</span>
                        <strong class="font-mono text-slate-800">{{ $queue['heartbeat'] }}</strong>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                Queue Telemetry: <span class="text-slate-700">{{ $queue['message'] }}</span>
            </div>
        </div>

    </div>

    <!-- ================= 6. SCHEDULED CRON TASKS & EXTERNAL DEPENDENCIES ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <!-- Scheduled Tasks (Artisan Cron) -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div>
                    <h4 class="text-sm font-bold text-slate-900">Platform Scheduled Tasks (Crons)</h4>
                    <p class="text-[11px] text-slate-500">Scheduled crons maintaining telemetry rollups, billing, and session cleanup.</p>
                </div>
                <span class="text-xs font-mono font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded">
                    6 Active
                </span>
            </div>

            <div class="space-y-3">
                @foreach($scheduledTasks as $task)
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-mono font-bold text-slate-900">{{ $task['name'] }}</span>
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ $task['status_label'] }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-0.5">{{ $task['description'] }}</p>
                    </div>
                    <div class="text-right shrink-0">
                        <div class="font-mono text-[10px] text-slate-400">{{ $task['schedule'] }}</div>
                        <div class="text-[11px] text-slate-600 font-medium">Last: {{ $task['last_run'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- External Integrations & Gateways -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div>
                    <h4 class="text-sm font-bold text-slate-900">External Integrations & Third-Party APIs</h4>
                    <p class="text-[11px] text-slate-500">Live connectivity and response latency for upstream payment, notification, and GIS hosts.</p>
                </div>
                <span class="text-xs font-mono font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">
                    All Reachable
                </span>
            </div>

            <div class="space-y-3">
                
                <!-- Midtrans QRIS -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">QR</div>
                        <div>
                            <span class="font-bold text-slate-900 block">Midtrans QRIS Settlement Engine</span>
                            <span class="text-[10px] font-mono text-slate-400">api.midtrans.com/v2/status</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Optimal (88ms)</span>
                        <span class="block text-[10px] text-slate-400 font-mono mt-0.5">TLS 1.3 Verified</span>
                    </div>
                </div>

                <!-- Bank BCA VA -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-[10px]">VA</div>
                        <div>
                            <span class="font-bold text-slate-900 block">Bank BCA Corporate Virtual Account API</span>
                            <span class="text-[10px] font-mono text-slate-400">api.bca.co.id/va/v1/health</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Optimal (104ms)</span>
                        <span class="block text-[10px] text-slate-400 font-mono mt-0.5">mTLS Handshake OK</span>
                    </div>
                </div>

                <!-- WhatsApp Cloud API -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">WA</div>
                        <div>
                            <span class="font-bold text-slate-900 block">WhatsApp Cloud Business API</span>
                            <span class="text-[10px] font-mono text-slate-400">graph.facebook.com/v19.0/whatsapp</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Operational (142ms)</span>
                        <span class="block text-[10px] text-slate-400 font-mono mt-0.5">Rate Limit 14%</span>
                    </div>
                </div>

                <!-- OSM GIS Tile CDN -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-[10px]">GIS</div>
                        <div>
                            <span class="font-bold text-slate-900 block">OpenStreetMap / Leaflet High-Speed Tile CDN</span>
                            <span class="text-[10px] font-mono text-slate-400">tile.openstreetmap.org</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Fast (48ms)</span>
                        <span class="block text-[10px] text-slate-400 font-mono mt-0.5">Cache Hit 99.6%</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- ================= 7. 24-HOUR PERFORMANCE & LATENCY TREND ================= -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100 mb-4">
            <div>
                <h4 class="text-sm font-bold text-slate-900">24-Hour National Telemetry & Latency Profile</h4>
                <p class="text-xs text-slate-500">Hourly distribution of incoming API volume and response latency percentiles.</p>
            </div>
            <div class="flex items-center gap-3 text-xs">
                <span class="flex items-center gap-1.5 text-slate-600 font-medium">
                    <span class="w-3 h-3 rounded bg-indigo-600"></span>
                    <span>Response Latency (ms)</span>
                </span>
                <span class="flex items-center gap-1.5 text-slate-600 font-medium">
                    <span class="w-3 h-3 rounded bg-slate-200"></span>
                    <span>Throughput (Requests)</span>
                </span>
            </div>
        </div>

        <!-- 24-Hour Bar Chart Visualization -->
        <div class="grid grid-cols-6 sm:grid-cols-12 gap-2 items-end h-44 pt-4 px-2">
            @foreach($hourlyTrends as $item)
            @php
                $latencyH = min(100, max(15, ($item['latency_ms'] / 60) * 100));
            @endphp
            <div class="flex flex-col items-center gap-1.5 h-full justify-end group">
                <div class="w-full flex items-end justify-center gap-1 h-32 relative">
                    <!-- Tooltip -->
                    <div class="absolute -top-10 opacity-0 group-hover:opacity-100 transition-opacity bg-slate-900 text-white text-[10px] px-2 py-1 rounded shadow-lg pointer-events-none whitespace-nowrap z-20">
                        {{ $item['hour'] }}: {{ $item['latency_ms'] }}ms ({{ number_format($item['requests']) }} req)
                    </div>
                    <!-- Latency Bar -->
                    <div class="w-full max-w-[20px] rounded-t-md bg-indigo-600 group-hover:bg-indigo-700 transition-all" style="height: {{ $latencyH }}%"></div>
                </div>
                <span class="text-[10px] font-mono text-slate-400 group-hover:text-slate-800">
                    {{ $item['hour'] }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ================= 8. SLIDE-OVER SERVICE DETAIL DRAWER ================= -->
    <div id="serviceDrawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="drawer-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeServiceDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 sm:p-6 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span id="drawer-srv-status-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Operational
                            </span>
                            <span id="drawer-srv-category" class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-200 text-slate-700">
                                Core Infrastructure
                            </span>
                        </div>
                        <h3 id="drawer-srv-name" class="text-base sm:text-lg font-bold text-slate-900 mt-1">
                            Service Inspection
                        </h3>
                        <p id="drawer-srv-component" class="text-xs font-mono text-slate-500">
                            Component Technology
                        </p>
                    </div>

                    <button type="button" onclick="closeServiceDrawer()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-6 text-xs text-slate-600">
                    
                    <!-- Metrics Quick Grid -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Live Telemetry Metrics</h4>
                        <div id="drawer-srv-metrics-grid" class="grid grid-cols-2 gap-3">
                            <!-- Populated dynamically -->
                        </div>
                    </div>

                    <!-- Diagnostic Note -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">Diagnostic Report</h4>
                        <p id="drawer-srv-diagnostic" class="text-xs text-slate-700 leading-relaxed font-medium">
                            Diagnostic details...
                        </p>
                    </div>

                    <!-- Dependencies List -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Service Dependencies</h4>
                        <ul id="drawer-srv-dependencies" class="space-y-1.5">
                            <!-- Populated dynamically -->
                        </ul>
                    </div>

                    <!-- Runbook & Troubleshooting Advice -->
                    <div class="p-4 rounded-xl bg-indigo-50/70 border border-indigo-100 text-indigo-950">
                        <h4 class="text-xs font-bold text-indigo-900 flex items-center gap-1.5 mb-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>On-Call Runbook & Remediation</span>
                        </h4>
                        <p id="drawer-srv-runbook" class="text-[11px] text-indigo-800 leading-relaxed">
                            Runbook advice...
                        </p>
                    </div>

                </div>

                <!-- Drawer Footer -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between text-xs">
                    <span class="text-slate-500">
                        Evaluated: <strong id="drawer-srv-last-checked" class="text-slate-700 font-mono">Just now</strong>
                    </span>
                    <button type="button" onclick="closeServiceDrawer()" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition-colors">
                        Close Drawer
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= CLIENT SCRIPTS ================= -->
    @push('scripts')
    <script>
        function openServiceDrawer(srvId) {
            const drawer = document.getElementById('serviceDrawer');
            if (!drawer) return;

            drawer.classList.remove('hidden');

            fetch(`/api/admin/system-health/services/${srvId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success || !data.service) return;
                    const srv = data.service;

                    document.getElementById('drawer-srv-name').textContent = srv.name;
                    document.getElementById('drawer-srv-component').textContent = `${srv.component} (${srv.id})`;
                    document.getElementById('drawer-srv-category').textContent = srv.category_label || srv.category;
                    document.getElementById('drawer-srv-diagnostic').textContent = srv.diagnostic_message;
                    document.getElementById('drawer-srv-runbook').textContent = srv.runbook || 'No special runbook instructions. Escalate to platform DevOps if unavailable.';
                    document.getElementById('drawer-srv-last-checked').textContent = srv.last_checked;

                    const statusBadge = document.getElementById('drawer-srv-status-badge');
                    if (srv.status === 'healthy') {
                        statusBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200';
                        statusBadge.textContent = 'Operational (Healthy)';
                    } else if (srv.status === 'degraded') {
                        statusBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200';
                        statusBadge.textContent = 'Degraded Performance';
                    } else {
                        statusBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200';
                        statusBadge.textContent = 'Service Unavailable';
                    }

                    // Metrics Grid
                    const metricsGrid = document.getElementById('drawer-srv-metrics-grid');
                    metricsGrid.innerHTML = '';
                    if (srv.metrics) {
                        for (const [k, v] of Object.entries(srv.metrics)) {
                            const div = document.createElement('div');
                            div.className = 'p-2.5 rounded-xl bg-slate-50 border border-slate-100';
                            div.innerHTML = `<span class="text-[10px] font-mono text-slate-400 block uppercase">${k}</span><strong class="text-xs font-mono text-slate-800">${v}</strong>`;
                            metricsGrid.appendChild(div);
                        }
                    }

                    // Dependencies
                    const depList = document.getElementById('drawer-srv-dependencies');
                    depList.innerHTML = '';
                    if (srv.dependencies && srv.dependencies.length > 0) {
                        srv.dependencies.forEach(dep => {
                            const li = document.createElement('li');
                            li.className = 'flex items-center gap-2 text-slate-700';
                            li.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span><span>${dep}</span>`;
                            depList.appendChild(li);
                        });
                    } else {
                        depList.innerHTML = '<li class="text-slate-400 italic">No external dependencies declared.</li>';
                    }
                })
                .catch(err => console.error("Error inspecting service:", err));
        }

        function closeServiceDrawer() {
            const drawer = document.getElementById('serviceDrawer');
            if (drawer) drawer.classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeServiceDrawer();
            }
        });

        @if(!empty($selectedService))
        document.addEventListener('DOMContentLoaded', function() {
            openServiceDrawer('{{ $selectedService['id'] }}');
        });
        @endif
    </script>
    @endpush

</x-layouts.admin>
