<x-layouts.admin activeNav="tenants" title="Tenant Management — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Success</p>
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

    <!-- ================= PAGE HEADER ================= -->
    <div class="space-y-4 mb-6">
        
        <!-- Breadcrumbs & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">Tenant Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>Cross-Tenant Platform Governance</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Last Audit: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Tenant Management
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 39
                    </span>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">
                        {{ $pagination['total'] }} Organizations Listed
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage multi-tenant operator registrations, partner tiers, compliance verification, and lifecycle statuses.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Export CSV -->
                <a href="{{ route('admin.tenants.export', request()->query()) }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export CSV</span>
                </a>

                <!-- Register Tenant Trigger -->
                <button type="button" 
                        onclick="openCreateTenantModal()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs shadow-indigo-600/20">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Provision Tenant</span>
                </button>
            </div>
        </div>

    </div>

    <!-- ================= SUMMARY METRICS GRID ================= -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        
        <!-- Total Registered -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Registered Operators</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 font-mono tracking-tight">
                {{ $summary['total_registered'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ $summary['total_facilities'] }} monitored facilities nationwide
            </div>
        </div>

        <!-- Active Operational -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Active Operational</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-emerald-600 font-mono tracking-tight">
                {{ $summary['active_tenants'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ number_format($summary['total_bays'], 0, ',', '.') }} total bays under active management
            </div>
        </div>

        <!-- Pending Verification -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Pending KYC Verification</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-amber-600 font-mono tracking-tight">
                {{ $summary['pending_tenants'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                Legal NIB & NPWP submitted for review
            </div>
        </div>

        <!-- Requires Attention / Monthly MRR -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Contract & SaaS MRR</span>
                <span class="text-[10px] font-bold text-indigo-600 font-mono">Platform MRR</span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-indigo-700 font-mono tracking-tight truncate">
                {{ $summary['formatted_total_mrr'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                {{ $summary['grace_tenants'] }} in grace • {{ $summary['suspended_tenants'] }} suspended
            </div>
        </div>

    </div>

    <!-- ================= SEARCH & MULTI-DIMENSIONAL FILTERS ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.tenants') }}" id="tenantFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
            
            <div class="flex flex-1 flex-wrap items-center gap-2.5">
                
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[200px] sm:min-w-[280px]">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           id="tenantSearchInput"
                           value="{{ $filters['q'] }}" 
                           placeholder="Search company name, brand, ID, email, or city..." 
                           class="w-full pl-9 pr-8 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 text-slate-800 font-medium placeholder-slate-400 transition-all">
                    @if(!empty($filters['q']))
                    <a href="{{ route('admin.tenants', array_merge($filters, ['q' => ''])) }}" class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400 hover:text-slate-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                    @endif
                </div>

                <!-- Status Filter -->
                <div class="relative min-w-[140px]">
                    <select name="status" 
                            id="statusFilterSelect"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        @foreach($statuses as $sKey => $sLabel)
                            <option value="{{ $sKey }}" {{ $filters['status'] === $sKey ? 'selected' : '' }}>
                                {{ $sLabel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Partner Tier Filter -->
                <div class="relative min-w-[150px]">
                    <select name="tier" 
                            id="tierFilterSelect"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        @foreach($tiers as $tKey => $tLabel)
                            <option value="{{ $tKey }}" {{ $filters['tier'] === $tKey ? 'selected' : '' }}>
                                {{ $tLabel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Province Filter -->
                <div class="relative min-w-[140px]">
                    <select name="province" 
                            id="provinceFilterSelect"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        <option value="all">All Provinces</option>
                        @foreach($regions as $rKey => $rLabel)
                            <option value="{{ $rKey }}" {{ $filters['province'] === $rKey ? 'selected' : '' }}>
                                {{ $rLabel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Sort Filter -->
                <div class="relative min-w-[140px]">
                    <select name="sort" 
                            id="sortFilterSelect"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ $filters['sort'] === 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="bays_desc" {{ $filters['sort'] === 'bays_desc' ? 'selected' : '' }}>Bays (Highest)</option>
                        <option value="facilities_desc" {{ $filters['sort'] === 'facilities_desc' ? 'selected' : '' }}>Facilities (Most)</option>
                        <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Date (Newest)</option>
                        <option value="date_asc" {{ $filters['sort'] === 'date_asc' ? 'selected' : '' }}>Date (Oldest)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Submit / Clear Button -->
                <button type="submit" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition-colors">
                    Filter
                </button>
                @if($filters['q'] !== '' || $filters['status'] !== 'all' || $filters['tier'] !== 'all' || $filters['province'] !== 'all' || $filters['sort'] !== 'name_asc')
                <a href="{{ route('admin.tenants') }}" class="px-2.5 py-2 text-slate-400 hover:text-slate-700 text-xs font-semibold">
                    Reset
                </a>
                @endif
            </div>

        </form>
    </div>

    <!-- ================= TENANT DATA TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 uppercase text-[10px] font-bold border-b border-slate-200/80 tracking-wider">
                        <th class="py-3 px-4 sm:px-6">Organization / Identity</th>
                        <th class="py-3 px-3">Partner Tier & Region</th>
                        <th class="py-3 px-3">Primary Representative</th>
                        <th class="py-3 px-3 text-right">Facilities & Bays</th>
                        <th class="py-3 px-3 text-right">SLA Health</th>
                        <th class="py-3 px-3 text-center">Status</th>
                        <th class="py-3 px-4 sm:px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tenants as $t)
                    <tr class="hover:bg-slate-50/70 transition-colors group">
                        
                        <!-- Organization & Brand -->
                        <td class="py-3.5 px-4 sm:px-6">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center font-bold text-xs shrink-0 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                    {{ strtoupper(substr(str_replace('PT ', '', $t['company_name']), 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors flex items-center gap-1.5 truncate">
                                        <span>{{ $t['company_name'] }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 font-medium truncate mt-0.5">
                                        {{ $t['brand_name'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono mt-0.5 flex items-center gap-2">
                                        <span>ID: {{ $t['id'] }}</span>
                                        <span>•</span>
                                        <span>NIB: {{ $t['nib'] ?? 'Verified' }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Partner Tier & Region -->
                        <td class="py-3.5 px-3">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold {{ str_contains($t['tier'], 'Enterprise') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : (str_contains($t['tier'], 'Growth') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-700 border border-slate-200') }}">
                                {{ $t['tier'] }}
                            </span>
                            <div class="text-[11px] text-slate-600 font-medium mt-1">
                                {{ $t['city'] }}
                            </div>
                            <div class="text-[10px] text-slate-400">
                                {{ $t['province'] }}
                            </div>
                        </td>

                        <!-- Primary Representative -->
                        <td class="py-3.5 px-3">
                            <div class="font-bold text-slate-800">{{ $t['primary_contact_name'] }}</div>
                            <div class="text-[10px] text-slate-400">{{ $t['primary_contact_role'] }}</div>
                            <div class="text-[10px] font-mono text-indigo-600 truncate max-w-[160px] mt-0.5">
                                {{ $t['primary_contact_email'] }}
                            </div>
                        </td>

                        <!-- Facilities & Bays -->
                        <td class="py-3.5 px-3 text-right">
                            <div class="font-bold font-mono text-slate-900">
                                {{ $t['facilities_count'] }} <span class="font-sans font-normal text-[10px] text-slate-400">Facilities</span>
                            </div>
                            <div class="font-mono text-slate-600 text-[11px] mt-0.5">
                                {{ number_format($t['total_bays'], 0, ',', '.') }} Bays
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5">
                                {{ number_format($t['active_sessions'], 0, ',', '.') }} active
                            </div>
                        </td>

                        <!-- SLA Health -->
                        <td class="py-3.5 px-3 text-right">
                            <div class="font-mono font-bold text-emerald-600 flex items-center justify-end gap-1">
                                <span class="w-1.5 h-1.5 rounded-full {{ (float)$t['sla_health'] > 95 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                <span>{{ $t['sla_health'] }}</span>
                            </div>
                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                {{ $t['last_activity'] }}
                            </div>
                        </td>

                        <!-- Operational Status -->
                        <td class="py-3.5 px-3 text-center">
                            @if($t['status'] === 'Active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Active</span>
                                </span>
                            @elseif($t['status'] === 'Pending Verification')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>Pending KYC</span>
                                </span>
                            @elseif($t['status'] === 'In Grace')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    <span>In Grace</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Suspended</span>
                                </span>
                            @endif
                        </td>

                        <!-- Actions Column -->
                        <td class="py-3.5 px-4 sm:px-6 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Inspect Details -->
                                <button type="button" 
                                        onclick="inspectTenant('{{ $t['id'] }}')" 
                                        class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Inspect Organization Details">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>

                                <!-- Edit Tenant Profile -->
                                <button type="button" 
                                        onclick="openEditTenantModal('{{ $t['id'] }}')" 
                                        class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Edit Organization Profile">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>

                                <!-- Status Action Trigger -->
                                <button type="button" 
                                        onclick="openStatusModal('{{ $t['id'] }}', '{{ addslashes($t['company_name']) }}', '{{ $t['status'] }}')" 
                                        class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Change Operational Status">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">
                            <div class="max-w-sm mx-auto space-y-2">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mx-auto text-slate-300">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                </svg>
                                <div class="text-sm font-bold text-slate-700">No organizations match current filters</div>
                                <p class="text-xs text-slate-400">Try adjusting your search query, status selector, or partner tier.</p>
                                <div class="pt-2">
                                    <a href="{{ route('admin.tenants') }}" class="inline-block px-3 py-1.5 bg-indigo-50 text-indigo-700 font-bold rounded-xl text-xs hover:bg-indigo-100 transition-colors">
                                        Reset All Filters
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= PAGINATION BAR ================= -->
        <div class="p-4 bg-slate-50/70 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div>
                Showing <strong class="text-slate-800 font-mono">{{ $pagination['from'] }}</strong> to <strong class="text-slate-800 font-mono">{{ $pagination['to'] }}</strong> of <strong class="text-slate-800 font-mono">{{ $pagination['total'] }}</strong> organizations
            </div>

            <!-- Page Navigation -->
            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-1">
                @if($pagination['current_page'] > 1)
                    <a href="{{ route('admin.tenants', array_merge($filters, ['page' => $pagination['current_page'] - 1])) }}" 
                       class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                        &larr; Prev
                    </a>
                @endif

                @for($p = 1; $p <= $pagination['last_page']; $p++)
                    <a href="{{ route('admin.tenants', array_merge($filters, ['page' => $p])) }}" 
                       class="px-3 py-1 rounded-lg border {{ $pagination['current_page'] === $p ? 'bg-indigo-600 text-white font-bold border-indigo-600' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100 font-medium' }} transition-colors">
                        {{ $p }}
                    </a>
                @endfor

                @if($pagination['current_page'] < $pagination['last_page'])
                    <a href="{{ route('admin.tenants', array_merge($filters, ['page' => $pagination['current_page'] + 1])) }}" 
                       class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                        Next &rarr;
                    </a>
                @endif
            </div>
            @endif
        </div>

    </div>

    <!-- ================= TENANT DETAIL INSPECTION DRAWER ================= -->
    <div id="tenantDetailDrawer" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-end p-0 sm:p-4">
        <div class="bg-white w-full max-w-xl h-full sm:h-auto sm:max-h-[90vh] sm:rounded-2xl border border-slate-200 flex flex-col shadow-2xl overflow-hidden">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-slate-100 flex items-start justify-between gap-4 bg-slate-50/50">
                <div>
                    <span id="detailTenantId" class="text-[10px] font-mono text-slate-400 uppercase font-semibold">vdr-xxx-00</span>
                    <h2 id="detailCompanyName" class="text-base sm:text-lg font-bold text-slate-900 tracking-tight leading-tight mt-0.5">Organization Details</h2>
                    <p id="detailBrandName" class="text-xs text-slate-500 mt-0.5">-</p>
                </div>
                <button type="button" onclick="closeDetailDrawer()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Content Body -->
            <div class="p-5 overflow-y-auto space-y-4 text-xs flex-1">
                
                <!-- Status & Tier Row -->
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <div>
                        <div class="text-[10px] text-slate-400 uppercase font-bold">Partner Tier</div>
                        <div id="detailTier" class="font-bold text-slate-800 mt-0.5">Enterprise Partner</div>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 uppercase font-bold text-right">Status</div>
                        <div id="detailStatusBadge" class="mt-0.5 text-right font-bold text-emerald-600">Active</div>
                    </div>
                </div>

                <!-- Legal Identity Section -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Legal Identity & Tax</div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">NIB (Nomor Induk Berusaha)</span>
                            <span id="detailNib" class="font-mono font-bold text-slate-800 mt-0.5 block">-</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">NPWP Perusahaan</span>
                            <span id="detailNpwp" class="font-mono font-bold text-slate-800 mt-0.5 block">-</span>
                        </div>
                    </div>
                </div>

                <!-- Primary Representative -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Primary Representative & Contact</div>
                    <div class="space-y-1.5 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Name & Role</span>
                            <span id="detailContactName" class="font-bold text-slate-800 text-right">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Direct Email</span>
                            <span id="detailContactEmail" class="font-mono text-indigo-600 text-right">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Phone Number</span>
                            <span id="detailContactPhone" class="font-mono text-slate-700 text-right">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Billing Email</span>
                            <span id="detailBillingEmail" class="font-mono text-slate-700 text-right">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">City / Province</span>
                            <span id="detailCity" class="text-slate-800 text-right font-medium">-</span>
                        </div>
                    </div>
                </div>

                <!-- Subscription Summary -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">SaaS Contract & Subscription</div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Subscription Plan</span>
                            <span id="detailPlan" class="font-bold text-slate-800 mt-0.5 block">-</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Contract Expiry</span>
                            <span id="detailExpiry" class="font-medium text-slate-700 mt-0.5 block">-</span>
                        </div>
                    </div>
                </div>

                <!-- Operational Infrastructure -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Operational Scope</div>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Facilities</span>
                            <span id="detailFacilities" class="font-bold font-mono text-sm text-slate-900 mt-0.5 block">0</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Bays</span>
                            <span id="detailBays" class="font-bold font-mono text-sm text-slate-900 mt-0.5 block">0</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">SLA Health</span>
                            <span id="detailSla" class="font-bold font-mono text-sm text-emerald-600 mt-0.5 block">0%</span>
                        </div>
                    </div>
                </div>

                <!-- Status Note -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Audit Status Note</div>
                    <p id="detailStatusNote" class="text-slate-600 bg-slate-50 p-2.5 rounded-xl border border-slate-100 leading-relaxed text-[11px]">
                        -
                    </p>
                </div>

            </div>

            <!-- Drawer Footer Actions -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between gap-3">
                <button type="button" 
                        id="drawerEditBtn"
                        onclick="triggerEditFromDrawer()" 
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors">
                    Edit Organization
                </button>
                <button type="button" 
                        onclick="closeDetailDrawer()" 
                        class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- ================= PROVISION TENANT MODAL ================= -->
    <div id="createTenantModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-xl w-full p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Provision New Tenant Organization</h3>
                    <p class="text-xs text-slate-500">Register a new parking management operator on NusaPark SaaS.</p>
                </div>
                <button type="button" onclick="closeCreateTenantModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.tenants.store') }}" class="my-4 space-y-3.5 text-xs">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Company Legal Name *</label>
                        <input type="text" name="company_name" required placeholder="PT ..." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Brand Name</label>
                        <input type="text" name="brand_name" placeholder="Commercial Brand" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">NIB (13 Digits)</label>
                        <input type="text" name="nib" placeholder="912000xxxxxxx" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">NPWP Perusahaan</label>
                        <input type="text" name="npwp" placeholder="00.000.000.0-000.000" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Partner Tier *</label>
                    <select name="tier" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="Enterprise Partner">Enterprise Partner (Custom ARR • Dedicated Core)</option>
                        <option value="Growth Partner">Growth Partner (Multi-Facility Scaled Plan)</option>
                        <option value="Standard Partner" selected>Standard Partner (Standard Regional Operators)</option>
                        <option value="Starter Partner">Starter Partner (Single Site Entry)</option>
                    </select>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Primary Representative</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Representative Name *</label>
                        <input type="text" name="primary_contact_name" required placeholder="Full name" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Job Role</label>
                        <input type="text" name="primary_contact_role" placeholder="Operations Director" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Official Email *</label>
                        <input type="email" name="primary_contact_email" required placeholder="contact@company.co.id" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Phone Number *</label>
                        <input type="text" name="primary_contact_phone" required placeholder="+62 812-xxxx-xxxx" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">City *</label>
                        <input type="text" name="city" required placeholder="e.g. Jakarta Selatan" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Province *</label>
                        <input type="text" name="province" required placeholder="e.g. DKI Jakarta" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Registered Address</label>
                    <textarea name="address" rows="2" placeholder="Full office address..." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeCreateTenantModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Provision Organization
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= EDIT TENANT MODAL ================= -->
    <div id="editTenantModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-xl w-full p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <span id="editModalTenantId" class="text-[10px] font-mono text-slate-400 uppercase">vdr-xxx-00</span>
                    <h3 class="text-base font-bold text-slate-900">Edit Organization Profile</h3>
                </div>
                <button type="button" onclick="closeEditTenantModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="editTenantForm" method="POST" action="" class="my-4 space-y-3.5 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Company Legal Name *</label>
                        <input type="text" id="editCompanyName" name="company_name" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Brand Name</label>
                        <input type="text" id="editBrandName" name="brand_name" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Partner Tier *</label>
                        <select id="editTier" name="tier" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="Enterprise Partner">Enterprise Partner</option>
                            <option value="Growth Partner">Growth Partner</option>
                            <option value="Standard Partner">Standard Partner</option>
                            <option value="Starter Partner">Starter Partner</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Billing Email</label>
                        <input type="email" id="editBillingEmail" name="billing_email" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Primary Representative *</label>
                        <input type="text" id="editContactName" name="primary_contact_name" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Role / Designation</label>
                        <input type="text" id="editContactRole" name="primary_contact_role" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Contact Email *</label>
                        <input type="email" id="editContactEmail" name="primary_contact_email" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Contact Phone *</label>
                        <input type="text" id="editContactPhone" name="primary_contact_phone" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">City *</label>
                        <input type="text" id="editCity" name="city" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Province *</label>
                        <input type="text" id="editProvince" name="province" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeEditTenantModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= STATUS TRANSITION MODAL ================= -->
    <div id="statusModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Change Operational Status</h3>
                    <p id="statusModalTenantName" class="text-xs text-slate-500 mt-0.5">Organization</p>
                </div>
                <button type="button" onclick="closeStatusModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="statusForm" method="POST" action="" class="my-4 space-y-3.5 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">New Operational Status *</label>
                    <select id="statusSelect" name="status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="Active">🟢 Active (Full Operations & API Sync)</option>
                        <option value="Pending Verification">🟡 Pending Verification (KYC Audit)</option>
                        <option value="In Grace">🟠 In Grace (Billing Overdue Period)</option>
                        <option value="Suspended">🔴 Suspended (Halt Edge API Sync)</option>
                    </select>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-slate-600 text-[11px] leading-relaxed">
                    <strong>Administrative Consequence:</strong>
                    <span id="statusConsequenceText">Modifying status changes access level immediately. Existing offline gate buffers and settled customer transactions remain safely preserved in compliance with platform audit standards.</span>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Administrative Reason / Note</label>
                    <input type="text" name="reason" placeholder="e.g. Legal documentation verified and approved" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Confirm Status Update
                    </button>
                </div>
            </form>

        </div>
    </div>

    @push('scripts')
    <script>
        const allTenantsJson = @json($tenants);

        // Pre-open drawer if requested via ?detail=
        @if(!empty($selectedTenant))
        document.addEventListener('DOMContentLoaded', function() {
            populateDetailDrawer(@json($selectedTenant));
        });
        @endif

        function inspectTenant(id) {
            const tenant = allTenantsJson.find(t => t.id === id);
            if (tenant) {
                populateDetailDrawer(tenant);
            } else {
                fetch(`/api/admin/tenants/${id}`)
                    .then(res => res.json())
                    .then(res => {
                        if (res.status === 'success') {
                            populateDetailDrawer(res.data);
                        }
                    });
            }
        }

        function populateDetailDrawer(t) {
            document.getElementById('detailTenantId').textContent = t.id;
            document.getElementById('detailCompanyName').textContent = t.company_name;
            document.getElementById('detailBrandName').textContent = `${t.brand_name} • Registered ${t.created_at}`;
            document.getElementById('detailTier').textContent = t.tier;
            document.getElementById('detailStatusBadge').textContent = t.status;
            
            document.getElementById('detailNib').textContent = t.nib || 'Verified Legal NIB';
            document.getElementById('detailNpwp').textContent = t.npwp || 'Verified NPWP';
            
            document.getElementById('detailContactName').textContent = `${t.primary_contact_name} (${t.primary_contact_role})`;
            document.getElementById('detailContactEmail').textContent = t.primary_contact_email;
            document.getElementById('detailContactPhone').textContent = t.primary_contact_phone;
            document.getElementById('detailBillingEmail').textContent = t.billing_email || t.primary_contact_email;
            document.getElementById('detailCity').textContent = `${t.city}, ${t.province}`;
            
            document.getElementById('detailPlan').textContent = t.subscription_plan;
            document.getElementById('detailExpiry').textContent = t.contract_expiry || 'Active';
            
            document.getElementById('detailFacilities').textContent = t.facilities_count;
            document.getElementById('detailBays').textContent = Number(t.total_bays).toLocaleString();
            document.getElementById('detailSla').textContent = t.sla_health;
            document.getElementById('detailStatusNote').textContent = t.status_note || 'Standard operational parameters verified.';

            document.getElementById('drawerEditBtn').setAttribute('onclick', `openEditTenantModal('${t.id}')`);

            document.getElementById('tenantDetailDrawer').classList.remove('hidden');
        }

        function closeDetailDrawer() {
            document.getElementById('tenantDetailDrawer').classList.add('hidden');
        }

        function triggerEditFromDrawer() {
            const id = document.getElementById('detailTenantId').textContent;
            closeDetailDrawer();
            openEditTenantModal(id);
        }

        function openCreateTenantModal() {
            document.getElementById('createTenantModal').classList.remove('hidden');
        }

        function closeCreateTenantModal() {
            document.getElementById('createTenantModal').classList.add('hidden');
        }

        function openEditTenantModal(id) {
            const tenant = allTenantsJson.find(t => t.id === id);
            if (!tenant) return;

            document.getElementById('editModalTenantId').textContent = tenant.id;
            document.getElementById('editTenantForm').action = `/admin/tenants/${tenant.id}`;
            document.getElementById('editCompanyName').value = tenant.company_name;
            document.getElementById('editBrandName').value = tenant.brand_name;
            document.getElementById('editTier').value = tenant.tier;
            document.getElementById('editBillingEmail').value = tenant.billing_email || '';
            document.getElementById('editContactName').value = tenant.primary_contact_name;
            document.getElementById('editContactRole').value = tenant.primary_contact_role;
            document.getElementById('editContactEmail').value = tenant.primary_contact_email;
            document.getElementById('editContactPhone').value = tenant.primary_contact_phone;
            document.getElementById('editCity').value = tenant.city;
            document.getElementById('editProvince').value = tenant.province;

            document.getElementById('editTenantModal').classList.remove('hidden');
        }

        function closeEditTenantModal() {
            document.getElementById('editTenantModal').classList.add('hidden');
        }

        function openStatusModal(id, name, currentStatus) {
            document.getElementById('statusModalTenantName').textContent = `${name} (${id})`;
            document.getElementById('statusForm').action = `/admin/tenants/${id}/status`;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }
    </script>
    @endpush

</x-layouts.admin>
