<x-layouts.vendor activeNav="iot" title="IoT Devices Inventory & Monitoring - NusaPark Enterprise">

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
                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                    <rect x="9" y="9" width="6" height="6"></rect>
                    <line x1="9" y1="1" x2="9" y2="4"></line>
                    <line x1="15" y1="1" x2="15" y2="4"></line>
                    <line x1="9" y1="20" x2="9" y2="23"></line>
                    <line x1="15" y1="20" x2="15" y2="23"></line>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure Fleet • Page 27</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        IoT Mesh Online
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    IoT Devices
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Monitor connected parking infrastructure and manage registered devices across your facilities.
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
                        onchange="window.location.href = '/vendor/iot-devices?facility=' + this.value"
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

            <!-- Refresh Fleet State -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer flex items-center gap-1.5 text-xs font-semibold"
                    title="Refresh telemetry state from connected devices">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>

            <!-- Register Device Action -->
            <button type="button" 
                    onclick="openAddDeviceModal()" 
                    class="px-4 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold flex items-center gap-2 shadow-xs transition-colors cursor-pointer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Register Device</span>
            </button>
        </div>

    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <section aria-labelledby="iot-metrics-heading">
        <h2 id="iot-metrics-heading" class="sr-only">IoT Fleet Operational Metrics</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5">
            
            <!-- 1. Total Registered Devices -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Fleet Total</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-[var(--text)] tracking-tight">
                        {{ $metrics['total_devices'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        Registered units
                    </div>
                </div>
            </div>

            <!-- 2. Connected Online Devices -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-emerald-600">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Connected</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-emerald-600 tracking-tight">
                        {{ $metrics['online_count'] }}
                    </div>
                    <div class="text-[11px] text-emerald-700/80 mt-0.5 font-medium">
                        Active heartbeat
                    </div>
                </div>
            </div>

            <!-- 3. Disconnected / Degraded Devices -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Offline / Degraded</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ ($metrics['offline_count'] + $metrics['degraded_count']) > 0 ? 'text-rose-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['offline_count'] + $metrics['degraded_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['offline_count'] }} offline • {{ $metrics['degraded_count'] }} jitter
                    </div>
                </div>
            </div>

            <!-- 4. Optimal Healthy State -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Health Rate</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-indigo-600 tracking-tight">
                        {{ $metrics['health_rate'] }}%
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['healthy_count'] }} optimal units
                    </div>
                </div>
            </div>

            <!-- 5. Attention / Warning Alerts -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Warnings / Faults</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ ($metrics['warning_count'] + $metrics['fault_count']) > 0 ? 'text-amber-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['warning_count'] + $metrics['fault_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ ($metrics['warning_count'] + $metrics['fault_count']) > 0 ? 'Requires attention' : 'No alerts reported' }}
                    </div>
                </div>
            </div>

            <!-- 6. Maintenance Mode -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Maintenance</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ $metrics['maintenance_count'] > 0 ? 'text-purple-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['maintenance_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        Active servicing
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= SEARCH, FILTERS & SORTING TOOLBAR ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        
        <form method="GET" action="/vendor/iot-devices" id="iot-filter-form" class="space-y-4">
            <!-- Hidden Facility Preserve -->
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <!-- Primary Search Row -->
            <div class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search device code (e.g. DEV-CTR-XYZ-01), name, hardware model, IP address, or area..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all">
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Apply Filter</span>
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/iot-devices?facility={{ $facilityId }}" 
                       class="px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5"
                       title="Reset all active search and filter options">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Clear</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Granular Filter Dropdowns Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-2.5 pt-2 border-t border-slate-100">
                
                <!-- Area Filter -->
                <div>
                    <label for="filter-area" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Parking Area</label>
                    <select id="filter-area" 
                            name="area" 
                            onchange="document.getElementById('iot-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['area'] === 'all') ? 'selected' : '' }}>All Parking Areas</option>
                        @foreach($areas as $ar)
                            <option value="{{ $ar['id'] }}" {{ ($filters['area'] === $ar['id']) ? 'selected' : '' }}>
                                {{ $ar['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Device Type Filter -->
                <div>
                    <label for="filter-device-type" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Device Type</label>
                    <select id="filter-device-type" 
                            name="device_type" 
                            onchange="document.getElementById('iot-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['device_type'] === 'all') ? 'selected' : '' }}>All Equipment Types</option>
                        <option value="barrier_controller" {{ ($filters['device_type'] === 'barrier_controller') ? 'selected' : '' }}>Barrier PLC Controller</option>
                        <option value="anpr_camera" {{ ($filters['device_type'] === 'anpr_camera') ? 'selected' : '' }}>ANPR Camera</option>
                        <option value="slot_sensor" {{ ($filters['device_type'] === 'slot_sensor') ? 'selected' : '' }}>Slot Occupancy Sensor Hub</option>
                        <option value="guidance_display" {{ ($filters['device_type'] === 'guidance_display') ? 'selected' : '' }}>VMS LED Display</option>
                        <option value="payment_kiosk" {{ ($filters['device_type'] === 'payment_kiosk') ? 'selected' : '' }}>Payment Terminal Kiosk</option>
                        <option value="edge_gateway" {{ ($filters['device_type'] === 'edge_gateway') ? 'selected' : '' }}>Industrial Edge Gateway</option>
                        <option value="loop_detector" {{ ($filters['device_type'] === 'loop_detector') ? 'selected' : '' }}>Loop Detector</option>
                        <option value="safety_beam" {{ ($filters['device_type'] === 'safety_beam') ? 'selected' : '' }}>Optical Safety Curtain</option>
                    </select>
                </div>

                <!-- Connectivity Filter -->
                <div>
                    <label for="filter-connectivity" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Connectivity</label>
                    <select id="filter-connectivity" 
                            name="connectivity" 
                            onchange="document.getElementById('iot-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['connectivity'] === 'all') ? 'selected' : '' }}>All Connectivity</option>
                        <option value="online" {{ ($filters['connectivity'] === 'online') ? 'selected' : '' }}>Online (Heartbeat OK)</option>
                        <option value="degraded" {{ ($filters['connectivity'] === 'degraded') ? 'selected' : '' }}>Degraded (High Latency)</option>
                        <option value="offline" {{ ($filters['connectivity'] === 'offline') ? 'selected' : '' }}>Offline (Unreachable)</option>
                    </select>
                </div>

                <!-- Health Status Filter -->
                <div>
                    <label for="filter-health" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Health Status</label>
                    <select id="filter-health" 
                            name="health_status" 
                            onchange="document.getElementById('iot-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['health_status'] === 'all') ? 'selected' : '' }}>All Health States</option>
                        <option value="Healthy" {{ ($filters['health_status'] === 'Healthy') ? 'selected' : '' }}>Healthy (Optimal)</option>
                        <option value="Warning" {{ ($filters['health_status'] === 'Warning') ? 'selected' : '' }}>Warning (Check Required)</option>
                        <option value="Fault" {{ ($filters['health_status'] === 'Fault') ? 'selected' : '' }}>Fault (Interlock Engaged)</option>
                        <option value="Maintenance" {{ ($filters['health_status'] === 'Maintenance') ? 'selected' : '' }}>Maintenance Mode</option>
                    </select>
                </div>

                <!-- Sorting Criteria -->
                <div>
                    <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Sort By</label>
                    <select id="filter-sort" 
                            name="sort" 
                            onchange="document.getElementById('iot-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="code_asc" {{ ($filters['sort'] === 'code_asc') ? 'selected' : '' }}>Device Code (A &rarr; Z)</option>
                        <option value="code_desc" {{ ($filters['sort'] === 'code_desc') ? 'selected' : '' }}>Device Code (Z &rarr; A)</option>
                        <option value="name_asc" {{ ($filters['sort'] === 'name_asc') ? 'selected' : '' }}>Device Name (A &rarr; Z)</option>
                        <option value="type_asc" {{ ($filters['sort'] === 'type_asc') ? 'selected' : '' }}>Equipment Type</option>
                        <option value="connectivity_asc" {{ ($filters['sort'] === 'connectivity_asc') ? 'selected' : '' }}>Connectivity State</option>
                        <option value="health_asc" {{ ($filters['sort'] === 'health_asc') ? 'selected' : '' }}>Health State</option>
                    </select>
                </div>

            </div>
        </form>

        <!-- Filter Count Banner -->
        <div class="flex items-center justify-between text-xs text-[var(--text-muted)] pt-1">
            <div class="flex items-center gap-2">
                <span>Showing <strong>{{ count($devices) }}</strong> of <strong>{{ $pagination['total'] }}</strong> matching IoT units</span>
                @if($hasActiveFilters)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Filtered Query
                </span>
                @endif
            </div>
            <div class="hidden sm:block text-[11px] text-slate-400">
                IoT Protocol Gateway: <strong>MQTT TLS v1.3 • Heartbeat (5s)</strong>
            </div>
        </div>

    </div>

    <!-- ================= IOT FLEET INVENTORY DATA TABLE / CARDS ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        @if(count($devices) > 0)
        <!-- DESKTOP TABLE (Hidden on Mobile) -->
        <div class="hidden lg:block overflow-x-auto scrollbar-thin">
            <table class="w-full text-left border-collapse min-w-[960px]">
                <colgroup>
                    <col class="w-[23%]"> <!-- Device & Type -->
                    <col class="w-[16%]"> <!-- Location & Area -->
                    <col class="w-[16%]"> <!-- Hardware & Network -->
                    <col class="w-[10%]"> <!-- Connectivity -->
                    <col class="w-[15%]"> <!-- Health & Diagnostics -->
                    <col class="w-[10%]"> <!-- Telemetry -->
                    <col class="w-[10%]"> <!-- Actions -->
                </colgroup>
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Device & Type</th>
                        <th class="py-3.5 px-3">Location & Placement</th>
                        <th class="py-3.5 px-3">Hardware & IP</th>
                        <th class="py-3.5 px-3">Connectivity</th>
                        <th class="py-3.5 px-3">Health & Diagnostics</th>
                        <th class="py-3.5 px-3">Telemetry</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-xs font-medium">
                    @foreach($devices as $device)
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        
                        <!-- 1. Device Code & Name -->
                        <td class="py-3.5 px-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100/90 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap tracking-tight group-hover:border-[var(--primary)] group-hover:text-[var(--primary)] transition-colors">
                                        {{ $device['device_code'] }}
                                    </span>
                                    
                                    <!-- Device Type Badge -->
                                    @if($device['device_type'] === 'barrier_controller')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 whitespace-nowrap">
                                        PLC
                                    </span>
                                    @elseif($device['device_type'] === 'anpr_camera')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200 whitespace-nowrap">
                                        ANPR
                                    </span>
                                    @elseif($device['device_type'] === 'slot_sensor')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-teal-50 text-teal-700 border border-teal-200 whitespace-nowrap">
                                        Sensor Hub
                                    </span>
                                    @elseif($device['device_type'] === 'guidance_display')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                        VMS LED
                                    </span>
                                    @elseif($device['device_type'] === 'payment_kiosk')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                        Paystation
                                    </span>
                                    @elseif($device['device_type'] === 'edge_gateway')
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 whitespace-nowrap">
                                        Edge Hub
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200 whitespace-nowrap">
                                        {{ $device['device_type_label'] }}
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="font-bold text-xs text-slate-900 group-hover:text-[var(--primary)] transition-colors truncate mt-1" title="{{ $device['name'] }}">
                                    {{ $device['name'] }}
                                </div>
                                <div class="text-[11px] text-slate-500 truncate" title="{{ $device['device_type_label'] }}">
                                    {{ $device['device_type_label'] }}
                                </div>
                            </div>
                        </td>

                        <!-- 2. Facility & Location -->
                        <td class="py-3.5 px-3">
                            <div class="font-semibold text-slate-800 text-xs truncate" title="{{ $device['facility_name'] }}">
                                {{ $device['facility_name'] }}
                            </div>
                            <div class="text-[11px] text-slate-500 truncate mt-0.5" title="{{ $device['area_name'] }}">
                                {{ $device['area_name'] }}
                            </div>
                            <div class="text-[10px] text-slate-400 truncate mt-0.5 font-mono" title="{{ $device['associated_entity'] }}">
                                {{ $device['associated_entity'] }}
                            </div>
                        </td>

                        <!-- 3. Hardware Model & Network -->
                        <td class="py-3.5 px-3 font-mono text-[11px]">
                            <div class="font-bold text-slate-800 flex items-center gap-1.5 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 shrink-0"></span>
                                <span class="truncate" title="{{ $device['model'] }}">{{ $device['model'] }}</span>
                            </div>
                            <div class="text-slate-500 text-[10px] mt-0.5 whitespace-nowrap flex items-center gap-1">
                                <span>{{ $device['ip_address'] }}</span>
                                <span class="text-slate-400 font-sans text-[9px]">({{ $device['protocol'] }})</span>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5 font-sans">
                                {{ $device['manufacturer'] }} • {{ $device['firmware_version'] }}
                            </div>
                        </td>

                        <!-- 4. Connectivity -->
                        <td class="py-3.5 px-3">
                            @if(strtolower($device['connectivity']) === 'online')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Online
                                <span class="text-[9px] text-emerald-600/80 font-mono">({{ $device['telemetry_data']['ping_ms'] ?? 14 }}ms)</span>
                            </span>
                            <div class="text-[10px] text-slate-400 mt-0.5 whitespace-nowrap">
                                {{ $device['last_heartbeat'] }}
                            </div>
                            @elseif(strtolower($device['connectivity']) === 'degraded')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Degraded
                                <span class="text-[9px] text-amber-600/80 font-mono">({{ $device['telemetry_data']['ping_ms'] ?? 240 }}ms)</span>
                            </span>
                            <div class="text-[10px] text-amber-600 mt-0.5 whitespace-nowrap font-medium">High latency</div>
                            @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Offline
                            </span>
                            <div class="text-[10px] text-rose-600 font-semibold mt-0.5 whitespace-nowrap">Host Unreachable</div>
                            @endif
                        </td>

                        <!-- 5. Health Status & Diagnostics -->
                        <td class="py-3.5 px-3">
                            <div class="space-y-1">
                                <div>
                                    @if($device['health_status'] === 'Healthy')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Healthy
                                    </span>
                                    @elseif($device['health_status'] === 'Warning')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        Warning
                                    </span>
                                    @elseif($device['health_status'] === 'Maintenance')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-800 border border-purple-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                        Maintenance
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-200 whitespace-nowrap">
                                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        Fault
                                    </span>
                                    @endif
                                </div>

                                <div class="text-[10px] text-slate-500 font-medium truncate max-w-[150px]" title="{{ $device['health_note'] }}">
                                    {{ $device['health_note'] }}
                                </div>
                            </div>
                        </td>

                        <!-- 6. Real Telemetry -->
                        <td class="py-3.5 px-3 text-[11px] font-mono">
                            <div class="space-y-0.5">
                                <div class="flex items-center gap-1 text-slate-700">
                                    <span class="text-slate-400 text-[10px]">Temp:</span>
                                    <span class="font-bold {{ ($device['telemetry_data']['temperature_c'] ?? 30) > 40 ? 'text-amber-600' : 'text-slate-800' }}">{{ $device['telemetry_data']['temperature_c'] ?? 30 }}°C</span>
                                </div>
                                <div class="flex items-center gap-1 text-slate-700 text-[10px]">
                                    <span class="text-slate-400">CPU:</span>
                                    <span>{{ $device['telemetry_data']['cpu_load_pct'] ?? 10 }}%</span>
                                    <span class="text-slate-300">•</span>
                                    <span>RAM: {{ $device['telemetry_data']['memory_usage_pct'] ?? 30 }}%</span>
                                </div>
                            </div>
                        </td>

                        <!-- 7. Actions Group -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5 whitespace-nowrap">
                                
                                <!-- Inspect Diagnostic Profile -->
                                <button type="button" 
                                        onclick="openDeviceDetailDrawer('{{ $device['id'] }}')" 
                                        class="p-1.5 rounded-lg border border-[var(--border)] text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer"
                                        title="View technical hardware profile and live telemetry">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                </button>

                                <!-- On-Demand Diagnostic Probe -->
                                <button type="button" 
                                        onclick="probeDevice('{{ $device['id'] }}')" 
                                        class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800 text-[11px] font-bold flex items-center gap-1 transition-colors cursor-pointer"
                                        title="Send keepalive probe probe to device">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    <span>Probe</span>
                                </button>

                                <!-- Secondary Actions Menu -->
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <button type="button" 
                                            onclick="toggleDeviceRowMenu('menu-{{ $device['id'] }}')" 
                                            class="p-1.5 rounded-lg border border-[var(--border)] text-slate-500 hover:bg-slate-100 transition-colors cursor-pointer"
                                            aria-label="More options for device {{ $device['device_code'] }}">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>

                                    <!-- Dropdown Popover -->
                                    <div id="menu-{{ $device['id'] }}" 
                                         class="hidden absolute right-0 mt-1 w-44 rounded-xl bg-white border border-[var(--border)] shadow-xl z-20 py-1.5 text-xs text-left">
                                        
                                        <!-- Edit Config -->
                                        <button type="button" 
                                                onclick="openEditDeviceModal('{{ $device['id'] }}'); toggleDeviceRowMenu('menu-{{ $device['id'] }}');" 
                                                class="w-full px-3 py-2 text-slate-700 hover:bg-slate-50 flex items-center gap-2 cursor-pointer">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            <span>Edit Configuration</span>
                                        </button>

                                        <!-- Toggle Maintenance State -->
                                        <form method="POST" action="/vendor/iot-devices/{{ $device['id'] }}/status">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $device['health_status'] === 'Maintenance' ? 'Healthy' : 'Maintenance' }}">
                                            <button type="submit" class="w-full px-3 py-2 text-slate-700 hover:bg-slate-50 flex items-center gap-2 cursor-pointer">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                                <span>{{ $device['health_status'] === 'Maintenance' ? 'Restore Operational' : 'Set Maintenance' }}</span>
                                            </button>
                                        </form>

                                        <div class="my-1 border-t border-slate-100"></div>

                                        <!-- Decommission Device -->
                                        <button type="button" 
                                                onclick="openDecommissionModal('{{ $device['id'] }}', '{{ $device['device_code'] }}'); toggleDeviceRowMenu('menu-{{ $device['id'] }}');" 
                                                class="w-full px-3 py-2 text-rose-600 hover:bg-rose-50 flex items-center gap-2 cursor-pointer">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            <span>Decommission</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- MOBILE / TABLET CARDS VIEW (Hidden on Desktop) -->
        <div class="lg:hidden p-4 divide-y divide-slate-100 space-y-4">
            @foreach($devices as $device)
            <div class="pt-4 first:pt-0 space-y-3">
                
                <!-- Card Header -->
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100/90 border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap">
                                {{ $device['device_code'] }}
                            </span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $device['device_type_label'] }}
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-[var(--text)] mt-1 truncate" title="{{ $device['name'] }}">
                            {{ $device['name'] }}
                        </h4>
                        <div class="text-[11px] text-[var(--text-muted)] truncate">
                            {{ $device['facility_name'] }} • {{ $device['area_name'] }}
                        </div>
                    </div>

                    <!-- Connectivity Pill -->
                    <div class="shrink-0">
                        @if(strtolower($device['connectivity']) === 'online')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online
                        </span>
                        @elseif(strtolower($device['connectivity']) === 'degraded')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                            Degraded
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200 whitespace-nowrap">
                            Offline
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Attributes Grid -->
                <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Health State</span>
                        <span class="font-semibold {{ $device['health_status'] === 'Healthy' ? 'text-emerald-700' : ($device['health_status'] === 'Maintenance' ? 'text-purple-700' : 'text-amber-700') }}">
                            {{ $device['health_status'] }}
                        </span>
                        <div class="text-[10px] text-slate-500 truncate" title="{{ $device['health_note'] }}">
                            {{ $device['health_note'] }}
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Hardware & Model</span>
                        <div class="font-semibold text-slate-800 truncate" title="{{ $device['model'] }}">{{ $device['model'] }}</div>
                        <div class="text-[10px] text-slate-500 font-mono">{{ $device['ip_address'] }}</div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Telemetry</span>
                        <div class="font-mono text-slate-800 text-[11px]">{{ $device['telemetry_data']['temperature_c'] ?? 30 }}°C • CPU {{ $device['telemetry_data']['cpu_load_pct'] ?? 10 }}%</div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Last Seen</span>
                        <div class="text-[11px] text-slate-600">{{ $device['last_heartbeat'] }}</div>
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="flex items-center gap-2 pt-1">
                    <button type="button" 
                            onclick="openDeviceDetailDrawer('{{ $device['id'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors">
                        Diagnostic Profile
                    </button>
                    <button type="button" 
                            onclick="probeDevice('{{ $device['id'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl bg-slate-800 text-white text-xs font-bold text-center hover:bg-slate-900 transition-colors flex items-center justify-center gap-1 shadow-2xs">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                        <span>Probe Diagnostic</span>
                    </button>
                </div>

            </div>
            @endforeach
        </div>

        <!-- PAGINATION BAR -->
        <div class="px-5 py-3.5 border-t border-[var(--border)] bg-slate-50/75 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <div class="text-slate-600 font-medium">
                Showing <strong class="text-slate-900 font-semibold">{{ $pagination['from'] }}</strong> to <strong class="text-slate-900 font-semibold">{{ $pagination['to'] }}</strong> of <strong class="text-slate-900 font-semibold">{{ $pagination['total'] }}</strong> devices
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-2">
                <!-- Previous Page -->
                @if($pagination['current_page'] > 1)
                <a href="/vendor/iot-devices?facility={{ $facilityId }}&page={{ $pagination['current_page'] - 1 }}&q={{ urlencode($filters['q']) }}&area={{ $filters['area'] }}&device_type={{ $filters['device_type'] }}&connectivity={{ $filters['connectivity'] }}&health_status={{ $filters['health_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200/80 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed flex items-center gap-1 opacity-70">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Previous
                </span>
                @endif

                <!-- Page Indicator Badge -->
                <span class="px-3 py-1.5 text-xs font-semibold text-slate-600 bg-white border border-[var(--border)] rounded-lg">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                <!-- Next Page -->
                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/iot-devices?facility={{ $facilityId }}&page={{ $pagination['current_page'] + 1 }}&q={{ urlencode($filters['q']) }}&area={{ $filters['area'] }}&device_type={{ $filters['device_type'] }}&connectivity={{ $filters['connectivity'] }}&health_status={{ $filters['health_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                    Next
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200/80 bg-slate-100 text-slate-400 font-semibold cursor-not-allowed flex items-center gap-1 opacity-70">
                    Next
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
                @endif
            </div>
            @endif
        </div>

        @else
        <!-- NO RESULTS EMPTY STATE -->
        <div class="py-16 px-4 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                    <rect x="9" y="9" width="6" height="6"></rect>
                </svg>
            </div>
            <h3 class="text-base font-extrabold text-[var(--text)]">
                No IoT Devices Found
            </h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] max-w-md mx-auto mt-1">
                @if($hasActiveFilters)
                No configured IoT devices matched your active filter criteria. Try clearing filters to view all devices.
                @else
                No IoT devices are registered for this facility. Provision your first connected device using the button below.
                @endif
            </p>
            <div class="mt-5 flex items-center justify-center gap-3">
                @if($hasActiveFilters)
                <a href="/vendor/iot-devices?facility={{ $facilityId }}" 
                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors">
                    Clear Active Filters
                </a>
                @endif
                <button type="button" 
                        onclick="openAddDeviceModal()" 
                        class="px-4 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors cursor-pointer">
                    Register Device
                </button>
            </div>
        </div>
        @endif

    </div>

    <!-- ================= RECENT HARDWARE TELEMETRY & EVENT LOGS ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs p-5 space-y-4">
        
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <div>
                    <h2 class="text-sm sm:text-base font-extrabold text-[var(--text)]">
                        Recent Device Telemetry & Diagnostic Events
                    </h2>
                    <p class="text-[11px] text-[var(--text-muted)]">
                        Authoritative hardware keepalive logs, MQTT telemetry queues, and sensor calibration audits.
                    </p>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-medium hidden sm:inline">
                Last recorded events
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-2.5 px-3">Timestamp</th>
                        <th class="py-2.5 px-3">Device Code</th>
                        <th class="py-2.5 px-3">Event Type</th>
                        <th class="py-2.5 px-3">Diagnostic Message</th>
                        <th class="py-2.5 px-3 text-right">Severity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentLogs as $log)
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-2.5 px-3 font-mono text-[11px] text-slate-500 whitespace-nowrap">
                            {{ $log['timestamp'] }}
                        </td>
                        <td class="py-2.5 px-3 font-mono font-bold text-slate-900 whitespace-nowrap">
                            {{ $log['device_code'] }}
                        </td>
                        <td class="py-2.5 px-3 whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                {{ ucwords(str_replace('_', ' ', $log['event_type'])) }}
                            </span>
                        </td>
                        <td class="py-2.5 px-3 font-medium text-slate-800">
                            {{ $log['message'] }}
                        </td>
                        <td class="py-2.5 px-3 text-right whitespace-nowrap">
                            @if(($log['severity'] ?? '') === 'error')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-rose-100 text-rose-800">
                                ERROR / FAULT
                            </span>
                            @elseif(($log['severity'] ?? '') === 'warning')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-amber-100 text-amber-800">
                                WARNING
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                INFO (ACK)
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400 text-xs">
                            No telemetry events recorded yet for this facility.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- ================= SLIDE-OVER IOT DIAGNOSTIC DRAWER ================= -->
    <div id="device-detail-drawer" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="drawer-device-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity cursor-pointer" onclick="closeDeviceDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-md w-full bg-[var(--surface)] shadow-2xl flex flex-col z-10 animate-slide-left">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                <div class="flex items-center gap-3">
                    <div class="px-2.5 py-1 rounded-lg bg-[var(--primary)] text-white font-mono font-bold text-xs shadow-xs shrink-0 whitespace-nowrap" id="drawer-device-badge">
                        --
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">IoT Hardware Telemetry</div>
                        <h2 class="text-base sm:text-lg font-extrabold text-[var(--text)] truncate" id="drawer-device-title">
                            Device Profile
                        </h2>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeDeviceDetailDrawer()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                        aria-label="Close drawer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Body -->
            <div class="flex-1 overflow-y-auto p-5 space-y-5" id="drawer-device-body">
                <div class="text-center py-12 text-slate-400 text-xs">
                    Loading device telemetry...
                </div>
            </div>

            <!-- Drawer Footer Actions -->
            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center gap-2" id="drawer-device-footer">
                <button type="button" 
                        onclick="closeDeviceDetailDrawer()" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-bold text-center transition-colors cursor-pointer">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- ================= REGISTER IOT DEVICE MODAL ================= -->
    <div id="add-device-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-add-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity cursor-pointer" onclick="closeAddDeviceModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in my-8">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Inventory Management</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-add-title">
                                Register IoT Device
                            </h3>
                        </div>
                    </div>
                    <button type="button" onclick="closeAddDeviceModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 cursor-pointer" aria-label="Close modal">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="/vendor/iot-devices" class="p-5 space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <!-- Facility Selection -->
                        <div class="sm:col-span-2">
                            <label for="reg-facility" class="block text-xs font-bold text-slate-700 mb-1">Target Facility *</label>
                            <select id="reg-facility" name="facility_id" required class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                @foreach($facilities as $f)
                                    <option value="{{ $f['id'] }}" {{ ($facilityId === $f['id']) ? 'selected' : '' }}>
                                        {{ $f['name'] }} ({{ $f['city'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Device Code -->
                        <div>
                            <label for="reg-code" class="block text-xs font-bold text-slate-700 mb-1">Device Identifier *</label>
                            <input type="text" id="reg-code" name="device_code" required placeholder="e.g. DEV-CTR-XYZ-04" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono uppercase focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Device Type -->
                        <div>
                            <label for="reg-type" class="block text-xs font-bold text-slate-700 mb-1">Equipment Type *</label>
                            <select id="reg-type" name="device_type" required class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="barrier_controller">Barrier PLC Controller</option>
                                <option value="anpr_camera">ANPR Optical Camera</option>
                                <option value="slot_sensor">Slot Occupancy Sensor Hub</option>
                                <option value="guidance_display">VMS LED Guidance Display</option>
                                <option value="payment_kiosk">Payment Terminal Kiosk</option>
                                <option value="edge_gateway">Industrial Edge Gateway</option>
                                <option value="loop_detector">Inductive Loop Detector</option>
                                <option value="safety_beam">Safety Infrared Curtain</option>
                            </select>
                        </div>

                        <!-- Friendly Name -->
                        <div class="sm:col-span-2">
                            <label for="reg-name" class="block text-xs font-bold text-slate-700 mb-1">Device Display Name *</label>
                            <input type="text" id="reg-name" name="name" required placeholder="e.g. South Exit Barrier Controller PLC 02" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Parking Area -->
                        <div>
                            <label for="reg-area" class="block text-xs font-bold text-slate-700 mb-1">Parking Area / Floor</label>
                            <select id="reg-area" name="area_id" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                <option value="">Select Parking Area...</option>
                                @foreach($areas as $ar)
                                    <option value="{{ $ar['id'] }}">{{ $ar['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Associated Entity -->
                        <div>
                            <label for="reg-entity" class="block text-xs font-bold text-slate-700 mb-1">Associated Placement / Gate</label>
                            <input type="text" id="reg-entity" name="associated_entity" placeholder="e.g. Gate GATE-XYZ-OUT-02" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- Manufacturer & Model -->
                        <div>
                            <label for="reg-manufacturer" class="block text-xs font-bold text-slate-700 mb-1">Manufacturer</label>
                            <input type="text" id="reg-manufacturer" name="manufacturer" placeholder="e.g. Advantech / Hikvision" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                        <div>
                            <label for="reg-model" class="block text-xs font-bold text-slate-700 mb-1">Hardware Model</label>
                            <input type="text" id="reg-model" name="model" placeholder="e.g. WISE-4050 PLC" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <!-- IP Address & Protocol -->
                        <div>
                            <label for="reg-ip" class="block text-xs font-bold text-slate-700 mb-1">IPv4 Address</label>
                            <input type="text" id="reg-ip" name="ip_address" placeholder="e.g. 192.168.10.14" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>
                        <div>
                            <label for="reg-protocol" class="block text-xs font-bold text-slate-700 mb-1">Communication Protocol</label>
                            <input type="text" id="reg-protocol" name="protocol" placeholder="e.g. Modbus TCP / MQTT" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                    </div>

                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="closeAddDeviceModal()" class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors cursor-pointer shadow-xs">
                            Register & Connect
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= EDIT IOT DEVICE MODAL ================= -->
    <div id="edit-device-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-edit-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity cursor-pointer" onclick="closeEditDeviceModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in my-8">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Configuration</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-edit-title">
                                Edit IoT Device
                            </h3>
                        </div>
                    </div>
                    <button type="button" onclick="closeEditDeviceModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 cursor-pointer" aria-label="Close modal">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Edit Form -->
                <form id="edit-device-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="space-y-3.5">
                        
                        <div>
                            <label for="edit-name" class="block text-xs font-bold text-slate-700 mb-1">Device Name *</label>
                            <input type="text" id="edit-name" name="name" required class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="edit-model" class="block text-xs font-bold text-slate-700 mb-1">Hardware Model</label>
                                <input type="text" id="edit-model" name="model" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                            <div>
                                <label for="edit-manufacturer" class="block text-xs font-bold text-slate-700 mb-1">Manufacturer</label>
                                <input type="text" id="edit-manufacturer" name="manufacturer" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="edit-ip" class="block text-xs font-bold text-slate-700 mb-1">IP Address</label>
                                <input type="text" id="edit-ip" name="ip_address" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                            <div>
                                <label for="edit-mac" class="block text-xs font-bold text-slate-700 mb-1">MAC Address</label>
                                <input type="text" id="edit-mac" name="mac_address" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="edit-protocol" class="block text-xs font-bold text-slate-700 mb-1">Protocol</label>
                                <input type="text" id="edit-protocol" name="protocol" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                            <div>
                                <label for="edit-firmware" class="block text-xs font-bold text-slate-700 mb-1">Firmware Version</label>
                                <input type="text" id="edit-firmware" name="firmware_version" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                        </div>

                        <div>
                            <label for="edit-entity" class="block text-xs font-bold text-slate-700 mb-1">Associated Infrastructure</label>
                            <input type="text" id="edit-entity" name="associated_entity" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="edit-health" class="block text-xs font-bold text-slate-700 mb-1">Health Status *</label>
                                <select id="edit-health" name="health_status" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                                    <option value="Healthy">Healthy (Optimal)</option>
                                    <option value="Warning">Warning</option>
                                    <option value="Fault">Fault</option>
                                    <option value="Maintenance">Maintenance</option>
                                </select>
                            </div>
                            <div>
                                <label for="edit-note" class="block text-xs font-bold text-slate-700 mb-1">Diagnostic Note</label>
                                <input type="text" id="edit-note" name="health_note" class="w-full px-3 py-2 rounded-xl border border-[var(--border)] bg-slate-50 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                            </div>
                        </div>

                    </div>

                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="closeEditDeviceModal()" class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors cursor-pointer shadow-xs">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= DECOMMISSION DEVICE CONFIRMATION MODAL ================= -->
    <div id="decommission-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-decom-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity cursor-pointer" onclick="closeDecommissionModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-md w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in p-6 space-y-4">
                
                <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>

                <div class="text-center">
                    <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-decom-title">
                        Decommission IoT Device?
                    </h3>
                    <p class="text-xs text-[var(--text-muted)] mt-1">
                        Are you sure you want to remove device <strong id="decommission-device-code" class="font-mono text-slate-900">--</strong> from the active fleet inventory?
                    </p>
                    <p class="text-[11px] text-amber-700 bg-amber-50 p-2.5 rounded-xl border border-amber-200 mt-3 text-left">
                        ⚠️ <strong>Operational Notice:</strong> Decommissioning will unregister telemetry heartbeats from the IoT broker and archive device logs.
                    </p>
                </div>

                <form id="decommission-form" method="POST" action="" class="flex items-center gap-2 pt-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDecommissionModal()" class="flex-1 py-2.5 px-4 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-colors cursor-pointer shadow-xs">
                        Decommission Device
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= JAVASCRIPT INTERACTIONS ================= -->
    @push('scripts')
    <script>
        // Toggle Row Context Menu
        function toggleDeviceRowMenu(menuId) {
            document.querySelectorAll('[id^="menu-"]').forEach(el => {
                if (el.id !== menuId) el.classList.add('hidden');
            });
            const menu = document.getElementById(menuId);
            if (menu) menu.classList.toggle('hidden');
        }

        // Close dropdowns on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[x-data]')) {
                document.querySelectorAll('[id^="menu-"]').forEach(el => el.classList.add('hidden'));
            }
        });

        // ================= SLIDE-OVER DIAGNOSTIC DRAWER =================
        function openDeviceDetailDrawer(deviceId) {
            const drawer = document.getElementById('device-detail-drawer');
            const title = document.getElementById('drawer-device-title');
            const badge = document.getElementById('drawer-device-badge');
            const body = document.getElementById('drawer-device-body');
            const footer = document.getElementById('drawer-device-footer');

            drawer.classList.remove('hidden');
            body.innerHTML = `
                <div class="text-center py-16 text-slate-400 text-xs space-y-2">
                    <div class="w-8 h-8 border-2 border-[var(--primary)] border-t-transparent rounded-full animate-spin mx-auto"></div>
                    <div>Fetching real-time device telemetry...</div>
                </div>
            `;

            fetch('/api/vendor/iot-devices/' + deviceId)
                .then(r => r.json())
                .then(data => {
                    if (!data.success || !data.device) {
                        body.innerHTML = '<div class="text-rose-600 text-xs p-4">Device profile could not be loaded.</div>';
                        return;
                    }

                    const d = data.device;
                    title.innerText = d.name;
                    badge.innerText = d.device_code;

                    const isOnline = (d.connectivity || '').toLowerCase() === 'online';
                    const isDegraded = (d.connectivity || '').toLowerCase() === 'degraded';
                    const connClass = isOnline ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : (isDegraded ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200');

                    body.innerHTML = `
                        <!-- Top State Badges -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-slate-400 block">Connectivity</span>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold border ${connClass}">
                                    <span class="w-2 h-2 rounded-full ${isOnline ? 'bg-emerald-500' : (isDegraded ? 'bg-amber-500' : 'bg-red-500')}"></span>
                                    ${d.connectivity.toUpperCase()}
                                    <span class="font-mono text-[10px]">(${d.telemetry_data?.ping_ms || 14}ms)</span>
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-bold uppercase text-slate-400 block">Health Status</span>
                                <span class="text-xs font-extrabold ${d.health_status === 'Healthy' ? 'text-emerald-700' : (d.health_status === 'Maintenance' ? 'text-purple-700' : 'text-amber-700')}">
                                    ${d.health_status}
                                </span>
                            </div>
                        </div>

                        <!-- Live Hardware Telemetry Matrix -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Live Telemetry Metrics</div>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Core Temp</div>
                                    <div class="text-base font-extrabold mt-0.5 ${(d.telemetry_data?.temperature_c || 30) > 40 ? 'text-amber-600' : 'text-slate-900'}">
                                        ${d.telemetry_data?.temperature_c || 30}°C
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Operating thermal range</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">CPU Load</div>
                                    <div class="text-base font-extrabold text-slate-900 mt-0.5">
                                        ${d.telemetry_data?.cpu_load_pct || 12}%
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">RAM: ${d.telemetry_data?.memory_usage_pct || 35}%</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Packet Loss</div>
                                    <div class="text-base font-extrabold ${(d.telemetry_data?.packet_loss_pct || 0) > 0 ? 'text-rose-600' : 'text-emerald-600'} mt-0.5">
                                        ${d.telemetry_data?.packet_loss_pct || 0}%
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Ping: ${d.telemetry_data?.ping_ms || 14}ms</div>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">System Uptime</div>
                                    <div class="text-base font-extrabold text-indigo-700 mt-0.5">
                                        ${d.telemetry_data?.uptime_days || 1} Days
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Continuous online</div>
                                </div>
                            </div>
                        </div>

                        <!-- Hardware & Network Identifiers -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Technical Specifications</div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Hardware Model:</span>
                                    <span class="font-bold text-slate-800">${d.model}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Manufacturer:</span>
                                    <span class="font-medium text-slate-700">${d.manufacturer}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Serial Number:</span>
                                    <span class="font-mono text-slate-700">${d.serial_number}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">IPv4 Address:</span>
                                    <span class="font-mono text-slate-900 font-bold">${d.ip_address}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">MAC Address:</span>
                                    <span class="font-mono text-slate-700">${d.mac_address}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Firmware:</span>
                                    <span class="font-mono text-slate-700">${d.firmware_version}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Protocol:</span>
                                    <span class="font-medium text-slate-800">${d.protocol}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Power Source:</span>
                                    <span class="text-slate-700 text-[11px]">${d.telemetry_data?.power_source || 'PoE / DC PSU'}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location Metadata -->
                        <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100 text-xs text-blue-900 space-y-1">
                            <div><strong>Facility:</strong> ${d.facility_name}</div>
                            <div><strong>Area / Floor:</strong> ${d.area_name}</div>
                            <div><strong>Placement / Gate:</strong> ${d.associated_entity}</div>
                            <div class="text-[10px] text-blue-700/80 mt-1">Installed Date: ${d.installed_date} • Last Sync: ${d.last_heartbeat}</div>
                        </div>
                    `;

                    footer.innerHTML = `
                        <button type="button" 
                                onclick="probeDevice('${d.id}')" 
                                class="flex-1 py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-bold text-center transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            <span>Probe Telemetry</span>
                        </button>
                        <button type="button" 
                                onclick="closeDeviceDetailDrawer()" 
                                class="py-2.5 px-4 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors cursor-pointer">
                            Close
                        </button>
                    `;
                })
                .catch(() => {
                    body.innerHTML = '<div class="text-rose-600 text-xs p-4">Error communicating with device API endpoint.</div>';
                });
        }

        function closeDeviceDetailDrawer() {
            document.getElementById('device-detail-drawer').classList.add('hidden');
        }

        // ================= ON-DEMAND PING PROBE =================
        function probeDevice(deviceId) {
            fetch('/api/vendor/iot-devices/' + deviceId + '/ping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    alert(`Probe ACK Received!\n\nDevice: ${res.device_code} (${res.ip_address})\nLatency: ${res.latency_ms} ms\nProtocol: ${res.protocol}\nStatus: ${res.status}\nTimestamp: ${res.timestamp}`);
                } else {
                    alert(`Probe Failed!\n\nDevice: ${res.device_code || deviceId}\nMessage: ${res.message || res.status}`);
                }
            })
            .catch(() => {
                alert('Diagnostic ping probe request timed out.');
            });
        }

        // ================= REGISTER DEVICE MODAL =================
        function openAddDeviceModal() {
            document.getElementById('add-device-modal').classList.remove('hidden');
        }

        function closeAddDeviceModal() {
            document.getElementById('add-device-modal').classList.add('hidden');
        }

        // ================= EDIT DEVICE MODAL =================
        function openEditDeviceModal(deviceId) {
            const modal = document.getElementById('edit-device-modal');
            const form = document.getElementById('edit-device-form');

            form.action = '/vendor/iot-devices/' + deviceId;

            fetch('/api/vendor/iot-devices/' + deviceId)
                .then(r => r.json())
                .then(data => {
                    if (!data.success || !data.device) return;
                    const d = data.device;

                    document.getElementById('edit-name').value = d.name || '';
                    document.getElementById('edit-model').value = d.model || '';
                    document.getElementById('edit-manufacturer').value = d.manufacturer || '';
                    document.getElementById('edit-ip').value = d.ip_address || '';
                    document.getElementById('edit-mac').value = d.mac_address || '';
                    document.getElementById('edit-protocol').value = d.protocol || '';
                    document.getElementById('edit-firmware').value = d.firmware_version || '';
                    document.getElementById('edit-entity').value = d.associated_entity || '';
                    document.getElementById('edit-health').value = d.health_status || 'Healthy';
                    document.getElementById('edit-note').value = d.health_note || '';

                    modal.classList.remove('hidden');
                });
        }

        function closeEditDeviceModal() {
            document.getElementById('edit-device-modal').classList.add('hidden');
        }

        // ================= DECOMMISSION DEVICE MODAL =================
        function openDecommissionModal(deviceId, deviceCode) {
            const modal = document.getElementById('decommission-modal');
            const form = document.getElementById('decommission-form');
            const codeEl = document.getElementById('decommission-device-code');

            form.action = '/vendor/iot-devices/' + deviceId;
            codeEl.innerText = deviceCode;

            modal.classList.remove('hidden');
        }

        function closeDecommissionModal() {
            document.getElementById('decommission-modal').classList.add('hidden');
        }

        // ESC Key Global Listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeviceDetailDrawer();
                closeAddDeviceModal();
                closeEditDeviceModal();
                closeDecommissionModal();
                document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
            }
        });
    </script>
    @endpush

</x-layouts.vendor>
