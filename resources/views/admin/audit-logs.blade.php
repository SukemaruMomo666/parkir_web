<x-layouts.admin activeNav="audit-logs" title="Audit Logs & Platform Integrity — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Audit Operation Completed</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Audit Query Notice</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
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
                <span class="font-medium text-slate-400">Platform Reliability</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">Audit Logs</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-900 text-slate-200 border border-slate-700 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Immutable Ledger • 365d Retention</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Authority Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Audit Logs
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 51
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Append-Only Active</span>
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Review recorded administrative actions and platform activity.
                </p>
            </div>

            <!-- Actions Row (Refresh & Real CSV Export; NO manual create button) -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.audit-logs', request()->query()) }}" 
                   title="Refresh audit event stream"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Export CSV Button (Real stream download) -->
                <a href="{{ route('admin.audit-logs.export', request()->query()) }}" 
                   title="Export currently filtered audit logs to RFC CSV"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export Audit CSV</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
        <!-- Card 1: Total Events -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Recorded</span>
                <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ number_format($summary['total_events']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Events in current scope</p>
            </div>
        </div>

        <!-- Card 2: Successful Operations -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-emerald-700">Successful</span>
                <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-emerald-600 tracking-tight">
                    {{ number_format($summary['success_events']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Authorized & completed</p>
            </div>
        </div>

        <!-- Card 3: Security Denials -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-amber-700">Access Denied</span>
                <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-amber-600 tracking-tight">
                    {{ number_format($summary['denied_events']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">RBAC & auth challenges</p>
            </div>
        </div>

        <!-- Card 4: Failed Operations -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-rose-700">Failed Actions</span>
                <div class="w-7 h-7 rounded-lg bg-rose-50 flex items-center justify-center text-rose-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-rose-600 tracking-tight">
                    {{ number_format($summary['failed_events']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Execution & system faults</p>
            </div>
        </div>

        <!-- Card 5: Distinct Actors -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-indigo-700">Active Actors</span>
                <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-indigo-600 tracking-tight">
                    {{ number_format($summary['distinct_actors']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Human & bot identities</p>
            </div>
        </div>
    </div>

    <!-- ================= SEARCH & MULTI-DIMENSIONAL FILTERS ================= -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.audit-logs') }}" id="auditFilterForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4">
                <!-- Search Input -->
                <div class="sm:col-span-2">
                    <label for="q" class="block text-xs font-semibold text-slate-700 mb-1">
                        Search Audit Trail
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <input type="text" 
                               name="q" 
                               id="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search log ID, actor, event, resource ID, IP, or correlation ID..." 
                               class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 transition-colors">
                    </div>
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-xs font-semibold text-slate-700 mb-1">
                        Action Category
                    </label>
                    <select name="category" id="category" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['category'] === 'all' ? 'selected' : '' }}>All Categories</option>
                        @foreach($categories as $catKey => $catInfo)
                        <option value="{{ $catKey }}" {{ $filters['category'] === $catKey ? 'selected' : '' }}>
                            {{ $catInfo['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Outcome Filter -->
                <div>
                    <label for="outcome" class="block text-xs font-semibold text-slate-700 mb-1">
                        Recorded Outcome
                    </label>
                    <select name="outcome" id="outcome" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['outcome'] === 'all' ? 'selected' : '' }}>All Outcomes</option>
                        <option value="success" {{ $filters['outcome'] === 'success' ? 'selected' : '' }}>Successful Operations</option>
                        <option value="denied" {{ $filters['outcome'] === 'denied' ? 'selected' : '' }}>Access Denied (RBAC)</option>
                        <option value="failed" {{ $filters['outcome'] === 'failed' ? 'selected' : '' }}>Execution Failed</option>
                    </select>
                </div>

                <!-- Resource Type Filter -->
                <div>
                    <label for="resource_type" class="block text-xs font-semibold text-slate-700 mb-1">
                        Resource Type
                    </label>
                    <select name="resource_type" id="resource_type" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['resource_type'] === 'all' ? 'selected' : '' }}>All Resource Types</option>
                        @foreach($resourceTypes as $resKey => $resInfo)
                        <option value="{{ $resKey }}" {{ $filters['resource_type'] === $resKey ? 'selected' : '' }}>
                            {{ $resInfo['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Actor Filter -->
                <div>
                    <label for="actor" class="block text-xs font-semibold text-slate-700 mb-1">
                        Actor / Account
                    </label>
                    <select name="actor" id="actor" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['actor'] === 'all' ? 'selected' : '' }}>All Actors</option>
                        @foreach($actors as $actorName)
                        <option value="{{ $actorName }}" {{ strtolower($filters['actor']) === strtolower($actorName) ? 'selected' : '' }}>
                            {{ $actorName }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Time Period Filter -->
                <div>
                    <label for="period" class="block text-xs font-semibold text-slate-700 mb-1">
                        Time Window
                    </label>
                    <select name="period" id="period" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['period'] === 'all' ? 'selected' : '' }}>All Recorded History</option>
                        <option value="today" {{ $filters['period'] === 'today' ? 'selected' : '' }}>Today (Past 24 Hours)</option>
                        <option value="7d" {{ $filters['period'] === '7d' ? 'selected' : '' }}>Past 7 Days</option>
                        <option value="30d" {{ $filters['period'] === '30d' ? 'selected' : '' }}>Past 30 Days</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort" class="block text-xs font-semibold text-slate-700 mb-1">
                        Chronological Order
                    </label>
                    <select name="sort" id="sort" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="newest" {{ $filters['sort'] === 'newest' ? 'selected' : '' }}>Newest First (Default)</option>
                        <option value="oldest" {{ $filters['sort'] === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="actor_asc" {{ $filters['sort'] === 'actor_asc' ? 'selected' : '' }}>Actor Name (A-Z)</option>
                    </select>
                </div>
            </div>

            <!-- Filter Action Buttons -->
            <div class="flex items-center justify-between pt-3 border-t border-slate-100 flex-wrap gap-2">
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs flex items-center gap-1.5">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                        <span>Apply Filters</span>
                    </button>

                    @php
                        $hasActiveFilters = $filters['q'] !== '' || 
                                           $filters['category'] !== 'all' || 
                                           $filters['outcome'] !== 'all' || 
                                           $filters['resource_type'] !== 'all' || 
                                           $filters['actor'] !== 'all' || 
                                           $filters['period'] !== 'all' || 
                                           $filters['sort'] !== 'newest';
                    @endphp

                    @if($hasActiveFilters)
                    <a href="{{ route('admin.audit-logs') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-medium transition-colors flex items-center gap-1">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Reset Filters</span>
                    </a>
                    @endif
                </div>

                <div class="text-xs text-slate-500">
                    Showing <strong>{{ $logs->total() }}</strong> total matching records
                </div>
            </div>
        </form>
    </div>

    <!-- ================= MAIN AUDIT LOG LEDGER TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        <!-- Table Top Bar -->
        <div class="p-4 sm:px-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Audit Trail Activity Inventory</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-600 font-semibold">
                        {{ $logs->total() }} Logged Entries
                    </span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Authoritative chronological record of platform administrative interventions.</p>
            </div>
            
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Audit Level: High Integrity</span>
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <th class="py-3 px-4 whitespace-nowrap">Timestamp & Event ID</th>
                        <th class="py-3 px-4">Actor / Origin</th>
                        <th class="py-3 px-4">Action & Category</th>
                        <th class="py-3 px-4">Target Resource</th>
                        <th class="py-3 px-4">Tenant Scope</th>
                        <th class="py-3 px-4 text-center">Outcome</th>
                        <th class="py-3 px-4 text-right">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($logs as $log)
                    @php
                        // Category pill colors
                        $catStyles = match($log['category']) {
                            'auth_security' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                            'tenant_management' => 'bg-purple-50 text-purple-700 border-purple-200',
                            'financial_ops' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'iot_hardware' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'api_policy' => 'bg-cyan-50 text-cyan-700 border-cyan-200',
                            'incident_response' => 'bg-rose-50 text-rose-700 border-rose-200',
                            'system_config' => 'bg-slate-100 text-slate-700 border-slate-200',
                            default => 'bg-slate-100 text-slate-600 border-slate-200',
                        };

                        // Outcome styles
                        $outcomeStyles = match($log['outcome'] ?? 'success') {
                            'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'denied' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'failed' => 'bg-rose-50 text-rose-700 border-rose-200',
                            default => 'bg-slate-50 text-slate-700 border-slate-200',
                        };

                        $isHuman = ($log['actor_type'] ?? 'human') === 'human';
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <!-- Timestamp & ID -->
                        <td class="py-3.5 px-4 whitespace-nowrap align-top">
                            <div class="font-mono font-bold text-slate-900 text-xs">
                                {{ $log['id'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5">
                                {{ $log['timestamp'] }}
                            </div>
                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                {{ $log['correlation_id'] ?? 'corr-auto' }}
                            </div>
                        </td>

                        <!-- Actor -->
                        <td class="py-3.5 px-4 align-top">
                            <div class="flex items-start gap-2.5">
                                <div class="w-7 h-7 rounded-lg {{ $isHuman ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-200 text-slate-700' }} flex items-center justify-center shrink-0 font-bold text-[10px] uppercase">
                                    @if($isHuman)
                                        {{ substr($log['actor'], 0, 2) }}
                                    @else
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold text-slate-900">{{ $log['actor'] }}</span>
                                        <span class="px-1.5 py-0.2 rounded text-[9px] font-mono {{ $isHuman ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                            {{ $isHuman ? 'Human' : 'System Bot' }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-500">
                                        {{ $log['actor_role'] ?? 'Platform Role' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                        IP: {{ $log['ip_address'] ?? '127.0.0.1' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Action & Category -->
                        <td class="py-3.5 px-4 align-top">
                            <div class="font-bold text-slate-900 text-xs">
                                {{ $log['event_name'] }}
                            </div>
                            <div class="font-mono text-[10px] text-slate-500 mt-0.5">
                                {{ $log['event'] }}
                            </div>
                            <div class="mt-1">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold border {{ $catStyles }}">
                                    {{ $categories[$log['category']]['name'] ?? ucfirst($log['category']) }}
                                </span>
                            </div>
                        </td>

                        <!-- Target Resource -->
                        <td class="py-3.5 px-4 align-top">
                            <div class="flex items-center gap-1.5">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $resourceTypes[$log['resource_type']]['label'] ?? $log['resource_type'] }}
                                </span>
                            </div>
                            <div class="font-bold text-slate-900 text-xs mt-1">
                                @if(!empty($log['resource_link']))
                                    <a href="{{ $log['resource_link'] }}" class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center gap-1">
                                        <span>{{ $log['resource_id'] }}</span>
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                    </a>
                                @else
                                    <span class="font-mono">{{ $log['resource_id'] ?? 'N/A' }}</span>
                                @endif
                            </div>
                            @if(!empty($log['resource_name']))
                            <div class="text-[11px] text-slate-500 truncate max-w-xs" title="{{ $log['resource_name'] }}">
                                {{ $log['resource_name'] }}
                            </div>
                            @endif
                        </td>

                        <!-- Tenant Scope -->
                        <td class="py-3.5 px-4 align-top whitespace-nowrap">
                            @if(!empty($log['vendor_name']))
                                <div class="font-medium text-slate-900 text-xs">{{ $log['vendor_name'] }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">{{ $log['vendor_id'] }}</div>
                            @else
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                    <span>Global / Core</span>
                                </span>
                            @endif
                        </td>

                        <!-- Outcome -->
                        <td class="py-3.5 px-4 align-top text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $outcomeStyles }}">
                                @if(($log['outcome'] ?? 'success') === 'success')
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>Success</span>
                                @elseif(($log['outcome'] ?? '') === 'denied')
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <span>Denied</span>
                                @else
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    <span>Failed</span>
                                @endif
                            </span>
                        </td>

                        <!-- Details Button -->
                        <td class="py-3.5 px-4 align-top text-right whitespace-nowrap">
                            <button type="button" 
                                    onclick="openAuditDrawer('{{ $log['id'] }}')" 
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 border border-slate-200 hover:border-indigo-200 text-xs font-semibold transition-colors">
                                <span>Inspect</span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="max-w-sm mx-auto text-center space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <circle cx="11" cy="14" r="3"></circle>
                                        <line x1="14" y1="17" x2="17" y2="20"></line>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">No Recorded Audit Logs Found</h4>
                                <p class="text-xs text-slate-500">
                                    No administrative actions matched your current filters. Adjust search keywords or time range filters.
                                </p>
                                <a href="{{ route('admin.audit-logs') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                                    <span>Reset All Filters</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($logs->hasPages())
        <div class="p-4 sm:px-6 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-xs text-slate-500">
                Showing <strong>{{ $logs->firstItem() ?? 0 }}</strong> to <strong>{{ $logs->lastItem() ?? 0 }}</strong> of <strong>{{ $logs->total() }}</strong> records
            </div>
            <div>
                {{ $logs->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- ================= SLIDE-OVER DETAIL DRAWER ================= -->
    <div id="auditDrawerBackdrop" 
         onclick="closeAuditDrawer()" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity opacity-0"></div>

    <div id="auditDrawer" 
         class="fixed top-0 right-0 h-full w-full sm:w-[540px] md:w-[600px] lg:w-[640px] bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- Drawer Header -->
        <div class="p-5 border-b border-slate-200 bg-slate-50/80 flex items-start justify-between gap-3 shrink-0">
            <div>
                <div class="flex items-center gap-2">
                    <span id="drawerLogId" class="font-mono text-xs font-bold text-slate-900 px-2 py-0.5 rounded bg-slate-200">
                        AUD-2026-000
                    </span>
                    <span id="drawerOutcomeBadge" class="px-2 py-0.5 rounded-full text-[10px] font-bold border bg-emerald-50 text-emerald-700 border-emerald-200">
                        Success
                    </span>
                    <span id="drawerCategoryBadge" class="px-2 py-0.5 rounded text-[10px] font-semibold border bg-indigo-50 text-indigo-700 border-indigo-200">
                        Category
                    </span>
                </div>
                <h3 id="drawerEventName" class="text-base font-bold text-slate-900 mt-1.5 leading-snug">
                    Administrative Action Detail
                </h3>
                <p id="drawerTimestamp" class="text-xs text-slate-500 mt-0.5">
                    Timestamp placeholder
                </p>
            </div>
            <button type="button" 
                    onclick="closeAuditDrawer()" 
                    title="Close Drawer (Esc)" 
                    class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- Drawer Scrollable Content -->
        <div class="p-5 sm:p-6 overflow-y-auto space-y-6 flex-1 text-xs">
            
            <!-- Event Technical Metadata -->
            <div class="grid grid-cols-2 gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Event Identifier</span>
                    <span id="drawerEventKey" class="font-mono font-bold text-slate-800 text-[11px] block mt-0.5">api.key.rotate</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Correlation ID</span>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span id="drawerCorrelationId" class="font-mono text-slate-800 text-[11px]">corr-xxx</span>
                        <button type="button" onclick="copyCorrelationId()" title="Copy Correlation ID" class="text-slate-400 hover:text-indigo-600">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actor Attribution Card -->
            <div class="p-4 rounded-xl border border-slate-200/90 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Actor Attribution</span>
                    <span id="drawerActorType" class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                        Human Admin
                    </span>
                </div>
                <div class="flex items-start gap-3">
                    <div id="drawerActorAvatar" class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-bold text-sm flex items-center justify-center shrink-0">
                        DL
                    </div>
                    <div class="space-y-0.5 flex-1">
                        <div id="drawerActorName" class="text-sm font-bold text-slate-900">Dewi Lestari</div>
                        <div id="drawerActorRole" class="text-slate-500 font-medium">Security Lead</div>
                        <div id="drawerActorEmail" class="text-slate-400 font-mono text-[11px]">dewi.lestari@nusapark.id</div>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-[11px]">
                    <div>
                        <span class="text-slate-400 text-[10px] block">Client IPv4 Address</span>
                        <span id="drawerIpAddress" class="font-mono font-bold text-slate-700">180.252.110.14</span>
                    </div>
                    <div>
                        <span class="text-slate-400 text-[10px] block">Client Environment</span>
                        <span id="drawerUserAgent" class="text-slate-600 truncate block" title="Browser / Agent">Chrome / Win10</span>
                    </div>
                </div>
            </div>

            <!-- Target Resource & Tenant Scope Card -->
            <div class="p-4 rounded-xl border border-slate-200/90 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Target Affected Resource</span>
                    <span id="drawerResourceType" class="px-2 py-0.5 rounded text-[10px] font-mono font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                        api_client
                    </span>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <span id="drawerResourceId" class="font-mono font-bold text-indigo-600 text-sm">client-qris-midtrans</span>
                        <a id="drawerResourceBtn" href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-600 hover:text-indigo-800 hover:underline">
                            <span>Open Resource</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                    </div>
                    <div id="drawerResourceName" class="text-slate-700 font-medium text-xs mt-0.5">Midtrans QRIS Settlement</div>
                </div>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-slate-400">Tenant / Operator Scope:</span>
                    <span id="drawerTenantScope" class="font-semibold text-slate-800">PT Parkir Cipta Nusantara</span>
                </div>
            </div>

            <!-- Narrative Description -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Event Narrative & Operational Context</span>
                <p id="drawerDescription" class="text-slate-700 leading-relaxed text-xs">
                    Description text
                </p>
            </div>

            <!-- Before-and-After Change Diff Snapshot -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Field-Level Change Snapshot</span>
                    <span class="text-[10px] text-slate-400">Before & After State</span>
                </div>
                
                <div id="drawerChangesContainer" class="rounded-xl border border-slate-200 overflow-hidden">
                    <!-- Populated dynamically via JS -->
                </div>
            </div>

            <!-- Immutability & Compliance Seal -->
            <div class="p-3.5 rounded-xl bg-slate-900 text-slate-300 text-[11px] space-y-1 border border-slate-800">
                <div class="flex items-center gap-1.5 text-emerald-400 font-bold text-xs uppercase tracking-wider">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>Immutability & Integrity Guarantee</span>
                </div>
                <p class="text-slate-400 leading-relaxed text-[10px]">
                    This record was cryptographically signed and stored in an append-only audit ledger upon event execution. Per Bank Indonesia regulatory requirements and ISO 27001 compliance standards, records are permanently retained for 365 days and cannot be modified or purged by any administrator.
                </p>
            </div>

        </div>

        <!-- Drawer Footer -->
        <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between shrink-0">
            <span class="text-[10px] text-slate-400">NusaPark SRE SecOps Audit Subsystem</span>
            <button type="button" 
                    onclick="closeAuditDrawer()" 
                    class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-xl text-xs font-semibold transition-colors">
                Close Panel
            </button>
        </div>
    </div>

    <!-- Embedded Scripts for Drawer and URL State Management -->
    <script>
        // Global storage for audit logs on the current page to enable instant drawer population
        const pageAuditLogs = @json($logs->items());
        const categoryLabels = @json($categories);
        const resourceTypeLabels = @json($resourceTypes);

        function openAuditDrawer(logId) {
            let log = pageAuditLogs.find(item => item.id === logId);

            if (log) {
                renderDrawer(log);
            } else {
                // Fetch dynamically via API if not in current page dataset
                fetch(`/api/admin/audit-logs/${encodeURIComponent(logId)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.audit_log) {
                            renderDrawer(data.audit_log);
                        } else {
                            alert(data.message || 'Audit log record could not be loaded.');
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching audit log:', err);
                        alert('Failed to connect to audit log service.');
                    });
            }
        }

        function renderDrawer(log) {
            // Log ID & Timestamp
            document.getElementById('drawerLogId').textContent = log.id;
            document.getElementById('drawerTimestamp').textContent = `${log.timestamp} • ${log.created_at || ''}`;
            document.getElementById('drawerEventName').textContent = log.event_name;
            document.getElementById('drawerEventKey').textContent = log.event;
            document.getElementById('drawerCorrelationId').textContent = log.correlation_id || 'corr-none';

            // Outcome badge
            const outcomeBadge = document.getElementById('drawerOutcomeBadge');
            outcomeBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-bold border ';
            if (log.outcome === 'success') {
                outcomeBadge.className += 'bg-emerald-50 text-emerald-700 border-emerald-200';
                outcomeBadge.textContent = 'Success';
            } else if (log.outcome === 'denied') {
                outcomeBadge.className += 'bg-amber-50 text-amber-700 border-amber-200';
                outcomeBadge.textContent = 'Access Denied';
            } else {
                outcomeBadge.className += 'bg-rose-50 text-rose-700 border-rose-200';
                outcomeBadge.textContent = 'Failed';
            }

            // Category badge
            const catBadge = document.getElementById('drawerCategoryBadge');
            const catInfo = categoryLabels[log.category];
            catBadge.textContent = catInfo ? catInfo.name : (log.category || 'General');

            // Actor info
            const isHuman = (log.actor_type || 'human') === 'human';
            document.getElementById('drawerActorType').textContent = isHuman ? 'Human Admin' : 'System Bot';
            document.getElementById('drawerActorName').textContent = log.actor;
            document.getElementById('drawerActorRole').textContent = log.actor_role || 'Super Admin Role';
            document.getElementById('drawerActorEmail').textContent = log.actor_email || 'system-daemon@nusapark.id';
            document.getElementById('drawerActorAvatar').textContent = isHuman ? log.actor.substring(0, 2).toUpperCase() : '🤖';
            document.getElementById('drawerIpAddress').textContent = log.ip_address || '127.0.0.1';
            document.getElementById('drawerUserAgent').textContent = log.user_agent || 'Platform Core Automation Kernel';

            // Resource info
            const resInfo = resourceTypeLabels[log.resource_type];
            document.getElementById('drawerResourceType').textContent = resInfo ? resInfo.label : log.resource_type;
            document.getElementById('drawerResourceId').textContent = log.resource_id || 'Global Core';
            document.getElementById('drawerResourceName').textContent = log.resource_name || 'Platform Scope';
            document.getElementById('drawerTenantScope').textContent = log.vendor_name || 'Global / Platform Core';

            const resBtn = document.getElementById('drawerResourceBtn');
            if (log.resource_link) {
                resBtn.href = log.resource_link;
                resBtn.style.display = 'inline-flex';
            } else {
                resBtn.style.display = 'none';
            }

            // Description
            document.getElementById('drawerDescription').textContent = log.description || 'No contextual narrative recorded for this event.';

            // Changes diff table
            const container = document.getElementById('drawerChangesContainer');
            if (log.changes && log.changes.length > 0) {
                let html = `
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200">
                                <th class="py-2 px-3">Field</th>
                                <th class="py-2 px-3">Previous State (Old)</th>
                                <th class="py-2 px-3">Recorded State (New)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                `;

                log.changes.forEach(ch => {
                    const oldVal = (ch.old !== null && ch.old !== undefined && ch.old !== '') ? ch.old : '<span class="text-slate-400 italic">null / none</span>';
                    const newVal = (ch.new !== null && ch.new !== undefined && ch.new !== '') ? ch.new : '<span class="text-slate-400 italic">null / none</span>';

                    html += `
                        <tr class="hover:bg-slate-50">
                            <td class="py-2 px-3 font-mono font-bold text-slate-700">${escapeHtml(ch.field)}</td>
                            <td class="py-2 px-3 font-mono text-rose-700 bg-rose-50/40">${oldVal}</td>
                            <td class="py-2 px-3 font-mono font-semibold text-emerald-700 bg-emerald-50/40">${newVal}</td>
                        </tr>
                    `;
                });

                html += `</tbody></table>`;
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div class="p-3.5 bg-slate-50 text-slate-500 text-center text-xs">
                        No field-level state changes were recorded for this action.
                    </div>
                `;
            }

            // Open animations
            const backdrop = document.getElementById('auditDrawerBackdrop');
            const drawer = document.getElementById('auditDrawer');

            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            }, 10);

            // Update URL query parameter without page reload
            const url = new URL(window.location.href);
            url.searchParams.set('detail', log.id);
            window.history.replaceState({}, '', url);
        }

        function closeAuditDrawer() {
            const backdrop = document.getElementById('auditDrawerBackdrop');
            const drawer = document.getElementById('auditDrawer');

            drawer.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0');

            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);

            // Clear ?detail query parameter without reload
            const url = new URL(window.location.href);
            url.searchParams.delete('detail');
            window.history.replaceState({}, '', url);
        }

        function copyCorrelationId() {
            const corr = document.getElementById('drawerCorrelationId').textContent;
            navigator.clipboard.writeText(corr).then(() => {
                alert(`Correlation ID copied to clipboard: ${corr}`);
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Close on Escape key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAuditDrawer();
            }
        });

        // Auto-open on page load if ?detail=AUD-xxx is present in URL
        document.addEventListener('DOMContentLoaded', function() {
            @if(!empty($selectedLog))
                openAuditDrawer('{{ $selectedLog['id'] }}');
            @endif
        });
    </script>
</x-layouts.admin>
