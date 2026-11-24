<x-layouts.admin activeNav="users" title="User Management — Super Admin NusaPark">

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
                <span class="font-semibold text-slate-700">User Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>Platform RBAC & Identity Governance</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Last Access Audit: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        User Management
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-xs font-mono">
                        {{ $pagination['total'] }} {{ Str::plural('account', $pagination['total']) }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    Centrally inspect, verify, and administer user identities, roles, tenant memberships, and authentication states across the national parking platform.
                </p>
            </div>

            <!-- Header Action Buttons -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.users.export', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                </a>

                <button type="button" 
                        onclick="openCreateUserModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Provision User</span>
                </button>
            </div>
        </div>

    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- Metric 1: Total Registered Accounts -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Registered Users</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ number_format($summary['total_users']) }}</span>
                    <span class="text-xs font-semibold text-slate-500">accounts</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-slate-700">{{ $summary['super_admin_count'] }}</strong> Admins • <strong class="text-slate-700">{{ $summary['vendor_staff_count'] }}</strong> Operators • <strong class="text-slate-700">{{ $summary['drivers_count'] }}</strong> Drivers
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
        </div>

        <!-- Metric 2: Active Operational Accounts -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Active Authorized</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-emerald-700 font-mono tracking-tight">{{ number_format($summary['active_users']) }}</span>
                    <span class="text-xs font-semibold text-emerald-600">active</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Full platform login & credential rights
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
        </div>

        <!-- Metric 3: Pending Verification -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Pending Verification</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-amber-700 font-mono tracking-tight">{{ number_format($summary['pending_users']) }}</span>
                    <span class="text-xs font-semibold text-amber-600">invitations</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Awaiting user confirmation or KYC
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
        </div>

        <!-- Metric 4: Security & 2FA Enforcement -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Security & 2FA Enforced</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $summary['mfa_enabled_count'] }}</span>
                    <span class="text-xs font-semibold text-slate-500">MFA active</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-rose-600">{{ $summary['suspended_users'] }}</strong> suspended accounts restricted
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </div>
        </div>

    </div>

    <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.users') }}" class="space-y-3">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
                
                <!-- Text Search -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Search Accounts</label>
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search user name, email, ID, organization..."
                               class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <span class="absolute left-3 top-2.5 text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </div>
                </div>

                <!-- Account Type Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Account Category</label>
                    <select name="account_type" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($accountTypes as $val => $label)
                            <option value="{{ $val }}" {{ $filters['account_type'] === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Role Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Assigned Role</label>
                    <select name="role" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($roles as $val => $label)
                            <option value="{{ $val }}" {{ $filters['role'] === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Account Status Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($statuses as $val => $label)
                            <option value="{{ $val }}" {{ $filters['status'] === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Secondary Filter Row -->
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-12 gap-3 pt-2 border-t border-slate-100">
                
                <!-- Organization / Tenant Filter -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Organization / Tenant</label>
                    <select name="vendor" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Organizations</option>
                        <option value="platform" {{ $filters['vendor'] === 'platform' ? 'selected' : '' }}>Platform Head Office (NusaPark Internal)</option>
                        <option value="none" {{ $filters['vendor'] === 'none' ? 'selected' : '' }}>None / Public Motorists</option>
                        <optgroup label="Tenant Operators">
                            @foreach($tenants as $t)
                                <option value="{{ $t['id'] }}" {{ $filters['vendor'] === $t['id'] ? 'selected' : '' }}>
                                    {{ $t['company_name'] }} ({{ $t['id'] }})
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>

                <!-- Email Verification Filter -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Email Verification</label>
                    <select name="verification" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all" {{ $filters['verification'] === 'all' ? 'selected' : '' }}>All Verification States</option>
                        <option value="verified" {{ $filters['verification'] === 'verified' ? 'selected' : '' }}>Verified Accounts Only</option>
                        <option value="unverified" {{ $filters['verification'] === 'unverified' ? 'selected' : '' }}>Unverified / Pending Email OTP</option>
                    </select>
                </div>

                <!-- Sorting & Actions -->
                <div class="lg:col-span-4 flex items-end gap-2">
                    <div class="flex-1">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Sort Order</label>
                        <select name="sort" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Full Name (A &rarr; Z)</option>
                            <option value="name_desc" {{ $filters['sort'] === 'name_desc' ? 'selected' : '' }}>Full Name (Z &rarr; A)</option>
                            <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Registration Date (Newest)</option>
                            <option value="date_asc" {{ $filters['sort'] === 'date_asc' ? 'selected' : '' }}>Registration Date (Oldest)</option>
                            <option value="type_asc" {{ $filters['sort'] === 'type_asc' ? 'selected' : '' }}>Account Category</option>
                            <option value="last_login_desc" {{ $filters['sort'] === 'last_login_desc' ? 'selected' : '' }}>Last Active Timestamp</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-2xs shrink-0">
                        Filter
                    </button>

                    <a href="{{ route('admin.users') }}" 
                       class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-semibold transition-colors shrink-0"
                       title="Reset all filters">
                        Reset
                    </a>
                </div>

            </div>

        </form>
    </div>

    <!-- ================= USER REGISTRY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">User & Account ID</th>
                        <th class="py-3 px-4">Email & Verification</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Organization / Tenant</th>
                        <th class="py-3 px-4">Assigned Role</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Last Active</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $u)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        
                        <!-- Col 1: Identity & Avatar -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs shrink-0 
                                    {{ $u['account_type'] === 'Super Admin' ? 'bg-indigo-100 text-indigo-700' : ($u['account_type'] === 'Vendor Staff' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ strtoupper(substr($u['name'], 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm leading-tight">
                                        {{ $u['name'] }}
                                    </div>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <span class="font-mono text-[10px] text-slate-400">
                                            {{ $u['id'] }}
                                        </span>
                                        <span class="text-slate-300">•</span>
                                        <span class="text-[10px] text-slate-500 font-mono">
                                            {{ $u['phone'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Col 2: Email & Verification -->
                        <td class="py-3.5 px-4">
                            <div class="font-mono font-medium text-slate-700">{{ $u['email'] }}</div>
                            <div class="flex items-center gap-1.5 mt-1">
                                @if($u['email_verified'])
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 px-1.5 py-0.2 rounded">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <span>Verified</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-100 px-1.5 py-0.2 rounded">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        <span>Pending OTP</span>
                                    </span>
                                @endif

                                @if($u['two_factor_enabled'])
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 px-1.5 py-0.2 rounded" title="Two-factor authentication active">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        <span>2FA</span>
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Col 3: Account Category -->
                        <td class="py-3.5 px-4">
                            @if($u['account_type'] === 'Super Admin')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    <span>Super Admin</span>
                                </span>
                            @elseif($u['account_type'] === 'Vendor Staff')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    <span>Vendor Operator</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Driver Motorist</span>
                                </span>
                            @endif
                        </td>

                        <!-- Col 4: Organization / Tenant (Page 39 Connection) -->
                        <td class="py-3.5 px-4">
                            @if(str_starts_with($u['vendor_id'], 'vdr-'))
                                <a href="/admin/tenants?detail={{ $u['vendor_id'] }}" 
                                   class="font-semibold text-indigo-600 hover:text-indigo-800 hover:underline block truncate max-w-[180px]"
                                   title="Inspect tenant {{ $u['vendor_name'] }} on Page 39">
                                    {{ $u['vendor_name'] }}
                                </a>
                                <span class="font-mono text-[10px] text-slate-400">{{ $u['vendor_id'] }}</span>
                            @elseif($u['vendor_id'] === 'platform')
                                <span class="font-medium text-slate-800 block truncate max-w-[180px]">NusaPark Platform</span>
                                <span class="text-[10px] text-slate-400">Head Office Internal</span>
                            @else
                                <span class="font-medium text-slate-600 block truncate max-w-[180px]">{{ $u['vendor_name'] }}</span>
                                <span class="text-[10px] text-slate-400">Public Driver App</span>
                            @endif
                        </td>

                        <!-- Col 5: Assigned Role -->
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-slate-800 text-[11px] block">{{ $u['role'] }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">Created {{ $u['created_at'] }}</span>
                        </td>

                        <!-- Col 6: Account Status -->
                        <td class="py-3.5 px-4">
                            @if($u['status'] === 'Active')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Active</span>
                                </span>
                            @elseif($u['status'] === 'Pending Verification')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>Pending</span>
                                </span>
                            @elseif($u['status'] === 'Suspended')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Suspended</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>{{ $u['status'] }}</span>
                                </span>
                            @endif
                            <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[130px]" title="{{ $u['status_note'] }}">
                                {{ $u['status_note'] }}
                            </div>
                        </td>

                        <!-- Col 7: Last Active Telemetry -->
                        <td class="py-3.5 px-4">
                            <div class="font-medium text-slate-700">{{ $u['last_login_at'] }}</div>
                            <div class="font-mono text-[10px] text-slate-400">{{ $u['last_login_ip'] }}</div>
                        </td>

                        <!-- Col 8: Actions -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                
                                <!-- Inspect Drawer Action -->
                                <button type="button" 
                                        onclick="inspectUser('{{ $u['id'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                        title="Inspect Account Details">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Edit Modal Action -->
                                <button type="button" 
                                        onclick="openEditUserModal('{{ $u['id'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Edit User Profile & Role">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>

                                <!-- Change Status Action -->
                                <button type="button" 
                                        onclick="openStatusModal('{{ $u['id'] }}', '{{ addslashes($u['name']) }}', '{{ $u['status'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                        title="Change Account Status">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                                </button>

                                <!-- Password Reset Trigger -->
                                <button type="button" 
                                        onclick="openResetPasswordModal('{{ $u['id'] }}', '{{ addslashes($u['name']) }}', '{{ $u['email'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                        title="Dispatch Password Reset">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-500">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                            </div>
                            <p class="font-bold text-slate-800 text-sm">No Platform Accounts Found</p>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                No registered user accounts match your current query or filter criteria. Try adjusting your search term or clearing the active filters.
                            </p>
                            <a href="{{ route('admin.users') }}" class="inline-block mt-3 px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg font-bold text-xs">
                                Clear All Filters
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= PAGINATION BAR ================= -->
        <div class="px-4 py-3 bg-slate-50/70 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="text-slate-500 text-[11px]">
                Showing <strong class="text-slate-800">{{ $pagination['from'] }}</strong> to 
                <strong class="text-slate-800">{{ $pagination['to'] }}</strong> of 
                <strong class="text-slate-800">{{ $pagination['total'] }}</strong> platform accounts
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-1.5">
                <!-- Previous Button -->
                @if($pagination['current_page'] > 1)
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
                       class="px-2.5 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium">
                        &larr; Prev
                    </a>
                @else
                    <span class="px-2.5 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-slate-400 cursor-not-allowed">
                        &larr; Prev
                    </span>
                @endif

                <!-- Page Indicator -->
                <span class="px-3 py-1.5 font-mono text-[11px] font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg">
                    Page {{ $pagination['current_page'] }} / {{ $pagination['last_page'] }}
                </span>

                <!-- Next Button -->
                @if($pagination['current_page'] < $pagination['last_page'])
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
                       class="px-2.5 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium">
                        Next &rarr;
                    </a>
                @else
                    <span class="px-2.5 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-slate-400 cursor-not-allowed">
                        Next &rarr;
                    </span>
                @endif
            </div>
            @endif
        </div>

    </div>

    <!-- ================= DETAIL INSPECTION DRAWER ================= -->
    <div id="userDetailDrawer" class="fixed inset-0 z-50 overflow-hidden {{ $selectedUser ? '' : 'hidden' }}">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-2xs transition-opacity" onclick="closeDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 flex items-start justify-between bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div id="detailAvatar" class="w-11 h-11 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm flex items-center justify-center shrink-0">
                            {{ $selectedUser ? strtoupper(substr($selectedUser['name'], 0, 2)) : 'US' }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span id="detailUserId" class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-200 text-slate-800">
                                    {{ $selectedUser['id'] ?? 'USR-ID' }}
                                </span>
                                <span id="detailUserStatus" class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $selectedUser['status'] ?? 'Active' }}
                                </span>
                            </div>
                            <h2 id="detailUserName" class="text-lg font-bold text-slate-900 mt-1">
                                {{ $selectedUser['name'] ?? 'User Details' }}
                            </h2>
                            <p id="detailUserRole" class="text-xs text-indigo-600 font-semibold mt-0.5">
                                {{ $selectedUser['role'] ?? 'Platform Role' }}
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="closeDetailDrawer()" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Scrollable Body -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5 text-xs">
                    
                    <!-- Section 1: Organization & Access Scope -->
                    <div class="bg-indigo-50/60 p-4 rounded-xl border border-indigo-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 mb-1">Organization & Access Context</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 id="detailOrgName" class="text-sm font-bold text-slate-900">
                                    {{ $selectedUser['vendor_name'] ?? 'Organization' }}
                                </h3>
                                <p class="text-[11px] text-slate-600 font-mono mt-0.5">
                                    Scope: <span id="detailOrgScope" class="font-sans font-semibold text-indigo-600">{{ $selectedUser['account_type'] ?? 'Platform Staff' }}</span>
                                </p>
                            </div>
                            <a id="detailOrgLink" 
                               href="/admin/tenants" 
                               class="px-2.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold text-[11px] transition-colors shadow-2xs">
                                View Tenant &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Section 2: Contact Information -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Contact & Identity Details
                        </h4>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="text-slate-400 block text-[11px]">Email Address:</span>
                                <span id="detailEmail" class="font-mono font-medium text-slate-800 text-xs">
                                    {{ $selectedUser['email'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Phone Number:</span>
                                <span id="detailPhone" class="font-mono font-medium text-slate-800 text-xs">
                                    {{ $selectedUser['phone'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Email Verification:</span>
                                <span id="detailVerification" class="font-semibold text-emerald-600">
                                    {{ ($selectedUser['email_verified'] ?? false) ? 'Verified' : 'Pending OTP' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">2-Factor Authentication:</span>
                                <span id="detailMfa" class="font-semibold text-indigo-600">
                                    {{ ($selectedUser['two_factor_enabled'] ?? false) ? 'Enabled' : 'Disabled' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Authentication & Security Telemetry -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Security & Session Audit
                        </h4>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Last Login Timestamp:</span>
                                <span id="detailLastLogin" class="font-medium text-slate-800">
                                    {{ $selectedUser['last_login_at'] ?? 'Never' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Last Origin IP Address:</span>
                                <span id="detailLastIp" class="font-mono font-semibold text-slate-700">
                                    {{ $selectedUser['last_login_ip'] ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Account Provisioned On:</span>
                                <span id="detailCreatedAt" class="font-mono text-slate-700">
                                    {{ $selectedUser['created_at'] ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Context Note -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Account Audit Note</span>
                            <p id="detailStatusNote" class="text-slate-600 text-[11px] leading-relaxed">
                                {{ $selectedUser['status_note'] ?? 'Full platform authentication rights authorized.' }}
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-end gap-2.5">
                    <button type="button" 
                            onclick="closeDetailDrawer()"
                            class="px-3.5 py-2 bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Close
                    </button>
                    <button type="button" 
                            onclick="triggerEditFromDrawer()"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-2xs">
                        Edit User
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= PROVISION USER MODAL ================= -->
    <div id="createUserModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-xl w-full max-h-[90vh] overflow-y-auto p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Provision Platform User</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Invite or provision an account with appropriate organizational roles.</p>
                </div>
                <button type="button" onclick="closeCreateUserModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="my-4 space-y-4 text-xs">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Full Name *</label>
                        <input type="text" name="name" required placeholder="e.g. Raditya Pratama" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="name@domain.com" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="+62 812-xxxx-xxxx" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Account Category *</label>
                        <select id="createAccountType" name="account_type" required onchange="handleAccountTypeChange(this.value)" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="Vendor Staff">Vendor / Tenant Operator</option>
                            <option value="Super Admin">Platform Super Admin</option>
                            <option value="Driver">Driver & Fleet Motorist</option>
                        </select>
                    </div>
                </div>

                <!-- Tenant Organization Selection (Shown for Vendor Staff) -->
                <div id="createTenantField">
                    <label class="block font-semibold text-slate-700 mb-1">Owning Tenant Operator *</label>
                    <select name="vendor_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="">-- Select Registered Tenant --</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t['id'] }}">
                                {{ $t['company_name'] }} ({{ $t['id'] }}) — {{ $t['tier'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Corporate Org Input (Shown for Driver) -->
                <div id="createCorporateField" class="hidden">
                    <label class="block font-semibold text-slate-700 mb-1">Corporate Fleet Organization (Optional)</label>
                    <input type="text" name="corporate_org" placeholder="e.g. PT Astra International Fleet" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Assigned Role *</label>
                        <select name="role" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($roles as $rKey => $rLabel)
                                @if($rKey !== 'all')
                                    <option value="{{ $rKey }}">{{ $rLabel }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Initial Status *</label>
                        <select name="status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="Active">🟢 Active (Immediate Access)</option>
                            <option value="Pending Verification">🟡 Pending Verification (Send Invitation)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeCreateUserModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Provision Account
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= EDIT USER MODAL ================= -->
    <div id="editUserModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-xl w-full max-h-[90vh] overflow-y-auto p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Edit User Account</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Updating profile: <strong id="editModalUserId" class="font-mono text-indigo-600">usr-id</strong>
                    </p>
                </div>
                <button type="button" onclick="closeEditUserModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="editUserForm" method="POST" action="" class="my-4 space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Full Name *</label>
                        <input type="text" id="editName" name="name" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Email Address *</label>
                        <input type="email" id="editEmail" name="email" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Phone Number</label>
                        <input type="text" id="editPhone" name="phone" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Account Category *</label>
                        <select id="editAccountType" name="account_type" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="Super Admin">Platform Super Admin</option>
                            <option value="Vendor Staff">Vendor / Tenant Operator</option>
                            <option value="Driver">Driver & Fleet Motorist</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Assigned Role *</label>
                        <select id="editRole" name="role" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($roles as $rKey => $rLabel)
                                @if($rKey !== 'all')
                                    <option value="{{ $rKey }}">{{ $rLabel }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Organization / Tenant</label>
                        <select id="editVendorId" name="vendor_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="platform">Platform Head Office (NusaPark Internal)</option>
                            <option value="none">None / Public Consumer</option>
                            @foreach($tenants as $t)
                                <option value="{{ $t['id'] }}">
                                    {{ $t['company_name'] }} ({{ $t['id'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeEditUserModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
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
    <div id="statusModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Change Account Status</h3>
                    <p id="statusModalUserName" class="text-xs text-slate-500 mt-0.5">User Name</p>
                </div>
                <button type="button" onclick="closeStatusModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="statusForm" method="POST" action="" class="my-4 space-y-3.5 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">New Account Status *</label>
                    <select id="statusSelect" name="status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="Active">🟢 Active (Full Platform Access)</option>
                        <option value="Pending Verification">🟡 Pending Verification (Pending Confirmation)</option>
                        <option value="Suspended">🔴 Suspended (Immediate Session Invalidation)</option>
                        <option value="Inactive">⚪ Inactive (De-provisioned Account)</option>
                    </select>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-slate-600 text-[11px] leading-relaxed">
                    <strong>Administrative Consequence:</strong>
                    <ul class="list-disc pl-4 mt-1 space-y-0.5 text-slate-500">
                        <li><strong>Active:</strong> Restores full portal login, API credentials, and role authorizations.</li>
                        <li><strong>Suspended:</strong> Immediately revokes active bearer tokens and forces session logout.</li>
                        <li><strong>Inactive:</strong> Deactivates staff access while retaining historical audit logs.</li>
                    </ul>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Administrative Audit Note / Reason</label>
                    <textarea name="reason" rows="2" placeholder="e.g. Account suspended due to security compliance investigation..." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600"></textarea>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Confirm Transition
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= RESET PASSWORD MODAL ================= -->
    <div id="resetPasswordModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Dispatch Password Reset</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Trigger a secure, cryptographically signed password reset link.</p>
                </div>
                <button type="button" onclick="closeResetPasswordModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="resetPasswordForm" method="POST" action="" class="my-4 space-y-4 text-xs">
                @csrf

                <div class="p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 block mb-0.5">Destination Account</span>
                    <p id="resetModalUserName" class="font-bold text-slate-900 text-sm">Full Name</p>
                    <p id="resetModalUserEmail" class="font-mono text-slate-600 text-xs mt-0.5">email@domain.com</p>
                </div>

                <div class="text-[11px] text-slate-500 leading-relaxed">
                    <strong>Security Notice:</strong> NusaPark never displays or stores cleartext passwords. Clicking <em>Dispatch Reset Link</em> will send an encrypted one-time reset token directly to the user's verified email address with a 60-minute expiry window.
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeResetPasswordModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Dispatch Reset Link
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= CLIENT JAVASCRIPT LOGIC ================= -->
    @push('scripts')
    <script>
        const allUsersJson = @json($users);

        function inspectUser(id) {
            const user = allUsersJson.find(u => u.id === id);
            if (!user) return;

            document.getElementById('detailUserId').textContent = user.id;
            document.getElementById('detailUserName').textContent = user.name;
            document.getElementById('detailUserRole').textContent = user.role;
            document.getElementById('detailUserStatus').textContent = user.status;
            document.getElementById('detailAvatar').textContent = user.name.substring(0, 2).toUpperCase();

            // Org & Scope
            document.getElementById('detailOrgName').textContent = user.vendor_name;
            document.getElementById('detailOrgScope').textContent = user.account_type;

            if (user.vendor_id && user.vendor_id.startsWith('vdr-')) {
                document.getElementById('detailOrgLink').href = `/admin/tenants?detail=${user.vendor_id}`;
                document.getElementById('detailOrgLink').classList.remove('hidden');
            } else {
                document.getElementById('detailOrgLink').classList.add('hidden');
            }

            // Contact
            document.getElementById('detailEmail').textContent = user.email;
            document.getElementById('detailPhone').textContent = user.phone || '-';
            document.getElementById('detailVerification').textContent = user.email_verified ? 'Verified' : 'Pending OTP';
            document.getElementById('detailMfa').textContent = user.two_factor_enabled ? 'Enabled' : 'Disabled';

            // Security telemetry
            document.getElementById('detailLastLogin').textContent = user.last_login_at || 'Never';
            document.getElementById('detailLastIp').textContent = user.last_login_ip || '-';
            document.getElementById('detailCreatedAt').textContent = user.created_at || '-';
            document.getElementById('detailStatusNote').textContent = user.status_note || 'Full platform authentication rights authorized.';

            // Open Drawer
            document.getElementById('userDetailDrawer').classList.remove('hidden');
        }

        function closeDetailDrawer() {
            document.getElementById('userDetailDrawer').classList.add('hidden');
        }

        function triggerEditFromDrawer() {
            const id = document.getElementById('detailUserId').textContent;
            closeDetailDrawer();
            openEditUserModal(id);
        }

        function openCreateUserModal() {
            document.getElementById('createUserModal').classList.remove('hidden');
        }

        function closeCreateUserModal() {
            document.getElementById('createUserModal').classList.add('hidden');
        }

        function handleAccountTypeChange(type) {
            const tenantField = document.getElementById('createTenantField');
            const corporateField = document.getElementById('createCorporateField');

            if (type === 'Vendor Staff') {
                tenantField.classList.remove('hidden');
                corporateField.classList.add('hidden');
            } else if (type === 'Driver') {
                tenantField.classList.add('hidden');
                corporateField.classList.remove('hidden');
            } else {
                tenantField.classList.add('hidden');
                corporateField.classList.add('hidden');
            }
        }

        function openEditUserModal(id) {
            const user = allUsersJson.find(u => u.id === id);
            if (!user) return;

            document.getElementById('editModalUserId').textContent = `${user.name} (${user.id})`;
            document.getElementById('editUserForm').action = `/admin/users/${user.id}`;
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editPhone').value = user.phone || '';
            document.getElementById('editAccountType').value = user.account_type;
            document.getElementById('editRole').value = user.role;
            document.getElementById('editVendorId').value = user.vendor_id || 'none';

            document.getElementById('editUserModal').classList.remove('hidden');
        }

        function closeEditUserModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }

        function openStatusModal(id, name, currentStatus) {
            document.getElementById('statusModalUserName').textContent = `${name} (${id})`;
            document.getElementById('statusForm').action = `/admin/users/${id}/status`;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function openResetPasswordModal(id, name, email) {
            document.getElementById('resetModalUserName').textContent = `${name} (${id})`;
            document.getElementById('resetModalUserEmail').textContent = email;
            document.getElementById('resetPasswordForm').action = `/admin/users/${id}/reset-password`;
            document.getElementById('resetPasswordModal').classList.remove('hidden');
        }

        function closeResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.add('hidden');
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailDrawer();
                closeCreateUserModal();
                closeEditUserModal();
                closeStatusModal();
                closeResetPasswordModal();
            }
        });
    </script>
    @endpush

</x-layouts.admin>
