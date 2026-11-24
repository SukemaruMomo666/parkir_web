@props(['isAuthenticated' => false])

<!-- LEAFLET CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<!-- SEARCH HERO BANNER -->
<section class="relative bg-gradient-to-r from-blue-50/50 via-slate-50/30 to-blue-50/60 pt-6 pb-20 overflow-hidden border-b border-slate-100">
    <!-- SVG ClipPath Definition for the Banner S-Curve -->
    <svg width="0" height="0" class="absolute">
        <defs>
            <clipPath id="search-banner-curve" clipPathUnits="objectBoundingBox">
                <path d="M 0.22,0 
                         C 0.12,0.16 0,0.32 0,0.50 
                         C 0,0.68 0.08,0.82 0.25,0.91 
                         C 0.42,0.98 0.65,1 1,1 
                         L 1,0 Z" />
            </clipPath>
        </defs>
    </svg>

    <!-- Desktop Curved Photo on Right -->
    <div class="hidden lg:block absolute top-0 right-0 bottom-0 w-[50%] xl:w-[48%] pointer-events-none">
        <div class="w-full h-full bg-slate-900 shadow-xl relative overflow-hidden" style="clip-path: url(#search-banner-curve);">
            <img src="{{ asset('images/parking-header.jpg') }}" alt="NusaPark Parking Facility" class="w-full h-full object-cover object-center scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
        </div>
    </div>

    <!-- Container Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-xl">
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-600 text-xs font-semibold mb-3.5 shadow-sm">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                Find Parking
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Find Parking <span class="text-blue-600">Near You</span>
            </h1>

            <p class="mt-3 text-slate-500 text-sm sm:text-base leading-relaxed max-w-lg">
                Discover available parking, compare prices, and navigate directly to your destination.
            </p>

            @if($isAuthenticated)
                <div class="mt-4 inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm px-3.5 py-1.5 rounded-full border border-slate-200 text-xs shadow-sm">
                    <span class="text-slate-500">Parking for</span>
                    <span class="font-bold text-slate-800">🚗 Toyota Avanza · B •••• XYZ</span>
                    <a href="/vehicles" class="text-blue-600 hover:text-blue-700 font-semibold ml-1">Change</a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- FLOATING OMNIBOX / SEARCH & FILTER BAR -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-30 mb-8">
    <div class="bg-white rounded-3xl p-4 sm:p-5 border border-slate-100 shadow-[0_12px_40px_rgba(0,0,0,0.06)] space-y-4">
        <!-- Row 1: Search Input, Use Location, Filter Button -->
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <!-- Search Input with Autocomplete -->
            <div class="relative flex-1 w-full" id="searchInputWrapper">
                <div class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-slate-50/80 border border-slate-200/90 focus-within:border-blue-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-500/10 transition-all">
                    <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Search mall, building, area, or address" class="w-full bg-transparent text-sm text-slate-800 placeholder-slate-400 focus:outline-none" autocomplete="off" />
                </div>

                <!-- Autocomplete Dropdown -->
                <div id="autocompleteDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden z-50 py-2">
                    <div class="px-4 py-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Suggested Locations</div>
                    <div class="ac-item px-4 py-2.5 hover:bg-slate-50 cursor-pointer flex items-center justify-between text-xs" onclick="selectLocation('Mall XYZ')">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span class="font-bold text-slate-900">Mall XYZ</span>
                        </div>
                        <span class="text-slate-400 text-[11px]">Jakarta Selatan</span>
                    </div>
                    <div class="ac-item px-4 py-2.5 hover:bg-slate-50 cursor-pointer flex items-center justify-between text-xs" onclick="selectLocation('Subang Square')">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span class="font-bold text-slate-900">Subang Square</span>
                        </div>
                        <span class="text-slate-400 text-[11px]">Subang</span>
                    </div>
                    <div class="ac-item px-4 py-2.5 hover:bg-slate-50 cursor-pointer flex items-center justify-between text-xs" onclick="selectLocation('Parking Building ABC')">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span class="font-bold text-slate-900">Parking Building ABC</span>
                        </div>
                        <span class="text-slate-400 text-[11px]">Bandung</span>
                    </div>
                </div>
            </div>

            <!-- Use My Location Button -->
            <button type="button" id="locationBtn" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-blue-50/80 hover:bg-blue-100/80 text-blue-600 border border-blue-100/90 font-semibold text-xs flex items-center justify-center gap-2 transition-all whitespace-nowrap">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <polygon points="3 11 22 2 13 21 11 13 3 11"/>
                </svg>
                <span id="locationText">Use my location</span>
            </button>

            <!-- Filters Button -->
            <button type="button" id="openFiltersBtn" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-semibold text-xs flex items-center justify-center gap-2 transition-all shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <span>Filters</span>
                <span id="filterCount" class="hidden px-1.5 py-0.5 rounded-full bg-blue-600 text-[10px] text-white">0</span>
            </button>
        </div>

        <!-- Row 2: Filter Pills / Chips -->
        <div class="flex items-center gap-2.5 overflow-x-auto pb-1 scrollbar-none text-xs">
            <button type="button" class="filter-chip active inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-blue-600 text-white shadow-sm shadow-blue-500/20" data-filter="available">
                <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Available Now
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="nearest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                Nearest
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="lowest-price">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Lowest Price
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="car">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                Car
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="motorcycle">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="5" cy="16" r="3"/><circle cx="19" cy="16" r="3"/><path d="M12 17h4l-3-7H9l-2 4h5z"/></svg>
                Motorcycle
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="ev">
                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                EV
            </button>
            <button type="button" class="filter-chip inline-flex items-center gap-1.5 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-slate-100 hover:bg-slate-200/80 text-slate-700" data-filter="vip">
                <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/></svg>
                VIP
            </button>
        </div>
    </div>
