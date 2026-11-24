<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - Simple, Transparent Parking Pricing | NusaPark</title>
    <meta name="description" content="Know what to expect before you park. Simple and transparent parking rates across Indonesia with NusaPark.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50/60 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <x-navbar active="pricing" />

    <!-- SVG ClipPath Definition for the Organic S-Curve -->
    <svg width="0" height="0" class="absolute pointer-events-none">
        <defs>
            <clipPath id="pricing-organic-curve" clipPathUnits="objectBoundingBox">
                <path d="M 0.20,0 
                         C 0.08,0.14 0,0.28 0,0.44 
                         C 0,0.62 0.06,0.76 0.22,0.88 
                         C 0.38,0.97 0.65,1 1,1 
                         L 1,0 Z" />
            </clipPath>
        </defs>
    </svg>

    <main class="flex-grow">
        <!-- HERO SECTION -->
        <section class="relative overflow-hidden pt-4 pb-16 lg:pt-10 lg:pb-24 bg-white border-b border-slate-100">
            <!-- Desktop Right Curved Graphic (Absolute spanning to right edge) -->
            <div class="hidden lg:block absolute top-0 right-0 bottom-6 w-[52%] xl:w-[50%] z-0 pointer-events-none">
                <div class="relative w-full h-full overflow-hidden shadow-2xl bg-slate-900" style="clip-path: url(#pricing-organic-curve);">
                    <!-- Parking Garage Photo -->
                    <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Underground Smart Parking" class="w-full h-full object-cover object-center scale-105 hover:scale-100 transition-transform duration-1000" />
                    <!-- Ambient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-900/20 to-slate-950/30"></div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 xl:col-span-6 pt-4 lg:pt-6">
                        <!-- Pill Badge -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 text-white text-xs font-semibold shadow-sm mb-6">
                            <svg class="w-3.5 h-3.5 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"></path>
                                <path d="M7 7h.01"></path>
                            </svg>
                            <span>Pricing</span>
                        </div>

                        <!-- Headline -->
                        <h1 class="text-4xl sm:text-5xl xl:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.12] mb-6">
                            Simple, Transparent <br>
                            <span class="text-blue-600">Parking Pricing.</span>
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-slate-600 text-base sm:text-lg max-w-xl mb-8 leading-relaxed font-normal">
                            Know what to expect before you park. Parking rates can vary by location, vehicle type, parking area, and applicable conditions.
                        </p>

                        <!-- CTA Actions -->
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="/search" class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all">
                                <span>Find Parking</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <a href="#how-it-works" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm border border-slate-200 shadow-sm transition-all">
                                <span class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mr-0.5">
                                    <svg class="w-3 h-3 fill-current ml-0.5" viewBox="0 0 24 24">
                                        <polygon points="5 3 19 12 5 21 5 3"/>
                                    </svg>
                                </span>
                                <span>How It Works</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Floating Receipt Card -->
                    <div class="lg:col-span-5 xl:col-span-6 flex justify-center lg:justify-end">
                        <div class="w-full max-w-sm sm:max-w-md bg-white/95 backdrop-blur-md rounded-2xl p-6 sm:p-7 shadow-2xl border border-slate-100/80 transition-transform duration-300 hover:-translate-y-1">
                            <!-- Card Header -->
                            <div class="flex items-start justify-between pb-4 border-b border-slate-100">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-xl font-bold text-slate-900">Mall XYZ</h3>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700">ACTIVE</span>
                                    </div>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5">Jakarta Selatan • Main Terminal</p>
                                </div>
                                <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                        <polyline points="9 22 9 12 15 12 15 22"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Receipt Itemized List -->
                            <div class="py-4 space-y-3.5 text-sm">
                                <div class="flex justify-between items-center text-slate-600">
                                    <span class="flex items-center gap-2 text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                        Vehicle
                                    </span>
                                    <span class="font-semibold text-slate-900">Car (Regular)</span>
                                </div>
                                <div class="flex justify-between items-center text-slate-600">
                                    <span class="flex items-center gap-2 text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        First hour
                                    </span>
                                    <span class="font-semibold text-slate-900">Rp 5.000</span>
                                </div>
                                <div class="flex justify-between items-center text-slate-600">
                                    <span class="flex items-center gap-2 text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                        Duration
                                    </span>
                                    <span class="font-semibold text-slate-900">3 hours</span>
                                </div>
                                <div class="flex justify-between items-center text-slate-600">
                                    <span class="flex items-center gap-2 text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                        Payment
                                    </span>
                                    <span class="inline-flex items-center gap-1 font-semibold text-blue-600">
                                        <span>QRIS</span>
                                        <svg class="w-3.5 h-3.5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Total Callout Box -->
                            <div class="mt-2 p-3.5 rounded-xl bg-blue-50/90 border border-blue-100 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-bold tracking-wider uppercase text-blue-700">Est. Total</span>
                                    <p class="text-xs text-blue-600/80">Includes partner parking tax</p>
                                </div>
                                <div class="text-2xl font-black text-blue-600 tracking-tight">
                                    Rp 13.000
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 3 TRUST FEATURES BAR -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-8 relative z-20">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                    
                    <!-- Feature 1 -->
                    <div class="flex items-start gap-4 pt-4 md:pt-0">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                <polyline points="2 17 12 22 22 17"/>
                                <polyline points="2 12 12 17 22 12"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 mb-1">Transparent Rates</h4>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Clear and upfront pricing at every location before you arrive.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start gap-4 pt-4 md:pt-0 md:pl-8">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 mb-1">Secure Payment</h4>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Pay safely with QRIS, e-wallets, or cards with zero hidden surcharges.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start gap-4 pt-4 md:pt-0 md:pl-8">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 mb-1">Real-Time Info</h4>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">Check live rates and slot availability in real time across Indonesia.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- BANNER ALERT: PARKING RATES DEPEND ON THE LOCATION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white shadow-2xl p-7 sm:p-10 lg:p-12">
                <!-- Garage Background on Right -->
                <div class="absolute top-0 right-0 bottom-0 w-full sm:w-1/2 opacity-25 sm:opacity-40 mix-blend-luminosity pointer-events-none">
                    <img src="{{ asset('images/hero-parking.jpg') }}" alt="Parking Location Rates" class="w-full h-full object-cover object-center" />
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 sm:gap-8">
                    <div class="max-w-2xl">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-semibold mb-3">Notice</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-3">
                            Parking rates depend on the location.
                        </h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Because NusaPark connects various properties, the exact price differs based on location rules, vehicle category, and duration.
                        </p>
                    </div>
                    <div class="shrink-0">
                        <a href="#pricing-explorer" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 text-slate-950 font-semibold text-sm shadow-lg transition-all">
                            <span>Check Location Pricing</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- LOCATION RATE EXPLORER (INTERACTIVE) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20" id="pricing-explorer">
            
            <!-- Vehicle Selector Tabs on Top -->
            <div class="flex items-center justify-center gap-2 sm:gap-3 mb-8">
                <button type="button" onclick="setVehicleTab('car', this)" id="tab-veh-car" class="veh-tab active inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all bg-blue-600 text-white shadow-md shadow-blue-500/25">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                    <span>Car</span>
                </button>
                <button type="button" onclick="setVehicleTab('moto', this)" id="tab-veh-moto" class="veh-tab inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 shadow-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg>
                    <span>Motorcycle</span>
                </button>
                <button type="button" onclick="setVehicleTab('ev', this)" id="tab-veh-ev" class="veh-tab inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 shadow-sm">
                    <svg class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    <span>EV Charging</span>
                </button>
            </div>

            <!-- Two-Column Interactive Rate Explorer Container -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Check a Location -->
                <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-7">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <h3 class="text-lg font-bold text-slate-900">Check a Location</h3>
                    </div>

                    <!-- Search Input -->
                    <div class="relative mb-5">
                        <input type="text" id="locSearchInput" onkeyup="filterLocations(this.value)" placeholder="Search location..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all" />
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>

                    <!-- Location List Items -->
                    <div class="space-y-2.5" id="locationList">
                        <!-- Location 1 -->
                        <button type="button" onclick="selectLocation('mall', this)" class="loc-item active w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-blue-500 bg-blue-50/70 text-blue-900">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900 loc-name">NusaPark Central</div>
                                    <div class="text-xs text-slate-500 loc-city">Jakarta Selatan</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-blue-600 loc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>

                        <!-- Location 2 -->
                        <button type="button" onclick="selectLocation('subang', this)" class="loc-item w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-slate-200 hover:border-slate-300 hover:bg-slate-50 bg-white text-slate-800">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900 loc-name">NusaPark Subang Square</div>
                                    <div class="text-xs text-slate-500 loc-city">Subang</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 loc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>

                        <!-- Location 3 -->
                        <button type="button" onclick="selectLocation('bandung', this)" class="loc-item w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-slate-200 hover:border-slate-300 hover:bg-slate-50 bg-white text-slate-800">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900 loc-name">NusaPark Bandung City Center</div>
                                    <div class="text-xs text-slate-500 loc-city">Bandung</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 loc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>

                        <!-- Location 4 -->
                        <button type="button" onclick="selectLocation('surabaya', this)" class="loc-item w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-slate-200 hover:border-slate-300 hover:bg-slate-50 bg-white text-slate-800">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900 loc-name">NusaPark Surabaya Central</div>
                                    <div class="text-xs text-slate-500 loc-city">Surabaya</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 loc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Right: Rate Breakdown Card -->
                <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
                    <!-- Amber Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-amber-50 border border-amber-200 text-amber-800 text-[11px] font-bold tracking-wider uppercase mb-5">
                        <svg class="w-3.5 h-3.5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Sample Tariff — Actual rates depend on the location</span>
                    </div>

                    <div class="mb-6">
                        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Estimated Base Rate</div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight" id="rateBaseHero">Rp 5.000</span>
                            <span class="text-base sm:text-lg text-slate-500 font-medium">/ first hour</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-2" id="rateSubText">Next hour: +Rp 4.000/hr • Daily Max: Rp 40.000</p>
                    </div>

                    <!-- Breakdown Table -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden shadow-sm">
                        <div class="bg-slate-50 px-5 py-3 border-b border-slate-200 flex justify-between text-xs font-bold uppercase tracking-wider text-slate-500">
                            <span>Duration</span>
                            <span>Rate</span>
                        </div>
                        <div class="divide-y divide-slate-100 text-sm" id="rateTableBody">
                            <div class="px-5 py-3.5 flex justify-between items-center bg-blue-50/50">
                                <span class="font-semibold text-slate-800 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    First hour
                                </span>
                                <span class="font-bold text-blue-700" id="rowFirst">Rp 5.000</span>
                            </div>
                            <div class="px-5 py-3.5 flex justify-between items-center">
                                <span class="text-slate-600">Second hour</span>
                                <span class="font-semibold text-slate-900" id="rowSecond">+ Rp 4.000</span>
                            </div>
                            <div class="px-5 py-3.5 flex justify-between items-center">
                                <span class="text-slate-600">Subsequent hours</span>
                                <span class="font-semibold text-slate-900" id="rowSubsequent">+ Rp 4.000 / hr</span>
                            </div>
                            <div class="px-5 py-3.5 flex justify-between items-center bg-slate-50/40">
                                <span class="text-slate-600 font-medium">Daily maximum</span>
                                <span class="font-bold text-slate-900" id="rowMax">Rp 40.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            Grace period: 10 mins free
                        </span>
                        <span>Auto calculated at barrier gate</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- VEHICLE CATEGORY PRICING CARDS -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    Different vehicles, different parking needs.
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    NusaPark systems automatically adapt to standard vehicle categories configured by our location partners.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- Card 1: Car -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <!-- Header & Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">Standard</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 mb-1">Car</h3>
                        <div class="text-2xl font-black text-blue-600 mb-4">Rp 5.000 <span class="text-xs text-slate-400 font-normal">/ hour</span></div>

                        <!-- Vehicle Graphic / Cutout -->
                        <div class="h-28 rounded-xl bg-gradient-to-b from-slate-50 to-slate-100/60 p-2 flex items-center justify-center mb-6 overflow-hidden">
                            <img src="{{ asset('images/veh-car.png') }}" alt="Car Parking" class="h-20 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500 drop-shadow-md" />
                        </div>

                        <!-- Checkpoints -->
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Standard parking slot</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>ANPR recognition supported</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Barrier access & ticketless</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 2: Motorcycle -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <!-- Header & Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">High Volume</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 mb-1">Motorcycle</h3>
                        <div class="text-2xl font-black text-blue-600 mb-4">Rp 2.000 <span class="text-xs text-slate-400 font-normal">/ hour</span></div>

                        <!-- Vehicle Graphic / Cutout -->
                        <div class="h-28 rounded-xl bg-gradient-to-b from-slate-50 to-slate-100/60 p-2 flex items-center justify-center mb-6 overflow-hidden">
                            <img src="{{ asset('images/veh-moto.png') }}" alt="Motorcycle Parking" class="h-20 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500 drop-shadow-md" />
                        </div>

                        <!-- Checkpoints -->
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Dedicated motorcycle area</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>QR or RFID tap access</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>High capacity sheltered zones</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 3: EV Parking -->
                <div class="bg-white rounded-2xl border-2 border-blue-500 shadow-lg shadow-blue-500/10 hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group relative">
                    <div class="absolute -top-3 right-6 bg-blue-600 text-white text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                        Eco Powered
                    </div>

                    <div>
                        <!-- Header & Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-blue-50 text-blue-700">Includes Power</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 mb-1">EV Parking</h3>
                        <div class="text-2xl font-black text-blue-600 mb-4">Rp 10.000 <span class="text-xs text-slate-400 font-normal">/ hour</span></div>

                        <!-- Vehicle Graphic / Cutout -->
                        <div class="h-28 rounded-xl bg-gradient-to-b from-blue-50/50 to-blue-100/40 p-2 flex items-center justify-center mb-6 overflow-hidden">
                            <img src="{{ asset('images/veh-ev.png') }}" alt="EV Charging Station" class="h-20 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500 drop-shadow-md" />
                        </div>

                        <!-- Checkpoints -->
                        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>EV charging included</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Dedicated charging slot</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>May require in-app reservation</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- ESTIMATE YOUR PARKING COST (INTERACTIVE ESTIMATOR) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28">
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/40 p-6 sm:p-10 lg:p-12">
                
                <div class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Estimate your parking cost.
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base">
                        Calculate your expected parking fee before you arrive.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- Left: Form Controls -->
                    <div class="lg:col-span-7 space-y-5">
                        <!-- Location Dropdown -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Location (Mock)</label>
                            <div class="relative">
                                <select id="estLocation" onchange="runEstimateCalculation()" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 pr-10 text-sm text-slate-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                                    <option value="mall" selected>Mall XYZ (Jakarta Selatan)</option>
                                    <option value="subang">Subang Square (Subang)</option>
                                    <option value="bandung">Building ABC / Bandung Center</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Type Dropdown -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Vehicle Type</label>
                            <div class="relative">
                                <select id="estVehicle" onchange="runEstimateCalculation()" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 pr-10 text-sm text-slate-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                                    <option value="car" selected>Car</option>
                                    <option value="moto">Motorcycle</option>
                                    <option value="ev">EV Parking</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Duration Dropdown -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Duration</label>
                            <div class="relative">
                                <select id="estDuration" onchange="runEstimateCalculation()" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 pr-10 text-sm text-slate-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                                    <option value="1">1 Hour</option>
                                    <option value="2">2 Hours</option>
                                    <option value="3" selected>3 Hours</option>
                                    <option value="4">4 Hours</option>
                                    <option value="6">6 Hours</option>
                                    <option value="8">8 Hours</option>
                                    <option value="12">12 Hours (Half Day)</option>
                                    <option value="24">24 Hours (Full Day)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs text-slate-500 leading-relaxed pt-2">
                            * This is an estimate. Final charges follow the exact tariff and duration recorded by the smart barrier gate at the selected parking location.
                        </p>
                    </div>

                    <!-- Right: Estimated Total Panel -->
                    <div class="lg:col-span-5">
                        <div class="bg-gradient-to-br from-slate-50 to-blue-50/40 rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-sm">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Estimated Total</span>
                            
                            <div class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mt-2 mb-6" id="calcTotal">
                                Rp 13.000
                            </div>

                            <!-- Breakdown Lines -->
                            <div class="space-y-3 py-4 border-t border-slate-200 text-sm">
                                <div class="flex justify-between items-center text-slate-600">
                                    <span>First hour</span>
                                    <span class="font-semibold text-slate-900" id="calcBase">Rp 5.000</span>
                                </div>
                                <div class="flex justify-between items-center text-slate-600">
                                    <span id="calcNextLabel">Next 2 hours (2 × Rp 4.000)</span>
                                    <span class="font-semibold text-slate-900" id="calcNext">Rp 8.000</span>
                                </div>
                            </div>

                            <!-- Total Payment Box -->
                            <div class="mt-4 p-4 rounded-xl bg-blue-600 text-white flex justify-between items-center shadow-md shadow-blue-500/20">
                                <span class="font-bold text-sm tracking-wide">Total Payment</span>
                                <span class="text-xl font-black tracking-tight" id="calcFinal">Rp 13.000</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- HOW YOUR PARKING FEE IS CALCULATED -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28" id="how-it-works">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    How your parking fee is calculated.
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    A simple and automated flow from your entry to your exit.
                </p>
            </div>

            <!-- 4 Connected Steps -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 relative">
                
                <!-- Step 1 -->
                <div class="relative bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                    </div>
                    <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">01</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Enter</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Drive in, your vehicle is recognized via ANPR or parking card.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">02</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Record</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        The system records your entry time securely in cloud storage.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="18"/><path d="M16 10h.01"/><path d="M12 10h.01"/><path d="M8 10h.01"/><path d="M12 14h.01"/><path d="M8 14h.01"/><path d="M12 18h.01"/><path d="M8 18h.01"/></svg>
                    </div>
                    <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">03</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Calculate</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        The tariff is calculated based on location rules and duration.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="relative bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    </div>
                    <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">04</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Pay</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Settle the payment via QRIS, e-wallet, or card before exit.
                    </p>
                </div>

            </div>

            <!-- PAY YOUR WAY BAR -->
            <div class="mt-16 bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Pay your way.</h3>
                        <p class="text-xs sm:text-sm text-slate-500">Universal support for all popular Indonesian payment methods.</p>
                    </div>
                    <div class="grid grid-cols-2 sm:flex sm:flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12V7H5a2 2 0 0 1 2-2h14v4z"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                            <span>E-Wallet</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700">
                            <svg class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="3"/><rect x="14" y="7" width="3" height="3"/><rect x="7" y="14" width="3" height="3"/><rect x="14" y="14" width="3" height="3"/></svg>
                            <span>QRIS</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700">
                            <svg class="w-4 h-4 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            <span>Bank Card</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700">
                            <svg class="w-4 h-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                            <span>Auto App Pay</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FREQUENTLY ASKED QUESTIONS -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28 mb-16" id="faq">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left: Title, subtext & illustration -->
                <div class="lg:col-span-5">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-3">FAQs</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                        Frequently <br>
                        <span class="text-blue-600">Asked Questions</span>
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                        Everything you need to know about parking rates and pricing at NusaPark.
                    </p>

                    <!-- Illustration Container -->
                    <div class="w-full max-w-xs bg-gradient-to-br from-blue-50 to-indigo-50/50 rounded-2xl p-6 border border-blue-100/80 flex flex-col items-center justify-center text-center shadow-sm">
                        <img src="{{ asset('images/faq-car.png') }}" alt="NusaPark FAQ" class="h-20 w-auto object-contain drop-shadow-sm mb-3" />
                        <span class="text-xs font-semibold text-slate-700">Transparent & Verified Pricing</span>
                        <span class="text-[11px] text-slate-500">Updated daily with location partners</span>
                    </div>
                </div>

                <!-- Right: Accordion Items -->
                <div class="lg:col-span-7 space-y-3.5">
                    
                    <!-- FAQ 1 (Open by default) -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleFaqAccordion(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">Are parking rates the same at every NusaPark location?</span>
                            <span class="faq-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300 rotate-180">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-content px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed block border-t border-slate-100 pt-3">
                            No. Parking rates are determined by the property management or local regulations of each specific location. Always check the pricing for your destination before parking.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleFaqAccordion(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">How is my parking fee calculated?</span>
                            <span class="faq-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-content px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            Fees are typically calculated based on a base rate for the first hour, plus an incremental rate for each subsequent hour. Some locations also apply daily maximums or special overnight flat rates.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleFaqAccordion(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">Why does the estimated price differ from the final charge?</span>
                            <span class="faq-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-content px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            Estimates are based on the duration you input into the calculator. Real-world conditions such as queueing to exit or crossing an hour threshold by 1 minute can alter the final recorded timestamp.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleFaqAccordion(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">Is there a grace period if I only drop off someone?</span>
                            <span class="faq-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-content px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            Yes! Almost all of our locations feature a 10 to 15 minute grace period where exiting within this window incurs zero parking charges.
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- BOTTOM CTA BANNER -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white shadow-2xl p-8 sm:p-12 lg:p-16 text-center">
                <!-- Garage / Building Background -->
                <div class="absolute inset-0 opacity-25 mix-blend-luminosity pointer-events-none">
                    <img src="{{ asset('images/parking-header.jpg') }}" alt="Find Parking" class="w-full h-full object-cover object-center" />
                    <div class="absolute inset-0 bg-slate-950/70"></div>
                </div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4">
                        Find a parking location and check its price.
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8">
                        Choose your destination and see parking availability, location details, and applicable rates immediately.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="/search" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-lg shadow-blue-500/25 transition-all">
                            <span>Find Parking</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="/locations" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm backdrop-blur-sm border border-white/20 transition-all">
                            <span>Explore Locations</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <x-footer />

    <!-- INTERACTIVE PRICING SCRIPTS -->
    <script>
        // Location Tariffs Mock Data
        const pricingDatabase = {
            'mall': {
                name: 'NusaPark Central (Mall XYZ)',
                city: 'Jakarta Selatan',
                car: { base: 5000, next: 4000, max: 40000 },
                moto: { base: 2000, next: 2000, max: 20000 },
                ev: { base: 10000, next: 10000, max: 80000 }
            },
            'subang': {
                name: 'NusaPark Subang Square',
                city: 'Subang',
                car: { base: 4000, next: 3000, max: 30000 },
                moto: { base: 1500, next: 1500, max: 15000 },
                ev: { base: 8000, next: 8000, max: 60000 }
            },
            'bandung': {
                name: 'NusaPark Bandung City Center',
                city: 'Bandung',
                car: { base: 6000, next: 5000, max: 50000 },
                moto: { base: 2500, next: 2000, max: 25000 },
                ev: { base: 12000, next: 10000, max: 90000 }
            },
            'surabaya': {
                name: 'NusaPark Surabaya Central',
                city: 'Surabaya',
                car: { base: 5000, next: 4000, max: 40000 },
                moto: { base: 2000, next: 2000, max: 20000 },
                ev: { base: 10000, next: 9000, max: 75000 }
            }
        };

        let currentActiveLocation = 'mall';
        let currentActiveVehicle = 'car';

        function formatRp(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        // Vehicle Tab switcher
        function setVehicleTab(veh, btn) {
            currentActiveVehicle = veh;
            
            // Update buttons styling
            document.querySelectorAll('.veh-tab').forEach(b => {
                b.className = 'veh-tab inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 shadow-sm';
            });
            btn.className = 'veh-tab active inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all bg-blue-600 text-white shadow-md shadow-blue-500/25';
            
            updateExplorerBreakdown();
        }

        // Location selection
        function selectLocation(locKey, btn) {
            currentActiveLocation = locKey;

            // Reset all location items
            document.querySelectorAll('.loc-item').forEach(el => {
                el.className = 'loc-item w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-slate-200 hover:border-slate-300 hover:bg-slate-50 bg-white text-slate-800';
                const iconBox = el.querySelector('div > div:first-child');
                if (iconBox) iconBox.className = 'w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0';
                const chevron = el.querySelector('.loc-chevron');
                if (chevron) chevron.className = 'w-4 h-4 text-slate-400 loc-chevron';
            });

            // Set active item
            btn.className = 'loc-item active w-full flex items-center justify-between p-3.5 rounded-xl text-left transition-all border border-blue-500 bg-blue-50/70 text-blue-900';
            const activeIconBox = btn.querySelector('div > div:first-child');
            if (activeIconBox) activeIconBox.className = 'w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0';
            const activeChevron = btn.querySelector('.loc-chevron');
            if (activeChevron) activeChevron.className = 'w-4 h-4 text-blue-600 loc-chevron';

            updateExplorerBreakdown();
        }

        // Update the Rate Breakdown card in explorer
        function updateExplorerBreakdown() {
            const locData = pricingDatabase[currentActiveLocation] || pricingDatabase['mall'];
            const rate = locData[currentActiveVehicle] || locData['car'];

            const heroVal = document.getElementById('rateBaseHero');
            const subText = document.getElementById('rateSubText');
            const rowFirst = document.getElementById('rowFirst');
            const rowSecond = document.getElementById('rowSecond');
            const rowSubsequent = document.getElementById('rowSubsequent');
            const rowMax = document.getElementById('rowMax');

            if (heroVal) heroVal.textContent = formatRp(rate.base);
            if (subText) subText.textContent = `Next hour: +${formatRp(rate.next)}/hr • Daily Max: ${formatRp(rate.max)}`;
            if (rowFirst) rowFirst.textContent = formatRp(rate.base);
            if (rowSecond) rowSecond.textContent = `+ ${formatRp(rate.next)}`;
            if (rowSubsequent) rowSubsequent.textContent = `+ ${formatRp(rate.next)} / hr`;
            if (rowMax) rowMax.textContent = formatRp(rate.max);
        }

        // Location Filter in left explorer list
        function filterLocations(query) {
            const filter = (query || '').toLowerCase().trim();
            const items = document.querySelectorAll('#locationList .loc-item');
            items.forEach(item => {
                const name = item.querySelector('.loc-name')?.textContent.toLowerCase() || '';
                const city = item.querySelector('.loc-city')?.textContent.toLowerCase() || '';
                if (name.includes(filter) || city.includes(filter)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Pricing Estimator calculation
        function runEstimateCalculation() {
            const locKey = document.getElementById('estLocation')?.value || 'mall';
            const veh = document.getElementById('estVehicle')?.value || 'car';
            const hours = parseInt(document.getElementById('estDuration')?.value || '3', 10);

            const locData = pricingDatabase[locKey] || pricingDatabase['mall'];
            const rate = locData[veh] || locData['car'];

            let total = 0;
            let nextHours = Math.max(0, hours - 1);
            let nextCost = nextHours * rate.next;

            total = rate.base + nextCost;
            if (rate.max && total > rate.max) {
                total = rate.max;
            }

            const calcTotal = document.getElementById('calcTotal');
            const calcBase = document.getElementById('calcBase');
            const calcNextLabel = document.getElementById('calcNextLabel');
            const calcNext = document.getElementById('calcNext');
            const calcFinal = document.getElementById('calcFinal');

            if (calcTotal) calcTotal.textContent = formatRp(total);
            if (calcFinal) calcFinal.textContent = formatRp(total);
            if (calcBase) calcBase.textContent = formatRp(rate.base);
            
            if (calcNextLabel) {
                if (nextHours > 0) {
                    calcNextLabel.textContent = `Next ${nextHours} hour${nextHours > 1 ? 's' : ''} (${nextHours} × ${formatRp(rate.next)})`;
                } else {
                    calcNextLabel.textContent = 'Additional hours';
                }
            }
            if (calcNext) calcNext.textContent = formatRp(nextCost);
        }

        // Accordion Toggle
        function toggleFaqAccordion(btn) {
            const faqItem = btn.closest('.faq-item');
            const content = faqItem.querySelector('.faq-content');
            const icon = btn.querySelector('.faq-icon');

            const isCurrentlyHidden = content.classList.contains('hidden');

            // Close all items
            document.querySelectorAll('.faq-item .faq-content').forEach(c => c.classList.add('hidden'));
            document.querySelectorAll('.faq-item .faq-icon').forEach(i => i.classList.remove('rotate-180'));

            if (isCurrentlyHidden) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        }

        // Initial setup on load
        document.addEventListener('DOMContentLoaded', function() {
            updateExplorerBreakdown();
            runEstimateCalculation();
        });
    </script>
</body>
</html>
