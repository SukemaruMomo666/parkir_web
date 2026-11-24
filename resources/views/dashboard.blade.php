<x-layouts.app activeNav="dashboard">
    @php
        $user = Auth::user();
        $name = trim($user?->name ?? 'Prabu');
        $parts = explode(' ', $name);
        $firstName = $parts[0] ?? 'Prabu';
    @endphp

    <!-- GREETING & ARCHITECTURAL HEADER -->
    <div class="relative flex flex-col md:flex-row md:items-center justify-between pb-2 mb-2">
        <div class="relative z-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Good morning, {{ $firstName }}.
            </h1>
            <p class="text-slate-500 text-sm sm:text-base mt-1">
                Here's what's happening with your parking today.
            </p>
        </div>

        <!-- Architectural Skyline Graphic in Top Right -->
        <div class="hidden md:block absolute -top-4 right-0 h-24 w-auto pointer-events-none select-none opacity-90">
            <img src="{{ asset('images/dashboard-skyline.png') }}" alt="Parking Skyline" class="h-full w-auto object-contain" />
        </div>
    </div>

    <!-- MAIN TWO-COLUMN DASHBOARD GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

        <!-- LEFT COLUMN (Main Content) -->
        <div class="lg:col-span-7 xl:col-span-8 space-y-6">

            <!-- 1. ACTIVE PARKING HERO CARD (GRADIENT HERO CARD) -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-sky-500 p-6 sm:p-7 text-white shadow-xl shadow-blue-500/10">
                
                <!-- Stylized "N" Watermark in Background -->
                <div class="absolute -top-6 -right-6 text-white/10 font-black text-9xl pointer-events-none select-none tracking-tighter">
                    N
                </div>

                <!-- Top Currently Parked Pill -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Currently Parked</span>
                </div>

                <!-- Title & Location -->
                <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight mb-0.5">
                    Mall XYZ Jakarta
                </h2>
                <p class="text-xs sm:text-sm text-blue-100 flex items-center gap-1.5 mb-5">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Jakarta Selatan</span>
                </p>

                <!-- Floating Information White Card -->
                <div class="bg-white rounded-2xl p-5 sm:p-6 text-slate-800 shadow-xl border border-white/60">
                    
                    <!-- 4 Metric Columns -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-5 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-400 font-medium block">Vehicle</span>
                                <span class="text-xs sm:text-sm font-bold text-slate-900">B 1234 XYZ</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-400 font-medium block">Entry</span>
                                <span class="text-xs sm:text-sm font-bold text-slate-900">10:32 AM</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-400 font-medium block">Duration</span>
                                <span class="text-xs sm:text-sm font-bold text-slate-900">1h 24m</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <span class="font-bold text-xs">P</span>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-400 font-medium block">Slot</span>
                                <span class="text-xs sm:text-sm font-bold text-slate-900">L2 • B-24</span>
                            </div>
                        </div>
                    </div>

                    <!-- Live Fee & Pay Button Row -->
                    <div class="pt-5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12V7H5a2 2 0 0 1 2-2h14v4z"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-400 block">Estimated Fee (Live)</span>
                                <span class="text-2xl font-black text-blue-600 tracking-tight">Rp 12.000</span>
                            </div>
                        </div>

                        <a href="/payment?type=session" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-blue-500/25 transition-all">
                            <span>Pay Fee</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Bottom Action Pills -->
                    <div class="pt-5 mt-4 border-t border-slate-100 flex flex-wrap items-center gap-3">
                        <a href="/active-parking" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                            <span>View Active Session</span>
                        </a>
                        <a href="/parking-map" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                            <span>View Map</span>
                        </a>
                    </div>

                </div>

            </div>

            <!-- 2. QUICK ACTIONS SECTION -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 mb-3">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                    
                    <!-- Card 1: Find Parking (Active in mockup) -->
                    <a href="/search" class="p-4 rounded-2xl bg-blue-50 border-2 border-blue-400 text-center shadow-xs hover:shadow-md transition-all flex flex-col items-center justify-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <span class="text-xs font-bold text-blue-700">Find Parking</span>
                    </a>

                    <!-- Card 2: Parking Map -->
                    <a href="/parking-map" class="p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 text-center shadow-xs hover:shadow-md transition-all flex flex-col items-center justify-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Parking Map</span>
                    </a>

                    <!-- Card 3: Reservations -->
                    <a href="/reservations" class="p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 text-center shadow-xs hover:shadow-md transition-all flex flex-col items-center justify-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Reservations</span>
                    </a>

                    <!-- Card 4: My Vehicles -->
                    <a href="/vehicles" class="p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 text-center shadow-xs hover:shadow-md transition-all flex flex-col items-center justify-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">My Vehicles</span>
                    </a>

                </div>
            </div>

            <!-- 3. PARKING NEAR YOU SECTION -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-900">Parking near you</h3>
                    <a href="/search" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View all</a>
                </div>

                <div class="space-y-3">
                    <!-- Item 1: Mall XYZ -->
                    <a href="/location-detail?name=Mall%20XYZ" class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 border border-slate-100 hover:border-slate-200 transition-all group">
                        <div class="flex items-center gap-3.5">
                            <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ" class="w-14 h-12 rounded-xl object-cover shadow-xs" />
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Mall XYZ</h4>
                                <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <span>📍 2.4 km</span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Open 327 slots available
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-sm font-bold text-slate-900">Rp 5.000</div>
                                <div class="text-[10px] text-slate-400">per hour</div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </a>

                    <!-- Item 2: Stasiun Sentral -->
                    <a href="/location-detail?name=Stasiun%20Sentral" class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 border border-slate-100 hover:border-slate-200 transition-all group">
                        <div class="flex items-center gap-3.5">
                            <img src="{{ asset('images/subang-square.jpg') }}" alt="Stasiun Sentral" class="w-14 h-12 rounded-xl object-cover shadow-xs" />
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Stasiun Sentral</h4>
                                <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <span>📍 3.1 km</span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Open 14 slots available
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-sm font-bold text-slate-900">Rp 4.000</div>
                                <div class="text-[10px] text-slate-400">per hour</div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- 4. BOTTOM STATS PILL (NusaPark in Numbers) -->
            <div class="bg-gradient-to-r from-blue-50/80 via-slate-50 to-indigo-50/60 rounded-2xl p-4 sm:p-5 border border-blue-100/80 flex items-center justify-between shadow-xs relative overflow-hidden">
                <div class="flex items-center gap-6 sm:gap-10 divide-x divide-slate-200/80">
                    <!-- Stat 1 -->
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-black text-sm shadow-sm">
                            P
                        </div>
                        <div>
                            <div class="text-base sm:text-lg font-black text-slate-900 leading-tight">128</div>
                            <div class="text-[10px] font-semibold text-slate-500">Parking Locations</div>
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="flex items-center gap-3 pl-6 sm:pl-10">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        </div>
                        <div>
                            <div class="text-base sm:text-lg font-black text-slate-900 leading-tight">1.024</div>
                            <div class="text-[10px] font-semibold text-slate-500">Active Sessions</div>
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="flex items-center gap-3 pl-6 sm:pl-10">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <div class="text-base sm:text-lg font-black text-slate-900 leading-tight">8.320</div>
                            <div class="text-[10px] font-semibold text-slate-500">Total Users</div>
                        </div>
                    </div>
                </div>

                <!-- Watermark road motif on right -->
                <div class="hidden sm:block text-blue-600/20 font-black text-4xl italic select-none">
                    N
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN (Widgets Stack) -->
        <div class="lg:col-span-5 xl:col-span-4 space-y-6">

            <!-- WIDGET 1: UPCOMING RESERVATION -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 relative overflow-hidden">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-900 mb-3">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span>Upcoming Reservation</span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <div class="max-w-[170px]">
                        <h4 class="text-sm font-bold text-slate-900 mb-1">Planning ahead?</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Reserve parking at supported locations.</p>
                        <a href="/reservations" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-all">
                            <span>Explore Parking</span>
                            <svg class="w-3 h-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="w-28 h-20 shrink-0">
                        <img src="{{ asset('images/dashboard-reservation.png') }}" alt="Reservation Illustration" class="w-full h-full object-contain" />
                    </div>
                </div>
            </div>

            <!-- WIDGET 2: YOUR VEHICLES -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        <span>Your Vehicles</span>
                    </div>
                    <a href="/vehicles" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Manage</a>
                </div>

                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50/70 border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        </div>
                        <div>
                            <h5 class="text-sm font-bold text-slate-900">Toyota Avanza</h5>
                            <span class="text-xs text-slate-500 font-mono">B •••• XYZ</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded bg-blue-50 text-blue-600 border border-blue-100">
                        DEFAULT
                    </span>
                </div>
            </div>

            <!-- WIDGET 3: RECENT ALERTS -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span>Recent Alerts</span>
                    </div>
                    <a href="/notifications" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View all</a>
                </div>

                <div class="space-y-3.5">
                    <!-- Alert 1 -->
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h5 class="text-xs font-bold text-slate-900">Parking session completed</h5>
                            <p class="text-[11px] text-slate-500">Mall XYZ • Rp 12.000 paid</p>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Yesterday, 14:20</span>
                        </div>
                    </div>

                    <!-- Alert 2 -->
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs font-black">i</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h5 class="text-xs font-bold text-slate-900">Welcome to NusaPark!</h5>
                            <p class="text-[11px] text-slate-500">Your account is ready to use.</p>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Oct 2, 09:00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WIDGET 4: RECENT ACTIVITY -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        <span>Recent Activity</span>
                    </div>
                    <a href="/history" class="text-xs font-semibold text-blue-600 hover:text-blue-700">History</a>
                </div>

                <div class="space-y-3.5">
                    <!-- Activity 1 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-slate-900">Mall XYZ</h5>
                                <span class="text-[10px] text-slate-400">Yesterday • 1h 24m</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-900">Rp 12.000</div>
                            <span class="text-[9px] font-extrabold uppercase text-emerald-600 tracking-wider">COMPLETED</span>
                        </div>
                    </div>

                    <!-- Activity 2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-slate-900">Stasiun Sentral</h5>
                                <span class="text-[10px] text-slate-400">Oct 4 • 4h 10m</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-900">Rp 20.000</div>
                            <span class="text-[9px] font-extrabold uppercase text-emerald-600 tracking-wider">COMPLETED</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layouts.app>
