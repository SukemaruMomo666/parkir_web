<x-layouts.vendor activeNav="staff" title="Operator Staff Management - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Operation Successful</p>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 cursor-pointer" aria-label="Dismiss alert">
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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Security & Operational Notice</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 cursor-pointer" aria-label="Dismiss alert">
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
            <p class="text-xs font-bold uppercase tracking-wider text-amber-900">Form Validation Error</p>
            <ul class="text-sm list-disc list-inside space-y-0.5 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- ================= PAGE HEADER & PRIMARY ACTIONS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Team & Access Control • Page 32</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Tenant: {{ $tenant['brand_name'] }}
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Managed Scope: {{ $metrics['facility_coverage'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Staff
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Manage your team's access to NusaPark facilities and operations.
                </p>
            </div>
        </div>

        <!-- Primary Action Buttons -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Refresh Staff View -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Staff Directory"
                    aria-label="Refresh Live Staff Directory">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Invite / Add Staff Modal Trigger -->
            <button type="button" 
                    onclick="openAddModal()" 
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
                    id="btn-open-add-staff">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Invite Staff</span>
            </button>
        </div>
    </div>

    <!-- ================= STAFF SUMMARY METRICS STRIP ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
        
        <!-- Total Staff -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Total Staff</span>
                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1">
                    {{ $metrics['total_staff'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    Authorized in vendor tenant
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[var(--accent)] flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
        </div>

        <!-- Active Members -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Active Members</span>
                <div class="text-xl sm:text-2xl font-extrabold text-emerald-700 mt-1">
                    {{ $metrics['active_count'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    Operational & logged in
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
        </div>

        <!-- Pending Invitations -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Pending Invitations</span>
                <div class="text-xl sm:text-2xl font-extrabold text-amber-700 mt-1">
                    {{ $metrics['pending_count'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    Awaiting email token verification
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
        </div>

        <!-- Suspended Members -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Suspended Accounts</span>
                <div class="text-xl sm:text-2xl font-extrabold text-rose-700 mt-1">
                    {{ $metrics['suspended_count'] }}
                </div>
                <div class="text-[11px] text-slate-500 mt-0.5">
                    Access revoked or on hold
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
            </div>
        </div>

    </div>

    <!-- ================= SEARCH & FILTERS BAR ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <form method="GET" action="/vendor/staff" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            
            <!-- 1. Search Query -->
            <div class="lg:col-span-2">
                <label for="filter-q" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Search Staff
                </label>
                <div class="relative">
                    <input type="text" 
                           id="filter-q"
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search by name, email, phone, or ID..." 
                           class="w-full pl-9 pr-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all">
                    <div class="absolute left-3 top-2.5 text-slate-400 pointer-events-none">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </div>
            </div>

            <!-- 2. Role Filter -->
            <div>
                <label for="filter-role" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Operational Role
                </label>
                <select id="filter-role" 
                        name="role" 
                        class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($filters['role'] === 'all') ? 'selected' : '' }}>All Roles</option>
                    <option value="owner" {{ ($filters['role'] === 'owner') ? 'selected' : '' }}>Vendor Owner</option>
                    <option value="administrator" {{ ($filters['role'] === 'administrator') ? 'selected' : '' }}>Operations Administrator</option>
                    <option value="supervisor" {{ ($filters['role'] === 'supervisor') ? 'selected' : '' }}>Facility Supervisor</option>
                    <option value="operator" {{ ($filters['role'] === 'operator') ? 'selected' : '' }}>Lane & Barrier Operator</option>
                </select>
            </div>

            <!-- 3. Status Filter -->
            <div>
                <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Account Status
                </label>
                <select id="filter-status" 
                        name="status" 
                        class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Statuses</option>
                    <option value="active" {{ ($filters['status'] === 'active') ? 'selected' : '' }}>Active Personnel</option>
                    <option value="pending" {{ ($filters['status'] === 'pending') ? 'selected' : '' }}>Pending Invitation</option>
                    <option value="suspended" {{ ($filters['status'] === 'suspended') ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>

            <!-- 4. Facility Filter & Submit Controls -->
            <div>
                <label for="filter-facility" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">
                    Facility Scope
                </label>
                <div class="flex items-center gap-2">
                    <select id="filter-facility" 
                            name="facility" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['facility'] === 'all') ? 'selected' : '' }}>All Facilities</option>
                        @foreach($facilities as $f)
                            <option value="{{ $f['id'] }}" {{ ($filters['facility'] === $f['id']) ? 'selected' : '' }}>
                                {{ $f['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" 
                            class="px-3.5 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold transition-colors cursor-pointer shrink-0">
                        Filter
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/staff" 
                       class="px-2.5 py-2 rounded-xl border border-slate-200 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition-colors shrink-0" 
                       title="Reset filters">
                        Reset
                    </a>
                    @endif
                </div>
            </div>

        </form>
    </div>

    <!-- ================= STAFF LIST TABLE ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <!-- Table Topbar -->
        <div class="px-5 py-3.5 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div>
                <span class="font-bold text-slate-800">Staff Members Directory</span>
                <span class="text-slate-500 ml-1.5">• Showing {{ $pagination['from'] }} - {{ $pagination['to'] }} of {{ $pagination['total'] }} recorded personnel</span>
            </div>

            <div class="text-slate-500 text-[11px]">
                Vendor Tenant: <strong class="text-slate-800">{{ $tenant['company_name'] }}</strong>
            </div>
        </div>

        <!-- Table Responsive Container -->
        <div class="overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse text-xs min-w-[850px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Staff Member</th>
                        <th class="py-3.5 px-4">Role & Authority</th>
                        <th class="py-3.5 px-4">Facility Access Scope</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4">Last Activity</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($staff as $member)
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        
                        <!-- 1. Staff Identity -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs shrink-0 {{ !empty($member['is_owner']) ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                                    {{ $member['initials'] }}
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold text-slate-900 truncate">{{ $member['name'] }}</span>
                                        @if(!empty($member['is_owner']))
                                        <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold uppercase bg-amber-100 text-amber-800 border border-amber-300">
                                            Owner
                                        </span>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-slate-500 font-mono truncate">
                                        {{ $member['email'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $member['phone'] }} • <span class="font-mono">{{ $member['id'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- 2. Role & Authority -->
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold {{ $member['role_meta']['badge'] }}">
                                {{ $member['role_meta']['label'] }}
                            </span>
                            <div class="text-[10px] text-slate-400 mt-0.5 line-clamp-1 max-w-[200px]" title="{{ $member['role_meta']['description'] }}">
                                {{ $member['role_meta']['description'] }}
                            </div>
                        </td>

                        <!-- 3. Facility Access Scope -->
                        <td class="py-3.5 px-4">
                            @if($member['is_all_facilities'])
                            <div>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    All Authorized Facilities (3)
                                </span>
                                <div class="text-[10px] text-slate-400 mt-0.5">Unrestricted portfolio access</div>
                            </div>
                            @else
                            <div class="space-y-1">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($member['facility_badges'] as $bName)
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $bName }}
                                    </span>
                                    @endforeach
                                </div>
                                <div class="text-[10px] text-slate-400">Scoped facility permissions</div>
                            </div>
                            @endif
                        </td>

                        <!-- 4. Account Status -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            @if($member['status'] === 'active')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                            @elseif($member['status'] === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-300" title="Invited on {{ $member['invited_at'] }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Pending Invite
                            </span>
                            <div class="text-[9px] text-amber-700 mt-0.5">Awaiting activation</div>
                            @elseif($member['status'] === 'suspended')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                Suspended
                            </span>
                            @endif
                        </td>

                        <!-- 5. Last Activity -->
                        <td class="py-3.5 px-4 whitespace-nowrap text-slate-600">
                            <div>{{ $member['last_active_at'] }}</div>
                            <div class="text-[10px] text-slate-400">Joined {{ date('d M Y', strtotime($member['created_at'])) }}</div>
                        </td>

                        <!-- 6. Actions -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Detail View Button -->
                                <button type="button" 
                                        onclick="openViewModal({{ json_encode($member) }})"
                                        class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-2xs"
                                        title="View staff details & access report">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Edit Staff Button -->
                                <button type="button" 
                                        onclick="openEditModal({{ json_encode($member) }})"
                                        class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-2xs"
                                        title="Edit staff details and permissions">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>

                                <!-- Resend Invite Button (If Pending) -->
                                @if($member['status'] === 'pending')
                                <form method="POST" action="/vendor/staff/{{ $member['id'] }}/resend-invitation" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="p-1.5 rounded-lg border border-amber-200 bg-amber-50 hover:bg-amber-100 text-amber-800 transition-colors cursor-pointer shadow-2xs"
                                            title="Resend activation invitation email">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                    </button>
                                </form>
                                @endif

                                <!-- Suspend / Reactivate Status Toggle -->
                                @if(empty($member['is_owner']))
                                <button type="button" 
                                        onclick="openToggleModal('{{ $member['id'] }}', '{{ $member['name'] }}', '{{ $member['status'] === 'active' ? 'suspended' : 'active' }}')"
                                        class="p-1.5 rounded-lg border {{ $member['status'] === 'active' ? 'border-amber-200 bg-amber-50/50 hover:bg-amber-100 text-amber-700' : 'border-emerald-200 bg-emerald-50 hover:bg-emerald-100 text-emerald-700' }} transition-colors cursor-pointer shadow-2xs"
                                        title="{{ $member['status'] === 'active' ? 'Suspend staff member access' : 'Reactivate staff member access' }}">
                                    @if($member['status'] === 'active')
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
                                    @else
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    @endif
                                </button>

                                <!-- Delete / Revoke Access Button -->
                                <button type="button" 
                                        onclick="openDeleteModal('{{ $member['id'] }}', '{{ $member['name'] }}', '{{ $member['email'] }}')"
                                        class="p-1.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 transition-colors cursor-pointer shadow-2xs"
                                        title="Revoke access and remove staff member">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                                @else
                                <span class="p-1.5 text-slate-300 cursor-not-allowed" title="Owner account protected from deletion and suspension">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </span>
                                @endif

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-4 text-center">
                            <div class="max-w-sm mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900">No staff members match active filters</h4>
                                <p class="text-xs text-slate-500 mt-1">
                                    No records matched your search term or selected role/status criteria. Try adjusting the query.
                                </p>
                                <a href="/vendor/staff" class="mt-3 px-3 py-1.5 rounded-lg bg-[var(--primary)] text-white text-xs font-bold">
                                    Reset Filters
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Pagination Footer -->
        <div class="px-5 py-3.5 border-t border-[var(--border)] bg-slate-50/75 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div class="text-slate-500">
                Showing <span class="font-bold text-slate-800">{{ $pagination['from'] }}</span> to <span class="font-bold text-slate-800">{{ $pagination['to'] }}</span> of <span class="font-bold text-slate-800">{{ $pagination['total'] }}</span> staff members
            </div>
            
            <div class="flex items-center gap-2">
                @if($pagination['current_page'] > 1)
                <a href="/vendor/staff?q={{ urlencode($filters['q']) }}&role={{ $filters['role'] }}&status={{ $filters['status'] }}&facility={{ $filters['facility'] }}&sort={{ $filters['sort'] }}&page={{ $pagination['current_page'] - 1 }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold transition-colors cursor-pointer shadow-2xs">
                    &larr; Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 font-bold cursor-not-allowed">
                    &larr; Previous
                </span>
                @endif

                <span class="px-2 text-slate-600 font-semibold">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/staff?q={{ urlencode($filters['q']) }}&role={{ $filters['role'] }}&status={{ $filters['status'] }}&facility={{ $filters['facility'] }}&sort={{ $filters['sort'] }}&page={{ $pagination['current_page'] + 1 }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold transition-colors cursor-pointer shadow-2xs">
                    Next &rarr;
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 font-bold cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif
            </div>
        </div>

    </div>

    <!-- ================= MODAL 1: ADD / INVITE STAFF MEMBER ================= -->
    <div id="modal-add-staff" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs" onclick="closeAddModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-10 animate-fade-in">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[var(--primary)] text-white flex items-center justify-center font-bold text-xs">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Invite New Staff Member</h3>
                            <p class="text-[11px] text-slate-500">Add an operator to {{ $tenant['brand_name'] }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Modal Form -->
                <form method="POST" action="/vendor/staff" class="p-6 space-y-4">
                    @csrf

                    <!-- Full Name & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="add-name" class="block text-xs font-bold text-slate-700 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="add-name" 
                                   name="name" 
                                   required 
                                   placeholder="e.g. Maya Indah" 
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <div>
                            <label for="add-email" class="block text-xs font-bold text-slate-700 mb-1">
                                Corporate Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="add-email" 
                                   name="email" 
                                   required 
                                   placeholder="e.g. maya@parkircipta.co.id" 
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                    </div>

                    <!-- Phone Number & Role -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="add-phone" class="block text-xs font-bold text-slate-700 mb-1">
                                Phone Number
                            </label>
                            <input type="text" 
                                   id="add-phone" 
                                   name="phone" 
                                   placeholder="+62 812-xxxx-xxxx" 
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <div>
                            <label for="add-role" class="block text-xs font-bold text-slate-700 mb-1">
                                Role & Permissions <span class="text-red-500">*</span>
                            </label>
                            <select id="add-role" 
                                    name="role" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="operator">Lane & Barrier Operator</option>
                                <option value="supervisor">Facility Supervisor</option>
                                <option value="administrator">Operations Administrator</option>
                            </select>
                        </div>
                    </div>

                    <!-- Facility Assignment Scope -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Facility Access Scope <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="radio" 
                                       name="facility_scope" 
                                       value="all" 
                                       checked 
                                       onchange="toggleFacilitySelection(this.value)"
                                       class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                <div class="text-xs">
                                    <strong class="text-slate-800">All Authorized Facilities</strong>
                                    <p class="text-[10px] text-slate-500">Access to all current (3) and future facilities in this vendor portfolio</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="radio" 
                                       name="facility_scope" 
                                       value="custom" 
                                       onchange="toggleFacilitySelection(this.value)"
                                       class="text-[var(--primary)] focus:ring-[var(--primary)]">
                                <div class="text-xs">
                                    <strong class="text-slate-800">Assign Specific Facilities</strong>
                                    <p class="text-[10px] text-slate-500">Restrict staff member to selected location(s) only</p>
                                </div>
                            </label>
                        </div>

                        <!-- Checkbox List (Visible only when custom scope is active) -->
                        <div id="add-specific-facilities-container" class="hidden mt-2 p-3 rounded-xl border border-blue-200 bg-blue-50/50 space-y-2">
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-blue-900">Select Permitted Facilities</span>
                            @foreach($facilities as $f)
                            <label class="flex items-center gap-2 text-xs font-medium text-slate-800 cursor-pointer">
                                <input type="checkbox" 
                                       name="facilities[]" 
                                       value="{{ $f['id'] }}" 
                                       class="rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                                <span>{{ $f['name'] }} ({{ $f['city'] }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Dispatch Invitation Checkbox -->
                    <div class="pt-2 border-t border-slate-100">
                        <label class="flex items-start gap-2.5 cursor-pointer">
                            <input type="checkbox" 
                                   name="send_invite" 
                                   value="1" 
                                   checked 
                                   class="mt-0.5 rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                            <div class="text-xs">
                                <span class="font-bold text-slate-800">Dispatch Email Activation Invitation</span>
                                <p class="text-[10px] text-slate-500">The recipient will receive an onboarding link with a secure one-time activation token.</p>
                            </div>
                        </label>
                    </div>

                    <!-- Operational Notes -->
                    <div>
                        <label for="add-notes" class="block text-xs font-bold text-slate-700 mb-1">
                            Internal Administrative Note
                        </label>
                        <input type="text" 
                               id="add-notes" 
                               name="notes" 
                               placeholder="e.g. Hired for weekend morning shift at West Mall" 
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" 
                                onclick="closeAddModal()" 
                                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold cursor-pointer shadow-xs">
                            Send Invitation
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= MODAL 2: EDIT STAFF MEMBER ================= -->
    <div id="modal-edit-staff" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs" onclick="closeEditModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-10 animate-fade-in">
                
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[var(--accent)] text-white flex items-center justify-center font-bold text-xs">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Edit Staff Permissions</h3>
                            <p class="text-[11px] text-slate-500" id="edit-modal-subtext">Update staff details</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="edit-staff-form" method="POST" action="" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="edit-name" class="block text-xs font-bold text-slate-700 mb-1">Full Name</label>
                            <input type="text" id="edit-name" name="name" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <div>
                            <label for="edit-phone" class="block text-xs font-bold text-slate-700 mb-1">Phone Number</label>
                            <input type="text" id="edit-phone" name="phone" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <!-- Role -->
                        <div>
                            <label for="edit-role" class="block text-xs font-bold text-slate-700 mb-1">Assigned Role</label>
                            <select id="edit-role" name="role" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="operator">Lane & Barrier Operator</option>
                                <option value="supervisor">Facility Supervisor</option>
                                <option value="administrator">Operations Administrator</option>
                                <option value="owner" disabled>Vendor Owner (Protected)</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="edit-status" class="block text-xs font-bold text-slate-700 mb-1">Membership Status</label>
                            <select id="edit-status" name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="active">Active Personnel</option>
                                <option value="pending">Pending Invitation</option>
                                <option value="suspended">Suspended Access</option>
                            </select>
                        </div>
                    </div>

                    <!-- Facility Assignment Scope -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Facility Access Scope</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="radio" id="edit-scope-all" name="facility_scope" value="all" onchange="toggleEditFacilitySelection(this.value)">
                                <div class="text-xs">
                                    <strong class="text-slate-800">All Authorized Facilities</strong>
                                    <p class="text-[10px] text-slate-500">Unrestricted operational authority across all sites</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="radio" id="edit-scope-custom" name="facility_scope" value="custom" onchange="toggleEditFacilitySelection(this.value)">
                                <div class="text-xs">
                                    <strong class="text-slate-800">Specific Assigned Facilities</strong>
                                    <p class="text-[10px] text-slate-500">Limit access to selected facilities</p>
                                </div>
                            </label>
                        </div>

                        <div id="edit-specific-facilities-container" class="hidden mt-2 p-3 rounded-xl border border-blue-200 bg-blue-50/50 space-y-2">
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-blue-900">Select Permitted Facilities</span>
                            @foreach($facilities as $f)
                            <label class="flex items-center gap-2 text-xs font-medium text-slate-800 cursor-pointer">
                                <input type="checkbox" name="facilities[]" value="{{ $f['id'] }}" class="edit-fac-checkbox rounded text-[var(--primary)]">
                                <span>{{ $f['name'] }} ({{ $f['city'] }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label for="edit-notes" class="block text-xs font-bold text-slate-700 mb-1">Operational Notes</label>
                        <input type="text" id="edit-notes" name="notes" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                    </div>

                    <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white text-xs font-bold cursor-pointer shadow-xs">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= MODAL 3: VIEW STAFF DETAILS ================= -->
    <div id="modal-view-staff" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs" onclick="closeViewModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-10 animate-fade-in">
                
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-xs">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Staff Member Profile</h3>
                            <p class="text-[11px] text-slate-500">Security & Operational Dossier</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeViewModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    
                    <!-- Identity Strip -->
                    <div class="flex items-center gap-3.5 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                        <div id="view-initials" class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white font-bold text-base flex items-center justify-center shrink-0">
                            ST
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h4 id="view-name" class="font-extrabold text-slate-900 text-base leading-tight">Name</h4>
                                <span id="view-owner-badge" class="hidden px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-amber-100 text-amber-800 border border-amber-300">Owner</span>
                            </div>
                            <p id="view-email" class="text-xs text-slate-500 font-mono mt-0.5">email@domain.com</p>
                            <p id="view-phone" class="text-xs text-slate-600 font-medium">+62 812-xxxx-xxxx</p>
                        </div>
                    </div>

                    <!-- Role & Status Grid -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Operational Role</span>
                            <span id="view-role-label" class="font-bold text-slate-900 block">Role</span>
                            <p id="view-role-desc" class="text-[11px] text-slate-500 mt-0.5 leading-snug">Description</p>
                        </div>

                        <div class="p-3 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Account Status</span>
                            <span id="view-status-badge" class="inline-block px-2 py-0.5 rounded text-[10px] font-bold">Status</span>
                            <p id="view-last-active" class="text-[11px] text-slate-500 mt-1">Last activity info</p>
                        </div>
                    </div>

                    <!-- Facility Access -->
                    <div class="p-3.5 rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Authorized Facility Access</span>
                        <div id="view-facilities-list" class="flex flex-wrap gap-1.5">
                            <!-- Populated via JS -->
                        </div>
                    </div>

                    <!-- Audit Metadata -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-[11px] space-y-1 text-slate-500">
                        <div>Staff Identifier: <strong id="view-id" class="text-slate-800 font-mono font-bold">STF-001</strong></div>
                        <div>Date Onboarded: <span id="view-created-at" class="text-slate-700">10 Jan 2025</span></div>
                        <div>Administrative Note: <span id="view-notes" class="text-slate-700 italic">No notes</span></div>
                    </div>

                    <div class="flex items-center justify-end pt-2">
                        <button type="button" onclick="closeViewModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold cursor-pointer">
                            Close
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ================= MODAL 4: CONFIRM STATUS TOGGLE ================= -->
    <div id="modal-toggle-status" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs" onclick="closeToggleModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-10 animate-fade-in p-6">
                
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900" id="toggle-modal-title">Confirm Access Modification</h3>
                        <p class="text-xs text-slate-500 mt-1" id="toggle-modal-desc">
                            Are you sure you want to change this staff member's operational status?
                        </p>
                    </div>
                </div>

                <form id="toggle-status-form" method="POST" action="" class="mt-5 flex items-center justify-end gap-2.5">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="toggle-target-status" name="status" value="">
                    
                    <button type="button" onclick="closeToggleModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="toggle-confirm-btn" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold cursor-pointer shadow-xs">
                        Confirm Update
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= MODAL 5: CONFIRM REVOKE / DELETE ================= -->
    <div id="modal-delete-staff" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs" onclick="closeDeleteModal()"></div>
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-10 animate-fade-in p-6">
                
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Revoke Staff Access</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Are you sure you want to permanently revoke access for <strong id="delete-staff-name" class="text-slate-900">Staff Member</strong> (<span id="delete-staff-email" class="font-mono">email</span>)?
                        </p>
                        <p class="text-[11px] text-red-600 mt-2 font-medium">
                            This will immediately terminate their ability to login and control facility hardware.
                        </p>
                    </div>
                </div>

                <form id="delete-staff-form" method="POST" action="" class="mt-5 flex items-center justify-end gap-2.5">
                    @csrf
                    @method('DELETE')
                    
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold cursor-pointer shadow-xs">
                        Revoke Access
                    </button>
                </form>

            </div>
        </div>
    </div>

@push('scripts')
<script>
    /**
     * Modal Visibility Helpers
     */
    function openAddModal() {
        document.getElementById('modal-add-staff').classList.remove('hidden');
    }
    function closeAddModal() {
        document.getElementById('modal-add-staff').classList.add('hidden');
    }

    function toggleFacilitySelection(val) {
        const container = document.getElementById('add-specific-facilities-container');
        if (val === 'custom') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    function toggleEditFacilitySelection(val) {
        const container = document.getElementById('edit-specific-facilities-container');
        if (val === 'custom') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    /**
     * Open and populate Edit Staff Modal
     */
    function openEditModal(staff) {
        document.getElementById('edit-staff-form').action = '/vendor/staff/' + staff.id;
        document.getElementById('edit-modal-subtext').innerText = staff.name + ' (' + staff.email + ')';
        document.getElementById('edit-name').value = staff.name;
        document.getElementById('edit-phone').value = staff.phone || '';
        document.getElementById('edit-notes').value = staff.notes || '';

        // Role & Status
        const roleSelect = document.getElementById('edit-role');
        roleSelect.value = staff.role;
        roleSelect.disabled = !!staff.is_owner;

        const statusSelect = document.getElementById('edit-status');
        statusSelect.value = staff.status;
        statusSelect.disabled = !!staff.is_owner;

        // Scope
        const isAll = (staff.facility_scope === 'all');
        document.getElementById('edit-scope-all').checked = isAll;
        document.getElementById('edit-scope-custom').checked = !isAll;
        toggleEditFacilitySelection(isAll ? 'all' : 'custom');

        // Checkboxes
        const assigned = staff.assigned_facilities || [];
        document.querySelectorAll('.edit-fac-checkbox').forEach(cb => {
            cb.checked = assigned.includes(cb.value);
        });

        document.getElementById('modal-edit-staff').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('modal-edit-staff').classList.add('hidden');
    }

    /**
     * Open and populate View Staff Modal
     */
    function openViewModal(staff) {
        document.getElementById('view-initials').innerText = staff.initials || 'ST';
        document.getElementById('view-name').innerText = staff.name;
        document.getElementById('view-email').innerText = staff.email;
        document.getElementById('view-phone').innerText = staff.phone || 'No phone provided';
        document.getElementById('view-id').innerText = staff.id;
        document.getElementById('view-created-at').innerText = staff.created_at;
        document.getElementById('view-notes').innerText = staff.notes || 'None';
        document.getElementById('view-last-active').innerText = staff.last_active_at || 'Never';

        // Owner badge
        const ownerBadge = document.getElementById('view-owner-badge');
        if (staff.is_owner) {
            ownerBadge.classList.remove('hidden');
        } else {
            ownerBadge.classList.add('hidden');
        }

        // Role
        const roleMeta = staff.role_meta || {};
        document.getElementById('view-role-label').innerText = roleMeta.label || staff.role;
        document.getElementById('view-role-desc').innerText = roleMeta.description || '';

        // Status badge
        const statusBadge = document.getElementById('view-status-badge');
        statusBadge.innerText = (staff.status || 'active').toUpperCase();
        if (staff.status === 'active') {
            statusBadge.className = 'inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200';
        } else if (staff.status === 'pending') {
            statusBadge.className = 'inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-300';
        } else {
            statusBadge.className = 'inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200';
        }

        // Facilities list
        const facContainer = document.getElementById('view-facilities-list');
        facContainer.innerHTML = '';
        if (staff.is_all_facilities) {
            facContainer.innerHTML = '<span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">All Authorized Facilities (Unrestricted)</span>';
        } else {
            (staff.facility_badges || []).forEach(bName => {
                const span = document.createElement('span');
                span.className = 'px-2 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200';
                span.innerText = bName;
                facContainer.appendChild(span);
            });
        }

        document.getElementById('modal-view-staff').classList.remove('hidden');
    }
    function closeViewModal() {
        document.getElementById('modal-view-staff').classList.add('hidden');
    }

    /**
     * Toggle Status Confirmation Modal
     */
    function openToggleModal(id, name, targetStatus) {
        document.getElementById('toggle-status-form').action = '/vendor/staff/' + id + '/status';
        document.getElementById('toggle-target-status').value = targetStatus;
        
        const titleEl = document.getElementById('toggle-modal-title');
        const descEl = document.getElementById('toggle-modal-desc');
        const btnEl = document.getElementById('toggle-confirm-btn');

        if (targetStatus === 'suspended') {
            titleEl.innerText = 'Suspend Staff Access';
            descEl.innerHTML = 'Are you sure you want to temporarily suspend access for <strong class="text-slate-900">' + name + '</strong>? They will be locked out of the vendor portal until reactivated.';
            btnEl.innerText = 'Suspend Access';
            btnEl.className = 'px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold cursor-pointer shadow-xs';
        } else {
            titleEl.innerText = 'Reactivate Staff Access';
            descEl.innerHTML = 'Reactivate operational credentials for <strong class="text-slate-900">' + name + '</strong>? This will restore their facility permissions immediately.';
            btnEl.innerText = 'Reactivate Access';
            btnEl.className = 'px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold cursor-pointer shadow-xs';
        }

        document.getElementById('modal-toggle-status').classList.remove('hidden');
    }
    function closeToggleModal() {
        document.getElementById('modal-toggle-status').classList.add('hidden');
    }

    /**
     * Delete / Revoke Access Confirmation Modal
     */
    function openDeleteModal(id, name, email) {
        document.getElementById('delete-staff-form').action = '/vendor/staff/' + id;
        document.getElementById('delete-staff-name').innerText = name;
        document.getElementById('delete-staff-email').innerText = email;
        document.getElementById('modal-delete-staff').classList.remove('hidden');
    }
    function closeDeleteModal() {
        document.getElementById('modal-delete-staff').classList.add('hidden');
    }
</script>
@endpush

</x-layouts.vendor>
