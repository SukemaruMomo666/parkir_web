<x-layouts.app activeNav="vehicles">
    <div class="w-full space-y-6">

        <!-- ================= PAGE HEADER WITH ANPR ILLUSTRATION ================= -->
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6 pb-2">
            
            <!-- Left Title & Subtitle -->
            <div class="max-w-xl relative z-10">
                <!-- Tags / Breadcrumb -->
                <div class="flex items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="3" y="10" width="18" height="8" rx="2"></rect>
                            <path d="M5 10L7 5h10l2 5"></path>
                            <circle cx="7" cy="18" r="1.5"></circle>
                            <circle cx="17" cy="18" r="1.5"></circle>
                        </svg>
                        Vehicle Management
                    </span>
                    <span class="text-xs font-semibold text-slate-500">My Vehicles</span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    My Vehicles
                </h1>
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mt-1">
                    Manage your registered vehicles for automatic smart barrier recognition (ANPR), ticketless entry, and quick bookings.
                </p>
            </div>

            <!-- Right: ANPR Smart Gate Graphic & Register Button -->
            <div class="flex items-center gap-4 relative z-10">
                <!-- Architectural / ANPR Illustration -->
                <div class="hidden md:block absolute -top-8 right-44 h-28 w-auto pointer-events-none select-none opacity-95">
                    <img src="{{ asset('images/vehicles-header-anpr.png') }}" alt="ANPR Smart Access" class="h-full w-auto object-contain" />
                </div>

                <button type="button" 
                        onclick="openAddModal()" 
                        class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm flex items-center gap-1.5 shadow-sm hover:shadow-md transition-all cursor-pointer">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Register Vehicle</span>
                </button>
            </div>

        </div>

        <!-- ================= NOTIFICATION ALERTS ================= -->
        @if(session('vehicle_success') || $success)
            <div id="alert-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/90 rounded-2xl text-emerald-800 text-xs sm:text-sm shadow-xs transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <span class="font-bold text-emerald-900">Success:</span>
                        <span>{{ session('vehicle_success') ?? $success }}</span>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        @endif

        @if(session('vehicle_error') || $error)
            <div id="alert-error" class="flex items-center justify-between p-4 bg-red-50 border border-red-200/90 rounded-2xl text-red-800 text-xs sm:text-sm shadow-xs transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                    <div>
                        <span class="font-bold text-red-900">Notice:</span>
                        <span>{{ session('vehicle_error') ?? $error }}</span>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-red-600 hover:text-red-800 p-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        @endif

        <!-- ================= 4 SUMMARY METRIC CARDS ================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Registered Vehicles -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><path d="M5 10L7 5h10l2 5"></path><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Registered Vehicles</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $vehicleCount }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Total vehicles</span>
                </div>
            </div>

            <!-- Card 2: Primary Vehicle -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-slate-500 block">Primary Vehicle</span>
                        <span class="text-base sm:text-lg font-black text-slate-900 font-mono tracking-tight leading-tight block">
                            {{ $defaultVehicle['plate'] ?? 'None' }}
                        </span>
                        <span class="text-[11px] text-slate-400 font-medium truncate block">
                            {{ $defaultVehicle['display_name'] ?? 'Toyota Avanza' }}
                        </span>
                    </div>
                </div>
                <div class="w-7 h-7 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">
                    &gt;
                </div>
            </div>

            <!-- Card 3: Currently Parked -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><path d="M5 10L7 5h10l2 5"></path><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Currently Parked</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $activeVehiclesCount }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Active on-site</span>
                </div>
            </div>

            <!-- Card 4: Booked Slots -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Booked Slots</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $reservedVehiclesCount }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Upcoming booking</span>
                </div>
            </div>

        </div>

        <!-- ================= ANPR SMART GATE INFO BANNER ================= -->
        <div class="bg-gradient-to-r from-blue-50/70 via-indigo-50/30 to-white rounded-2xl border border-blue-100 p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-2xs">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 flex items-center gap-2">
                        <span>Automatic License Plate Recognition (ANPR) Active</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-100 text-blue-700 uppercase tracking-wide">SMART ACCESS</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                        All registered vehicles are recognized automatically at entry and exit, enabling ticketless access and faster parking.
                    </p>
                </div>
            </div>
            <div class="shrink-0 flex items-center gap-2 text-xs font-bold text-blue-600 bg-white px-3.5 py-1.5 rounded-xl border border-blue-200/70 shadow-2xs">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Format: B 1234 XYZ</span>
            </div>
        </div>

        <!-- ================= CATEGORY TABS & SEARCH ROW ================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            
            <!-- Category Tabs -->
            <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto" id="category-tabs">
                <!-- All Vehicles (3) -->
                <button type="button" 
                        onclick="filterCategory('all')" 
                        id="tab-all"
                        class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>All Vehicles ({{ $vehicleCount }})</span>
                </button>

                <!-- Car (1) -->
                <button type="button" 
                        onclick="filterCategory('car')" 
                        id="tab-car"
                        class="px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="10" width="18" height="8" rx="2"></rect>
                        <circle cx="7" cy="18" r="1.5"></circle>
                        <circle cx="17" cy="18" r="1.5"></circle>
                    </svg>
                    <span>Car (1)</span>
                </button>

                <!-- Electric Vehicle (1) -->
                <button type="button" 
                        onclick="filterCategory('ev')" 
                        id="tab-ev"
                        class="px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                    <span>Electric Vehicle (1)</span>
                </button>

                <!-- Motorcycle (1) -->
                <button type="button" 
                        onclick="filterCategory('motorcycle')" 
                        id="tab-motorcycle"
                        class="px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="5" cy="16" r="3"></circle>
                        <circle cx="19" cy="16" r="3"></circle>
                        <path d="M12 17l4-9h4"></path>
                    </svg>
                    <span>Motorcycle (1)</span>
                </button>
            </div>

            <!-- Search Input & Filter Icon -->
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative flex-1 sm:w-64">
                    <input type="text" 
                           id="vehicle-search" 
                           oninput="filterVehiclesLive()" 
                           placeholder="Search vehicle (e.g. B 1234 XYZ)" 
                           class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-2xs transition-all" />
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <button type="button" class="p-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 shadow-2xs transition-colors shrink-0">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                </button>
            </div>

        </div>

        <!-- ================= VEHICLE CARDS GRID ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="vehicles-grid">
            @forelse($vehicles as $vehicle)
                @php
                    $isCar = $vehicle['type'] === 'car';
                    $isEv = $vehicle['type'] === 'ev';
                    $isMoto = $vehicle['type'] === 'motorcycle';

                    // Determine image
                    $vehicleImg = 'images/vehicle-avanza.png';
                    if ($isEv || str_contains(strtolower($vehicle['display_name'] ?? ''), 'ioniq')) {
                        $vehicleImg = 'images/vehicle-ioniq5.png';
                    } elseif ($isMoto || str_contains(strtolower($vehicle['display_name'] ?? ''), 'vario')) {
                        $vehicleImg = 'images/vehicle-vario.png';
                    }
                @endphp

                <div class="vehicle-card bg-white rounded-3xl p-5 flex flex-col justify-between relative transition-all duration-200 {{ $vehicle['is_default'] ? 'border-2 border-blue-500 shadow-sm' : 'border border-slate-200/90 shadow-sm hover:shadow-md' }}"
                     data-type="{{ $vehicle['type'] }}"
                     data-plate="{{ strtoupper($vehicle['plate']) }}"
                     data-name="{{ strtolower($vehicle['display_name'] ?? '') }}">
                    
                    <div>
                        <!-- Top Header: Type Pill & Primary Badge -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <div>
                                @if($isCar)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-600">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                                        <span>Car</span>
                                    </span>
                                @elseif($isEv)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-600">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                        <span>Electric Vehicle</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="16" r="3"></circle><circle cx="19" cy="16" r="3"></circle><path d="M12 17l4-9h4"></path></svg>
                                        <span>Motorcycle</span>
                                    </span>
                                @endif
                            </div>

                            @if($vehicle['is_default'])
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-blue-600 text-white shadow-2xs">
                                    PRIMARY
                                </span>
                            @endif
                        </div>

                        <!-- Main Content: Vehicle Photo on Left, Details on Right -->
                        <div class="flex items-center gap-4 my-2">
                            <!-- Vehicle Cutout Photo -->
                            <div class="w-28 sm:w-32 h-20 flex items-center justify-center shrink-0">
                                <img src="{{ asset($vehicleImg) }}" alt="{{ $vehicle['display_name'] ?? 'Vehicle' }}" class="max-w-full max-h-full object-contain" />
                            </div>

                            <!-- Vehicle Info -->
                            <div class="flex-1 min-w-0">
                                <!-- Indonesian License Plate Badge -->
                                <div class="inline-block bg-slate-900 text-white font-mono font-bold text-xs sm:text-sm px-3 py-1 rounded-xl tracking-wider shadow-xs mb-1">
                                    {{ $vehicle['plate'] }}
                                </div>

                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">
                                    {{ $vehicle['display_name'] ?? 'Vehicle Model' }}
                                </h4>

                                <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
                                    <span>Added {{ date('d M Y', strtotime($vehicle['created_at'])) }}</span>
                                </div>

                                <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                    ID: {{ $vehicle['id'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Live Status Banner Strip -->
                        <div class="my-3">
                            @if(!empty($vehicle['has_active_session']))
                                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-emerald-50/90 border border-emerald-100 text-xs text-emerald-800">
                                    <div class="flex items-center gap-1.5 font-bold">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>Parked at NusaPark Central</span>
                                    </div>
                                    <a href="/active-parking" class="text-emerald-700 font-bold hover:underline flex items-center gap-0.5 text-xs">
                                        View &rarr;
                                    </a>
                                </div>
                            @elseif(!empty($vehicle['has_future_reservation']))
                                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-purple-50/90 border border-purple-100 text-xs text-purple-800">
                                    <div class="flex items-center gap-1.5 font-bold">
                                        <svg class="w-3.5 h-3.5 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
                                        <span>Upcoming Reservation</span>
                                    </div>
                                    <a href="/reservations" class="text-purple-700 font-bold hover:underline flex items-center gap-0.5 text-xs">
                                        Details &rarr;
                                    </a>
                                </div>
                            @else
                                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600">
                                    <div class="flex items-center gap-1.5 font-medium">
                                        <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        <span>Ready for entry</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-200/60 text-slate-600">
                                        Idle
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Row: Primary Switch & Action Buttons -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                        <div>
                            @if($vehicle['is_default'])
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-500">
                                    <svg class="w-3.5 h-3.5 text-amber-500" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                    <span>Default</span>
                                </span>
                            @else
                                <form method="POST" action="/vehicles/{{ $vehicle['id'] }}/default" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        <span>Set as Primary</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Action Icons: Edit & Delete -->
                        <div class="flex items-center gap-1">
                            <!-- Edit Button -->
                            <button type="button" 
                                    onclick="openEditModal({{ json_encode($vehicle) }})" 
                                    title="Edit vehicle"
                                    class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            @if(!empty($vehicle['has_active_session']) || !empty($vehicle['has_future_reservation']))
                                <button type="button" 
                                        disabled 
                                        title="Cannot delete active vehicle"
                                        class="p-1.5 text-slate-300 cursor-not-allowed opacity-50">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            @else
                                <button type="button" 
                                        onclick="openDeleteModal('{{ $vehicle['id'] }}', '{{ $vehicle['plate'] }}', '{{ $vehicle['display_name'] ?? $vehicle['type_label'] }}')" 
                                        title="Delete vehicle"
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">No Vehicles Registered</h3>
                    <p class="text-xs text-slate-400 mt-1 mb-4">Register your vehicle for ticketless parking access.</p>
                    <button type="button" onclick="openAddModal()" class="px-4 py-2 rounded-xl bg-blue-600 text-white font-bold text-xs">
                        + Register Vehicle
                    </button>
                </div>
            @endforelse
        </div>

    </div>

    <!-- ================= ADD VEHICLE MODAL ================= -->
    <div id="add-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="add-modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity" onclick="closeAddModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 sm:p-7 border border-slate-200 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900" id="add-modal-title">Register New Vehicle</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Add vehicle for automatic gate access & ticketless parking</p>
                    </div>
                    <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form method="POST" action="/vehicles" class="mt-5 space-y-4">
                    @csrf

                    <!-- License Plate -->
                    <div>
                        <label for="add-plate" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            License Plate Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="add-plate" 
                               name="plate" 
                               value="{{ old('plate') }}" 
                               placeholder="e.g. B 1234 XYZ" 
                               required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-mono text-base font-bold uppercase tracking-wider text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                               oninput="this.value = this.value.toUpperCase()">
                        <p class="text-[11px] text-slate-400 mt-1">Format: B 1234 XYZ</p>
                        @if(isset($errors) && $errors->has('plate'))
                            <p class="text-xs text-red-600 mt-1 font-semibold">{{ $errors->first('plate') }}</p>
                        @endif
                    </div>

                    <!-- Vehicle Type -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Vehicle Type <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2.5">
                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-blue-500 hover:bg-blue-50/30 transition-all text-center">
                                <input type="radio" name="type" value="car" class="sr-only peer" checked>
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-blue-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle>
                                    </svg>
                                    <span class="text-xs">Car</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-blue-600 rounded-2xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-amber-500 hover:bg-amber-50/30 transition-all text-center">
                                <input type="radio" name="type" value="motorcycle" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-amber-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="5" cy="16" r="3"></circle><circle cx="19" cy="16" r="3"></circle><path d="M12 17l4-9h4"></path>
                                    </svg>
                                    <span class="text-xs">Motorcycle</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-amber-500 rounded-2xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/30 transition-all text-center">
                                <input type="radio" name="type" value="ev" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-emerald-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                    <span class="text-xs">Electric (EV)</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-emerald-500 rounded-2xl pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Make & Model row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="add-make" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Brand / Make
                            </label>
                            <input type="text" 
                                   id="add-make" 
                                   name="make" 
                                   value="{{ old('make') }}" 
                                   placeholder="e.g. Toyota, Honda" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                        <div>
                            <label for="add-model" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Model
                            </label>
                            <input type="text" 
                                   id="add-model" 
                                   name="model" 
                                   value="{{ old('model') }}" 
                                   placeholder="e.g. Avanza, Vario 160" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="add-color" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Vehicle Color
                        </label>
                        <input type="text" 
                               id="add-color" 
                               name="color" 
                               value="{{ old('color') }}" 
                               placeholder="e.g. White, Silver, Black" 
                               class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                    </div>

                    <!-- Set as Default Checkbox -->
                    <div class="pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" 
                                   name="is_default" 
                                   value="1" 
                                   class="w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500">
                            <span class="text-xs font-semibold text-slate-700">
                                Set as primary vehicle for automatic barrier access
                            </span>
                        </label>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <button type="button" 
                                onclick="closeAddModal()" 
                                class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition-all">
                            Save Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= EDIT VEHICLE MODAL ================= -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="edit-modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity" onclick="closeEditModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 sm:p-7 border border-slate-200 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900" id="edit-modal-title">Edit Vehicle</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Update vehicle details and preferences</p>
                    </div>
                    <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form id="edit-form" method="POST" action="" class="mt-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="edit-plate" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            License Plate Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="edit-plate" 
                               name="plate" 
                               required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-mono text-base font-bold uppercase tracking-wider text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                               oninput="this.value = this.value.toUpperCase()">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Vehicle Type <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2.5">
                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-blue-500 hover:bg-blue-50/30 transition-all text-center">
                                <input type="radio" name="type" value="car" id="edit-type-car" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-blue-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle>
                                    </svg>
                                    <span class="text-xs">Car</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-blue-600 rounded-2xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-amber-500 hover:bg-amber-50/30 transition-all text-center">
                                <input type="radio" name="type" value="motorcycle" id="edit-type-motorcycle" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-amber-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="5" cy="16" r="3"></circle><circle cx="19" cy="16" r="3"></circle><path d="M12 17l4-9h4"></path>
                                    </svg>
                                    <span class="text-xs">Motorcycle</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-amber-500 rounded-2xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-slate-200 rounded-2xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/30 transition-all text-center">
                                <input type="radio" name="type" value="ev" id="edit-type-ev" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-emerald-600 peer-checked:font-bold">
                                    <svg class="w-6 h-6 mb-1 text-slate-500 peer-checked:text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                    <span class="text-xs">Electric (EV)</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-emerald-500 rounded-2xl pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="edit-make" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Brand / Make</label>
                            <input type="text" id="edit-make" name="make" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                        <div>
                            <label for="edit-model" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Model</label>
                            <input type="text" id="edit-model" name="model" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="edit-color" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Vehicle Color</label>
                        <input type="text" id="edit-color" name="color" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" id="edit-is-default" name="is_default" value="1" class="w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500">
                            <span class="text-xs font-semibold text-slate-700">Set as primary vehicle for automatic barrier access</span>
                        </label>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition-all">Update Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= DELETE VEHICLE MODAL ================= -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center border border-slate-200 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Remove Vehicle?</h3>
                <p class="text-xs text-slate-500 mt-1 mb-4">
                    Are you sure you want to remove <span class="font-bold text-slate-800" id="delete-vehicle-plate"></span> (<span id="delete-vehicle-name"></span>)? This action cannot be undone.
                </p>

                <form id="delete-form" method="POST" action="" class="flex items-center gap-2.5">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-red-600 hover:bg-red-700 text-white shadow-sm transition-all">
                        Remove
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= CLIENT-SIDE SCRIPTS FOR CATEGORY & SEARCH ================= -->
    @push('scripts')
    <script>
        let currentCategory = 'all';

        function filterCategory(cat) {
            currentCategory = cat;
            
            // Update Tab styles
            const tabs = ['all', 'car', 'ev', 'motorcycle'];
            tabs.forEach(t => {
                const el = document.getElementById('tab-' + t);
                if (el) {
                    if (t === cat) {
                        el.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm flex items-center gap-1.5 transition-all cursor-pointer';
                    } else {
                        el.className = 'px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center gap-1.5 transition-all cursor-pointer';
                    }
                }
            });

            applyCardFilters();
        }

        function filterVehiclesLive() {
            applyCardFilters();
        }

        function applyCardFilters() {
            const query = (document.getElementById('vehicle-search')?.value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.vehicle-card');

            cards.forEach(card => {
                const type = card.getAttribute('data-type');
                const plate = (card.getAttribute('data-plate') || '').toLowerCase();
                const name = (card.getAttribute('data-name') || '').toLowerCase();

                const matchesCat = (currentCategory === 'all') || (type === currentCategory);
                const matchesSearch = !query || plate.includes(query) || name.includes(query);

                if (matchesCat && matchesSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Modal Helpers
        function openAddModal() {
            document.getElementById('add-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                const plateInput = document.getElementById('add-plate');
                if (plateInput) plateInput.focus();
            }, 50);
        }

        function closeAddModal() {
            document.getElementById('add-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function openEditModal(vehicle) {
            if (!vehicle) return;
            const form = document.getElementById('edit-form');
            form.action = '/vehicles/' + vehicle.id;

            document.getElementById('edit-plate').value = vehicle.plate || '';
            document.getElementById('edit-make').value = vehicle.make || '';
            document.getElementById('edit-model').value = vehicle.model || '';
            document.getElementById('edit-color').value = vehicle.color || '';
            document.getElementById('edit-is-default').checked = !!vehicle.is_default;

            const carRadio = document.getElementById('edit-type-car');
            const motoRadio = document.getElementById('edit-type-motorcycle');
            const evRadio = document.getElementById('edit-type-ev');

            if (vehicle.type === 'motorcycle' && motoRadio) {
                motoRadio.checked = true;
            } else if (vehicle.type === 'ev' && evRadio) {
                evRadio.checked = true;
            } else if (carRadio) {
                carRadio.checked = true;
            }

            document.getElementById('edit-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function openDeleteModal(id, plate, name) {
            const form = document.getElementById('delete-form');
            form.action = '/vehicles/' + id;
            document.getElementById('delete-vehicle-plate').textContent = plate;
            document.getElementById('delete-vehicle-name').textContent = name || 'Vehicle';

            document.getElementById('delete-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // ESC listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddModal();
                closeEditModal();
                closeDeleteModal();
            }
        });

        @if(session('show_modal') === 'add')
            openAddModal();
        @endif
    </script>
    @endpush

</x-layouts.app>
