<x-layouts.vendor activeNav="slots" title="Parking Slots - NusaPark Enterprise">

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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Operational Notice</p>
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

    <!-- ================= FACILITY & AREA CONTEXT SELECTOR BAR ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        
        <!-- Active Facility Meta -->
        <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-sm shadow-xs shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
            </div>
            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Facility & Area Context</div>
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
                    <span>Area: <strong>{{ $selectedArea['name'] ?? 'All Configured Areas' }}</strong></span>
                </div>
            </div>
        </div>

        <!-- Switchers and Quick Nav -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Facility Switcher -->
            <div class="relative min-w-[200px]">
                <label for="facility-selector" class="sr-only">Switch Facility</label>
                <select id="facility-selector" 
                        onchange="window.location.href = '/vendor/parking-slots?facility=' + this.value"
                        class="w-full pl-3 pr-8 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($selectedFacility['id'] ?? '') === $f['id'] ? 'selected' : '' }}>
                            {{ $f['name'] }} ({{ $f['city'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Area Switcher -->
            <div class="relative min-w-[190px]">
                <label for="area-selector" class="sr-only">Switch Parking Area</label>
                <select id="area-selector" 
                        onchange="window.location.href = '/vendor/parking-slots?facility={{ $facilityId }}&area=' + this.value"
                        class="w-full pl-3 pr-8 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    <option value="all" {{ ($areaId === 'all') ? 'selected' : '' }}>All Areas ({{ count($areas) }})</option>
                    @foreach($areas as $a)
                        <option value="{{ $a['id'] }}" {{ ($areaId === $a['id']) ? 'selected' : '' }}>
                            {{ $a['name'] }} ({{ $a['floor'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quick Jump to Parking Map -->
            <a href="/vendor/parking-map?facility={{ $facilityId }}{{ $areaId !== 'all' ? '&area=' . $areaId : '' }}" 
               class="px-3 py-2 rounded-xl border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 text-xs font-semibold flex items-center gap-1.5 transition-colors"
               title="View floor schematic on Map">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                <span class="hidden sm:inline">View Map</span>
            </a>

            <!-- Quick Jump to Areas -->
            <a href="/vendor/parking-areas?facility={{ $facilityId }}" 
               class="px-3 py-2 rounded-xl border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 text-xs font-semibold flex items-center gap-1.5 transition-colors"
               title="Configure Parking Areas">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <span class="hidden sm:inline">Areas</span>
            </a>
        </div>
    </div>

    <!-- ================= PAGE HEADER & PRIMARY ACTION ================= -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-2 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)] font-medium mb-1">
                <span>Vendor Portal</span>
                <span class="text-slate-300">/</span>
                <span>Operations</span>
                <span class="text-slate-300">/</span>
                <a href="/vendor/locations" class="hover:underline">Locations</a>
                <span class="text-slate-300">/</span>
                <span class="text-[var(--primary)] font-semibold">Parking Slots</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    Parking Slots
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                    Showing {{ $pagination['from'] }} - {{ $pagination['to'] }} of {{ $pagination['total'] }} Slots
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 hidden sm:inline">
                    {{ $selectedFacility['name'] }}
                </span>
            </div>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-1">
                Manage individual parking spaces across your facilities.
            </p>
        </div>

        <!-- Primary Action -->
        <div class="flex items-center gap-3 shrink-0">
            <button type="button" 
                    onclick="openAddSlotModal()" 
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold flex items-center gap-2 shadow-xs hover:shadow-md transition-all cursor-pointer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Add Parking Slot</span>
            </button>
        </div>
    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3.5 sm:gap-4">
        
        <!-- Total Slots -->
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-1">
                <span>Configured Slots</span>
                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[var(--text)] tracking-tight">
                {{ number_format($metrics['total_slots'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[var(--text-muted)] mt-1 flex items-center justify-between">
                <span>Standard: {{ $metrics['standard_count'] ?? 0 }}</span>
                <span>EV: {{ $metrics['ev_count'] ?? 0 }}</span>
                <span>VIP: {{ $metrics['vip_count'] ?? 0 }}</span>
            </div>
        </div>

        <!-- Available Spaces -->
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between text-xs text-emerald-700 font-semibold mb-1">
                <span>Available Bays</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                {{ number_format($metrics['available_count'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[var(--text-muted)] mt-1 flex items-center gap-1.5">
                <span class="text-emerald-700 font-bold">
                    {{ $metrics['total_slots'] > 0 ? round((($metrics['available_count'] ?? 0) / $metrics['total_slots']) * 100, 1) : 0 }}%
                </span>
                <span>of configured capacity</span>
            </div>
        </div>

        <!-- Occupied Spaces -->
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between text-xs text-blue-700 font-semibold mb-1">
                <span>Occupied Bays</span>
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[var(--accent)] tracking-tight">
                {{ number_format($metrics['occupied_count'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[var(--text-muted)] mt-1 flex items-center gap-1.5">
                <span class="text-[var(--accent)] font-bold">{{ $metrics['occupancy_rate'] ?? 0 }}%</span>
                <span>live occupancy rate</span>
            </div>
        </div>

        <!-- Reserved Spaces -->
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between text-xs text-amber-700 font-semibold mb-1">
                <span>Reserved Holds</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-amber-600 tracking-tight">
                {{ number_format($metrics['reserved_count'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[var(--text-muted)] mt-1">
                Active booking allocations
            </div>
        </div>

        <!-- Maintenance / Offline -->
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between text-xs text-orange-700 font-semibold mb-1">
                <span>Maintenance / Out</span>
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-orange-600 tracking-tight">
                {{ number_format($metrics['maintenance_count'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[var(--text-muted)] mt-1 flex items-center gap-1">
                @if(($metrics['maintenance_count'] ?? 0) > 0)
                <span class="text-orange-700 font-bold">Needs Inspection</span>
                @else
                <span class="text-emerald-600 font-medium">All hardware optimal</span>
                @endif
            </div>
        </div>

    </div>

    <!-- ================= SEARCH, FILTERS & SORTING ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        <form method="GET" action="/vendor/parking-slots" id="slots-filter-form" class="space-y-4">
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 sm:gap-4">
                
                <!-- Keyword Search -->
                <div class="lg:col-span-3">
                    <label for="filter-q" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Search Bay / Sensor
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                        <input type="text" 
                               name="q" 
                               id="filter-q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Code (e.g. A-01), sensor, plate..." 
                               class="w-full pl-9 pr-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white focus:bg-white text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all">
                    </div>
                </div>

                <!-- Area Filter -->
                <div class="lg:col-span-2">
                    <label for="filter-area" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Parking Area
                    </label>
                    <select name="area" 
                            id="filter-area" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ $areaId === 'all' ? 'selected' : '' }}>All Areas</option>
                        @foreach($areas as $a)
                            <option value="{{ $a['id'] }}" {{ $areaId === $a['id'] ? 'selected' : '' }}>
                                {{ $a['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="lg:col-span-2">
                    <label for="filter-category" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Bay Category
                    </label>
                    <select name="category" 
                            id="filter-category" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['category'] === 'all') ? 'selected' : '' }}>All Categories</option>
                        <option value="standard" {{ ($filters['category'] === 'standard') ? 'selected' : '' }}>Standard Car</option>
                        <option value="motorcycle" {{ ($filters['category'] === 'motorcycle') ? 'selected' : '' }}>Motorcycle</option>
                        <option value="vip" {{ ($filters['category'] === 'vip') ? 'selected' : '' }}>VIP / Accessible</option>
                        <option value="ev" {{ ($filters['category'] === 'ev') ? 'selected' : '' }}>EV Fast Charging</option>
                    </select>
                </div>

                <!-- Operational Status Filter -->
                <div class="lg:col-span-2">
                    <label for="filter-op-status" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Configured Status
                    </label>
                    <select name="operational_status" 
                            id="filter-op-status" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['operational_status'] === 'all') ? 'selected' : '' }}>All Statuses</option>
                        <option value="Operational" {{ ($filters['operational_status'] === 'Operational') ? 'selected' : '' }}>Operational</option>
                        <option value="Maintenance" {{ ($filters['operational_status'] === 'Maintenance') ? 'selected' : '' }}>Maintenance</option>
                        <option value="Reserved" {{ ($filters['operational_status'] === 'Reserved') ? 'selected' : '' }}>Reserved</option>
                        <option value="Decommissioned" {{ ($filters['operational_status'] === 'Decommissioned') ? 'selected' : '' }}>Decommissioned</option>
                    </select>
                </div>

                <!-- Live Occupancy Filter -->
                <div class="lg:col-span-2">
                    <label for="filter-occupancy" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Live Occupancy
                    </label>
                    <select name="occupancy_status" 
                            id="filter-occupancy" 
                            class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['occupancy_status'] === 'all') ? 'selected' : '' }}>All Occupancy</option>
                        <option value="Available" {{ ($filters['occupancy_status'] === 'Available') ? 'selected' : '' }}>Available</option>
                        <option value="Occupied" {{ ($filters['occupancy_status'] === 'Occupied') ? 'selected' : '' }}>Occupied</option>
                        <option value="Reserved" {{ ($filters['occupancy_status'] === 'Reserved') ? 'selected' : '' }}>Reserved</option>
                        <option value="Maintenance" {{ ($filters['occupancy_status'] === 'Maintenance') ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div class="lg:col-span-1">
                    <label for="filter-sort" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                        Sort
                    </label>
                    <select name="sort" 
                            id="filter-sort" 
                            class="w-full px-2 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="code_asc" {{ ($filters['sort'] === 'code_asc') ? 'selected' : '' }}>Code (A-Z)</option>
                        <option value="code_desc" {{ ($filters['sort'] === 'code_desc') ? 'selected' : '' }}>Code (Z-A)</option>
                        <option value="category_asc" {{ ($filters['sort'] === 'category_asc') ? 'selected' : '' }}>Category</option>
                        <option value="status_asc" {{ ($filters['sort'] === 'status_asc') ? 'selected' : '' }}>Status</option>
                        <option value="occupancy_asc" {{ ($filters['sort'] === 'occupancy_asc') ? 'selected' : '' }}>Occupancy</option>
                        <option value="updated_desc" {{ ($filters['sort'] === 'updated_desc') ? 'selected' : '' }}>Updated</option>
                    </select>
                </div>

            </div>

            <!-- Filter Action Buttons -->
            <div class="flex items-center justify-between pt-1">
                <div class="text-xs text-[var(--text-muted)]">
                    @if($hasActiveFilters)
                    <span class="inline-flex items-center gap-1.5 text-blue-700 font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        Active filters applied
                    </span>
                    @else
                    <span>Showing configured spaces for <strong>{{ $selectedFacility['name'] }}</strong></span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    @if($hasActiveFilters)
                    <a href="/vendor/parking-slots?facility={{ $facilityId }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-600 text-xs font-semibold transition-colors">
                        Clear Filters
                    </a>
                    @endif
                    <button type="submit" 
                            class="px-4 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold transition-colors cursor-pointer">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- ================= SLOTS DATA TABLE (DESKTOP & TABLET) ================= -->
    <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-xs overflow-hidden">
        
        <!-- Desktop Table Header Meta -->
        <div class="p-4 border-b border-[var(--border)] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-50/50">
            <div class="flex items-center gap-2">
                <h3 class="font-extrabold text-sm sm:text-base text-[var(--text)]">
                    Configured Parking Spaces
                </h3>
                <span class="text-xs text-[var(--text-muted)]">({{ $pagination['total'] }} total records)</span>
            </div>
            
            <div class="text-xs text-slate-500 flex items-center gap-4">
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-sm bg-emerald-500"></span>
                    <span>Available</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-sm bg-blue-500"></span>
                    <span>Occupied</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-sm bg-amber-500"></span>
                    <span>Reserved</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-sm bg-orange-500"></span>
                    <span>Maintenance</span>
                </span>
            </div>
        </div>

        @if(count($slots) > 0)
        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm border-collapse" aria-label="Vendor Parking Spaces List">
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th scope="col" class="py-3 px-4">Bay Code</th>
                        <th scope="col" class="py-3 px-4">Area & Floor</th>
                        <th scope="col" class="py-3 px-4">Category</th>
                        <th scope="col" class="py-3 px-4">Configured Status</th>
                        <th scope="col" class="py-3 px-4">Live Occupancy</th>
                        <th scope="col" class="py-3 px-4">Sensor Node</th>
                        <th scope="col" class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)]">
                    @foreach($slots as $slot)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        
                        <!-- Bay Code -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center font-mono font-bold text-xs shrink-0 shadow-2xs 
                                    {{ ($slot['category'] === 'ev') ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                                       (($slot['category'] === 'vip') ? 'bg-amber-100 text-amber-800 border border-amber-200' : 
                                       (($slot['category'] === 'motorcycle') ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 'bg-slate-100 text-slate-800 border border-slate-200')) }}">
                                    {{ $slot['code'] }}
                                </div>
                                <div>
                                    <div class="font-bold text-[var(--text)] group-hover:text-[var(--primary)] transition-colors">
                                        {{ $slot['code'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-medium">
                                        {{ $slot['row'] ?? 'Bay Row' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Area & Floor -->
                        <td class="py-3.5 px-4">
                            <div class="font-semibold text-slate-800 truncate max-w-[180px]" title="{{ $slot['area_name'] }}">
                                {{ $slot['area_name'] }}
                            </div>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $slot['floor'] }}
                                </span>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="py-3.5 px-4">
                            @if($slot['category'] === 'ev')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                <span>EV Fast Bay</span>
                            </span>
                            @elseif($slot['category'] === 'vip')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span>VIP & Accessible</span>
                            </span>
                            @elseif($slot['category'] === 'motorcycle')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="18.5" cy="17.5" r="3.5"></circle><path d="M15 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-3 11.5L9 9h6l-3 8.5z"></path></svg>
                                <span>Motorcycle</span>
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                <span>Standard Car</span>
                            </span>
                            @endif
                        </td>

                        <!-- Configured Operational Status -->
                        <td class="py-3.5 px-4">
                            @if($slot['operational_status'] === 'Operational')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Operational</span>
                            </span>
                            @elseif($slot['operational_status'] === 'Maintenance')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-orange-50 text-orange-800 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                <span>Maintenance</span>
                            </span>
                            @elseif($slot['operational_status'] === 'Reserved')
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Reserved Hold</span>
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                <span>{{ $slot['operational_status'] }}</span>
                            </span>
                            @endif
                        </td>

                        <!-- Live Occupancy State -->
                        <td class="py-3.5 px-4">
                            @php
                                $occState = strtolower($slot['occupancy_status'] ?? $slot['status'] ?? 'available');
                            @endphp

                            @if($occState === 'available')
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Available
                                </span>
                                <span class="text-[10px] text-slate-400">Vacant</span>
                            </div>
                            @elseif($occState === 'occupied')
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-900 border border-blue-200">
                                        Occupied
                                    </span>
                                    @if(isset($slot['vehicle']['plate']))
                                    <span class="font-mono text-xs font-bold text-slate-800">
                                        {{ $slot['vehicle']['plate'] }}
                                    </span>
                                    @endif
                                </div>
                                @if(isset($slot['vehicle']['duration']))
                                <div class="text-[10px] text-slate-500 mt-0.5">
                                    Since {{ $slot['vehicle']['entry_time'] }} ({{ $slot['vehicle']['duration'] }})
                                </div>
                                @endif
                            </div>
                            @elseif($occState === 'reserved')
                            <div>
                                <span class="px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-900 border border-amber-200">
                                    Reserved
                                </span>
                                @if(isset($slot['reservation']['code']))
                                <div class="text-[10px] text-amber-700 font-mono mt-0.5 font-medium">
                                    {{ $slot['reservation']['code'] }} • Until {{ $slot['reservation']['valid_until'] }}
                                </div>
                                @endif
                            </div>
                            @else
                            <div>
                                <span class="px-2 py-0.5 rounded text-xs font-bold bg-orange-100 text-orange-900 border border-orange-200">
                                    Maintenance
                                </span>
                                @if(!empty($slot['maintenance_note']))
                                <div class="text-[10px] text-orange-700 truncate max-w-[140px] mt-0.5" title="{{ $slot['maintenance_note'] }}">
                                    {{ $slot['maintenance_note'] }}
                                </div>
                                @endif
                            </div>
                            @endif
                        </td>

                        <!-- IoT Sensor Node -->
                        <td class="py-3.5 px-4">
                            <div class="font-mono text-xs font-bold text-slate-700">
                                {{ $slot['sensor_id'] }}
                            </div>
                            <div class="text-[10px] flex items-center gap-1.5 mt-0.5">
                                @if(str_contains(strtolower($slot['sensor_status'] ?? ''), 'online'))
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span class="text-slate-500 font-medium">Online (Ping: {{ $slot['last_heartbeat'] ?? 'Just now' }})</span>
                                @else
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                <span class="text-orange-600 font-medium">{{ $slot['sensor_status'] ?? 'Degraded' }}</span>
                                @endif
                            </div>
                        </td>

                        <!-- Actions Column -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                
                                <!-- Inspect Drawer -->
                                <button type="button" 
                                        onclick="openSlotDetailDrawer('{{ $slot['id'] }}')" 
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors" 
                                        title="Inspect Space Diagnostics">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Edit Modal -->
                                <button type="button" 
                                        onclick="openEditSlotModal('{{ $slot['id'] }}')" 
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-colors" 
                                        title="Edit Space Configuration">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>

                                <!-- Quick Toggle Status Form -->
                                <form method="POST" action="/vendor/parking-slots/{{ $slot['id'] }}/status" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($slot['operational_status'] === 'Operational')
                                    <input type="hidden" name="status" value="Maintenance">
                                    <button type="submit" 
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-orange-600 hover:bg-orange-50 transition-colors"
                                            title="Mark as Maintenance Mode">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                    </button>
                                    @else
                                    <input type="hidden" name="status" value="Operational">
                                    <button type="submit" 
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 transition-colors"
                                            title="Restore to Operational Status">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </button>
                                    @endif
                                </form>

                                <!-- Delete Modal Trigger -->
                                <button type="button" 
                                        onclick="confirmDeleteSlot('{{ $slot['id'] }}', '{{ $slot['code'] }}', '{{ $slot['area_name'] }}', '{{ $slot['occupancy_status'] }}')" 
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                        title="Delete Space Record">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ================= PAGINATION BAR ================= -->
        <div class="p-4 border-t border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-[var(--text-muted)]">
            <div>
                Showing <strong class="text-slate-800">{{ $pagination['from'] }}</strong> to <strong class="text-slate-800">{{ $pagination['to'] }}</strong> of <strong class="text-slate-800">{{ $pagination['total'] }}</strong> spaces
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-1.5 self-end sm:self-auto">
                
                <!-- Prev Button -->
                @if($pagination['current_page'] > 1)
                <a href="/vendor/parking-slots?{{ http_build_query(array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
                   class="px-2.5 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-700 font-semibold transition-colors">
                    &larr; Prev
                </a>
                @else
                <span class="px-2.5 py-1.5 rounded-lg border border-[var(--border)] bg-slate-100 text-slate-400 cursor-not-allowed">
                    &larr; Prev
                </span>
                @endif

                <!-- Page numbers -->
                @for($p = 1; $p <= $pagination['last_page']; $p++)
                    @if($p == 1 || $p == $pagination['last_page'] || abs($p - $pagination['current_page']) <= 1)
                    <a href="/vendor/parking-slots?{{ http_build_query(array_merge(request()->query(), ['page' => $p])) }}" 
                       class="px-3 py-1.5 rounded-lg font-bold transition-colors {{ $p == $pagination['current_page'] ? 'bg-[var(--primary)] text-white shadow-2xs' : 'border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-700' }}">
                        {{ $p }}
                    </a>
                    @elseif($p == 2 && $pagination['current_page'] > 3)
                    <span class="px-1 text-slate-400">...</span>
                    @elseif($p == $pagination['last_page'] - 1 && $pagination['current_page'] < $pagination['last_page'] - 2)
                    <span class="px-1 text-slate-400">...</span>
                    @endif
                @endfor

                <!-- Next Button -->
                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/parking-slots?{{ http_build_query(array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
                   class="px-2.5 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-100 text-slate-700 font-semibold transition-colors">
                    Next &rarr;
                </a>
                @else
                <span class="px-2.5 py-1.5 rounded-lg border border-[var(--border)] bg-slate-100 text-slate-400 cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif

            </div>
            @endif
        </div>

        @else
        <!-- Empty State -->
        <div class="py-16 px-4 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
            </div>
            <h3 class="text-base font-extrabold text-[var(--text)]">
                No Parking Spaces Found
            </h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] max-w-md mx-auto mt-1">
                @if($hasActiveFilters)
                No parking bays matched your active filter criteria. Try adjusting your keyword search or category filters.
                @else
                There are no configured parking bays for this facility area yet. Create your first space using the button below.
                @endif
            </p>
            <div class="mt-5 flex items-center justify-center gap-3">
                @if($hasActiveFilters)
                <a href="/vendor/parking-slots?facility={{ $facilityId }}" 
                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors">
                    Clear All Filters
                </a>
                @endif
                <button type="button" 
                        onclick="openAddSlotModal()" 
                        class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors">
                    Add Parking Space
                </button>
            </div>
        </div>
        @endif

    </div>

    <!-- ================= SLIDE-OVER DETAIL DRAWER ================= -->
    <div id="slot-detail-drawer" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="drawer-slot-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeSlotDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-md w-full bg-[var(--surface)] shadow-2xl flex flex-col z-10 animate-slide-left">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white font-mono font-bold flex items-center justify-center text-sm shadow-xs" id="drawer-slot-badge">
                        --
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bay Diagnostic Profile</div>
                        <h2 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="drawer-slot-title">
                            Space Details
                        </h2>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeSlotDetailDrawer()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                        aria-label="Close drawer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Body -->
            <div class="flex-1 overflow-y-auto p-5 space-y-5" id="drawer-slot-body">
                <div class="text-center py-12 text-slate-400 text-xs">
                    Loading slot telemetry profile...
                </div>
            </div>

            <!-- Drawer Footer Actions -->
            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center gap-2" id="drawer-slot-footer">
                <button type="button" 
                        onclick="closeSlotDetailDrawer()" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-bold text-center transition-colors">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- ================= ADD PARKING SLOT MODAL ================= -->
    <div id="modal-add-slot" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-add-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs" onclick="closeAddSlotModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4 z-10">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden animate-scale-up">
                
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-[var(--primary)] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                        <h3 class="font-extrabold text-base text-[var(--text)]" id="modal-add-title">
                            Add New Parking Slot
                        </h3>
                    </div>
                    <button type="button" onclick="closeAddSlotModal()" class="text-slate-400 hover:text-slate-600 p-1">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form method="POST" action="/vendor/parking-slots" class="p-5 space-y-4">
                    @csrf
                    <input type="hidden" name="facility_id" value="{{ $facilityId }}">

                    <!-- Facility Context (Readonly) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Assigned Facility</label>
                        <input type="text" 
                               value="{{ $selectedFacility['name'] }} ({{ $selectedFacility['city'] }})" 
                               disabled 
                               class="w-full px-3 py-2 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-600 cursor-not-allowed">
                    </div>

                    <!-- Target Parking Area -->
                    <div>
                        <label for="add-area-id" class="block text-xs font-bold text-slate-700 mb-1">
                            Target Parking Area <span class="text-red-500">*</span>
                        </label>
                        <select name="area_id" 
                                id="add-area-id" 
                                required 
                                class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            @foreach($areas as $a)
                                <option value="{{ $a['id'] }}" {{ ($areaId === $a['id']) ? 'selected' : '' }}>
                                    {{ $a['name'] }} ({{ $a['floor'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Bay Code -->
                        <div>
                            <label for="add-code" class="block text-xs font-bold text-slate-700 mb-1">
                                Space Code / Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="code" 
                                   id="add-code" 
                                   required 
                                   placeholder="e.g. A-13, EV-07" 
                                   style="text-transform: uppercase;"
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] font-mono font-bold text-xs sm:text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            <span class="text-[10px] text-slate-400">Must be unique within the selected area.</span>
                        </div>

                        <!-- Bay Category -->
                        <div>
                            <label for="add-category" class="block text-xs font-bold text-slate-700 mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category" 
                                    id="add-category" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="standard">Standard Car Bay</option>
                                <option value="motorcycle">Motorcycle Bay</option>
                                <option value="vip">VIP & Accessible Bay</option>
                                <option value="ev">EV Fast Charging Bay</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Operational Status -->
                        <div>
                            <label for="add-operational-status" class="block text-xs font-bold text-slate-700 mb-1">
                                Initial Operational Status
                            </label>
                            <select name="operational_status" 
                                    id="add-operational-status" 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="Operational">Operational (Ready for Parking)</option>
                                <option value="Maintenance">Maintenance Mode</option>
                                <option value="Reserved">Reserved Hold</option>
                            </select>
                        </div>

                        <!-- IoT Sensor ID -->
                        <div>
                            <label for="add-sensor-id" class="block text-xs font-bold text-slate-700 mb-1">
                                IoT Guidance Sensor Node
                            </label>
                            <input type="text" 
                                   name="sensor_id" 
                                   id="add-sensor-id" 
                                   placeholder="e.g. SEN-XYZ-A13 (Auto if blank)" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] font-mono text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="add-maintenance-note" class="block text-xs font-bold text-slate-700 mb-1">
                            Notes / Maintenance Annotation (Optional)
                        </label>
                        <textarea name="maintenance_note" 
                                  id="add-maintenance-note" 
                                  rows="2" 
                                  placeholder="Special stall dimensions, sensor serial, pillar adjacent..." 
                                  class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-3 border-t border-[var(--border)]">
                        <button type="button" 
                                onclick="closeAddSlotModal()" 
                                class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-all shadow-xs">
                            Create Parking Space
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= EDIT PARKING SLOT MODAL ================= -->
    <div id="modal-edit-slot" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-edit-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs" onclick="closeEditSlotModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4 z-10">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden animate-scale-up">
                
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <h3 class="font-extrabold text-base text-[var(--text)]" id="modal-edit-title">
                            Edit Parking Space
                        </h3>
                    </div>
                    <button type="button" onclick="closeEditSlotModal()" class="text-slate-400 hover:text-slate-600 p-1">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="edit-slot-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Area Selector -->
                    <div>
                        <label for="edit-area-id" class="block text-xs font-bold text-slate-700 mb-1">
                            Assigned Parking Area <span class="text-red-500">*</span>
                        </label>
                        <select name="area_id" 
                                id="edit-area-id" 
                                required 
                                class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            @foreach($areas as $a)
                                <option value="{{ $a['id'] }}">{{ $a['name'] }} ({{ $a['floor'] }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Bay Code -->
                        <div>
                            <label for="edit-code" class="block text-xs font-bold text-slate-700 mb-1">
                                Space Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="code" 
                                   id="edit-code" 
                                   required 
                                   style="text-transform: uppercase;"
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] font-mono font-bold text-xs sm:text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Bay Category -->
                        <div>
                            <label for="edit-category" class="block text-xs font-bold text-slate-700 mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category" 
                                    id="edit-category" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="standard">Standard Car Bay</option>
                                <option value="motorcycle">Motorcycle Bay</option>
                                <option value="vip">VIP & Accessible Bay</option>
                                <option value="ev">EV Fast Charging Bay</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Operational Status -->
                        <div>
                            <label for="edit-operational-status" class="block text-xs font-bold text-slate-700 mb-1">
                                Configured Operational Status <span class="text-red-500">*</span>
                            </label>
                            <select name="operational_status" 
                                    id="edit-operational-status" 
                                    required 
                                    class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-white text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="Operational">Operational</option>
                                <option value="Maintenance">Maintenance Mode</option>
                                <option value="Reserved">Reserved Hold</option>
                                <option value="Decommissioned">Decommissioned</option>
                            </select>
                        </div>

                        <!-- Sensor Node ID -->
                        <div>
                            <label for="edit-sensor-id" class="block text-xs font-bold text-slate-700 mb-1">
                                Sensor Node ID
                            </label>
                            <input type="text" 
                                   name="sensor_id" 
                                   id="edit-sensor-id" 
                                   class="w-full px-3 py-2 rounded-xl border border-[var(--border)] font-mono text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                    </div>

                    <!-- Maintenance Note -->
                    <div>
                        <label for="edit-maintenance-note" class="block text-xs font-bold text-slate-700 mb-1">
                            Operational Notes / Diagnostics
                        </label>
                        <textarea name="maintenance_note" 
                                  id="edit-maintenance-note" 
                                  rows="2" 
                                  class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-3 border-t border-[var(--border)]">
                        <button type="button" 
                                onclick="closeEditSlotModal()" 
                                class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-bold transition-all shadow-xs">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= DELETE CONFIRMATION MODAL ================= -->
    <div id="modal-delete-slot" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-delete-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs" onclick="closeDeleteModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4 z-10">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-md w-full border border-[var(--border)] overflow-hidden animate-scale-up">
                
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between bg-red-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        <h3 class="font-extrabold text-base text-red-950" id="modal-delete-title">
                            Delete Parking Space Record
                        </h3>
                    </div>
                    <button type="button" onclick="closeDeleteModal()" class="text-slate-400 hover:text-slate-600 p-1">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="p-5 space-y-3">
                    <p class="text-sm text-slate-700">
                        Are you sure you want to permanently delete space <strong id="delete-slot-code" class="font-mono text-slate-900">--</strong> in <span id="delete-slot-area">this area</span>?
                    </p>
                    <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs space-y-1">
                        <p class="font-bold flex items-center gap-1.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            Safety Rule Enforced:
                        </p>
                        <p>
                            If this bay is actively occupied by a vehicle or holds an active reservation, the system will reject deletion until the session concludes.
                        </p>
                    </div>
                </div>

                <form id="delete-slot-form" method="POST" action="" class="p-4 bg-slate-50 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-600 hover:bg-slate-200 text-xs font-semibold transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition-all shadow-xs">
                        Permanently Delete
                    </button>
                </form>

            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Global cached slots data for instant drawer rendering
    const slotsData = @json($slots);

    function openAddSlotModal() {
        document.getElementById('modal-add-slot').classList.remove('hidden');
        document.getElementById('add-code').focus();
    }

    function closeAddSlotModal() {
        document.getElementById('modal-add-slot').classList.add('hidden');
    }

    function openEditSlotModal(slotId) {
        const slot = slotsData.find(s => s.id === slotId);
        if (!slot) {
            // Fetch via API fallback
            fetch(`/api/vendor/parking-slots/${slotId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.slot) {
                        populateEditModal(data.slot);
                    }
                });
            return;
        }
        populateEditModal(slot);
    }

    function populateEditModal(slot) {
        document.getElementById('modal-edit-title').textContent = `Edit Parking Space: ${slot.code}`;
        document.getElementById('edit-slot-form').action = `/vendor/parking-slots/${slot.id}`;
        document.getElementById('edit-code').value = slot.code;
        document.getElementById('edit-area-id').value = slot.area_id;
        document.getElementById('edit-category').value = slot.category;
        document.getElementById('edit-operational-status').value = slot.operational_status;
        document.getElementById('edit-sensor-id').value = slot.sensor_id || '';
        document.getElementById('edit-maintenance-note').value = slot.maintenance_note || '';

        document.getElementById('modal-edit-slot').classList.remove('hidden');
        document.getElementById('edit-code').focus();
    }

    function closeEditSlotModal() {
        document.getElementById('modal-edit-slot').classList.add('hidden');
    }

    function confirmDeleteSlot(slotId, slotCode, areaName, occupancyStatus) {
        document.getElementById('delete-slot-code').textContent = slotCode;
        document.getElementById('delete-slot-area').textContent = areaName;
        document.getElementById('delete-slot-form').action = `/vendor/parking-slots/${slotId}`;
        document.getElementById('modal-delete-slot').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('modal-delete-slot').classList.add('hidden');
    }

    function openSlotDetailDrawer(slotId) {
        const slot = slotsData.find(s => s.id === slotId);
        if (!slot) {
            fetch(`/api/vendor/parking-slots/${slotId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.slot) {
                        renderDrawerContent(data.slot);
                    }
                });
            return;
        }
        renderDrawerContent(slot);
    }

    function renderDrawerContent(slot) {
        document.getElementById('drawer-slot-badge').textContent = slot.code;
        document.getElementById('drawer-slot-title').textContent = `Space ${slot.code} Diagnostic`;

        const occ = (slot.occupancy_status || slot.status || 'available').toLowerCase();
        let occBadge = '';
        if (occ === 'available') {
            occBadge = '<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Available (Vacant)</span>';
        } else if (occ === 'occupied') {
            occBadge = '<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-900 border border-blue-200">Occupied</span>';
        } else if (occ === 'reserved') {
            occBadge = '<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900 border border-amber-200">Reserved Hold</span>';
        } else {
            occBadge = '<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-900 border border-orange-200">Maintenance</span>';
        }

        const bodyHtml = `
            <!-- Space Overview Card -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Live Occupancy</span>
                    ${occBadge}
                </div>
                <div class="pt-2 border-t border-slate-200/80 grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <span class="text-slate-400">Configured State:</span>
                        <div class="font-bold text-slate-800">${slot.operational_status}</div>
                    </div>
                    <div>
                        <span class="text-slate-400">Category:</span>
                        <div class="font-bold text-slate-800">${slot.category_label}</div>
                    </div>
                </div>
            </div>

            <!-- Location & Area Specs -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Location & Floor Placement</h4>
                <div class="p-3.5 rounded-xl border border-slate-200 space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Facility:</span>
                        <span class="font-bold text-slate-800">${slot.facility_name}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Parking Area:</span>
                        <span class="font-bold text-slate-800">${slot.area_name}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Floor Level:</span>
                        <span class="font-bold text-slate-800">${slot.floor}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Bay Layout Row:</span>
                        <span class="font-bold text-slate-800">${slot.row || 'Row Placement'}</span>
                    </div>
                </div>
            </div>

            ${occ === 'occupied' && slot.vehicle ? `
            <!-- Vehicle Telemetry -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Parked Vehicle Telemetry</h4>
                <div class="p-3.5 rounded-xl border border-blue-200 bg-blue-50/40 space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Vehicle Type:</span>
                        <span class="font-bold text-slate-800">${slot.vehicle.type}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Plate (Masked):</span>
                        <span class="font-mono font-bold text-blue-900">${slot.vehicle.plate}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Entry Timestamp:</span>
                        <span class="font-bold text-slate-800">${slot.vehicle.entry_time}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Elapsed Duration:</span>
                        <span class="font-bold text-[var(--accent)]">${slot.vehicle.duration}</span>
                    </div>
                </div>
            </div>
            ` : ''}

            ${occ === 'reserved' && slot.reservation ? `
            <!-- Reservation Hold -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Reservation</h4>
                <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50/50 space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Booking Code:</span>
                        <span class="font-mono font-bold text-amber-900">${slot.reservation.code}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Driver Hold:</span>
                        <span class="font-bold text-slate-800">${slot.reservation.holder}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Valid Until:</span>
                        <span class="font-bold text-amber-700">${slot.reservation.valid_until}</span>
                    </div>
                </div>
            </div>
            ` : ''}

            <!-- Hardware Telemetry -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">IoT Guidance Sensor</h4>
                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Sensor Node ID:</span>
                        <span class="font-mono font-bold text-slate-800">${slot.sensor_id}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Sensor Status:</span>
                        <span class="font-bold text-emerald-600">${slot.sensor_status || 'Active (Online)'}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Heartbeat:</span>
                        <span class="text-slate-700">${slot.last_heartbeat || 'Just now'}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Signal RSSI:</span>
                        <span class="font-mono text-slate-700">-68 dBm (Strong)</span>
                    </div>
                </div>
            </div>

            ${slot.maintenance_note ? `
            <!-- Maintenance Notes -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-orange-600">Operational Annotation</h4>
                <div class="p-3.5 rounded-xl border border-orange-200 bg-orange-50/50 text-xs text-orange-900">
                    ${slot.maintenance_note}
                </div>
            </div>
            ` : ''}
        `;

        const footerHtml = `
            <a href="/vendor/parking-map?facility=${slot.facility_id}&area=${slot.area_id}&q=${encodeURIComponent(slot.code)}" 
               class="flex-1 py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-blue-100 text-[var(--accent)] text-xs font-bold text-center transition-colors">
                View on Map &rarr;
            </a>
            <button type="button" 
                    onclick="closeSlotDetailDrawer(); openEditSlotModal('${slot.id}')" 
                    class="flex-1 py-2.5 px-3 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold text-center transition-colors">
                Edit Bay
            </button>
            <button type="button" 
                    onclick="closeSlotDetailDrawer()" 
                    class="py-2.5 px-3 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-semibold text-center transition-colors">
                Close
            </button>
        `;

        document.getElementById('drawer-slot-body').innerHTML = bodyHtml;
        document.getElementById('drawer-slot-footer').innerHTML = footerHtml;
        document.getElementById('slot-detail-drawer').classList.remove('hidden');
    }

    function closeSlotDetailDrawer() {
        document.getElementById('slot-detail-drawer').classList.add('hidden');
    }

    // Keyboard Shortcuts: Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSlotDetailDrawer();
            closeAddSlotModal();
            closeEditSlotModal();
            closeDeleteModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
