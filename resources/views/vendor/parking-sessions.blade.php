<x-layouts.vendor activeNav="sessions" title="Parking Sessions Monitoring - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Success</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Operational Notice</p>
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
            <p class="text-xs font-bold uppercase tracking-wider text-amber-900">Validation Notice</p>
            <ul class="text-sm list-disc list-inside space-y-0.5 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- ================= FACILITY CONTEXT & PAGE HEADER ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Breadcrumb -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Fleet Operations • Page 28</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Ingress/Egress Telemetry Live
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Parking Sessions
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Monitor vehicle parking activity across your facilities.
                </p>
            </div>
        </div>

        <!-- Facility Switcher & Primary Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Facility Context Switcher -->
            @if(count($facilities) > 1)
            <div class="relative min-w-[210px]">
                <label for="facility-selector" class="sr-only">Switch Facility Scope</label>
                <select id="facility-selector" 
                        onchange="window.location.href = '/vendor/parking-sessions?facility=' + this.value + '&period={{ $filters['period'] }}&status={{ $filters['status'] }}'"
                        class="w-full pl-3 pr-8 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($facilityId === 'all') ? 'selected' : '' }}>All Authorized Facilities ({{ count($facilities) }})</option>
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($facilityId === $f['id']) ? 'selected' : '' }}>
                            {{ $f['name'] }} ({{ $f['city'] }})
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            <!-- Refresh Button -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer" 
                    title="Refresh Live Session Records"
                    aria-label="Refresh Live Session Records">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Export to CSV Action -->
            <a href="/vendor/parking-sessions/export?facility={{ $facilityId }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_status={{ $filters['payment_status'] }}&area={{ $filters['area'] }}&q={{ urlencode($filters['q']) }}" 
               class="px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs"
               title="Export filtered records as CSV spreadsheet">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span>Export CSV</span>
            </a>
        </div>
    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4">
        
        <!-- Metric 1: Active Sessions -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Active (Parked)</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $metrics['active_sessions_count'] }}
                </div>
                <div class="flex items-center gap-1.5 mt-1 text-[11px] font-semibold text-emerald-600">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Vehicles inside bays</span>
                </div>
            </div>
        </div>

        <!-- Metric 2: Completed Sessions -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Completed Sessions</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $metrics['completed_sessions_count'] }}
                </div>
                <div class="text-[11px] font-medium text-slate-500 mt-1">
                    Exited & verified cycles
                </div>
            </div>
        </div>

        <!-- Metric 3: Requiring Attention -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Requires Attention</span>
                <div class="w-8 h-8 rounded-lg {{ $metrics['attention_required_count'] > 0 ? 'bg-amber-100 text-amber-700 animate-pulse' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold {{ $metrics['attention_required_count'] > 0 ? 'text-amber-700' : 'text-slate-900' }} leading-tight">
                    {{ $metrics['attention_required_count'] }}
                </div>
                <div class="text-[11px] font-medium {{ $metrics['attention_required_count'] > 0 ? 'text-amber-700' : 'text-slate-500' }} mt-1">
                    Overstay or payment issue
                </div>
            </div>
        </div>

        <!-- Metric 4: Average Duration -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Avg Duration</span>
                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-2xl font-extrabold text-slate-900 leading-tight">
                    {{ $metrics['average_duration_formatted'] }}
                </div>
                <div class="text-[11px] font-medium text-slate-500 mt-1">
                    Per parking transaction
                </div>
            </div>
        </div>

        <!-- Metric 5: Total Accrued / Collected Revenue -->
        <div class="col-span-2 lg:col-span-1 p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Recorded Revenue</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
            </div>
            <div class="mt-2.5">
                <div class="text-xl sm:text-2xl font-extrabold text-emerald-800 leading-tight">
                    {{ $metrics['formatted_total_fee'] }}
                </div>
                <div class="text-[11px] font-medium text-slate-500 mt-1">
                    Billed / accrued amount
                </div>
            </div>
        </div>

    </div>

    <!-- ================= SEARCH & MULTI-FILTER TOOLBAR ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        
        <form id="sessions-filter-form" method="GET" action="/vendor/parking-sessions" class="space-y-4">
            <!-- Hidden Facility Scope -->
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <!-- Primary Search Row -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
                <div class="relative flex-1">
                    <label for="search-input" class="sr-only">Search sessions</label>
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           id="search-input" 
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search plate (e.g. B 1234 XYZ), session reference, vehicle model, bay slot, or driver..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all">
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Apply Filter</span>
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/parking-sessions?facility={{ $facilityId }}" 
                       class="px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5"
                       title="Reset all active search and filter options">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Clear</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Granular Filter Dropdowns Row -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 pt-2 border-t border-slate-100">
                
                <!-- Period / Date Range -->
                <div>
                    <label for="filter-period" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Time Period</label>
                    <select id="filter-period" 
                            name="period" 
                            onchange="document.getElementById('sessions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['period'] === 'all') ? 'selected' : '' }}>All Time (All Records)</option>
                        <option value="today" {{ ($filters['period'] === 'today') ? 'selected' : '' }}>Today (11 Oct 2026)</option>
                        <option value="yesterday" {{ ($filters['period'] === 'yesterday') ? 'selected' : '' }}>Yesterday (10 Oct 2026)</option>
                        <option value="7days" {{ ($filters['period'] === '7days') ? 'selected' : '' }}>Last 7 Days (Oct 2026)</option>
                    </select>
                </div>

                <!-- Session Status Filter -->
                <div>
                    <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Session State</label>
                    <select id="filter-status" 
                            name="status" 
                            onchange="document.getElementById('sessions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['status'] === 'all') ? 'selected' : '' }}>All Session States</option>
                        <option value="active" {{ ($filters['status'] === 'active') ? 'selected' : '' }}>Active (Currently Parked)</option>
                        <option value="completed" {{ ($filters['status'] === 'completed') ? 'selected' : '' }}>Completed (Exited)</option>
                        <option value="attention" {{ ($filters['status'] === 'attention') ? 'selected' : '' }}>Attention Required (Flagged)</option>
                    </select>
                </div>

                <!-- Payment Status Filter -->
                <div>
                    <label for="filter-payment-status" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Payment Status</label>
                    <select id="filter-payment-status" 
                            name="payment_status" 
                            onchange="document.getElementById('sessions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['payment_status'] === 'all') ? 'selected' : '' }}>All Payment States</option>
                        <option value="paid" {{ ($filters['payment_status'] === 'paid') ? 'selected' : '' }}>Paid (Settled)</option>
                        <option value="pending" {{ ($filters['payment_status'] === 'pending') ? 'selected' : '' }}>Pending (In Progress)</option>
                        <option value="auto_debited" {{ ($filters['payment_status'] === 'auto_debited') ? 'selected' : '' }}>Auto-Debited (App)</option>
                        <option value="disputed" {{ ($filters['payment_status'] === 'disputed') ? 'selected' : '' }}>Overdue / Disputed</option>
                    </select>
                </div>

                <!-- Parking Area Filter -->
                <div>
                    <label for="filter-area" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Parking Area</label>
                    <select id="filter-area" 
                            name="area" 
                            onchange="document.getElementById('sessions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['area'] === 'all') ? 'selected' : '' }}>All Parking Areas</option>
                        @foreach($areas as $ar)
                            <option value="{{ $ar['id'] }}" {{ ($filters['area'] === $ar['id']) ? 'selected' : '' }}>
                                {{ $ar['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sorting Criteria -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Sort By</label>
                    <select id="filter-sort" 
                            name="sort" 
                            onchange="document.getElementById('sessions-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="entry_desc" {{ ($filters['sort'] === 'entry_desc') ? 'selected' : '' }}>Entry Time (Newest First)</option>
                        <option value="entry_asc" {{ ($filters['sort'] === 'entry_asc') ? 'selected' : '' }}>Entry Time (Oldest First)</option>
                        <option value="duration_desc" {{ ($filters['sort'] === 'duration_desc') ? 'selected' : '' }}>Longest Duration</option>
                        <option value="duration_asc" {{ ($filters['sort'] === 'duration_asc') ? 'selected' : '' }}>Shortest Duration</option>
                        <option value="fee_desc" {{ ($filters['sort'] === 'fee_desc') ? 'selected' : '' }}>Highest Billed Fee</option>
                        <option value="plate_asc" {{ ($filters['sort'] === 'plate_asc') ? 'selected' : '' }}>Vehicle Plate (A &rarr; Z)</option>
                    </select>
                </div>

            </div>
        </form>

    </div>

    <!-- ================= SESSION INVENTORY TABLE CONTAINER ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        <!-- Table Header Bar -->
        <div class="px-5 py-4 border-b border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900">
                    Parking Activity Feed
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Showing {{ $pagination['from'] }}-{{ $pagination['to'] }} of {{ $pagination['total'] }} recorded sessions across authorized facilities.
                </p>
            </div>

            <!-- Active Filters Pill Summary -->
            @if($hasActiveFilters)
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-[11px] font-bold text-slate-400">Active Filters:</span>
                @if($filters['q'])
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-200">
                        Query: "{{ $filters['q'] }}"
                    </span>
                @endif
                @if($filters['period'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Period: {{ ucfirst($filters['period']) }}
                    </span>
                @endif
                @if($filters['status'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Status: {{ ucfirst($filters['status']) }}
                    </span>
                @endif
                @if($filters['payment_status'] !== 'all')
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200">
                        Payment: {{ ucfirst($filters['payment_status']) }}
                    </span>
                @endif
            </div>
            @endif
        </div>

        <!-- Desktop View Table (Fixed colgroup to prevent character-level wrap) -->
        <div class="hidden lg:block overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse min-w-[1020px]">
                <colgroup>
                    <col class="w-[18%]"> <!-- Session Reference & Ingress -->
                    <col class="w-[16%]"> <!-- Vehicle Details -->
                    <col class="w-[16%]"> <!-- Facility & Placement -->
                    <col class="w-[15%]"> <!-- Timestamps & Duration -->
                    <col class="w-[12%]"> <!-- Session Status -->
                    <col class="w-[13%]"> <!-- Fee & Payment -->
                    <col class="w-[10%]"> <!-- Actions -->
                </colgroup>
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Session Reference</th>
                        <th class="py-3.5 px-3">Vehicle Details</th>
                        <th class="py-3.5 px-3">Facility & Placement</th>
                        <th class="py-3.5 px-3">Timestamps & Duration</th>
                        <th class="py-3.5 px-3">Session Status</th>
                        <th class="py-3.5 px-3">Fee & Payment</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-xs font-medium">
                    @forelse($sessions as $session)
                    <tr class="hover:bg-slate-50/60 transition-colors group {{ !empty($session['is_flagged']) ? 'bg-amber-50/30' : '' }}">
                        
                        <!-- 1. Session Reference & Gate -->
                        <td class="py-3.5 px-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-mono text-xs font-bold text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap tracking-tight group-hover:border-[var(--primary)] group-hover:text-[var(--primary)] transition-colors">
                                        {{ $session['session_code'] }}
                                    </span>
                                    @if(!empty($session['is_flagged']))
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-300 whitespace-nowrap" title="{{ $session['flag_reason'] }}">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                        Flagged
                                    </span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-500 truncate mt-1 flex items-center gap-1">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <span class="truncate" title="{{ $session['entry_gate_name'] }}">{{ $session['entry_gate_name'] }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- 2. Vehicle Details -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-mono text-xs font-extrabold text-slate-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-300 whitespace-nowrap">
                                        {{ $session['vehicle_plate'] }}
                                    </span>
                                    
                                    <!-- Vehicle Category Badge -->
                                    @if($session['vehicle_type'] === 'EV')
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        EV
                                    </span>
                                    @elseif($session['vehicle_type'] === 'Motorcycle')
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Bike
                                    </span>
                                    @elseif($session['vehicle_type'] === 'VIP / Luxury')
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                        VIP
                                    </span>
                                    @else
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Car
                                    </span>
                                    @endif
                                </div>

                                <div class="text-xs font-bold text-slate-800 truncate mt-1" title="{{ $session['vehicle_model'] }}">
                                    {{ $session['vehicle_model'] }}
                                </div>
                                <div class="text-[11px] text-slate-400 truncate">
                                    {{ $session['vehicle_color'] }}
                                </div>
                            </div>
                        </td>

                        <!-- 3. Facility & Placement -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                <div class="font-bold text-xs text-slate-900 truncate" title="{{ $session['facility_name'] }}">
                                    {{ $session['facility_name'] }}
                                </div>
                                <div class="text-[11px] text-slate-600 truncate mt-0.5" title="{{ $session['area_name'] }}">
                                    {{ $session['area_name'] }}
                                </div>
                                <div class="mt-1">
                                    @if($session['slot_code'] && $session['slot_code'] !== 'Unassigned Bay')
                                    <span class="inline-flex items-center gap-1 font-mono text-[11px] font-semibold text-slate-700 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200 whitespace-nowrap">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                        Bay {{ $session['slot_code'] }}
                                    </span>
                                    @else
                                    <span class="text-[10px] text-slate-400 italic">
                                        Open Bay Area
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- 4. Timestamps & Duration -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0 space-y-1">
                                <div class="flex items-center gap-1 text-[11px] text-slate-800">
                                    <span class="text-slate-400 font-semibold w-7">In:</span>
                                    <span class="font-medium whitespace-nowrap">{{ $session['entry_time'] }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-[11px]">
                                    <span class="text-slate-400 font-semibold w-7">Out:</span>
                                    @if($session['exit_time'])
                                    <span class="font-medium text-slate-800 whitespace-nowrap">{{ $session['exit_time'] }}</span>
                                    @else
                                    <span class="font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200 whitespace-nowrap">
                                        Currently Parked
                                    </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1 text-[11px] text-slate-500 pt-0.5">
                                    <span class="text-slate-400 font-semibold w-7">Time:</span>
                                    <span class="font-bold text-slate-900 bg-slate-100 px-1.5 py-0.2 rounded">{{ $session['duration_formatted'] }}</span>
                                    <span class="text-[10px] text-slate-400">({{ $session['duration_type'] }})</span>
                                </div>
                            </div>
                        </td>

                        <!-- 5. Session Status -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                @if($session['session_status'] === 'active')
                                <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap shadow-2xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Active (Parked)
                                </span>
                                @elseif($session['session_status'] === 'attention_required')
                                <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-300 whitespace-nowrap shadow-2xs">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    {{ $session['session_status_label'] }}
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Completed
                                </span>
                                @endif

                                @if(!empty($session['is_flagged']) && $session['flag_reason'])
                                <div class="text-[10px] text-amber-700 font-medium truncate mt-1 max-w-[140px]" title="{{ $session['flag_reason'] }}">
                                    ⚠️ {{ $session['flag_reason'] }}
                                </div>
                                @endif
                            </div>
                        </td>

                        <!-- 6. Fee & Payment -->
                        <td class="py-3.5 px-3">
                            <div class="min-w-0">
                                <div class="font-extrabold text-xs text-slate-900">
                                    {{ $session['formatted_fee'] }}
                                </div>
                                <div class="mt-1">
                                    @if($session['payment_status'] === 'paid')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Paid
                                    </span>
                                    @elseif($session['payment_status'] === 'auto_debited')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 whitespace-nowrap">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        Auto-Debited
                                    </span>
                                    @elseif($session['payment_status'] === 'pending')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                        Pending
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-700 border border-red-200 whitespace-nowrap">
                                        Disputed
                                    </span>
                                    @endif
                                </div>
                                <div class="text-[10px] text-slate-400 truncate mt-0.5" title="{{ $session['payment_method'] }}">
                                    {{ $session['payment_method'] }}
                                </div>
                            </div>
                        </td>

                        <!-- 7. Actions -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" 
                                        onclick="openSessionDetails('{{ $session['id'] }}')" 
                                        class="px-2.5 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] text-xs font-semibold transition-colors cursor-pointer flex items-center gap-1 shadow-2xs"
                                        title="View Ingress/Egress Dossier">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span>Inspect</span>
                                </button>

                                @if(!empty($session['is_flagged']))
                                <button type="button" 
                                        onclick="openResolveModal('{{ $session['id'] }}', '{{ $session['session_code'] }}', '{{ $session['flag_reason'] }}')" 
                                        class="p-1.5 rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-800 transition-colors cursor-pointer"
                                        title="Resolve Operational Flag">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>
                                @else
                                <button type="button" 
                                        onclick="openFlagModal('{{ $session['id'] }}', '{{ $session['session_code'] }}')" 
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors cursor-pointer"
                                        title="Flag for Operator Review">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                </button>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="max-w-md mx-auto space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 mx-auto flex items-center justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900">No Parking Sessions Found</h3>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    No recorded parking activities match the active facility scope or search criteria.
                                </p>
                                @if($hasActiveFilters)
                                <div class="pt-2">
                                    <a href="/vendor/parking-sessions?facility={{ $facilityId }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-[var(--primary)] text-white hover:bg-[var(--primary-dark)] transition-colors">
                                        Reset All Filters
                                    </a>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile / Tablet Responsive Card List (lg:hidden) -->
        <div class="lg:hidden divide-y divide-[var(--border)]">
            @forelse($sessions as $session)
            <div class="p-4 space-y-3 hover:bg-slate-50/60 transition-colors {{ !empty($session['is_flagged']) ? 'bg-amber-50/30' : '' }}">
                
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xs font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                {{ $session['vehicle_plate'] }}
                            </span>
                            @if($session['session_status'] === 'active')
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Active
                            </span>
                            @elseif($session['session_status'] === 'attention_required')
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                Attention
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                Completed
                            </span>
                            @endif
                        </div>
                        <div class="text-xs font-bold text-slate-900 mt-1">
                            {{ $session['vehicle_model'] }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-extrabold text-slate-900">
                            {{ $session['formatted_fee'] }}
                        </div>
                        <div class="text-[10px] text-slate-400">
                            {{ $session['payment_status_label'] }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Facility & Area</span>
                        <span class="font-semibold text-slate-800 truncate block">{{ $session['facility_name'] }}</span>
                        <span class="text-[11px] text-slate-500 truncate block">{{ $session['slot_code'] ?: 'Unassigned' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Duration & Time</span>
                        <span class="font-semibold text-slate-800 block">{{ $session['duration_formatted'] }}</span>
                        <span class="text-[11px] text-slate-500 block truncate">{{ $session['entry_time'] }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <span class="font-mono text-[11px] text-slate-400">
                        {{ $session['session_code'] }}
                    </span>
                    <button type="button" 
                            onclick="openSessionDetails('{{ $session['id'] }}')" 
                            class="px-3 py-1.5 rounded-lg bg-[var(--primary)] text-white text-xs font-bold hover:bg-[var(--primary-dark)] transition-colors cursor-pointer flex items-center gap-1 shadow-xs">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        <span>Inspect Dossier</span>
                    </button>
                </div>

            </div>
            @empty
            <div class="p-8 text-center text-xs text-slate-500">
                No session activity recorded for current parameters.
            </div>
            @endforelse
        </div>

        <!-- Pagination Bar -->
        @if($pagination['total'] > 0)
        <div class="p-4 border-t border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-600">
            <div>
                Showing <span class="font-bold text-slate-900">{{ $pagination['from'] }}</span> to 
                <span class="font-bold text-slate-900">{{ $pagination['to'] }}</span> of 
                <span class="font-bold text-slate-900">{{ $pagination['total'] }}</span> sessions
            </div>

            <div class="flex items-center gap-1.5">
                @if($pagination['current_page'] > 1)
                <a href="/vendor/parking-sessions?facility={{ $facilityId }}&page={{ $pagination['current_page'] - 1 }}&q={{ urlencode($filters['q']) }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_status={{ $filters['payment_status'] }}&area={{ $filters['area'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                    Previous
                </a>
                @endif

                @for($p = 1; $p <= $pagination['last_page']; $p++)
                    @if($p == $pagination['current_page'])
                        <span class="px-3 py-1.5 rounded-lg bg-[var(--primary)] text-white font-bold">{{ $p }}</span>
                    @elseif($p <= 3 || $p >= $pagination['last_page'] - 1 || abs($p - $pagination['current_page']) <= 1)
                        <a href="/vendor/parking-sessions?facility={{ $facilityId }}&page={{ $p }}&q={{ urlencode($filters['q']) }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_status={{ $filters['payment_status'] }}&area={{ $filters['area'] }}&sort={{ $filters['sort'] }}" 
                           class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                            {{ $p }}
                        </a>
                    @endif
                @endfor

                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/parking-sessions?facility={{ $facilityId }}&page={{ $pagination['current_page'] + 1 }}&q={{ urlencode($filters['q']) }}&period={{ $filters['period'] }}&status={{ $filters['status'] }}&payment_status={{ $filters['payment_status'] }}&area={{ $filters['area'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                    Next
                </a>
                @endif
            </div>
        </div>
        @endif

    </div>

    <!-- ================= SLIDE-OVER INSPECTION DRAWER ================= -->
    <div id="session-drawer" class="fixed inset-0 z-50 hidden transition-opacity duration-300" aria-labelledby="drawer-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="session-drawer-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeSessionDetails()"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col transform transition-transform ease-in-out duration-300">
                
                <!-- Drawer Header -->
                <div class="px-6 py-5 border-b border-[var(--border)] bg-slate-50/75 flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="drawer-session-code" class="font-mono text-sm font-extrabold text-[var(--primary)] bg-blue-50 px-2 py-0.5 rounded border border-blue-200">
                                SES-LOADING
                            </span>
                            <span id="drawer-status-pill" class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        </div>
                        <h2 id="drawer-title" class="text-base font-extrabold text-slate-900 mt-1">
                            Session Operational Dossier
                        </h2>
                    </div>
                    <button type="button" 
                            onclick="closeSessionDetails()" 
                            class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors cursor-pointer" 
                            aria-label="Close Inspection Drawer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6 text-xs font-medium">
                    
                    <!-- Flag Alert Banner (Conditional) -->
                    <div id="drawer-flag-banner" class="hidden p-4 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 space-y-2">
                        <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-800">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                            <span>Operational Flag Active</span>
                        </div>
                        <p id="drawer-flag-reason" class="text-xs font-medium text-amber-900 leading-relaxed"></p>
                    </div>

                    <!-- 1. Vehicle Identity Card -->
                    <div class="p-4 rounded-xl border border-[var(--border)] bg-slate-50/50 space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Vehicle Identity & Driver Profile
                        </div>
                        <div class="flex items-start justify-between">
                            <div>
                                <span id="drawer-vehicle-plate" class="font-mono text-base font-extrabold text-slate-900 bg-white px-2.5 py-1 rounded border border-slate-300 inline-block shadow-2xs">
                                    --
                                </span>
                                <div id="drawer-vehicle-model" class="font-bold text-sm text-slate-900 mt-1.5">--</div>
                                <div id="drawer-vehicle-color" class="text-xs text-slate-500">--</div>
                            </div>
                            <span id="drawer-vehicle-type-badge" class="px-2 py-0.5 rounded text-[11px] font-bold bg-blue-100 text-blue-800">
                                Car
                            </span>
                        </div>
                        <div class="pt-2 border-t border-slate-200/70 grid grid-cols-2 gap-2 text-[11px]">
                            <div>
                                <span class="text-slate-400 block">Registered Driver:</span>
                                <span id="drawer-driver-name" class="font-semibold text-slate-800">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">Contact Mask:</span>
                                <span id="drawer-driver-phone" class="font-semibold text-slate-800">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Facility Placement -->
                    <div class="p-4 rounded-xl border border-[var(--border)] bg-slate-50/50 space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Facility Placement & Allocation
                        </div>
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Facility</span>
                                <span id="drawer-facility-name" class="font-bold text-slate-900 block mt-0.5">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Allocated Area</span>
                                <span id="drawer-area-name" class="font-bold text-slate-900 block mt-0.5">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Assigned Slot Bay</span>
                                <span id="drawer-slot-code" class="font-mono font-bold text-slate-900 block mt-0.5">--</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[10px] uppercase font-bold block">Current Rate</span>
                                <span id="drawer-rate-hourly" class="font-bold text-slate-900 block mt-0.5">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Ingress & Egress Timestamps -->
                    <div class="p-4 rounded-xl border border-[var(--border)] bg-slate-50/50 space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Access Gate & Optical Verification
                        </div>
                        <div class="space-y-3 text-xs">
                            <!-- Ingress -->
                            <div class="p-2.5 rounded-lg bg-white border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-emerald-700 flex items-center gap-1">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Inbound Verification
                                    </span>
                                    <span id="drawer-entry-time" class="font-semibold text-slate-700">--</span>
                                </div>
                                <div class="text-[11px] text-slate-500 flex items-center justify-between">
                                    <span id="drawer-entry-gate">Gate: --</span>
                                    <span id="drawer-entry-camera" class="font-mono">CAM: --</span>
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    ANPR Confidence: <span id="drawer-entry-confidence" class="font-bold text-slate-700">--</span>
                                </div>
                            </div>

                            <!-- Egress -->
                            <div class="p-2.5 rounded-lg bg-white border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-blue-700 flex items-center gap-1">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                                        Outbound Egress
                                    </span>
                                    <span id="drawer-exit-time" class="font-semibold text-slate-700">--</span>
                                </div>
                                <div class="text-[11px] text-slate-500 flex items-center justify-between">
                                    <span id="drawer-exit-gate">Gate: --</span>
                                    <span id="drawer-exit-camera" class="font-mono">CAM: --</span>
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    ANPR Confidence: <span id="drawer-exit-confidence" class="font-bold text-slate-700">--</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Financial Fee & Payment Breakdown -->
                    <div class="p-4 rounded-xl border border-[var(--border)] bg-slate-50/50 space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Billing & Settlement Breakdown
                        </div>
                        <div class="space-y-1.5 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-600">Duration Recorded:</span>
                                <span id="drawer-duration" class="font-bold text-slate-900">--</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-600">Base Parking Charge:</span>
                                <span id="drawer-base-fee" class="font-semibold text-slate-900">--</span>
                            </div>
                            <div class="flex items-center justify-between pt-1 border-t border-slate-200 text-sm font-extrabold text-slate-900">
                                <span>Total Fee Due:</span>
                                <span id="drawer-total-fee" class="text-emerald-700">--</span>
                            </div>
                            <div class="flex items-center justify-between pt-1 text-[11px]">
                                <span class="text-slate-500">Settlement Method:</span>
                                <span id="drawer-payment-method" class="font-semibold text-slate-800">--</span>
                            </div>
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="text-slate-500">Transaction Token:</span>
                                <span id="drawer-payment-ref" class="font-mono font-semibold text-slate-700">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Chronological Event Timeline -->
                    <div class="space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Ingress / Egress Audit Trace
                        </div>
                        <div id="drawer-timeline" class="space-y-3 pl-2 border-l-2 border-slate-200">
                            <!-- Populated via Javascript -->
                        </div>
                    </div>

                </div>

                <!-- Drawer Footer Controls -->
                <div class="p-5 border-t border-[var(--border)] bg-slate-50 flex items-center justify-between gap-3">
                    <button type="button" 
                            onclick="closeSessionDetails()" 
                            class="px-4 py-2 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold transition-colors cursor-pointer">
                        Close Dossier
                    </button>

                    <div id="drawer-action-container">
                        <!-- Populated by JS based on flag state -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= MODAL: FLAG FOR INVESTIGATION ================= -->
    <div id="flag-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="flag-modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" onclick="closeFlagModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl border border-[var(--border)] overflow-hidden">
                <form id="flag-form" method="POST" action="">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                        </div>
                        <div>
                            <h3 id="flag-modal-title" class="text-base font-extrabold text-slate-900">
                                Flag Parking Session
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Mark session <span id="flag-modal-code" class="font-mono font-bold text-slate-800">--</span> for manual supervisor investigation.
                            </p>
                        </div>

                        <div>
                            <label for="flag-reason-select" class="block text-xs font-bold text-slate-700 mb-1">Reason for Flag *</label>
                            <select id="flag-reason-select" name="reason" required class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="Overstay exceeded 24 hours without prior overnight declaration">Overstay > 24 hours without declaration</option>
                                <option value="Prepaid tap failed at barrier exit with insufficient balance">Exit gate tap payment insufficient balance</option>
                                <option value="Plate mismatch between inbound and outbound ANPR capture">ANPR Plate mismatch discrepancy</option>
                                <option value="Customer reported lost parking ticket or damaged RFID pass">Customer reported lost ticket / manual clearance</option>
                                <option value="Suspicious vehicle movement or barrier forced open">Security anomaly / barrier forced open</option>
                            </select>
                        </div>

                        <div>
                            <label for="flag-notes" class="block text-xs font-bold text-slate-700 mb-1">Supervisor Notes (Optional)</label>
                            <textarea id="flag-notes" name="notes" rows="2" placeholder="Add specific operational context..." class="w-full p-2.5 rounded-xl border border-[var(--border)] text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-[var(--border)] flex items-center justify-end gap-2.5">
                        <button type="button" onclick="closeFlagModal()" class="px-4 py-2 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-xs font-semibold text-slate-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow-xs">Submit Operational Flag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= MODAL: RESOLVE OPERATIONAL FLAG ================= -->
    <div id="resolve-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="resolve-modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" onclick="closeResolveModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl border border-[var(--border)] overflow-hidden">
                <form id="resolve-form" method="POST" action="">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <h3 id="resolve-modal-title" class="text-base font-extrabold text-slate-900">
                                Resolve Operational Flag
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Clear review status for session <span id="resolve-modal-code" class="font-mono font-bold text-slate-800">--</span>.
                            </p>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Existing Flag Reason</span>
                            <span id="resolve-existing-reason" class="text-slate-800 font-medium mt-0.5 block">--</span>
                        </div>

                        <div>
                            <label for="resolve-notes" class="block text-xs font-bold text-slate-700 mb-1">Resolution Summary</label>
                            <textarea id="resolve-notes" name="notes" rows="2" placeholder="e.g. Fare settled at cash counter, driver identity verified, receipt issued." class="w-full p-2.5 rounded-xl border border-[var(--border)] text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-[var(--border)] flex items-center justify-end gap-2.5">
                        <button type="button" onclick="closeResolveModal()" class="px-4 py-2 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-xs font-semibold text-slate-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs">Confirm Resolution</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    let activeSessionDossier = null;

    /**
     * Open Slide-Over Inspection Drawer with live API lookup.
     */
    async function openSessionDetails(sessionId) {
        const drawer = document.getElementById('session-drawer');
        if (!drawer) return;

        drawer.classList.remove('hidden');

        // Set loading states
        document.getElementById('drawer-session-code').innerText = 'Loading...';
        document.getElementById('drawer-vehicle-plate').innerText = '...';
        document.getElementById('drawer-vehicle-model').innerText = 'Loading telemetry...';
        document.getElementById('drawer-timeline').innerHTML = '<div class="text-xs text-slate-400 py-2">Loading event logs...</div>';

        try {
            const res = await fetch('/api/vendor/parking-sessions/' + encodeURIComponent(sessionId));
            if (!res.ok) throw new Error('Failed to fetch session metadata');
            const data = await res.json();

            if (!data.success || !data.session) throw new Error('Session not found');
            const s = data.session;
            activeSessionDossier = s;

            // Populate Drawer Elements
            document.getElementById('drawer-session-code').innerText = s.session_code;
            
            // Status Pill
            const statusPill = document.getElementById('drawer-status-pill');
            if (s.session_status === 'active') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200';
                statusPill.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Active (Parked)';
            } else if (s.session_status === 'attention_required') {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-300';
                statusPill.innerHTML = '⚠️ Attention Required';
            } else {
                statusPill.className = 'inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-700 border border-slate-200';
                statusPill.innerHTML = 'Completed';
            }

            // Flag banner
            const flagBanner = document.getElementById('drawer-flag-banner');
            if (s.is_flagged) {
                flagBanner.classList.remove('hidden');
                document.getElementById('drawer-flag-reason').innerText = s.flag_reason || 'Marked for supervisor review';
            } else {
                flagBanner.classList.add('hidden');
            }

            // Vehicle
            document.getElementById('drawer-vehicle-plate').innerText = s.vehicle_plate;
            document.getElementById('drawer-vehicle-model').innerText = s.vehicle_model;
            document.getElementById('drawer-vehicle-color').innerText = s.vehicle_color;
            document.getElementById('drawer-vehicle-type-badge').innerText = s.vehicle_type;
            document.getElementById('drawer-driver-name').innerText = s.driver_name || 'Driver Not Disclosed';
            document.getElementById('drawer-driver-phone').innerText = s.driver_phone || '--';

            // Placement
            document.getElementById('drawer-facility-name').innerText = s.facility_name;
            document.getElementById('drawer-area-name').innerText = s.area_name;
            document.getElementById('drawer-slot-code').innerText = s.slot_code || 'Unassigned Bay';
            document.getElementById('drawer-rate-hourly').innerText = 'Rp ' + Number(s.rate_hourly || 5000).toLocaleString('id-ID') + ' / hr';

            // Gates
            document.getElementById('drawer-entry-time').innerText = s.entry_time;
            document.getElementById('drawer-entry-gate').innerText = 'Gate: ' + (s.entry_gate_code || '--');
            document.getElementById('drawer-entry-camera').innerText = s.entry_camera_code || '--';
            document.getElementById('drawer-entry-confidence').innerText = (s.entry_anpr_confidence || 99) + '%';

            document.getElementById('drawer-exit-time').innerText = s.exit_time || 'Not Exited Yet';
            document.getElementById('drawer-exit-gate').innerText = 'Gate: ' + (s.exit_gate_code || 'None (Parked)');
            document.getElementById('drawer-exit-camera').innerText = s.exit_camera_code || '--';
            document.getElementById('drawer-exit-confidence').innerText = s.exit_anpr_confidence ? (s.exit_anpr_confidence + '%') : 'Pending Exit';

            // Financial
            document.getElementById('drawer-duration').innerText = s.duration_formatted + ' (' + s.duration_type + ')';
            document.getElementById('drawer-base-fee').innerText = 'Rp ' + Number(s.base_fee || 0).toLocaleString('id-ID');
            document.getElementById('drawer-total-fee').innerText = s.formatted_fee;
            document.getElementById('drawer-payment-method').innerText = s.payment_method;
            document.getElementById('drawer-payment-ref').innerText = s.payment_reference || 'Pending Exit Settlement';

            // Timeline Trace
            const timelineContainer = document.getElementById('drawer-timeline');
            if (s.timeline && s.timeline.length > 0) {
                timelineContainer.innerHTML = s.timeline.map(item => `
                    <div class="relative pl-4">
                        <div class="absolute -left-[9px] top-1 w-3.5 h-3.5 rounded-full ${item.status === 'warning' ? 'bg-amber-400' : 'bg-emerald-500'} border-2 border-white shadow-2xs"></div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-slate-800">${item.event}</span>
                            <span class="text-slate-400 font-mono text-[10px]">${item.time}</span>
                        </div>
                        <div class="text-[11px] text-slate-500 mt-0.5">${item.details}</div>
                    </div>
                `).join('');
            } else {
                timelineContainer.innerHTML = '<div class="text-xs text-slate-400 italic">No timeline trace available.</div>';
            }

            // Footer Action
            const actionContainer = document.getElementById('drawer-action-container');
            if (s.is_flagged) {
                actionContainer.innerHTML = `
                    <button type="button" 
                            onclick="closeSessionDetails(); openResolveModal('${s.id}', '${s.session_code}', '${s.flag_reason || ''}')" 
                            class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Resolve Flag</span>
                    </button>
                `;
            } else {
                actionContainer.innerHTML = `
                    <button type="button" 
                            onclick="closeSessionDetails(); openFlagModal('${s.id}', '${s.session_code}')" 
                            class="px-4 py-2 rounded-xl border border-amber-300 bg-amber-50 hover:bg-amber-100 text-amber-800 text-xs font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-2xs">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                        <span>Flag for Review</span>
                    </button>
                `;
            }

        } catch (err) {
            document.getElementById('drawer-title').innerText = 'Session Details Failed';
            document.getElementById('drawer-timeline').innerHTML = `<div class="text-xs text-red-600">Error loading session data: ${err.message}</div>`;
        }
    }

    function closeSessionDetails() {
        const drawer = document.getElementById('session-drawer');
        if (drawer) drawer.classList.add('hidden');
    }

    /**
     * Modal controls for flagging.
     */
    function openFlagModal(id, code) {
        document.getElementById('flag-modal-code').innerText = code;
        document.getElementById('flag-form').action = '/vendor/parking-sessions/' + encodeURIComponent(id) + '/flag';
        document.getElementById('flag-modal').classList.remove('hidden');
    }

    function closeFlagModal() {
        document.getElementById('flag-modal').classList.add('hidden');
    }

    /**
     * Modal controls for resolving.
     */
    function openResolveModal(id, code, reason) {
        document.getElementById('resolve-modal-code').innerText = code;
        document.getElementById('resolve-existing-reason').innerText = reason || 'Manual review flag';
        document.getElementById('resolve-form').action = '/vendor/parking-sessions/' + encodeURIComponent(id) + '/resolve';
        document.getElementById('resolve-modal').classList.remove('hidden');
    }

    function closeResolveModal() {
        document.getElementById('resolve-modal').classList.add('hidden');
    }

    // Keyboard accessibility
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSessionDetails();
            closeFlagModal();
            closeResolveModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
