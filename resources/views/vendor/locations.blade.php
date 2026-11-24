<x-layouts.vendor activeNav="locations" title="Locations Management - NusaPark Enterprise">

    <!-- Flash Notifications -->
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
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100">
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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Error</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100">
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

    <!-- ================= PAGE HEADER ================= -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-2 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)] font-medium mb-1">
                <span>Vendor Portal</span>
                <span class="text-slate-300">/</span>
                <span>Operations</span>
                <span class="text-slate-300">/</span>
                <span class="text-[var(--primary)] font-semibold">Locations</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    Locations
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                    {{ count($locations) }} of {{ $metrics['total_locations'] }} Facilities Showing
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 hidden sm:inline">
                    Tenant: {{ $tenant['company_name'] }}
                </span>
            </div>
            <p class="text-sm text-[var(--text-muted)] mt-1.5 max-w-3xl">
                Monitor and configure authorized parking facilities, capacity allocations, barrier gate telemetry, and operational status across your licensed sites.
            </p>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center gap-2.5 shrink-0">
            <!-- Refresh Action -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 sm:px-3 sm:py-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-slate-700 hover:text-[var(--primary)] hover:border-slate-300 text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer"
                    title="Refresh Facilities List">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="hover:rotate-180 transition-transform duration-500">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>

            <!-- Add Location Action (Modal Trigger) -->
            <button type="button"
                    onclick="openAddLocationModal()"
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer active:scale-98">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Add Location</span>
            </button>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS ROW ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        
        <!-- Total Managed Facilities -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Managed Sites</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-[var(--accent)] flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    {{ $metrics['total_locations'] }}
                </div>
                <div class="text-[11px] text-[var(--text-muted)] font-medium mt-0.5">
                    Authorized under Enterprise Tier
                </div>
            </div>
        </div>

        <!-- Operational Status -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Fully Operational</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600 tracking-tight">
                    {{ $metrics['operational_locations'] }}
                </div>
                <div class="flex items-center gap-1.5 text-[11px] text-emerald-700 font-medium mt-0.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Gates & Sensors Optimal</span>
                </div>
            </div>
        </div>

        <!-- Attention Required / Alert -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Needs Attention</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-600 tracking-tight">
                    {{ $metrics['attention_locations'] }}
                </div>
                <div class="text-[11px] text-amber-700 font-medium mt-0.5">
                    {{ $metrics['attention_locations'] > 0 ? '1 Hardware Maintenance Check' : 'No Active Sensor Warnings' }}
                </div>
            </div>
        </div>

        <!-- Total System Capacity & Live Availability -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Total Slot Capacity</span>
                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                        {{ number_format($metrics['total_capacity'], 0, ',', '.') }}
                    </span>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                        {{ number_format($metrics['total_available'], 0, ',', '.') }} Avail
                    </span>
                </div>
                <!-- Micro Occupancy Bar -->
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden flex">
                    <div class="bg-[var(--accent)] h-1.5 rounded-full" style="width: {{ $metrics['avg_occupancy_rate'] }}%"></div>
                </div>
                <div class="text-[11px] text-[var(--text-muted)] font-medium mt-1">
                    {{ $metrics['avg_occupancy_rate'] }}% overall occupancy
                </div>
            </div>
        </div>

    </div>

    <!-- ================= SEARCH, FILTER & TOOLBAR ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <form method="GET" action="/vendor/locations" id="location-filters-form" class="space-y-3">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                
                <!-- Search Input -->
                <div class="md:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           id="filter-q"
                           value="{{ $filters['q'] }}" 
                           placeholder="Search by facility name, code, address, or district..." 
                           class="w-full pl-10 pr-9 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-800 placeholder-slate-400">
                    @if($filters['q'])
                    <a href="/vendor/locations?{{ http_build_query(array_merge($filters, ['q' => ''])) }}" 
                       class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600"
                       title="Clear search">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                    @endif
                </div>

                <!-- Status Filter -->
                <div class="md:col-span-2">
                    <select name="status" 
                            id="filter-status" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-700">
                        <option value="all" {{ $filters['status'] === 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="Optimal" {{ $filters['status'] === 'Optimal' ? 'selected' : '' }}>Operational (Optimal)</option>
                        <option value="Attention Required" {{ $filters['status'] === 'Attention Required' ? 'selected' : '' }}>Attention Required</option>
                        <option value="Maintenance" {{ $filters['status'] === 'Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                        <option value="Inactive" {{ $filters['status'] === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- City / District Filter -->
                <div class="md:col-span-2">
                    <select name="city" 
                            id="filter-city" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-700">
                        <option value="all" {{ $filters['city'] === 'all' ? 'selected' : '' }}>All Cities / Areas</option>
                        @foreach($cities as $c)
                            <option value="{{ $c }}" {{ $filters['city'] === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="md:col-span-2">
                    <select name="sort" 
                            id="filter-sort" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-700">
                        <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="name_desc" {{ $filters['sort'] === 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                        <option value="capacity_desc" {{ $filters['sort'] === 'capacity_desc' ? 'selected' : '' }}>Capacity: High to Low</option>
                        <option value="occupancy_desc" {{ $filters['sort'] === 'occupancy_desc' ? 'selected' : '' }}>Occupancy: High to Low</option>
                        <option value="updated_desc" {{ $filters['sort'] === 'updated_desc' ? 'selected' : '' }}>Recently Updated</option>
                    </select>
                </div>

                <!-- Submit / Clear Buttons -->
                <div class="md:col-span-1 flex items-center gap-1.5">
                    <button type="submit" 
                            class="w-full py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all text-center cursor-pointer">
                        Apply
                    </button>
                </div>

            </div>

            <!-- Active Filter Badges / Chips -->
            @php
                $hasActiveFilters = ($filters['q'] !== '') || ($filters['status'] !== 'all') || ($filters['city'] !== 'all') || ($filters['type'] !== 'all') || ($filters['sort'] !== 'name_asc');
            @endphp

            @if($hasActiveFilters)
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100 text-xs">
                <span class="text-slate-400 font-medium">Active filters:</span>
                
                @if($filters['q'])
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-[var(--accent)] font-semibold border border-blue-200">
                    Query: "{{ $filters['q'] }}"
                    <a href="/vendor/locations?{{ http_build_query(array_merge($filters, ['q' => ''])) }}" class="hover:text-blue-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                @if($filters['status'] !== 'all')
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold border border-slate-200">
                    Status: {{ $filters['status'] }}
                    <a href="/vendor/locations?{{ http_build_query(array_merge($filters, ['status' => 'all'])) }}" class="hover:text-slate-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                @if($filters['city'] !== 'all')
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold border border-slate-200">
                    City: {{ $filters['city'] }}
                    <a href="/vendor/locations?{{ http_build_query(array_merge($filters, ['city' => 'all'])) }}" class="hover:text-slate-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                <a href="/vendor/locations" class="text-xs text-[var(--accent)] hover:underline font-bold ml-1">
                    Reset All Filters
                </a>
            </div>
            @endif

        </form>
    </div>

    <!-- ================= LOCATIONS LIST / GRID ================= -->
    @if(empty($locations))
        <!-- Empty Results State -->
        <div class="p-8 sm:p-12 rounded-2xl bg-[var(--surface)] border border-[var(--border)] text-center shadow-xs">
            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <h3 class="text-base font-bold text-[var(--text)]">No parking facilities match your search</h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-1 max-w-md mx-auto">
                No authorized facilities matched the specified search query or filter parameters. Try clearing your filters or adding a new location.
            </p>
            <div class="mt-5 flex items-center justify-center gap-3">
                <a href="/vendor/locations" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all">
                    Reset Filters
                </a>
                <button type="button" onclick="openAddLocationModal()" class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all">
                    Add New Facility
                </button>
            </div>
        </div>
    @else
        <!-- Grid of Location Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($locations as $loc)
            <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] hover:border-slate-300 transition-all shadow-xs hover:shadow-md flex flex-col justify-between overflow-hidden group">
                
                <!-- Card Header -->
                <div class="p-5 border-b border-slate-100 space-y-3">
                    
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $loc['code'] }}
                                </span>
                                <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    {{ $loc['city'] }}
                                </span>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-[var(--text)] tracking-tight mt-1 group-hover:text-[var(--accent)] transition-colors">
                                {{ $loc['name'] }}
                            </h3>
                        </div>

                        <!-- Status Badge -->
                        @if($loc['status'] === 'Optimal')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Operational
                            </span>
                        @elseif($loc['status'] === 'Attention Required')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200 shrink-0" title="{{ $loc['issue_notice'] ?? 'Hardware check needed' }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                Attention Req.
                            </span>
                        @elseif($loc['status'] === 'Maintenance')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                Maintenance
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 border border-slate-200 shrink-0">
                                Inactive
                            </span>
                        @endif
                    </div>

                    <!-- Address & Zone -->
                    <p class="text-xs text-[var(--text-muted)] line-clamp-2 leading-relaxed">
                        {{ $loc['address'] }}
                        @if(!empty($loc['postal_code']))
                            · <span class="text-slate-400">{{ $loc['postal_code'] }}</span>
                        @endif
                    </p>

                    @if(!empty($loc['issue_notice']))
                    <div class="p-2.5 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-2 text-xs text-amber-800">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="shrink-0 text-amber-600 mt-0.5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span class="text-[11px] font-medium leading-tight">{{ $loc['issue_notice'] }}</span>
                    </div>
                    @endif

                </div>

                <!-- Card Body: Capacity & Telemetry -->
                <div class="p-5 space-y-4">
                    
                    <!-- Capacity & Occupancy Visualization -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                            <span class="text-slate-500">Live Space Utilization</span>
                            <span class="text-[var(--text)] font-bold">
                                {{ $loc['occupied'] }} / {{ $loc['total_capacity'] }} ({{ $loc['occupancy_rate'] }}%)
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden flex">
                            <div class="h-2 rounded-full {{ $loc['occupancy_rate'] > 85 ? 'bg-amber-500' : 'bg-[var(--accent)]' }}" 
                                 style="width: {{ min(100, $loc['occupancy_rate']) }}%"></div>
                        </div>

                        <!-- 3-Pill Breakdown -->
                        <div class="grid grid-cols-3 gap-2 mt-2.5 text-center">
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="text-[10px] font-bold uppercase text-slate-400">Occupied</div>
                                <div class="text-xs font-bold text-slate-800 mt-0.5">{{ $loc['occupied'] }}</div>
                            </div>
                            <div class="p-2 rounded-xl bg-emerald-50 border border-emerald-100">
                                <div class="text-[10px] font-bold uppercase text-emerald-600">Available</div>
                                <div class="text-xs font-extrabold text-emerald-700 mt-0.5">{{ $loc['available'] }}</div>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="text-[10px] font-bold uppercase text-slate-400">Total Slots</div>
                                <div class="text-xs font-bold text-slate-800 mt-0.5">{{ $loc['total_capacity'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hardware Telemetry & Parking Types -->
                    <div class="pt-3 border-t border-slate-100 space-y-2.5">
                        
                        <!-- Hardware Status -->
                        <div class="flex items-center justify-between text-xs text-slate-600">
                            <div class="flex items-center gap-1.5">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span>Barrier Gates:</span>
                                <span class="font-bold text-slate-800">{{ $loc['gates_online'] ?? $loc['gates_count'] }}/{{ $loc['gates_count'] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                <span>ANPR:</span>
                                <span class="font-bold {{ ($loc['cameras_online'] ?? $loc['cameras_count']) < $loc['cameras_count'] ? 'text-amber-600' : 'text-slate-800' }}">
                                    {{ $loc['cameras_online'] ?? $loc['cameras_count'] }}/{{ $loc['cameras_count'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Vehicle Types Supported -->
                        <div class="flex flex-wrap items-center gap-1.5">
                            @foreach($loc['parking_types'] ?? ['Car', 'Motorcycle'] as $ptype)
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $ptype }}
                                </span>
                            @endforeach
                            @if(!empty($loc['operating_hours']))
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-medium bg-blue-50 text-[var(--accent)] border border-blue-100 ml-auto">
                                    {{ $loc['operating_hours'] }}
                                </span>
                            @endif
                        </div>

                    </div>

                    <!-- Contact & Sync Meta -->
                    <div class="pt-2 text-[11px] text-slate-400 flex items-center justify-between border-t border-slate-50">
                        <span class="truncate">Contact: {{ $loc['contact_person'] ?? 'Supervisor' }}</span>
                        <span class="shrink-0 text-slate-400">{{ $loc['last_updated'] ?? 'Synced' }}</span>
                    </div>

                </div>

                <!-- Card Footer / Actions -->
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                    
                    <!-- Inspect / Technical Drawer Trigger -->
                    <button type="button" 
                            onclick="openLocationDetailsModal('{{ $loc['id'] }}')" 
                            class="px-3 py-1.5 rounded-xl border border-[var(--border)] bg-white text-slate-700 hover:text-[var(--primary)] hover:border-slate-300 text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span>Telemetry</span>
                    </button>

                    <div class="flex items-center gap-1.5">
                        <!-- Quick Status Toggle -->
                        <button type="button"
                                onclick="openStatusConfirmModal('{{ $loc['id'] }}', '{{ $loc['name'] }}', '{{ $loc['status'] }}')"
                                class="p-1.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors cursor-pointer"
                                title="Change Operational Status">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        </button>

                        <!-- Edit Button -->
                        <button type="button"
                                onclick="openEditLocationModal('{{ $loc['id'] }}')"
                                class="px-3 py-1.5 rounded-xl bg-white border border-[var(--border)] hover:border-slate-300 text-slate-700 hover:text-[var(--primary)] text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            <span>Edit</span>
                        </button>

                        <!-- Manage Areas (Page 22) -->
                        <a href="/vendor/parking-areas?facility={{ $loc['id'] }}" 
                           class="px-3 py-1.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-2xs flex items-center gap-1 cursor-pointer"
                           title="Manage facility subdivisions & parking areas">
                            <span>Areas</span>
                            <span class="text-[9px] opacity-70">&rarr;</span>
                        </a>
                    </div>

                </div>

            </div>
            @endforeach
        </div>
    @endif

    <!-- ================= ADD LOCATION MODAL ================= -->
    <div id="modal-add-location" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAddLocationModal()"></div>
        
        <!-- Modal Dialog -->
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden animate-scale-up">
                
                <!-- Header -->
                <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                    <div>
                        <h3 class="text-base font-bold text-[var(--text)]">Add New Parking Facility</h3>
                        <p class="text-xs text-[var(--text-muted)]">Provision a newly authorized location under tenant {{ $tenant['company_name'] }}</p>
                    </div>
                    <button type="button" onclick="closeAddLocationModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Form -->
                <form method="POST" action="/vendor/locations" id="form-add-location" class="p-6 space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Facility Name -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Facility Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   required 
                                   placeholder="e.g. Pondok Indah Mall 3 Sky Parking" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Location Code -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Location Code <span class="text-slate-400 font-normal">(Optional)</span>
                            </label>
                            <input type="text" 
                                   name="code" 
                                   placeholder="e.g. LOC-PIM-03" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800 font-mono">
                        </div>

                        <!-- City / District -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                City / District <span class="text-red-500">*</span>
                            </label>
                            <select name="city" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                <option value="Jakarta Barat">Jakarta Barat</option>
                                <option value="Jakarta Utara">Jakarta Utara</option>
                                <option value="Jakarta Timur">Jakarta Timur</option>
                                <option value="Tangerang">Tangerang</option>
                                <option value="Bekasi">Bekasi</option>
                            </select>
                        </div>

                        <!-- Full Street Address -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Full Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="address" 
                                   required 
                                   placeholder="e.g. Jl. Metro Pondok Indah Blok III-B, Pondok Pinang" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Total Capacity -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Total Slot Capacity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="total_capacity" 
                                   required 
                                   min="10" 
                                   max="5000" 
                                   value="300"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Operating Hours -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Operating Hours
                            </label>
                            <input type="text" 
                                   name="operating_hours" 
                                   value="24 Hours"
                                   placeholder="e.g. 24 Hours or 06:00 - 24:00" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Contact Person -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Duty Supervisor Name
                            </label>
                            <input type="text" 
                                   name="contact_person" 
                                   placeholder="e.g. Rudi Hermawan" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Contact Phone -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Supervisor Phone
                            </label>
                            <input type="text" 
                                   name="contact_phone" 
                                   placeholder="e.g. +62 812-8899-0012" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Barrier Gates & Cameras -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Barrier Gates Count
                            </label>
                            <input type="number" 
                                   name="gates_count" 
                                   value="2" 
                                   min="1" 
                                   max="20"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                ANPR Cameras Count
                            </label>
                            <input type="number" 
                                   name="cameras_count" 
                                   value="2" 
                                   min="1" 
                                   max="20"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Supported Parking Types -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Supported Vehicle Types
                            </label>
                            <div class="flex flex-wrap gap-4 text-xs font-medium text-slate-700">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="parking_types[]" value="Car" checked class="rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <span>Passenger Cars</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="parking_types[]" value="Motorcycle" checked class="rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <span>Motorcycles</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="parking_types[]" value="EV Hub" checked class="rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <span>EV Charging Bays</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="parking_types[]" value="Valet VIP" class="rounded text-[var(--primary)] focus:ring-[var(--primary)]">
                                    <span>Valet & VIP Lane</span>
                                </label>
                            </div>
                        </div>

                        <!-- Operational Status -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Initial Operational Status
                            </label>
                            <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Ready for active traffic)</option>
                                <option value="Maintenance">Under Maintenance (Gates restricted)</option>
                                <option value="Inactive">Inactive / Pending Launch</option>
                            </select>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                        <button type="button" onclick="closeAddLocationModal()" class="px-4 py-2.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs">
                            Register Facility
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= EDIT LOCATION MODAL ================= -->
    <div id="modal-edit-location" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeEditLocationModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden animate-scale-up">
                
                <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                    <div>
                        <h3 class="text-base font-bold text-[var(--text)]">Edit Parking Facility</h3>
                        <p class="text-xs text-[var(--text-muted)]" id="edit-facility-subtitle">Update location configuration and capacity</p>
                    </div>
                    <button type="button" onclick="closeEditLocationModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form method="POST" id="form-edit-location" action="" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Facility Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="edit-name" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                City / District <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city" id="edit-city" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Total Slot Capacity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="total_capacity" id="edit-total-capacity" min="10" max="5000" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Full Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="address" id="edit-address" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Operating Hours
                            </label>
                            <input type="text" name="operating_hours" id="edit-operating-hours" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Operational Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="edit-status" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Operational)</option>
                                <option value="Attention Required">Attention Required</option>
                                <option value="Maintenance">Under Maintenance</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Duty Supervisor
                            </label>
                            <input type="text" name="contact_person" id="edit-contact-person" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Supervisor Phone
                            </label>
                            <input type="text" name="contact_phone" id="edit-contact-phone" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                    </div>

                    <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                        <button type="button" onclick="closeEditLocationModal()" class="px-4 py-2.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= STATUS CONFIRM MODAL ================= -->
    <div id="modal-status-confirm" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeStatusConfirmModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl max-w-md w-full shadow-2xl overflow-hidden animate-scale-up">
                
                <div class="p-6 text-center space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 mx-auto flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                    </div>
                    <h3 class="text-base font-bold text-[var(--text)]">Change Operational Status</h3>
                    <p class="text-xs text-[var(--text-muted)] leading-relaxed">
                        Update the operational mode for <strong id="status-modal-facility-name" class="text-slate-800"></strong>. Changing this status will immediately impact gate access controls and customer navigation.
                    </p>

                    <form method="POST" id="form-toggle-status" action="" class="space-y-4 pt-2">
                        @csrf
                        @method('PATCH')

                        <div class="text-left">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Select New Status
                            </label>
                            <select name="status" id="status-select-action" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Normal Automated Operations)</option>
                                <option value="Attention Required">Attention Required (Sensors Under Observation)</option>
                                <option value="Maintenance">Under Maintenance (Restrict Automated Lanes)</option>
                                <option value="Inactive">Inactive (Full Facility Shutdown)</option>
                            </select>
                        </div>

                        <div class="pt-2 flex items-center justify-center gap-3">
                            <button type="button" onclick="closeStatusConfirmModal()" class="w-full py-2.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all">
                                Cancel
                            </button>
                            <button type="submit" class="w-full py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs">
                                Confirm Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= TECHNICAL TELEMETRY DRAWER ================= -->
    <div id="drawer-location-details" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeLocationDetailsModal()"></div>
        <div class="fixed top-0 bottom-0 right-0 max-w-lg w-full bg-[var(--surface)] shadow-2xl z-10 flex flex-col overflow-hidden animate-slide-left">
            
            <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Telemetry & Hardware Hub</span>
                </div>
                <button type="button" onclick="closeLocationDetailsModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6" id="drawer-telemetry-content">
                <!-- Loaded dynamically by JS -->
                <div class="flex items-center justify-center py-12 text-slate-400">
                    <svg class="animate-spin h-6 w-6 text-[var(--accent)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center justify-between">
                <span class="text-xs text-slate-400">Live IoT Gateway Protocol v2.4</span>
                <button type="button" onclick="closeLocationDetailsModal()" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold">
                    Close
                </button>
            </div>

        </div>
    </div>

@push('scripts')
<script>
    // Global data cache for modal population
    const facilitiesMap = @json(collect($locations)->keyBy('id'));

    // Add Location Modal
    function openAddLocationModal() {
        document.getElementById('modal-add-location').classList.remove('hidden');
    }
    function closeAddLocationModal() {
        document.getElementById('modal-add-location').classList.add('hidden');
    }

    // Edit Location Modal
    function openEditLocationModal(id) {
        const fac = facilitiesMap[id];
        if (!fac) return;

        document.getElementById('edit-facility-subtitle').textContent = `Configuring ${fac.name} (${fac.code})`;
        document.getElementById('form-edit-location').action = `/vendor/locations/${id}`;
        document.getElementById('edit-name').value = fac.name;
        document.getElementById('edit-city').value = fac.city;
        document.getElementById('edit-total-capacity').value = fac.total_capacity;
        document.getElementById('edit-address').value = fac.address;
        document.getElementById('edit-operating-hours').value = fac.operating_hours || '24 Hours';
        document.getElementById('edit-status').value = fac.status;
        document.getElementById('edit-contact-person').value = fac.contact_person || '';
        document.getElementById('edit-contact-phone').value = fac.contact_phone || '';

        document.getElementById('modal-edit-location').classList.remove('hidden');
    }
    function closeEditLocationModal() {
        document.getElementById('modal-edit-location').classList.add('hidden');
    }

    // Status Toggle Modal
    function openStatusConfirmModal(id, name, currentStatus) {
        document.getElementById('status-modal-facility-name').textContent = name;
        document.getElementById('form-toggle-status').action = `/vendor/locations/${id}/status`;
        document.getElementById('status-select-action').value = currentStatus;
        document.getElementById('modal-status-confirm').classList.remove('hidden');
    }
    function closeStatusConfirmModal() {
        document.getElementById('modal-status-confirm').classList.add('hidden');
    }

    // Telemetry Drawer
    function openLocationDetailsModal(id) {
        const fac = facilitiesMap[id];
        const container = document.getElementById('drawer-telemetry-content');
        const drawer = document.getElementById('drawer-location-details');

        if (!fac) return;

        container.innerHTML = `
            <div class="space-y-5">
                <div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600 border border-slate-200">${fac.code}</span>
                    <h2 class="text-xl font-extrabold text-slate-900 mt-1">${fac.name}</h2>
                    <p class="text-xs text-slate-500 mt-0.5">${fac.address}, ${fac.city}</p>
                </div>

                <!-- Status Banner -->
                <div class="p-3.5 rounded-xl ${fac.status === 'Optimal' ? 'bg-emerald-50 border border-emerald-200 text-emerald-800' : 'bg-amber-50 border border-amber-200 text-amber-800'} flex items-center justify-between text-xs">
                    <span class="font-bold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full ${fac.status === 'Optimal' ? 'bg-emerald-500' : 'bg-amber-500'}"></span>
                        Status: ${fac.status}
                    </span>
                    <span class="font-mono text-[11px]">${fac.last_updated || 'Active'}</span>
                </div>

                <!-- Capacity Breakdown -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Capacity & Occupancy</h4>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Total Capacity</span>
                            <span class="text-base font-extrabold text-slate-800">${fac.total_capacity} Slots</span>
                        </div>
                        <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200">
                            <span class="text-emerald-600 block text-[10px] uppercase font-bold">Available Now</span>
                            <span class="text-base font-extrabold text-emerald-700">${fac.available} Slots</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Occupancy Rate</span>
                            <span class="text-base font-extrabold text-slate-800">${fac.occupancy_rate}%</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Active Sessions</span>
                            <span class="text-base font-extrabold text-slate-800">${fac.active_sessions || Math.round(fac.occupied * 0.96)}</span>
                        </div>
                    </div>
                </div>

                <!-- Hardware Connectivity -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Barrier Gates & ANPR Nodes</h4>
                    <div class="space-y-2 text-xs">
                        <div class="p-3 rounded-xl border border-slate-200 bg-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="font-bold text-slate-700">Barrier Gates Controller</span>
                            </div>
                            <span class="font-bold text-emerald-600">${fac.gates_online || fac.gates_count} / ${fac.gates_count} Online</span>
                        </div>
                        <div class="p-3 rounded-xl border border-slate-200 bg-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full ${(fac.cameras_online || fac.cameras_count) < fac.cameras_count ? 'bg-amber-500' : 'bg-emerald-500'}"></span>
                                <span class="font-bold text-slate-700">ANPR Vision Units</span>
                            </div>
                            <span class="font-bold ${(fac.cameras_online || fac.cameras_count) < fac.cameras_count ? 'text-amber-600' : 'text-emerald-600'}">
                                ${fac.cameras_online || fac.cameras_count} / ${fac.cameras_count} Online
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Traffic Today -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Today's Traffic & Revenue</h4>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs">
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="text-[10px] font-bold text-slate-400 uppercase">Entries</div>
                            <div class="font-bold text-slate-800 mt-0.5">${fac.today_entries ? Number(fac.today_entries).toLocaleString('id-ID') : '1.204'}</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="text-[10px] font-bold text-slate-400 uppercase">Exits</div>
                            <div class="font-bold text-slate-800 mt-0.5">${fac.today_exits ? Number(fac.today_exits).toLocaleString('id-ID') : '980'}</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-blue-50 border border-blue-100">
                            <div class="text-[10px] font-bold text-[var(--accent)] uppercase">Revenue</div>
                            <div class="font-extrabold text-[var(--accent)] mt-0.5">${fac.formatted_revenue || 'Rp 14.200.000'}</div>
                        </div>
                    </div>
                </div>

                <!-- Site Contact Details -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs space-y-1">
                    <div class="text-[10px] font-bold uppercase text-slate-400">On-Site Management</div>
                    <div class="font-bold text-slate-800">${fac.contact_person || 'Ahmad Fauzi (Supervisor)'}</div>
                    <div class="text-slate-500">${fac.contact_phone || '+62 812-9844-1102'}</div>
                    <div class="text-slate-400 text-[11px] mt-1">Zone allocation: ${fac.zone || 'Zone A, B & Basement'}</div>
                </div>
            </div>
        `;

        drawer.classList.remove('hidden');
    }
    function closeLocationDetailsModal() {
        document.getElementById('drawer-location-details').classList.add('hidden');
    }

    // Keyboard support: Close modals on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddLocationModal();
            closeEditLocationModal();
            closeStatusConfirmModal();
            closeLocationDetailsModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
