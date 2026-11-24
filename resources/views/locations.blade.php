<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Parking Locations - NusaPark</title>
    <meta name="description" content="Discover connected NusaPark parking locations across cities and destinations in Indonesia.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <x-navbar active="locations" />

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-20">
        <!-- HERO BANNER (Dark Blue Card with Organic S-Curve Cutout) -->
        <section class="rounded-[2.5rem] bg-gradient-to-r from-[#0C2444] via-[#0E356A] to-[#1D5EAF] text-white shadow-2xl relative overflow-hidden min-h-[300px] flex items-center">
            <!-- SVG ClipPath for the Hero Organic Curve -->
            <svg width="0" height="0" class="absolute">
                <defs>
                    <clipPath id="locations-hero-curve" clipPathUnits="objectBoundingBox">
                        <path d="M 0.22,0 
                                 C 0.12,0.18 0,0.34 0,0.50 
                                 C 0,0.68 0.08,0.82 0.25,0.91 
                                 C 0.42,0.98 0.65,1 1,1 
                                 L 1,0 Z" />
                    </clipPath>
                </defs>
            </svg>

            <!-- Desktop Right Curved Photo -->
            <div class="hidden lg:block absolute top-0 right-0 bottom-0 w-[52%] xl:w-[50%] pointer-events-none">
                <div class="w-full h-full bg-slate-900 relative overflow-hidden" style="clip-path: url(#locations-hero-curve);">
                    <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Connected Locations" class="w-full h-full object-cover object-center scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-slate-950/20"></div>

                    <!-- Illuminated P Pillar Marker in Image -->
                    <div class="absolute top-1/2 left-[20%] -translate-y-1/2">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center font-black text-2xl text-white shadow-[0_0_25px_rgba(37,99,235,0.7)] border-2 border-blue-400">
                            P
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Hero Content -->
            <div class="w-full lg:w-[54%] p-8 sm:p-12 z-10 space-y-4">
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-blue-200 text-xs font-semibold shadow-inner">
                    <svg class="w-3.5 h-3.5 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    Parking Locations
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[44px] font-black tracking-tight text-white leading-tight">
                    Explore Parking Locations
                </h1>

                <p class="text-slate-300 text-sm sm:text-base max-w-lg leading-relaxed font-normal">
                    Discover connected NusaPark parking locations across cities and destinations.
                </p>

                <!-- 3 Stats Strip -->
                <div class="flex flex-wrap items-center gap-6 sm:gap-10 pt-4">
                    <!-- Stat 1: Locations -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/70 backdrop-blur-sm border border-blue-400/30 flex items-center justify-center text-white shrink-0 shadow-md">
                            <svg class="w-5 h-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-white">128+</div>
                            <div class="text-xs text-slate-300">Locations</div>
                        </div>
                    </div>

                    <!-- Stat 2: Slots -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/70 backdrop-blur-sm border border-blue-400/30 flex items-center justify-center text-white shrink-0 shadow-md">
                            <svg class="w-5 h-5 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-white">3.4M+</div>
                            <div class="text-xs text-slate-300">Parking Slots</div>
                        </div>
                    </div>

                    <!-- Stat 3: Cities -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/70 backdrop-blur-sm border border-blue-400/30 flex items-center justify-center text-white shrink-0 shadow-md">
                            <svg class="w-5 h-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h2v2H7V5zm4 0h2v2h-2V5zm-4 4h2v2H7V9zm4 0h2v2h-2V9zm-4 4h2v2H7v-2zm4 0h2v2h-2v-2z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-white">18</div>
                            <div class="text-xs text-slate-300">Cities</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FLOATING OMNIBOX & POPULAR CITIES BAR -->
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-[0_12px_40px_rgba(0,0,0,0.07)] -mt-10 relative z-20 space-y-4 mb-8">
            <!-- Row 1: Search Inputs & Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <!-- Search Input Field -->
                <div class="relative flex-1 w-full">
                    <div class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200/90 focus-within:border-blue-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-500/10 transition-all">
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" id="locSearchInput" placeholder="Search location, mall, building, city, or address" class="w-full bg-transparent text-sm text-slate-800 placeholder-slate-400 focus:outline-none" autocomplete="off" />
                    </div>
                </div>

                <!-- Near Me Button -->
                <button type="button" id="locNearMeBtn" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-semibold text-xs flex items-center justify-center gap-2 transition-all shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <polygon points="3 11 22 2 13 21 11 13 3 11"/>
                    </svg>
                    <span>Near me</span>
                </button>

                <!-- Search Button -->
                <button type="button" id="locSearchBtn" class="w-full sm:w-auto px-7 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs flex items-center justify-center gap-2 transition-all shadow-md shadow-blue-500/25 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <span>Search</span>
                </button>
            </div>

            <!-- Row 2: Popular Cities Pills -->
            <div class="flex items-center gap-2.5 overflow-x-auto pb-1 text-xs">
                <span class="text-slate-400 font-semibold shrink-0">Popular:</span>
                <button type="button" class="city-pill active px-4 py-1.5 rounded-full font-semibold transition-all whitespace-nowrap bg-blue-600 text-white shadow-sm shadow-blue-500/20" data-city="Jakarta">Jakarta</button>
                <button type="button" class="city-pill px-4 py-1.5 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-city="Bandung">Bandung</button>
                <button type="button" class="city-pill px-4 py-1.5 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-city="Surabaya">Surabaya</button>
                <button type="button" class="city-pill px-4 py-1.5 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-city="Subang">Subang</button>
                <button type="button" class="city-pill px-4 py-1.5 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-city="Cirebon">Cirebon</button>
            </div>
        </div>

        <!-- FILTER TOOLBAR & VIEW CONTROLS -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <!-- Left Filter Pills Dropdown -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
                <button type="button" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center gap-1.5 shadow-sm whitespace-nowrap" id="filterAvailBtn">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Availability</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <button type="button" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center gap-1.5 shadow-sm whitespace-nowrap">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span>Distance</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <button type="button" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center gap-1.5 shadow-sm whitespace-nowrap">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    <span>Vehicle: Car</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <button type="button" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center gap-1.5 shadow-sm whitespace-nowrap">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>Price</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <button type="button" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center gap-1.5 shadow-sm whitespace-nowrap">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
                    <span>More Filters</span>
                </button>
            </div>

            <!-- Right Controls: Sort & Grid/List View Switcher -->
            <div class="flex items-center gap-3 shrink-0">
                <div class="flex items-center gap-2">
                    <label for="locSortSelect" class="text-xs text-slate-500 font-medium">Sort by:</label>
                    <select id="locSortSelect" class="bg-white border border-slate-200 text-xs font-semibold text-slate-700 rounded-xl px-3 py-1.5 focus:outline-none focus:border-blue-500 shadow-sm cursor-pointer">
                        <option value="nearest">Nearest</option>
                        <option value="available">Most Available</option>
                        <option value="price">Lowest Price</option>
                        <option value="rating">Top Rated</option>
                    </select>
                </div>

                <!-- View Switcher -->
                <div class="flex items-center bg-slate-100 p-1 rounded-xl border border-slate-200">
                    <button type="button" id="gridViewBtn" class="p-1.5 rounded-lg bg-blue-600 text-white shadow-sm transition-all" title="Grid View">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </button>
                    <button type="button" id="listViewBtn" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-800 transition-all" title="List View">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- SECTION TITLE WITH JAKARTA SKYLINE ILLUSTRATION -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-8">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">128 Parking Locations</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5" id="connectedLocationText">Connected locations near Jakarta</p>
            </div>

            <!-- Soft Blue Jakarta Skyline Vector Silhouette (Including Monas) -->
            <div class="hidden md:block w-72 h-16 opacity-60">
                <svg viewBox="0 0 300 80" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Skyline Buildings -->
                    <rect x="10" y="45" width="16" height="35" fill="#BFDBFE" rx="1"/>
                    <rect x="30" y="35" width="22" height="45" fill="#93C5FD" rx="1"/>
                    <rect x="56" y="50" width="18" height="30" fill="#DBEAFE" rx="1"/>
                    <!-- Monas Landmark -->
                    <polygon points="100,15 100,65 106,65 106,15" fill="#60A5FA"/>
                    <rect x="94" y="65" width="18" height="15" fill="#93C5FD" rx="1"/>
                    <!-- Monas Golden Flame -->
                    <path d="M103,8 C105,10 106,12 103,15 C100,12 101,10 103,8 Z" fill="#FBBF24"/>
                    <!-- Right Skyscrapers -->
                    <rect x="120" y="30" width="24" height="50" fill="#93C5FD" rx="1"/>
                    <rect x="148" y="40" width="20" height="40" fill="#BFDBFE" rx="1"/>
                    <rect x="172" y="25" width="28" height="55" fill="#60A5FA" rx="1"/>
                    <rect x="204" y="38" width="20" height="42" fill="#93C5FD" rx="1"/>
                    <rect x="228" y="48" width="18" height="32" fill="#DBEAFE" rx="1"/>
                    <rect x="250" y="34" width="26" height="46" fill="#BFDBFE" rx="1"/>
                </svg>
            </div>
        </div>

        <!-- 3-COLUMN PARKING CARDS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="locationsContainer">
            <!-- Card 1: Mall XYZ (Recommended) -->
            <div class="loc-card bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 overflow-hidden flex flex-col justify-between group" data-city="Jakarta" data-status="available" data-price="5000" data-dist="2.4" data-slots="327">
                <div>
                    <!-- Image Wrapper -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ Parking" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <!-- Recommended Badge -->
                        <div class="absolute top-3.5 left-3.5 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-600 text-[11px] font-bold text-white shadow-md">
                            <span class="text-amber-300">★</span> Recommended
                        </div>
                        <!-- Favorite Heart Button -->
                        <button type="button" class="heart-btn absolute top-3.5 right-3.5 w-9 h-9 rounded-full bg-white/90 hover:bg-white border border-slate-200/80 text-slate-400 hover:text-rose-500 flex items-center justify-center transition-all shadow-sm" onclick="toggleHeart(this)" title="Save to favorites">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Mall XYZ</h3>
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Jakarta Selatan
                                    </span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Open now
                                    </span>
                                </div>
                            </div>
                            <div class="text-xs font-bold text-amber-500 flex items-center gap-0.5 shrink-0 pt-0.5">
                                ★ 4.8 <span class="text-slate-400 font-normal">(1.2k)</span>
                            </div>
                        </div>

                        <!-- Availability Badge -->
                        <div class="pt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                Available <span class="text-slate-500 font-normal">327 slots available</span>
                            </span>
                        </div>

                        <!-- 2-Column Info Grid: Distance & Starting Price -->
                        <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-100 text-xs">
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                    Distance
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">2.4 km</span>
                            </div>
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                    Starting Price
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">Rp5.000 <span class="text-xs font-normal text-slate-400">/hour</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-5 pt-0 grid grid-cols-2 gap-2.5">
                    <a href="/location-detail" class="text-center py-2.5 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm transition-all flex items-center justify-center gap-1">
                        View Parking →
                    </a>
                    <button type="button" class="py-2.5 px-3 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition-all flex items-center justify-center gap-1.5" onclick="navigateTo('Mall XYZ', -6.235, 106.820)">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                        Directions
                    </button>
                </div>
            </div>

            <!-- Card 2: Subang Square (Limited) -->
            <div class="loc-card bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 overflow-hidden flex flex-col justify-between group" data-city="Subang" data-status="limited" data-price="4000" data-dist="3.1" data-slots="24">
                <div>
                    <!-- Image Wrapper -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/subang-square.jpg') }}" alt="Subang Square Parking" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <!-- Favorite Heart Button -->
                        <button type="button" class="heart-btn absolute top-3.5 right-3.5 w-9 h-9 rounded-full bg-white/90 hover:bg-white border border-slate-200/80 text-slate-400 hover:text-rose-500 flex items-center justify-center transition-all shadow-sm" onclick="toggleHeart(this)" title="Save to favorites">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Subang Square</h3>
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Subang
                                    </span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Open now
                                    </span>
                                </div>
                            </div>
                            <div class="text-xs font-bold text-amber-500 flex items-center gap-0.5 shrink-0 pt-0.5">
                                ★ 4.5 <span class="text-slate-400 font-normal">(856)</span>
                            </div>
                        </div>

                        <!-- Availability Badge -->
                        <div class="pt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 text-amber-700 text-xs font-semibold">
                                Limited <span class="text-slate-500 font-normal">24 slots available</span>
                            </span>
                        </div>

                        <!-- 2-Column Info Grid: Distance & Starting Price -->
                        <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-100 text-xs">
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                    Distance
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">3.1 km</span>
                            </div>
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                    Starting Price
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">Rp4.000 <span class="text-xs font-normal text-slate-400">/hour</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-5 pt-0 grid grid-cols-2 gap-2.5">
                    <a href="/location-detail" class="text-center py-2.5 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm transition-all flex items-center justify-center gap-1">
                        View Parking →
                    </a>
                    <button type="button" class="py-2.5 px-3 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition-all flex items-center justify-center gap-1.5" onclick="navigateTo('Subang Square', -6.240, 106.810)">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                        Directions
                    </button>
                </div>
            </div>

            <!-- Card 3: Parking Building ABC (Full) -->
            <div class="loc-card bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 overflow-hidden flex flex-col justify-between group" data-city="Bandung" data-status="full" data-price="6000" data-dist="4.5" data-slots="0">
                <div>
                    <!-- Image Wrapper -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/building-abc.jpg') }}" alt="Parking Building ABC" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <!-- Favorite Heart Button -->
                        <button type="button" class="heart-btn absolute top-3.5 right-3.5 w-9 h-9 rounded-full bg-white/90 hover:bg-white border border-slate-200/80 text-slate-400 hover:text-rose-500 flex items-center justify-center transition-all shadow-sm" onclick="toggleHeart(this)" title="Save to favorites">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Parking Building ABC</h3>
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Bandung
                                    </span>
                                    <span>•</span>
                                    <span class="text-amber-600 font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Closing soon
                                    </span>
                                </div>
                            </div>
                            <div class="text-xs font-bold text-amber-500 flex items-center gap-0.5 shrink-0 pt-0.5">
                                ★ 4.2 <span class="text-slate-400 font-normal">(412)</span>
                            </div>
                        </div>

                        <!-- Availability Badge -->
                        <div class="pt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-rose-50 text-rose-700 text-xs font-semibold">
                                Full <span class="text-slate-500 font-normal">0 slots available</span>
                            </span>
                        </div>

                        <!-- 2-Column Info Grid: Distance & Starting Price -->
                        <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-100 text-xs">
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                    Distance
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">4.5 km</span>
                            </div>
                            <div class="space-y-0.5">
                                <span class="text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                    Starting Price
                                </span>
                                <span class="font-extrabold text-slate-800 text-sm">Rp6.000 <span class="text-xs font-normal text-slate-400">/hour</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button (Full Width View Location) -->
                <div class="p-5 pt-0">
                    <a href="/location-detail" class="w-full py-2.5 px-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs border border-slate-200 transition-all flex items-center justify-center gap-1">
                        View Location →
                    </a>
                </div>
            </div>
        </div>

        <!-- PAGINATION BAR -->
        <div class="flex items-center justify-center gap-2 pt-14">
            <button type="button" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-400 font-semibold text-xs cursor-not-allowed">
                &lt; Previous
            </button>
            <button type="button" class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow-sm shadow-blue-500/20">
                1
            </button>
            <button type="button" class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center transition-colors">
                2
            </button>
            <button type="button" class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center transition-colors">
                3
            </button>
            <button type="button" class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center transition-colors">
                4
            </button>
            <button type="button" class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center transition-colors">
                5
            </button>
            <button type="button" class="px-4 py-2 rounded-xl border border-slate-200 hover:border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition-colors">
                Next &gt;
            </button>
        </div>
    </main>

    <!-- FOOTER WITH APP STORE BADGES -->
    <footer class="bg-[#0B1528] text-white pt-16 pb-12 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-14">
                <!-- Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="/" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <svg class="w-4 h-4 fill-none stroke-current stroke-[2.5]" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 19V5l12 14V5" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white">Nusa<span class="text-blue-500">Park</span></span>
                    </a>
                    <p class="text-slate-400 text-sm max-w-sm leading-relaxed">
                        Smart Parking for a Smarter Indonesia. Revolutionizing urban mobility through enterprise-grade technology.
                    </p>
                    <div class="flex items-center gap-3 pt-2 text-slate-400">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all" aria-label="Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all" aria-label="YouTube">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all" aria-label="LinkedIn">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Product Column -->
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Product</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="/search" class="hover:text-white transition-colors">Find Parking</a></li>
                        <li><a href="/locations" class="hover:text-white transition-colors">Locations</a></li>
                        <li><a href="/pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">App Download</a></li>
                    </ul>
                </div>

                <!-- Company Column -->
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Company</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>

                <!-- Get the App Column (With Official Badges) -->
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm tracking-wider uppercase">Get the App</h4>
                    <p class="text-xs text-slate-400 mb-4 leading-relaxed">
                        Find, book, and pay for parking more easily with the NusaPark app.
                    </p>
                    <div class="space-y-2.5">
                        <!-- App Store Button -->
                        <a href="#" class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-slate-500 text-white transition-all w-full shadow-sm group">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.37c.62-.75 1.04-1.8 0.92-2.85-.9.04-1.99.6-2.63 1.35-.56.64-1.06 1.71-.93 2.73 1 .08 2.02-.48 2.64-1.23z"/></svg>
                            <div class="text-left">
                                <div class="text-[9px] uppercase tracking-wider text-slate-400">Download on the</div>
                                <div class="text-xs font-bold leading-tight">App Store</div>
                            </div>
                        </a>

                        <!-- Google Play Button -->
                        <a href="#" class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-slate-500 text-white transition-all w-full shadow-sm group">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M3.609 1.814L13.792 12 3.61 22.186a1.987 1.987 0 0 1-.61-.926V2.74a1.987 1.987 0 0 1 .609-.926zm11.602 11.602L4.697 2.899l10.514 10.517zm1.414-1.414L19.5 9.5a1.5 1.5 0 0 0 0-2.122l-2.875-2.878-1.414 1.414 1.414 1.414zM4.697 21.101l10.514-10.517-1.414-1.414-10.514 10.517 1.414 1.414z"/></svg>
                            <div class="text-left">
                                <div class="text-[9px] uppercase tracking-wider text-slate-400">GET IT ON</div>
                                <div class="text-xs font-bold leading-tight">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <p>&copy; 2026 NusaPark. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-slate-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-400 transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-slate-400 transition-colors">Security</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('locSearchInput');
            const searchBtn = document.getElementById('locSearchBtn');
            const cards = document.querySelectorAll('.loc-card');
            const cityPills = document.querySelectorAll('.city-pill');
            const subtitleText = document.getElementById('connectedLocationText');
            const sortSelect = document.getElementById('locSortSelect');
            const container = document.getElementById('locationsContainer');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            // City Filter Function
            cityPills.forEach(pill => {
                pill.addEventListener('click', () => {
                    cityPills.forEach(p => {
                        p.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-sm', 'shadow-blue-500/20');
                        p.classList.add('bg-slate-100', 'text-slate-700');
                    });
                    pill.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-sm', 'shadow-blue-500/20');
                    pill.classList.remove('bg-slate-100', 'text-slate-700');

                    const city = pill.dataset.city;
                    subtitleText.textContent = `Connected locations near ${city}`;

                    cards.forEach(card => {
                        const cardCity = card.dataset.city;
                        if (city === 'Jakarta') {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = (cardCity.toLowerCase() === city.toLowerCase()) ? 'flex' : 'none';
                        }
                    });
                });
            });

            // Live Search Filter
            function filterLocations() {
                const val = searchInput.value.toLowerCase();
                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    card.style.display = text.includes(val) ? 'flex' : 'none';
                });
            }
            if (searchInput) searchInput.addEventListener('input', filterLocations);
            if (searchBtn) searchBtn.addEventListener('click', filterLocations);

            // Near Me Button
            const nearMeBtn = document.getElementById('locNearMeBtn');
            if (nearMeBtn) {
                nearMeBtn.addEventListener('click', () => {
                    nearMeBtn.classList.add('bg-blue-50', 'text-blue-600', 'border-blue-200');
                    cityPills[0].click();
                });
            }

            // Sort Dropdown
            if (sortSelect && container) {
                sortSelect.addEventListener('change', () => {
                    const val = sortSelect.value;
                    const cardsArray = Array.from(cards);
                    cardsArray.sort((a, b) => {
                        if (val === 'price') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        if (val === 'nearest') return parseFloat(a.dataset.dist) - parseFloat(b.dataset.dist);
                        if (val === 'available') return parseFloat(b.dataset.slots) - parseFloat(a.dataset.slots);
                        return 0;
                    });
                    cardsArray.forEach(c => container.appendChild(c));
                });
            }

            // Grid / List View Toggle
            if (gridBtn && listBtn && container) {
                gridBtn.addEventListener('click', () => {
                    gridBtn.className = 'p-1.5 rounded-lg bg-blue-600 text-white shadow-sm transition-all';
                    listBtn.className = 'p-1.5 rounded-lg text-slate-500 hover:text-slate-800 transition-all';
                    container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
                });

                listBtn.addEventListener('click', () => {
                    listBtn.className = 'p-1.5 rounded-lg bg-blue-600 text-white shadow-sm transition-all';
                    gridBtn.className = 'p-1.5 rounded-lg text-slate-500 hover:text-slate-800 transition-all';
                    container.className = 'grid grid-cols-1 gap-4';
                });
            }

            // Heart / Favorite Toggle
            window.toggleHeart = function(btn) {
                const svg = btn.querySelector('svg');
                const isSaved = btn.classList.contains('text-rose-500');
                if (isSaved) {
                    btn.classList.remove('text-rose-500');
                    btn.classList.add('text-slate-400');
                    svg.setAttribute('fill', 'none');
                } else {
                    btn.classList.add('text-rose-500');
                    btn.classList.remove('text-slate-400');
                    svg.setAttribute('fill', 'currentColor');
                }
            };

            // Directions to Navigation
            window.navigateTo = function(name, lat, lng) {
                window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, '_blank');
            };
        });
    </script>
</body>
</html>
