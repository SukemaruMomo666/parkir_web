<x-layouts.admin activeNav="api-management" title="API Management & Security Controls — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">API Operation Completed</p>
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

    <!-- ONE-TIME GENERATED CLIENT SECRET BANNER (CRITICAL SECURITY NOTICE) -->
    @if(session('one_time_secret'))
    <div class="mb-6 p-5 rounded-2xl bg-slate-900 text-white border-2 border-indigo-500/80 shadow-xl relative overflow-hidden" role="alert">
        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-500/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-300">New API Client Credentials Generated</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-rose-500/20 text-rose-300 border border-rose-500/30">One-Time Display</span>
                </div>
                <h3 class="text-sm sm:text-base font-bold text-white">
                    {{ session('one_time_client_name') }} <span class="text-xs text-slate-400 font-mono">({{ session('one_time_client_id') }})</span>
                </h3>
                <p class="text-xs text-slate-300">
                    Store this client secret immediately. For security, NusaPark will <strong>never show this plaintext secret again</strong>.
                </p>
            </div>

            <!-- Secret Box with Copy Button -->
            <div class="bg-slate-950 p-2.5 rounded-xl border border-slate-800 flex items-center justify-between gap-3 shrink-0 sm:max-w-md w-full sm:w-auto">
                <code id="raw-secret-display" class="font-mono text-xs text-emerald-400 select-all break-all px-1">
                    {{ session('one_time_secret') }}
                </code>
                <button type="button" 
                        onclick="copyTextToClipboard('{{ session('one_time_secret') }}', this)" 
                        class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs transition-colors shrink-0 flex items-center gap-1.5">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    <span>Copy Secret</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- ================= PAGE HEADER & BREADCRUMBS ================= -->
    <div class="space-y-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">API Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>{{ $summary['active_clients'] }} Active Client Integrations</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Gateway Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        API Management
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 50
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Gateway v1.4 Operational</span>
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage platform API access, integrations, policies, and usage.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.api-management', request()->query()) }}" 
                   title="Refresh API clients and telemetry"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.api-management.export', request()->query()) }}" 
                   title="Export API clients metadata to CSV"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export (CSV)</span>
                </a>

                <!-- Register API Client Modal Trigger -->
                <button type="button" 
                        onclick="openCreateModal()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-all shadow-sm shadow-indigo-600/30">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Register API Client</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ================= 5 OVERVIEW SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 mb-6">
        <!-- Registered Clients -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Registered Clients</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['total_clients'] }}</span>
                <span class="text-[11px] font-semibold text-emerald-600">{{ $summary['active_clients'] }} Active</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">{{ $summary['suspended_clients'] }} suspended • {{ $summary['revoked_clients'] }} revoked</p>
        </div>

        <!-- 30-Day Request Volume -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">30-Day Volume</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-indigo-600"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['requests_30d_formatted'] }}</span>
                <span class="text-[11px] font-semibold text-indigo-600">Calls</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Platform aggregate API traffic</p>
        </div>

        <!-- Today's Telemetry Requests -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Today's Traffic</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['requests_today_formatted'] }}</span>
                <span class="text-[11px] font-semibold text-emerald-600">Live</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Incoming telemetry & gateway requests</p>
        </div>

        <!-- Success SLA & Latency -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Gateway SLA</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['platform_success_rate'] }}</span>
                <span class="text-[11px] font-semibold text-emerald-600 font-mono">{{ $summary['avg_latency_ms'] }}ms avg</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Weighted 30-day response latency</p>
        </div>

        <!-- Rate-Limited Requests -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider">Throttled (429)</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-500"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $summary['rate_limited_total'] }}</span>
                <span class="text-[11px] font-semibold text-amber-600">Enforced</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-1">Protection policy limits maintained</p>
        </div>
    </div>

    <!-- ================= WORKSPACE TABS ================= -->
    <div class="flex items-center gap-2 mb-4 border-b border-slate-200 text-xs">
        <button type="button" 
                id="tab-btn-clients" 
                onclick="switchTab('clients')" 
                class="px-4 py-2.5 font-bold border-b-2 border-indigo-600 text-indigo-600 transition-colors flex items-center gap-2">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
            <span>Registered API Clients</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-50 text-indigo-700 font-mono font-bold">{{ $clients->total() }}</span>
        </button>

        <button type="button" 
                id="tab-btn-logs" 
                onclick="switchTab('logs')" 
                class="px-4 py-2.5 font-semibold text-slate-500 hover:text-slate-800 border-b-2 border-transparent transition-colors flex items-center gap-2">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            <span>Live Request Telemetry Logs</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-600 font-mono font-bold">{{ count($requestLogs) }}</span>
        </button>
    </div>

    <!-- ================= TAB 1: API CLIENTS INVENTORY ================= -->
    <div id="tab-clients-content" class="space-y-6">

        <!-- SEARCH AND FILTERS TOOLBAR -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs">
            <form method="GET" action="{{ route('admin.api-management') }}" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">
                    <!-- Search Input -->
                    <div class="lg:col-span-2">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Search Clients & Keys</label>
                        <div class="relative">
                            <input type="text" 
                                   name="q" 
                                   value="{{ $filters['q'] }}" 
                                   placeholder="Client name, client_id, IP..." 
                                   class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="all">All Statuses</option>
                            <option value="active" {{ $filters['status'] === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="suspended" {{ $filters['status'] === 'suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="revoked" {{ $filters['status'] === 'revoked' ? 'selected' : '' }}>Revoked</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Integration Category</label>
                        <select name="category" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="all">All Categories</option>
                            @foreach($categories as $catKey => $cat)
                            <option value="{{ $catKey }}" {{ $filters['category'] === $catKey ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Environment Filter -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Environment</label>
                        <select name="environment" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="all">All Environments</option>
                            <option value="production" {{ $filters['environment'] === 'production' ? 'selected' : '' }}>Production (Live)</option>
                            <option value="sandbox" {{ $filters['environment'] === 'sandbox' ? 'selected' : '' }}>Sandbox (Staging / Test)</option>
                        </select>
                    </div>

                    <!-- Tenant Filter -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Tenant Operator</label>
                        <select name="vendor" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="all">All Tenants</option>
                            @foreach($tenants as $t)
                            <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>{{ $t['company_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Bottom Row: Sort & Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100 text-xs">
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Sort Order:</span>
                        <select name="sort" class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="volume_desc" {{ $filters['sort'] === 'volume_desc' ? 'selected' : '' }}>Highest Request Volume (30D)</option>
                            <option value="newest" {{ $filters['sort'] === 'newest' ? 'selected' : '' }}>Newest Created</option>
                            <option value="oldest" {{ $filters['sort'] === 'oldest' ? 'selected' : '' }}>Oldest Created</option>
                            <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Client Name (A &rarr; Z)</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        @if(!empty($filters['q']) || $filters['status'] !== 'all' || $filters['category'] !== 'all' || $filters['environment'] !== 'all' || $filters['vendor'] !== 'all' || $filters['sort'] !== 'volume_desc')
                        <a href="{{ route('admin.api-management') }}" class="px-3 py-2 text-slate-500 hover:text-slate-800 font-semibold transition-colors">
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

        <!-- API CLIENT INVENTORY TABLE -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3 px-4">Client Name & Category</th>
                            <th class="py-3 px-4">Environment & Tenant</th>
                            <th class="py-3 px-4">Client ID & Fingerprint</th>
                            <th class="py-3 px-4">Rate Limit & Scopes</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">30D Traffic</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($clients as $client)
                        <tr class="hover:bg-slate-50/70 transition-colors cursor-pointer group" onclick="openClientDrawer('{{ $client['id'] }}')">
                            
                            <!-- Client Name & Category -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $client['name'] }}
                                    </span>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $categories[$client['category']]['name'] ?? ucfirst($client['category']) }}
                                </span>
                            </td>

                            <!-- Environment & Tenant -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="mb-1">
                                    @if($client['environment'] === 'production')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Production
                                    </span>
                                    @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        Sandbox
                                    </span>
                                    @endif
                                </div>
                                <span class="text-[11px] text-slate-500 font-medium block">
                                    {{ $client['vendor_name'] ?? 'Platform Global' }}
                                </span>
                            </td>

                            <!-- Client ID & Fingerprint -->
                            <td class="py-3.5 px-4" onclick="event.stopPropagation()">
                                <div class="flex items-center gap-1.5 font-mono text-xs text-indigo-700 bg-indigo-50/60 px-2 py-1 rounded-lg border border-indigo-100 w-fit">
                                    <span>{{ $client['client_id'] }}</span>
                                    <button type="button" 
                                            onclick="copyTextToClipboard('{{ $client['client_id'] }}', this)" 
                                            title="Copy Client ID" 
                                            class="text-indigo-500 hover:text-indigo-800 p-0.5">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                    </button>
                                </div>
                                <span class="text-[10px] font-mono text-slate-400 block mt-1 truncate max-w-[220px]" title="{{ $client['key_fingerprint'] }}">
                                    {{ $client['key_fingerprint'] }}
                                </span>
                            </td>

                            <!-- Rate Limit & Scopes -->
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-800 mb-1">
                                    {{ $tiers[$client['rate_limit_tier']]['name'] ?? $client['rate_limit_tier'] }}
                                    <span class="text-[10px] text-slate-400 block font-mono">
                                        {{ $tiers[$client['rate_limit_tier']]['rpm'] ?? 300 }} req/min
                                    </span>
                                </div>
                                <div class="flex items-center gap-1 flex-wrap">
                                    @foreach(array_slice($client['scopes'] ?? [], 0, 2) as $sc)
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-mono bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $sc }}
                                    </span>
                                    @endforeach
                                    @if(count($client['scopes'] ?? []) > 2)
                                    <span class="text-[9px] font-mono text-slate-400">+{{ count($client['scopes']) - 2 }}</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($client['status'] === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                                @elseif($client['status'] === 'suspended')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Suspended
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Revoked
                                </span>
                                @endif
                            </td>

                            <!-- 30D Traffic & Last Active -->
                            <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                                <span class="font-bold text-slate-800 block">
                                    {{ number_format($client['requests_30d'] ?? 0, 0, ',', '.') }} reqs
                                </span>
                                <span class="text-slate-400 block text-[10px]">
                                    Last active: {{ $client['last_active'] ?? 'Never' }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right" onclick="event.stopPropagation()">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" 
                                            onclick="openClientDrawer('{{ $client['id'] }}')" 
                                            class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-colors">
                                        Inspect &rarr;
                                    </button>

                                    <button type="button" 
                                            onclick="openRotateModal('{{ $client['id'] }}', '{{ addslashes($client['name']) }}', '{{ $client['client_id'] }}')" 
                                            title="Rotate Client Secret" 
                                            class="p-1.5 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl border border-slate-200 transition-colors">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="max-w-xs mx-auto">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                                    <p class="text-sm font-semibold text-slate-700">No API clients match your criteria.</p>
                                    <p class="text-xs text-slate-400 mt-1">Try adjusting the filter options or search term above.</p>
                                    <button type="button" onclick="openCreateModal()" class="mt-3 px-3.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors">
                                        Register New API Client
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Server-Side Pagination Bar -->
            @if($clients->hasPages())
            <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>
                    Showing <strong>{{ $clients->firstItem() }}</strong> to <strong>{{ $clients->lastItem() }}</strong> of <strong>{{ $clients->total() }}</strong> registered API clients
                </span>
                <div>
                    {{ $clients->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>

    <!-- ================= TAB 2: LIVE REQUEST TELEMETRY LOGS ================= -->
    <div id="tab-logs-content" class="hidden space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Recent Gateway Inbound Requests</h3>
                    <p class="text-xs text-slate-500">Authorized real-time audit stream of microservice API calls across national endpoints.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-[11px] font-mono text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Ingest Active
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-2.5 px-3">Timestamp</th>
                            <th class="py-2.5 px-3">Method & Path</th>
                            <th class="py-2.5 px-3">Client Identifier</th>
                            <th class="py-2.5 px-3">Status</th>
                            <th class="py-2.5 px-3">Latency</th>
                            <th class="py-2.5 px-3">Caller IP</th>
                            <th class="py-2.5 px-3">Correlation ID</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-mono text-[11px]">
                        @foreach($requestLogs as $log)
                        <tr class="hover:bg-slate-50/70">
                            <td class="py-3 px-3 whitespace-nowrap text-slate-500">{{ $log['timestamp'] }}</td>
                            <td class="py-3 px-3">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold {{ $log['method'] === 'POST' ? 'bg-indigo-100 text-indigo-700' : ($log['method'] === 'GET' ? 'bg-sky-100 text-sky-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ $log['method'] }}
                                </span>
                                <span class="text-slate-800 font-medium ml-1">{{ $log['path'] }}</span>
                            </td>
                            <td class="py-3 px-3 whitespace-nowrap">
                                <span class="text-indigo-600 font-medium block">{{ $log['client_name'] }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ $log['client_id'] }}</span>
                            </td>
                            <td class="py-3 px-3 whitespace-nowrap">
                                @if($log['status_code'] >= 200 && $log['status_code'] < 300)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $log['status_code'] }} OK
                                </span>
                                @elseif($log['status_code'] === 429)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    429 Throttled
                                </span>
                                @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    {{ $log['status_code'] }} Error
                                </span>
                                @endif
                            </td>
                            <td class="py-3 px-3 whitespace-nowrap text-slate-600">{{ $log['latency_ms'] }}ms</td>
                            <td class="py-3 px-3 whitespace-nowrap text-slate-500">{{ $log['ip_address'] }}</td>
                            <td class="py-3 px-3 whitespace-nowrap text-slate-400 text-[10px]">{{ $log['correlation_id'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= SLIDE-OVER API CLIENT DETAIL WORKSPACE DRAWER ================= -->
    <div id="apiClientDrawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="drawer-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeClientDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-2xl bg-white shadow-2xl flex flex-col">
                
                <!-- Drawer Header -->
                <div class="p-5 sm:p-6 border-b border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span id="drawer-client-env" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Production
                            </span>
                            <span id="drawer-client-status" class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-100 text-emerald-800">
                                Active
                            </span>
                            <span id="drawer-client-category" class="text-xs font-semibold text-slate-500">
                                Payment Gateway
                            </span>
                        </div>
                        <h3 id="drawer-client-name" class="text-base sm:text-lg font-bold text-slate-900 mt-1">
                            Client Integration Workspace
                        </h3>
                        <p id="drawer-client-vendor" class="text-xs text-slate-500">
                            Owning Tenant Organization
                        </p>
                    </div>

                    <button type="button" onclick="closeClientDrawer()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-6 text-xs text-slate-600">
                    
                    <!-- Credential Metadata Card -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-700">Credential Metadata</h4>
                            <span class="text-[10px] font-mono text-slate-400">HMAC-SHA256 Token Auth</span>
                        </div>

                        <div class="space-y-2">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Public Client Identifier</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <code id="drawer-client-id" class="font-mono text-xs text-indigo-700 bg-white px-2 py-1 rounded border border-slate-200 select-all font-bold">np_live_cli_...</code>
                                    <button type="button" onclick="copyTextToClipboard(document.getElementById('drawer-client-id').textContent, this)" class="text-indigo-600 hover:text-indigo-800 text-[11px] font-bold">Copy</button>
                                </div>
                            </div>

                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Masked Client Secret (Encrypted at Rest)</span>
                                <code id="drawer-client-secret" class="font-mono text-xs text-slate-600 bg-white px-2 py-1 rounded border border-slate-200 block mt-0.5">np_sec_live_********************8f2d</code>
                                <span class="text-[10px] text-slate-400 mt-0.5 block">Secrets are cryptographically hashed and never stored in plaintext.</span>
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-mono block">Key Fingerprint</span>
                                    <code id="drawer-client-fingerprint" class="font-mono text-[10px] text-slate-600 truncate block mt-0.5">SHA256:...</code>
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-mono block">Credential Expiry</span>
                                    <span id="drawer-client-expires" class="font-mono text-xs text-slate-700 block mt-0.5">2027-01-10</span>
                                </div>
                            </div>

                            <div class="pt-1">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Network IP Whitelist (CIDR Allowlist)</span>
                                <code id="drawer-client-ips" class="font-mono text-[11px] text-slate-700 bg-white px-2 py-1 rounded border border-slate-200 block mt-0.5">103.12.164.0/24</code>
                            </div>
                        </div>
                    </div>

                    <!-- Rate Limits & Access Policy Card -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-700">Rate Limit & Access Policy</h4>
                            <button type="button" onclick="openEditPolicyModalFromDrawer()" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Edit Policy &rarr;</button>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="p-2.5 bg-white rounded-xl border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Minute Cap</span>
                                <strong id="drawer-policy-rpm" class="text-sm font-extrabold text-slate-900 block mt-0.5">1,500</strong>
                                <span class="text-[9px] text-slate-400">req / min</span>
                            </div>
                            <div class="p-2.5 bg-white rounded-xl border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Daily Cap</span>
                                <strong id="drawer-policy-rpd" class="text-sm font-extrabold text-slate-900 block mt-0.5">1,000,000</strong>
                                <span class="text-[9px] text-slate-400">req / day</span>
                            </div>
                            <div class="p-2.5 bg-white rounded-xl border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Burst Limit</span>
                                <strong id="drawer-policy-burst" class="text-sm font-extrabold text-slate-900 block mt-0.5">250</strong>
                                <span class="text-[9px] text-slate-400">burst reqs</span>
                            </div>
                        </div>

                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-mono block mb-1">Granted OAuth2 Scopes</span>
                            <div id="drawer-client-scopes" class="flex items-center gap-1.5 flex-wrap">
                                <!-- Populated dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Usage Telemetry Summary -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-700">Usage Telemetry (30-Day Period)</h4>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-center pt-1">
                            <div class="p-2 bg-white rounded-xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">30D Requests</span>
                                <strong id="drawer-usage-total" class="text-xs font-bold text-slate-800 block mt-0.5">1,420,500</strong>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Today's Traffic</span>
                                <strong id="drawer-usage-today" class="text-xs font-bold text-slate-800 block mt-0.5">48,210</strong>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Avg Latency</span>
                                <strong id="drawer-usage-latency" class="text-xs font-bold text-slate-800 block mt-0.5 font-mono">48ms</strong>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 uppercase font-mono block">Error Rate</span>
                                <strong id="drawer-usage-errors" class="text-xs font-bold text-emerald-600 block mt-0.5 font-mono">0.04%</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Chronological Audit Timeline -->
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2.5">Credential & Policy Audit History</h4>
                        <div id="drawer-client-timeline" class="space-y-3 border-l-2 border-slate-200 pl-3.5 ml-2">
                            <!-- Populated dynamically -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Actions Footer -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex flex-wrap items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <!-- Rotate Secret Trigger -->
                        <button type="button" 
                                onclick="openRotateModalFromDrawer()" 
                                class="px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl transition-colors shadow-2xs">
                            Rotate Secret Key
                        </button>

                        <!-- Toggle Status (Suspend / Enable) -->
                        <form id="drawerStatusForm" method="POST" action="" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" id="drawer-status-input" value="suspended">
                            <button type="submit" id="drawer-btn-status-toggle" class="px-3 py-2 bg-slate-700 hover:bg-slate-800 text-white font-bold rounded-xl transition-colors">
                                Suspend Access
                            </button>
                        </form>
                    </div>

                    <button type="button" onclick="closeClientDrawer()" class="px-3 py-2 text-slate-500 hover:text-slate-800 font-semibold">
                        Close Drawer
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= REGISTER API CLIENT MODAL ================= -->
    <div id="createClientModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="create-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeCreateModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full p-5 sm:p-6 border border-slate-200">
                <form method="POST" action="{{ route('admin.api-management.store') }}">
                    @csrf
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="create-modal-title">Register New API Client</h3>
                            <p class="text-xs text-slate-500">Provision secure OAuth2 API credentials with enforced policy tiers</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Application / Client Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" required placeholder="e.g. DANA Cashless Auto-Debit Integration" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Tenant Operator <span class="text-rose-500">*</span></label>
                                <select name="vendor_id" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    @foreach($tenants as $t)
                                    <option value="{{ $t['id'] }}">{{ $t['company_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Integration Category <span class="text-rose-500">*</span></label>
                                <select name="category" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    @foreach($categories as $catKey => $cat)
                                    <option value="{{ $catKey }}">{{ $cat['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Target Environment <span class="text-rose-500">*</span></label>
                                <select name="environment" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <option value="production">Production (Live Traffic)</option>
                                    <option value="sandbox">Sandbox (Testing / Staging)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Rate Limit Tier <span class="text-rose-500">*</span></label>
                                <select name="rate_limit_tier" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    @foreach($tiers as $tierKey => $tier)
                                    <option value="{{ $tierKey }}">{{ $tier['name'] }} ({{ $tier['rpm'] }} req/min)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Granted Permissions / Scopes <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-3 bg-slate-50 border border-slate-200 rounded-xl max-h-40 overflow-y-auto">
                                @foreach($scopes as $scopeKey => $scope)
                                <label class="flex items-start gap-2 cursor-pointer">
                                    <input type="checkbox" name="scopes[]" value="{{ $scopeKey }}" class="mt-0.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ in_array($scopeKey, ['parking:read']) ? 'checked' : '' }}>
                                    <div>
                                        <span class="font-mono font-bold text-slate-800 text-[11px] block">{{ $scope['label'] }}</span>
                                        <span class="text-[10px] text-slate-400 block">{{ $scope['desc'] }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Network IP Whitelist (Optional CIDRs)</label>
                            <input type="text" name="allowed_ips" placeholder="e.g. 103.12.164.0/24, 202.158.44.12/32 (Leave empty for open access)" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Integration Context / Notes</label>
                            <textarea name="status_note" rows="2" placeholder="e.g. Production webhook endpoint for contactless automated gate opening." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100 mt-4">
                        <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-colors shadow-sm shadow-indigo-600/30">Provision Credentials</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= ROTATE SECRET MODAL ================= -->
    <div id="rotateModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="rotate-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeRotateModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-5 sm:p-6 border border-slate-200">
                <form id="rotateForm" method="POST" action="">
                    @csrf
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="rotate-modal-title">Rotate Client Secret</h3>
                            <p class="text-xs text-slate-500" id="rotate-modal-subtitle">Generate replacement secret credentials</p>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-xl bg-amber-50/80 border border-amber-200 text-amber-950 text-xs mb-4">
                        <p class="font-bold mb-1">Consequential Security Operation:</p>
                        <p class="text-[11px] text-amber-800 leading-relaxed">
                            Generating a new secret will immediately invalidate the current credential. Any active third-party integrations using the previous secret must be updated with the newly generated secret.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeRotateModal()" class="px-3.5 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl transition-colors shadow-xs">Rotate & Invalidate Prior Secret</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= EDIT ACCESS POLICY MODAL ================= -->
    <div id="editPolicyModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="policy-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeEditPolicyModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-5 sm:p-6 border border-slate-200">
                <form id="editPolicyForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900" id="policy-modal-title">Configure Access Policy</h3>
                            <p class="text-xs text-slate-500" id="policy-modal-subtitle">Modify rate limits, scopes, and network CIDRs</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Rate Limit Policy Tier <span class="text-rose-500">*</span></label>
                            <select name="rate_limit_tier" id="edit-policy-tier" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                @foreach($tiers as $tierKey => $tier)
                                <option value="{{ $tierKey }}">{{ $tier['name'] }} ({{ $tier['rpm'] }} req/min • Burst: {{ $tier['burst'] }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Granted Permissions / Scopes <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-3 bg-slate-50 border border-slate-200 rounded-xl max-h-40 overflow-y-auto" id="edit-policy-scopes">
                                @foreach($scopes as $scopeKey => $scope)
                                <label class="flex items-start gap-2 cursor-pointer">
                                    <input type="checkbox" name="scopes[]" value="{{ $scopeKey }}" class="mt-0.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                    <div>
                                        <span class="font-mono font-bold text-slate-800 text-[11px] block">{{ $scope['label'] }}</span>
                                        <span class="text-[10px] text-slate-400 block">{{ $scope['desc'] }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Network IP Whitelist (Allowed CIDRs)</label>
                            <input type="text" name="allowed_ips" id="edit-policy-ips" placeholder="e.g. 103.12.164.0/24, 202.158.44.12/32" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100 mt-4">
                        <button type="button" onclick="closeEditPolicyModal()" class="px-4 py-2 text-slate-600 hover:text-slate-800 font-semibold text-xs rounded-xl bg-slate-100">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-colors shadow-sm shadow-indigo-600/30">Save Access Policy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= JAVASCRIPT WORKSPACE CONTROLLER ================= -->
    <script>
        let currentClientPayload = null;

        // Auto-open drawer if server provided selected client (?detail=client-xxx)
        @if(!empty($selectedClient))
        document.addEventListener('DOMContentLoaded', function() {
            const initialPayload = @json($selectedClient);
            populateClientDrawer(initialPayload);
            document.getElementById('apiClientDrawer').classList.remove('hidden');
        });
        @endif

        // Tab Switching
        function switchTab(tab) {
            const tabClientsBtn = document.getElementById('tab-btn-clients');
            const tabLogsBtn = document.getElementById('tab-btn-logs');
            const contentClients = document.getElementById('tab-clients-content');
            const contentLogs = document.getElementById('tab-logs-content');

            if (tab === 'clients') {
                tabClientsBtn.className = "px-4 py-2.5 font-bold border-b-2 border-indigo-600 text-indigo-600 transition-colors flex items-center gap-2";
                tabLogsBtn.className = "px-4 py-2.5 font-semibold text-slate-500 hover:text-slate-800 border-b-2 border-transparent transition-colors flex items-center gap-2";
                contentClients.classList.remove('hidden');
                contentLogs.classList.add('hidden');
            } else {
                tabClientsBtn.className = "px-4 py-2.5 font-semibold text-slate-500 hover:text-slate-800 border-b-2 border-transparent transition-colors flex items-center gap-2";
                tabLogsBtn.className = "px-4 py-2.5 font-bold border-b-2 border-indigo-600 text-indigo-600 transition-colors flex items-center gap-2";
                contentClients.classList.add('hidden');
                contentLogs.classList.remove('hidden');
            }
        }

        // Fetch & open client drawer
        async function openClientDrawer(clientId) {
            const drawer = document.getElementById('apiClientDrawer');
            drawer.classList.remove('hidden');

            try {
                const response = await fetch(`/api/admin/api-clients/${clientId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                
                if (data.success && data.client) {
                    populateClientDrawer(data.client);
                }
            } catch (err) {
                console.error('Error fetching API client:', err);
            }
        }

        function closeClientDrawer() {
            document.getElementById('apiClientDrawer').classList.add('hidden');
        }

        function populateClientDrawer(client) {
            currentClientPayload = client;

            document.getElementById('drawer-client-name').textContent = client.name;
            document.getElementById('drawer-client-vendor').textContent = `${client.vendor_name || 'Platform Infrastructure'} • ${client.category}`;
            document.getElementById('drawer-client-id').textContent = client.client_id;
            document.getElementById('drawer-client-secret').textContent = client.masked_secret;
            document.getElementById('drawer-client-fingerprint').textContent = client.key_fingerprint;
            document.getElementById('drawer-client-expires').textContent = client.expires_at || 'Never';
            document.getElementById('drawer-client-ips').textContent = client.allowed_ips || '* (Open Access)';

            // Environment
            const envEl = document.getElementById('drawer-client-env');
            if (client.environment === 'production') {
                envEl.textContent = 'Production (Live)';
                envEl.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200';
            } else {
                envEl.textContent = 'Sandbox (Test)';
                envEl.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200';
            }

            // Status
            const stEl = document.getElementById('drawer-client-status');
            stEl.textContent = client.status.toUpperCase();
            if (client.status === 'active') {
                stEl.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-100 text-emerald-800';
            } else if (client.status === 'suspended') {
                stEl.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-amber-100 text-amber-800';
            } else {
                stEl.className = 'px-2 py-0.5 rounded text-[10px] font-mono bg-rose-100 text-rose-800';
            }

            // Status Form Action & Toggle Button
            const statusForm = document.getElementById('drawerStatusForm');
            statusForm.action = `/admin/api-management/${client.id}/status`;
            const statusInput = document.getElementById('drawer-status-input');
            const statusBtn = document.getElementById('drawer-btn-status-toggle');

            if (client.status === 'active') {
                statusInput.value = 'suspended';
                statusBtn.textContent = 'Suspend Access';
                statusBtn.className = 'px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl transition-colors';
            } else {
                statusInput.value = 'active';
                statusBtn.textContent = 'Reactivate Access';
                statusBtn.className = 'px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-colors';
            }

            // Rate Limit
            const tierMapping = {
                'tier_standard': { rpm: 300, rpd: '100,000', burst: 50 },
                'tier_growth': { rpm: 600, rpd: '250,000', burst: 100 },
                'tier_enterprise': { rpm: '1,500', rpd: '1,000,000', burst: 250 },
                'tier_smart_city': { rpm: '3,000', rpd: '2,500,000', burst: 500 },
            };
            const tierData = tierMapping[client.rate_limit_tier] || { rpm: 300, rpd: '100k', burst: 50 };
            document.getElementById('drawer-policy-rpm').textContent = tierData.rpm;
            document.getElementById('drawer-policy-rpd').textContent = tierData.rpd;
            document.getElementById('drawer-policy-burst').textContent = tierData.burst;

            // Scopes
            const scopesContainer = document.getElementById('drawer-client-scopes');
            scopesContainer.innerHTML = '';
            if (client.scopes && client.scopes.length > 0) {
                client.scopes.forEach(sc => {
                    const pill = document.createElement('span');
                    pill.className = 'px-2 py-0.5 rounded text-[10px] font-mono font-semibold bg-white text-indigo-700 border border-slate-200';
                    pill.textContent = sc;
                    scopesContainer.appendChild(pill);
                });
            }

            // Usage Telemetry
            document.getElementById('drawer-usage-total').textContent = Number(client.requests_30d || 0).toLocaleString('id-ID');
            document.getElementById('drawer-usage-today').textContent = Number(client.requests_today || 0).toLocaleString('id-ID');
            document.getElementById('drawer-usage-latency').textContent = `${client.avg_latency_ms || 45}ms`;
            document.getElementById('drawer-usage-errors').textContent = `${client.error_rate_pct || 0.0}%`;

            // Timeline
            const timelineContainer = document.getElementById('drawer-client-timeline');
            timelineContainer.innerHTML = '';
            if (client.timeline && client.timeline.length > 0) {
                client.timeline.forEach(event => {
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
        }

        // Create Modal
        function openCreateModal() {
            document.getElementById('createClientModal').classList.remove('hidden');
        }
        function closeCreateModal() {
            document.getElementById('createClientModal').classList.add('hidden');
        }

        // Rotate Modal
        function openRotateModal(id, name, clientId) {
            const modal = document.getElementById('rotateModal');
            document.getElementById('rotateForm').action = `/admin/api-management/${id}/rotate-secret`;
            document.getElementById('rotate-modal-subtitle').textContent = `Client: ${name} (${clientId})`;
            modal.classList.remove('hidden');
        }
        function openRotateModalFromDrawer() {
            if (currentClientPayload) {
                openRotateModal(currentClientPayload.id, currentClientPayload.name, currentClientPayload.client_id);
            }
        }
        function closeRotateModal() {
            document.getElementById('rotateModal').classList.add('hidden');
        }

        // Edit Policy Modal
        function openEditPolicyModal(id, name, tier, scopes, ips) {
            const modal = document.getElementById('editPolicyModal');
            document.getElementById('editPolicyForm').action = `/admin/api-management/${id}/policy`;
            document.getElementById('policy-modal-subtitle').textContent = `Client: ${name}`;
            
            const tierSelect = document.getElementById('edit-policy-tier');
            if (tierSelect && tier) tierSelect.value = tier;

            const ipsInput = document.getElementById('edit-policy-ips');
            if (ipsInput) ipsInput.value = ips || '';

            const scopeCheckboxes = document.querySelectorAll('#edit-policy-scopes input[type="checkbox"]');
            scopeCheckboxes.forEach(cb => {
                cb.checked = Array.isArray(scopes) && scopes.includes(cb.value);
            });

            modal.classList.remove('hidden');
        }
        function openEditPolicyModalFromDrawer() {
            if (currentClientPayload) {
                openEditPolicyModal(
                    currentClientPayload.id,
                    currentClientPayload.name,
                    currentClientPayload.rate_limit_tier,
                    currentClientPayload.scopes,
                    currentClientPayload.allowed_ips
                );
            }
        }
        function closeEditPolicyModal() {
            document.getElementById('editPolicyModal').classList.add('hidden');
        }

        // 1-Click Clipboard Copy Function
        function copyTextToClipboard(text, buttonEl) {
            if (!text) return;
            navigator.clipboard.writeText(text).then(() => {
                const originalHtml = buttonEl.innerHTML;
                buttonEl.innerHTML = `
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-400"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Copied!</span>
                `;
                setTimeout(() => {
                    buttonEl.innerHTML = originalHtml;
                }, 2000);
            }).catch(err => {
                console.error('Clipboard copy failed:', err);
            });
        }
    </script>

</x-layouts.admin>
