<x-layouts.admin activeNav="locations" title="Location Management — Super Admin NusaPark">

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
                <span class="font-semibold text-slate-700">Location Management</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>National Facility Registry</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Last Telemetry Sync: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Location Management
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-xs font-mono">
                        {{ $pagination['total'] }} {{ Str::plural('facility', $pagination['total']) }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    Centrally inspect, verify, and govern smart parking facilities, sensor telemetry, and bay capacity across all registered tenant organizations in Indonesia.
                </p>
            </div>

            <!-- Header Action Buttons -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.locations.export', request()->query()) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors shadow-2xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Export CSV</span>
                </a>

                <button type="button" 
                        onclick="openCreateLocationModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition-colors shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Register Facility</span>
                </button>
            </div>
        </div>

    </div>

    <!-- ================= SUMMARY METRICS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- Metric 1: Total Registered Facilities -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Registered Facilities</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ number_format($summary['total_locations']) }}</span>
                    <span class="text-xs font-semibold text-slate-500">sites</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Across <strong class="text-slate-700">{{ $summary['provinces_count'] }}</strong> Indonesian provinces
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
        </div>

        <!-- Metric 2: Operational Health -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Active Operational</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-emerald-700 font-mono tracking-tight">{{ number_format($summary['operational_locations']) }}</span>
                    <span class="text-xs font-semibold text-emerald-600">online</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Gate barrier & ANPR streams live
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            </div>
        </div>

        <!-- Metric 3: GPS Survey Pending -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Pending GPS Geocoding</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-amber-700 font-mono tracking-tight">{{ number_format($summary['unmapped_gps']) }}</span>
                    <span class="text-xs font-semibold text-amber-600">incomplete</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    Awaiting site survey verification
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
        </div>

        <!-- Metric 4: Platform Capacity -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Monitored Capacity</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ number_format($summary['total_capacity']) }}</span>
                    <span class="text-xs font-semibold text-slate-500">bays</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-0.5">
                    <strong class="text-indigo-600">{{ $summary['overall_occupancy'] }}%</strong> aggregate occupancy
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect><path d="M9 17V7h4a3 3 0 0 1 0 6H9"></path></svg>
            </div>
        </div>

    </div>

    <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-6">
        <form method="GET" action="{{ route('admin.locations') }}" class="space-y-3">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
                
                <!-- Text Search -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Search Facilities</label>
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search facility name, code, city, vendor..."
                               class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <span class="absolute left-3 top-2.5 text-slate-400">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </div>
                </div>

                <!-- Owning Tenant Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Owning Tenant</label>
                    <select name="vendor" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Tenant Operators</option>
                        @foreach($operators as $op)
                            <option value="{{ $op['id'] }}" {{ $filters['vendor'] === $op['id'] ? 'selected' : '' }}>
                                {{ $op['name'] }} ({{ $op['id'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Operational Status Filter -->
                <div class="lg:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Operational Status</label>
                    <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($statuses as $val => $label)
                            <option value="{{ $val }}" {{ $filters['status'] === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Province / Region Filter -->
                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Province / Region</label>
                    <select name="province" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all">All Indonesia (National)</option>
                        @foreach($regions as $rKey => $rLabel)
                            @if($rKey !== 'all')
                                <option value="{{ $rKey }}" {{ $filters['province'] === $rKey ? 'selected' : '' }}>{{ $rLabel }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Secondary Filter Row -->
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-12 gap-3 pt-2 border-t border-slate-100">
                
                <!-- GPS Completeness -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">GPS Geocoding Status</label>
                    <select name="completeness" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        <option value="all" {{ $filters['completeness'] === 'all' ? 'selected' : '' }}>All Geocoding States</option>
                        <option value="complete" {{ $filters['completeness'] === 'complete' ? 'selected' : '' }}>Mapped GPS Only (Valid Lat/Lng)</option>
                        <option value="unmapped" {{ $filters['completeness'] === 'unmapped' ? 'selected' : '' }}>Unmapped (Missing GPS / Survey Pending)</option>
                    </select>
                </div>

                <!-- Facility Type -->
                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Facility Type</label>
                    <select name="facility_type" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        @foreach($facilityTypes as $fKey => $fLabel)
                            <option value="{{ $fKey }}" {{ $filters['facility_type'] === $fKey ? 'selected' : '' }}>{{ $fLabel }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sorting & Actions -->
                <div class="lg:col-span-4 flex items-end gap-2">
                    <div class="flex-1">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1">Sort Order</label>
                        <select name="sort" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            <option value="name_asc" {{ $filters['sort'] === 'name_asc' ? 'selected' : '' }}>Facility Name (A &rarr; Z)</option>
                            <option value="name_desc" {{ $filters['sort'] === 'name_desc' ? 'selected' : '' }}>Facility Name (Z &rarr; A)</option>
                            <option value="code_asc" {{ $filters['sort'] === 'code_asc' ? 'selected' : '' }}>Location Code</option>
                            <option value="capacity_desc" {{ $filters['sort'] === 'capacity_desc' ? 'selected' : '' }}>Bay Capacity (High &rarr; Low)</option>
                            <option value="capacity_asc" {{ $filters['sort'] === 'capacity_asc' ? 'selected' : '' }}>Bay Capacity (Low &rarr; High)</option>
                            <option value="date_desc" {{ $filters['sort'] === 'date_desc' ? 'selected' : '' }}>Registration Date (Newest)</option>
                            <option value="vendor_asc" {{ $filters['sort'] === 'vendor_asc' ? 'selected' : '' }}>Tenant Operator (A &rarr; Z)</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-2xs shrink-0">
                        Filter
                    </button>

                    <a href="{{ route('admin.locations') }}" 
                       class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-semibold transition-colors shrink-0"
                       title="Reset all filters">
                        Reset
                    </a>
                </div>

            </div>

        </form>
    </div>

    <!-- ================= LOCATION REGISTRY TABLE ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-6">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">Facility & Code</th>
                        <th class="py-3 px-4">Owning Tenant</th>
                        <th class="py-3 px-4">City & Province</th>
                        <th class="py-3 px-4">GPS Geocoding</th>
                        <th class="py-3 px-4">Capacity & Occupancy</th>
                        <th class="py-3 px-4">Hardware Footprint</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($locations as $loc)
                    @php
                        $hasGps = !empty($loc['coordinates']) && isset($loc['coordinates']['lat'], $loc['coordinates']['lng']);
                        $occupancyPct = ($loc['total_capacity'] > 0) ? round((($loc['occupied'] ?? 0) / $loc['total_capacity']) * 100) : 0;
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        
                        <!-- Col 1: Facility Identity -->
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                                <span>{{ $loc['name'] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="font-mono text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 font-bold">
                                    {{ $loc['code'] }}
                                </span>
                                <span class="text-[10px] px-1.5 py-0.5 rounded bg-indigo-50 text-indigo-700 border border-indigo-100 font-medium">
                                    {{ $loc['facility_type'] ?? 'Commercial Mall' }}
                                </span>
                            </div>
                        </td>

                        <!-- Col 2: Owning Tenant (Canonical Link to Page 39) -->
                        <td class="py-3.5 px-4">
                            <a href="/admin/tenants?detail={{ $loc['vendor_id'] }}" 
                               class="font-semibold text-indigo-600 hover:text-indigo-800 hover:underline block truncate max-w-[190px]"
                               title="Inspect tenant {{ $loc['vendor_name'] }} on Page 39">
                                {{ $loc['vendor_name'] }}
                            </a>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="font-mono text-[10px] text-slate-400">
                                    {{ $loc['vendor_id'] }}
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="text-[10px] font-medium text-slate-500">
                                    {{ $loc['vendor_tier'] ?? 'Standard Partner' }}
                                </span>
                            </div>
                        </td>

                        <!-- Col 3: City & Province -->
                        <td class="py-3.5 px-4">
                            <div class="font-medium text-slate-800">{{ $loc['city'] }}</div>
                            <div class="text-[11px] text-slate-400 truncate max-w-[160px]" title="{{ $loc['address'] }}">
                                {{ $loc['province'] }}
                            </div>
                        </td>

                        <!-- Col 4: GPS Geolocation -->
                        <td class="py-3.5 px-4">
                            @if($hasGps)
                                <a href="/admin/map?selected={{ $loc['id'] }}" 
                                   class="inline-flex items-center gap-1.5 font-mono text-[11px] text-slate-600 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 px-2 py-1 rounded-lg transition-colors"
                                   title="View facility on Super Admin Indonesia Map (Page 38)">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-indigo-500"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    <span>{{ $loc['coordinates']['lat'] }}, {{ $loc['coordinates']['lng'] }}</span>
                                </a>
                            @else
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-lg"
                                      title="GPS coordinates missing. Site survey required before live map rendering.">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                    <span>Missing GPS</span>
                                </span>
                            @endif
                        </td>

                        <!-- Col 5: Capacity & Occupancy Progress -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center justify-between text-[11px] mb-1">
                                <span class="font-bold font-mono text-slate-800">{{ number_format($loc['total_capacity']) }} bays</span>
                                <span class="text-slate-500 font-mono">{{ $occupancyPct }}% full</span>
                            </div>
                            <div class="w-28 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="h-1.5 rounded-full {{ $occupancyPct > 85 ? 'bg-rose-500' : ($occupancyPct > 65 ? 'bg-amber-500' : 'bg-emerald-500') }}" 
                                     style="width: {{ min(100, $occupancyPct) }}%"></div>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-1">
                                {{ number_format($loc['occupied'] ?? 0) }} occ • {{ number_format($loc['available'] ?? 0) }} avail
                            </div>
                        </td>

                        <!-- Col 6: Hardware Footprint -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1 font-mono text-[11px] text-slate-700 bg-slate-50 px-2 py-0.5 rounded border border-slate-200"
                                      title="Barrier gate lanes">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <span>{{ $loc['gates_count'] ?? 0 }}</span>
                                </span>
                                <span class="inline-flex items-center gap-1 font-mono text-[11px] text-slate-700 bg-slate-50 px-2 py-0.5 rounded border border-slate-200"
                                      title="ANPR recognition cameras">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                    <span>{{ $loc['cameras_count'] ?? 0 }}</span>
                                </span>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-1 truncate max-w-[130px]">
                                {{ $loc['operating_hours'] ?? '24 Hours' }}
                            </div>
                        </td>

                        <!-- Col 7: Operational Status -->
                        <td class="py-3.5 px-4">
                            @if($loc['status'] === 'Operational')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Operational</span>
                                </span>
                            @elseif($loc['status'] === 'Attention Required')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>Attention</span>
                                </span>
                            @elseif($loc['status'] === 'Suspended')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Suspended</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    <span>{{ $loc['status'] }}</span>
                                </span>
                            @endif
                            <div class="text-[10px] text-slate-400 mt-1 truncate max-w-[140px]" title="{{ $loc['status_note'] ?? '' }}">
                                {{ $loc['status_note'] ?? 'Telemetry synchronized' }}
                            </div>
                        </td>

                        <!-- Col 8: Actions -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                
                                <!-- Inspect Drawer Action -->
                                <button type="button" 
                                        onclick="inspectLocation('{{ $loc['id'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                        title="Inspect Facility Details">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>

                                <!-- Edit Modal Action -->
                                <button type="button" 
                                        onclick="openEditLocationModal('{{ $loc['id'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Edit Facility Configuration">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>

                                <!-- Change Status Action -->
                                <button type="button" 
                                        onclick="openStatusModal('{{ $loc['id'] }}', '{{ addslashes($loc['name']) }}', '{{ $loc['status'] }}')"
                                        class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                        title="Change Operational Status">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-500">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            </div>
                            <p class="font-bold text-slate-800 text-sm">No Parking Facilities Found</p>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                No registered facilities match your current query or filter criteria. Try adjusting your search term or clearing the active filters.
                            </p>
                            <a href="{{ route('admin.locations') }}" class="inline-block mt-3 px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg font-bold text-xs">
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
                <strong class="text-slate-800">{{ $pagination['total'] }}</strong> registered facilities
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-1.5">
                <!-- Previous Button -->
                @if($pagination['current_page'] > 1)
                    <a href="{{ route('admin.locations', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}" 
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
                    <a href="{{ route('admin.locations', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}" 
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
    <div id="locationDetailDrawer" class="fixed inset-0 z-50 overflow-hidden {{ $selectedLocation ? '' : 'hidden' }}">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-2xs transition-opacity" onclick="closeDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-xl bg-white shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-200 flex items-start justify-between bg-slate-50/50">
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="detailLocCode" class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-slate-200 text-slate-800">
                                {{ $selectedLocation['code'] ?? 'LOC-ID' }}
                            </span>
                            <span id="detailLocStatus" class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ $selectedLocation['status'] ?? 'Operational' }}
                            </span>
                        </div>
                        <h2 id="detailLocName" class="text-lg font-bold text-slate-900 mt-1">
                            {{ $selectedLocation['name'] ?? 'Facility Details' }}
                        </h2>
                        <p id="detailLocType" class="text-xs text-indigo-600 font-semibold mt-0.5">
                            {{ $selectedLocation['facility_type'] ?? 'Commercial Mall' }}
                        </p>
                    </div>

                    <button type="button" onclick="closeDetailDrawer()" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Drawer Scrollable Body -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5 text-xs">
                    
                    <!-- Section 1: Owning Tenant Context (Page 39 Connection) -->
                    <div class="bg-indigo-50/60 p-4 rounded-xl border border-indigo-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 mb-1">Owning Tenant Operator</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 id="detailVendorName" class="text-sm font-bold text-slate-900">
                                    {{ $selectedLocation['vendor_name'] ?? 'Tenant Legal Name' }}
                                </h3>
                                <p class="text-[11px] text-slate-600 font-mono mt-0.5">
                                    ID: <span id="detailVendorId">{{ $selectedLocation['vendor_id'] ?? 'vdr-xxx-xx' }}</span> • 
                                    <span id="detailVendorTier" class="font-sans font-semibold text-indigo-600">{{ $selectedLocation['vendor_tier'] ?? 'Standard Partner' }}</span>
                                </p>
                            </div>
                            <a id="detailVendorLink" 
                               href="/admin/tenants?detail={{ $selectedLocation['vendor_id'] ?? '' }}" 
                               class="px-2.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold text-[11px] transition-colors shadow-2xs">
                                View Tenant &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Section 2: Address & Geographic Geolocation -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Geographic Coordinates & Address
                        </h4>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <span class="text-slate-400 block text-[11px]">Street Address:</span>
                                <span id="detailAddress" class="font-medium text-slate-800 text-xs">
                                    {{ $selectedLocation['address'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">City / Municipality:</span>
                                <span id="detailCity" class="font-semibold text-slate-800">
                                    {{ $selectedLocation['city'] ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Province:</span>
                                <span id="detailProvince" class="font-semibold text-slate-800">
                                    {{ $selectedLocation['province'] ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- GPS Coordinates Card -->
                        <div id="detailGpsContainer" class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Stored GPS Geolocation</span>
                                <span id="detailCoordinatesText" class="font-mono text-xs font-semibold text-slate-800">
                                    @if(!empty($selectedLocation['coordinates']))
                                        {{ $selectedLocation['coordinates']['lat'] }}, {{ $selectedLocation['coordinates']['lng'] }}
                                    @else
                                        Unmapped (Missing Coordinates)
                                    @endif
                                </span>
                            </div>
                            <a id="detailMapLink" 
                               href="/admin/map?selected={{ $selectedLocation['id'] ?? '' }}" 
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:bg-indigo-50 hover:text-indigo-600 text-slate-700 rounded-lg text-xs font-bold transition-colors">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                <span>Open in Map</span>
                            </a>
                        </div>
                    </div>

                    <!-- Section 3: Capacity & Live Telemetry -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Capacity & Gate Architecture
                        </h4>

                        <div class="grid grid-cols-3 gap-2.5 text-center">
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Declared Total</span>
                                <span id="detailCapacity" class="text-base font-black font-mono text-slate-900">
                                    {{ $selectedLocation['total_capacity'] ?? 0 }}
                                </span>
                                <span class="text-[10px] text-slate-500 block">bays</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Occupied</span>
                                <span id="detailOccupied" class="text-base font-black font-mono text-indigo-600">
                                    {{ $selectedLocation['occupied'] ?? 0 }}
                                </span>
                                <span class="text-[10px] text-slate-500 block">vehicles</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Available</span>
                                <span id="detailAvailable" class="text-base font-black font-mono text-emerald-600">
                                    {{ $selectedLocation['available'] ?? 0 }}
                                </span>
                                <span class="text-[10px] text-slate-500 block">free bays</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-1">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <span class="text-slate-500 font-medium">Barrier Gate Lanes:</span>
                                <span id="detailGates" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ $selectedLocation['gates_count'] ?? 0 }} lanes
                                </span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <span class="text-slate-500 font-medium">ANPR Cameras:</span>
                                <span id="detailCameras" class="font-mono font-bold text-slate-800 text-sm">
                                    {{ $selectedLocation['cameras_count'] ?? 0 }} units
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Operational Configuration -->
                    <div class="space-y-3">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-1">
                            Operational Profile & Telemetry
                        </h4>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Operating Schedule:</span>
                                <span id="detailHours" class="font-medium text-slate-800">
                                    {{ $selectedLocation['operating_hours'] ?? '24 Hours' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Site Emergency Contact:</span>
                                <span id="detailPhone" class="font-mono font-medium text-slate-800">
                                    {{ $selectedLocation['contact_phone'] ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">Last Telemetry Heartbeat:</span>
                                <span id="detailLastTelemetry" class="font-mono font-semibold text-emerald-600">
                                    {{ $selectedLocation['last_telemetry_at'] ?? 'Online' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1">
                                <span class="text-slate-500">Registration Date:</span>
                                <span id="detailCreatedAt" class="font-mono text-slate-700">
                                    {{ $selectedLocation['created_at'] ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Context Note -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Status Audit Note</span>
                            <p id="detailStatusNote" class="text-slate-600 text-[11px] leading-relaxed">
                                {{ $selectedLocation['status_note'] ?? 'All telemetry and edge gate communications active.' }}
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
                        Edit Facility
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= REGISTER FACILITY MODAL ================= -->
    <div id="createLocationModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-2xl w-full max-h-[90vh] overflow-y-auto p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Register New Parking Facility</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Provision an operational location under an authorized tenant operator.</p>
                </div>
                <button type="button" onclick="closeCreateLocationModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.locations.store') }}" class="my-4 space-y-4 text-xs">
                @csrf

                <!-- Owning Tenant Operator -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Owning Tenant Operator *</label>
                    <select name="vendor_id" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 font-medium">
                        <option value="">-- Select Registered Tenant --</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t['id'] }}">
                                {{ $t['company_name'] }} ({{ $t['id'] }}) — {{ $t['tier'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Facility Name *</label>
                        <input type="text" name="name" required placeholder="e.g. Grand Sahid Jaya Parking" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Facility Code (Optional)</label>
                        <input type="text" name="code" placeholder="e.g. LOC-GSJ-JKT (Auto-generated if blank)" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Facility Type *</label>
                        <select name="facility_type" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($facilityTypes as $fKey => $fLabel)
                                @if($fKey !== 'all')
                                    <option value="{{ $fKey }}">{{ $fLabel }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Regional Zone</label>
                        <select name="region_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($regions as $rKey => $rLabel)
                                @if($rKey !== 'all')
                                    <option value="{{ $rKey }}">{{ $rLabel }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Street Address *</label>
                    <input type="text" name="address" required placeholder="e.g. Jl. Jend. Sudirman Kav. 86, Karet Tengsin" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">City / Municipality *</label>
                        <input type="text" name="city" required placeholder="e.g. Jakarta Pusat" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Province *</label>
                        <input type="text" name="province" required placeholder="e.g. DKI Jakarta" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <!-- GPS Coordinates Section -->
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-slate-700 text-xs">GPS Geolocation (Latitude & Longitude)</span>
                        <span class="text-[10px] text-slate-400">Optional: leave empty if pending site survey</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] text-slate-500 mb-0.5">Latitude (WGS84)</label>
                            <input type="number" step="0.0001" name="lat" placeholder="-6.2088" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-500 mb-0.5">Longitude (WGS84)</label>
                            <input type="number" step="0.0001" name="lng" placeholder="106.8456" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        </div>
                    </div>
                </div>

                <!-- Hardware & Capacity -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Declared Bay Capacity *</label>
                        <input type="number" name="total_capacity" min="1" required value="300" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Barrier Gates *</label>
                        <input type="number" name="gates_count" min="1" required value="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">ANPR Cameras *</label>
                        <input type="number" name="cameras_count" min="0" required value="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Operating Hours</label>
                        <input type="text" name="operating_hours" value="24 Hours" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Site Contact Phone</label>
                        <input type="text" name="contact_phone" placeholder="+62 812-xxxx-xxxx" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeCreateLocationModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                        Provision Facility
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- ================= EDIT FACILITY MODAL ================= -->
    <div id="editLocationModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-2xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-2xl w-full max-h-[90vh] overflow-y-auto p-6 shadow-2xl">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Edit Facility Configuration</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Updating record: <strong id="editModalLocCode" class="font-mono text-indigo-600">LOC-ID</strong>
                    </p>
                </div>
                <button type="button" onclick="closeEditLocationModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form id="editLocationForm" method="POST" action="" class="my-4 space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Facility Name *</label>
                        <input type="text" id="editName" name="name" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Facility Type *</label>
                        <select id="editFacilityType" name="facility_type" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                            @foreach($facilityTypes as $fKey => $fLabel)
                                @if($fKey !== 'all')
                                    <option value="{{ $fKey }}">{{ $fLabel }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Street Address *</label>
                    <input type="text" id="editAddress" name="address" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">City / Municipality *</label>
                        <input type="text" id="editCity" name="city" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Province *</label>
                        <input type="text" id="editProvince" name="province" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <!-- GPS Coordinates Section -->
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 space-y-2">
                    <span class="font-semibold text-slate-700 text-xs block">GPS Geolocation Coordinates</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] text-slate-500 mb-0.5">Latitude (WGS84)</label>
                            <input type="number" step="0.0001" id="editLat" name="lat" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-500 mb-0.5">Longitude (WGS84)</label>
                            <input type="number" step="0.0001" id="editLng" name="lng" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                        </div>
                    </div>
                </div>

                <!-- Hardware & Capacity -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Declared Bay Capacity *</label>
                        <input type="number" id="editCapacity" name="total_capacity" min="1" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Barrier Gates *</label>
                        <input type="number" id="editGates" name="gates_count" min="1" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">ANPR Cameras *</label>
                        <input type="number" id="editCameras" name="cameras_count" min="0" required class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Operating Hours</label>
                        <input type="text" id="editHours" name="operating_hours" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Site Contact Phone</label>
                        <input type="text" id="editPhone" name="contact_phone" class="w-full px-3 py-2 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600">
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeEditLocationModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-colors">
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
                    <h3 class="text-base font-bold text-slate-900">Change Operational Status</h3>
                    <p id="statusModalLocName" class="text-xs text-slate-500 mt-0.5">Facility Name</p>
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
                        <option value="Operational">🟢 Operational (Full Traffic & Booking Active)</option>
                        <option value="Attention Required">🟡 Attention Required (Telemetry Discrepancy)</option>
                        <option value="Maintenance">🟠 Maintenance (Temporary Lane / Hardware Offline)</option>
                        <option value="Suspended">🔴 Suspended (Halt Edge API & Public Reservations)</option>
                    </select>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-slate-600 text-[11px] leading-relaxed">
                    <strong>Administrative Consequence:</strong>
                    <ul class="list-disc pl-4 mt-1 space-y-0.5 text-slate-500">
                        <li><strong>Operational:</strong> Unlocks driver navigation, reservation slots, and live ANPR gate telemetry.</li>
                        <li><strong>Maintenance:</strong> Pauses new driver bookings while leaving gate manual overrides active for on-site staff.</li>
                        <li><strong>Suspended:</strong> Disables all public reservation routes and isolates Edge IoT barrier sync.</li>
                    </ul>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Status Audit Note / Reason</label>
                    <textarea name="reason" rows="2" placeholder="e.g. Scheduled sensor recalibration or administrative compliance audit..." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600"></textarea>
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

    <!-- ================= CLIENT JAVASCRIPT LOGIC ================= -->
    @push('scripts')
    <script>
        const allLocationsJson = @json($locations);

        function inspectLocation(id) {
            const loc = allLocationsJson.find(l => l.id === id);
            if (!loc) return;

            document.getElementById('detailLocCode').textContent = loc.code;
            document.getElementById('detailLocName').textContent = loc.name;
            document.getElementById('detailLocType').textContent = loc.facility_type || 'Commercial Mall';
            document.getElementById('detailLocStatus').textContent = loc.status;
            
            // Owning Tenant
            document.getElementById('detailVendorName').textContent = loc.vendor_name;
            document.getElementById('detailVendorId').textContent = loc.vendor_id;
            document.getElementById('detailVendorTier').textContent = loc.vendor_tier || 'Standard Partner';
            document.getElementById('detailVendorLink').href = `/admin/tenants?detail=${loc.vendor_id}`;

            // Address & GPS
            document.getElementById('detailAddress').textContent = loc.address;
            document.getElementById('detailCity').textContent = loc.city;
            document.getElementById('detailProvince').textContent = loc.province;

            const hasGps = loc.coordinates && loc.coordinates.lat && loc.coordinates.lng;
            if (hasGps) {
                document.getElementById('detailCoordinatesText').textContent = `${loc.coordinates.lat}, ${loc.coordinates.lng}`;
                document.getElementById('detailMapLink').href = `/admin/map?selected=${loc.id}`;
                document.getElementById('detailMapLink').classList.remove('hidden');
            } else {
                document.getElementById('detailCoordinatesText').textContent = 'Unmapped (Missing GPS / Survey Pending)';
                document.getElementById('detailMapLink').classList.add('hidden');
            }

            // Capacity
            document.getElementById('detailCapacity').textContent = (loc.total_capacity || 0).toLocaleString();
            document.getElementById('detailOccupied').textContent = (loc.occupied || 0).toLocaleString();
            document.getElementById('detailAvailable').textContent = (loc.available || 0).toLocaleString();
            document.getElementById('detailGates').textContent = `${loc.gates_count || 0} lanes`;
            document.getElementById('detailCameras').textContent = `${loc.cameras_count || 0} units`;

            // Operational Profile
            document.getElementById('detailHours').textContent = loc.operating_hours || '24 Hours';
            document.getElementById('detailPhone').textContent = loc.contact_phone || '-';
            document.getElementById('detailLastTelemetry').textContent = loc.last_telemetry_at || 'Online';
            document.getElementById('detailCreatedAt').textContent = loc.created_at || '-';
            document.getElementById('detailStatusNote').textContent = loc.status_note || 'All telemetry and edge gate communications active.';

            // Open Drawer
            document.getElementById('locationDetailDrawer').classList.remove('hidden');
        }

        function closeDetailDrawer() {
            document.getElementById('locationDetailDrawer').classList.add('hidden');
        }

        function triggerEditFromDrawer() {
            const code = document.getElementById('detailLocCode').textContent;
            const loc = allLocationsJson.find(l => l.code === code);
            closeDetailDrawer();
            if (loc) {
                openEditLocationModal(loc.id);
            }
        }

        function openCreateLocationModal() {
            document.getElementById('createLocationModal').classList.remove('hidden');
        }

        function closeCreateLocationModal() {
            document.getElementById('createLocationModal').classList.add('hidden');
        }

        function openEditLocationModal(id) {
            const loc = allLocationsJson.find(l => l.id === id);
            if (!loc) return;

            document.getElementById('editModalLocCode').textContent = `${loc.name} (${loc.code})`;
            document.getElementById('editLocationForm').action = `/admin/locations/${loc.id}`;
            document.getElementById('editName').value = loc.name;
            document.getElementById('editFacilityType').value = loc.facility_type || 'Commercial Mall';
            document.getElementById('editAddress').value = loc.address;
            document.getElementById('editCity').value = loc.city;
            document.getElementById('editProvince').value = loc.province;
            document.getElementById('editCapacity').value = loc.total_capacity || 100;
            document.getElementById('editGates').value = loc.gates_count || 2;
            document.getElementById('editCameras').value = loc.cameras_count || 2;
            document.getElementById('editHours').value = loc.operating_hours || '24 Hours';
            document.getElementById('editPhone').value = loc.contact_phone || '';

            if (loc.coordinates && loc.coordinates.lat && loc.coordinates.lng) {
                document.getElementById('editLat').value = loc.coordinates.lat;
                document.getElementById('editLng').value = loc.coordinates.lng;
            } else {
                document.getElementById('editLat').value = '';
                document.getElementById('editLng').value = '';
            }

            document.getElementById('editLocationModal').classList.remove('hidden');
        }

        function closeEditLocationModal() {
            document.getElementById('editLocationModal').classList.add('hidden');
        }

        function openStatusModal(id, name, currentStatus) {
            document.getElementById('statusModalLocName').textContent = `${name} (${id})`;
            document.getElementById('statusForm').action = `/admin/locations/${id}/status`;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailDrawer();
                closeCreateLocationModal();
                closeEditLocationModal();
                closeStatusModal();
            }
        });
    </script>
    @endpush

</x-layouts.admin>
