<x-layouts.vendor activeNav="areas" title="Parking Area Management - NusaPark Enterprise">

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

    <!-- ================= FACILITY SELECTOR BAR ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-sm shadow-xs shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Active Managed Facility</div>
                <div class="text-sm sm:text-base font-extrabold text-[var(--text)] flex items-center gap-2">
                    <span>{{ $selectedFacility['name'] ?? 'Facility' }}</span>
                    @if($selectedFacility)
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600 border border-slate-200">
                        {{ $selectedFacility['code'] ?? 'LOC' }}
                    </span>
                    @endif
                </div>
                <div class="text-xs text-[var(--text-muted)] flex items-center gap-2 mt-0.5">
                    <span>{{ $selectedFacility['city'] ?? '' }}</span>
                    <span>•</span>
                    <span>Total Facility Capacity: <strong>{{ number_format($selectedFacility['total_capacity'] ?? 0, 0, ',', '.') }}</strong> Slots</span>
                </div>
            </div>
        </div>

        <!-- Facility Switcher Dropdown -->
        <div class="flex items-center gap-2.5">
            <label for="facility-switcher" class="text-xs font-bold text-slate-500 hidden sm:inline">Switch Site:</label>
            <div class="relative min-w-[220px]">
                <select id="facility-switcher" 
                        onchange="window.location.href = '/vendor/parking-areas?facility=' + this.value"
                        class="w-full pl-3 pr-8 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($selectedFacility['id'] ?? '') === $f['id'] ? 'selected' : '' }}>
                            {{ $f['name'] }} ({{ $f['city'] }})
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="/vendor/locations" class="p-2 rounded-xl border border-[var(--border)] text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 text-xs font-semibold transition-colors" title="Manage all facilities">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            </a>
        </div>
    </div>

    <!-- ================= PAGE HEADER ================= -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-2 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)] font-medium mb-1">
                <span>Vendor Portal</span>
                <span class="text-slate-300">/</span>
                <span>Operations</span>
                <span class="text-slate-300">/</span>
                <a href="/vendor/locations" class="hover:underline">Locations</a>
                <span class="text-slate-300">/</span>
                <span class="text-[var(--primary)] font-semibold">Parking Area</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    Parking Areas
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                    {{ count($areas) }} of {{ $metrics['total_areas'] ?? 0 }} Areas Showing
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 hidden sm:inline">
                    {{ $selectedFacility['name'] }}
                </span>
            </div>
            <p class="text-sm text-[var(--text-muted)] mt-1.5 max-w-3xl">
                Configure and maintain parking area subdivisions, floor levels, dedicated zoning, and slot capacities within {{ $selectedFacility['name'] }}.
            </p>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center gap-2.5 shrink-0">
            <!-- Refresh Action -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 sm:px-3 sm:py-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-slate-700 hover:text-[var(--primary)] hover:border-slate-300 text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer"
                    title="Refresh Areas">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="hover:rotate-180 transition-transform duration-500">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>

            <!-- Add Area Action (Modal Trigger) -->
            <button type="button"
                    onclick="openAddAreaModal()"
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer active:scale-98">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Add Parking Area</span>
            </button>
        </div>
    </div>

    <!-- ================= SUMMARY METRICS ROW ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        
        <!-- Total Configured Areas -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Configured Areas</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-[var(--accent)] flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    {{ $metrics['total_areas'] ?? 0 }}
                </div>
                <div class="text-[11px] text-[var(--text-muted)] font-medium mt-0.5">
                    Zoned subdivisions in this site
                </div>
            </div>
        </div>

        <!-- Operational Areas -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Operational Areas</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600 tracking-tight">
                    {{ $metrics['active_areas'] ?? 0 }}
                </div>
                <div class="flex items-center gap-1.5 text-[11px] text-emerald-700 font-medium mt-0.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Ready for inbound traffic</span>
                </div>
            </div>
        </div>

        <!-- Capacity Allocation & Integrity -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Capacity Allocation</span>
                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-baseline justify-between">
                    <span class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                        {{ number_format($metrics['allocated_capacity'] ?? 0, 0, ',', '.') }}
                    </span>
                    <span class="text-[11px] font-bold text-slate-500">
                        / {{ number_format($metrics['facility_capacity'] ?? 0, 0, ',', '.') }} Slots
                    </span>
                </div>
                <!-- Micro Allocation Integrity Bar -->
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden flex">
                    <div class="h-1.5 rounded-full {{ ($metrics['is_fully_allocated'] ?? false) ? 'bg-emerald-500' : 'bg-amber-500' }}" 
                         style="width: {{ min(100, $metrics['allocation_rate'] ?? 100) }}%"></div>
                </div>
                <div class="text-[11px] text-[var(--text-muted)] font-medium mt-1 flex items-center justify-between">
                    <span>{{ $metrics['allocation_rate'] ?? 100 }}% allocated</span>
                    <span class="text-emerald-700 font-bold">100% Balanced</span>
                </div>
            </div>
        </div>

        <!-- Space Occupancy / Availability -->
        <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider">Live Availability</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600 tracking-tight">
                        {{ number_format($metrics['total_available'] ?? 0, 0, ',', '.') }}
                    </span>
                    <span class="text-xs font-bold text-slate-500">
                        {{ number_format($metrics['total_occupied'] ?? 0, 0, ',', '.') }} Occ.
                    </span>
                </div>
                <!-- Micro Occupancy Bar -->
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden flex">
                    <div class="bg-[var(--accent)] h-1.5 rounded-full" style="width: {{ $metrics['occupancy_rate'] ?? 0 }}%"></div>
                </div>
                <div class="text-[11px] text-[var(--text-muted)] font-medium mt-1">
                    {{ $metrics['occupancy_rate'] ?? 0 }}% active space load
                </div>
            </div>
        </div>

    </div>

    <!-- ================= SEARCH, FILTER & TOOLBAR ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <form method="GET" action="/vendor/parking-areas" id="area-filters-form" class="space-y-3">
            <!-- Retain current facility context -->
            <input type="hidden" name="facility" value="{{ $selectedFacility['id'] }}">

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
                           placeholder="Search area name, code, floor, description..." 
                           class="w-full pl-10 pr-9 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-800 placeholder-slate-400">
                    @if($filters['q'])
                    <a href="/vendor/parking-areas?{{ http_build_query(array_merge($filters, ['facility' => $selectedFacility['id'], 'q' => ''])) }}" 
                       class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600"
                       title="Clear search">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                    @endif
                </div>

                <!-- Area Type Filter -->
                <div class="md:col-span-2">
                    <select name="type" 
                            id="filter-type" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-700">
                        <option value="all" {{ $filters['type'] === 'all' ? 'selected' : '' }}>All Area Types</option>
                        <option value="Basement" {{ $filters['type'] === 'Basement' ? 'selected' : '' }}>Basement</option>
                        <option value="Above-Ground / Indoor" {{ $filters['type'] === 'Above-Ground / Indoor' ? 'selected' : '' }}>Indoor / Above-Ground</option>
                        <option value="Outdoor / Surface" {{ $filters['type'] === 'Outdoor / Surface' ? 'selected' : '' }}>Outdoor Surface</option>
                        <option value="EV Charging Zone" {{ $filters['type'] === 'EV Charging Zone' ? 'selected' : '' }}>EV Charging Zone</option>
                        <option value="VIP / Valet Area" {{ $filters['type'] === 'VIP / Valet Area' ? 'selected' : '' }}>VIP / Valet Area</option>
                        <option value="Motorcycle Zone" {{ $filters['type'] === 'Motorcycle Zone' ? 'selected' : '' }}>Motorcycle Zone</option>
                    </select>
                </div>

                <!-- Floor / Level Filter -->
                <div class="md:col-span-2">
                    <select name="floor" 
                            id="filter-floor" 
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all text-slate-700">
                        <option value="all" {{ $filters['floor'] === 'all' ? 'selected' : '' }}>All Floors / Levels</option>
                        @foreach($floors as $fl)
                            <option value="{{ $fl }}" {{ $filters['floor'] === $fl ? 'selected' : '' }}>{{ $fl }}</option>
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
                        <option value="capacity_asc" {{ $filters['sort'] === 'capacity_asc' ? 'selected' : '' }}>Capacity: Low to High</option>
                        <option value="floor_asc" {{ $filters['sort'] === 'floor_asc' ? 'selected' : '' }}>Floor Level</option>
                        <option value="updated_desc" {{ $filters['sort'] === 'updated_desc' ? 'selected' : '' }}>Recently Updated</option>
                    </select>
                </div>

                <!-- Submit / Clear Buttons -->
                <div class="md:col-span-1 flex items-center gap-1.5">
                    <button type="submit" 
                            class="w-full py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all text-center cursor-pointer">
                        Filter
                    </button>
                </div>

            </div>

            <!-- Active Filter Chips -->
            @php
                $hasActiveFilters = ($filters['q'] !== '') || ($filters['type'] !== 'all') || ($filters['status'] !== 'all') || ($filters['floor'] !== 'all') || ($filters['sort'] !== 'name_asc');
            @endphp

            @if($hasActiveFilters)
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100 text-xs">
                <span class="text-slate-400 font-medium">Active filters:</span>
                
                @if($filters['q'])
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-[var(--accent)] font-semibold border border-blue-200">
                    Query: "{{ $filters['q'] }}"
                    <a href="/vendor/parking-areas?{{ http_build_query(array_merge($filters, ['facility' => $selectedFacility['id'], 'q' => ''])) }}" class="hover:text-blue-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                @if($filters['type'] !== 'all')
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold border border-slate-200">
                    Type: {{ $filters['type'] }}
                    <a href="/vendor/parking-areas?{{ http_build_query(array_merge($filters, ['facility' => $selectedFacility['id'], 'type' => 'all'])) }}" class="hover:text-slate-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                @if($filters['floor'] !== 'all')
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold border border-slate-200">
                    Floor: {{ $filters['floor'] }}
                    <a href="/vendor/parking-areas?{{ http_build_query(array_merge($filters, ['facility' => $selectedFacility['id'], 'floor' => 'all'])) }}" class="hover:text-slate-900">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </span>
                @endif

                <a href="/vendor/parking-areas?facility={{ $selectedFacility['id'] }}" class="text-xs text-[var(--accent)] hover:underline font-bold ml-1">
                    Reset All Filters
                </a>
            </div>
            @endif

        </form>
    </div>

    <!-- ================= PARKING AREAS GRID / LIST ================= -->
    @if(empty($areas))
        <!-- Empty Results State -->
        <div class="p-8 sm:p-12 rounded-2xl bg-[var(--surface)] border border-[var(--border)] text-center shadow-xs">
            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
            </div>
            <h3 class="text-base font-bold text-[var(--text)]">No parking areas match your criteria</h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-1 max-w-md mx-auto">
                No configured parking areas matched the specified query or filters for {{ $selectedFacility['name'] }}. Try resetting your filters or create a new parking area.
            </p>
            <div class="mt-5 flex items-center justify-center gap-3">
                <a href="/vendor/parking-areas?facility={{ $selectedFacility['id'] }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all">
                    Reset Filters
                </a>
                <button type="button" onclick="openAddAreaModal()" class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all">
                    Add New Area
                </button>
            </div>
        </div>
    @else
        <!-- Grid of Area Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($areas as $area)
            <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] hover:border-slate-300 transition-all shadow-xs hover:shadow-md flex flex-col justify-between overflow-hidden group">
                
                <!-- Card Header -->
                <div class="p-5 border-b border-slate-100 space-y-3">
                    
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $area['code'] }}
                                </span>
                                <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    {{ $area['floor'] }}
                                </span>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-[var(--text)] tracking-tight mt-1 group-hover:text-[var(--accent)] transition-colors">
                                {{ $area['name'] }}
                            </h3>
                        </div>

                        <!-- Status Badge -->
                        @if($area['status'] === 'Optimal')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                        @elseif($area['status'] === 'Attention Required')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                Attention Req.
                            </span>
                        @elseif($area['status'] === 'Maintenance')
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

                    <!-- Area Type & Description -->
                    <p class="text-xs text-[var(--text-muted)] line-clamp-2 leading-relaxed">
                        {{ $area['description'] ?? 'Designated operational zone with live ANPR guidance sensors.' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-2 pt-1">
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                            {{ $area['type'] }}
                        </span>
                        @if(!empty($area['gates_assigned']))
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200 truncate max-w-[200px]" title="Assigned gates">
                            Gates: {{ $area['gates_assigned'] }}
                        </span>
                        @endif
                    </div>

                </div>

                <!-- Card Body: Capacity & Space Utilization -->
                <div class="p-5 space-y-4">
                    
                    @php
                        $occRate = $area['capacity'] > 0 ? round(($area['occupied'] / $area['capacity']) * 100, 1) : 0;
                    @endphp

                    <div>
                        <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                            <span class="text-slate-500">Area Slot Utilization</span>
                            <span class="text-[var(--text)] font-bold">
                                {{ $area['occupied'] }} / {{ $area['capacity'] }} ({{ $occRate }}%)
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden flex">
                            <div class="h-2 rounded-full {{ $occRate > 85 ? 'bg-amber-500' : 'bg-[var(--accent)]' }}" 
                                 style="width: {{ min(100, $occRate) }}%"></div>
                        </div>

                        <!-- 3-Pill Breakdown -->
                        <div class="grid grid-cols-3 gap-2 mt-2.5 text-center">
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="text-[10px] font-bold uppercase text-slate-400">Occupied</div>
                                <div class="text-xs font-bold text-slate-800 mt-0.5">{{ $area['occupied'] }}</div>
                            </div>
                            <div class="p-2 rounded-xl bg-emerald-50 border border-emerald-100">
                                <div class="text-[10px] font-bold uppercase text-emerald-600">Available</div>
                                <div class="text-xs font-extrabold text-emerald-700 mt-0.5">{{ $area['available'] }}</div>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="text-[10px] font-bold uppercase text-slate-400">Capacity</div>
                                <div class="text-xs font-bold text-slate-800 mt-0.5">{{ $area['capacity'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sync Meta -->
                    <div class="pt-2 text-[11px] text-slate-400 flex items-center justify-between border-t border-slate-50">
                        <span class="truncate">Parent: {{ $selectedFacility['name'] }}</span>
                        <span class="shrink-0 text-slate-400">{{ $area['last_updated'] ?? 'Synced' }}</span>
                    </div>

                </div>

                <!-- Card Footer / Actions -->
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                    
                    <!-- Inspect / Telemetry -->
                    <button type="button" 
                            onclick="openAreaDetailsModal('{{ $area['id'] }}')" 
                            class="px-3 py-1.5 rounded-xl border border-[var(--border)] bg-white text-slate-700 hover:text-[var(--primary)] hover:border-slate-300 text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span>Telemetry</span>
                    </button>

                    <div class="flex items-center gap-1.5">
                        <!-- Quick Status Toggle -->
                        <button type="button"
                                onclick="openStatusConfirmModal('{{ $area['id'] }}', '{{ $area['name'] }}', '{{ $area['status'] }}')"
                                class="p-1.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors cursor-pointer"
                                title="Change Area Status">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        </button>

                        <!-- Edit Button -->
                        <button type="button"
                                onclick="openEditAreaModal('{{ $area['id'] }}')"
                                class="px-3 py-1.5 rounded-xl bg-white border border-[var(--border)] hover:border-slate-300 text-slate-700 hover:text-[var(--primary)] text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            <span>Edit</span>
                        </button>

                        <!-- View Map Link (Page 23) -->
                        <a href="/vendor/parking-map?facility={{ $selectedFacility['id'] }}&area={{ $area['id'] }}" 
                           class="p-1.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors cursor-pointer"
                           title="Inspect Internal Parking Map">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                        </a>

                        <!-- Manage Slots Link (Page 24) -->
                        <a href="/vendor/parking-slots?facility={{ $selectedFacility['id'] }}&area={{ $area['id'] }}" 
                           class="px-3 py-1.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-2xs flex items-center gap-1 cursor-pointer"
                           title="Manage individual parking bays & sensors">
                            <span>Slots</span>
                            <span class="text-[9px] opacity-70">&rarr;</span>
                        </a>
                    </div>

                </div>

            </div>
            @endforeach
        </div>
    @endif

    <!-- ================= ADD PARKING AREA MODAL ================= -->
    <div id="modal-add-area" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAddAreaModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden animate-scale-up">
                
                <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                    <div>
                        <h3 class="text-base font-bold text-[var(--text)]">Add New Parking Area</h3>
                        <p class="text-xs text-[var(--text-muted)]">Configure a subdivision zone for {{ $selectedFacility['name'] }}</p>
                    </div>
                    <button type="button" onclick="closeAddAreaModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form method="POST" action="/vendor/parking-areas" id="form-add-area" class="p-6 space-y-4">
                    @csrf
                    <!-- Scoped to active facility -->
                    <input type="hidden" name="facility_id" value="{{ $selectedFacility['id'] }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Area Name -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Area Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   required 
                                   placeholder="e.g. Basement 3 - EV Stalls & Fleet" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Area Code -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Area Code <span class="text-slate-400 font-normal">(Optional)</span>
                            </label>
                            <input type="text" 
                                   name="code" 
                                   placeholder="e.g. AREA-XYZ-B3" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800 font-mono">
                        </div>

                        <!-- Floor Level -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Floor / Level <span class="text-red-500">*</span>
                            </label>
                            <select name="floor" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Basement 1">Basement 1</option>
                                <option value="Basement 2">Basement 2</option>
                                <option value="Basement 3">Basement 3</option>
                                <option value="Ground Floor">Ground Floor</option>
                                <option value="Ground / Outdoor">Ground / Outdoor</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                                <option value="Rooftop">Rooftop</option>
                            </select>
                        </div>

                        <!-- Area Type -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Area Type <span class="text-red-500">*</span>
                            </label>
                            <select name="type" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Basement">Basement</option>
                                <option value="Above-Ground / Indoor">Above-Ground / Indoor</option>
                                <option value="Outdoor / Surface">Outdoor / Surface</option>
                                <option value="EV Charging Zone">EV Charging Zone</option>
                                <option value="VIP / Valet Area">VIP / Valet Area</option>
                                <option value="Motorcycle Zone">Motorcycle Zone</option>
                            </select>
                        </div>

                        <!-- Configured Slot Capacity -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Slot Capacity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="capacity" 
                                   required 
                                   min="5" 
                                   max="2000" 
                                   value="50"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Assigned Gates -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Assigned Gates / Access
                            </label>
                            <input type="text" 
                                   name="gates_assigned" 
                                   placeholder="e.g. Entry Gate 2, Exit Gate 2" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <!-- Initial Status -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Operational Status
                            </label>
                            <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Ready for active traffic)</option>
                                <option value="Maintenance">Under Maintenance (Gates restricted)</option>
                                <option value="Inactive">Inactive / Offline</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Description & Technical Notes
                            </label>
                            <textarea name="description" 
                                      rows="2" 
                                      placeholder="e.g. High turnover visitor bay, equipped with overhead LED bay sensors and smart ANPR lane guidance."
                                      class="w-full px-3.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800"></textarea>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                        <button type="button" onclick="closeAddAreaModal()" class="px-4 py-2.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs">
                            Configure Area
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= EDIT PARKING AREA MODAL ================= -->
    <div id="modal-edit-area" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeEditAreaModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden animate-scale-up">
                
                <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                    <div>
                        <h3 class="text-base font-bold text-[var(--text)]">Edit Parking Area</h3>
                        <p class="text-xs text-[var(--text-muted)]" id="edit-area-subtitle">Update parking area details and capacity</p>
                    </div>
                    <button type="button" onclick="closeEditAreaModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form method="POST" id="form-edit-area" action="" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Area Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="edit-area-name" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Floor / Level <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="floor" id="edit-area-floor" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Area Type <span class="text-red-500">*</span>
                            </label>
                            <select name="type" id="edit-area-type" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Basement">Basement</option>
                                <option value="Above-Ground / Indoor">Above-Ground / Indoor</option>
                                <option value="Outdoor / Surface">Outdoor / Surface</option>
                                <option value="EV Charging Zone">EV Charging Zone</option>
                                <option value="VIP / Valet Area">VIP / Valet Area</option>
                                <option value="Motorcycle Zone">Motorcycle Zone</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Slot Capacity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="capacity" id="edit-area-capacity" min="5" max="2000" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Operational Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="edit-area-status" required class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Active)</option>
                                <option value="Attention Required">Attention Required</option>
                                <option value="Maintenance">Under Maintenance</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Assigned Gates / Access
                            </label>
                            <input type="text" name="gates_assigned" id="edit-area-gates" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Description
                            </label>
                            <textarea name="description" id="edit-area-description" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800"></textarea>
                        </div>

                    </div>

                    <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                        <button type="button" onclick="closeEditAreaModal()" class="px-4 py-2.5 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all">
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
                        Update the operational mode for area <strong id="status-modal-area-name" class="text-slate-800"></strong>. Changing this status will immediately impact digital signage, wayfinding sensors, and app reservations in this zone.
                    </p>

                    <form method="POST" id="form-toggle-status" action="" class="space-y-4 pt-2">
                        @csrf
                        @method('PATCH')

                        <div class="text-left">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Select New Status
                            </label>
                            <select name="status" id="status-select-action" class="w-full px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800">
                                <option value="Optimal">Optimal (Active Operations)</option>
                                <option value="Attention Required">Attention Required (Sensors Under Observation)</option>
                                <option value="Maintenance">Under Maintenance (Restrict Entry Gates)</option>
                                <option value="Inactive">Inactive (Full Zone Shutdown)</option>
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
    <div id="drawer-area-details" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAreaDetailsModal()"></div>
        <div class="fixed top-0 bottom-0 right-0 max-w-lg w-full bg-[var(--surface)] shadow-2xl z-10 flex flex-col overflow-hidden animate-slide-left">
            
            <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Area Diagnostic Telemetry</span>
                </div>
                <button type="button" onclick="closeAreaDetailsModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6" id="drawer-telemetry-content">
                <!-- Populated dynamically by JS -->
            </div>

            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center justify-between">
                <span class="text-xs text-slate-400">Area Controller Gateway v3.1</span>
                <button type="button" onclick="closeAreaDetailsModal()" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold">
                    Close
                </button>
            </div>

        </div>
    </div>

@push('scripts')
<script>
    // Global data cache for modal population
    const areasMap = @json(collect($areas)->keyBy('id'));

    // Add Area Modal
    function openAddAreaModal() {
        document.getElementById('modal-add-area').classList.remove('hidden');
    }
    function closeAddAreaModal() {
        document.getElementById('modal-add-area').classList.add('hidden');
    }

    // Edit Area Modal
    function openEditAreaModal(id) {
        const area = areasMap[id];
        if (!area) return;

        document.getElementById('edit-area-subtitle').textContent = `Configuring ${area.name} (${area.code})`;
        document.getElementById('form-edit-area').action = `/vendor/parking-areas/${id}`;
        document.getElementById('edit-area-name').value = area.name;
        document.getElementById('edit-area-floor').value = area.floor;
        document.getElementById('edit-area-type').value = area.type;
        document.getElementById('edit-area-capacity').value = area.capacity;
        document.getElementById('edit-area-status').value = area.status;
        document.getElementById('edit-area-gates').value = area.gates_assigned || '';
        document.getElementById('edit-area-description').value = area.description || '';

        document.getElementById('modal-edit-area').classList.remove('hidden');
    }
    function closeEditAreaModal() {
        document.getElementById('modal-edit-area').classList.add('hidden');
    }

    // Status Toggle Modal
    function openStatusConfirmModal(id, name, currentStatus) {
        document.getElementById('status-modal-area-name').textContent = name;
        document.getElementById('form-toggle-status').action = `/vendor/parking-areas/${id}/status`;
        document.getElementById('status-select-action').value = currentStatus;
        document.getElementById('modal-status-confirm').classList.remove('hidden');
    }
    function closeStatusConfirmModal() {
        document.getElementById('modal-status-confirm').classList.add('hidden');
    }

    // Telemetry Drawer
    function openAreaDetailsModal(id) {
        const area = areasMap[id];
        const container = document.getElementById('drawer-telemetry-content');
        const drawer = document.getElementById('drawer-area-details');

        if (!area) return;

        const occRate = area.capacity > 0 ? Math.round((area.occupied / area.capacity) * 100) : 0;

        container.innerHTML = `
            <div class="space-y-5">
                <div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600 border border-slate-200">${area.code}</span>
                    <h2 class="text-xl font-extrabold text-slate-900 mt-1">${area.name}</h2>
                    <p class="text-xs text-slate-500 mt-0.5">${area.floor} · ${area.type}</p>
                </div>

                <!-- Status Banner -->
                <div class="p-3.5 rounded-xl ${area.status === 'Optimal' ? 'bg-emerald-50 border border-emerald-200 text-emerald-800' : 'bg-amber-50 border border-amber-200 text-amber-800'} flex items-center justify-between text-xs">
                    <span class="font-bold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full ${area.status === 'Optimal' ? 'bg-emerald-500' : 'bg-amber-500'}"></span>
                        Status: ${area.status}
                    </span>
                    <span class="font-mono text-[11px]">${area.last_updated || 'Active'}</span>
                </div>

                <!-- Slot Capacity & Utilization -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Capacity & Live Stalls</h4>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Total Capacity</span>
                            <span class="text-base font-extrabold text-slate-800">${area.capacity} Slots</span>
                        </div>
                        <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200">
                            <span class="text-emerald-600 block text-[10px] uppercase font-bold">Available Bays</span>
                            <span class="text-base font-extrabold text-emerald-700">${area.available} Slots</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Occupied Bays</span>
                            <span class="text-base font-extrabold text-slate-800">${area.occupied} Slots (${occRate}%)</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">App Reserved</span>
                            <span class="text-base font-extrabold text-slate-800">${area.reserved || 0} Slots</span>
                        </div>
                    </div>
                </div>

                <!-- Gate & Access Configuration -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Lane & Gate Association</h4>
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-white space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 font-medium">Assigned Barrier Gates:</span>
                            <span class="font-bold text-slate-800">${area.gates_assigned || 'Main Terminal Lane'}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 font-medium">Overhead Sensor Status:</span>
                            <span class="font-bold text-emerald-600">Online · Dynamic Display Active</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 font-medium">Facility Parent:</span>
                            <span class="font-bold text-slate-800">${area.facility_name}</span>
                        </div>
                    </div>
                </div>

                <!-- Description & Operational Guidelines -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Area Description</h4>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed">
                        ${area.description || 'Designated parking subdivision. Automated ANPR cameras and ultrasonic sensors guide drivers directly to open bays.'}
                    </div>
                </div>

                <!-- Direct Roadmap Links -->
                <div class="pt-2 flex items-center gap-2">
                    <a href="/vendor/parking-map?facility=${area.facility_id}&area=${area.id}" 
                       class="flex-1 py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold text-center transition-colors">
                        Inspect Visual Map &rarr;
                    </a>
                    <a href="/vendor/parking-slots?facility=${area.facility_id}&area=${area.id}" 
                       class="flex-1 py-2 px-3 rounded-xl bg-[var(--primary)] hover:bg-slate-800 text-white text-xs font-bold text-center transition-colors">
                        Manage Slots &rarr;
                    </a>
                </div>
            </div>
        `;

        drawer.classList.remove('hidden');
    }
    function closeAreaDetailsModal() {
        document.getElementById('drawer-area-details').classList.add('hidden');
    }

    // Keyboard support: Close modals on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddAreaModal();
            closeEditAreaModal();
            closeStatusConfirmModal();
            closeAreaDetailsModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
