<x-layouts.vendor activeNav="map" title="Parking Map - NusaPark Enterprise">

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

    <!-- ================= FACILITY & FLOOR CONTEXT SELECTOR ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        
        <!-- Active Facility Meta -->
        <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-sm shadow-xs shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
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
                    <span class="font-medium text-slate-700">Area: <strong>{{ $selectedArea['name'] ?? 'All Areas' }}</strong> ({{ $selectedArea['floor'] ?? 'Floor' }})</span>
                </div>
            </div>
        </div>

        <!-- Selectors Toolbar -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Facility Switcher -->
            <div class="relative min-w-[200px] flex-1 sm:flex-none">
                <select id="facility-map-select" 
                        onchange="window.location.href = '/vendor/parking-map?facility=' + this.value"
                        class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    @foreach($facilities as $f)
                        <option value="{{ $f['id'] }}" {{ ($selectedFacility['id'] ?? '') === $f['id'] ? 'selected' : '' }}>
                            {{ $f['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Area / Floor Switcher -->
            <div class="relative min-w-[200px] flex-1 sm:flex-none">
                <select id="area-map-select" 
                        onchange="window.location.href = '/vendor/parking-map?facility={{ $selectedFacility['id'] }}&area=' + this.value"
                        class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                    @foreach($areas as $a)
                        <option value="{{ $a['id'] }}" {{ ($selectedArea['id'] ?? '') === $a['id'] ? 'selected' : '' }}>
                            {{ $a['name'] }} ({{ $a['floor'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Link to Page 22 Areas -->
            <a href="/vendor/parking-areas?facility={{ $selectedFacility['id'] }}" 
               class="px-3 py-2 rounded-xl border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5"
               title="Configure parking areas">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <span class="hidden sm:inline">Configure Areas</span>
            </a>
        </div>
    </div>

    <!-- ================= PAGE HEADER & LIVE TELEMETRY ================= -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-2 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 text-xs text-[var(--text-muted)] font-medium mb-1">
                <span>Vendor Portal</span>
                <span class="text-slate-300">/</span>
                <span>Operations</span>
                <span class="text-slate-300">/</span>
                <span class="text-[var(--primary)] font-semibold">Parking Map</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text)] tracking-tight">
                    Parking Map
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                    Live Bay Schematic
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sensors Online
                </span>
            </div>
            <p class="text-sm text-[var(--text-muted)] mt-1.5 max-w-3xl">
                Monitor parking space availability and internal facility layout across {{ $selectedFacility['name'] }} · {{ $selectedArea['name'] }}.
            </p>
        </div>

        <!-- Telemetry Actions -->
        <div class="flex items-center gap-2.5 shrink-0">
            <div class="text-right hidden sm:block">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Telemetry Freshness</div>
                <div class="text-xs font-medium text-slate-700" id="sync-timestamp">{{ $mapData['last_updated'] }}</div>
            </div>

            <!-- Real Refresh Button -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="px-3.5 py-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-slate-700 hover:text-[var(--primary)] hover:border-slate-300 text-xs font-bold transition-all shadow-2xs flex items-center gap-1.5 cursor-pointer"
                    title="Refresh Map Telemetry">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="hover:rotate-180 transition-transform duration-500">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span>Sync Now</span>
            </button>
        </div>
    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
        
        <!-- Total Spaces in this layout -->
        <div class="p-3.5 sm:p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Layout Bays</span>
            <div class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight mt-1">
                {{ $mapData['summary']['total_slots'] }}
            </div>
            <div class="text-[11px] text-slate-500 mt-0.5">{{ $selectedArea['floor'] }} mapped</div>
        </div>

        <!-- Available Spaces -->
        <div class="p-3.5 sm:p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Available</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-emerald-600 tracking-tight mt-1">
                {{ $mapData['summary']['available_count'] }}
            </div>
            <div class="text-[11px] text-emerald-700 font-medium mt-0.5">Ready for entry</div>
        </div>

        <!-- Occupied Spaces -->
        <div class="p-3.5 sm:p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Occupied</span>
                <span class="w-2 h-2 rounded-full bg-slate-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight mt-1">
                {{ $mapData['summary']['occupied_count'] }}
            </div>
            <div class="text-[11px] text-slate-500 mt-0.5">Active vehicles</div>
        </div>

        <!-- Reserved Spaces -->
        <div class="p-3.5 sm:p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">App Reserved</span>
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-[var(--accent)] tracking-tight mt-1">
                {{ $mapData['summary']['reserved_count'] }}
            </div>
            <div class="text-[11px] text-blue-700 font-medium mt-0.5">Held for drivers</div>
        </div>

        <!-- Maintenance / Alerts -->
        <div class="p-3.5 sm:p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Maintenance</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-xl sm:text-2xl font-extrabold text-amber-600 tracking-tight mt-1">
                {{ $mapData['summary']['maintenance_count'] }}
            </div>
            <div class="text-[11px] text-amber-700 font-medium mt-0.5">
                {{ $mapData['summary']['maintenance_count'] > 0 ? 'Sensor Check' : 'All Clear' }}
            </div>
        </div>

    </div>

    <!-- ================= MAP TOOLBAR, FILTERS & LEGEND ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            
            <!-- Left: Search & Filter Pills -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Slot Search Input -->
                <div class="relative w-full sm:w-56">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           id="slot-search-input" 
                           placeholder="Search slot (e.g. A-04, EV-01)..." 
                           oninput="filterSlots()"
                           class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-[var(--border)] bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white text-slate-800 font-medium">
                </div>

                <!-- Status Filter Pills -->
                <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl text-xs font-semibold overflow-x-auto max-w-full">
                    <button type="button" onclick="setStatusFilter('all')" id="btn-status-all" class="px-2.5 py-1 rounded-lg bg-white text-slate-800 shadow-2xs transition-all cursor-pointer">
                        All ({{ $mapData['summary']['total_slots'] }})
                    </button>
                    <button type="button" onclick="setStatusFilter('available')" id="btn-status-available" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all cursor-pointer">
                        Available ({{ $mapData['summary']['available_count'] }})
                    </button>
                    <button type="button" onclick="setStatusFilter('occupied')" id="btn-status-occupied" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all cursor-pointer">
                        Occupied ({{ $mapData['summary']['occupied_count'] }})
                    </button>
                    <button type="button" onclick="setStatusFilter('reserved')" id="btn-status-reserved" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all cursor-pointer">
                        Reserved ({{ $mapData['summary']['reserved_count'] }})
                    </button>
                    <button type="button" onclick="setStatusFilter('maintenance')" id="btn-status-maintenance" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all cursor-pointer">
                        Maint. ({{ $mapData['summary']['maintenance_count'] }})
                    </button>
                </div>
            </div>

            <!-- Right: Zoom & Reset Map Controls -->
            <div class="flex items-center gap-2 shrink-0">
                <div class="flex items-center border border-[var(--border)] rounded-xl bg-slate-50 p-0.5">
                    <button type="button" onclick="zoomMap(-0.15)" class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-white rounded-lg transition-colors" title="Zoom Out" aria-label="Zoom Out">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </button>
                    <span id="zoom-level-text" class="px-2 text-[11px] font-mono font-bold text-slate-600 select-none">100%</span>
                    <button type="button" onclick="zoomMap(0.15)" class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-white rounded-lg transition-colors" title="Zoom In" aria-label="Zoom In">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </button>
                    <button type="button" onclick="resetMapZoom()" class="px-2 py-1 text-[11px] font-bold text-slate-600 hover:text-slate-900 hover:bg-white rounded-lg transition-colors ml-0.5" title="Reset View">
                        Reset
                    </button>
                </div>

                <!-- Fullscreen Toggle -->
                <button type="button" onclick="toggleMapFullscreen()" class="p-2 border border-[var(--border)] rounded-xl bg-slate-50 hover:bg-white text-slate-600 hover:text-slate-900 transition-colors" title="Toggle Fullscreen" aria-label="Toggle Fullscreen">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg>
                </button>
            </div>

        </div>

        <!-- Interactive Legend Bar -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-2.5 border-t border-slate-100 text-xs">
            <div class="flex flex-wrap items-center gap-4 text-slate-600">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Legend:</span>
                
                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-emerald-500 border border-emerald-600 shadow-2xs"></div>
                    <span class="font-medium text-slate-700">Available</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-slate-700 border border-slate-800 shadow-2xs"></div>
                    <span class="font-medium text-slate-700">Occupied</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-blue-500 border border-blue-600 shadow-2xs"></div>
                    <span class="font-medium text-slate-700">Reserved</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-emerald-100 border-2 border-emerald-500 flex items-center justify-center text-[9px] font-bold text-emerald-800">EV</div>
                    <span class="font-medium text-slate-700">EV Bay</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-amber-500 border border-amber-600 shadow-2xs"></div>
                    <span class="font-medium text-slate-700">Maintenance</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-md bg-purple-500 border border-purple-600 shadow-2xs"></div>
                    <span class="font-medium text-slate-700">VIP / Accessible</span>
                </div>
            </div>

            <div class="text-[11px] text-slate-400">
                Click any parking space to inspect live bay sensors & status
            </div>
        </div>
    </div>

    <!-- ================= INTERNAL MAP WORKSPACE CANVAS ================= -->
    <div id="map-workspace-wrapper" class="relative rounded-2xl border border-[var(--border)] bg-slate-900/5 overflow-hidden shadow-xs min-h-[580px] flex flex-col justify-between">
        
        <!-- Floor Compass & Directional Header -->
        <div class="absolute top-4 left-4 z-10 flex items-center gap-2 pointer-events-none select-none">
            <div class="px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur-xs border border-slate-200 shadow-xs flex items-center gap-2 text-xs font-bold text-slate-700">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>{{ $selectedArea['floor'] }} · {{ $selectedArea['name'] }}</span>
            </div>
            <div class="px-2.5 py-1.5 rounded-xl bg-white/90 backdrop-blur-xs border border-slate-200 shadow-xs flex items-center gap-1 text-[11px] font-bold text-slate-600">
                <span>N</span>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
            </div>
        </div>

        <!-- Landmarks & Barrier Gate Badges (Top) -->
        <div class="absolute top-4 right-4 z-10 flex flex-wrap items-center gap-2 pointer-events-none select-none">
            <div class="px-2.5 py-1 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10px] font-bold flex items-center gap-1.5 shadow-2xs">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Barrier Gate 1 (Entry)</span>
            </div>
            <div class="px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-200 text-[var(--accent)] text-[10px] font-bold flex items-center gap-1.5 shadow-2xs">
                <span>Lobby Elevator A</span>
            </div>
            <div class="px-2.5 py-1 rounded-lg bg-slate-100 border border-slate-200 text-slate-700 text-[10px] font-bold flex items-center gap-1.5 shadow-2xs">
                <span>Exit Gate 1</span>
            </div>
        </div>

        <!-- Interactive Map Canvas Container (Supports Pan & Zoom) -->
        <div id="map-scroll-viewport" class="flex-1 overflow-auto p-6 md:p-8 flex items-center justify-center cursor-grab active:cursor-grabbing select-none">
            
            <div id="map-scalable-canvas" class="transition-transform duration-200 origin-center space-y-6 max-w-5xl w-full">
                
                <!-- Schematic Facility Bounds Box -->
                <div class="p-6 md:p-8 rounded-2xl bg-white border-2 border-dashed border-slate-300 shadow-sm space-y-6 relative">
                    
                    <!-- Driving Lane 1: Inbound North Lane -->
                    <div class="h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-between px-4 text-xs font-bold text-slate-500 tracking-wider">
                        <div class="flex items-center gap-2 text-emerald-700 font-extrabold text-[11px]">
                            <span>&rarr; INBOUND LANE (3.5M)</span>
                            <span class="text-slate-400">• ANPR SENSOR 1A</span>
                        </div>
                        <div class="text-[10px] font-mono text-slate-400">CLEARANCE: 2.1M</div>
                    </div>

                    <!-- Row A: North Bay Slots -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                            <span>Bay Row A — Visitor Stalls</span>
                            <span class="text-[10px] font-normal text-slate-400">12 Bays</span>
                        </div>
                        <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-12 gap-2">
                            @foreach(array_slice($mapData['slots'], 0, 12) as $slot)
                                <button type="button" 
                                        id="slot-node-{{ $slot['id'] }}"
                                        onclick="selectSlot('{{ $slot['id'] }}')"
                                        data-slot-code="{{ $slot['code'] }}"
                                        data-slot-status="{{ $slot['status'] }}"
                                        data-slot-category="{{ $slot['category'] }}"
                                        class="slot-node group relative p-2 h-20 rounded-xl border flex flex-col justify-between items-center text-center transition-all cursor-pointer hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]
                                        {{ $slot['status'] === 'available' ? 'bg-emerald-50/70 border-emerald-300 hover:border-emerald-500 text-emerald-900' : '' }}
                                        {{ $slot['status'] === 'occupied' ? 'bg-slate-800 border-slate-900 hover:border-slate-700 text-white' : '' }}
                                        {{ $slot['status'] === 'reserved' ? 'bg-blue-50 border-blue-300 hover:border-blue-500 text-blue-900' : '' }}
                                        {{ $slot['status'] === 'maintenance' ? 'bg-amber-50 border-amber-300 hover:border-amber-500 text-amber-900' : '' }}">
                                    
                                    <!-- Bay Status Dot / Indicator -->
                                    <div class="w-full flex items-center justify-between">
                                        <span class="text-[9px] font-mono font-bold opacity-80">{{ $slot['code'] }}</span>
                                        <span class="w-1.5 h-1.5 rounded-full 
                                            {{ $slot['status'] === 'available' ? 'bg-emerald-500' : '' }}
                                            {{ $slot['status'] === 'occupied' ? 'bg-red-400' : '' }}
                                            {{ $slot['status'] === 'reserved' ? 'bg-blue-400' : '' }}
                                            {{ $slot['status'] === 'maintenance' ? 'bg-amber-500' : '' }}"></span>
                                    </div>

                                    <!-- Category Icon / Center Motif -->
                                    <div class="my-auto">
                                        @if($slot['status'] === 'occupied')
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-90"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                        @elseif($slot['status'] === 'available')
                                            <span class="text-[10px] font-bold text-emerald-700">OPEN</span>
                                        @elseif($slot['status'] === 'reserved')
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                        @else
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-600"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                                        @endif
                                    </div>

                                    <!-- Slot Status Subtext -->
                                    <div class="text-[9px] font-bold uppercase tracking-tight truncate w-full">
                                        {{ $slot['status'] === 'occupied' ? ($slot['vehicle']['type'] ?? 'Occupied') : $slot['status'] }}
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Driving Lane 2: Central Two-Way Driveway -->
                    <div class="h-14 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-between px-6 text-xs font-extrabold text-slate-500 tracking-wider">
                        <div class="flex items-center gap-3">
                            <span class="text-slate-700">&larr; TWO-WAY CENTRAL DRIVEWAY &rarr;</span>
                            <span class="px-2 py-0.5 rounded text-[10px] bg-slate-200 text-slate-600 font-mono">SPEED: 10 KM/H</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-400 text-[11px]">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                            <span>OVERHEAD WAYFINDING ACTIVE</span>
                        </div>
                    </div>

                    <!-- Row B: Central Bay Slots -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                            <span>Bay Row B — Central Stalls</span>
                            <span class="text-[10px] font-normal text-slate-400">12 Bays</span>
                        </div>
                        <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-12 gap-2">
                            @foreach(array_slice($mapData['slots'], 12, 12) as $slot)
                                <button type="button" 
                                        id="slot-node-{{ $slot['id'] }}"
                                        onclick="selectSlot('{{ $slot['id'] }}')"
                                        data-slot-code="{{ $slot['code'] }}"
                                        data-slot-status="{{ $slot['status'] }}"
                                        data-slot-category="{{ $slot['category'] }}"
                                        class="slot-node group relative p-2 h-20 rounded-xl border flex flex-col justify-between items-center text-center transition-all cursor-pointer hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]
                                        {{ $slot['status'] === 'available' ? 'bg-emerald-50/70 border-emerald-300 hover:border-emerald-500 text-emerald-900' : '' }}
                                        {{ $slot['status'] === 'occupied' ? 'bg-slate-800 border-slate-900 hover:border-slate-700 text-white' : '' }}
                                        {{ $slot['status'] === 'reserved' ? 'bg-blue-50 border-blue-300 hover:border-blue-500 text-blue-900' : '' }}
                                        {{ $slot['status'] === 'maintenance' ? 'bg-amber-50 border-amber-300 hover:border-amber-500 text-amber-900' : '' }}">
                                    
                                    <div class="w-full flex items-center justify-between">
                                        <span class="text-[9px] font-mono font-bold opacity-80">{{ $slot['code'] }}</span>
                                        <span class="w-1.5 h-1.5 rounded-full 
                                            {{ $slot['status'] === 'available' ? 'bg-emerald-500' : '' }}
                                            {{ $slot['status'] === 'occupied' ? 'bg-red-400' : '' }}
                                            {{ $slot['status'] === 'reserved' ? 'bg-blue-400' : '' }}
                                            {{ $slot['status'] === 'maintenance' ? 'bg-amber-500' : '' }}"></span>
                                    </div>

                                    <div class="my-auto">
                                        @if($slot['status'] === 'occupied')
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-90"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                        @elseif($slot['status'] === 'available')
                                            <span class="text-[10px] font-bold text-emerald-700">OPEN</span>
                                        @elseif($slot['status'] === 'reserved')
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                        @else
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-600"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                                        @endif
                                    </div>

                                    <div class="text-[9px] font-bold uppercase tracking-tight truncate w-full">
                                        {{ $slot['status'] === 'occupied' ? ($slot['vehicle']['type'] ?? 'Occupied') : $slot['status'] }}
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Row VIP & EV Charging Combined Bay -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                        
                        <!-- VIP / Accessible Stalls -->
                        <div>
                            <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <span class="flex items-center gap-1.5 text-purple-700">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="12 8 8 12 12 16 16 12 12 8"></polygon></svg>
                                    VIP & Accessible Row
                                </span>
                                <span class="text-[10px] font-normal text-slate-400">6 Bays</span>
                            </div>
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2">
                                @foreach(array_slice($mapData['slots'], 24, 6) as $slot)
                                    <button type="button" 
                                            id="slot-node-{{ $slot['id'] }}"
                                            onclick="selectSlot('{{ $slot['id'] }}')"
                                            data-slot-code="{{ $slot['code'] }}"
                                            data-slot-status="{{ $slot['status'] }}"
                                            data-slot-category="{{ $slot['category'] }}"
                                            class="slot-node group relative p-2 h-20 rounded-xl border flex flex-col justify-between items-center text-center transition-all cursor-pointer hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]
                                            {{ $slot['status'] === 'available' ? 'bg-purple-50/70 border-purple-300 hover:border-purple-500 text-purple-900' : '' }}
                                            {{ $slot['status'] === 'occupied' ? 'bg-slate-800 border-slate-900 hover:border-slate-700 text-white' : '' }}
                                            {{ $slot['status'] === 'reserved' ? 'bg-blue-50 border-blue-300 hover:border-blue-500 text-blue-900' : '' }}
                                            {{ $slot['status'] === 'maintenance' ? 'bg-amber-50 border-amber-300 hover:border-amber-500 text-amber-900' : '' }}">
                                        
                                        <div class="w-full flex items-center justify-between">
                                            <span class="text-[9px] font-mono font-bold opacity-80">{{ $slot['code'] }}</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                        </div>
                                        <div class="my-auto text-[10px] font-bold">
                                            {{ $slot['status'] === 'occupied' ? 'VIP' : 'OPEN' }}
                                        </div>
                                        <div class="text-[9px] font-bold uppercase truncate w-full">
                                            {{ $slot['status'] }}
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- EV Fast-Charging Hub Stalls -->
                        <div>
                            <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <span class="flex items-center gap-1.5 text-emerald-700">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                                    EV Fast-Charging Hub (22kW DC)
                                </span>
                                <span class="text-[10px] font-normal text-slate-400">6 Bays</span>
                            </div>
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2">
                                @foreach(array_slice($mapData['slots'], 30, 6) as $slot)
                                    <button type="button" 
                                            id="slot-node-{{ $slot['id'] }}"
                                            onclick="selectSlot('{{ $slot['id'] }}')"
                                            data-slot-code="{{ $slot['code'] }}"
                                            data-slot-status="{{ $slot['status'] }}"
                                            data-slot-category="{{ $slot['category'] }}"
                                            class="slot-node group relative p-2 h-20 rounded-xl border flex flex-col justify-between items-center text-center transition-all cursor-pointer hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]
                                            {{ $slot['status'] === 'available' ? 'bg-emerald-50 border-emerald-400 hover:border-emerald-600 text-emerald-900' : '' }}
                                            {{ $slot['status'] === 'occupied' ? 'bg-slate-800 border-slate-900 hover:border-slate-700 text-white' : '' }}
                                            {{ $slot['status'] === 'reserved' ? 'bg-blue-50 border-blue-300 hover:border-blue-500 text-blue-900' : '' }}
                                            {{ $slot['status'] === 'maintenance' ? 'bg-amber-50 border-amber-300 hover:border-amber-500 text-amber-900' : '' }}">
                                        
                                        <div class="w-full flex items-center justify-between">
                                            <span class="text-[9px] font-mono font-bold opacity-80">{{ $slot['code'] }}</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        </div>
                                        <div class="my-auto">
                                            <span class="px-1 py-0.5 rounded text-[8px] font-extrabold bg-emerald-500 text-white">22kW</span>
                                        </div>
                                        <div class="text-[9px] font-bold uppercase truncate w-full">
                                            {{ $slot['status'] }}
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Driving Lane 3: Outbound Exit Thoroughfare -->
                    <div class="h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-between px-4 text-xs font-bold text-slate-500 tracking-wider">
                        <div class="flex items-center gap-2 text-slate-700 font-extrabold text-[11px]">
                            <span>OUTBOUND BARRIER GATE 1 &rarr;</span>
                            <span class="text-slate-400">• CASHLESS TAP / ANPR AUTO-LIFT</span>
                        </div>
                        <div class="text-[10px] font-mono text-emerald-700">LANE CLEAR</div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Bottom Canvas Status Bar -->
        <div class="p-3 bg-white/90 backdrop-blur-xs border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500 px-6">
            <div class="flex items-center gap-3">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Ultrasonic Loop Telemetry Active</span>
                </span>
                <span class="text-slate-300">•</span>
                <span>Facility: <strong>{{ $selectedFacility['name'] }}</strong></span>
            </div>
            <div class="flex items-center gap-2 text-[11px] text-slate-400">
                <span>Hold space / drag to pan workspace</span>
            </div>
        </div>

    </div>

    <!-- ================= SLOT DETAIL SLIDE-OVER DRAWER ================= -->
    <div id="drawer-slot-details" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeSlotDrawer()"></div>
        
        <!-- Drawer Panel -->
        <div class="fixed top-0 bottom-0 right-0 max-w-md w-full bg-[var(--surface)] shadow-2xl z-10 flex flex-col overflow-hidden animate-slide-left">
            
            <!-- Drawer Header -->
            <div class="px-6 py-4 border-b border-[var(--border)] flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Parking Space Diagnostics</span>
                </div>
                <button type="button" onclick="closeSlotDrawer()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200 cursor-pointer" aria-label="Close detail panel">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Content Body (Populated via JS) -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6" id="drawer-slot-content">
                <!-- Dynamically populated -->
            </div>

            <!-- Drawer Footer -->
            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center justify-between">
                <span class="text-xs text-slate-400 font-mono">IoT Node Protocol v2.4</span>
                <button type="button" onclick="closeSlotDrawer()" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold cursor-pointer">
                    Close Panel
                </button>
            </div>

        </div>
    </div>

@push('scripts')
<script>
    // Global Slot Data Map
    const slotsMap = @json(collect($mapData['slots'])->keyBy('id'));
    let currentSelectedSlotId = null;
    let currentStatusFilter = 'all';
    let currentZoom = 1.0;

    // --- ZOOM & PAN LOGIC ---
    function zoomMap(delta) {
        currentZoom = Math.min(1.8, Math.max(0.6, currentZoom + delta));
        applyZoom();
    }

    function resetMapZoom() {
        currentZoom = 1.0;
        applyZoom();
    }

    function applyZoom() {
        const canvas = document.getElementById('map-scalable-canvas');
        if (canvas) {
            canvas.style.transform = `scale(${currentZoom})`;
            document.getElementById('zoom-level-text').textContent = `${Math.round(currentZoom * 100)}%`;
        }
    }

    function toggleMapFullscreen() {
        const wrapper = document.getElementById('map-workspace-wrapper');
        if (!document.fullscreenElement) {
            wrapper.requestFullscreen().catch(err => {
                alert(`Error entering fullscreen: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    }

    // --- FILTER & SEARCH LOGIC ---
    function setStatusFilter(status) {
        currentStatusFilter = status;
        
        // Update button styles
        ['all', 'available', 'occupied', 'reserved', 'maintenance'].forEach(st => {
            const btn = document.getElementById(`btn-status-${st}`);
            if (btn) {
                if (st === status) {
                    btn.className = "px-2.5 py-1 rounded-lg bg-white text-slate-800 shadow-2xs font-bold transition-all cursor-pointer";
                } else {
                    btn.className = "px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 transition-all cursor-pointer font-semibold";
                }
            }
        });

        filterSlots();
    }

    function filterSlots() {
        const searchVal = document.getElementById('slot-search-input').value.trim().toLowerCase();
        const nodes = document.querySelectorAll('.slot-node');

        nodes.forEach(node => {
            const code = node.getAttribute('data-slot-code').toLowerCase();
            const status = node.getAttribute('data-slot-status');
            const matchesSearch = searchVal === '' || code.includes(searchVal);
            const matchesStatus = currentStatusFilter === 'all' || status === currentStatusFilter;

            if (matchesSearch && matchesStatus) {
                node.style.display = 'flex';
                node.style.opacity = '1';
            } else {
                node.style.display = 'none';
            }
        });
    }

    // --- SLOT SELECTION & DRAWER ---
    function selectSlot(slotId) {
        const slot = slotsMap[slotId];
        if (!slot) return;

        currentSelectedSlotId = slotId;

        // Visual Outline on active slot node
        document.querySelectorAll('.slot-node').forEach(n => {
            n.classList.remove('ring-4', 'ring-[var(--primary)]', 'ring-offset-2');
        });
        const selectedNode = document.getElementById(`slot-node-${slotId}`);
        if (selectedNode) {
            selectedNode.classList.add('ring-4', 'ring-[var(--primary)]', 'ring-offset-2');
        }

        const container = document.getElementById('drawer-slot-content');
        const drawer = document.getElementById('drawer-slot-details');

        let statusClass = 'bg-emerald-50 text-emerald-800 border-emerald-200';
        let statusBadge = '<span class="w-2 h-2 rounded-full bg-emerald-500"></span> Available (Clear)';
        if (slot.status === 'occupied') {
            statusClass = 'bg-slate-800 text-white border-slate-900';
            statusBadge = '<span class="w-2 h-2 rounded-full bg-red-400"></span> Occupied by Vehicle';
        } else if (slot.status === 'reserved') {
            statusClass = 'bg-blue-50 text-blue-900 border-blue-200';
            statusBadge = '<span class="w-2 h-2 rounded-full bg-blue-500"></span> Reserved via App';
        } else if (slot.status === 'maintenance') {
            statusClass = 'bg-amber-50 text-amber-900 border-amber-200';
            statusBadge = '<span class="w-2 h-2 rounded-full bg-amber-500"></span> Under Maintenance';
        }

        container.innerHTML = `
            <div class="space-y-5">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded text-xs font-mono font-extrabold bg-slate-100 text-slate-700 border border-slate-200">${slot.code}</span>
                        <span class="text-xs text-slate-500 font-medium">${slot.row}</span>
                    </div>
                    <h2 class="text-xl font-extrabold text-slate-900 mt-1">Bay Space ${slot.code}</h2>
                    <p class="text-xs text-slate-500 mt-0.5">${slot.area_name} · ${slot.floor}</p>
                </div>

                <!-- Status Banner -->
                <div class="p-3.5 rounded-xl border ${statusClass} flex items-center justify-between text-xs font-bold">
                    <span class="flex items-center gap-1.5">${statusBadge}</span>
                    <span class="font-mono text-[11px]">${slot.last_heartbeat}</span>
                </div>

                <!-- Bay Classification Specs -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Space Classification</h4>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Category:</span>
                            <span class="font-bold text-slate-800">${slot.category_label}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Stall Dimension:</span>
                            <span class="font-bold text-slate-800">2.5m × 5.0m Standard</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Guidance Sensor Node:</span>
                            <span class="font-mono font-bold text-slate-700">${slot.sensor_id}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Sensor Telemetry:</span>
                            <span class="font-bold text-emerald-600">${slot.sensor_status}</span>
                        </div>
                    </div>
                </div>

                ${slot.status === 'occupied' && slot.vehicle ? `
                <!-- Vehicle Telemetry -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Occupant Telemetry</h4>
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-white space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Vehicle Type:</span>
                            <span class="font-bold text-slate-800">${slot.vehicle.type}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Plate (Masked):</span>
                            <span class="font-mono font-bold text-slate-900">${slot.vehicle.plate}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Parked Since:</span>
                            <span class="font-bold text-slate-800">${slot.vehicle.entry_time}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Elapsed Duration:</span>
                            <span class="font-bold text-[var(--accent)]">${slot.vehicle.duration}</span>
                        </div>
                    </div>
                </div>
                ` : ''}

                ${slot.status === 'reserved' && slot.reservation ? `
                <!-- Reservation Information -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Reservation</h4>
                    <div class="p-3.5 rounded-xl border border-blue-200 bg-blue-50/50 space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Booking Ref:</span>
                            <span class="font-mono font-bold text-blue-900">${slot.reservation.code}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Reserved For:</span>
                            <span class="font-bold text-slate-800">${slot.reservation.holder}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Hold Expiration:</span>
                            <span class="font-bold text-blue-700">${slot.reservation.valid_until}</span>
                        </div>
                    </div>
                </div>
                ` : ''}

                ${slot.status === 'maintenance' ? `
                <!-- Maintenance Notice -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-amber-700">Maintenance Dispatch</h4>
                    <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50 space-y-1 text-xs text-amber-900">
                        <div class="font-bold">Sensor Recalibration Dispatched</div>
                        <div class="text-[11px] text-amber-800">${slot.maintenance_note || 'Automated hardware ticket issued for diagnostic check.'}</div>
                    </div>
                </div>
                ` : ''}

                <!-- Direct Action -->
                <div class="pt-2 flex items-center gap-2">
                    <a href="/vendor/parking-slots?facility={{ $facilityId }}&q=${encodeURIComponent(slot.code)}" 
                       class="flex-1 py-2.5 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 text-[var(--accent)] text-xs font-bold text-center transition-colors">
                        Manage in Slots &rarr;
                    </a>
                    <button type="button" 
                            onclick="closeSlotDrawer()" 
                            class="flex-1 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold text-center transition-colors cursor-pointer">
                        Back to Map
                    </button>
                </div>
            </div>
        `;

        drawer.classList.remove('hidden');
    }

    function closeSlotDrawer() {
        document.getElementById('drawer-slot-details').classList.add('hidden');
        if (currentSelectedSlotId) {
            const selectedNode = document.getElementById(`slot-node-${currentSelectedSlotId}`);
            if (selectedNode) {
                selectedNode.classList.remove('ring-4', 'ring-[var(--primary)]', 'ring-offset-2');
            }
            currentSelectedSlotId = null;
        }
    }

    // Keyboard Shortcuts: Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSlotDrawer();
        }
    });
</script>
@endpush

</x-layouts.vendor>
