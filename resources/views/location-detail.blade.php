<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mall XYZ - Connected Parking - NusaPark</title>
    <meta name="description" content="View real-time availability, parking rates, floor maps, and amenities at Mall XYZ Jakarta Selatan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <x-navbar active="locations" />

    <!-- MAIN WRAPPER -->
    <main class="flex-1 w-full pb-20">

        <!-- ================= BREADCRUMB ================= -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-2">
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <a href="/" class="hover:text-blue-600 flex items-center gap-1 transition-colors">
                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span>Home</span>
                </a>
                <span class="text-slate-300">&gt;</span>
                <a href="/locations" class="hover:text-blue-600 transition-colors">Locations</a>
                <span class="text-slate-300">&gt;</span>
                <span class="text-slate-900 font-bold">Mall XYZ</span>
            </nav>
        </div>

        <!-- ================= LOCATION HERO / HEADER SECTION ================= -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Image Gallery & Thumbnails (lg:col-span-6) -->
                <div class="lg:col-span-6 space-y-3">
                    <!-- Main Gallery Image with Carousel Controls -->
                    <div class="relative rounded-3xl overflow-hidden shadow-sm border border-slate-200/90 group bg-slate-900">
                        <img src="{{ asset('images/mall-xyz.jpg') }}" 
                             alt="Mall XYZ Parking" 
                             id="mainGalleryImg" 
                             class="w-full h-72 sm:h-80 md:h-[340px] object-cover transition-all duration-300" />
                        
                        <!-- 1/4 Badge -->
                        <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/20 select-none" id="galleryCounter">
                            1 / 4
                        </div>

                        <!-- Prev Button -->
                        <button type="button" 
                                onclick="prevImage()" 
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-slate-800 flex items-center justify-center shadow-md transition-all cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>

                        <!-- Next Button -->
                        <button type="button" 
                                onclick="nextImage()" 
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-slate-800 flex items-center justify-center shadow-md transition-all cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    </div>

                    <!-- 4 Gallery Thumbnails -->
                    <div class="grid grid-cols-4 gap-3">
                        <div class="gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-blue-600 transition-all shadow-xs" onclick="selectImage(0, '{{ asset('images/mall-xyz.jpg') }}')">
                            <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Thumb 1" class="w-full h-16 sm:h-20 object-cover" />
                        </div>
                        <div class="gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-transparent hover:border-slate-300 transition-all opacity-80 hover:opacity-100" onclick="selectImage(1, '{{ asset('images/mall-xyz-thumb2.jpg') }}')">
                            <img src="{{ asset('images/mall-xyz-thumb2.jpg') }}" alt="Thumb 2" class="w-full h-16 sm:h-20 object-cover" />
                        </div>
                        <div class="gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-transparent hover:border-slate-300 transition-all opacity-80 hover:opacity-100" onclick="selectImage(2, '{{ asset('images/building-abc.jpg') }}')">
                            <img src="{{ asset('images/building-abc.jpg') }}" alt="Thumb 3" class="w-full h-16 sm:h-20 object-cover" />
                        </div>
                        <div class="gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-transparent hover:border-slate-300 transition-all opacity-80 hover:opacity-100" onclick="selectImage(3, '{{ asset('images/subang-square.jpg') }}')">
                            <img src="{{ asset('images/subang-square.jpg') }}" alt="Thumb 4" class="w-full h-16 sm:h-20 object-cover" />
                        </div>
                    </div>
                </div>

                <!-- Right: Location Details & Modern Building Facade (lg:col-span-6) -->
                <div class="lg:col-span-6 flex flex-col justify-between space-y-5">
                    
                    <div>
                        <!-- Top Row: Status Badge & Building Facade Photo -->
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <!-- Status Badge -->
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 mb-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Open Now · 06:00 – 23:00</span>
                                </span>

                                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                    Mall XYZ
                                </h1>

                                <!-- Meta: City, Rating, Reviews -->
                                <div class="flex flex-wrap items-center gap-2.5 text-xs text-slate-500 mt-2 font-medium">
                                    <span class="flex items-center gap-1 text-slate-700 font-semibold">
                                        📍 Jakarta Selatan
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="flex items-center gap-1 text-slate-900 font-bold">
                                        <svg class="w-3.5 h-3.5 text-amber-500 fill-amber-500" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        4.8
                                    </span>
                                    <span class="text-slate-400">(324 reviews)</span>
                                </div>
                            </div>

                            <!-- Architectural Mall XYZ Building Facade Photo -->
                            <div class="hidden sm:block shrink-0 w-44 sm:w-52 h-auto select-none pointer-events-none">
                                <img src="{{ asset('images/mall-xyz-facade.png') }}" alt="Mall XYZ Facade" class="w-full h-auto object-contain drop-shadow-sm" />
                            </div>
                        </div>

                        <!-- Street Address & Actions -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-start gap-2.5 text-xs sm:text-sm text-slate-600">
                            <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                            </svg>
                            <div>
                                <span class="font-medium text-slate-800 leading-relaxed block">
                                    Jl. Exemplo No. 123, Kebayoran Baru, Jakarta Selatan 12190
                                </span>
                                <div class="flex items-center gap-4 mt-2">
                                    <button type="button" onclick="copyAddress('Jl. Exemplo No. 123, Kebayoran Baru, Jakarta Selatan 12190')" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1 cursor-pointer">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                        <span>Copy Address</span>
                                    </button>
                                    <a href="https://maps.google.com/?q=Mall+XYZ+Jakarta+Selatan" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                        <span>Get Directions</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3 Hero Action Buttons -->
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 pt-4">
                        <a href="/active-parking" class="flex-1 min-w-[150px] py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-sm hover:shadow-md transition-all">
                            <span class="w-5 h-5 rounded-lg bg-blue-500 text-white flex items-center justify-center text-xs font-black">P</span>
                            <span>Start Parking</span>
                        </a>

                        <a href="/reservations" class="py-3.5 px-6 rounded-2xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-800 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-2xs hover:shadow-xs transition-all">
                            <svg class="w-4 h-4 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>Reserve</span>
                        </a>

                        <a href="https://maps.google.com/?q=Mall+XYZ+Jakarta+Selatan" target="_blank" class="py-3.5 px-6 rounded-2xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-800 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-2xs hover:shadow-xs transition-all">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                            <span>Navigate</span>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= CONTENT LAYOUT (TWO COLUMNS) ================= -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- ================= LEFT COLUMN (lg:col-span-8) ================= -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- 1. LIVE AVAILABILITY CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                </div>
                                <h2 class="text-base font-extrabold text-slate-900">Live Availability</h2>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Updated just now</span>
                            </span>
                        </div>

                        <!-- 4 Stat Metrics -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6">
                            <!-- Available Slots -->
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                                    <span>Available Slots</span>
                                </div>
                                <div class="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight">327</div>
                            </div>

                            <!-- Total Capacity -->
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                    <span>Total Capacity</span>
                                </div>
                                <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">1,250</div>
                            </div>

                            <!-- Occupied -->
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><path d="M5 10L7 5h10l2 5"></path><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                                    <span>Occupied</span>
                                </div>
                                <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">911</div>
                            </div>

                            <!-- Reserved -->
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1">
                                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span>Reserved</span>
                                </div>
                                <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">12</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. PARKING OPTIONS -->
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                            <h2 class="text-base font-extrabold text-slate-900">Parking Options</h2>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <!-- Option 1: Car -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mb-3">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><path d="M5 10L7 5h10l2 5"></path><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm text-slate-900">Car</div>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 mt-1">High Availability</span>
                                    <div class="text-[11px] text-slate-400 mt-2 font-medium">From Rp5.000 / hour</div>
                                </div>
                            </div>

                            <!-- Option 2: Motorcycle -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mb-3">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="16" r="3"></circle><circle cx="19" cy="16" r="3"></circle><path d="M12 17l4-9h4"></path></svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm text-slate-900">Motorcycle</div>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 mt-1">Available</span>
                                    <div class="text-[11px] text-slate-400 mt-2 font-medium">From Rp2.000 / hour</div>
                                </div>
                            </div>

                            <!-- Option 3: EV Charging -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mb-3">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm text-slate-900">EV Charging</div>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 mt-1">4 Chargers</span>
                                    <div class="text-[11px] text-slate-400 mt-2 font-medium">From Rp10.000 / hour</div>
                                </div>
                            </div>

                            <!-- Option 4: VIP -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 flex flex-col justify-between hover:shadow-md transition-shadow">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 mb-3">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14v2H5v-2z"></path></svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-sm text-slate-900">VIP</div>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 mt-1">Limited</span>
                                    <div class="text-[11px] text-slate-400 mt-2 font-medium">Rp15.000 / hour</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. PARKING MAP -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                            <div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="10" r="3"></circle><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"></path></svg>
                                    <h2 class="text-base font-extrabold text-slate-900">Parking Map</h2>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">See available spaces before you arrive.</p>
                            </div>

                            <!-- Floor Level Buttons & Open Map Full -->
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-2xl" id="floorSelector">
                                    <button type="button" onclick="selectFloor(this, 'B2')" class="px-3 py-1 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all cursor-pointer">B2</button>
                                    <button type="button" onclick="selectFloor(this, 'B1')" class="px-3 py-1 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-xs transition-all cursor-pointer">B1</button>
                                    <button type="button" onclick="selectFloor(this, 'L1')" class="px-3 py-1 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all cursor-pointer">L1</button>
                                    <button type="button" onclick="selectFloor(this, 'L2')" class="px-3 py-1 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all cursor-pointer">L2</button>
                                </div>
                                <a href="/parking-map" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                                    <span>Open Map Full</span>
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                </a>
                            </div>
                        </div>

                        <!-- Floor Slot Schematic Diagram -->
                        <div class="mt-6 bg-[#EDF3FA] rounded-2xl p-6 sm:p-8 border border-blue-100/80 relative overflow-hidden">
                            
                            <!-- Top Slot Row -->
                            <div class="grid grid-cols-4 gap-3 sm:gap-4 mb-6">
                                <!-- A-001 (Available) -->
                                <div class="bg-white border-2 border-emerald-500 text-emerald-700 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm shadow-xs transition-transform hover:scale-105 cursor-pointer">
                                    A-001
                                </div>
                                <!-- A-002 (Occupied) -->
                                <div class="bg-slate-200/90 text-slate-500 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm cursor-not-allowed">
                                    A-002
                                </div>
                                <!-- A-003 (Available) -->
                                <div class="bg-white border-2 border-emerald-500 text-emerald-700 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm shadow-xs transition-transform hover:scale-105 cursor-pointer">
                                    A-003
                                </div>
                                <!-- A-004 (Occupied) -->
                                <div class="bg-slate-200/90 text-slate-500 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm cursor-not-allowed">
                                    A-004
                                </div>
                            </div>

                            <!-- Driveway Roadway Corridor -->
                            <div class="relative py-4 my-2 border-y-2 border-dashed border-blue-200/80 flex items-center justify-center">
                                <span class="text-[10px] sm:text-xs font-black tracking-widest text-slate-400 uppercase select-none">
                                    DRIVEWAY
                                </span>
                            </div>

                            <!-- Bottom Slot Row -->
                            <div class="grid grid-cols-4 gap-3 sm:gap-4 mt-6">
                                <!-- B-001 (Occupied) -->
                                <div class="bg-slate-200/90 text-slate-500 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm cursor-not-allowed">
                                    B-001
                                </div>
                                <!-- B-002 (Available) -->
                                <div class="bg-white border-2 border-emerald-500 text-emerald-700 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm shadow-xs transition-transform hover:scale-105 cursor-pointer">
                                    B-002
                                </div>
                                <!-- B-003 (Available) -->
                                <div class="bg-white border-2 border-emerald-500 text-emerald-700 rounded-xl p-3 sm:p-4 text-center font-bold text-xs sm:text-sm shadow-xs transition-transform hover:scale-105 cursor-pointer">
                                    B-003
                                </div>
                                <!-- Empty / Entrance Slot -->
                                <div class="border-2 border-dashed border-slate-300/80 rounded-xl p-3 sm:p-4 text-center font-semibold text-xs text-slate-400 flex items-center justify-center select-none">
                                    Entrance
                                </div>
                            </div>

                        </div>

                        <!-- Legend Row -->
                        <div class="flex flex-wrap items-center justify-center gap-6 pt-5 text-xs font-semibold text-slate-600">
                            <div class="flex items-center gap-2">
                                <span class="w-4 h-4 rounded-md border-2 border-emerald-500 bg-white"></span>
                                <span>Available (327)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-4 h-4 rounded-md bg-slate-300"></span>
                                <span>Occupied (911)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-4 h-4 rounded-md border-2 border-blue-600 bg-white"></span>
                                <span>Reserved (12)</span>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- ================= RIGHT COLUMN (SIDEBAR, lg:col-span-4) ================= -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- 1. PARKING RATES CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        <div class="flex items-center gap-2 pb-4 border-b border-slate-100">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                            <h2 class="text-base font-extrabold text-slate-900">Parking Rates</h2>
                        </div>

                        <!-- Car Rates -->
                        <div class="pt-4 space-y-2.5">
                            <div class="flex items-center gap-1.5 font-bold text-xs text-slate-800">
                                <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"></rect><circle cx="7" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                                <span>Car</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>0 – 1 hour</span>
                                <span class="font-bold text-slate-900">Rp 5.000</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>1 – 2 hours</span>
                                <span class="font-bold text-slate-900">Rp 9.000</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>Next hour</span>
                                <span class="font-bold text-slate-900">+ Rp 4.000</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>Daily max</span>
                                <span class="font-bold text-slate-900">Rp 40.000</span>
                            </div>
                        </div>

                        <!-- Motorcycle Rates -->
                        <div class="pt-4 mt-4 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-1.5 font-bold text-xs text-slate-800">
                                <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="16" r="3"></circle><circle cx="19" cy="16" r="3"></circle><path d="M12 17l4-9h4"></path></svg>
                                <span>Motorcycle</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>0 – 1 hour</span>
                                <span class="font-bold text-slate-900">Rp 2.000</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-600">
                                <span>Next hour</span>
                                <span class="font-bold text-slate-900">+ Rp 2.000</span>
                            </div>
                        </div>

                        <!-- Rate Disclaimer -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-start gap-1.5 text-[11px] text-slate-400 leading-relaxed">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>Rates may vary by parking category, day, and in promotional periods.</span>
                        </div>

                        <!-- Payment Methods -->
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="text-xs font-bold text-slate-800 mb-2">Payment Methods</div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-xl text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">QRIS</span>
                                <span class="px-3 py-1 rounded-xl text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100">E-Wallet</span>
                                <span class="px-3 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">NFC Card</span>
                                <span class="px-3 py-1 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">App</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. FACILITIES CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        <div class="flex items-center gap-2 pb-4 border-b border-slate-100">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            <h2 class="text-base font-extrabold text-slate-900">Facilities</h2>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-4 text-xs font-semibold text-slate-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                <span>EV Charging</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
                                <span>24/7 Access</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                <span>CCTV Monitoring</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="4" r="2"></circle><path d="M15 11l-3 4-2-2-4 4"></path></svg>
                                <span>Disabled Parking</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. HOW TO ENTER CARD -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6">
                        <div class="flex items-center gap-2 pb-4 border-b border-slate-100">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                            <h2 class="text-base font-extrabold text-slate-900">How to Enter</h2>
                        </div>

                        <div class="pt-4 space-y-3.5">
                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-2xs">
                                    1
                                </span>
                                <span class="text-xs text-slate-600 font-medium leading-relaxed">
                                    Drive to the entrance gate.
                                </span>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-2xs">
                                    2
                                </span>
                                <span class="text-xs text-slate-600 font-medium leading-relaxed">
                                    ANPR camera reads your plate automatically.
                                </span>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-2xs">
                                    3
                                </span>
                                <span class="text-xs text-slate-600 font-medium leading-relaxed">
                                    Barrier opens, proceed to park.
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= OTHER PARKING NEARBY ================= -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="10" r="3"></circle><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"></path></svg>
                    <h2 class="text-lg font-black text-slate-900">Other Parking Nearby</h2>
                </div>
                <a href="/locations" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                    <span>View All</span>
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nearby 1: Office Tower B -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <img src="{{ asset('images/building-abc.jpg') }}" alt="Office Tower B" class="w-28 sm:w-36 h-24 sm:h-28 rounded-2xl object-cover shrink-0 shadow-xs" />
                    <div class="flex-1 min-w-0 flex flex-col justify-between h-full py-0.5">
                        <div>
                            <h3 class="font-extrabold text-sm sm:text-base text-slate-900 truncate">Office Tower B</h3>
                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5 font-medium">
                                <span>📍 0.8 km away</span>
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">Limited</span>
                                <span class="text-[11px] text-slate-500 font-semibold">24 slots available</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Starting from</span>
                                <span class="text-xs sm:text-sm font-black text-slate-900">Rp4.000 <span class="text-[10px] font-normal text-slate-500">/ hour</span></span>
                            </div>
                            <a href="/location-detail" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors shadow-2xs">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Nearby 2: Parking Building ABC -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <img src="{{ asset('images/subang-square.jpg') }}" alt="Parking Building ABC" class="w-28 sm:w-36 h-24 sm:h-28 rounded-2xl object-cover shrink-0 shadow-xs" />
                    <div class="flex-1 min-w-0 flex flex-col justify-between h-full py-0.5">
                        <div>
                            <h3 class="font-extrabold text-sm sm:text-base text-slate-900 truncate">Parking Building ABC</h3>
                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5 font-medium">
                                <span>📍 1.2 km away</span>
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Available</span>
                                <span class="text-[11px] text-slate-500 font-semibold">156 slots available</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Starting from</span>
                                <span class="text-xs sm:text-sm font-black text-slate-900">Rp6.000 <span class="text-[10px] font-normal text-slate-500">/ hour</span></span>
                            </div>
                            <a href="/location-detail" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors shadow-2xs">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-[#0B1528] text-white pt-16 pb-12 border-t border-slate-800/80 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-14">
                
                <!-- Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="/" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-blue-500/20">
                            N
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-white">Nusa<span class="text-blue-500">Park</span></span>
                    </a>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-sm">
                        Smart Parking for a Smarter Indonesia.<br>
                        Revolutionizing urban mobility through enterprise-grade technology.
                    </p>
                    <div class="flex items-center gap-3 text-slate-400 pt-2">
                        <a href="#" class="hover:text-blue-400 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Product</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="/search" class="hover:text-white transition-colors">Find Parking</a></li>
                        <li><a href="/locations" class="hover:text-white transition-colors">Locations</a></li>
                        <li><a href="/pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">App Download</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Company</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="/faq" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Get the App -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Get the App</h4>
                    <p class="text-xs text-slate-400 mb-3 leading-relaxed">Download NusaPark and manage your parking anywhere.</p>
                    <div class="space-y-2">
                        <!-- Google Play Badge -->
                        <a href="#" class="flex items-center gap-2.5 px-3 py-2 bg-slate-900 border border-slate-700/80 rounded-xl hover:border-slate-500 transition-all w-fit">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3.609 1.814L13.792 12 3.61 22.186a1.986 1.986 0 0 1-.61-.926V2.74c.15-.365.365-.688.609-.926zm11.233 11.234l2.583 2.583-11.45 6.467 8.867-9.05zm0-2.096L5.975 1.898l11.45 6.474-2.583 2.576zm1.48 1.048l3.655 2.064c.833.47.833 1.238 0 1.708l-3.655 2.064-2.222-2.222 2.222-3.614z"/>
                            </svg>
                            <div class="text-left">
                                <div class="text-[9px] uppercase tracking-wider text-slate-400 leading-tight">GET IT ON</div>
                                <div class="text-xs font-bold text-white leading-tight">Google Play</div>
                            </div>
                        </a>

                        <!-- App Store Badge -->
                        <a href="#" class="flex items-center gap-2.5 px-3 py-2 bg-slate-900 border border-slate-700/80 rounded-xl hover:border-slate-500 transition-all w-fit">
                            <svg class="w-4 h-4 text-white shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.37c.63-.77 1.06-1.85.94-2.93-.91.04-2.02.61-2.67 1.37-.58.67-1.09 1.76-.95 2.82 1.02.08 2.05-.49 2.68-1.26z"/>
                            </svg>
                            <div class="text-left">
                                <div class="text-[9px] uppercase tracking-wider text-slate-400 leading-tight">Download on the</div>
                                <div class="text-xs font-bold text-white leading-tight">App Store</div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <div>© 2026 NusaPark. All rights reserved.</div>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-slate-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ================= JAVASCRIPT LOGIC ================= -->
    <script>
        // Gallery Images List
        const galleryImages = [
            "{{ asset('images/mall-xyz.jpg') }}",
            "{{ asset('images/mall-xyz-thumb2.jpg') }}",
            "{{ asset('images/building-abc.jpg') }}",
            "{{ asset('images/subang-square.jpg') }}"
        ];
        let currentImgIndex = 0;

        function updateGalleryView() {
            const mainImg = document.getElementById('mainGalleryImg');
            const counter = document.getElementById('galleryCounter');
            const thumbs = document.querySelectorAll('.gallery-thumb');

            if (mainImg) mainImg.src = galleryImages[currentImgIndex];
            if (counter) counter.textContent = `${currentImgIndex + 1} / ${galleryImages.length}`;

            thumbs.forEach((th, idx) => {
                if (idx === currentImgIndex) {
                    th.className = 'gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-blue-600 transition-all shadow-xs';
                } else {
                    th.className = 'gallery-thumb cursor-pointer rounded-2xl overflow-hidden border-2 border-transparent hover:border-slate-300 transition-all opacity-80 hover:opacity-100';
                }
            });
        }

        function selectImage(index) {
            currentImgIndex = index;
            updateGalleryView();
        }

        function prevImage() {
            currentImgIndex = (currentImgIndex - 1 + galleryImages.length) % galleryImages.length;
            updateGalleryView();
        }

        function nextImage() {
            currentImgIndex = (currentImgIndex + 1) % galleryImages.length;
            updateGalleryView();
        }

        // Copy Address with Toast
        function copyAddress(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Address copied to clipboard: ' + text);
            }).catch(() => {
                prompt('Copy address:', text);
            });
        }

        // Floor selector
        function selectFloor(btn, floor) {
            const container = document.getElementById('floorSelector');
            if (!container) return;
            const buttons = container.querySelectorAll('button');
            buttons.forEach(b => {
                b.className = 'px-3 py-1 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all cursor-pointer';
            });
            btn.className = 'px-3 py-1 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-xs transition-all cursor-pointer';
        }
    </script>

</body>
</html>