</div>

<!-- MAIN TWO-COLUMN DISCOVERY CONTENT -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- LEFT: PARKING RESULTS LIST -->
        <div class="w-full lg:w-[48%] xl:w-[46%] space-y-4">
            <!-- Results Header -->
            <div class="flex items-center justify-between pb-2">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Parking near Jakarta Selatan</h2>
                    <p class="text-xs text-slate-500" id="resultCountText">128 locations found</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="sortSelect" class="text-xs text-slate-500 font-medium">Sort by:</label>
                    <select id="sortSelect" class="bg-white border border-slate-200 text-xs font-semibold text-slate-700 rounded-xl px-3 py-1.5 focus:outline-none focus:border-blue-500 shadow-sm cursor-pointer">
                        <option value="nearest">Nearest</option>
                        <option value="available">Most Available</option>
                        <option value="price">Lowest Price</option>
                        <option value="rating">Top Rated</option>
                    </select>
                </div>
            </div>

            <!-- Locations Cards List -->
            <div class="space-y-4" id="cardsList">
                <!-- Card 1: Mall XYZ (Recommended) -->
                <div class="parking-card bg-white rounded-3xl p-4 sm:p-5 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-blue-300 transition-all cursor-pointer relative" id="card-1" data-id="1" data-lat="-6.235" data-lng="106.820" data-status="available" data-slots="327" data-price="5000" data-dist="2.4" onclick="selectLocationCard(1)">
                    <!-- Bookmark Button -->
                    <button type="button" class="bookmark-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/80 hover:bg-white border border-slate-200 text-slate-400 hover:text-blue-600 flex items-center justify-center transition-all z-10" onclick="event.stopPropagation(); toggleBookmark(this)" title="Save to bookmarks">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </button>

                    <div class="flex flex-col sm:flex-row gap-4 items-start">
                        <!-- Image with Recommended Badge -->
                        <div class="relative w-full sm:w-44 h-32 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                            <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ" class="w-full h-full object-cover" />
                            <div class="absolute top-2.5 left-2.5 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-600 text-[10px] font-bold text-white shadow-sm">
                                <span class="text-amber-300">★</span> RECOMMENDED
                            </div>
                        </div>

                        <!-- Card Info -->
                        <div class="flex-1 w-full space-y-2">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">Mall XYZ</h3>
                                <div class="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Jakarta Selatan
                                    </span>
                                    <span>•</span>
                                    <span>2.4 km</span>
                                    <span>•</span>
                                    <span class="font-bold text-amber-500 flex items-center gap-0.5">
                                        ★ 4.8 <span class="text-slate-400 font-normal">(1.2k)</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Availability & Price -->
                            <div class="flex items-center justify-between text-xs pt-1">
                                <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Available <span class="font-normal text-slate-500">327 slots available</span>
                                </div>
                            </div>
                            <div class="text-xs font-extrabold text-slate-800">
                                🚗 Rp5.000<span class="font-normal text-slate-500">/hour</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-2 pt-2">
                                <a href="/locations" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm transition-all" onclick="event.stopPropagation();">
                                    View Parking
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <button type="button" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition-all" onclick="event.stopPropagation(); navigateTo('Mall XYZ', -6.235, 106.820)">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                    Navigate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Subang Square (Limited) -->
                <div class="parking-card bg-white rounded-3xl p-4 sm:p-5 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-blue-300 transition-all cursor-pointer relative" id="card-2" data-id="2" data-lat="-6.240" data-lng="106.810" data-status="limited" data-slots="24" data-price="4000" data-dist="3.1" onclick="selectLocationCard(2)">
                    <button type="button" class="bookmark-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/80 hover:bg-white border border-slate-200 text-slate-400 hover:text-blue-600 flex items-center justify-center transition-all z-10" onclick="event.stopPropagation(); toggleBookmark(this)" title="Save to bookmarks">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </button>

                    <div class="flex flex-col sm:flex-row gap-4 items-start">
                        <div class="relative w-full sm:w-44 h-32 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                            <img src="{{ asset('images/subang-square.jpg') }}" alt="Subang Square" class="w-full h-full object-cover" />
                        </div>

                        <div class="flex-1 w-full space-y-2">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">Subang Square</h3>
                                <div class="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Subang
                                    </span>
                                    <span>•</span>
                                    <span>3.1 km</span>
                                    <span>•</span>
                                    <span class="font-bold text-amber-500 flex items-center gap-0.5">
                                        ★ 4.5 <span class="text-slate-400 font-normal">(856)</span>
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs pt-1">
                                <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Limited <span class="font-normal text-slate-500">24 slots available</span>
                                </div>
                            </div>
                            <div class="text-xs font-extrabold text-slate-800">
                                🚗 Rp4.000<span class="font-normal text-slate-500">/hour</span>
                            </div>

                            <div class="flex items-center gap-2 pt-2">
                                <a href="/locations" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-blue-600 font-semibold text-xs border border-blue-200 transition-all" onclick="event.stopPropagation();">
                                    View Parking
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <button type="button" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition-all" onclick="event.stopPropagation(); navigateTo('Subang Square', -6.240, 106.810)">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                    Navigate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Parking Building ABC (Full) -->
                <div class="parking-card bg-white rounded-3xl p-4 sm:p-5 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-blue-300 transition-all cursor-pointer relative" id="card-3" data-id="3" data-lat="-6.220" data-lng="106.830" data-status="full" data-slots="0" data-price="6000" data-dist="4.5" onclick="selectLocationCard(3)">
                    <button type="button" class="bookmark-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/80 hover:bg-white border border-slate-200 text-slate-400 hover:text-blue-600 flex items-center justify-center transition-all z-10" onclick="event.stopPropagation(); toggleBookmark(this)" title="Save to bookmarks">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </button>

                    <div class="flex flex-col sm:flex-row gap-4 items-start">
                        <div class="relative w-full sm:w-44 h-32 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                            <img src="{{ asset('images/building-abc.jpg') }}" alt="Parking Building ABC" class="w-full h-full object-cover" />
                        </div>

                        <div class="flex-1 w-full space-y-2">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">Parking Building ABC</h3>
                                <div class="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs text-slate-500 mt-1">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Bandung
                                    </span>
                                    <span>•</span>
                                    <span>4.5 km</span>
                                    <span>•</span>
                                    <span class="font-bold text-amber-500 flex items-center gap-0.5">
                                        ★ 4.2 <span class="text-slate-400 font-normal">(412)</span>
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs pt-1">
                                <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-700 bg-rose-50 px-2.5 py-1 rounded-lg">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    Full <span class="font-normal text-slate-500">0 slots available</span>
                                </div>
                            </div>
                            <div class="text-xs font-extrabold text-slate-800">
                                🚗 Rp6.000<span class="font-normal text-slate-500">/hour</span>
                            </div>

                            <div class="pt-2">
                                <a href="/locations" class="inline-flex items-center justify-center w-full px-4 py-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs border border-slate-200 transition-all" onclick="event.stopPropagation();">
                                    View Location
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: INTERACTIVE MAP WITH FLOATING POPUP -->
        <div class="w-full lg:w-[52%] xl:w-[54%] rounded-3xl overflow-hidden shadow-lg border border-slate-200 relative min-h-[580px] lg:min-h-[640px] sticky top-28 bg-slate-100">
            <!-- Leaflet Map Container -->
            <div id="interactiveMap" class="w-full h-full min-h-[580px] lg:min-h-[640px] z-10"></div>

            <!-- Map Controls (Zoom In/Out, Target) -->
            <div class="absolute bottom-6 right-6 flex flex-col gap-2 z-20">
                <div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden flex flex-col">
                    <button type="button" id="zoomInBtn" class="w-10 h-10 flex items-center justify-center text-slate-700 hover:bg-slate-50 border-b border-slate-100 transition-colors" title="Zoom In">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </button>
                    <button type="button" id="zoomOutBtn" class="w-10 h-10 flex items-center justify-center text-slate-700 hover:bg-slate-50 transition-colors" title="Zoom Out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </button>
                </div>
                <button type="button" id="recenterBtn" class="w-10 h-10 rounded-2xl bg-white shadow-md border border-slate-200 flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors" title="Recenter Map">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                </button>
            </div>

            <!-- FLOATING POPUP CARD OVER THE MAP (As shown in screenshot) -->
            <div id="mapFloatingCard" class="absolute bottom-6 left-6 right-16 sm:right-20 md:right-28 lg:left-6 lg:right-20 bg-white rounded-3xl p-4 sm:p-5 border border-slate-200 shadow-2xl z-30 transition-all duration-300">
                <!-- Close Button -->
                <button type="button" id="closeFloatingCardBtn" class="absolute top-3.5 right-3.5 w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center text-sm transition-colors" title="Close">
                    ✕
                </button>

                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <!-- Thumbnail -->
                    <div class="w-full sm:w-32 h-24 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                        <img id="popupImage" src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ" class="w-full h-full object-cover" />
                    </div>

                    <!-- Details & Price -->
                    <div class="flex-1 w-full space-y-1.5">
                        <div class="flex items-start justify-between gap-2 pr-6">
                            <div>
                                <h4 id="popupTitle" class="text-base font-bold text-slate-900 leading-snug">Mall XYZ</h4>
                                <p id="popupSubtitle" class="text-xs text-slate-500 mt-0.5">📍 Jakarta Selatan • 2.4 km • ★ 4.8 (1.2k)</p>
                            </div>
                            <div class="text-right shrink-0">
                                <div id="popupPrice" class="text-base font-extrabold text-slate-900">Rp5.000</div>
                                <span class="text-[10px] text-slate-400">/hour</span>
                            </div>
                        </div>

                        <!-- Availability Badge -->
                        <div class="pt-0.5">
                            <span id="popupBadge" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-lg">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span id="popupBadgeText">Available 327 slots</span>
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 pt-2">
                            <a id="popupViewBtn" href="/locations" class="flex-1 text-center py-2 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm transition-all">
                                View Parking →
                            </a>
                            <button type="button" id="popupNavBtn" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition-all">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                                Navigate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ADVANCED FILTER SLIDE-OVER DRAWER -->
