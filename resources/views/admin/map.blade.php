<x-layouts.admin activeNav="map" title="Indonesia Map — Super Admin NusaPark">

    @push('styles')
    <!-- LEAFLET CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <style>
        .custom-map-marker {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, filter 0.2s ease;
        }
        .custom-map-marker:hover {
            transform: scale(1.15) translateY(-2px);
            z-index: 1000 !important;
        }
        .custom-map-marker.selected {
            transform: scale(1.25) translateY(-4px);
            z-index: 1001 !important;
        }
        .marker-pin {
            width: 32px;
            height: 32px;
            border-radius: 50% 50% 50% 0;
            position: absolute;
            transform: rotate(-45deg);
            left: 50%;
            top: 50%;
            margin: -16px 0 0 -16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .marker-pin::after {
            content: '';
            width: 14px;
            height: 14px;
            margin: 0;
            background: #ffffff;
            position: absolute;
            border-radius: 50%;
        }
        .marker-pin.operational {
            background: #10B981;
        }
        .marker-pin.attention {
            background: #F59E0B;
        }
        .marker-pin.maintenance {
            background: #EF4444;
        }
        .leaflet-popup-content-wrapper {
            border-radius: 14px;
            padding: 4px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
            border: 1px solid #E2E8F0;
        }
        .leaflet-popup-content {
            margin: 8px 12px;
            line-height: 1.4;
        }
    </style>
    @endpush

    <!-- ================= PAGE HEADER & CONTEXT ================= -->
    <div class="space-y-4 mb-5">
        
        <!-- Breadcrumb & Freshness -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-semibold text-slate-700">Indonesia Map</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    <span>National Geographic Registry</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Data Freshness: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Page Title & Operational Disclosure -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Indonesia Map
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 38
                    </span>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">
                        {{ $metrics['total_locations'] }} Registered Facilities
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Geographic distribution of authorized smart parking facilities across Indonesian provinces.
                </p>
                <div class="mt-2 text-[11px] text-slate-400 flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100 inline-flex">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-indigo-500 shrink-0"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span>Markers depict registered facility locations and authoritative metadata; not live vehicular GPS coordinates or parking slot vacancies.</span>
                </div>
            </div>

            <!-- Quick Action: Manual Refresh -->
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('admin.map') }}" 
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                    </svg>
                    <span>Reset View</span>
                </a>
            </div>
        </div>

        <!-- ================= GEOGRAPHIC SUMMARY METRICS BAR ================= -->
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-3">
            <div class="bg-white p-3 rounded-xl border border-slate-200/90 shadow-xs">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total in View</div>
                <div class="text-lg font-extrabold text-slate-900 mt-0.5 font-mono">{{ $metrics['total_locations'] }} <span class="text-xs font-normal text-slate-500 font-sans">Facilities</span></div>
            </div>

            <div class="bg-white p-3 rounded-xl border border-slate-200/90 shadow-xs">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Operational Health</div>
                <div class="text-lg font-extrabold text-emerald-600 mt-0.5 font-mono">
                    {{ $metrics['operational_rate'] }}% 
                    <span class="text-xs font-normal text-slate-500 font-sans">({{ $metrics['operational_locations'] }}/{{ $metrics['total_locations'] }})</span>
                </div>
            </div>

            <div class="bg-white p-3 rounded-xl border border-slate-200/90 shadow-xs">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Provinces & Cities</div>
                <div class="text-lg font-extrabold text-indigo-700 mt-0.5 font-mono">
                    {{ $metrics['provinces_count'] }} <span class="text-xs font-normal text-slate-500 font-sans">Prov • {{ $metrics['cities_count'] }} Cities</span>
                </div>
            </div>

            <div class="bg-white p-3 rounded-xl border border-slate-200/90 shadow-xs">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Registered Capacity</div>
                <div class="text-lg font-extrabold text-slate-900 mt-0.5 font-mono">
                    {{ number_format($metrics['total_capacity'], 0, ',', '.') }} <span class="text-xs font-normal text-slate-500 font-sans">Bays</span>
                </div>
            </div>

            <div class="bg-white p-3 rounded-xl border border-slate-200/90 shadow-xs col-span-2 sm:col-span-4 lg:col-span-1">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Coordinates Quality</div>
                <div class="text-lg font-extrabold text-slate-800 mt-0.5 font-mono">
                    @if($metrics['unmapped_coordinates'] > 0)
                        <span class="text-amber-600">{{ $metrics['unmapped_coordinates'] }} Pending</span>
                    @else
                        <span class="text-emerald-600">100% Mapped</span>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- ================= FILTERS & SEARCH TOOLBAR ================= -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-5">
        <form method="GET" action="{{ route('admin.map') }}" id="mapFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
            
            <!-- Left: Search and Quick Dropdowns -->
            <div class="flex flex-1 flex-wrap items-center gap-2.5">
                
                <!-- Search Box -->
                <div class="relative flex-1 min-w-[200px] sm:min-w-[260px]">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           id="searchInput"
                           value="{{ $filters['q'] }}" 
                           placeholder="Search facility name, city, address, or code..." 
                           class="w-full pl-9 pr-8 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 text-slate-800 font-medium placeholder-slate-400 transition-all">
                    @if(!empty($filters['q']))
                    <a href="{{ route('admin.map', array_merge($filters, ['q' => ''])) }}" class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400 hover:text-slate-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                    @endif
                </div>

                <!-- Province Selector -->
                <div class="relative min-w-[140px]">
                    <select name="province" 
                            id="provinceFilter"
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

                <!-- Status Selector -->
                <div class="relative min-w-[130px]">
                    <select name="status" 
                            id="statusFilter"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        <option value="all">All Statuses</option>
                        <option value="Operational" {{ $filters['status'] === 'Operational' ? 'selected' : '' }}>🟢 Operational</option>
                        <option value="Attention Required" {{ $filters['status'] === 'Attention Required' ? 'selected' : '' }}>🟡 Attention Required</option>
                        <option value="Maintenance" {{ $filters['status'] === 'Maintenance' ? 'selected' : '' }}>🔴 Maintenance</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Operator Selector -->
                <div class="relative min-w-[150px]">
                    <select name="vendor" 
                            id="vendorFilter"
                            onchange="this.form.submit()" 
                            class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 pr-8 font-semibold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 cursor-pointer">
                        <option value="all">All Operators</option>
                        @foreach($operators as $op)
                            <option value="{{ $op['id'] }}" {{ $filters['vendor'] === $op['id'] ? 'selected' : '' }}>
                                {{ $op['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <!-- Submit / Clear Button -->
                <button type="submit" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition-colors">
                    Filter
                </button>
                @if($filters['q'] !== '' || $filters['province'] !== 'all' || $filters['status'] !== 'all' || $filters['vendor'] !== 'all')
                <a href="{{ route('admin.map') }}" class="px-2.5 py-2 text-slate-400 hover:text-slate-700 text-xs font-semibold">
                    Reset
                </a>
                @endif
            </div>

            <!-- Right: View Toggle (Map vs List on Mobile) -->
            <div class="flex items-center justify-between lg:justify-end gap-2 shrink-0 pt-2 lg:pt-0 border-t lg:border-t-0 border-slate-100">
                <div class="inline-flex p-1 bg-slate-100 rounded-xl border border-slate-200 text-xs font-semibold">
                    <button type="button" 
                            id="viewModeMapBtn"
                            onclick="switchViewMode('map')" 
                            class="px-3 py-1 rounded-lg bg-white text-indigo-700 shadow-xs font-bold transition-all">
                        Map View
                    </button>
                    <button type="button" 
                            id="viewModeListBtn"
                            onclick="switchViewMode('list')" 
                            class="px-3 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all">
                        Directory List ({{ count($locations) }})
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- ================= MAIN WORKSPACE: MAP CANVAS & LOCATION DETAILS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-6 items-start">
        
        <!-- LEFT: INTERACTIVE GEOGRAPHIC MAP CANVAS (8 Cols on Desktop) -->
        <div id="mapWorkspaceCol" class="lg:col-span-8 flex flex-col space-y-3">
            
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden relative">
                
                <!-- Floating Map Controls Overlay -->
                <div class="absolute top-4 left-4 z-20 flex flex-col gap-1.5 shadow-md rounded-xl bg-white/95 backdrop-blur-xs border border-slate-200 p-1">
                    <button type="button" 
                            id="mapZoomIn" 
                            class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-sm transition-colors" 
                            title="Zoom In">
                        +
                    </button>
                    <button type="button" 
                            id="mapZoomOut" 
                            class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-sm transition-colors" 
                            title="Zoom Out">
                        &minus;
                    </button>
                    <div class="w-full h-px bg-slate-200 my-0.5"></div>
                    <button type="button" 
                            id="mapFitBounds" 
                            class="w-8 h-8 rounded-lg hover:bg-slate-100 text-indigo-600 flex items-center justify-center transition-colors" 
                            title="Fit Filtered Results">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>
                    </button>
                    <button type="button" 
                            id="mapResetIndonesia" 
                            class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-600 flex items-center justify-center transition-colors" 
                            title="Reset to All Indonesia View">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="12 8 8 12 12 16 12 8"></polygon></svg>
                    </button>
                </div>

                <!-- Status Legend Overlay (Bottom Left) -->
                <div class="absolute bottom-6 left-4 z-20 hidden sm:flex items-center gap-3 bg-white/95 backdrop-blur-xs border border-slate-200 rounded-xl px-3 py-1.5 text-[11px] shadow-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-slate-600 font-medium">Operational ({{ $metrics['operational_locations'] }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="text-slate-600 font-medium">Attention ({{ $metrics['attention_locations'] }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        <span class="text-slate-600 font-medium">Maintenance ({{ $metrics['maintenance_locations'] }})</span>
                    </div>
                </div>

                <!-- Tile Fallback Notice (Hidden unless tiles fail) -->
                <div id="tileErrorAlert" class="hidden absolute top-4 right-4 z-20 bg-rose-50 border border-rose-200 text-rose-800 text-xs px-3 py-2 rounded-xl shadow-md">
                    Tile loading interrupted. Interactive coordinate markers remain accessible.
                </div>

                <!-- Leaflet Container -->
                <div id="indonesiaMap" class="w-full h-[520px] sm:h-[620px] bg-slate-100 z-10"></div>
            </div>

            <!-- Subordinate Helper Text -->
            <div class="flex items-center justify-between text-[11px] text-slate-400 px-1">
                <span>Centering: Republic of Indonesia • Coordinate System: WGS84 EPSG:4326</span>
                <span>OpenStreetMap &copy; Contributors • CartoDB Tiles</span>
            </div>
        </div>

        <!-- RIGHT: LOCATION SUMMARY PANEL & DIRECTORY (4 Cols on Desktop) -->
        <div class="lg:col-span-4 space-y-4">
            
            <!-- SELECTED LOCATION SUMMARY PANEL -->
            <div id="locationSummaryPanel" class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 transition-all">
                @if($selectedLocation)
                    <div class="space-y-4">
                        
                        <!-- Panel Header & Status -->
                        <div class="flex items-start justify-between gap-3 pb-3 border-b border-slate-100">
                            <div>
                                <span class="font-mono text-[10px] text-slate-400 uppercase font-semibold">
                                    {{ $selectedLocation['code'] }}
                                </span>
                                <h2 id="summaryLocName" class="text-base sm:text-lg font-bold text-slate-900 tracking-tight leading-tight mt-0.5">
                                    {{ $selectedLocation['name'] }}
                                </h2>
                                <p id="summaryLocCity" class="text-xs text-slate-500 mt-0.5">
                                    {{ $selectedLocation['city'] }}, {{ $selectedLocation['province'] }}
                                </p>
                            </div>

                            <span id="summaryLocStatus" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold shrink-0 {{ $selectedLocation['status'] === 'Operational' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($selectedLocation['status'] === 'Attention Required' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $selectedLocation['status'] === 'Operational' ? 'bg-emerald-500' : ($selectedLocation['status'] === 'Attention Required' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                <span>{{ $selectedLocation['status'] }}</span>
                            </span>
                        </div>

                        <!-- Operator Tenant -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Authorized Operator Tenant</div>
                            <div class="text-xs font-bold text-slate-800 mt-0.5" id="summaryLocVendor">{{ $selectedLocation['vendor_name'] }}</div>
                            <div class="text-[10px] text-indigo-600 font-mono mt-0.5" id="summaryLocTier">{{ $selectedLocation['vendor_tier'] }} • {{ $selectedLocation['vendor_id'] }}</div>
                        </div>

                        <!-- Capacity & Live Occupancy Snapshot -->
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/70">
                                <div class="text-[10px] text-slate-400 font-medium">Bay Capacity</div>
                                <div class="font-bold text-slate-900 font-mono text-sm mt-0.5" id="summaryLocCapacity">{{ number_format($selectedLocation['total_capacity'], 0, ',', '.') }} Bays</div>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/70">
                                <div class="text-[10px] text-slate-400 font-medium">Current Occupancy</div>
                                <div class="font-bold text-emerald-600 font-mono text-sm mt-0.5" id="summaryLocOccupied">
                                    {{ number_format($selectedLocation['occupied'], 0, ',', '.') }} <span class="text-[11px] font-normal text-slate-400 font-sans">({{ round(($selectedLocation['occupied'] / ($selectedLocation['total_capacity'] ?: 1)) * 100, 1) }}%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Facility Specifications -->
                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-400">Barrier Gates</span>
                                <span class="font-bold text-slate-800 font-mono" id="summaryLocGates">{{ $selectedLocation['gates_count'] }} Lanes</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-400">ANPR Cameras</span>
                                <span class="font-bold text-slate-800 font-mono" id="summaryLocCameras">{{ $selectedLocation['cameras_count'] }} Units</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-400">Operating Hours</span>
                                <span class="font-bold text-slate-800" id="summaryLocHours">{{ $selectedLocation['operating_hours'] }}</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-400">Geographic Coordinates</span>
                                <span class="font-mono text-slate-700 text-[11px]" id="summaryLocCoords">
                                    @if(!empty($selectedLocation['coordinates']))
                                        {{ $selectedLocation['coordinates']['lat'] }}, {{ $selectedLocation['coordinates']['lng'] }}
                                    @else
                                        <span class="text-amber-600 font-semibold">⚠️ Pending Survey</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Street Address</div>
                            <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-2.5 rounded-xl border border-slate-100" id="summaryLocAddress">
                                {{ $selectedLocation['address'] }}
                            </p>
                        </div>

                        <!-- Operational Note -->
                        @if(!empty($selectedLocation['status_note']))
                        <div class="p-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 text-slate-700" id="summaryLocNote">
                            <div class="text-[10px] font-bold uppercase text-slate-400 mb-0.5">Operational Telemetry Note</div>
                            <span>{{ $selectedLocation['status_note'] }}</span>
                        </div>
                        @endif

                        <!-- Action Link to existing location detail route -->
                        <div class="pt-2 flex items-center justify-between gap-2">
                            <a href="/location-detail" 
                               class="flex-1 text-center py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                                Inspect Facility Operations &rarr;
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="py-12 text-center text-slate-400 space-y-2">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mx-auto text-slate-300">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <div class="text-xs font-bold text-slate-700">No Location Selected</div>
                        <p class="text-[11px] max-w-[200px] mx-auto">Click any location pin on the map or select from the directory below.</p>
                    </div>
                @endif
            </div>

            <!-- LOCATION DIRECTORY LIST (Scrollable / Text Alternative) -->
            <div id="locationDirectoryPanel" class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700">
                            Locations Directory
                        </h3>
                        <div class="text-[10px] text-slate-400">
                            Showing {{ count($locations) }} of {{ $metrics['total_locations'] }} matching filters
                        </div>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400">Sort by City</span>
                </div>

                <div class="divide-y divide-slate-100 mt-2 max-h-[360px] overflow-y-auto pr-1 scrollbar-thin">
                    @forelse($locations as $loc)
                    <div class="py-2.5 px-2 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer group {{ ($selectedLocation['id'] ?? '') === $loc['id'] ? 'bg-indigo-50/60' : '' }}"
                         onclick="selectLocationOnMap('{{ $loc['id'] }}')">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <div class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 truncate transition-colors">
                                    {{ $loc['name'] }}
                                </div>
                                <div class="text-[11px] text-slate-500 truncate mt-0.5">
                                    {{ $loc['city'] }} • <span class="text-slate-400 font-mono">{{ $loc['code'] }}</span>
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $loc['vendor_name'] }}
                                </div>
                            </div>

                            <div class="text-right shrink-0">
                                <span class="inline-block px-2 py-0.5 rounded text-[9px] font-bold {{ $loc['status'] === 'Operational' ? 'bg-emerald-50 text-emerald-700' : ($loc['status'] === 'Attention Required' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                                    {{ $loc['status'] }}
                                </span>
                                <div class="text-[10px] font-mono text-slate-500 font-bold mt-1">
                                    {{ $loc['total_capacity'] }} bays
                                </div>
                                @if(empty($loc['coordinates']))
                                <div class="text-[9px] text-amber-600 font-semibold mt-0.5">
                                    ⚠️ Unmapped
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center text-slate-400 text-xs">
                        No facilities match your search query or filter selection.
                        <div class="mt-2">
                            <a href="{{ route('admin.map') }}" class="text-indigo-600 font-bold hover:underline">Clear Filters</a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    @push('scripts')
    <!-- LEAFLET JS SCRIPT -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        // Global Map State
        let map = null;
        const markersMap = {};
        const locationsData = @json($locations);
        let selectedId = "{{ $selectedLocation['id'] ?? '' }}";

        document.addEventListener('DOMContentLoaded', function() {
            initLeafletMap();
        });

        function initLeafletMap() {
            const mapContainer = document.getElementById('indonesiaMap');
            if (!mapContainer) return;

            try {
                // Initialize map centered on Indonesian Archipelago
                map = L.map('indonesiaMap', {
                    zoomControl: false,
                    attributionControl: true
                }).setView([-2.5489, 118.0149], 5);

                // CartoDB Positron / OpenStreetMap standard tiles
                const tileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 19
                }).addTo(map);

                tileLayer.on('tileerror', function() {
                    const alertEl = document.getElementById('tileErrorAlert');
                    if (alertEl) alertEl.classList.remove('hidden');
                });

                // Attach Control Buttons
                document.getElementById('mapZoomIn').addEventListener('click', () => map.zoomIn());
                document.getElementById('mapZoomOut').addEventListener('click', () => map.zoomOut());
                document.getElementById('mapFitBounds').addEventListener('click', () => fitMapBounds());
                document.getElementById('mapResetIndonesia').addEventListener('click', () => {
                    map.setView([-2.5489, 118.0149], 5);
                });

                // Render Location Markers
                renderLocationMarkers();

                // Auto-fit to active markers
                fitMapBounds();

            } catch (err) {
                console.error("Map initialization failed:", err);
                const alertEl = document.getElementById('tileErrorAlert');
                if (alertEl) {
                    alertEl.textContent = "Map provider unavailable. Location directory list remains fully operational.";
                    alertEl.classList.remove('hidden');
                }
            }
        }

        function renderLocationMarkers() {
            locationsData.forEach(loc => {
                if (!loc.coordinates || typeof loc.coordinates.lat !== 'number' || typeof loc.coordinates.lng !== 'number') {
                    return; // Gracefully handle unmapped coordinates
                }

                const statusClass = loc.status === 'Operational' ? 'operational' : (loc.status === 'Attention Required' ? 'attention' : 'maintenance');
                const isSelected = loc.id === selectedId;

                const markerHtml = `
                    <div class="custom-map-marker ${isSelected ? 'selected' : ''}" id="marker-${loc.id}">
                        <div class="marker-pin ${statusClass}"></div>
                    </div>
                `;

                const customIcon = L.divIcon({
                    html: markerHtml,
                    className: '',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });

                const marker = L.marker([loc.coordinates.lat, loc.coordinates.lng], {
                    icon: customIcon,
                    title: loc.name
                }).addTo(map);

                // Leaflet Popup
                const popupContent = `
                    <div class="text-xs">
                        <div class="font-bold text-slate-900">${loc.name}</div>
                        <div class="text-[10px] text-slate-500">${loc.city} • <span class="font-mono">${loc.code}</span></div>
                        <div class="mt-1 flex items-center justify-between text-[11px]">
                            <span class="font-mono font-bold text-slate-800">${loc.total_capacity} Bays</span>
                            <span class="font-bold ${loc.status === 'Operational' ? 'text-emerald-600' : (loc.status === 'Attention Required' ? 'text-amber-600' : 'text-rose-600')}">${loc.status}</span>
                        </div>
                    </div>
                `;
                marker.bindPopup(popupContent);

                marker.on('click', () => {
                    selectLocationOnMap(loc.id, false);
                });

                markersMap[loc.id] = marker;
            });
        }

        function selectLocationOnMap(id, pan = true) {
            const loc = locationsData.find(l => l.id === id);
            if (!loc) return;

            selectedId = id;

            // Update marker styles
            document.querySelectorAll('.custom-map-marker').forEach(el => el.classList.remove('selected'));
            const activeMarkerEl = document.getElementById('marker-' + id);
            if (activeMarkerEl) activeMarkerEl.classList.add('selected');

            // Pan map if coordinates exist
            if (loc.coordinates && loc.coordinates.lat && loc.coordinates.lng) {
                if (pan && map) {
                    map.flyTo([loc.coordinates.lat, loc.coordinates.lng], 13, { duration: 1.2 });
                }
                if (markersMap[id]) {
                    markersMap[id].openPopup();
                }
            }

            // Update Summary Panel DOM
            updateSummaryPanel(loc);
        }

        function updateSummaryPanel(loc) {
            const nameEl = document.getElementById('summaryLocName');
            if (!nameEl) return;

            nameEl.textContent = loc.name;
            document.getElementById('summaryLocCity').textContent = `${loc.city}, ${loc.province}`;
            document.getElementById('summaryLocVendor').textContent = loc.vendor_name;
            document.getElementById('summaryLocTier').textContent = `${loc.vendor_tier} • ${loc.vendor_id}`;
            document.getElementById('summaryLocCapacity').textContent = `${Number(loc.total_capacity).toLocaleString()} Bays`;
            
            const occRate = loc.total_capacity > 0 ? Math.round((loc.occupied / loc.total_capacity) * 100 * 10) / 10 : 0;
            document.getElementById('summaryLocOccupied').innerHTML = `${Number(loc.occupied).toLocaleString()} <span class="text-[11px] font-normal text-slate-400 font-sans">(${occRate}%)</span>`;
            
            document.getElementById('summaryLocGates').textContent = `${loc.gates_count} Lanes`;
            document.getElementById('summaryLocCameras').textContent = `${loc.cameras_count} Units`;
            document.getElementById('summaryLocHours').textContent = loc.operating_hours;
            document.getElementById('summaryLocAddress').textContent = loc.address;

            const coordsEl = document.getElementById('summaryLocCoords');
            if (loc.coordinates && loc.coordinates.lat) {
                coordsEl.textContent = `${loc.coordinates.lat}, ${loc.coordinates.lng}`;
            } else {
                coordsEl.innerHTML = `<span class="text-amber-600 font-semibold">⚠️ Pending Survey</span>`;
            }

            // Status styling
            const statusBadge = document.getElementById('summaryLocStatus');
            if (statusBadge) {
                let badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                let dotClass = 'bg-emerald-500';
                if (loc.status === 'Attention Required') {
                    badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                    dotClass = 'bg-amber-500';
                } else if (loc.status === 'Maintenance') {
                    badgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                    dotClass = 'bg-rose-500';
                }
                statusBadge.className = `inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold border ${badgeClass}`;
                statusBadge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${dotClass}"></span><span>${loc.status}</span>`;
            }

            // Note styling
            const noteEl = document.getElementById('summaryLocNote');
            if (noteEl) {
                noteEl.querySelector('span').textContent = loc.status_note || 'All operational metrics within standard parameters.';
            }
        }

        function fitMapBounds() {
            if (!map) return;
            const validCoords = locationsData
                .filter(l => l.coordinates && typeof l.coordinates.lat === 'number')
                .map(l => [l.coordinates.lat, l.coordinates.lng]);

            if (validCoords.length > 0) {
                map.fitBounds(validCoords, { padding: [50, 50], maxZoom: 14 });
            }
        }

        function switchViewMode(mode) {
            const mapCol = document.getElementById('mapWorkspaceCol');
            const dirPanel = document.getElementById('locationDirectoryPanel');
            const mapBtn = document.getElementById('viewModeMapBtn');
            const listBtn = document.getElementById('viewModeListBtn');

            if (mode === 'list') {
                mapCol.classList.add('hidden', 'lg:flex');
                dirPanel.classList.remove('hidden');
                dirPanel.scrollIntoView({ behavior: 'smooth' });
                listBtn.className = "px-3 py-1 rounded-lg bg-white text-indigo-700 shadow-xs font-bold transition-all";
                mapBtn.className = "px-3 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all";
            } else {
                mapCol.classList.remove('hidden');
                mapBtn.className = "px-3 py-1 rounded-lg bg-white text-indigo-700 shadow-xs font-bold transition-all";
                listBtn.className = "px-3 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all";
                if (map) {
                    setTimeout(() => map.invalidateSize(), 200);
                }
            }
        }
    </script>
    @endpush

</x-layouts.admin>
