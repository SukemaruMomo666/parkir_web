<x-layouts.admin activeNav="alerts" title="Operational Alerts & Triage — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Triage Action Completed</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Action Restricted</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-5 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 shadow-xs" role="alert">
        <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-800 mb-1">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            <span>Validation Error</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-0.5 text-amber-800">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- ================= PAGE HEADER & BREADCRUMBS ================= -->
    <div class="space-y-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">Alerts</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                    <span>{{ $summary['active_alerts'] }} Active Operational Alerts</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Triage Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Operational Alerts & Triage
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 48
                    </span>
                    @if($summary['critical_alerts'] > 0)
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                        <span>{{ $summary['critical_alerts'] }} Critical Urgency</span>
                    </span>
                    @endif
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Centralized operational triage for hardware telemetry dropouts, gate interlocks, payment webhook latencies, and tenant compliance alerts.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.alerts', request()->query()) }}" 
                   title="Refresh active alerts queue"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.alerts.export', request()->query()) }}" 
                   title="Export filtered alerts to CSV"
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

    <!-- ================= ALERT SUMMARY METRICS (5 CARDS) ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4 mb-6">
        
        <!-- Card 1: Total Active Alerts -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Active Alerts</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-slate-900 font-mono tracking-tight">
                    {{ $summary['active_alerts'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Total recorded: <strong class="text-slate-700">{{ $summary['total_alerts'] }}</strong>
                </div>
            </div>
        </div>

        <!-- Card 2: Critical Priority -->
        <div class="bg-white p-4 rounded-2xl border {{ $summary['critical_alerts'] > 0 ? 'border-rose-300 bg-rose-50/20' : 'border-slate-200/90' }} shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Critical Urgency</span>
                <span class="w-2 h-2 rounded-full {{ $summary['critical_alerts'] > 0 ? 'bg-rose-500 animate-ping' : 'bg-slate-300' }}"></span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-rose-600 font-mono tracking-tight">
                    {{ $summary['critical_alerts'] }}
                </div>
                <div class="text-[11px] {{ $summary['critical_alerts'] > 0 ? 'text-rose-600 font-bold' : 'text-slate-500' }} mt-1">
                    Immediate triage required
                </div>
            </div>
        </div>

        <!-- Card 3: High Priority -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>High Priority</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-amber-600 font-mono tracking-tight">
                    {{ $summary['high_alerts'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Elevated degradation
                </div>
            </div>
        </div>

        <!-- Card 4: Unacknowledged -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Unacknowledged</span>
                <span class="text-[10px] font-mono text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded font-bold">New Queue</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-slate-900 font-mono tracking-tight">
                    {{ $summary['unacknowledged_alerts'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Awaiting admin response
                </div>
            </div>
        </div>

        <!-- Card 5: Resolved / Suppressed -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                <span>Resolved / Muted</span>
                <span class="text-[10px] font-mono text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded font-bold">Archived</span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-bold text-emerald-600 font-mono tracking-tight">
                    {{ $summary['resolved_alerts'] }} <span class="text-xs font-normal text-slate-400">res</span> / {{ $summary['suppressed_alerts'] }} <span class="text-xs font-normal text-slate-400">mute</span>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    Historic & suppressed
                </div>
            </div>
        </div>

    </div>

    <!-- ================= SEARCH & FILTERS TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.alerts') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-end">
            
            <!-- Search Query -->
            <div class="lg:col-span-3">
                <label for="filter-q" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Search Alert Details
                </label>
                <div class="relative">
                    <input type="text" 
                           id="filter-q"
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search title, ID, device, or location..." 
                           class="w-full pl-9 pr-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>

            <!-- Severity Selector -->
            <div class="lg:col-span-2">
                <label for="filter-severity" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Severity
                </label>
                <select id="filter-severity" 
                        name="severity" 
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-slate-700">
                    @foreach($severities as $key => $lbl)
                    <option value="{{ $key }}" {{ $filters['severity'] === $key ? 'selected' : '' }}>
                        {{ $lbl }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Category Selector -->
            <div class="lg:col-span-2">
                <label for="filter-category" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Category Source
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

            <!-- Tenant / Vendor Selector -->
            <div class="lg:col-span-2">
                <label for="filter-vendor" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Operator Tenant
                </label>
                <select id="filter-vendor" 
                        name="vendor" 
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-slate-700">
                    <option value="all">All Tenants</option>
                    @foreach($tenants as $t)
                    <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                        {{ $t['company_name'] }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Lifecycle State Selector -->
            <div class="lg:col-span-2">
                <label for="filter-lifecycle" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-1">
                    Lifecycle State
                </label>
                <select id="filter-lifecycle" 
                        name="lifecycle" 
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-slate-700">
                    @foreach($lifecycles as $key => $lbl)
                    <option value="{{ $key }}" {{ $filters['lifecycle'] === $key ? 'selected' : '' }}>
                        {{ $lbl }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions (Filter & Reset) -->
            <div class="lg:col-span-1 flex items-center gap-1.5">
                <button type="submit" 
                        class="w-full py-2 px-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-colors">
                    Apply
                </button>
                @if(!empty($filters['q']) || $filters['severity'] !== 'all' || $filters['category'] !== 'all' || $filters['vendor'] !== 'all' || $filters['lifecycle'] !== 'active')
                <a href="{{ route('admin.alerts') }}" 
                   title="Reset filters to default active view"
                   class="p-2 text-slate-500 hover:text-slate-800 rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
                @endif
            </div>

        </form>
    </div>

    <!-- ================= BULK ACTIONS TOOLBAR (Appears when checkboxes checked) ================= -->
    <form id="bulkActionForm" method="POST" action="{{ route('admin.alerts.bulk') }}">
        @csrf
        <div id="bulkActionBar" class="mb-4 p-3 bg-indigo-900 text-white rounded-2xl shadow-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3 hidden transition-all">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-indigo-700 flex items-center justify-center text-xs font-bold font-mono" id="bulkCountBadge">
                    0
                </span>
                <span class="text-xs font-medium">
                    alert(s) selected for batch triage action
                </span>
            </div>
            
            <div class="flex items-center gap-2">
                <button type="submit" 
                        name="action" 
                        value="acknowledge"
                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl text-xs transition-colors flex items-center gap-1.5">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Acknowledge Selected</span>
                </button>
                <button type="button" 
                        onclick="openBulkResolveModal()"
                        class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition-colors flex items-center gap-1.5">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                    <span>Resolve Selected...</span>
                </button>
                <button type="button" 
                        onclick="clearBulkSelections()" 
                        class="px-2.5 py-1.5 text-slate-300 hover:text-white text-xs font-medium">
                    Cancel
                </button>
            </div>
        </div>

        <!-- ================= ALERT INVENTORY TABLE ================= -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
            
            <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">
                        Operational Alerts Inventory
                    </h3>
                    <p class="text-xs text-slate-500">
                        Ranked by severity and deduplicated repeat event occurrence counts.
                    </p>
                </div>
                <div class="text-xs text-slate-500 font-medium">
                    Showing <strong class="text-slate-800">{{ $pagination['from'] }}-{{ $pagination['to'] }}</strong> of <strong class="text-slate-800">{{ $pagination['total'] }}</strong> alerts
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/75 text-[10px] uppercase font-bold text-slate-500 tracking-wider border-b border-slate-200/80">
                        <tr>
                            <th class="py-3 px-3 w-8 text-center">
                                <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            </th>
                            <th class="py-3 px-3">Severity</th>
                            <th class="py-3 px-4">Alert Title & Affected Resource</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Tenant & Location</th>
                            <th class="py-3 px-4">Repeats & Freshness</th>
                            <th class="py-3 px-4">Lifecycle State</th>
                            <th class="py-3 px-4 text-right">Triage Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($alerts as $alt)
                        <tr class="hover:bg-slate-50/70 transition-colors cursor-pointer group {{ $alt['severity'] === 'critical' && $alt['lifecycle'] === 'new' ? 'bg-rose-50/20' : '' }}" onclick="openAlertDrawer('{{ $alt['id'] }}')">
                            
                            <!-- Checkbox -->
                            <td class="py-3 px-3 text-center" onclick="event.stopPropagation()">
                                <input type="checkbox" 
                                       name="selected_alerts[]" 
                                       value="{{ $alt['id'] }}" 
                                       onchange="updateBulkSelectionState()" 
                                       class="alert-checkbox rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            </td>

                            <!-- Severity Badge -->
                            <td class="py-3 px-3 shrink-0">
                                @if($alt['severity'] === 'critical')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                                    <span>Critical</span>
                                </span>
                                @elseif($alt['severity'] === 'high')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                    <span>High</span>
                                </span>
                                @elseif($alt['severity'] === 'medium')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>Medium</span>
                                </span>
                                @elseif($alt['severity'] === 'low')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <span>Low</span>
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <span>Info</span>
                                </span>
                                @endif
                            </td>

                            <!-- Alert Title & Resource -->
                            <td class="py-3 px-4 max-w-sm">
                                <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors block text-xs">
                                    {{ $alt['title'] }}
                                </span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[10px] font-mono text-slate-400 font-semibold">{{ $alt['id'] }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-[10px] font-mono px-1.5 py-0.2 rounded bg-slate-100 text-slate-600">
                                        {{ $alt['resource_id'] }}
                                    </span>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-3 px-4">
                                <span class="text-[11px] text-slate-600 block">
                                    {{ $alt['category_label'] }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">
                                    {{ $alt['resource_type'] }}
                                </span>
                            </td>

                            <!-- Tenant & Location -->
                            <td class="py-3 px-4">
                                <span class="font-semibold text-slate-800 block text-xs truncate max-w-[180px]">
                                    {{ $alt['vendor_name'] }}
                                </span>
                                <span class="text-[11px] text-slate-500 block truncate max-w-[180px]">
                                    {{ $alt['location_name'] }}
                                </span>
                            </td>

                            <!-- Repeats & Freshness -->
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-700">
                                        &times;{{ $alt['repeat_count'] }}
                                    </span>
                                    <span class="text-[11px] text-slate-700 font-semibold">
                                        {{ $alt['freshness'] }}
                                    </span>
                                </div>
                                <span class="text-[10px] text-slate-400 block mt-0.5">
                                    First: {{ $alt['first_seen'] }}
                                </span>
                            </td>

                            <!-- Lifecycle State -->
                            <td class="py-3 px-4">
                                @if($alt['lifecycle'] === 'new')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    New
                                </span>
                                @elseif($alt['lifecycle'] === 'acknowledged')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    Acknowledged
                                </span>
                                @elseif($alt['lifecycle'] === 'investigating')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    Investigating
                                </span>
                                @elseif($alt['lifecycle'] === 'resolved')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Resolved
                                </span>
                                @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                    Suppressed
                                </span>
                                @endif

                                @if(!empty($alt['acknowledged_by']))
                                <span class="text-[9px] text-slate-400 block mt-0.5">
                                    By: {{ $alt['acknowledged_by'] }}
                                </span>
                                @endif
                            </td>

                            <!-- Triage Actions -->
                            <td class="py-3 px-4 text-right" onclick="event.stopPropagation()">
                                <div class="inline-flex items-center gap-1">
                                    
                                    @if($alt['lifecycle'] === 'new')
                                    <button type="button" 
                                            onclick="openAcknowledgeModal('{{ $alt['id'] }}', '{{ addslashes($alt['title']) }}')"
                                            class="px-2 py-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-lg text-xs font-bold transition-colors">
                                        Ack
                                    </button>
                                    @endif

                                    @if($alt['lifecycle'] !== 'resolved')
                                    <button type="button" 
                                            onclick="openResolveModal('{{ $alt['id'] }}', '{{ addslashes($alt['title']) }}')"
                                            class="px-2 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold transition-colors">
                                        Resolve
                                    </button>
                                    @endif

                                    <button type="button" 
                                            onclick="openAlertDrawer('{{ $alt['id'] }}')"
                                            class="px-2 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition-colors">
                                        Details &rarr;
                                    </button>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <p class="text-sm font-semibold text-slate-600">No active operational alerts match your criteria.</p>
                                <p class="text-xs text-slate-400 mt-1">Platform monitoring indicates all systems and facilities are nominal.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Server-Side Pagination Bar -->
            @if($pagination['last_page'] > 1)
            <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>
                
                <div class="flex items-center gap-1.5">
                    @if($pagination['current_page'] > 1)
                    <a href="{{ route('admin.alerts', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                        &larr; Previous
                    </a>
                    @endif

                    @if($pagination['current_page'] < $pagination['last_page'])
                    <a href="{{ route('admin.alerts', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                        Next &rarr;
                    </a>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </form>

    <!-- ================= SLIDE-OVER ALERT DETAIL DRAWER ================= -->
    <div id="alertDrawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="drawer-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAlertDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 sm:p-6 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span id="drawer-alt-sev-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                Critical
                            </span>
                            <span id="drawer-alt-lifecycle-badge" class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-200 text-slate-700">
                                New
                            </span>
                            <span id="drawer-alt-id" class="text-xs font-mono font-bold text-slate-500">
                                ALT-2026-1001
                            </span>
                        </div>
                        <h3 id="drawer-alt-title" class="text-base sm:text-lg font-bold text-slate-900 mt-1">
                            Alert Inspection
                        </h3>
                        <p id="drawer-alt-location" class="text-xs text-slate-500">
                            Location & Tenant
                        </p>
                    </div>

                    <button type="button" onclick="closeAlertDrawer()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-6 text-xs text-slate-600">
                    
                    <!-- Affected Resource Card -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-mono text-slate-400 block uppercase">Target Component Resource</span>
                            <strong id="drawer-alt-resource" class="text-xs font-mono text-slate-900">GW-SBY-E03 (Edge Gateway)</strong>
                        </div>
                        <a id="drawer-alt-resource-link" href="#" class="px-2.5 py-1 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-xs transition-colors">
                            Inspect Target &rarr;
                        </a>
                    </div>

                    <!-- Diagnostics & Description -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Operational Description</h4>
                        <p id="drawer-alt-description" class="text-xs text-slate-800 leading-relaxed font-medium bg-slate-50 p-3 rounded-xl border border-slate-100">
                            Alert description...
                        </p>
                    </div>

                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Diagnostic Telemetry Summary</h4>
                        <p id="drawer-alt-diagnostic" class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-3 rounded-xl border border-slate-100">
                            Diagnostic telemetry...
                        </p>
                    </div>

                    <!-- Suggested On-Call Runbook -->
                    <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200 text-amber-950">
                        <h4 class="text-xs font-bold text-amber-900 flex items-center gap-1.5 mb-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>Suggested On-Call Runbook</span>
                        </h4>
                        <p id="drawer-alt-runbook" class="text-[11px] text-amber-800 leading-relaxed">
                            Runbook advice...
                        </p>
                    </div>

                    <!-- Audit Timeline -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Alert Lifecycle & Audit Timeline</h4>
                        <div id="drawer-alt-timeline" class="space-y-2 border-l-2 border-slate-200 pl-3 ml-2">
                            <!-- Populated dynamically -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Actions Footer -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex flex-wrap items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <button type="button" id="drawer-btn-ack" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors">
                            Acknowledge
                        </button>
                        <button type="button" id="drawer-btn-resolve" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-colors">
                            Mark Resolved
                        </button>
                        <button type="button" id="drawer-btn-suppress" class="px-2.5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition-colors">
                            Suppress
                        </button>
                    </div>
                    <button type="button" onclick="closeAlertDrawer()" class="px-3 py-2 text-slate-500 hover:text-slate-800 font-semibold">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= ACKNOWLEDGE MODAL ================= -->
    <div id="ackModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="ack-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAcknowledgeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="ackForm" method="POST" action="">
                    @csrf
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="ack-modal-title">Acknowledge Alert</h3>
                            <p class="text-xs text-slate-500" id="ack-modal-subtitle">Record triage ownership</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Triage Note (Optional)</label>
                            <input type="text" name="note" placeholder="e.g. Field crew dispatched to Surabaya East Hub Gate 3" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeAcknowledgeModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-colors">Confirm Acknowledgement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= RESOLVE MODAL ================= -->
    <div id="resolveModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="resolve-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeResolveModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="resolveForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="resolve-modal-title">Mark Alert as Resolved</h3>
                            <p class="text-xs text-slate-500" id="resolve-modal-subtitle">Save root-cause resolution summary</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Resolution Summary Note <span class="text-rose-500">*</span></label>
                            <textarea name="resolution_note" required rows="3" placeholder="Explain the root cause and remedy (e.g. Media converter power cycled; fiber link restored. Zero barcode buffer loss)." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeResolveModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-colors">Confirm Resolution</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= SUPPRESS MODAL ================= -->
    <div id="suppressModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="suppress-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeSuppressModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="suppressForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Suppress / Mute Alert</h3>
                            <p class="text-xs text-slate-500" id="suppress-modal-subtitle">Silence alerts during scheduled maintenance</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Suppression Reason <span class="text-rose-500">*</span></label>
                            <input type="text" name="reason" required placeholder="e.g. Planned on-site electrical panel maintenance" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-slate-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Mute Duration</label>
                            <select name="hours" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs">
                                <option value="4">4 Hours</option>
                                <option value="8">8 Hours</option>
                                <option value="24" selected>24 Hours</option>
                                <option value="72">3 Days</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeSuppressModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition-colors">Suppress Alert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= BULK RESOLVE MODAL ================= -->
    <div id="bulkResolveModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="bulk-resolve-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeBulkResolveModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Bulk Resolve Selected Alerts</h3>
                        <p class="text-xs text-slate-500">Provide common resolution note</p>
                    </div>
                </div>

                <div class="space-y-3 text-xs mb-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Common Resolution Note</label>
                        <input type="text" id="bulk-note-input" placeholder="e.g. Resolved following nationwide gateway sync" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeBulkResolveModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                    <button type="button" onclick="submitBulkResolve()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-colors">Confirm Bulk Resolve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= CLIENT SCRIPTS ================= -->
    @push('scripts')
    <script>
        // Checkbox Bulk Selection Logic
        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.alert-checkbox');
            checkboxes.forEach(cb => cb.checked = master.checked);
            updateBulkSelectionState();
        }

        function updateBulkSelectionState() {
            const checked = document.querySelectorAll('.alert-checkbox:checked');
            const bar = document.getElementById('bulkActionBar');
            const countBadge = document.getElementById('bulkCountBadge');
            
            if (checked.length > 0) {
                bar.classList.remove('hidden');
                countBadge.textContent = checked.length;
            } else {
                bar.classList.add('hidden');
                countBadge.textContent = '0';
            }
        }

        function clearBulkSelections() {
            const checkboxes = document.querySelectorAll('.alert-checkbox');
            checkboxes.forEach(cb => cb.checked = false);
            const master = document.getElementById('selectAllCheckbox');
            if (master) master.checked = false;
            updateBulkSelectionState();
        }

        function openBulkResolveModal() {
            document.getElementById('bulkResolveModal').classList.remove('hidden');
        }

        function closeBulkResolveModal() {
            document.getElementById('bulkResolveModal').classList.add('hidden');
        }

        function submitBulkResolve() {
            const form = document.getElementById('bulkActionForm');
            const noteInput = document.createElement('input');
            noteInput.type = 'hidden';
            noteInput.name = 'bulk_note';
            noteInput.value = document.getElementById('bulk-note-input').value;
            form.appendChild(noteInput);

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'resolve';
            form.appendChild(actionInput);

            form.submit();
        }

        // Slide-Over Detail Drawer
        function openAlertDrawer(altId) {
            const drawer = document.getElementById('alertDrawer');
            if (!drawer) return;

            drawer.classList.remove('hidden');

            fetch(`/api/admin/alerts/${altId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success || !data.alert) return;
                    const alt = data.alert;

                    document.getElementById('drawer-alt-id').textContent = alt.id;
                    document.getElementById('drawer-alt-title').textContent = alt.title;
                    document.getElementById('drawer-alt-location').textContent = `${alt.location_name} • ${alt.vendor_name}`;
                    document.getElementById('drawer-alt-resource').textContent = `${alt.resource_id} (${alt.resource_type})`;
                    document.getElementById('drawer-alt-description').textContent = alt.description;
                    document.getElementById('drawer-alt-diagnostic').textContent = alt.diagnostic_summary;
                    document.getElementById('drawer-alt-runbook').textContent = alt.suggested_runbook || 'Follow standard triage procedures.';

                    // Resource link
                    const resLink = document.getElementById('drawer-alt-resource-link');
                    if (alt.related_route) {
                        resLink.href = alt.related_route;
                        resLink.textContent = `${alt.related_route_label || 'Inspect Target'} \u2192`;
                        resLink.style.display = 'inline-block';
                    } else {
                        resLink.style.display = 'none';
                    }

                    // Severity Badge
                    const sevBadge = document.getElementById('drawer-alt-sev-badge');
                    sevBadge.textContent = alt.severity.toUpperCase();
                    if (alt.severity === 'critical') {
                        sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200';
                    } else if (alt.severity === 'high') {
                        sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200';
                    } else {
                        sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200';
                    }

                    // Lifecycle Badge
                    const lcBadge = document.getElementById('drawer-alt-lifecycle-badge');
                    lcBadge.textContent = alt.lifecycle_label || alt.lifecycle;

                    // Audit Timeline
                    const timelineEl = document.getElementById('drawer-alt-timeline');
                    timelineEl.innerHTML = '';
                    if (alt.timeline && alt.timeline.length > 0) {
                        alt.timeline.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'relative text-[11px]';
                            div.innerHTML = `
                                <div class="font-bold text-slate-800 flex items-center gap-2">
                                    <span>${item.event}</span>
                                    <span class="text-slate-400 font-mono text-[10px]">• ${item.time}</span>
                                </div>
                                <div class="text-slate-500">${item.note}</div>
                                <div class="text-[10px] text-indigo-600 font-mono">Actor: ${item.actor}</div>
                            `;
                            timelineEl.appendChild(div);
                        });
                    }

                    // Setup Drawer Action Buttons
                    const btnAck = document.getElementById('drawer-btn-ack');
                    const btnResolve = document.getElementById('drawer-btn-resolve');
                    const btnSuppress = document.getElementById('drawer-btn-suppress');

                    if (alt.lifecycle === 'resolved') {
                        btnAck.style.display = 'none';
                        btnResolve.style.display = 'none';
                        btnSuppress.style.display = 'none';
                    } else {
                        btnAck.style.display = (alt.lifecycle === 'new') ? 'inline-block' : 'none';
                        btnResolve.style.display = 'inline-block';
                        btnSuppress.style.display = 'inline-block';

                        btnAck.onclick = () => {
                            closeAlertDrawer();
                            openAcknowledgeModal(alt.id, alt.title);
                        };
                        btnResolve.onclick = () => {
                            closeAlertDrawer();
                            openResolveModal(alt.id, alt.title);
                        };
                        btnSuppress.onclick = () => {
                            closeAlertDrawer();
                            openSuppressModal(alt.id, alt.title);
                        };
                    }
                })
                .catch(err => console.error("Could not fetch alert detail:", err));
        }

        function closeAlertDrawer() {
            const drawer = document.getElementById('alertDrawer');
            if (drawer) drawer.classList.add('hidden');
        }

        // Modals Logic
        function openAcknowledgeModal(altId, title) {
            const modal = document.getElementById('ackModal');
            if (!modal) return;
            document.getElementById('ackForm').action = `/admin/alerts/${altId}/acknowledge`;
            document.getElementById('ack-modal-title').textContent = `Acknowledge ${altId}`;
            document.getElementById('ack-modal-subtitle').textContent = title;
            modal.classList.remove('hidden');
        }

        function closeAcknowledgeModal() {
            const modal = document.getElementById('ackModal');
            if (modal) modal.classList.add('hidden');
        }

        function openResolveModal(altId, title) {
            const modal = document.getElementById('resolveModal');
            if (!modal) return;
            document.getElementById('resolveForm').action = `/admin/alerts/${altId}/resolve`;
            document.getElementById('resolve-modal-title').textContent = `Resolve ${altId}`;
            document.getElementById('resolve-modal-subtitle').textContent = title;
            modal.classList.remove('hidden');
        }

        function closeResolveModal() {
            const modal = document.getElementById('resolveModal');
            if (modal) modal.classList.add('hidden');
        }

        function openSuppressModal(altId, title) {
            const modal = document.getElementById('suppressModal');
            if (!modal) return;
            document.getElementById('suppressForm').action = `/admin/alerts/${altId}/suppress`;
            document.getElementById('suppress-modal-subtitle').textContent = `Muting ${altId}: ${title}`;
            modal.classList.remove('hidden');
        }

        function closeSuppressModal() {
            const modal = document.getElementById('suppressModal');
            if (modal) modal.classList.add('hidden');
        }

        // Escape Key Listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAlertDrawer();
                closeAcknowledgeModal();
                closeResolveModal();
                closeSuppressModal();
                closeBulkResolveModal();
            }
        });

        @if(!empty($selectedAlert))
        document.addEventListener('DOMContentLoaded', function() {
            openAlertDrawer('{{ $selectedAlert['id'] }}');
        });
        @endif
    </script>
    @endpush

</x-layouts.admin>
