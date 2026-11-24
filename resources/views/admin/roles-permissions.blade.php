<x-layouts.admin activeNav="roles-permissions" title="Roles & Permissions Governance — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Access Governance Policy Updated</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Access Control Restriction</p>
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
            <span>Validation Restrictions Encountered</span>
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
                <span class="font-medium text-slate-400">Access Governance</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">Roles & Permissions</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-900 text-slate-200 border border-slate-700 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>RBAC Policy v2.4 Active</span>
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
                        Roles & Permissions
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 52
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>High-Privilege Protection Enforced</span>
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage platform roles and access permissions.
                </p>
            </div>

            <!-- Header Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.roles-permissions', request()->query()) }}" 
                   title="Refresh roles registry"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Export Matrix CSV -->
                <a href="{{ route('admin.roles-permissions.export', request()->query()) }}" 
                   title="Export roles & permissions matrix to CSV"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export Matrix CSV</span>
                </a>

                <!-- Create Custom Role Button -->
                <button type="button" 
                        onclick="openCreateModal()" 
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Create Custom Role</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
        <!-- Card 1: Total Roles -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Defined</span>
                <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ number_format($summary['total_roles']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Platform & tenant roles</p>
            </div>
        </div>

        <!-- Card 2: System-Managed Roles -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-indigo-700">System Roles</span>
                <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-indigo-600 tracking-tight">
                    {{ number_format($summary['system_roles']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Protected system baselines</p>
            </div>
        </div>

        <!-- Card 3: Custom Roles -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-purple-700">Custom Roles</span>
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-purple-600 tracking-tight">
                    {{ number_format($summary['custom_roles']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Configurable custom tiers</p>
            </div>
        </div>

        <!-- Card 4: Platform Scoped -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-blue-700">Platform Scope</span>
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-blue-600 tracking-tight">
                    {{ number_format($summary['platform_roles']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Root & platform staff</p>
            </div>
        </div>

        <!-- Card 5: Total Permissions Catalog -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-medium uppercase tracking-wider text-emerald-700">Permissions</span>
                <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold text-emerald-600 tracking-tight">
                    {{ number_format($summary['total_permissions']) }}
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">Across {{ $summary['total_modules'] }} platform modules</p>
            </div>
        </div>
    </div>

    <!-- ================= SEARCH & FILTERS ================= -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.roles-permissions') }}" id="rolesFilterForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4">
                <!-- Search Input -->
                <div class="sm:col-span-2">
                    <label for="q" class="block text-xs font-semibold text-slate-700 mb-1">
                        Search Role Registry
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
                               placeholder="Search role name, description, ID, or scope..." 
                               class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 transition-colors">
                    </div>
                </div>

                <!-- Role Type Filter -->
                <div>
                    <label for="type" class="block text-xs font-semibold text-slate-700 mb-1">
                        Role Management Type
                    </label>
                    <select name="type" id="type" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['type'] === 'all' ? 'selected' : '' }}>All Management Types</option>
                        <option value="system" {{ $filters['type'] === 'system' ? 'selected' : '' }}>System-Managed (Protected)</option>
                        <option value="custom" {{ $filters['type'] === 'custom' ? 'selected' : '' }}>Custom Operator Roles</option>
                    </select>
                </div>

                <!-- Scope Filter -->
                <div>
                    <label for="scope" class="block text-xs font-semibold text-slate-700 mb-1">
                        Authorization Scope
                    </label>
                    <select name="scope" id="scope" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="all" {{ $filters['scope'] === 'all' ? 'selected' : '' }}>All Scopes</option>
                        <option value="platform" {{ $filters['scope'] === 'platform' ? 'selected' : '' }}>Platform-Wide (Super Admin)</option>
                        <option value="tenant" {{ $filters['scope'] === 'tenant' ? 'selected' : '' }}>Tenant-Scoped (Vendor Operator)</option>
                        <option value="driver" {{ $filters['scope'] === 'driver' ? 'selected' : '' }}>Driver / Public</option>
                    </select>
                </div>
            </div>

            <!-- Filter Controls Footer -->
            <div class="flex items-center justify-between pt-3 border-t border-slate-100 flex-wrap gap-2">
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs flex items-center gap-1.5">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                        <span>Apply Filters</span>
                    </button>

                    @php
                        $hasActiveFilters = $filters['q'] !== '' || $filters['type'] !== 'all' || $filters['scope'] !== 'all' || $filters['sort'] !== 'name_asc';
                    @endphp

                    @if($hasActiveFilters)
                    <a href="{{ route('admin.roles-permissions') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-medium transition-colors flex items-center gap-1">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Reset Filters</span>
                    </a>
                    @endif
                </div>

                <!-- View Mode Tabs (Directory Table vs Interactive Matrix) -->
                <div class="flex items-center bg-slate-100 p-1 rounded-xl text-xs font-semibold">
                    <button type="button" 
                            id="tabBtnDirectory" 
                            onclick="switchViewMode('directory')" 
                            class="px-3 py-1.5 rounded-lg bg-white text-indigo-700 shadow-xs flex items-center gap-1.5 transition-all">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                        <span>Roles Directory</span>
                    </button>
                    <button type="button" 
                            id="tabBtnMatrix" 
                            onclick="switchViewMode('matrix')" 
                            class="px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 flex items-center gap-1.5 transition-all">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        <span>Cross-Reference Matrix</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- ================= VIEW 1: ROLES DIRECTORY (TABLE INVENTORY) ================= -->
    <div id="rolesDirectoryView" class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        <div class="p-4 sm:px-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Configured Platform Roles</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-600 font-semibold">
                        {{ count($roles) }} Roles
                    </span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Authoritative role definitions and granted permission quotas.</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="inline-block w-2 h-2 rounded-full bg-indigo-500"></span>
                <span>Active Roles: {{ count($roles) }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <th class="py-3 px-4">Role Identification</th>
                        <th class="py-3 px-4">Management Type</th>
                        <th class="py-3 px-4">Scope</th>
                        <th class="py-3 px-4 text-center">Assigned Users</th>
                        <th class="py-3 px-4 text-center">Permission Quota</th>
                        <th class="py-3 px-4">Role Description</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($roles as $r)
                    @php
                        $isSystem = ($r['type'] ?? '') === 'system';
                        $isImmutable = !empty($r['is_immutable']);
                        $scope = $r['scope'] ?? 'platform';

                        $scopeBadge = match($scope) {
                            'platform' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                            'tenant' => 'bg-purple-50 text-purple-700 border-purple-200',
                            'driver' => 'bg-slate-100 text-slate-700 border-slate-200',
                            default => 'bg-slate-100 text-slate-600 border-slate-200',
                        };

                        $userCount = $r['user_count'] ?? 0;
                        $permCount = $r['permission_count'] ?? count($r['permissions'] ?? []);
                        $totalPerms = count($allPermissions);
                        $percent = $totalPerms > 0 ? round(($permCount / $totalPerms) * 100) : 0;
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <!-- Role Name & Identifier -->
                        <td class="py-3.5 px-4 align-top">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-900 text-xs">{{ $r['name'] }}</span>
                                @if($isImmutable)
                                <span class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1" title="Immutable Root System Role">
                                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <span>Root Lock</span>
                                </span>
                                @endif
                            </div>
                            <div class="font-mono text-[10px] text-slate-400 mt-0.5">
                                {{ $r['id'] }}
                            </div>
                        </td>

                        <!-- Management Type -->
                        <td class="py-3.5 px-4 align-top whitespace-nowrap">
                            @if($isSystem)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                    <span>System-Managed</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <span>Custom Operator</span>
                                </span>
                            @endif
                        </td>

                        <!-- Scope -->
                        <td class="py-3.5 px-4 align-top whitespace-nowrap">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-medium border {{ $scopeBadge }}">
                                {{ ucfirst($scope) }}-Wide
                            </span>
                        </td>

                        <!-- Assigned Users -->
                        <td class="py-3.5 px-4 align-top text-center whitespace-nowrap">
                            <a href="/admin/users?role={{ urlencode($r['name']) }}" 
                               title="Inspect assigned users in User Directory"
                               class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg {{ $userCount > 0 ? 'bg-slate-100 hover:bg-indigo-50 text-slate-800 hover:text-indigo-700' : 'bg-slate-50 text-slate-400' }} font-bold text-xs transition-colors">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                                <span>{{ $userCount }} {{ Str::plural('user', $userCount) }}</span>
                            </a>
                        </td>

                        <!-- Permission Quota -->
                        <td class="py-3.5 px-4 align-top text-center whitespace-nowrap">
                            <div class="inline-flex flex-col items-center">
                                <span class="font-bold text-slate-900 text-xs">{{ $permCount }} / {{ $totalPerms }}</span>
                                <div class="w-16 bg-slate-200 rounded-full h-1.5 mt-1 overflow-hidden">
                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        </td>

                        <!-- Role Description -->
                        <td class="py-3.5 px-4 align-top">
                            <p class="text-[11px] text-slate-600 max-w-sm line-clamp-2 leading-relaxed" title="{{ $r['description'] }}">
                                {{ $r['description'] }}
                            </p>
                        </td>

                        <!-- Actions -->
                        <td class="py-3.5 px-4 align-top text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" 
                                        onclick="openRoleDrawer('{{ $r['id'] }}')" 
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 border border-slate-200 hover:border-indigo-200 text-xs font-semibold transition-colors">
                                    <span>Permissions</span>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </button>

                                @if(!$isSystem && !$isImmutable)
                                <button type="button" 
                                        onclick="confirmDeleteRole('{{ $r['id'] }}', '{{ addslashes($r['name']) }}', {{ $userCount }})" 
                                        title="Delete custom role"
                                        class="p-1.5 rounded-lg bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-600 border border-slate-200 hover:border-rose-200 transition-colors">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="max-w-sm mx-auto text-center space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">No Roles Match Criteria</h4>
                                <p class="text-xs text-slate-500">
                                    Try adjusting your search query or reset the management type filters.
                                </p>
                                <a href="{{ route('admin.roles-permissions') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
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
    </div>

    <!-- ================= VIEW 2: INTERACTIVE PERMISSION MATRIX ================= -->
    <div id="rolesMatrixView" class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6 hidden">
        <div class="p-4 sm:px-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Cross-Role Permission Matrix</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-600 font-semibold">
                        {{ count($allPermissions) }} Grants
                    </span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Comparative matrix of granted and ungranted capabilities across all active platform roles.</p>
            </div>
            
            <div class="flex items-center gap-3 text-[11px] text-slate-500">
                <span class="inline-flex items-center gap-1">
                    <span class="w-3 h-3 rounded bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[9px]">✓</span>
                    <span>Granted</span>
                </span>
                <span class="inline-flex items-center gap-1">
                    <span class="w-3 h-3 rounded bg-slate-100 text-slate-400 flex items-center justify-center text-[9px]">•</span>
                    <span>Ungranted</span>
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <th class="py-3 px-4 min-w-[240px] sticky left-0 bg-slate-50/95 z-10">Module & Permission</th>
                        @foreach($roles as $r)
                        <th class="py-3 px-3 text-center whitespace-nowrap min-w-[110px]" title="{{ $r['name'] }}">
                            <div class="font-bold text-slate-900 text-[11px] truncate max-w-[120px] mx-auto">{{ $r['name'] }}</div>
                            <span class="text-[9px] font-mono px-1.5 py-0.2 rounded {{ ($r['type'] ?? '') === 'system' ? 'bg-indigo-50 text-indigo-700' : 'bg-purple-50 text-purple-700' }}">
                                {{ $r['type'] }}
                            </span>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($modules as $modKey => $modInfo)
                    <!-- Module Group Header Row -->
                    <tr class="bg-slate-100/70 border-y border-slate-200/80">
                        <td colspan="{{ count($roles) + 1 }}" class="py-2.5 px-4 font-bold text-slate-800 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                <span>{{ $modInfo['name'] }}</span>
                                <span class="text-[10px] text-slate-400 font-normal">({{ $modInfo['desc'] }})</span>
                            </div>
                        </td>
                    </tr>

                    @foreach($permissionsByModule[$modKey] ?? [] as $pKey => $pData)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <!-- Permission Label & Key -->
                        <td class="py-2.5 px-4 align-middle sticky left-0 bg-white hover:bg-slate-50/60 z-10 border-r border-slate-100">
                            <div class="flex items-center justify-between gap-2">
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">{{ $pData['name'] }}</div>
                                    <div class="font-mono text-[10px] text-slate-400">{{ $pKey }}</div>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    @if($pData['is_dangerous'])
                                    <span class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200" title="High Privilege Action">
                                        ADMIN
                                    </span>
                                    @endif
                                    <span class="px-1.5 py-0.2 rounded text-[9px] font-mono bg-slate-100 text-slate-600">
                                        {{ strtoupper($pData['action']) }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Role Granted Indicators -->
                        @foreach($roles as $r)
                        @php
                            $isGranted = in_array($pKey, $r['permissions'] ?? []);
                        @endphp
                        <td class="py-2.5 px-3 text-center align-middle">
                            @if($isGranted)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 font-bold text-xs" title="Granted for {{ $r['name'] }}">
                                    ✓
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-slate-300 font-bold text-xs" title="Not Granted">
                                    —
                                </span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= SLIDE-OVER ROLE & PERMISSIONS EDITOR DRAWER ================= -->
    <div id="roleDrawerBackdrop" 
         onclick="closeRoleDrawer()" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity opacity-0"></div>

    <div id="roleDrawer" 
         class="fixed top-0 right-0 h-full w-full sm:w-[580px] md:w-[680px] lg:w-[740px] bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- Drawer Header -->
        <div class="p-5 border-b border-slate-200 bg-slate-50/80 flex items-start justify-between gap-3 shrink-0">
            <div>
                <div class="flex items-center gap-2">
                    <span id="drawerRoleId" class="font-mono text-xs font-bold text-slate-900 px-2 py-0.5 rounded bg-slate-200">
                        role-id
                    </span>
                    <span id="drawerTypeBadge" class="px-2 py-0.5 rounded text-[10px] font-bold border bg-indigo-50 text-indigo-700 border-indigo-200">
                        System-Managed
                    </span>
                    <span id="drawerScopeBadge" class="px-2 py-0.5 rounded text-[10px] font-semibold border bg-purple-50 text-purple-700 border-purple-200">
                        Platform-Wide
                    </span>
                </div>
                <h3 id="drawerRoleName" class="text-base font-bold text-slate-900 mt-1.5 leading-snug">
                    Role Title
                </h3>
                <p id="drawerDescription" class="text-xs text-slate-500 mt-0.5 line-clamp-2">
                    Role description text
                </p>
            </div>
            <button type="button" 
                    onclick="closeRoleDrawer()" 
                    title="Close Panel (Esc)" 
                    class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- Drawer Form & Content Container -->
        <form id="drawerPermissionsForm" method="POST" action="#" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            @method('PUT')

            <!-- Drawer Scrollable Body -->
            <div class="p-5 sm:p-6 overflow-y-auto space-y-6 flex-1 text-xs">

                <!-- Assigned Users Summary Card -->
                <div class="p-4 rounded-xl border border-slate-200/90 space-y-3 bg-slate-50/50">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Assigned Platform Accounts</span>
                        <a id="drawerUserDirectoryLink" href="/admin/users" class="text-indigo-600 hover:text-indigo-800 text-[11px] font-semibold flex items-center gap-1 hover:underline">
                            <span>Open User Directory</span>
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                    </div>
                    
                    <div id="drawerAssignedUsersList" class="space-y-2">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- High-Privilege Notice / Immutable Warning -->
                <div id="drawerImmutableNotice" class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 space-y-1 hidden">
                    <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-800">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Root Privilege Safeguard Active</span>
                    </div>
                    <p class="text-[11px] text-amber-800 leading-relaxed">
                        This is a protected system-managed root role. Core governance and audit inspection permissions are locked to prevent irreversible platform administrator self-lockout.
                    </p>
                </div>

                <!-- Permission Quick Actions -->
                <div class="flex items-center justify-between pb-2 border-b border-slate-200 flex-wrap gap-2">
                    <div>
                        <h4 class="font-bold text-slate-900 text-xs">Granted Permission Bundles</h4>
                        <p class="text-[11px] text-slate-500">Toggle capabilities assigned to this role.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="selectAllDrawerPerms(true)" class="px-2.5 py-1 text-[11px] font-semibold rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors">
                            Grant All
                        </button>
                        <button type="button" onclick="selectAllDrawerPerms(false)" class="px-2.5 py-1 text-[11px] font-semibold rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
                            Revoke All
                        </button>
                    </div>
                </div>

                <!-- Permission Modules Checklist -->
                <div class="space-y-4">
                    @foreach($modules as $modKey => $modInfo)
                    <div class="rounded-xl border border-slate-200/90 overflow-hidden bg-white">
                        <!-- Module Group Header -->
                        <div class="p-3 bg-slate-50/80 border-b border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800 text-xs">{{ $modInfo['name'] }}</span>
                                <span class="text-[10px] text-slate-400">({{ count($permissionsByModule[$modKey] ?? []) }} permissions)</span>
                            </div>
                            <button type="button" 
                                    onclick="toggleModulePerms('{{ $modKey }}')" 
                                    class="text-[10px] text-indigo-600 hover:text-indigo-800 font-semibold">
                                Toggle Module
                            </button>
                        </div>

                        <!-- Module Permissions List -->
                        <div class="divide-y divide-slate-100 p-1">
                            @foreach($permissionsByModule[$modKey] ?? [] as $pKey => $pData)
                            <label class="p-3 flex items-start gap-3 hover:bg-slate-50/80 cursor-pointer rounded-lg transition-colors">
                                <input type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $pKey }}" 
                                       data-module="{{ $modKey }}"
                                       class="drawer-perm-checkbox mt-0.5 rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                                <div class="space-y-0.5 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-bold text-slate-800 text-xs">{{ $pData['name'] }}</span>
                                            @if($pData['is_dangerous'])
                                            <span class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                ADMIN / HIGH PRIVILEGE
                                            </span>
                                            @endif
                                        </div>
                                        <span class="font-mono text-[10px] text-slate-400">{{ $pKey }}</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 leading-relaxed">{{ $pData['desc'] }}</p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            <!-- Drawer Footer -->
            <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between shrink-0">
                <button type="button" 
                        onclick="closeRoleDrawer()" 
                        class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl text-xs font-semibold transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs flex items-center gap-1.5">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Save Role Permissions</span>
                </button>
            </div>
        </form>
    </div>

    <!-- ================= MODAL: CREATE CUSTOM ROLE ================= -->
    <div id="createRoleModalBackdrop" 
         onclick="closeCreateModal()" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity opacity-0"></div>

    <div id="createRoleModal" 
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-xl bg-white rounded-2xl shadow-2xl z-50 hidden transition-all p-6 text-xs max-h-[90vh] flex flex-col">
        
        <div class="flex items-start justify-between pb-3 border-b border-slate-100 shrink-0">
            <div>
                <h3 class="text-base font-bold text-slate-900">Create Custom Operator Role</h3>
                <p class="text-xs text-slate-500 mt-0.5">Define a new authorization role with tailored platform capabilities.</p>
            </div>
            <button type="button" onclick="closeCreateModal()" class="p-1 rounded-lg text-slate-400 hover:text-slate-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.roles-permissions.store') }}" class="flex flex-col flex-1 overflow-hidden mt-4">
            @csrf

            <div class="space-y-4 overflow-y-auto flex-1 pr-1">
                <!-- Role Name -->
                <div>
                    <label for="create_name" class="block font-semibold text-slate-700 mb-1">
                        Role Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="create_name" 
                           required 
                           placeholder="e.g. Regional Field Auditor, Cashless Gate Specialist" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                </div>

                <!-- Scope -->
                <div>
                    <label for="create_scope" class="block font-semibold text-slate-700 mb-1">
                        Authorization Scope <span class="text-rose-500">*</span>
                    </label>
                    <select name="scope" id="create_scope" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="platform">Platform-Wide (Super Admin Platform Staff)</option>
                        <option value="tenant" selected>Tenant-Scoped (Vendor Operator & Facility Staff)</option>
                        <option value="driver">Driver / Public Motorist</option>
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label for="create_description" class="block font-semibold text-slate-700 mb-1">
                        Role Purpose & Description
                    </label>
                    <textarea name="description" 
                              id="create_description" 
                              rows="2" 
                              placeholder="Briefly describe what tasks this role performs and access constraints..." 
                              class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800"></textarea>
                </div>

                <!-- Initial Permissions Selector -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block font-semibold text-slate-700">Initial Granted Permissions</label>
                        <span class="text-[10px] text-slate-400">Can be refined later</span>
                    </div>

                    <div class="max-h-48 overflow-y-auto border border-slate-200 rounded-xl p-3 space-y-2 bg-slate-50/50">
                        @foreach($allPermissions as $pKey => $pData)
                        <label class="flex items-center gap-2 text-xs hover:bg-slate-100/60 p-1 rounded cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $pKey }}" class="rounded text-indigo-600 border-slate-300">
                            <span class="font-medium text-slate-800">{{ $pData['name'] }}</span>
                            <span class="text-[10px] font-mono text-slate-400">({{ $pKey }})</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="p-3 bg-slate-100 rounded-xl text-[11px] text-slate-600">
                    <strong>Audit Notice:</strong> Creation of custom roles is recorded immediately in the platform audit trail for security compliance.
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2 shrink-0 mt-4">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-xs">
                    Create Role
                </button>
            </div>
        </form>
    </div>

    <!-- ================= MODAL: DELETE ROLE CONFIRMATION ================= -->
    <div id="deleteRoleModalBackdrop" 
         onclick="closeDeleteModal()" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity opacity-0"></div>

    <div id="deleteRoleModal" 
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl z-50 hidden transition-all p-6 text-xs">
        
        <div class="flex items-center gap-3 text-rose-600 mb-3">
            <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Confirm Custom Role Deletion</h3>
                <p class="text-xs text-slate-500">This action permanently purges the role definition.</p>
            </div>
        </div>

        <p class="text-slate-600 leading-relaxed mb-4">
            Are you sure you want to delete role <strong id="deleteRoleNameText" class="text-slate-900">Role Name</strong>? 
            System-managed roles and roles with active assigned users cannot be deleted.
        </p>

        <form id="deleteRoleForm" method="POST" action="#">
            @csrf
            @method('DELETE')

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold shadow-xs">
                    Confirm Deletion
                </button>
            </div>
        </form>
    </div>

    <!-- Embedded Scripts for Drawer and Workspace Controller -->
    <script>
        const rolesData = @json($roles);
        const allPermissionsData = @json($allPermissions);

        function switchViewMode(mode) {
            const dirView = document.getElementById('rolesDirectoryView');
            const matView = document.getElementById('rolesMatrixView');
            const tabDir = document.getElementById('tabBtnDirectory');
            const tabMat = document.getElementById('tabBtnMatrix');

            if (mode === 'matrix') {
                dirView.classList.add('hidden');
                matView.classList.remove('hidden');

                tabMat.className = 'px-3 py-1.5 rounded-lg bg-white text-indigo-700 shadow-xs flex items-center gap-1.5 transition-all';
                tabDir.className = 'px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 flex items-center gap-1.5 transition-all';
            } else {
                matView.classList.add('hidden');
                dirView.classList.remove('hidden');

                tabDir.className = 'px-3 py-1.5 rounded-lg bg-white text-indigo-700 shadow-xs flex items-center gap-1.5 transition-all';
                tabMat.className = 'px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 flex items-center gap-1.5 transition-all';
            }
        }

        function openRoleDrawer(roleId) {
            let role = rolesData.find(r => r.id === roleId);

            if (role) {
                renderRoleDrawer(role);
            } else {
                fetch(`/api/admin/roles/${encodeURIComponent(roleId)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.role) {
                            renderRoleDrawer(data.role);
                        } else {
                            alert(data.message || 'Role record could not be loaded.');
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching role:', err);
                        alert('Failed to connect to role governance API.');
                    });
            }
        }

        function renderRoleDrawer(role) {
            document.getElementById('drawerRoleId').textContent = role.id;
            document.getElementById('drawerRoleName').textContent = role.name;
            document.getElementById('drawerDescription').textContent = role.description || 'No description configured.';

            // Setup Form Action
            const form = document.getElementById('drawerPermissionsForm');
            form.action = `/admin/roles-permissions/${encodeURIComponent(role.id)}`;

            // Type Badge
            const isSystem = (role.type || 'system') === 'system';
            const isImmutable = !!role.is_immutable;
            const typeBadge = document.getElementById('drawerTypeBadge');
            typeBadge.textContent = isSystem ? 'System-Managed' : 'Custom Operator';
            typeBadge.className = isSystem ? 'px-2 py-0.5 rounded text-[10px] font-bold border bg-indigo-50 text-indigo-700 border-indigo-200' : 'px-2 py-0.5 rounded text-[10px] font-bold border bg-purple-50 text-purple-700 border-purple-200';

            // Scope Badge
            const scopeBadge = document.getElementById('drawerScopeBadge');
            scopeBadge.textContent = (role.scope || 'platform').toUpperCase() + '-WIDE';

            // Immutable Notice
            const notice = document.getElementById('drawerImmutableNotice');
            if (isImmutable) {
                notice.classList.remove('hidden');
            } else {
                notice.classList.add('hidden');
            }

            // User directory link
            const uLink = document.getElementById('drawerUserDirectoryLink');
            uLink.href = `/admin/users?role=${encodeURIComponent(role.name)}`;

            // Assigned Users List
            const usersContainer = document.getElementById('drawerAssignedUsersList');
            const assigned = role.assigned_users || [];
            if (assigned.length > 0) {
                let uHtml = '<div class="divide-y divide-slate-100 max-h-36 overflow-y-auto">';
                assigned.forEach(u => {
                    uHtml += `
                        <div class="py-1.5 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-md bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-[9px] uppercase">
                                    ${u.name.substring(0, 2)}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800">${escapeHtml(u.name)}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">${escapeHtml(u.email)}</div>
                                </div>
                            </div>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-medium">
                                ${escapeHtml(u.vendor_name || u.account_type)}
                            </span>
                        </div>
                    `;
                });
                uHtml += '</div>';
                usersContainer.innerHTML = uHtml;
            } else {
                usersContainer.innerHTML = `
                    <div class="text-[11px] text-slate-400 italic py-1">
                        No active users currently assigned to this role.
                    </div>
                `;
            }

            // Checkboxes
            const rolePerms = role.permissions || [];
            const checkboxes = document.querySelectorAll('.drawer-perm-checkbox');
            checkboxes.forEach(cb => {
                const isGranted = rolePerms.includes(cb.value);
                cb.checked = isGranted;

                // Root lock for mandatory permissions if immutable
                if (isImmutable && ['access.roles.view', 'access.roles.manage', 'audit.ledger.view'].includes(cb.value)) {
                    cb.checked = true;
                    cb.disabled = true;
                } else {
                    cb.disabled = false;
                }
            });

            // Open Animation
            const backdrop = document.getElementById('roleDrawerBackdrop');
            const drawer = document.getElementById('roleDrawer');

            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            }, 10);

            // Update URL without reload
            const url = new URL(window.location.href);
            url.searchParams.set('detail', role.id);
            window.history.replaceState({}, '', url);
        }

        function closeRoleDrawer() {
            const backdrop = document.getElementById('roleDrawerBackdrop');
            const drawer = document.getElementById('roleDrawer');

            drawer.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0');

            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);

            const url = new URL(window.location.href);
            url.searchParams.delete('detail');
            window.history.replaceState({}, '', url);
        }

        function selectAllDrawerPerms(check) {
            const checkboxes = document.querySelectorAll('.drawer-perm-checkbox:not(:disabled)');
            checkboxes.forEach(cb => cb.checked = check);
        }

        function toggleModulePerms(modKey) {
            const checkboxes = document.querySelectorAll(`.drawer-perm-checkbox[data-module="${modKey}"]:not(:disabled)`);
            if (checkboxes.length > 0) {
                const anyUnchecked = Array.from(checkboxes).some(cb => !cb.checked);
                checkboxes.forEach(cb => cb.checked = anyUnchecked);
            }
        }

        function openCreateModal() {
            const backdrop = document.getElementById('createRoleModalBackdrop');
            const modal = document.getElementById('createRoleModal');

            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
            }, 10);
        }

        function closeCreateModal() {
            const backdrop = document.getElementById('createRoleModalBackdrop');
            const modal = document.getElementById('createRoleModal');

            backdrop.classList.add('opacity-0');
            setTimeout(() => {
                backdrop.classList.add('hidden');
                modal.classList.add('hidden');
            }, 200);
        }

        function confirmDeleteRole(roleId, roleName, userCount) {
            if (userCount > 0) {
                alert(`Cannot delete role '${roleName}' because ${userCount} active users are currently assigned. Reassign users in the User Directory first.`);
                return;
            }

            document.getElementById('deleteRoleNameText').textContent = roleName;
            document.getElementById('deleteRoleForm').action = `/admin/roles-permissions/${encodeURIComponent(roleId)}`;

            const backdrop = document.getElementById('deleteRoleModalBackdrop');
            const modal = document.getElementById('deleteRoleModal');

            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
            }, 10);
        }

        function closeDeleteModal() {
            const backdrop = document.getElementById('deleteRoleModalBackdrop');
            const modal = document.getElementById('deleteRoleModal');

            backdrop.classList.add('opacity-0');
            setTimeout(() => {
                backdrop.classList.add('hidden');
                modal.classList.add('hidden');
            }, 200);
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Close drawer or modals on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRoleDrawer();
                closeCreateModal();
                closeDeleteModal();
            }
        });

        // Auto-open on load if ?detail=role-xxx is in URL
        document.addEventListener('DOMContentLoaded', function() {
            @if(!empty($selectedRole))
                openRoleDrawer('{{ $selectedRole['id'] }}');
            @endif
        });
    </script>
</x-layouts.admin>
