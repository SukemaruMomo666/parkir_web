<x-layouts.vendor activeNav="anpr" title="ANPR Monitoring - NusaPark Enterprise">

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
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100" aria-label="Dismiss alert">
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
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100" aria-label="Dismiss alert">
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

    <!-- ================= PAGE HEADER & FACILITY SCOPE ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Device Fleet • Page 26</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        AI OCR Engine v5.4 Active
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    ANPR Monitoring
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Monitor number-plate recognition events, camera health, and manual verification across your facilities.
                </p>
            </div>
        </div>

        <!-- Facility Switcher & Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Facility Context Switcher -->
            @if(count($facilities) > 1)
            <div class="relative min-w-[210px]">
                <label for="facility-selector" class="sr-only">Switch Facility Scope</label>
                <select id="facility-selector" 
                        onchange="window.location.href = '/vendor/anpr?facility=' + this.value"
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

            <!-- Refresh State Button -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer flex items-center gap-1.5 text-xs font-semibold"
                    title="Refresh recognition stream from edge cameras">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>

            <!-- Jump to Barrier Gates Page -->
            <a href="/vendor/gates?facility={{ $facilityId }}" 
               class="px-3.5 py-2.5 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-colors"
               title="View associated barrier gates">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span class="hidden sm:inline">Barrier Gates</span>
            </a>
        </div>

    </div>

    <!-- ================= OPERATIONAL SUMMARY METRICS ================= -->
    <section aria-labelledby="anpr-metrics-heading">
        <h2 id="anpr-metrics-heading" class="sr-only">ANPR Fleet Metrics</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5">
            
            <!-- 1. Configured Cameras -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Cameras</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-[var(--text)] tracking-tight">
                        {{ $metrics['total_cameras'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>{{ $metrics['online_cameras'] }} Online ({{ $metrics['camera_online_rate'] }}%)</span>
                    </div>
                </div>
            </div>

            <!-- 2. Events Logged -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Events Total</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-indigo-600 tracking-tight">
                        {{ $metrics['total_events'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        Recognitions in scope
                    </div>
                </div>
            </div>

            <!-- 3. Recognition Success -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Success Rate</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-emerald-600 tracking-tight flex items-baseline gap-1.5">
                        <span>{{ $metrics['successful_count'] }}</span>
                        <span class="text-xs font-semibold text-emerald-700/80">({{ $metrics['success_rate'] }}%)</span>
                    </div>
                    <div class="text-[11px] text-emerald-700 mt-0.5 font-medium">
                        High OCR confidence
                    </div>
                </div>
            </div>

            <!-- 4. Unreadable / Missing Plates -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Unreadable</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ ($metrics['unreadable_count'] + $metrics['no_plate_count']) > 0 ? 'text-amber-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['unreadable_count'] + $metrics['no_plate_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['unreadable_count'] }} dirty/glare • {{ $metrics['no_plate_count'] }} no plate
                    </div>
                </div>
            </div>

            <!-- 5. Manual Review Queue -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Review Queue</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ $metrics['review_required_count'] > 0 ? 'text-amber-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['review_required_count'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['review_required_count'] > 0 ? 'Pending verification' : 'Queue cleared' }}
                    </div>
                </div>
            </div>

            <!-- 6. Camera Hardware Alerts -->
            <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Device Health</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ ($metrics['offline_cameras'] + $metrics['degraded_cameras']) > 0 ? 'text-rose-600' : 'text-slate-700' }} tracking-tight">
                        {{ $metrics['offline_cameras'] + $metrics['degraded_cameras'] }}
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)] mt-0.5 font-medium">
                        {{ $metrics['offline_cameras'] }} offline • {{ $metrics['degraded_cameras'] }} glare alert
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= CAMERA FLEET HEALTH STRIP ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        <div class="flex items-center justify-between text-xs font-bold text-slate-700">
            <div class="flex items-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                <span>Configured Camera Devices ({{ count($cameras) }})</span>
            </div>
            <span class="text-[11px] text-slate-400 font-normal">Click a camera below to filter events</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2.5">
            @foreach($cameras as $cam)
            <div onclick="window.location.href = '/vendor/anpr?facility={{ $facilityId }}&camera={{ $cam['id'] }}'"
                 class="p-3 rounded-xl border {{ ($filters['camera'] === $cam['id'] || $filters['camera'] === $cam['camera_code']) ? 'border-[var(--primary)] bg-blue-50/40 ring-2 ring-[var(--primary)]/20' : 'border-slate-200 bg-slate-50 hover:bg-white hover:border-slate-300' }} transition-all cursor-pointer flex flex-col justify-between">
                
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <span class="font-mono text-xs font-bold text-slate-900 block">{{ $cam['camera_code'] }}</span>
                        <span class="text-[10px] text-slate-500 font-medium truncate block max-w-[130px]" title="{{ $cam['name'] }}">
                            {{ $cam['name'] }}
                        </span>
                    </div>

                    @if(strtolower($cam['connectivity']) === 'online')
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0 mt-1" title="Online: {{ $cam['health_status'] }}"></span>
                    @elseif(strtolower($cam['connectivity']) === 'degraded')
                    <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0 mt-1" title="Degraded: {{ $cam['health_status'] }}"></span>
                    @else
                    <span class="w-2 h-2 rounded-full bg-red-500 shrink-0 mt-1" title="Offline: {{ $cam['health_status'] }}"></span>
                    @endif
                </div>

                <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[10px] text-slate-600">
                    <span class="font-mono">{{ $cam['gate_code'] }}</span>
                    <span>{{ number_format($cam['today_reads_count']) }} reads</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ================= SEARCH, FILTERS & VIEW CONTROLS ================= -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-4">
        
        <form method="GET" action="/vendor/anpr" id="anpr-filter-form" class="space-y-4">
            <!-- Preserve Facility -->
            <input type="hidden" name="facility" value="{{ $facilityId }}">

            <!-- Search Bar Row -->
            <div class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ $filters['q'] }}" 
                           placeholder="Search plate number (e.g. B 1892 KRF, D 1104), event UUID, or gate..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:bg-white transition-all">
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs sm:text-sm font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Filter Events</span>
                    </button>

                    @if($hasActiveFilters)
                    <a href="/vendor/anpr?facility={{ $facilityId }}" 
                       class="px-3.5 py-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5"
                       title="Reset all active search and filter parameters">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span>Clear</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Granular Filter Dropdowns Row -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2.5 pt-2 border-t border-slate-100">
                
                <!-- Camera Filter -->
                <div>
                    <label for="filter-camera" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Camera</label>
                    <select id="filter-camera" 
                            name="camera" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['camera'] === 'all') ? 'selected' : '' }}>All Cameras</option>
                        @foreach($cameras as $c)
                            <option value="{{ $c['id'] }}" {{ ($filters['camera'] === $c['id'] || $filters['camera'] === $c['camera_code']) ? 'selected' : '' }}>
                                {{ $c['camera_code'] }} ({{ $c['direction_label'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Gate Filter -->
                <div>
                    <label for="filter-gate" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Gate / Lane</label>
                    <select id="filter-gate" 
                            name="gate" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['gate'] === 'all') ? 'selected' : '' }}>All Gates</option>
                        @foreach($gates as $g)
                            <option value="{{ $g['id'] }}" {{ ($filters['gate'] === $g['id'] || $filters['gate'] === $g['code']) ? 'selected' : '' }}>
                                {{ $g['code'] }} - {{ $g['lane_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Direction Filter -->
                <div>
                    <label for="filter-direction" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Direction</label>
                    <select id="filter-direction" 
                            name="direction" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['direction'] === 'all') ? 'selected' : '' }}>All Directions</option>
                        <option value="entry" {{ ($filters['direction'] === 'entry') ? 'selected' : '' }}>Entry (Inbound)</option>
                        <option value="exit" {{ ($filters['direction'] === 'exit') ? 'selected' : '' }}>Exit (Outbound)</option>
                    </select>
                </div>

                <!-- Recognition Outcome Filter -->
                <div>
                    <label for="filter-outcome" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Outcome</label>
                    <select id="filter-outcome" 
                            name="outcome" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['outcome'] === 'all') ? 'selected' : '' }}>All Outcomes</option>
                        <option value="Recognized" {{ ($filters['outcome'] === 'Recognized') ? 'selected' : '' }}>Recognized (Success)</option>
                        <option value="Unreadable" {{ ($filters['outcome'] === 'Unreadable') ? 'selected' : '' }}>Unreadable / Glare</option>
                        <option value="No Plate Detected" {{ ($filters['outcome'] === 'No Plate Detected') ? 'selected' : '' }}>No Plate Detected</option>
                        <option value="Processing Failed" {{ ($filters['outcome'] === 'Processing Failed') ? 'selected' : '' }}>Processing Failed</option>
                    </select>
                </div>

                <!-- Review Status Filter -->
                <div>
                    <label for="filter-review" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Review Status</label>
                    <select id="filter-review" 
                            name="review_status" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="all" {{ ($filters['review_status'] === 'all') ? 'selected' : '' }}>All Review Statuses</option>
                        <option value="Verified" {{ ($filters['review_status'] === 'Verified') ? 'selected' : '' }}>Verified</option>
                        <option value="Pending Review" {{ ($filters['review_status'] === 'Pending Review') ? 'selected' : '' }}>Pending Review</option>
                        <option value="Flagged" {{ ($filters['review_status'] === 'Flagged') ? 'selected' : '' }}>Flagged</option>
                        <option value="Manually Corrected" {{ ($filters['review_status'] === 'Manually Corrected') ? 'selected' : '' }}>Manually Corrected</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label for="filter-sort" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Sort By</label>
                    <select id="filter-sort" 
                            name="sort" 
                            onchange="document.getElementById('anpr-filter-form').submit()"
                            class="w-full px-2.5 py-2 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] transition-all cursor-pointer">
                        <option value="timestamp_desc" {{ ($filters['sort'] === 'timestamp_desc') ? 'selected' : '' }}>Newest Events First</option>
                        <option value="timestamp_asc" {{ ($filters['sort'] === 'timestamp_asc') ? 'selected' : '' }}>Oldest Events First</option>
                        <option value="plate_asc" {{ ($filters['sort'] === 'plate_asc') ? 'selected' : '' }}>Plate Number (A &rarr; Z)</option>
                        <option value="confidence_desc" {{ ($filters['sort'] === 'confidence_desc') ? 'selected' : '' }}>Confidence (Highest)</option>
                        <option value="confidence_asc" {{ ($filters['sort'] === 'confidence_asc') ? 'selected' : '' }}>Confidence (Lowest)</option>
                    </select>
                </div>

            </div>
        </form>

        <!-- Banner Counter -->
        <div class="flex items-center justify-between text-xs text-[var(--text-muted)] pt-1">
            <div class="flex items-center gap-2">
                <span>Showing <strong>{{ count($events) }}</strong> of <strong>{{ $pagination['total'] }}</strong> recognition events</span>
                @if($hasActiveFilters)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Active Filters
                </span>
                @endif
            </div>
            <div class="hidden sm:block text-[11px] text-slate-400">
                Telemetry freshness: <strong>{{ $metrics['last_sync'] }}</strong>
            </div>
        </div>

    </div>

    <!-- ================= RECOGNITION EVENTS TABLE & CARDS ================= -->
    <div class="rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs overflow-hidden">
        
        @if(count($events) > 0)
        <!-- DESKTOP TABLE -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[var(--border)] bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Event Timestamp & UUID</th>
                        <th class="py-3.5 px-4">Recognized Number Plate</th>
                        <th class="py-3.5 px-4">Facility & Gate Lane</th>
                        <th class="py-3.5 px-4">Camera Device</th>
                        <th class="py-3.5 px-4">Confidence</th>
                        <th class="py-3.5 px-4">Outcome & Review</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-xs font-medium">
                    @foreach($events as $event)
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        
                        <!-- 1. Timestamp & UUID -->
                        <td class="py-4 px-4 whitespace-nowrap">
                            <div class="font-bold text-slate-900 text-xs">
                                {{ $event['timestamp'] }}
                            </div>
                            <div class="text-[11px] text-slate-400 font-mono mt-0.5 flex items-center gap-1.5">
                                <span>{{ $event['event_uuid'] }}</span>
                                <span>•</span>
                                <span class="text-slate-500 font-sans">{{ $event['time_ago'] }}</span>
                            </div>
                        </td>

                        <!-- 2. Recognized License Plate -->
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                @if(!empty($event['recognized_plate']))
                                <!-- Realistic Indonesian License Plate Badge -->
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900 text-white font-mono font-bold tracking-wider text-sm border-2 {{ str_contains($event['plate_type'] ?? '', 'Electric') ? 'border-emerald-500' : (str_contains($event['plate_type'] ?? '', 'Government') ? 'border-red-600 bg-red-950 text-white' : 'border-slate-700') }} shadow-xs">
                                    <span>{{ $event['recognized_plate'] }}</span>
                                    @if(str_contains($event['plate_type'] ?? '', 'Electric'))
                                    <span class="w-1.5 h-3.5 rounded-xs bg-emerald-400" title="Electric Vehicle (EV)"></span>
                                    @endif
                                </div>
                                @else
                                <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-dashed border-amber-300">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                    <span>{{ $event['outcome'] === 'No Plate Detected' ? 'NO PLATE MOUNTED' : 'UNREADABLE / OBSCURED' }}</span>
                                </div>
                                @endif

                                <div class="text-[10px] text-slate-500 flex items-center gap-1.5">
                                    <span>{{ $event['vehicle_type'] }}</span>
                                    @if(!empty($event['vehicle_color']))
                                    <span>•</span>
                                    <span>{{ $event['vehicle_color'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- 3. Facility & Gate Lane -->
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-800 text-xs">
                                {{ $event['facility_name'] }}
                            </div>
                            <div class="text-[11px] text-[var(--text-muted)] mt-0.5 flex items-center gap-1">
                                <span class="font-mono font-semibold text-slate-700">{{ $event['gate_code'] }}</span>
                                <span>•</span>
                                <span>{{ $event['lane_name'] }}</span>
                            </div>
                        </td>

                        <!-- 4. Camera Device -->
                        <td class="py-4 px-4 font-mono text-[11px]">
                            <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                <span>{{ $event['camera_code'] }}</span>
                            </div>
                            <div class="text-[10px] text-slate-400 font-sans mt-0.5">
                                {{ $event['direction_label'] }}
                            </div>
                        </td>

                        <!-- 5. Confidence Score -->
                        <td class="py-4 px-4">
                            @if($event['confidence_score'] !== null)
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="font-mono font-bold text-xs {{ $event['confidence_score'] >= 90 ? 'text-emerald-700' : ($event['confidence_score'] >= 75 ? 'text-amber-700' : 'text-rose-700') }}">
                                        {{ number_format($event['confidence_score'], 1) }}%
                                    </span>
                                    <span class="text-[10px] font-bold uppercase text-slate-400 font-sans">
                                        {{ $event['confidence_level'] }}
                                    </span>
                                </div>
                                <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden mt-1">
                                    <div class="h-full rounded-full {{ $event['confidence_score'] >= 90 ? 'bg-emerald-500' : ($event['confidence_score'] >= 75 ? 'bg-amber-500' : 'bg-rose-500') }}" style="width: {{ $event['confidence_score'] }}%"></div>
                                </div>
                            </div>
                            @else
                            <span class="text-[10px] text-slate-400 font-mono">N/A</span>
                            @endif
                        </td>

                        <!-- 6. Outcome & Review Status -->
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <!-- Outcome Pill -->
                                <div>
                                    @if($event['outcome'] === 'Recognized')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Recognized
                                    </span>
                                    @elseif($event['outcome'] === 'Unreadable')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                        Unreadable
                                    </span>
                                    @elseif($event['outcome'] === 'No Plate Detected')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                        No Plate Found
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-800 border border-red-200">
                                        Processing Failed
                                    </span>
                                    @endif
                                </div>

                                <!-- Review Status Tag -->
                                <div class="text-[10px]">
                                    @if($event['review_status'] === 'Verified')
                                    <span class="text-slate-500 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Verified
                                    </span>
                                    @elseif($event['review_status'] === 'Manually Corrected')
                                    <span class="text-purple-700 font-bold flex items-center gap-1" title="Reviewed by {{ $event['reviewed_by'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span>
                                        Manually Corrected
                                    </span>
                                    @elseif($event['review_status'] === 'Pending Review')
                                    <span class="text-amber-700 font-bold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending Review
                                    </span>
                                    @else
                                    <span class="text-rose-700 font-bold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Flagged
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- 7. Actions -->
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- Inspect Detail Drawer -->
                                <button type="button" 
                                        onclick="openAnprDetailDrawer('{{ $event['id'] }}')" 
                                        class="p-2 rounded-lg border border-[var(--border)] text-slate-600 hover:text-[var(--primary)] hover:bg-slate-100 transition-colors cursor-pointer"
                                        title="View crop snapshot and OCR bounding box metadata">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                </button>

                                <!-- Manual Review Modal Trigger -->
                                <button type="button" 
                                        onclick="openReviewModal('{{ $event['id'] }}', '{{ $event['event_uuid'] }}', '{{ $event['recognized_plate'] ?? '' }}', '{{ $event['outcome'] }}', '{{ $event['review_status'] }}')" 
                                        class="px-2.5 py-1.5 rounded-lg {{ $event['review_status'] === 'Pending Review' || $event['review_status'] === 'Flagged' ? 'bg-amber-600 hover:bg-amber-700 text-white' : 'border border-[var(--border)] text-slate-700 hover:bg-slate-100' }} text-[11px] font-bold flex items-center gap-1 transition-colors cursor-pointer"
                                        title="Verify or manually correct recognized plate text">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <span>{{ $event['review_status'] === 'Pending Review' ? 'Review' : 'Audit' }}</span>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- MOBILE / TABLET CARDS VIEW -->
        <div class="lg:hidden p-4 divide-y divide-slate-100 space-y-4">
            @foreach($events as $event)
            <div class="pt-4 first:pt-0 space-y-3">
                
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="font-bold text-xs text-slate-900">{{ $event['timestamp'] }}</div>
                        <div class="text-[10px] text-slate-400 font-mono">{{ $event['event_uuid'] }} • {{ $event['time_ago'] }}</div>
                    </div>

                    <!-- Outcome Badge -->
                    <div>
                        @if($event['outcome'] === 'Recognized')
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Recognized</span>
                        @elseif($event['outcome'] === 'Unreadable')
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800">Unreadable</span>
                        @else
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800">{{ $event['outcome'] }}</span>
                        @endif
                    </div>
                </div>

                <!-- Plate Display -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block">Number Plate</span>
                        @if(!empty($event['recognized_plate']))
                        <span class="font-mono font-bold text-base text-slate-900">{{ $event['recognized_plate'] }}</span>
                        @else
                        <span class="font-mono font-bold text-xs text-amber-700">UNREADABLE / NO PLATE</span>
                        @endif
                        <span class="text-[10px] text-slate-500 block">{{ $event['vehicle_type'] }}</span>
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block">Confidence</span>
                        <span class="font-mono font-bold text-xs {{ ($event['confidence_score'] ?? 0) >= 90 ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $event['confidence_score'] !== null ? number_format($event['confidence_score'], 1) . '%' : 'N/A' }}
                        </span>
                        <span class="text-[10px] text-slate-500 block">{{ $event['review_status'] }}</span>
                    </div>
                </div>

                <!-- Location & Device -->
                <div class="text-xs text-slate-600 flex items-center justify-between">
                    <span>{{ $event['facility_name'] }} • {{ $event['gate_code'] }}</span>
                    <span class="font-mono text-[11px] text-slate-500">{{ $event['camera_code'] }}</span>
                </div>

                <!-- Actions Row -->
                <div class="flex items-center gap-2 pt-1">
                    <button type="button" 
                            onclick="openAnprDetailDrawer('{{ $event['id'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors">
                        Crop Snapshot
                    </button>
                    <button type="button" 
                            onclick="openReviewModal('{{ $event['id'] }}', '{{ $event['event_uuid'] }}', '{{ $event['recognized_plate'] ?? '' }}', '{{ $event['outcome'] }}', '{{ $event['review_status'] }}')" 
                            class="flex-1 py-2 px-3 rounded-xl bg-[var(--primary)] text-white text-xs font-bold text-center hover:bg-[var(--primary-dark)] transition-colors">
                        Manual Review
                    </button>
                </div>

            </div>
            @endforeach
        </div>

        <!-- PAGINATION BAR -->
        <div class="p-4 border-t border-[var(--border)] bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-xs text-[var(--text-muted)]">
                Showing <strong>{{ $pagination['from'] }}</strong> to <strong>{{ $pagination['to'] }}</strong> of <strong>{{ $pagination['total'] }}</strong> recognition records
            </div>

            @if($pagination['last_page'] > 1)
            <div class="flex items-center gap-1.5">
                <!-- Previous Page -->
                @if($pagination['current_page'] > 1)
                <a href="/vendor/anpr?facility={{ $facilityId }}&page={{ $pagination['current_page'] - 1 }}&q={{ urlencode($filters['q']) }}&camera={{ $filters['camera'] }}&gate={{ $filters['gate'] }}&direction={{ $filters['direction'] }}&outcome={{ $filters['outcome'] }}&review_status={{ $filters['review_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors">
                    Previous
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 text-xs font-bold cursor-not-allowed">
                    Previous
                </span>
                @endif

                <!-- Page Indicator -->
                <span class="px-3 py-1.5 text-xs font-semibold text-slate-600">
                    Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                </span>

                <!-- Next Page -->
                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="/vendor/anpr?facility={{ $facilityId }}&page={{ $pagination['current_page'] + 1 }}&q={{ urlencode($filters['q']) }}&camera={{ $filters['camera'] }}&gate={{ $filters['gate'] }}&direction={{ $filters['direction'] }}&outcome={{ $filters['outcome'] }}&review_status={{ $filters['review_status'] }}&sort={{ $filters['sort'] }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors">
                    Next
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 text-xs font-bold cursor-not-allowed">
                    Next
                </span>
                @endif
            </div>
            @endif
        </div>

        @else
        <!-- EMPTY RESULTS STATE -->
        <div class="py-16 px-4 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
            </div>
            <h3 class="text-base font-extrabold text-[var(--text)]">
                No Recognition Events Found
            </h3>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] max-w-md mx-auto mt-1">
                @if($hasActiveFilters)
                No license plate recognition events matched your search keyword or selected filter parameters.
                @else
                No ANPR events have been logged for this facility yet. As vehicles pass through camera lanes, detections will stream here automatically.
                @endif
            </p>
            @if($hasActiveFilters)
            <div class="mt-5">
                <a href="/vendor/anpr?facility={{ $facilityId }}" 
                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors inline-block">
                    Clear Active Filters
                </a>
            </div>
            @endif
        </div>
        @endif

    </div>

    <!-- ================= SLIDE-OVER RECOGNITION DETAIL DRAWER ================= -->
    <div id="anpr-detail-drawer" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="drawer-anpr-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeAnprDetailDrawer()"></div>
        
        <div class="fixed inset-y-0 right-0 max-w-md w-full bg-[var(--surface)] shadow-2xl flex flex-col z-10 animate-slide-left">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[var(--primary)] text-white font-mono font-bold flex items-center justify-center text-xs shadow-xs" id="drawer-anpr-badge">
                        OCR
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Recognition Event Evidence</div>
                        <h2 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="drawer-anpr-title">
                            Event Details
                        </h2>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeAnprDetailDrawer()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                        aria-label="Close drawer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Drawer Body -->
            <div class="flex-1 overflow-y-auto p-5 space-y-5" id="drawer-anpr-body">
                <div class="text-center py-16 text-slate-400 text-xs">
                    Loading recognition metadata...
                </div>
            </div>

            <!-- Drawer Footer Actions -->
            <div class="p-4 border-t border-[var(--border)] bg-slate-50 flex items-center gap-2" id="drawer-anpr-footer">
                <button type="button" 
                        onclick="closeAnprDetailDrawer()" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-bold text-center transition-colors">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- ================= MANUAL REVIEW / PLATE CORRECTION MODAL ================= -->
    <div id="anpr-review-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-review-title">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-2xs transition-opacity" onclick="closeReviewModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-[var(--surface)] rounded-2xl shadow-2xl max-w-lg w-full border border-[var(--border)] overflow-hidden z-10 animate-fade-in">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-[var(--border)] flex items-center justify-between gap-4 bg-slate-50/75">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center text-sm shadow-xs">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Audit & Verification</span>
                            <h3 class="text-base sm:text-lg font-extrabold text-[var(--text)]" id="modal-review-title">
                                Manual ANPR Plate Review
                            </h3>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="closeReviewModal()" 
                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                            aria-label="Close review modal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Review Form -->
                <form id="anpr-review-form" method="POST" action="" class="p-5 space-y-4">
                    @csrf
                    
                    <!-- Event Banner -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Target Event UUID</div>
                            <div class="font-mono text-sm font-extrabold text-slate-900" id="modal-review-uuid">EVT-...</div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">Current Status</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800" id="modal-review-current-status">--</span>
                        </div>
                    </div>

                    <!-- Review Decision -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Review Action <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 gap-2">
                            
                            <label class="p-3 rounded-xl border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50/30 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="review_status" value="Verified" checked class="text-[var(--primary)] focus:ring-[var(--primary)]" onchange="togglePlateCorrectionInput(false)">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Confirm Existing Recognition as Verified</div>
                                        <div class="text-[11px] text-slate-500">The current OCR output is accurate and confirmed</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Verify</span>
                            </label>

                            <label class="p-3 rounded-xl border border-slate-200 hover:border-purple-300 hover:bg-purple-50/30 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="review_status" value="Manually Corrected" class="text-[var(--primary)] focus:ring-[var(--primary)]" onchange="togglePlateCorrectionInput(true)">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Correct Number Plate Text</div>
                                        <div class="text-[11px] text-slate-500">Fix OCR reading errors caused by dirt, reflection, or glare</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-800">Correct</span>
                            </label>

                            <label class="p-3 rounded-xl border border-slate-200 hover:border-rose-300 hover:bg-rose-50/30 flex items-center justify-between cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="review_status" value="Flagged" class="text-[var(--primary)] focus:ring-[var(--primary)]" onchange="togglePlateCorrectionInput(false)">
                                    <div>
                                        <div class="text-xs font-extrabold text-slate-900">Flag for Investigation / Security Check</div>
                                        <div class="text-[11px] text-slate-500">Suspicious vehicle, missing plate, or obstructed view</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800">Flag</span>
                            </label>

                        </div>
                    </div>

                    <!-- Corrected Plate Field (Shown when Correct is selected) -->
                    <div id="corrected-plate-wrapper" class="hidden">
                        <label for="corrected-plate-input" class="block text-xs font-bold text-slate-800 mb-1">
                            Corrected License Plate Text <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="corrected-plate-input" 
                               name="corrected_plate" 
                               placeholder="e.g. B 1892 KRF" 
                               class="w-full px-3 py-2 rounded-xl border border-[var(--border)] font-mono text-sm uppercase text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]">
                        <p class="text-[11px] text-slate-500 mt-1">
                            Note: The original raw engine reading will be preserved in audit history.
                        </p>
                    </div>

                    <!-- Review Reason / Audit Justification -->
                    <div>
                        <label for="review-reason-input" class="block text-xs font-bold text-slate-800 mb-1">
                            Audit Reason & Context <span class="text-red-500">*</span>
                        </label>
                        <textarea id="review-reason-input" 
                                  name="review_reason" 
                                  rows="2" 
                                  required 
                                  placeholder="State reason for verification/correction (e.g. confirmed via front high-res crop, cleaned mud spatter, reflection glare)..." 
                                  class="w-full px-3 py-2 rounded-xl border border-[var(--border)] text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex items-center justify-end gap-2.5">
                        <button type="button" 
                                onclick="closeReviewModal()" 
                                class="px-4 py-2.5 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold transition-colors">
                            Save Review Record
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= CLIENT JAVASCRIPT ================= -->
    @push('scripts')
    <script>
        // Toggle Plate Correction input visibility
        function togglePlateCorrectionInput(show) {
            const wrapper = document.getElementById('corrected-plate-wrapper');
            const input = document.getElementById('corrected-plate-input');
            if (show) {
                wrapper.classList.remove('hidden');
                input.required = true;
                input.focus();
            } else {
                wrapper.classList.add('hidden');
                input.required = false;
            }
        }

        // ================= SLIDE-OVER DETAIL DRAWER =================
        function openAnprDetailDrawer(eventId) {
            const drawer = document.getElementById('anpr-detail-drawer');
            const title = document.getElementById('drawer-anpr-title');
            const badge = document.getElementById('drawer-anpr-badge');
            const body = document.getElementById('drawer-anpr-body');
            const footer = document.getElementById('drawer-anpr-footer');

            drawer.classList.remove('hidden');
            body.innerHTML = `
                <div class="text-center py-16 text-slate-400 text-xs space-y-2">
                    <div class="w-8 h-8 border-2 border-[var(--primary)] border-t-transparent rounded-full animate-spin mx-auto"></div>
                    <div>Loading recognition snapshot and OCR bounding box...</div>
                </div>
            `;

            fetch('/api/vendor/anpr/events/' + eventId)
                .then(r => r.json())
                .then(data => {
                    if (!data.success || !data.event) {
                        body.innerHTML = '<div class="text-rose-600 text-xs p-4">Event details could not be loaded.</div>';
                        return;
                    }

                    const e = data.event;
                    title.innerText = e.event_uuid;
                    badge.innerText = e.camera_code;

                    const plateText = e.recognized_plate || 'UNREADABLE';
                    const isEV = (e.plate_type || '').includes('Electric');
                    const isGov = (e.plate_type || '').includes('Government');

                    body.innerHTML = `
                        <!-- Snapshot Crop Simulation with Bounding Box Overlay -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                <span>Camera Optical Evidence Frame</span>
                                <span class="text-slate-500 font-mono">Snapshot Crop</span>
                            </div>
                            
                            <div class="relative w-full h-48 rounded-xl bg-slate-900 border border-slate-800 overflow-hidden flex items-center justify-center select-none shadow-inner">
                                <!-- Simulated Camera Telemetry Overlay -->
                                <div class="absolute top-2.5 left-2.5 text-[9px] font-mono text-emerald-400 bg-slate-950/80 px-2 py-0.5 rounded border border-emerald-500/30">
                                    ● LIVE OCR CROP • ${e.camera_code}
                                </div>
                                <div class="absolute top-2.5 right-2.5 text-[9px] font-mono text-slate-300 bg-slate-950/80 px-2 py-0.5 rounded border border-slate-700">
                                    ${e.timestamp}
                                </div>

                                <!-- Vehicle Silhouette Simulation -->
                                <div class="text-center p-4">
                                    <div class="w-20 h-10 mx-auto text-slate-700 mb-2">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                    </div>
                                    
                                    <!-- License Plate Bounding Box Target -->
                                    <div class="inline-block relative p-2.5 rounded-lg border-2 border-emerald-400 bg-slate-950/90 shadow-lg">
                                        <div class="absolute -top-2.5 left-2 text-[8px] font-mono font-bold uppercase bg-emerald-500 text-slate-950 px-1 rounded">
                                            OCR ${e.confidence_score ? e.confidence_score + '%' : 'TARGET'}
                                        </div>
                                        <div class="font-mono text-base font-extrabold tracking-widest text-white flex items-center gap-2">
                                            <span>${plateText}</span>
                                            ${isEV ? '<span class="w-1.5 h-4 bg-emerald-400 rounded-xs"></span>' : ''}
                                        </div>
                                    </div>
                                    
                                    <div class="text-[10px] text-slate-400 mt-2 font-mono">
                                        ROI: [${e.crop_coordinates ? e.crop_coordinates.ymin + ', ' + e.crop_coordinates.xmin : '0.62, 0.38'}] • 4MP 1/1000s
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recognition Metadata Table -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">OCR Engine Classification</div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Recognized Plate:</span>
                                    <span class="font-mono font-extrabold text-slate-900">${e.recognized_plate || 'None Detected'}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Raw OCR Reading:</span>
                                    <span class="font-mono text-slate-700">${e.original_recognized_plate || 'Unreadable'}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Confidence Score:</span>
                                    <span class="font-mono font-bold ${e.confidence_score >= 90 ? 'text-emerald-700' : 'text-amber-700'}">
                                        ${e.confidence_score !== null ? e.confidence_score + '%' : 'N/A'}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Plate Category:</span>
                                    <span class="font-medium text-slate-800">${e.plate_type}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Vehicle Classification:</span>
                                    <span class="font-medium text-slate-800">${e.vehicle_type} (${e.vehicle_color || 'Unknown'})</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location & Device Metadata -->
                        <div class="space-y-2">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Camera & Gate Context</div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Facility:</span>
                                    <span class="font-bold text-slate-900">${e.facility_name}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Gate & Lane:</span>
                                    <span class="font-medium text-slate-800">${e.gate_code} • ${e.lane_name}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Camera Device:</span>
                                    <span class="font-mono font-bold text-slate-800">${e.camera_code} (${e.direction_label})</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Associated Session:</span>
                                    <span class="font-mono text-blue-700 font-bold">${e.parking_session_id || 'Not Session Associated'}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Audit & Review Trail -->
                        <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100 text-xs text-blue-950 space-y-1">
                            <div class="font-bold text-[10px] uppercase tracking-wider text-blue-800">Audit & Verification Log</div>
                            <div><strong>Review Status:</strong> ${e.review_status}</div>
                            <div><strong>Reviewed By:</strong> ${e.reviewed_by || 'Awaiting operator review'}</div>
                            ${e.reviewed_at ? '<div><strong>Timestamp:</strong> ' + e.reviewed_at + '</div>' : ''}
                            <div class="text-[11px] text-blue-900/80 mt-1"><strong>Reason / Notes:</strong> ${e.review_reason || 'Automated entry pass'}</div>
                        </div>
                    `;

                    footer.innerHTML = `
                        <button type="button" 
                                onclick="closeAnprDetailDrawer(); openReviewModal('${e.id}', '${e.event_uuid}', '${e.recognized_plate || ''}', '${e.outcome}', '${e.review_status}')" 
                                class="flex-1 py-2.5 px-4 rounded-xl bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white text-xs font-bold text-center transition-colors">
                            Manual Review
                        </button>
                        <button type="button" 
                                onclick="closeAnprDetailDrawer()" 
                                class="py-2.5 px-4 rounded-xl border border-[var(--border)] text-slate-700 text-xs font-bold text-center hover:bg-slate-100 transition-colors">
                            Close
                        </button>
                    `;
                })
                .catch(() => {
                    body.innerHTML = '<div class="text-rose-600 text-xs p-4">Error communicating with API endpoint.</div>';
                });
        }

        function closeAnprDetailDrawer() {
            document.getElementById('anpr-detail-drawer').classList.add('hidden');
        }

        // ================= MANUAL REVIEW MODAL =================
        function openReviewModal(eventId, uuid, plate, outcome, currentStatus) {
            const modal = document.getElementById('anpr-review-modal');
            const form = document.getElementById('anpr-review-form');
            const uuidEl = document.getElementById('modal-review-uuid');
            const statusEl = document.getElementById('modal-review-current-status');
            const plateInput = document.getElementById('corrected-plate-input');
            const reasonInput = document.getElementById('review-reason-input');

            form.action = '/vendor/anpr/events/' + eventId + '/review';
            uuidEl.innerText = uuid;
            statusEl.innerText = currentStatus || outcome;
            plateInput.value = plate || '';
            reasonInput.value = '';

            // Default to verified unless unreadable or pending review
            const isUnreadable = outcome === 'Unreadable' || currentStatus === 'Pending Review' || currentStatus === 'Flagged';
            const correctRadio = form.querySelector('input[name="review_status"][value="Manually Corrected"]');
            const verifyRadio = form.querySelector('input[name="review_status"][value="Verified"]');

            if (isUnreadable) {
                correctRadio.checked = true;
                togglePlateCorrectionInput(true);
            } else {
                verifyRadio.checked = true;
                togglePlateCorrectionInput(false);
            }

            modal.classList.remove('hidden');
        }

        function closeReviewModal() {
            document.getElementById('anpr-review-modal').classList.add('hidden');
        }

        // Global ESC key listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAnprDetailDrawer();
                closeReviewModal();
            }
        });
    </script>
    @endpush

</x-layouts.vendor>