<div id="filterOverlay" class="hidden fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-50 transition-opacity"></div>
<div id="filterDrawer" class="fixed top-0 right-0 bottom-0 w-full max-w-md bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-900">Filters</h3>
        <button type="button" id="closeDrawerBtn" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center text-sm">✕</button>
    </div>
    <div class="p-6 space-y-6 flex-1 overflow-y-auto">
        <!-- Availability -->
        <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Availability</h4>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200" data-filter="available">Available Now</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200" data-filter="limited">Limited</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200" data-filter="full">Full</button>
            </div>
        </div>
        <!-- Vehicle Type -->
        <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Vehicle Type</h4>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200">Car</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">Motorcycle</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">EV Charging</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">VIP</button>
            </div>
        </div>
        <!-- Distance -->
        <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Max Distance</h4>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">&lt; 1 km</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200">1 – 3 km</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">3 – 5 km</button>
                <button type="button" class="drawer-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">5+ km</button>
            </div>
        </div>
    </div>
    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between gap-3">
        <button type="button" id="clearFiltersBtn" class="text-xs font-semibold text-slate-600 hover:text-slate-900">Clear All</button>
        <button type="button" id="applyFiltersBtn" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs shadow-sm">Apply Filters</button>
    </div>
</div>

<!-- LEAFLET & INTERACTIVE SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Location Data Store
        const locations = [
            {
                id: 1,
                name: 'Mall XYZ',
                area: 'Jakarta Selatan',
                dist: '2.4 km',
                rating: '4.8 (1.2k)',
                status: 'available',
                slots: 327,
                price: 'Rp5.000',
                image: "{{ asset('images/mall-xyz.jpg') }}",
                lat: -6.235,
                lng: 106.820
            },
            {
                id: 2,
                name: 'Subang Square',
                area: 'Subang',
                dist: '3.1 km',
                rating: '4.5 (856)',
                status: 'limited',
                slots: 24,
                price: 'Rp4.000',
                image: "{{ asset('images/subang-square.jpg') }}",
                lat: -6.240,
                lng: 106.810
            },
            {
                id: 3,
                name: 'Parking Building ABC',
                area: 'Bandung',
                dist: '4.5 km',
                rating: '4.2 (412)',
                status: 'full',
                slots: 0,
                price: 'Rp6.000',
                image: "{{ asset('images/building-abc.jpg') }}",
                lat: -6.220,
                lng: 106.830
            },
            // Additional surround locations on map
            {
                id: 4,
                name: 'Kebayoran Park Point',
                area: 'Kebayoran Baru',
                dist: '1.8 km',
                rating: '4.6 (320)',
                status: 'available',
                slots: 150,
                price: 'Rp4.000',
                image: "{{ asset('images/hero-parking.jpg') }}",
                lat: -6.228,
                lng: 106.802
            },
            {
                id: 5,
                name: 'Cilandak Center Parking',
                area: 'Cilandak',
                dist: '3.8 km',
                rating: '4.7 (540)',
                status: 'available',
                slots: 85,
                price: 'Rp5.000',
                image: "{{ asset('images/parking-header.jpg') }}",
                lat: -6.255,
                lng: 106.815
            },
            {
                id: 6,
                name: 'Pancoran Hub Park',
                area: 'Pancoran',
                dist: '4.1 km',
                rating: '4.3 (210)',
                status: 'available',
                slots: 112,
                price: 'Rp3.500',
                image: "{{ asset('images/building-abc.jpg') }}",
                lat: -6.242,
                lng: 106.845
            }
        ];

        // Initialize Map
        const map = L.map('interactiveMap', {
            zoomControl: false,
            center: [-6.235, 106.820],
            zoom: 14
        });

        // CartoDB Positron Tiles (High aesthetics modern pastel map)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
            maxZoom: 19,
            subdomains: 'abcd'
        }).addTo(map);

        // Custom Marker Pin Generator
        function createCustomPin(item, isActive = false) {
            const size = isActive ? 44 : 36;
            const activePulse = isActive 
                ? '<div class="absolute -inset-2 rounded-full bg-blue-500/25 animate-ping"></div><div class="absolute -inset-1 rounded-full bg-blue-500/30"></div>' 
                : '';
            
            const activeTooltip = isActive 
                ? `<div class="absolute -top-9 left-1/2 -translate-x-1/2 bg-white px-2.5 py-1 rounded-lg border border-slate-200 shadow-md text-[10px] font-bold text-slate-900 whitespace-nowrap flex items-center gap-1.5 z-50">
                    <span>${item.name}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span class="text-emerald-600">${item.slots} slots</span>
                   </div>`
                : '';

            const html = `
                <div class="relative flex items-center justify-center cursor-pointer group" style="width:${size}px; height:${size}px;">
                    ${activePulse}
                    ${activeTooltip}
                    <div class="w-full h-full rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow-lg border-2 border-white transition-transform group-hover:scale-110">
                        P
                    </div>
                </div>
            `;

            return L.divIcon({
                html: html,
                className: 'custom-pin-icon',
                iconSize: [size, size],
                iconAnchor: [size / 2, size / 2]
            });
        }

        // Add markers
        const markers = {};
        locations.forEach(loc => {
            const isInitialActive = loc.id === 1;
            const marker = L.marker([loc.lat, loc.lng], {
                icon: createCustomPin(loc, isInitialActive)
            }).addTo(map);

            marker.on('click', () => {
                selectLocation(loc.id);
            });

            markers[loc.id] = marker;
        });

        // Floating Popup Card Elements
        const popupCard = document.getElementById('mapFloatingCard');
        const popupImage = document.getElementById('popupImage');
        const popupTitle = document.getElementById('popupTitle');
        const popupSubtitle = document.getElementById('popupSubtitle');
        const popupPrice = document.getElementById('popupPrice');
        const popupBadge = document.getElementById('popupBadge');
        const popupBadgeText = document.getElementById('popupBadgeText');
        const closePopupBtn = document.getElementById('closeFloatingCardBtn');

        function updateFloatingCard(loc) {
            if (!popupCard) return;
            popupCard.classList.remove('hidden');
            popupImage.src = loc.image;
            popupTitle.textContent = loc.name;
            popupSubtitle.textContent = `📍 ${loc.area} • ${loc.dist} • ★ ${loc.rating}`;
            popupPrice.textContent = loc.price;

            if (loc.status === 'available') {
                popupBadge.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-lg';
                popupBadgeText.textContent = `Available ${loc.slots} slots`;
            } else if (loc.status === 'limited') {
                popupBadge.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-lg';
                popupBadgeText.textContent = `Limited ${loc.slots} slots`;
            } else {
                popupBadge.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-rose-700 bg-rose-50 px-2.5 py-0.5 rounded-lg';
                popupBadgeText.textContent = `Full 0 slots`;
            }
        }

        if (closePopupBtn) {
            closePopupBtn.addEventListener('click', () => {
                popupCard.classList.add('hidden');
            });
        }

        // Global Select Function
        window.selectLocationCard = function(id) {
            selectLocation(id);
        };

        function selectLocation(id) {
            const loc = locations.find(l => l.id === id);
            if (!loc) return;

            // Pan map
            map.flyTo([loc.lat, loc.lng], 15, { duration: 1 });

            // Update marker pins
            locations.forEach(l => {
                if (markers[l.id]) {
                    markers[l.id].setIcon(createCustomPin(l, l.id === id));
                }
            });

            // Update floating popup card
            updateFloatingCard(loc);

            // Highlight card in list
            document.querySelectorAll('.parking-card').forEach(card => {
                card.classList.remove('border-blue-500', 'ring-2', 'ring-blue-500/20', 'bg-blue-50/20');
            });
            const activeCard = document.getElementById(`card-${id}`);
            if (activeCard) {
                activeCard.classList.add('border-blue-500', 'ring-2', 'ring-blue-500/20', 'bg-blue-50/20');
                activeCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        // Zoom Controls
        document.getElementById('zoomInBtn').addEventListener('click', () => map.zoomIn());
        document.getElementById('zoomOutBtn').addEventListener('click', () => map.zoomOut());
        document.getElementById('recenterBtn').addEventListener('click', () => {
            map.flyTo([-6.235, 106.820], 14);
            selectLocation(1);
        });

        // Search Input Filter
        const searchInput = document.getElementById('searchInput');
        const acDropdown = document.getElementById('autocompleteDropdown');
        if (searchInput) {
            searchInput.addEventListener('focus', () => acDropdown.classList.remove('hidden'));
            searchInput.addEventListener('input', (e) => {
                const val = e.target.value.toLowerCase();
                document.querySelectorAll('.parking-card').forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    card.style.display = title.includes(val) ? 'block' : 'none';
                });
            });
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !acDropdown.contains(e.target)) {
                    acDropdown.classList.add('hidden');
                }
            });
        }

        window.selectLocation = function(name) {
            if (searchInput) searchInput.value = name;
            acDropdown.classList.add('hidden');
            const target = locations.find(l => l.name.toLowerCase().includes(name.toLowerCase()));
            if (target) selectLocation(target.id);
        };

        // Filter Chips Click
        const chips = document.querySelectorAll('.filter-chip');
        chips.forEach(chip => {
            chip.addEventListener('click', () => {
                const isActive = chip.classList.contains('active');
                if (isActive) {
                    chip.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-sm', 'shadow-blue-500/20');
                    chip.classList.add('bg-slate-100', 'text-slate-700');
                } else {
                    chip.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-sm', 'shadow-blue-500/20');
                    chip.classList.remove('bg-slate-100', 'text-slate-700');
                }
                applyQuickFilter(chip.dataset.filter, !isActive);
            });
        });

        function applyQuickFilter(type, active) {
            const cards = document.querySelectorAll('.parking-card');
            cards.forEach(card => {
                const status = card.dataset.status;
                if (type === 'available' && active) {
                    card.style.display = (status === 'full') ? 'none' : 'block';
                } else {
                    card.style.display = 'block';
                }
            });
        }

        // Sort Control
        const sortSelect = document.getElementById('sortSelect');
        const cardsList = document.getElementById('cardsList');
        if (sortSelect && cardsList) {
            sortSelect.addEventListener('change', () => {
                const val = sortSelect.value;
                const cardsArray = Array.from(cardsList.querySelectorAll('.parking-card'));
                cardsArray.sort((a, b) => {
                    if (val === 'price') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    if (val === 'nearest') return parseFloat(a.dataset.dist) - parseFloat(b.dataset.dist);
                    if (val === 'available') return parseFloat(b.dataset.slots) - parseFloat(a.dataset.slots);
                    return 0;
                });
                cardsArray.forEach(c => cardsList.appendChild(c));
            });
        }

        // Use My Location
        const locBtn = document.getElementById('locationBtn');
        const locText = document.getElementById('locationText');
        if (locBtn && locText) {
            locBtn.addEventListener('click', () => {
                locText.textContent = 'Jakarta Selatan detected';
                locBtn.classList.add('bg-emerald-50', 'text-emerald-600', 'border-emerald-200');
                locBtn.classList.remove('bg-blue-50/80', 'text-blue-600', 'border-blue-100/90');
                map.flyTo([-6.235, 106.820], 15);
            });
        }

        // Drawer
        const drawer = document.getElementById('filterDrawer');
        const overlay = document.getElementById('filterOverlay');
        const openBtn = document.getElementById('openFiltersBtn');
        const closeBtn = document.getElementById('closeDrawerBtn');
        const applyBtn = document.getElementById('applyFiltersBtn');

        function openDrawer() {
            drawer.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
        }
        function closeDrawer() {
            drawer.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        }
        if (openBtn) openBtn.addEventListener('click', openDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);
        if (applyBtn) applyBtn.addEventListener('click', closeDrawer);

        // Bookmarks Toggle
        window.toggleBookmark = function(btn) {
            const svg = btn.querySelector('svg');
            const isSaved = btn.classList.contains('text-blue-600');
            if (isSaved) {
                btn.classList.remove('text-blue-600');
                btn.classList.add('text-slate-400');
                svg.setAttribute('fill', 'none');
            } else {
                btn.classList.add('text-blue-600');
                btn.classList.remove('text-slate-400');
                svg.setAttribute('fill', 'currentColor');
            }
        };

        // Navigate Action
        window.navigateTo = function(name, lat, lng) {
            window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, '_blank');
        };
    });
</script>