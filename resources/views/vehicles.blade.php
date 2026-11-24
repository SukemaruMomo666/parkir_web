<x-layouts.app activeNav="vehicles">
    <div class="w-full space-y-6 md:space-y-8">

        <!-- ================= PAGE HEADER & TITLE ================= -->
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-1 sm:pt-2">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-[var(--accent)] border border-blue-200/60">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        Vehicle Management
                    </span>
                    <span class="text-xs text-[var(--text-muted)]">Driver Portal</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)] mt-1.5">My Vehicles</h1>
                <p class="text-[var(--text-muted)] text-sm md:text-base mt-1">
                    Manage registered vehicles for automatic smart barrier recognition (ANPR), ticketless entry, and quick bookings.
                </p>
            </div>

            <div class="flex items-center gap-2.5 self-start sm:self-auto">
                <button type="button" 
                        onclick="openAddModal()" 
                        class="inline-flex items-center gap-2 bg-[var(--accent)] hover:bg-[var(--accent-hover)] text-white px-4 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[var(--accent)]">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Register Vehicle</span>
                </button>
            </div>
        </header>

        <!-- ================= NOTIFICATION ALERTS ================= -->
        @if(session('vehicle_success') || $success)
            <div id="alert-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <span class="font-semibold text-emerald-900">Success:</span>
                        <span>{{ session('vehicle_success') ?? $success }}</span>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('vehicle_error') || $error)
            <div id="alert-error" class="flex items-center justify-between p-4 bg-red-50 border border-red-200/80 rounded-xl text-red-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div>
                        <span class="font-semibold text-red-900">Notice:</span>
                        <span>{{ session('vehicle_error') ?? $error }}</span>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        <!-- ================= SUMMARY METRICS ================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Registered Vehicles -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Registered Vehicles</span>
                    <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <circle cx="7" cy="15" r="2"></circle>
                            <circle cx="17" cy="15" r="2"></circle>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--text)]">{{ $vehicleCount }}</span>
                    <span class="text-xs text-[var(--text-muted)]">{{ $vehicleCount === 1 ? '1 vehicle' : $vehicleCount . ' vehicles' }}</span>
                </div>
            </div>

            <!-- Primary / Default Vehicle -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent)]">Primary Vehicle</span>
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[var(--accent)] flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    @if($defaultVehicle)
                        <div class="text-sm font-bold text-[var(--text)] truncate">{{ $defaultVehicle['plate'] }}</div>
                        <div class="text-xs text-[var(--text-muted)] truncate">{{ $defaultVehicle['display_name'] ?? $defaultVehicle['type_label'] }}</div>
                    @else
                        <span class="text-sm font-medium text-[var(--text-muted)]">None Selected</span>
                    @endif
                </div>
            </div>

            <!-- Active In Facility -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Currently Parked</span>
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-emerald-700">{{ $activeVehiclesCount }}</span>
                    <span class="text-xs text-[var(--text-muted)]">{{ $activeVehiclesCount > 0 ? 'Active on-site' : 'None parked' }}</span>
                </div>
            </div>

            <!-- Future Reservations -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-700">Booked Slots</span>
                    <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-purple-700">{{ $reservedVehiclesCount }}</span>
                    <span class="text-xs text-[var(--text-muted)]">Upcoming booking</span>
                </div>
            </div>
        </div>

        <!-- ================= ANPR SMART GATE INFO BANNER ================= -->
        <div class="dashboard-card p-4 sm:p-5 bg-gradient-to-r from-blue-50/70 via-indigo-50/40 to-slate-50 border border-blue-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-[var(--accent)] text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[var(--primary)] flex items-center gap-2">
                        Automatic License Plate Recognition (ANPR) Active
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800 uppercase tracking-wide">Smart Gates</span>
                    </h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5 leading-relaxed">
                        At partner facilities, gates open automatically upon plate scanning. The primary vehicle will be pre-selected for ticketless sessions and app reservations.
                    </p>
                </div>
            </div>
            <div class="shrink-0 flex items-center gap-2 text-xs font-semibold text-[var(--accent)] bg-white/80 px-3 py-1.5 rounded-lg border border-blue-200/60 shadow-xs">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Format: B 1234 XYZ</span>
            </div>
        </div>

        <!-- ================= VEHICLE CARDS GRID ================= -->
        @if($vehicleCount === 0)
            <!-- EMPTY STATE -->
            <div class="dashboard-card p-8 md:p-14 text-center">
                <div class="w-16 h-16 bg-blue-50 text-[var(--accent)] rounded-2xl flex items-center justify-center mx-auto mb-4 border border-blue-100 shadow-sm">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                        <circle cx="7" cy="15" r="2"></circle>
                        <circle cx="17" cy="15" r="2"></circle>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--text)] mb-1">No Vehicles Registered</h3>
                <p class="text-sm text-[var(--text-muted)] max-w-md mx-auto mb-6">
                    Add your car or motorcycle to experience seamless automatic barrier opening and instant ticketless parking.
                </p>
                <button type="button" 
                        onclick="openAddModal()" 
                        class="inline-flex items-center gap-2 bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-md shadow-slate-900/10">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Register Your First Vehicle</span>
                </button>
            </div>
        @else
            <!-- VEHICLES GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($vehicles as $vehicle)
                    <div class="dashboard-card p-5 flex flex-col justify-between relative overflow-hidden group hover:border-[var(--accent)]/40 transition-all duration-200">
                        
                        <!-- Top Accent Line if Default -->
                        @if($vehicle['is_default'])
                            <div class="absolute top-0 left-0 right-0 h-1 bg-[var(--accent)]"></div>
                        @endif

                        <div>
                            <!-- Card Header: Type Badge & Default Status -->
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <div class="flex items-center gap-2">
                                    @if($vehicle['type'] === 'car')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-[var(--accent)] border border-blue-200/60">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                                <circle cx="7" cy="15" r="2"></circle>
                                                <circle cx="17" cy="15" r="2"></circle>
                                            </svg>
                                            Car
                                        </span>
                                    @elseif($vehicle['type'] === 'motorcycle')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/60">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="5" cy="16" r="3"></circle>
                                                <circle cx="19" cy="16" r="3"></circle>
                                                <path d="M12 17l4-9h4"></path>
                                                <path d="M5 16l4-7h5"></path>
                                            </svg>
                                            Motorcycle
                                        </span>
                                    @elseif($vehicle['type'] === 'ev')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                            </svg>
                                            Electric Vehicle
                                        </span>
                                    @endif

                                    @if($vehicle['color'])
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-600">
                                            <span class="w-2 h-2 rounded-full border border-slate-300" style="background-color: {{ strtolower($vehicle['color']) === 'white' ? '#FFFFFF' : (strtolower($vehicle['color']) === 'black' ? '#1E293B' : (strtolower($vehicle['color']) === 'silver' ? '#94A3B8' : '#64748B')) }}"></span>
                                            {{ $vehicle['color'] }}
                                        </span>
                                    @endif
                                </div>

                                @if($vehicle['is_default'])
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100/80 text-[var(--accent)] border border-blue-200">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        Primary
                                    </span>
                                @endif
                            </div>

                            <!-- Indonesian License Plate Visual -->
                            <div class="mb-4">
                                <div class="bg-slate-900 border-2 border-slate-700 rounded-xl px-4 py-2.5 shadow-md flex items-center justify-between text-white font-mono">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                        <span class="text-lg md:text-xl font-black tracking-widest">{{ $vehicle['plate'] }}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-semibold tracking-wider">10 · 29</span>
                                </div>
                            </div>

                            <!-- Vehicle Make & Model Description -->
                            <div class="space-y-1 mb-4">
                                <h4 class="text-base font-bold text-[var(--text)] truncate">
                                    {{ $vehicle['display_name'] ?? 'Unspecified Model' }}
                                </h4>
                                <div class="flex items-center justify-between text-xs text-[var(--text-muted)]">
                                    <span>Added {{ date('d M Y', strtotime($vehicle['created_at'])) }}</span>
                                    <span class="font-mono text-[11px] text-slate-400">ID: {{ $vehicle['id'] }}</span>
                                </div>
                            </div>

                            <!-- Live Activity Status Badge -->
                            <div class="pt-3 border-t border-[var(--border)] mb-4">
                                @if(!empty($vehicle['has_active_session']))
                                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-emerald-50/80 border border-emerald-200 text-xs text-emerald-800">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span class="font-bold">Parked at NusaPark Central</span>
                                        </div>
                                        <a href="/active-parking" class="text-emerald-700 font-bold hover:underline flex items-center gap-0.5">
                                            View
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        </a>
                                    </div>
                                @elseif(!empty($vehicle['has_future_reservation']))
                                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-purple-50/80 border border-purple-200 text-xs text-purple-800">
                                        <div class="flex items-center gap-2">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
                                            <span class="font-bold">Upcoming Reservation</span>
                                        </div>
                                        <a href="/reservations" class="text-purple-700 font-bold hover:underline flex items-center gap-0.5">
                                            Details
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        </a>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100 text-xs text-slate-500">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            <span>Ready for entry</span>
                                        </div>
                                        <span class="font-medium text-slate-400">Idle</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="pt-2 flex items-center justify-between gap-2 border-t border-[var(--border)]">
                            <div class="flex items-center gap-1.5">
                                @if(!$vehicle['is_default'])
                                    <form method="POST" action="/vehicles/{{ $vehicle['id'] }}/default" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                title="Set as primary vehicle for automatic gate access"
                                                class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--accent)] hover:text-[var(--accent-hover)] hover:bg-blue-50 px-2.5 py-1.5 rounded-lg transition-colors cursor-pointer">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                            </svg>
                                            Set Primary
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-400 px-2 py-1.5">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" class="text-amber-500">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        Default
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-1">
                                <!-- Edit Button -->
                                <button type="button" 
                                        onclick="openEditModal({{ json_encode($vehicle) }})" 
                                        title="Edit vehicle details"
                                        class="p-2 text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 rounded-lg transition-colors cursor-pointer">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>

                                <!-- Delete Button -->
                                @if(!empty($vehicle['has_active_session']) || !empty($vehicle['has_future_reservation']))
                                    <button type="button" 
                                            disabled 
                                            title="Cannot delete: active session or reservation exists"
                                            class="p-2 text-slate-300 cursor-not-allowed rounded-lg opacity-50">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                @else
                                    <button type="button" 
                                            onclick="openDeleteModal('{{ $vehicle['id'] }}', '{{ $vehicle['plate'] }}', '{{ $vehicle['display_name'] ?? $vehicle['type_label'] }}')" 
                                            title="Remove vehicle"
                                            class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <!-- ================= ADD VEHICLE MODAL ================= -->
    <div id="add-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="add-modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeAddModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 sm:p-7 border border-[var(--border)] overflow-hidden">
                <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
                    <div>
                        <h3 class="text-lg font-bold text-[var(--text)]" id="add-modal-title">Register New Vehicle</h3>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">Add vehicle for automatic gate access & ticketless parking</p>
                    </div>
                    <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="/vehicles" class="mt-5 space-y-4">
                    @csrf

                    <!-- License Plate -->
                    <div>
                        <label for="add-plate" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                            License Plate Number <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="add-plate" 
                                   name="plate" 
                                   value="{{ old('plate') }}" 
                                   placeholder="e.g. B 1234 XYZ" 
                                   required 
                                   class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl font-mono text-base font-bold uppercase tracking-wider text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                                   oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Indonesian plate format (e.g., B 1234 XYZ, D 999 AB)</p>
                        @error('plate')
                            <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vehicle Type -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                            Vehicle Type <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2.5">
                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-[var(--accent)] hover:bg-blue-50/30 transition-all text-center">
                                <input type="radio" name="type" value="car" class="sr-only peer" checked>
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-[var(--accent)] peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-[var(--accent)]">
                                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                        <circle cx="7" cy="15" r="2"></circle>
                                        <circle cx="17" cy="15" r="2"></circle>
                                    </svg>
                                    <span class="text-xs">Car</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[var(--accent)] rounded-xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-amber-500 hover:bg-amber-50/30 transition-all text-center">
                                <input type="radio" name="type" value="motorcycle" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-amber-600 peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-amber-600">
                                        <circle cx="5" cy="16" r="3"></circle>
                                        <circle cx="19" cy="16" r="3"></circle>
                                        <path d="M12 17l4-9h4"></path>
                                        <path d="M5 16l4-7h5"></path>
                                    </svg>
                                    <span class="text-xs">Motorcycle</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-amber-500 rounded-xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/30 transition-all text-center">
                                <input type="radio" name="type" value="ev" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-emerald-600 peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-emerald-600">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                    <span class="text-xs">Electric (EV)</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-emerald-500 rounded-xl pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Make & Model row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="add-make" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                                Brand / Make
                            </label>
                            <input type="text" 
                                   id="add-make" 
                                   name="make" 
                                   value="{{ old('make') }}" 
                                   placeholder="e.g. Toyota, Honda" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                        <div>
                            <label for="add-model" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                                Model
                            </label>
                            <input type="text" 
                                   id="add-model" 
                                   name="model" 
                                   value="{{ old('model') }}" 
                                   placeholder="e.g. Avanza, Vario 160" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="add-color" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                            Vehicle Color
                        </label>
                        <input type="text" 
                               id="add-color" 
                               name="color" 
                               value="{{ old('color') }}" 
                               placeholder="e.g. Silver, Black, White" 
                               class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                    </div>

                    <!-- Set as Default Checkbox -->
                    <div class="pt-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="is_default" 
                                   value="1" 
                                   class="w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            <span class="text-xs font-semibold text-[var(--text)]">
                                Set as primary vehicle for automatic gate recognition
                            </span>
                        </label>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-[var(--border)]">
                        <button type="button" 
                                onclick="closeAddModal()" 
                                class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-[var(--accent)] hover:bg-[var(--accent-hover)] text-white shadow-md shadow-blue-500/20 transition-all">
                            Save Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= EDIT VEHICLE MODAL ================= -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="edit-modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeEditModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 sm:p-7 border border-[var(--border)] overflow-hidden">
                <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
                    <div>
                        <h3 class="text-lg font-bold text-[var(--text)]" id="edit-modal-title">Edit Vehicle</h3>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">Update vehicle details and preferences</p>
                    </div>
                    <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form id="edit-form" method="POST" action="" class="mt-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- License Plate -->
                    <div>
                        <label for="edit-plate" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                            License Plate Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="edit-plate" 
                               name="plate" 
                               required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl font-mono text-base font-bold uppercase tracking-wider text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                               oninput="this.value = this.value.toUpperCase()">
                    </div>

                    <!-- Vehicle Type -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                            Vehicle Type <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2.5">
                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-[var(--accent)] transition-all text-center">
                                <input type="radio" id="edit-type-car" name="type" value="car" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-[var(--accent)] peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-[var(--accent)]">
                                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                        <circle cx="7" cy="15" r="2"></circle>
                                        <circle cx="17" cy="15" r="2"></circle>
                                    </svg>
                                    <span class="text-xs">Car</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[var(--accent)] rounded-xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-amber-500 transition-all text-center">
                                <input type="radio" id="edit-type-motorcycle" name="type" value="motorcycle" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-amber-600 peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-amber-600">
                                        <circle cx="5" cy="16" r="3"></circle>
                                        <circle cx="19" cy="16" r="3"></circle>
                                        <path d="M12 17l4-9h4"></path>
                                        <path d="M5 16l4-7h5"></path>
                                    </svg>
                                    <span class="text-xs">Motorcycle</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-amber-500 rounded-xl pointer-events-none"></div>
                            </label>

                            <label class="relative flex flex-col items-center p-3 border border-[var(--border)] rounded-xl cursor-pointer hover:border-emerald-500 transition-all text-center">
                                <input type="radio" id="edit-type-ev" name="type" value="ev" class="sr-only peer">
                                <div class="w-full h-full flex flex-col items-center peer-checked:text-emerald-600 peer-checked:font-bold">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-1 text-slate-500 peer-checked:text-emerald-600">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                    <span class="text-xs">Electric (EV)</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-emerald-500 rounded-xl pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Make & Model row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="edit-make" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                                Brand / Make
                            </label>
                            <input type="text" 
                                   id="edit-make" 
                                   name="make" 
                                   placeholder="e.g. Toyota" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                        <div>
                            <label for="edit-model" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                                Model
                            </label>
                            <input type="text" 
                                   id="edit-model" 
                                   name="model" 
                                   placeholder="e.g. Avanza" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                        </div>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="edit-color" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1">
                            Vehicle Color
                        </label>
                        <input type="text" 
                               id="edit-color" 
                               name="color" 
                               placeholder="e.g. Silver, Black" 
                               class="w-full px-3.5 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                    </div>

                    <!-- Set as Default Checkbox -->
                    <div class="pt-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   id="edit-is-default" 
                                   name="is_default" 
                                   value="1" 
                                   class="w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            <span class="text-xs font-semibold text-[var(--text)]">
                                Set as primary vehicle for automatic gate recognition
                            </span>
                        </label>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-[var(--border)]">
                        <button type="button" 
                                onclick="closeEditModal()" 
                                class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-[var(--accent)] hover:bg-[var(--accent-hover)] text-white shadow-md shadow-blue-500/20 transition-all">
                            Update Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= DELETE CONFIRMATION MODAL ================= -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="delete-modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 text-center border border-[var(--border)]">
                <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-[var(--text)]" id="delete-modal-title">Remove Vehicle</h3>
                <p class="text-xs text-[var(--text-muted)] mt-1 mb-4">
                    Are you sure you want to remove <span id="delete-vehicle-plate" class="font-mono font-bold text-[var(--primary)]"></span> (<span id="delete-vehicle-name"></span>) from your account?
                </p>
                <div class="p-3 bg-amber-50 border border-amber-200/80 rounded-xl text-left text-[11px] text-amber-800 mb-6 flex items-start gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5 text-amber-600">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>This vehicle will no longer be recognized by automatic barriers and won't be available for quick reservations.</span>
                </div>

                <form id="delete-form" method="POST" action="" class="flex items-center justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-700 text-white shadow-md shadow-red-600/20 transition-all">
                        Yes, Remove
                    </button>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
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

        // Type radio
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

    // Keyboard navigation (ESC to close modals)
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
