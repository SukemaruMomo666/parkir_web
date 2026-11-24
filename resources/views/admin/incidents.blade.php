<x-layouts.admin activeNav="incidents" title="Incident Management & SRE Response — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Incident Operation Completed</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Operation Restricted</p>
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
                <span class="font-semibold text-slate-700">Incident Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                    <span>{{ $summary['open_incidents'] }} Active Open Incidents</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    SRE Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Incident Management
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 49
                    </span>
                    @if($summary['critical_sev1'] > 0)
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                        <span>{{ $summary['critical_sev1'] }} SEV-1 Critical</span>
                    </span>
                    @endif
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Centralized SRE workspace to declare, investigate, assign, escalate, and resolve operational incidents across platform facilities and microservices.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.incidents', request()->query()) }}" 
                   title="Refresh active incidents queue"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.incidents.export', request()->query()) }}" 
                   title="Export filtered incidents to CSV"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export (CSV)</span>
                </a>

                <!-- Declare Incident Modal Trigger -->
                <button type="button" 
                        onclick="openDeclareModal()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all shadow-sm shadow-rose-600/30">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Declare Incident</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ================= 5 INCIDENT SUMMARY METRIC CARDS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 mb-6">
        <!-- Open Incidents -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Active Open</span>
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['open_incidents'] }}</span>
                <span class="text-[11px] font-semibold text-rose-600">Under SRE</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Open, investigating, or escalated</p>
        </div>

        <!-- Critical SEV-1 -->
        <div class="bg-white p-4 rounded-2xl border border-rose-200 shadow-xs bg-gradient-to-br from-white to-rose-50/30">
            <div class="flex items-center justify-between text-rose-600 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">SEV-1 Critical</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-rose-700 tracking-tight">{{ $summary['critical_sev1'] }}</span>
                <span class="text-[11px] font-semibold text-rose-600">Tier-3 Priority</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-1">Platform-wide or facility outage</p>
        </div>

        <!-- Major SEV-2 -->
        <div class="bg-white p-4 rounded-2xl border border-amber-200 shadow-xs">
            <div class="flex items-center justify-between text-amber-600 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">SEV-2 Major</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-amber-700 tracking-tight">{{ $summary['major_sev2'] }}</span>
                <span class="text-[11px] font-semibold text-amber-600">Degraded Ops</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Gateway or hardware dropouts</p>
        </div>

        <!-- Unassigned Incidents -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Unassigned</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['unassigned_incidents'] }}</span>
                @if($summary['unassigned_incidents'] > 0)
                <span class="text-[11px] font-semibold text-rose-600">Needs Dispatch</span>
                @else
                <span class="text-[11px] font-semibold text-emerald-600">All Assigned</span>
                @endif
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Awaiting SRE responder ownership</p>
        </div>

        <!-- Resolved / Closed -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Resolved / Closed</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['resolved_incidents'] + $summary['closed_incidents'] }}</span>
                <span class="text-[11px] font-semibold text-emerald-600">Verified</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Remediated with root-cause logged</p>
        </div>
    </div>

    <!-- ================= SEARCH AND FILTERS TOOLBAR ================= -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.incidents') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">
                <!-- Search Box -->
                <div class="lg:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Search Incidents</label>
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Ref ID, title, facility, service..." 
                               class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                    </div>
                </div>

                <!-- Severity Filter -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Severity</label>
                    <select name="severity" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Severities</option>
                        <option value="sev1" {{ $filters['severity'] === 'sev1' ? 'selected' : '' }}>SEV-1 Critical</option>
                        <option value="sev2" {{ $filters['severity'] === 'sev2' ? 'selected' : '' }}>SEV-2 Major</option>
                        <option value="sev3" {{ $filters['severity'] === 'sev3' ? 'selected' : '' }}>SEV-3 Moderate</option>
                        <option value="sev4" {{ $filters['severity'] === 'sev4' ? 'selected' : '' }}>SEV-4 Minor</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Lifecycle Status</label>
                    <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Statuses</option>
                        <option value="open" {{ $filters['status'] === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="investigating" {{ $filters['status'] === 'investigating' ? 'selected' : '' }}>Under Investigation</option>
                        <option value="escalated" {{ $filters['status'] === 'escalated' ? 'selected' : '' }}>Escalated (Tier-3)</option>
                        <option value="resolved" {{ $filters['status'] === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $filters['status'] === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Responder Filter -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">SRE Responder</label>
                    <select name="responder" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Responders</option>
                        <option value="unassigned" {{ $filters['responder'] === 'unassigned' ? 'selected' : '' }}>⚠️ Unassigned Only</option>
                        @foreach($responders as $rKey => $resp)
                            @if($rKey !== 'unassigned')
                            <option value="{{ $rKey }}" {{ $filters['responder'] === $rKey ? 'selected' : '' }}>
                                {{ $resp['name'] }} ({{ $resp['role'] }})
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Tenant / Operator Filter -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Tenant Operator</label>
                    <select name="vendor" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Tenants</option>
                        @foreach($tenants as $t)
                        <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                            {{ $t['company_name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Bottom Row: Sort & Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100 text-xs">
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Sort Order:</span>
                    <select name="sort" class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="priority_desc" {{ $filters['sort'] === 'priority_desc' ? 'selected' : '' }}>Highest Severity / Open First</option>
                        <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Newest Declared</option>
                        <option value="date_asc" {{ $filters['sort'] === 'date_asc' ? 'selected' : '' }}>Oldest Declared</option>
                        <option value="sev_asc" {{ $filters['sort'] === 'sev_asc' ? 'selected' : '' }}>SEV-1 &rarr; SEV-4</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    @if(!empty($filters['q']) || $filters['severity'] !== 'all' || $filters['status'] !== 'all' || $filters['responder'] !== 'all' || $filters['vendor'] !== 'all' || $filters['sort'] !== 'priority_desc')
                    <a href="{{ route('admin.incidents') }}" class="px-3 py-2 text-slate-500 hover:text-slate-800 font-semibold transition-colors">
                        Clear Filters
                    </a>
                    @endif
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-xs">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- ================= INCIDENT INVENTORY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">Incident Ref & Severity</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Affected Scope & Service</th>
                        <th class="py-3 px-4">Facility & Tenant</th>
                        <th class="py-3 px-4">SRE Responder</th>
                        <th class="py-3 px-4">Timeline</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($incidents as $inc)
                    <tr class="hover:bg-slate-50/70 transition-colors cursor-pointer group" onclick="openIncidentDrawer('{{ $inc['id'] }}')">
                        
                        <!-- Incident Ref & Severity -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-mono font-bold text-xs text-indigo-600 group-hover:underline">
                                    {{ $inc['id'] }}
                                </span>
                                
                                @if($inc['severity'] === 'sev1')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-pulse"></span>
                                    SEV-1 Critical
                                </span>
                                @elseif($inc['severity'] === 'sev2')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    SEV-2 Major
                                </span>
                                @elseif($inc['severity'] === 'sev3')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                    SEV-3 Moderate
                                </span>
                                @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    SEV-4 Minor
                                </span>
                                @endif
                            </div>
                            <p class="font-bold text-slate-900 text-xs sm:text-sm line-clamp-1">
                                {{ $inc['title'] }}
                            </p>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($inc['status'] === 'open')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                Open
                            </span>
                            @elseif($inc['status'] === 'investigating')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                Investigating
                            </span>
                            @elseif($inc['status'] === 'escalated')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-800 border border-rose-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                                Escalated (Tier-3)
                            </span>
                            @elseif($inc['status'] === 'resolved')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Resolved
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                Closed
                            </span>
                            @endif
                        </td>

                        <!-- Affected Scope & Service -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-1.5 flex-wrap mb-1">
                                <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-slate-100 text-slate-800 border border-slate-200">
                                    {{ $inc['affected_service'] }}
                                </span>
                                @if(!empty($inc['resource_id']))
                                <span class="text-[10px] font-mono text-slate-500">
                                    [{{ $inc['resource_id'] }}]
                                </span>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                {{ $inc['impact_summary'] }}
                            </p>
                        </td>

                        <!-- Facility & Tenant -->
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-slate-900 block line-clamp-1">
                                {{ $inc['location_name'] }}
                            </span>
                            <div class="flex items-center gap-1 text-[11px] text-slate-500 mt-0.5">
                                <span>{{ $inc['vendor_name'] }}</span>
                                <span>•</span>
                                <span class="font-medium text-slate-600">{{ $inc['location_city'] }}</span>
                            </div>
                        </td>

                        <!-- SRE Responder -->
                        <td class="py-3.5 px-4" onclick="event.stopPropagation()">
                            @if(!empty($inc['assigned_responder']) && $inc['assigned_responder'] !== 'unassigned')
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($inc['responder_name'] ?? 'S', 0, 1)) }}
                                </div>
                                <div>
                                    <span class="font-bold text-slate-800 block text-xs">{{ $inc['responder_name'] }}</span>
                                    <span class="text-[10px] text-slate-400 block">{{ $inc['responder_role'] }}</span>
                                </div>
                            </div>
                            @else
                            <button type="button" 
                                    onclick="openAssignModal('{{ $inc['id'] }}', 'unassigned', '{{ addslashes($inc['title']) }}')"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition-colors">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <span>Assign Responder</span>
                            </button>
                            @endif
                        </td>

                        <!-- Timeline / Timestamps -->
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <span class="text-slate-800 font-medium block">
                                {{ $inc['created_at'] }}
                            </span>
                            <span class="text-slate-400 block text-[10px]">
                                Updated: {{ $inc['updated_at'] }}
                            </span>
                        </td>

                        <!-- Actions Column -->
                        <td class="py-3.5 px-4 text-right" onclick="event.stopPropagation()">
                            <div class="inline-flex items-center gap-1.5">
                                <button type="button" 
                                        onclick="openIncidentDrawer('{{ $inc['id'] }}')" 
                                        class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-colors">
                                    Workspace &rarr;
                                </button>
                                
                                @if($inc['status'] !== 'resolved' && $inc['status'] !== 'closed')
                                <button type="button" 
                                        onclick="openResolveModal('{{ $inc['id'] }}', '{{ addslashes($inc['title']) }}')"
                                        title="Resolve this incident"
                                        class="px-2 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-xl text-xs font-bold transition-colors">
                                    Resolve
                                </button>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">
                            <div class="max-w-xs mx-auto">
                                <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <p class="text-sm font-semibold text-slate-700">No operational incidents match your filters.</p>
                                <p class="text-xs text-slate-400 mt-1">All platform microservices, edge nodes, and gateways are operating within normal SLA thresholds.</p>
                                @if(!empty($filters['q']) || $filters['severity'] !== 'all' || $filters['status'] !== 'all' || $filters['responder'] !== 'all' || $filters['vendor'] !== 'all')
                                <a href="{{ route('admin.incidents') }}" class="inline-block mt-3 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold">
                                    Reset Filters
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Server-Side Pagination Bar -->
        @if($incidents->hasPages())
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>
                Showing <strong>{{ $incidents->firstItem() }}</strong> to <strong>{{ $incidents->lastItem() }}</strong> of <strong>{{ $incidents->total() }}</strong> incidents
            </span>
            <div>
                {{ $incidents->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- ================= SLIDE-OVER INCIDENT DETAIL WORKSPACE DRAWER ================= -->
    <div id="incidentDrawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="drawer-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeIncidentDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-2xl bg-white shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 sm:p-6 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span id="drawer-inc-sev-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                SEV-1 Critical
                            </span>
                            <span id="drawer-inc-status-badge" class="px-2 py-0.5 rounded text-[10px] font-mono bg-sky-100 text-sky-800">
                                Open
                            </span>
                            <span id="drawer-inc-id" class="text-xs font-mono font-bold text-slate-500">
                                INC-2026-081
                            </span>
                        </div>
                        <h3 id="drawer-inc-title" class="text-base sm:text-lg font-bold text-slate-900 mt-1">
                            Incident Investigation Workspace
                        </h3>
                        <p id="drawer-inc-location" class="text-xs text-slate-500">
                            Location & Tenant Operator
                        </p>
                    </div>

                    <button type="button" onclick="closeIncidentDrawer()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-6 text-xs text-slate-600">
                    
                    <!-- SRE Ownership Card -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div id="drawer-responder-avatar" class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm shrink-0">
                                B
                            </div>
                            <div>
                                <span class="text-[10px] font-mono text-slate-400 block uppercase">Assigned SRE Responder</span>
                                <strong id="drawer-responder-name" class="text-sm font-bold text-slate-900 block">Budi Santoso</strong>
                                <span id="drawer-responder-role" class="text-[11px] text-slate-500">Lead SRE Engineer</span>
                            </div>
                        </div>

                        <button type="button" 
                                id="drawer-btn-reassign"
                                onclick="openAssignModalFromDrawer()" 
                                class="px-3 py-1.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 font-bold text-xs transition-colors shadow-2xs">
                            Reassign Ownership
                        </button>
                    </div>

                    <!-- Impact & Scope Summary -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Affected Scope & Impact</h4>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Service / Microservice</span>
                                <span id="drawer-inc-service" class="font-bold text-slate-800 text-xs mt-0.5 block">Payment Gateway</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Target Resource ID</span>
                                <span id="drawer-inc-resource" class="font-mono font-bold text-indigo-700 text-xs mt-0.5 block">GW-QRIS-01</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-[10px] text-slate-400 uppercase font-mono block">Impact Assessment</span>
                            <p id="drawer-inc-impact" class="text-xs text-slate-800 font-medium leading-relaxed mt-1">
                                Operational impact assessment statement...
                            </p>
                        </div>
                    </div>

                    <!-- Linked Alerts -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Linked Operational Alerts</h4>
                            <a href="/admin/alerts" class="text-[11px] font-semibold text-indigo-600 hover:underline">All Alerts &rarr;</a>
                        </div>
                        <div id="drawer-inc-alerts" class="space-y-2">
                            <!-- Populated dynamically -->
                        </div>
                    </div>

                    <!-- Resolution Information (If Resolved) -->
                    <div id="drawer-resolution-card" class="hidden p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-950">
                        <div class="flex items-center gap-2 mb-1.5">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-700"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <h4 class="text-xs font-bold text-emerald-900">Resolved & Verified</h4>
                            <span id="drawer-verified-at" class="text-[10px] font-mono text-emerald-700 ml-auto">24 Oct 2026, 17:30 WIB</span>
                        </div>
                        <div class="text-[11px] space-y-1">
                            <p><strong>Root Cause Category:</strong> <span id="drawer-root-cause">Third-Party Gateway Outage</span></p>
                            <p id="drawer-resolution-note" class="text-emerald-800 leading-relaxed">Resolution note summary...</p>
                        </div>
                    </div>

                    <!-- Chronological Investigation Audit Timeline -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2.5">Investigation Audit Timeline</h4>
                        <div id="drawer-inc-timeline" class="space-y-3 border-l-2 border-slate-200 pl-3.5 ml-2">
                            <!-- Populated dynamically -->
                        </div>
                    </div>

                    <!-- Add Investigation Note Form -->
                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-2">Record Investigation Update</h4>
                        <form id="drawerNoteForm" method="POST" action="">
                            @csrf
                            <textarea name="note" required rows="3" placeholder="Enter diagnostic telemetry findings, vendor escalation ticket ID, or on-site dispatch updates..." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none mb-2"></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="px-3.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-2xs">
                                    Post Investigation Update
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Drawer Actions Footer -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex flex-wrap items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <!-- Transition to Investigating Form -->
                        <form id="drawerFormInvestigating" method="POST" action="" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="investigating">
                            <button type="submit" id="drawer-btn-investigate" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors">
                                Start Investigation
                            </button>
                        </form>

                        <!-- Transition to Escalated (Modal trigger) -->
                        <button type="button" 
                                id="drawer-btn-escalate" 
                                onclick="openEscalateModalFromDrawer()" 
                                class="px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl transition-colors">
                            Escalate (Tier-3)
                        </button>

                        <!-- Resolve Incident Button -->
                        <button type="button" 
                                id="drawer-btn-resolve" 
                                onclick="openResolveModalFromDrawer()" 
                                class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-colors">
                            Resolve Incident
                        </button>

                        <!-- Close Incident Button -->
                        <form id="drawerFormClose" method="POST" action="" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="closed">
                            <button type="submit" id="drawer-btn-close" class="px-3 py-2 bg-slate-700 hover:bg-slate-800 text-white font-bold rounded-xl transition-colors">
                                Close Incident
                            </button>
                        </form>
                    </div>

                    <button type="button" onclick="closeIncidentDrawer()" class="px-3 py-2 text-slate-500 hover:text-slate-800 font-semibold">
                        Close Drawer
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= DECLARE INCIDENT MODAL ================= -->
    <div id="declareModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="declare-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeDeclareModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full p-5 sm:p-6 border border-slate-200">
                <form method="POST" action="{{ route('admin.incidents.store') }}">
                    @csrf
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="declare-modal-title">Declare Platform Incident</h3>
                            <p class="text-xs text-slate-500">Initiate formal cross-platform SRE triage and incident response</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Incident Title / Summary <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" required placeholder="e.g. Major QRIS Settlement Failure at Terminal 2" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Severity Tier <span class="text-rose-500">*</span></label>
                                <select name="severity" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                                    <option value="sev1">SEV-1 Critical (Full Outage)</option>
                                    <option value="sev2" selected>SEV-2 Major (High Impact)</option>
                                    <option value="sev3">SEV-3 Moderate (Degraded)</option>
                                    <option value="sev4">SEV-4 Minor (Low / Edge)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Tenant Operator <span class="text-rose-500">*</span></label>
                                <select name="vendor_id" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                                    @foreach($tenants as $t)
                                    <option value="{{ $t['id'] }}">{{ $t['company_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Facility / Location Name <span class="text-rose-500">*</span></label>
                                <input type="text" name="location_name" required placeholder="e.g. Grand Indonesia West Mall" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">City <span class="text-rose-500">*</span></label>
                                <input type="text" name="location_city" required placeholder="e.g. Jakarta Pusat" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Affected Service <span class="text-rose-500">*</span></label>
                                <input type="text" name="affected_service" required placeholder="e.g. Payment Gateway / IoT Core" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Resource ID (Optional)</label>
                                <input type="text" name="resource_id" placeholder="e.g. GW-QRIS-01 / SRV-AUTH" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Initial Impact Summary <span class="text-rose-500">*</span></label>
                            <input type="text" name="impact_summary" required placeholder="e.g. Approximately 420 active drivers unable to process cashless checkout" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Assign SRE Responder</label>
                                <select name="assigned_responder" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                                    <option value="unassigned">-- Unassigned (Dispatch Later) --</option>
                                    @foreach($responders as $rKey => $resp)
                                        @if($rKey !== 'unassigned')
                                        <option value="{{ $rKey }}">{{ $resp['name'] }} ({{ $resp['role'] }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Linked Operational Alert ID</label>
                                <input type="text" name="linked_alert_id" placeholder="e.g. ALT-2026-1001" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Initial Investigation Note</label>
                            <textarea name="initial_note" rows="2" placeholder="Diagnostic steps taken so far, escalated upstream ticket numbers, etc." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-rose-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100 mt-4">
                        <button type="button" onclick="closeDeclareModal()" class="px-4 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl transition-colors shadow-sm shadow-rose-600/30">Declare Incident</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= ASSIGN RESPONDER MODAL ================= -->
    <div id="assignModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="assign-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAssignModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="assignForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="assign-modal-title">Assign SRE Ownership</h3>
                            <p class="text-xs text-slate-500" id="assign-modal-subtitle">Transfer investigation responsibility</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Select SRE Responder <span class="text-rose-500">*</span></label>
                            <select name="responder_id" id="assign-responder-select" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                @foreach($responders as $rKey => $resp)
                                    @if($rKey !== 'unassigned')
                                    <option value="{{ $rKey }}">{{ $resp['name'] }} — {{ $resp['role'] }} ({{ $resp['email'] }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Assignment Handover Note</label>
                            <input type="text" name="assignment_note" placeholder="Reason for transfer or primary directive..." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeAssignModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-colors">Confirm Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= RESOLVE INCIDENT MODAL ================= -->
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
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="resolve-modal-title">Resolve Incident</h3>
                            <p class="text-xs text-slate-500" id="resolve-modal-subtitle">Log root-cause analysis & resolution</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Root Cause Category <span class="text-rose-500">*</span></label>
                            <select name="root_cause_category" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <option value="Third-Party Provider Outage">Third-Party Provider Outage</option>
                                <option value="Edge Hardware Malfunction">Edge Hardware Malfunction</option>
                                <option value="Platform Infrastructure / DB">Platform Infrastructure / DB</option>
                                <option value="Software Code Defect">Software Code Defect</option>
                                <option value="Configuration / Credentials">Configuration / Credentials</option>
                                <option value="Network / ISP Partition">Network / ISP Partition</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Resolution Summary Note <span class="text-rose-500">*</span></label>
                            <textarea name="resolution_note" required rows="3" placeholder="Explain the root-cause remedy, component verification, and verified system health..." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeResolveModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-colors shadow-xs">Verify & Mark Resolved</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= ESCALATE INCIDENT MODAL ================= -->
    <div id="escalateModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="escalate-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeEscalateModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="escalateForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="escalated">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="escalate-modal-title">Escalate to Tier-3 SRE</h3>
                            <p class="text-xs text-slate-500" id="escalate-modal-subtitle">Page on-call engineering lead</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs mb-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Escalation Reason / Blocking Diagnostic <span class="text-rose-500">*</span></label>
                            <textarea name="reason" required rows="3" placeholder="Explain why standard mitigation failed and what specialized engineering intervention is required..." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-amber-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeEscalateModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl transition-colors shadow-xs">Confirm Tier-3 Escalation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= JAVASCRIPT WORKSPACE CONTROLLER ================= -->
    <script>
        let currentIncidentPayload = null;

        // Auto-open drawer if server provided selected incident
        @if(!empty($selectedIncident))
        document.addEventListener('DOMContentLoaded', function() {
            const initialPayload = @json($selectedIncident);
            populateIncidentDrawer(initialPayload);
            document.getElementById('incidentDrawer').classList.remove('hidden');
        });
        @endif

        // Fetch & open incident drawer
        async function openIncidentDrawer(incidentId) {
            const drawer = document.getElementById('incidentDrawer');
            drawer.classList.remove('hidden');

            try {
                const response = await fetch(`/api/admin/incidents/${incidentId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                
                if (data.success && data.incident) {
                    populateIncidentDrawer(data.incident);
                }
            } catch (err) {
                console.error('Error fetching incident:', err);
            }
        }

        function closeIncidentDrawer() {
            document.getElementById('incidentDrawer').classList.add('hidden');
        }

        function populateIncidentDrawer(inc) {
            currentIncidentPayload = inc;

            document.getElementById('drawer-inc-id').textContent = inc.id;
            document.getElementById('drawer-inc-title').textContent = inc.title;
            document.getElementById('drawer-inc-location').textContent = `${inc.location_name} • ${inc.location_city} (${inc.vendor_name})`;
            document.getElementById('drawer-inc-service').textContent = inc.affected_service;
            document.getElementById('drawer-inc-resource').textContent = inc.resource_id || 'N/A';
            document.getElementById('drawer-inc-impact').textContent = inc.impact_summary;

            // Form actions
            document.getElementById('drawerNoteForm').action = `/admin/incidents/${inc.id}/notes`;
            document.getElementById('drawerFormInvestigating').action = `/admin/incidents/${inc.id}/status`;
            document.getElementById('drawerFormClose').action = `/admin/incidents/${inc.id}/status`;

            // Severity Badge
            const sevBadge = document.getElementById('drawer-inc-sev-badge');
            sevBadge.textContent = inc.severity_label || inc.severity.toUpperCase();
            if (inc.severity === 'sev1') {
                sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200';
            } else if (inc.severity === 'sev2') {
                sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200';
            } else if (inc.severity === 'sev3') {
                sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200';
            } else {
                sevBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200';
            }

            // Status Badge
            const stBadge = document.getElementById('drawer-inc-status-badge');
            stBadge.textContent = inc.status_label || inc.status.toUpperCase();
            if (inc.status === 'open') {
                stBadge.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-sky-100 text-sky-800';
            } else if (inc.status === 'investigating') {
                stBadge.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-indigo-100 text-indigo-800';
            } else if (inc.status === 'escalated') {
                stBadge.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-rose-100 text-rose-800';
            } else if (inc.status === 'resolved') {
                stBadge.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-100 text-emerald-800';
            } else {
                stBadge.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-800';
            }

            // SRE Responder Info
            const respName = inc.responder_name || 'Unassigned';
            const respRole = inc.responder_role || 'Awaiting SRE Dispatch';
            document.getElementById('drawer-responder-name').textContent = respName;
            document.getElementById('drawer-responder-role').textContent = respRole;
            document.getElementById('drawer-responder-avatar').textContent = respName.charAt(0).toUpperCase();

            // Resolution Card
            const resCard = document.getElementById('drawer-resolution-card');
            if (inc.status === 'resolved' || inc.status === 'closed') {
                resCard.classList.remove('hidden');
                document.getElementById('drawer-root-cause').textContent = inc.root_cause_category || 'Mitigated';
                document.getElementById('drawer-resolution-note').textContent = inc.resolution_note || 'Resolution recorded.';
                document.getElementById('drawer-verified-at').textContent = inc.verified_at || inc.updated_at;
            } else {
                resCard.classList.add('hidden');
            }

            // Linked Alerts
            const alertsContainer = document.getElementById('drawer-inc-alerts');
            alertsContainer.innerHTML = '';
            if (inc.linked_alert_ids && inc.linked_alert_ids.length > 0) {
                inc.linked_alert_ids.forEach(altId => {
                    const alertEl = document.createElement('div');
                    alertEl.className = 'p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs';
                    alertEl.innerHTML = `
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <span class="font-mono font-bold text-slate-800">${altId}</span>
                            <span class="text-slate-400">• Operational Alert</span>
                        </div>
                        <a href="/admin/alerts?detail=${altId}" class="px-2.5 py-1 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-[11px] transition-colors">
                            View Alert &rarr;
                        </a>
                    `;
                    alertsContainer.appendChild(alertEl);
                });
            } else {
                alertsContainer.innerHTML = '<p class="text-[11px] text-slate-400 italic">No specific operational alerts attached to this incident.</p>';
            }

            // Chronological Timeline
            const timelineContainer = document.getElementById('drawer-inc-timeline');
            timelineContainer.innerHTML = '';
            if (inc.timeline && inc.timeline.length > 0) {
                inc.timeline.forEach(event => {
                    const item = document.createElement('div');
                    item.className = 'relative text-xs';
                    item.innerHTML = `
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="font-bold text-slate-800">${event.event}</span>
                            <span class="text-[10px] font-mono text-slate-400">${event.time}</span>
                        </div>
                        <span class="text-[10px] text-indigo-600 font-medium block">Actor: ${event.actor}</span>
                        <p class="text-slate-600 text-[11px] mt-0.5 leading-relaxed bg-slate-50/80 p-2 rounded-lg border border-slate-100">${event.note}</p>
                    `;
                    timelineContainer.appendChild(item);
                });
            }

            // Action Buttons Visibility
            const btnInvestigate = document.getElementById('drawer-btn-investigate');
            const btnEscalate = document.getElementById('drawer-btn-escalate');
            const btnResolve = document.getElementById('drawer-btn-resolve');
            const btnClose = document.getElementById('drawer-btn-close');

            btnInvestigate.classList.toggle('hidden', inc.status !== 'open');
            btnEscalate.classList.toggle('hidden', inc.status === 'escalated' || inc.status === 'resolved' || inc.status === 'closed');
            btnResolve.classList.toggle('hidden', inc.status === 'resolved' || inc.status === 'closed');
            btnClose.classList.toggle('hidden', inc.status !== 'resolved');
        }

        // Declare Modal Controls
        function openDeclareModal() {
            document.getElementById('declareModal').classList.remove('hidden');
        }
        function closeDeclareModal() {
            document.getElementById('declareModal').classList.add('hidden');
        }

        // Assign Modal Controls
        function openAssignModal(incidentId, currentResponderKey, title) {
            const modal = document.getElementById('assignModal');
            document.getElementById('assignForm').action = `/admin/incidents/${incidentId}/assign`;
            document.getElementById('assign-modal-subtitle').textContent = `Incident: ${incidentId} — ${title}`;
            if (currentResponderKey && currentResponderKey !== 'unassigned') {
                const select = document.getElementById('assign-responder-select');
                if (select) select.value = currentResponderKey;
            }
            modal.classList.remove('hidden');
        }
        function openAssignModalFromDrawer() {
            if (currentIncidentPayload) {
                openAssignModal(currentIncidentPayload.id, currentIncidentPayload.assigned_responder, currentIncidentPayload.title);
            }
        }
        function closeAssignModal() {
            document.getElementById('assignModal').classList.add('hidden');
        }

        // Resolve Modal Controls
        function openResolveModal(incidentId, title) {
            const modal = document.getElementById('resolveModal');
            document.getElementById('resolveForm').action = `/admin/incidents/${incidentId}/resolve`;
            document.getElementById('resolve-modal-subtitle').textContent = `Incident: ${incidentId} — ${title}`;
            modal.classList.remove('hidden');
        }
        function openResolveModalFromDrawer() {
            if (currentIncidentPayload) {
                openResolveModal(currentIncidentPayload.id, currentIncidentPayload.title);
            }
        }
        function closeResolveModal() {
            document.getElementById('resolveModal').classList.add('hidden');
        }

        // Escalate Modal Controls
        function openEscalateModal(incidentId, title) {
            const modal = document.getElementById('escalateModal');
            document.getElementById('escalateForm').action = `/admin/incidents/${incidentId}/status`;
            document.getElementById('escalate-modal-subtitle').textContent = `Incident: ${incidentId} — ${title}`;
            modal.classList.remove('hidden');
        }
        function openEscalateModalFromDrawer() {
            if (currentIncidentPayload) {
                openEscalateModal(currentIncidentPayload.id, currentIncidentPayload.title);
            }
        }
        function closeEscalateModal() {
            document.getElementById('escalateModal').classList.add('hidden');
        }
    </script>

</x-layouts.admin>
