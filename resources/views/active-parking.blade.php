<x-layouts.app activeNav="active-parking">
    <div class="w-full space-y-6">
        
        <!-- HEADER WITH INTEGRATED BUILDING GRAPHIC & NEED HELP CARD -->
        <div class="relative flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-2">
            
            <!-- Left Header Text -->
            <div class="max-w-xl relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-xs font-semibold mb-3">
                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                    <span>Active Parking</span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
                    Your current parking session
                </h1>
                
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                    Here's the detail of your ongoing parking session. You can view the location, check the duration and make a payment when you're ready.
                </p>
            </div>

            <!-- Center/Right Architectural Building Graphic -->
            <div class="hidden xl:block absolute left-[44%] top-[-10px] h-32 w-auto pointer-events-none select-none opacity-90">
                <img src="{{ asset('images/active-parking-building.png') }}" alt="Parking Building Sign" class="h-full w-auto object-contain" />
            </div>

            <!-- Right "Need Help?" Card -->
            <div class="shrink-0 relative z-10">
                <a href="/faq" class="p-4 sm:p-4.5 rounded-2xl bg-white border border-slate-200/90 hover:border-blue-300 shadow-xs hover:shadow-md transition-all flex items-center justify-between gap-4 group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900">Need help?</div>
                            <div class="text-[11px] text-slate-500">Contact our support team</div>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>

        @if(!isset($hasActiveSession) || $hasActiveSession)
            <!-- ACTIVE SESSION MAIN TWO-COLUMN GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- LEFT COLUMN: PRIMARY CARD + EXIT BANNER -->
                <div class="lg:col-span-7 xl:col-span-8 space-y-6">
                    
                    <!-- 1. MAIN ACTIVE SESSION CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7 relative overflow-hidden">
                        
                        <!-- Top Row: Active Status Badge & View on Map Link -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>ACTIVE</span>
                            </span>

                            <a href="#parking-map-widget" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                                <span>View on Map</span>
                            </a>
                        </div>

                        <!-- Venue Name & Location -->
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            Mall XYZ
                        </h2>
                        <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5 mb-6">
                            <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>Jakarta Selatan</span>
                        </p>

                        <!-- 5 Key Metrics Boxes (Horizontal Grid) -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-3.5 mb-6">
                            
                            <!-- Box 1: Vehicle -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                    </div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Vehicle</span>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-bold text-slate-900 truncate">B 1234 XYZ</div>
                                    <span class="inline-block mt-1 px-1.5 py-0.5 rounded bg-blue-50 text-blue-600 text-[9px] font-bold">Toyota Avanza</span>
                                </div>
                            </div>

                            <!-- Box 2: Parking Spot -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <span class="font-bold text-[11px]">P</span>
                                    </div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Parking Spot</span>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-bold text-slate-900 truncate">B1 - A01</div>
                                    <span class="text-[10px] text-slate-400 font-medium">Zone A</span>
                                </div>
                            </div>

                            <!-- Box 3: Entry Time -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    </div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Entry Time</span>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-bold text-slate-900">11:01 AM</div>
                                    <span class="text-[10px] text-slate-400 font-medium">Today, Oct 4</span>
                                </div>
                            </div>

                            <!-- Box 4: Duration -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 22h14M5 2h14M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/></svg>
                                    </div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Duration</span>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-bold text-slate-900" id="liveDurationVal">1h 24m</div>
                                    <span class="text-[10px] font-semibold text-emerald-600">(ongoing)</span>
                                </div>
                            </div>

                            <!-- Box 5: Estimated Fee -->
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    </div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Estimated Fee</span>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-bold text-slate-900">Rp 12.000</div>
                                    <a href="/pricing" class="text-[10px] text-blue-600 font-semibold hover:underline">View details</a>
                                </div>
                            </div>

                        </div>

                        <!-- Mid Action Bar: Info Note + Pay Fee Button -->
                        <div class="p-3.5 rounded-2xl bg-blue-50/60 border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-2.5 text-xs text-slate-600">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                                    <span class="font-bold text-xs">i</span>
                                </div>
                                <span>You can pay for your parking session anytime before you exit.</span>
                            </div>

                            <a href="/payment?type=session" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-blue-500/25 transition-all shrink-0">
                                <span>Pay Fee</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>

                        <!-- Bottom Sub-Actions Row -->
                        <div class="pt-5 mt-5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <a href="/location-detail?name=Mall%20XYZ" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-xs font-semibold shadow-2xs transition-colors">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span>View Location</span>
                                </a>
                                <a href="/parking-map" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-xs font-semibold shadow-2xs transition-colors">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                                    <span>View Map</span>
                                </a>
                            </div>

                            <div>
                                <button type="button" onclick="alert('Time extension request submitted successfully!')" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-xs font-semibold shadow-2xs transition-colors">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                    <span>Extend Time</span>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- 2. "PAYMENT REQUIRED UPON EXIT" BANNER -->
                    <div class="bg-gradient-to-r from-blue-50/90 via-sky-50 to-indigo-50/70 rounded-2xl p-4 sm:p-5 border border-blue-100 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 mb-0.5">Payment required upon exit</h3>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Complete your payment before leaving the parking area to avoid additional charges.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5 shrink-0 self-end sm:self-center">
                            <a href="/payment?type=session" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm transition-all">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12V7H5a2 2 0 0 1 2-2h14v4z"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                                <span>Pay Now</span>
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                            <div class="w-7 h-7 rounded-full bg-white/80 border border-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: PARKING LOCATION MAP + SESSION TIMELINE -->
                <div class="lg:col-span-5 xl:col-span-4 space-y-6">
                    
                    <!-- WIDGET 1: PARKING LOCATION MAP CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 space-y-4" id="parking-map-widget">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                                <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                                <span>Parking Location</span>
                            </div>
                            <a href="https://maps.google.com/?q=Mall+XYZ+Jakarta" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                <span>Open in Maps</span>
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>

                        <!-- Stylized Mini Map Container -->
                        <div class="relative h-44 rounded-2xl overflow-hidden border border-slate-100 bg-slate-100 shadow-inner group">
                            <img src="{{ asset('images/active-parking-map.png') }}" alt="Parking Location Map" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
                            
                            <!-- Location Pin on Map -->
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                <div class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-md whitespace-nowrap mb-1">
                                    Mall XYZ
                                </div>
                                <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs ring-4 ring-blue-500/30 shadow-lg">
                                    P
                                </div>
                            </div>

                            <!-- Compass Icon Bottom Right -->
                            <div class="absolute bottom-2.5 right-2.5 w-7 h-7 rounded-lg bg-white/95 shadow-md flex items-center justify-center text-blue-600 backdrop-blur-xs">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                            </div>
                        </div>

                        <!-- Venue Summary Card Below Map -->
                        <div class="flex items-center gap-3.5 pt-1">
                            <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ Building" class="w-20 h-16 rounded-xl object-cover shadow-xs shrink-0" />
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-slate-900 truncate">Mall XYZ</h4>
                                <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                                    <span>📍 Jakarta Selatan</span>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[10px] text-amber-500 font-semibold flex items-center gap-0.5">
                                        ★ 4.8 <span class="text-slate-400">(1,230 reviews)</span>
                                    </span>
                                </div>
                                <div class="mt-1">
                                    <span class="text-[10px] font-bold text-emerald-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Available
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Get Directions Button -->
                        <a href="https://maps.google.com/?q=Mall+XYZ+Jakarta" target="_blank" class="w-full py-2.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center gap-2 transition-colors">
                            <span>Get Directions</span>
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>

                    </div>

                    <!-- WIDGET 2: SESSION TIMELINE CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                                <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span>Session Timeline</span>
                            </div>
                            <a href="/history" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View All</a>
                        </div>

                        <!-- 3-Step Timeline with Vertical Connecting Line -->
                        <div class="space-y-6 relative before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
                            
                            <!-- Step 1 (Current / Active) -->
                            <div class="flex items-start justify-between gap-3 relative pl-6">
                                <div class="absolute left-0 top-1 w-4 h-4 rounded-full bg-blue-600 ring-4 ring-blue-100 flex items-center justify-center text-white">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-900">Currently parked</h5>
                                    <p class="text-[11px] text-slate-500 mt-0.5">You have been parked for 1h 24m</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-[11px] font-bold text-slate-900">11:01 AM</div>
                                    <span class="text-[10px] text-slate-400">Today</span>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex items-start justify-between gap-3 relative pl-6">
                                <div class="absolute left-0.5 top-1 w-3.5 h-3.5 rounded-full border-2 border-slate-300 bg-white"></div>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-900">Vehicle recognized</h5>
                                    <p class="text-[11px] text-slate-500 mt-0.5">ANPR camera verified your vehicle</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-[11px] font-bold text-slate-900">11:01 AM</div>
                                    <span class="text-[10px] text-slate-400">Today</span>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex items-start justify-between gap-3 relative pl-6">
                                <div class="absolute left-0.5 top-1 w-3.5 h-3.5 rounded-full border-2 border-slate-300 bg-white"></div>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-900">Entered parking</h5>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Payment required upon exit</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-[11px] font-bold text-slate-900">11:01 AM</div>
                                    <span class="text-[10px] text-slate-400">Today</span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        @else
            <!-- NO ACTIVE SESSION FALLBACK -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-12 text-center max-w-xl mx-auto">
                <div class="w-16 h-16 mx-auto rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No Active Parking Session</h3>
                <p class="text-xs sm:text-sm text-slate-500 mb-6">You don't have any vehicle currently parked. Ready to find a spot?</p>
                <a href="/search" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm shadow-md shadow-blue-500/25">
                    <span>Find Parking</span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif

    </div>
</x-layouts.app>
