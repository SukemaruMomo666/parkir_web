<x-layouts.admin activeNav="subscriptions" title="Subscription Management — Super Admin NusaPark">

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
                <span class="font-semibold text-slate-700">Subscription Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>Platform Fleet Subscriptions & Plan Catalog</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Audit Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Subscription Management
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 45
                    </span>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">
                        {{ $globalSummary['total_subscriptions'] }} Tenant Subscriptions
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Supervise multi-tenant SaaS subscriptions, manage canonical tier entitlements, and oversee tenant billing lifecycles across the platform.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.subscriptions', request()->query()) }}" 
                   title="Refresh telemetry"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                    </svg>
                    <span class="hidden sm:inline">Refresh</span>
                </a>

                <!-- Export CSV -->
                <a href="{{ route('admin.subscriptions.export', request()->query()) }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Export CSV</span>
                </a>
            </div>
        </div>

        <!-- Section Navigation Tabs -->
        <div class="border-b border-slate-200 flex items-center justify-between gap-4">
            <nav class="flex gap-2" aria-label="Subscription Navigation Tabs">
                <a href="{{ route('admin.subscriptions', array_merge(request()->except('tab'), ['tab' => 'subscriptions'])) }}" 
                   class="inline-flex items-center gap-2 py-3 px-4 border-b-2 font-bold text-xs sm:text-sm transition-colors {{ $activeTab === 'subscriptions' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Subscriptions Inventory</span>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $activeTab === 'subscriptions' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $summary['total_subscriptions'] }}
                    </span>
                </a>

                <a href="{{ route('admin.subscriptions', array_merge(request()->except('tab'), ['tab' => 'plans'])) }}" 
                   class="inline-flex items-center gap-2 py-3 px-4 border-b-2 font-bold text-xs sm:text-sm transition-colors {{ $activeTab === 'plans' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span>Plan Catalog & Entitlements</span>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $activeTab === 'plans' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ count($plans) }} Tiers
                    </span>
                </a>
            </nav>

            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Active Fleets Synchronized</span>
            </div>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS BANNER ================= -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
        
        <!-- Total Subscriptions -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Total Subscriptions</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 font-mono tracking-tight">
                {{ $summary['total_subscriptions'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                Across 18 registered operators
            </div>
        </div>

        <!-- Active Subscriptions -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Active Fleet</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-emerald-600 font-mono tracking-tight">
                {{ $summary['active_subscriptions'] }}
            </div>
            <div class="text-[11px] text-emerald-700 font-medium mt-1">
                {{ $summary['active_rate'] }}% healthy operational rate
            </div>
        </div>

        <!-- Trialing Subscriptions -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Trial Subscriptions</span>
                <span class="w-2 h-2 rounded-full bg-sky-500"></span>
            </div>
            <div class="text-2xl font-extrabold text-sky-600 font-mono tracking-tight">
                {{ $summary['trialing_subscriptions'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                14-day proof of concepts
            </div>
        </div>

        <!-- Past Due / Grace Period -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Past Due / In Grace</span>
                <span class="w-2 h-2 rounded-full {{ $summary['past_due_subscriptions'] > 0 ? 'bg-amber-500 animate-pulse' : 'bg-slate-300' }}"></span>
            </div>
            <div class="text-2xl font-extrabold {{ $summary['past_due_subscriptions'] > 0 ? 'text-amber-600' : 'text-slate-900' }} font-mono tracking-tight">
                {{ $summary['past_due_subscriptions'] }}
            </div>
            <div class="text-[11px] text-amber-700 font-medium mt-1">
                {{ $summary['past_due_subscriptions'] > 0 ? '7-day operational grace active' : 'Zero overdue invoices' }}
            </div>
        </div>

        <!-- Total MRR -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs col-span-2 sm:col-span-1">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Platform SaaS MRR</span>
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-purple-700 font-mono tracking-tight">
                {{ $summary['formatted_total_mrr'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">
                ARR: {{ $summary['formatted_total_arr'] }}
            </div>
        </div>

    </div>

    @if($activeTab === 'subscriptions')
    <!-- ========================================================================= -->
    <!-- TAB 1: SUBSCRIPTIONS INVENTORY                                            -->
    <!-- ========================================================================= -->

    <!-- Filters & Search Toolbar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.subscriptions') }}" class="space-y-3">
            <input type="hidden" name="tab" value="subscriptions">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <!-- Search Query -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Search Subscriptions
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search tenant name, code, contact, city..."
                               class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                    </div>
                </div>

                <!-- Plan Tier Filter -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Subscription Plan
                    </label>
                    <select name="plan" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        <option value="all" {{ $filters['plan'] === 'all' ? 'selected' : '' }}>All Plans</option>
                        @foreach($plans as $p)
                        <option value="{{ $p['slug'] }}" {{ $filters['plan'] === $p['slug'] ? 'selected' : '' }}>
                            {{ $p['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Lifecycle Status
                    </label>
                    <select name="status" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        @foreach($statuses as $k => $label)
                        <option value="{{ $k }}" {{ $filters['status'] === $k ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Billing Interval Filter -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Billing Interval
                    </label>
                    <select name="interval" 
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                        <option value="all" {{ $filters['interval'] === 'all' ? 'selected' : '' }}>All Intervals</option>
                        <option value="monthly" {{ $filters['interval'] === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="annual" {{ $filters['interval'] === 'annual' ? 'selected' : '' }}>Annual (Discounted)</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between gap-3 pt-2 border-t border-slate-100 flex-wrap">
                <!-- Sorting Selector -->
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-500 font-medium">Sort by:</span>
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="px-2.5 py-1 text-xs rounded-lg border border-slate-200 bg-white font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                        <option value="mrr_desc" {{ $filters['sort'] === 'mrr_desc' ? 'selected' : '' }}>Highest MRR</option>
                        <option value="mrr_asc" {{ $filters['sort'] === 'mrr_asc' ? 'selected' : '' }}>Lowest MRR</option>
                        <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Tenant Name (A-Z)</option>
                        <option value="renewal_asc" {{ $filters['sort'] === 'renewal_asc' ? 'selected' : '' }}>Next Renewal Date</option>
                        <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Newest Subscribed</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.subscriptions', ['tab' => 'subscriptions']) }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold transition-colors">
                        Reset Filters
                    </a>
                    <button type="submit" 
                            class="px-4 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs shadow-indigo-600/20">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Subscriptions Inventory Table -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4">Tenant / Operator</th>
                        <th class="py-3.5 px-3">Plan Tier</th>
                        <th class="py-3.5 px-3">MRR & Interval</th>
                        <th class="py-3.5 px-3">Entitlements & Utilization</th>
                        <th class="py-3.5 px-3">Lifecycle Status</th>
                        <th class="py-3.5 px-3">Renewal / Period End</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($subscriptions as $sub)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <!-- Tenant info -->
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-slate-900 flex items-center gap-2">
                                <span>{{ $sub['vendor_name'] }}</span>
                            </div>
                            <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                                <span class="font-mono text-slate-400">{{ $sub['subscription_code'] }}</span>
                                <span>•</span>
                                <span>{{ $sub['city'] }}, {{ $sub['province'] }}</span>
                            </div>
                        </td>

                        <!-- Plan Tier -->
                        <td class="py-3.5 px-3">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold font-mono
                                {{ $sub['plan_slug'] === 'enterprise' ? 'bg-purple-50 text-purple-700 border border-purple-200' : '' }}
                                {{ $sub['plan_slug'] === 'growth' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                {{ $sub['plan_slug'] === 'standard' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                {{ $sub['plan_slug'] === 'starter' ? 'bg-slate-100 text-slate-700 border border-slate-200' : '' }}">
                                {{ $sub['plan_name'] }}
                            </span>
                        </td>

                        <!-- MRR & Interval -->
                        <td class="py-3.5 px-3">
                            <div class="font-extrabold text-slate-900 font-mono">
                                {{ $sub['formatted_mrr'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 capitalize">
                                {{ $sub['billing_interval'] }} cycle
                            </div>
                        </td>

                        <!-- Entitlements & Usage -->
                        <td class="py-3.5 px-3">
                            <div class="space-y-1 max-w-[200px]">
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="text-slate-500">Bays:</span>
                                    <span class="font-semibold text-slate-700 font-mono">
                                        {{ number_format($sub['usage']['bays'] ?? 0) }} / {{ number_format($sub['limits']['max_bays'] ?? 0) }}
                                    </span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full rounded-full {{ ($sub['usage']['bays_pct'] ?? 0) > 90 ? 'bg-amber-500' : 'bg-indigo-600' }}"
                                         style="width: {{ $sub['usage']['bays_pct'] ?? 0 }}%"></div>
                                </div>
                                <div class="flex items-center justify-between text-[10px] text-slate-400">
                                    <span>{{ $sub['usage']['facilities'] ?? 0 }} of {{ $sub['limits']['max_facilities'] ?? 0 }} facilities</span>
                                    <span class="font-mono">{{ $sub['usage']['bays_pct'] ?? 0 }}%</span>
                                </div>
                            </div>
                        </td>

                        <!-- Lifecycle Status -->
                        <td class="py-3.5 px-3">
                            @if($sub['status'] === 'active')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Active</span>
                            </span>
                            @elseif($sub['status'] === 'trialing')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                                <span>Trial ({{ $sub['trial_days_remaining'] ?? 0 }}d left)</span>
                            </span>
                            @elseif($sub['status'] === 'past_due')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Past Due (Grace)</span>
                            </span>
                            @elseif($sub['status'] === 'suspended')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                <span>Suspended</span>
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                <span>{{ ucfirst($sub['status']) }}</span>
                            </span>
                            @endif

                            @if(!empty($sub['notes']))
                            <div class="text-[10px] text-slate-400 mt-1 max-w-[160px] truncate" title="{{ $sub['notes'] }}">
                                {{ $sub['notes'] }}
                            </div>
                            @endif
                        </td>

                        <!-- Renewal / Period End -->
                        <td class="py-3.5 px-3">
                            <div class="font-semibold text-slate-800 font-mono text-[11px]">
                                {{ $sub['next_renewal_date'] }}
                            </div>
                            <div class="text-[10px] flex items-center gap-1 mt-0.5 {{ $sub['auto_renew'] ? 'text-emerald-600' : 'text-slate-400' }}">
                                @if($sub['auto_renew'])
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                                <span>Auto-Renew ON</span>
                                @else
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                <span>Auto-Renew OFF</span>
                                @endif
                            </div>
                        </td>

                        <!-- Administrative Actions -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- Inspect Drawer Button -->
                                <button type="button" 
                                        onclick="openSubscriptionDrawer('{{ $sub['id'] }}')"
                                        title="View Subscription Details & Timeline"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-indigo-50 hover:border-indigo-200 text-slate-600 hover:text-indigo-600 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Change Plan Trigger -->
                                <button type="button" 
                                        onclick="openChangePlanModal('{{ $sub['id'] }}', '{{ $sub['vendor_name'] }}', '{{ $sub['plan_slug'] }}', '{{ $sub['billing_interval'] }}')"
                                        title="Change Subscription Plan"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>
                                </button>

                                <!-- Status / Safe Action Dropdown Trigger -->
                                <button type="button" 
                                        onclick="openStatusModal('{{ $sub['id'] }}', '{{ $sub['vendor_name'] }}', '{{ $sub['status'] }}')"
                                        title="Transition Lifecycle Status"
                                        class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="max-w-md mx-auto">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">No Subscriptions Found</h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    No tenant subscriptions match your current filter parameters. Try clearing your search query or resetting filters.
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('admin.subscriptions', ['tab' => 'subscriptions']) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
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

        <!-- Pagination Controls -->
        @if($pagination['total'] > 0)
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="text-slate-500">
                Showing <strong class="text-slate-800">{{ $pagination['from'] }}</strong> to <strong class="text-slate-800">{{ $pagination['to'] }}</strong> of <strong class="text-slate-800">{{ $pagination['total'] }}</strong> subscription records
            </div>

            <div class="flex items-center gap-1">
                @if($pagination['current_page'] > 1)
                <a href="{{ route('admin.subscriptions', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                    &larr; Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                    &larr; Previous
                </span>
                @endif

                <span class="px-3 py-1.5 text-slate-600 font-mono font-medium">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="{{ route('admin.subscriptions', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
                   class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors">
                    Next &rarr;
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>

    @else
    <!-- ========================================================================= -->
    <!-- TAB 2: PLAN CATALOG & ENTITLEMENTS                                        -->
    <!-- ========================================================================= -->

    <div class="space-y-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
            <div>
                <h2 class="text-base font-bold text-slate-900">Configured Subscription Plans Catalog</h2>
                <p class="text-xs text-slate-500 mt-0.5">Authoritative platform pricing tiers, hardware quotas, SLA guarantees, and feature entitlement policies.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-lg border border-indigo-200">
                    4 Standard Production Tiers Active
                </span>
            </div>
        </div>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($plans as $plan)
            <div class="bg-white rounded-2xl border {{ $plan['slug'] === 'enterprise' ? 'border-purple-200 shadow-md ring-1 ring-purple-100' : 'border-slate-200 shadow-xs' }} flex flex-col justify-between p-5 relative overflow-hidden">
                @if($plan['slug'] === 'enterprise')
                <div class="absolute top-0 right-0 bg-purple-600 text-white text-[9px] font-bold uppercase tracking-wider px-3 py-0.5 rounded-bl-lg">
                    Flagship
                </div>
                @endif

                <div>
                    <!-- Plan Header -->
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider
                            {{ $plan['slug'] === 'enterprise' ? 'text-purple-600' : '' }}
                            {{ $plan['slug'] === 'growth' ? 'text-amber-600' : '' }}
                            {{ $plan['slug'] === 'standard' ? 'text-blue-600' : '' }}
                            {{ $plan['slug'] === 'starter' ? 'text-slate-600' : '' }}">
                            {{ $plan['tier'] }}
                        </span>
                        <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                            {{ $planSubscriberCounts[$plan['slug']] ?? 0 }} Subscribers
                        </span>
                    </div>

                    <h3 class="text-lg font-extrabold text-slate-900">{{ $plan['name'] }}</h3>
                    <p class="text-xs text-slate-500 mt-1 min-h-[38px]">{{ $plan['description'] }}</p>

                    <!-- Pricing Block -->
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $plan['formatted_price_monthly'] }}</span>
                            <span class="text-xs text-slate-500">/ mo</span>
                        </div>
                        <div class="text-[11px] text-slate-400 mt-0.5">
                            Annual billing: {{ $plan['formatted_price_annual'] }} / yr (10% discount)
                        </div>
                    </div>

                    <!-- Quota Limits -->
                    <div class="mt-4 p-3 rounded-xl bg-slate-50 space-y-2 text-xs">
                        <div class="font-bold text-[10px] uppercase tracking-wider text-slate-400 mb-1">Hardware & Entitlement Quotas</div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Max Facilities</span>
                            <strong class="text-slate-800 font-mono">{{ $plan['max_facilities'] }} Sites</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Max Bay Capacity</span>
                            <strong class="text-slate-800 font-mono">{{ number_format($plan['max_bays']) }} Bays</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Max Barrier Gates</span>
                            <strong class="text-slate-800 font-mono">{{ $plan['max_gates'] }} Gates</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Operator Staff Seats</span>
                            <strong class="text-slate-800 font-mono">{{ $plan['max_staff'] }} Seats</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Platform SLA Target</span>
                            <strong class="text-emerald-700 font-mono">{{ $plan['sla_health'] }}</strong>
                        </div>
                    </div>

                    <!-- Feature Bullet Points -->
                    <div class="mt-4 space-y-1.5">
                        <div class="font-bold text-[10px] uppercase tracking-wider text-slate-400 mb-1">Included Platform Features</div>
                        @foreach($plan['features'] as $f)
                        <div class="flex items-start gap-2 text-xs text-slate-600">
                            <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>{{ $f }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Plan Config Action -->
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <button type="button" 
                            onclick="openEditPlanModal('{{ $plan['id'] }}', '{{ $plan['name'] }}', '{{ addslashes($plan['description']) }}', {{ $plan['price_monthly'] }}, {{ $plan['price_annual'] }}, {{ $plan['max_facilities'] }}, {{ $plan['max_bays'] }}, {{ $plan['max_gates'] }}, {{ $plan['max_staff'] }}, '{{ $plan['sla_health'] }}')"
                            class="w-full py-2 px-3 rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 font-bold text-xs transition-colors flex items-center justify-center gap-1.5">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        <span>Configure Tier Parameters</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- ========================================================================= -->
    <!-- SLIDE-OVER DRAWER: SUBSCRIPTION DETAILS & ENTITLEMENTS AUDIT              -->
    <!-- ========================================================================= -->
    <div id="subscriptionDrawer" 
         class="fixed inset-0 z-50 overflow-hidden hidden" 
         aria-labelledby="drawer-title" 
         role="dialog" 
         aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
             onclick="closeSubscriptionDrawer()"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 flex items-start justify-between bg-slate-50/70">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="drawer-plan-badge" class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                Enterprise
                            </span>
                            <span id="drawer-status-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        </div>
                        <h2 id="drawer-vendor-name" class="text-lg font-bold text-slate-900 mt-1">
                            Tenant Organization
                        </h2>
                        <p class="text-xs text-slate-500 font-mono" id="drawer-sub-code">
                            SUB-JKT-01-2025
                        </p>
                    </div>

                    <button type="button" 
                            onclick="closeSubscriptionDrawer()"
                            class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200/60">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 text-xs">
                    
                    <!-- Financial & Billing Summary Card -->
                    <div class="p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100 space-y-3">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-indigo-900 flex items-center justify-between">
                            <span>SaaS Commercial Terms</span>
                            <span id="drawer-billing-interval" class="capitalize font-mono text-indigo-700">Monthly</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="text-slate-500 text-[11px]">Monthly Recurring Revenue</span>
                                <div id="drawer-mrr" class="text-lg font-extrabold text-indigo-900 font-mono">Rp 0</div>
                            </div>
                            <div>
                                <span class="text-slate-500 text-[11px]">Next Renewal Date</span>
                                <div id="drawer-renewal-date" class="text-sm font-bold text-slate-800 font-mono mt-0.5">01 Nov 2026</div>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-indigo-100/70 flex items-center justify-between text-[11px] text-slate-600">
                            <span>Current Period: <strong id="drawer-period" class="font-mono">01 Oct - 31 Oct 2026</strong></span>
                            <span id="drawer-autorenew" class="font-bold text-emerald-600">Auto-Renew ON</span>
                        </div>
                    </div>

                    <!-- Resource Quota Entitlements vs Actual Usage -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">
                            Hardware & Quota Entitlements
                        </h4>
                        <div class="p-4 rounded-xl border border-slate-200 space-y-3 bg-slate-50/50">
                            <!-- Bay Capacity -->
                            <div>
                                <div class="flex items-center justify-between text-xs mb-1">
                                    <span class="text-slate-600">Bay Utilization Quota</span>
                                    <span id="drawer-bays-text" class="font-mono font-bold text-slate-800">1,400 / 10,000 Bays</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                                    <div id="drawer-bays-bar" class="h-full bg-indigo-600 rounded-full" style="width: 14%"></div>
                                </div>
                            </div>

                            <!-- Facilities -->
                            <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-200/60">
                                <div>
                                    <span class="text-slate-500 text-[11px]">Sites Deployed</span>
                                    <div id="drawer-facilities-text" class="font-bold text-slate-800 font-mono text-sm">3 / 25 Sites</div>
                                </div>
                                <div>
                                    <span class="text-slate-500 text-[11px]">Barrier Gates Connected</span>
                                    <div id="drawer-gates-text" class="font-bold text-slate-800 font-mono text-sm">6 / 32 Gates</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-200/60">
                                <div>
                                    <span class="text-slate-500 text-[11px]">Operator Staff Seats</span>
                                    <div id="drawer-staff-text" class="font-bold text-slate-800 font-mono text-sm">8 / 100 Seats</div>
                                </div>
                                <div>
                                    <span class="text-slate-500 text-[11px]">SLA Target</span>
                                    <div id="drawer-sla-text" class="font-bold text-emerald-700 font-mono text-sm">99.95%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tenant Contacts & Contract Specs -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">
                            Operator & Billing Contact
                        </h4>
                        <div class="p-3.5 rounded-xl border border-slate-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Contract Reference:</span>
                                <span id="drawer-contract-number" class="font-mono font-bold text-slate-800">NUSA-VDR-2025-0042</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Primary Contact:</span>
                                <span id="drawer-primary-contact" class="font-semibold text-slate-800">Budi Santoso</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Invoicing Email:</span>
                                <span id="drawer-billing-email" class="font-mono text-slate-800">invoicing@parkircipta.co.id</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Payment Channel:</span>
                                <span id="drawer-payment-method" class="text-slate-800">Bank Virtual Account</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Invoice Status:</span>
                                <span id="drawer-invoices-summary" class="text-slate-800 font-semibold">10 paid • 0 overdue</span>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Timeline Feed -->
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">
                            Subscription Lifecycle Timeline
                        </h4>
                        <div id="drawer-timeline" class="space-y-3 relative pl-4 border-l-2 border-slate-200">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Actions -->
                <div class="p-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between gap-2">
                    <form id="drawer-autorenew-form" method="POST" action="" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-3 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-xs transition-colors">
                            Toggle Auto-Renew
                        </button>
                    </form>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                id="drawer-btn-change-plan"
                                class="px-3 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors shadow-xs">
                            Change Plan
                        </button>
                        <button type="button" 
                                id="drawer-btn-status"
                                class="px-3 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-xs transition-colors">
                            Update Status
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 1: CHANGE SUBSCRIPTION PLAN                                         -->
    <!-- ========================================================================= -->
    <div id="changePlanModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="change-plan-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeChangePlanModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>
                        </div>
                        <div>
                            <h3 id="change-plan-title" class="text-base font-bold text-slate-900">
                                Change Subscription Plan
                            </h3>
                            <p class="text-xs text-slate-500" id="change-plan-tenant-name">
                                Updating subscription tier
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeChangePlanModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="changePlanForm" method="POST" action="">
                    @csrf
                    <div class="space-y-4 text-xs">
                        <!-- Select Plan -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Target Plan Tier *</label>
                            <select name="plan_id" 
                                    id="modal-plan-select"
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 text-xs">
                                @foreach($plans as $p)
                                <option value="{{ $p['slug'] }}">
                                    {{ $p['name'] }} — {{ $p['formatted_price_monthly'] }}/mo (Max {{ number_format($p['max_bays']) }} bays)
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Billing Interval -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Billing Interval *</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                                    <input type="radio" name="billing_interval" value="monthly" checked class="text-indigo-600">
                                    <span class="font-medium text-slate-700">Monthly</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                                    <input type="radio" name="billing_interval" value="annual" class="text-indigo-600">
                                    <span class="font-medium text-slate-700">Annual (10% Off)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Proration & Effective Notice -->
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 space-y-1">
                            <div class="font-bold text-slate-800 text-[11px] flex items-center gap-1.5">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                <span>Proration Policy Notice</span>
                            </div>
                            <p class="text-[11px] text-slate-500">
                                Upgrades take effect immediately with new hardware quota limits. Prorated difference will be reflected on the next scheduled invoice cycle.
                            </p>
                        </div>

                        <!-- Administrative Note -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Administrative Change Note (Optional)</label>
                            <input type="text" 
                                   name="notes" 
                                   placeholder="e.g., Requested upgrade for Phase 2 mall expansion"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 text-xs">
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeChangePlanModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors shadow-xs shadow-indigo-600/20">
                            Apply Plan Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 2: EXTEND TRIAL                                                     -->
    <!-- ========================================================================= -->
    <div id="extendTrialModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="extend-trial-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeExtendTrialModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-sky-50 flex items-center justify-center text-sky-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <div>
                            <h3 id="extend-trial-title" class="text-base font-bold text-slate-900">
                                Extend Subscription Trial
                            </h3>
                            <p class="text-xs text-slate-500" id="extend-trial-tenant-name">
                                Operator Proof of Concept
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeExtendTrialModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="extendTrialForm" method="POST" action="">
                    @csrf
                    <div class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Additional Extension Days *</label>
                            <select name="extra_days" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20 text-xs">
                                <option value="7">+7 Days Extension (1 Week)</option>
                                <option value="14" selected>+14 Days Extension (2 Weeks Standard)</option>
                                <option value="30">+30 Days Extension (1 Month POC)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Justification Reason *</label>
                            <textarea name="reason" 
                                      rows="3" 
                                      required
                                      placeholder="State the administrative justification (e.g., Delay in barrier hardware shipment at client site)..."
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20 text-xs"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeExtendTrialModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs transition-colors shadow-xs shadow-sky-600/20">
                            Confirm Trial Extension
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 3: TRANSITION LIFECYCLE STATUS                                      -->
    <!-- ========================================================================= -->
    <div id="statusModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="status-modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeStatusModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <div>
                            <h3 id="status-modal-title" class="text-base font-bold text-slate-900">
                                Transition Subscription Lifecycle
                            </h3>
                            <p class="text-xs text-slate-500" id="status-modal-tenant-name">
                                Administrative Status Control
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeStatusModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="statusForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Target Lifecycle State *</label>
                            <select name="status" 
                                    id="modal-status-select"
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 text-xs">
                                <option value="active">Active (Full Platform Operational Access)</option>
                                <option value="past_due">Past Due (7-Day Operational Grace Period)</option>
                                <option value="suspended">Suspended (Freeze Edge Telemetry & Reservation Gateways)</option>
                                <option value="cancelled">Cancelled (Terminated Subscription Agreement)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Reason / Audit Trail Note</label>
                            <textarea name="reason" 
                                      rows="3" 
                                      placeholder="State reason for audit compliance log..."
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 text-xs"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeStatusModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-slate-900 hover:bg-black text-white font-bold text-xs transition-colors shadow-xs">
                            Confirm Status Transition
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 4: EDIT PLAN CATALOG PARAMETERS                                     -->
    <!-- ========================================================================= -->
    <div id="editPlanModal" 
         class="fixed inset-0 z-50 overflow-y-auto hidden" 
         aria-labelledby="edit-plan-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 onclick="closeEditPlanModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 font-bold">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </div>
                        <div>
                            <h3 id="edit-plan-title" class="text-base font-bold text-slate-900">
                                Configure Plan Catalog Tier
                            </h3>
                            <p class="text-xs text-slate-500">
                                Update master pricing and resource limits
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="closeEditPlanModal()" class="text-slate-400 hover:text-slate-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="editPlanForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Plan Display Name *</label>
                            <input type="text" name="name" id="plan-input-name" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Description *</label>
                            <input type="text" name="description" id="plan-input-description" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Monthly Price (IDR) *</label>
                                <input type="number" name="price_monthly" id="plan-input-price-monthly" min="0" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Annual Price (IDR) *</label>
                                <input type="number" name="price_annual" id="plan-input-price-annual" min="0" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Max Sites Limit *</label>
                                <input type="number" name="max_facilities" id="plan-input-max-facilities" min="1" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Max Bays Limit *</label>
                                <input type="number" name="max_bays" id="plan-input-max-bays" min="1" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Max Barrier Gates *</label>
                                <input type="number" name="max_gates" id="plan-input-max-gates" min="1" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Max Staff Seats *</label>
                                <input type="number" name="max_staff" id="plan-input-max-staff" min="1" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">SLA Target *</label>
                            <input type="text" name="sla_health" id="plan-input-sla" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white font-mono text-xs">
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                onclick="closeEditPlanModal()"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs transition-colors shadow-xs shadow-purple-600/20">
                            Save Plan Parameters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Modal & Drawer State Management
        function openSubscriptionDrawer(subId) {
            const drawer = document.getElementById('subscriptionDrawer');
            if (!drawer) return;

            drawer.classList.remove('hidden');

            // Fetch asynchronous detail payload
            fetch(`/api/admin/subscriptions/${subId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success || !data.subscription) return;
                    const s = data.subscription;

                    document.getElementById('drawer-vendor-name').textContent = s.vendor_name;
                    document.getElementById('drawer-sub-code').textContent = `${s.subscription_code} • ${s.contract_number}`;
                    document.getElementById('drawer-plan-badge').textContent = s.plan_name;
                    document.getElementById('drawer-status-badge').textContent = s.status_label;
                    document.getElementById('drawer-billing-interval').textContent = s.billing_interval + ' billing';
                    document.getElementById('drawer-mrr').textContent = s.formatted_mrr;
                    document.getElementById('drawer-renewal-date').textContent = s.next_renewal_date;
                    document.getElementById('drawer-period').textContent = `${s.current_period_start} to ${s.current_period_end}`;
                    document.getElementById('drawer-autorenew').textContent = s.auto_renew ? 'Auto-Renew ON' : 'Auto-Renew OFF';
                    document.getElementById('drawer-autorenew').className = s.auto_renew ? 'font-bold text-emerald-600' : 'font-bold text-slate-400';

                    // Quotas
                    const baysPct = s.usage.bays_pct || 0;
                    document.getElementById('drawer-bays-text').textContent = `${(s.usage.bays || 0).toLocaleString()} / ${(s.limits.max_bays || 0).toLocaleString()} Bays (${baysPct}%)`;
                    document.getElementById('drawer-bays-bar').style.width = `${baysPct}%`;
                    document.getElementById('drawer-facilities-text').textContent = `${s.usage.facilities || 0} / ${s.limits.max_facilities || 0} Sites`;
                    document.getElementById('drawer-gates-text').textContent = `${s.usage.gates || 0} / ${s.limits.max_gates || 0} Gates`;
                    document.getElementById('drawer-staff-text').textContent = `${s.usage.staff || 0} / ${s.limits.max_staff || 0} Seats`;
                    document.getElementById('drawer-sla-text').textContent = s.limits.sla_health || '99.5%';

                    // Contacts & Contract
                    document.getElementById('drawer-contract-number').textContent = s.contract_number;
                    document.getElementById('drawer-primary-contact').textContent = s.primary_contact_name;
                    document.getElementById('drawer-billing-email').textContent = s.billing_email;
                    document.getElementById('drawer-payment-method').textContent = s.payment_method;
                    document.getElementById('drawer-invoices-summary').textContent = s.invoices_summary || '0 overdue';

                    // Timeline
                    const tlContainer = document.getElementById('drawer-timeline');
                    tlContainer.innerHTML = '';
                    (s.timeline || []).forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full ${item.status === 'success' ? 'bg-emerald-500' : (item.status === 'warning' ? 'bg-amber-500' : 'bg-indigo-500')} ring-4 ring-white"></span>
                            <div class="font-bold text-slate-800 text-[11px]">${item.event}</div>
                            <div class="text-[10px] text-slate-400 font-mono">${item.time}</div>
                            <div class="text-slate-600 mt-0.5 text-[11px]">${item.details}</div>
                        `;
                        tlContainer.appendChild(div);
                    });

                    // Update form actions
                    document.getElementById('drawer-autorenew-form').action = `/admin/subscriptions/${s.id}/auto-renew`;
                    document.getElementById('drawer-btn-change-plan').onclick = () => {
                        closeSubscriptionDrawer();
                        openChangePlanModal(s.id, s.vendor_name, s.plan_slug, s.billing_interval);
                    };
                    document.getElementById('drawer-btn-status').onclick = () => {
                        closeSubscriptionDrawer();
                        openStatusModal(s.id, s.vendor_name, s.status);
                    };
                })
                .catch(err => console.error("Could not fetch subscription detail:", err));
        }

        function closeSubscriptionDrawer() {
            const drawer = document.getElementById('subscriptionDrawer');
            if (drawer) drawer.classList.add('hidden');
        }

        function openChangePlanModal(subId, vendorName, currentPlanSlug, currentInterval) {
            const modal = document.getElementById('changePlanModal');
            if (!modal) return;
            document.getElementById('changePlanForm').action = `/admin/subscriptions/${subId}/plan`;
            document.getElementById('change-plan-tenant-name').textContent = `Updating subscription for ${vendorName}`;
            
            const sel = document.getElementById('modal-plan-select');
            if (sel) sel.value = currentPlanSlug;

            const radios = document.getElementsByName('billing_interval');
            radios.forEach(r => {
                r.checked = (r.value === currentInterval);
            });

            modal.classList.remove('hidden');
        }

        function closeChangePlanModal() {
            const modal = document.getElementById('changePlanModal');
            if (modal) modal.classList.add('hidden');
        }

        function openExtendTrialModal(subId, vendorName) {
            const modal = document.getElementById('extendTrialModal');
            if (!modal) return;
            document.getElementById('extendTrialForm').action = `/admin/subscriptions/${subId}/extend-trial`;
            document.getElementById('extend-trial-tenant-name').textContent = `Operator: ${vendorName}`;
            modal.classList.remove('hidden');
        }

        function closeExtendTrialModal() {
            const modal = document.getElementById('extendTrialModal');
            if (modal) modal.classList.add('hidden');
        }

        function openStatusModal(subId, vendorName, currentStatus) {
            const modal = document.getElementById('statusModal');
            if (!modal) return;
            document.getElementById('statusForm').action = `/admin/subscriptions/${subId}/status`;
            document.getElementById('status-modal-tenant-name').textContent = `Target Organization: ${vendorName}`;
            
            const sel = document.getElementById('modal-status-select');
            if (sel) sel.value = currentStatus;

            modal.classList.remove('hidden');
        }

        function closeStatusModal() {
            const modal = document.getElementById('statusModal');
            if (modal) modal.classList.add('hidden');
        }

        function openEditPlanModal(planId, name, description, priceMonthly, priceAnnual, maxFac, maxBays, maxGates, maxStaff, sla) {
            const modal = document.getElementById('editPlanModal');
            if (!modal) return;
            document.getElementById('editPlanForm').action = `/admin/subscriptions/plans/${planId}`;
            document.getElementById('plan-input-name').value = name;
            document.getElementById('plan-input-description').value = description;
            document.getElementById('plan-input-price-monthly').value = priceMonthly;
            document.getElementById('plan-input-price-annual').value = priceAnnual;
            document.getElementById('plan-input-max-facilities').value = maxFac;
            document.getElementById('plan-input-max-bays').value = maxBays;
            document.getElementById('plan-input-max-gates').value = maxGates;
            document.getElementById('plan-input-max-staff').value = maxStaff;
            document.getElementById('plan-input-sla').value = sla;

            modal.classList.remove('hidden');
        }

        function closeEditPlanModal() {
            const modal = document.getElementById('editPlanModal');
            if (modal) modal.classList.add('hidden');
        }

        // Close on Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSubscriptionDrawer();
                closeChangePlanModal();
                closeExtendTrialModal();
                closeStatusModal();
                closeEditPlanModal();
            }
        });

        // Auto-open drawer if requested by query parameter (e.g. ?detail=vdr-jkt-01)
        @if(!empty($selectedSubscription))
        document.addEventListener('DOMContentLoaded', function() {
            openSubscriptionDrawer('{{ $selectedSubscription['id'] }}');
        });
        @endif
    </script>
    @endpush

</x-layouts.admin>
