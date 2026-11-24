<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works - A Smarter Parking Experience | NusaPark</title>
    <meta name="description" content="Discover how NusaPark works, from finding a parking location to paying and exiting — all in one seamless flow.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50/60 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <x-navbar active="how-it-works" />

    <!-- SVG ClipPath Definition for the Organic S-Curve -->
    <svg width="0" height="0" class="absolute pointer-events-none">
        <defs>
            <clipPath id="hiw-organic-curve" clipPathUnits="objectBoundingBox">
                <path d="M 0.18,0 
                         C 0.08,0.14 0,0.28 0,0.44 
                         C 0,0.62 0.06,0.76 0.22,0.88 
                         C 0.38,0.97 0.65,1 1,1 
                         L 1,0 Z" />
            </clipPath>
        </defs>
    </svg>

    <main class="flex-grow">
        <!-- HERO SECTION -->
        <section class="relative overflow-hidden pt-4 pb-16 lg:pt-8 lg:pb-24 bg-white border-b border-slate-100">
            <!-- Desktop Right Curved Graphic (Absolute spanning to right edge) -->
            <div class="hidden lg:block absolute top-0 right-0 bottom-8 w-[54%] xl:w-[52%] z-0 pointer-events-none">
                <div class="relative w-full h-full overflow-hidden shadow-2xl bg-slate-900" style="clip-path: url(#hiw-organic-curve);">
                    <!-- Parking Garage Photo -->
                    <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Smart Parking System" class="w-full h-full object-cover object-center scale-105 hover:scale-100 transition-transform duration-1000" />

                    <!-- Ambient Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-slate-950/20"></div>

                    <!-- Overhead Digital Sign [P] Available 327 / 350 -->
                    <div class="absolute top-8 right-12 xl:right-16 flex flex-col items-center">
                        <div class="flex justify-between w-32 px-4 -mb-1">
                            <div class="w-0.5 h-6 bg-slate-500/80 shadow-sm"></div>
                            <div class="w-0.5 h-6 bg-slate-500/80 shadow-sm"></div>
                        </div>
                        <div class="bg-slate-950/90 backdrop-blur-md border border-cyan-500/40 rounded-xl p-3 shadow-2xl flex items-center gap-3.5 ring-1 ring-cyan-500/20">
                            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center font-black text-xl text-white shadow-inner">
                                P
                            </div>
                            <div class="pr-2">
                                <div class="text-[10px] uppercase font-bold tracking-wider text-cyan-400 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                                    Available
                                </div>
                                <div class="text-xl font-extrabold text-emerald-400 tracking-tight font-mono">
                                    327 <span class="text-slate-400 text-xs font-normal">/ 350</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 xl:col-span-6 pt-4 lg:pt-6">
                        <!-- Pill Badge -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-xs font-semibold mb-6">
                            <span>How It Works</span>
                        </div>

                        <!-- Headline -->
                        <h1 class="text-4xl sm:text-5xl xl:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.12] mb-6">
                            A Smarter Parking <br>
                            <span class="text-slate-900">Experience</span>
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-slate-600 text-base sm:text-lg max-w-xl mb-8 leading-relaxed font-normal">
                            Discover how NusaPark works, from finding a parking location to paying and exiting — all in one seamless flow.
                        </p>

                        <!-- CTA Actions -->
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="/search" class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all">
                                <span>Find Parking</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <a href="#how-nusapark-works" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm border border-slate-200 shadow-sm transition-all">
                                <span>Explore Features</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column Placeholder for Mobile -->
                    <div class="lg:hidden mt-4">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl bg-slate-900 h-64">
                            <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Smart Parking System" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 bg-slate-950/90 rounded-xl p-3 border border-cyan-500/30 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-white">P</div>
                                <div>
                                    <div class="text-[9px] uppercase font-bold text-cyan-400">Available</div>
                                    <div class="text-base font-extrabold text-emerald-400">327 <span class="text-xs text-slate-400">/ 350</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- WHY CHOOSE NUSAPARK? (DARK NAVY STRIP) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-8 relative z-20">
            <div class="bg-slate-900 rounded-3xl shadow-2xl p-6 sm:p-10 border border-slate-800 text-white">
                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight mb-8">
                    Why Choose NusaPark?
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-6 divide-y sm:divide-y-0 sm:divide-x divide-slate-800/80">
                    
                    <!-- Feature 1 -->
                    <div class="pt-4 sm:pt-0 sm:pr-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1">Real-Time Availability</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Check empty slots instantly.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="pt-4 sm:pt-0 sm:px-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                <circle cx="12" cy="13" r="4"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1">ANPR Recognition</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Automatic vehicle identification.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="pt-4 sm:pt-0 sm:px-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1">Digital Payment</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Pay cashless with QRIS, e-wallet, or card.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="pt-4 sm:pt-0 sm:px-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="20" x2="18" y2="10"/>
                                <line x1="12" y1="20" x2="12" y2="4"/>
                                <line x1="6" y1="20" x2="6" y2="14"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1">Transparent Pricing</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Clear rates with no hidden fees.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="pt-4 sm:pt-0 sm:pl-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <polyline points="9 12 11 14 15 10"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1">Safe & Reliable</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Monitored and secured parking environment.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- HOW NUSAPARK WORKS (OVERVIEW BLOCK) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24" id="how-nusapark-works">
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 lg:p-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    
                    <!-- Left Column -->
                    <div class="lg:col-span-7">
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                            How <span class="text-blue-600">NusaPark</span> Works
                        </h2>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                            A simple and seamless parking process from arrival to exit.
                        </p>

                        <ul class="space-y-3.5 text-sm sm:text-base text-slate-700">
                            <li class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span>Find a parking location near you.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span>Enter and park using ANPR or ticket.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span>Pay digitally with your preferred method.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span>Exit automatically after payment.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Right Column: Vertical Timeline Card -->
                    <div class="lg:col-span-5">
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 space-y-3.5">
                            
                            <!-- Step 01 -->
                            <a href="#step-1" class="flex items-center justify-between p-3.5 rounded-xl bg-white border border-blue-500/30 shadow-sm hover:shadow transition-all group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Find Parking</span>
                                </div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">01</span>
                            </a>

                            <!-- Step 02 -->
                            <a href="#step-2" class="flex items-center justify-between p-3.5 rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow transition-all group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Arrive & Park</span>
                                </div>
                                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">02</span>
                            </a>

                            <!-- Step 03 -->
                            <a href="#step-3" class="flex items-center justify-between p-3.5 rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow transition-all group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Pay</span>
                                </div>
                                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">03</span>
                            </a>

                            <!-- Step 04 -->
                            <a href="#step-4" class="flex items-center justify-between p-3.5 rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow transition-all group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Exit</span>
                                </div>
                                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">04</span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- DETAILED STEP 1: ENTER THE PARKING AREA -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24" id="step-1">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left: Photo of car at barrier gate -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-200/80 group">
                        <img src="{{ asset('images/parking-booth.jpg') }}" alt="Enter Parking Gate ANPR" class="w-full h-72 sm:h-80 object-cover object-center transform group-hover:scale-105 transition-transform duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900/90 text-white text-xs font-semibold backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                            ANPR Barrier Active
                        </div>
                    </div>
                </div>

                <!-- Right: Text & Badges -->
                <div class="lg:col-span-6 lg:pl-6">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
                        <span class="text-blue-600">1. Enter</span> the Parking Area
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Your vehicle is automatically recognized using ANPR (Automatic Number Plate Recognition) or a parking ticket.
                    </p>

                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                <circle cx="12" cy="13" r="4"/>
                            </svg>
                            <span>ANPR</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="6" width="20" height="12" rx="2"/>
                                <circle cx="12" cy="12" r="2"/>
                                <path d="M6 12h.01M18 12h.01"/>
                            </svg>
                            <span>Parking Ticket</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DETAILED STEP 2: PARK WITH CONFIDENCE -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24" id="step-2">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left: Text & Checkpoints -->
                <div class="lg:col-span-6 lg:pr-6 order-2 lg:order-1">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
                        <span class="text-blue-600">2. Park</span> with Confidence
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Find an available slot easily through real-time updates on the web or mobile app.
                    </p>

                    <ul class="space-y-3 text-sm text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Live slot availability</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Clear zone information</span>
                        </li>
                    </ul>
                </div>

                <!-- Right: Interactive Parking Slot Map Widget -->
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xl p-6 sm:p-7">
                        <!-- Floor Switcher -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl" id="floorTabs">
                                <button type="button" onclick="switchFloor('B1', this)" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all bg-blue-600 text-white shadow-sm">B1</button>
                                <button type="button" onclick="switchFloor('B2', this)" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-600 hover:text-slate-900">B2</button>
                                <button type="button" onclick="switchFloor('L1', this)" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-600 hover:text-slate-900">L1</button>
                                <button type="button" onclick="switchFloor('L2', this)" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-600 hover:text-slate-900">L2</button>
                            </div>
                            <span class="text-xs text-slate-500 font-medium">Zone A • Main Hall</span>
                        </div>

                        <!-- 10 Slots Grid (2 rows x 5 cols) -->
                        <div class="grid grid-cols-5 gap-2.5 sm:gap-3 mb-6" id="slotMatrix">
                            <!-- Row 1 -->
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A01</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-rose-100 text-rose-800 border border-rose-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A02</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A03</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-amber-100 text-amber-800 border border-amber-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A04</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A05</div>
                            
                            <!-- Row 2 -->
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A06</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A07</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-rose-100 text-rose-800 border border-rose-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A08</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-amber-100 text-amber-800 border border-amber-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A09</div>
                            <div class="py-3 rounded-xl text-center font-bold text-xs bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm transition-transform hover:scale-105 cursor-pointer">A10</div>
                        </div>

                        <!-- Legend -->
                        <div class="flex items-center justify-center gap-6 text-xs text-slate-600 font-medium pt-2 border-t border-slate-100">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                Available
                            </span>
                            <span class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                Occupied
                            </span>
                            <span class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                Reserved
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DETAILED STEP 3: PAY DIGITALLY, EASILY -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24" id="step-3">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left: Dark Payment Card UI Mockup -->
                <div class="lg:col-span-6 flex justify-center lg:justify-start">
                    <div class="w-full max-w-sm sm:max-w-md bg-slate-900 text-white rounded-2xl p-6 sm:p-7 shadow-2xl border border-slate-800">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-blue-600/30 text-blue-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                </div>
                                <span class="text-sm font-bold text-white">Payment</span>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-500/20 text-blue-300">AUTO-SYNC</span>
                        </div>

                        <!-- Rows -->
                        <div class="py-4 space-y-3 text-sm">
                            <div class="flex justify-between items-center text-slate-300">
                                <span>Parking Fee</span>
                                <span class="font-semibold text-white">Rp 5.000</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-300">
                                <span>Duration</span>
                                <span class="font-semibold text-white">1 hour</span>
                            </div>
                            <div class="pt-3 border-t border-slate-800 flex justify-between items-center">
                                <span class="font-bold text-slate-200">Total</span>
                                <span class="text-xl font-black text-emerald-400">Rp 5.000</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <button type="button" class="w-full mt-2 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-500/25 transition-all text-center">
                            Pay Now
                        </button>
                    </div>
                </div>

                <!-- Right: Text & Payment Options -->
                <div class="lg:col-span-6 lg:pl-6">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
                        <span class="text-blue-600">3. Pay</span> Digitally, Easily
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Settle your parking fee quickly and securely using various payment methods.
                    </p>

                    <!-- Payment Badges / Cards -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200 text-center shadow-sm hover:border-blue-400 transition-colors">
                            <div class="w-8 h-8 mx-auto rounded-lg bg-red-50 text-red-500 flex items-center justify-center mb-1.5">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="3"/><rect x="14" y="7" width="3" height="3"/><rect x="7" y="14" width="3" height="3"/><rect x="14" y="14" width="3" height="3"/></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">QRIS</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200 text-center shadow-sm hover:border-blue-400 transition-colors">
                            <div class="w-8 h-8 mx-auto rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-1.5">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12V7H5a2 2 0 0 1 2-2h14v4z"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">E-Wallet</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200 text-center shadow-sm hover:border-blue-400 transition-colors">
                            <div class="w-8 h-8 mx-auto rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-1.5">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Bank Card</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DETAILED STEP 4: EXIT SEAMLESSLY -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24" id="step-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left: Text & Checkpoints -->
                <div class="lg:col-span-6 lg:pr-6 order-2 lg:order-1">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
                        <span class="text-blue-600">4. Exit</span> Seamlessly
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        Drive out automatically after a successful payment verification.
                    </p>

                    <ul class="space-y-3 text-sm text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Automatic gate opening</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Fast and contactless</span>
                        </li>
                    </ul>
                </div>

                <!-- Right: Exit Photo -->
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-200/80 group">
                        <img src="{{ asset('images/parking-booth.jpg') }}" alt="Exit Barrier Gate" class="w-full h-72 sm:h-80 object-cover object-center transform group-hover:scale-105 transition-transform duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>
                        
                        <!-- Green Exit Overhead Banner -->
                        <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-black shadow-lg">
                            <span>EXIT</span>
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>

                        <div class="absolute bottom-4 left-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900/90 text-white text-xs font-semibold backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            Verified Paid • Gate Cleared
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TECHNOLOGY BEHIND NUSAPARK (4 GRID CARDS) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    Technology Behind <span class="text-blue-600">NusaPark</span>
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Powered by IoT, AI, and a modern web platform for a smarter parking ecosystem.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12.55a11 11 0 0 1 14.08 0"/>
                                <path d="M1.42 9a16 16 0 0 1 21.16 0"/>
                                <path d="M8.53 16.11a6 6 0 0 1 6.95 0"/>
                                <line x1="12" y1="20" x2="12.01" y2="20"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">IoT Integration</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Real-time data from gates, sensors, and devices.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                <polyline points="2 17 12 22 22 17"/>
                                <polyline points="2 12 12 17 22 12"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">AI & ANPR</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Recognizes vehicle license plates automatically.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Web Platform</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Manage parking, monitor slots, and view reports.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="20" x2="18" y2="10"/>
                                <line x1="12" y1="20" x2="12" y2="4"/>
                                <line x1="6" y1="20" x2="6" y2="14"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Real-Time Monitoring</h4>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Live parking activity and occupancy stats.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- NUSAPARK IN NUMBERS (STATS BAR) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 sm:mt-24">
            <div class="bg-gradient-to-r from-blue-50 via-slate-50 to-indigo-50/60 rounded-3xl border border-blue-100/80 p-6 sm:p-8 lg:p-10 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mb-1">
                        <span class="text-blue-600">NusaPark</span> in Numbers
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500">A growing parking network across Indonesia</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 divide-x divide-slate-200/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">4,821+</div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Locations</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pl-4 sm:pl-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20">
                            <span class="font-bold text-sm">P</span>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">3.4M+</div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Parking Slots</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pl-4 sm:pl-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">8.9M+</div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Vehicles Today</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pl-4 sm:pl-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/20">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">12M+</div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Transactions</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WHAT OUR USERS SAY (TESTIMONIALS) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    What Our <span class="text-blue-600">Users Say</span>
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Real experiences from drivers who use NusaPark.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- Review 1 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-7 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div>
                        <!-- Header with Avatar and Name -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-sm ring-2 ring-blue-500/20">
                                RP
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Risky Pratama</h4>
                                <p class="text-xs text-slate-500">Driver</p>
                            </div>
                        </div>

                        <!-- Stars -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4 text-sm">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>

                        <!-- Quote -->
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                            "Sangat membantu! Saya bisa langsung lihat slot yang tersedia dan bayar tanpa ribet."
                        </p>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-7 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div>
                        <!-- Header with Avatar and Name -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-full bg-pink-100 text-pink-700 font-bold flex items-center justify-center text-sm ring-2 ring-pink-500/20">
                                AP
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Anisa Putri</h4>
                                <p class="text-xs text-slate-500">Office Worker</p>
                            </div>
                        </div>

                        <!-- Stars -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4 text-sm">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>

                        <!-- Quote -->
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                            "Pembayarannya mudah, cukup scan QRIS. Prosesnya cepat dan lokasinya lengkap."
                        </p>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-7 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div>
                        <!-- Header with Avatar and Name -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-sm ring-2 ring-indigo-500/20">
                                DY
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Dimas Yudha</h4>
                                <p class="text-xs text-slate-500">Student</p>
                            </div>
                        </div>

                        <!-- Stars -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4 text-sm">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>

                        <!-- Quote -->
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                            "Fitur ANPR-nya keren, keluar masuk parkir jadi lebih praktis dan cepat."
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- FREQUENTLY ASKED QUESTIONS (FAQ) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 sm:mt-28 mb-16" id="faq">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    Frequently Asked <span class="text-blue-600">Questions</span>
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Everything you need to know about how NusaPark works.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: 3D Speech Bubble Graphic -->
                <div class="lg:col-span-4 flex justify-center">
                    <div class="relative w-48 h-48 sm:w-56 sm:h-56 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-3xl p-6 shadow-2xl flex items-center justify-center text-white transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px] rounded-3xl"></div>
                        <div class="relative z-10 text-center">
                            <span class="text-6xl sm:text-7xl font-black drop-shadow-md">?</span>
                            <div class="flex items-center justify-center gap-1.5 mt-2">
                                <span class="w-2 h-2 rounded-full bg-white animate-bounce"></span>
                                <span class="w-2 h-2 rounded-full bg-white animate-bounce [animation-delay:0.2s]"></span>
                                <span class="w-2 h-2 rounded-full bg-white animate-bounce [animation-delay:0.4s]"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Accordion Items -->
                <div class="lg:col-span-8 space-y-3.5">
                    
                    <!-- FAQ 1 (Open by default) -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleHiwFaq(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">How does NusaPark work?</span>
                            <span class="faq-toggle-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300 rotate-180">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-drawer px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed block border-t border-slate-100 pt-3">
                            Find a location, park your vehicle, pay digitally, and exit automatically. The whole process is integrated with ANPR and real-time monitoring.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleHiwFaq(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">What payment methods are available?</span>
                            <span class="faq-toggle-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-drawer px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            You can pay cashless with QRIS, major e-wallets (GoPay, OVO, Dana, ShopeePay), debit/credit cards, and automated in-app payments.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleHiwFaq(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">Is my vehicle data safe?</span>
                            <span class="faq-toggle-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-drawer px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            Yes, vehicle license plate data and timestamps are encrypted with enterprise-grade standards and solely used for barrier verification.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200">
                        <button type="button" onclick="toggleHiwFaq(this)" class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                            <span class="text-sm sm:text-base">Can I use NusaPark at multiple locations?</span>
                            <span class="faq-toggle-icon w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0 transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </button>
                        <div class="faq-drawer px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-3">
                            Absolutely. One account gives you seamless entry and cashless exit across all partner malls, office towers, and public venues throughout Indonesia.
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- BOTTOM CTA BANNER: READY TO EXPERIENCE SMARTER PARKING? -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white shadow-2xl p-8 sm:p-12 lg:p-16">
                <!-- Glowing ambient background -->
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    
                    <!-- Left Column -->
                    <div class="lg:col-span-8">
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4">
                            Ready to Experience <br class="hidden sm:inline">Smarter Parking?
                        </h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8 max-w-xl">
                            Find a location near you and enjoy a faster, safer, and more convenient parking experience.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="/search" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-lg shadow-blue-500/25 transition-all">
                                <span>Find Parking</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/locations" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm backdrop-blur-sm border border-white/20 transition-all">
                                <span>Explore Locations</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Mobile Phone Mockup -->
                    <div class="lg:col-span-4 flex justify-center lg:justify-end">
                        <div class="relative w-48 sm:w-56 rounded-3xl bg-slate-950 p-2.5 shadow-2xl border-4 border-slate-700 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <!-- Screen -->
                            <div class="rounded-2xl bg-blue-600 p-4 text-white text-center flex flex-col justify-between h-72 shadow-inner">
                                <div class="flex items-center justify-between text-[10px] text-blue-200">
                                    <span>NusaPark</span>
                                    <span>9:41</span>
                                </div>
                                <div class="my-auto py-4">
                                    <div class="w-12 h-12 mx-auto rounded-2xl bg-white text-blue-600 flex items-center justify-center font-black text-2xl mb-3 shadow-md">
                                        P
                                    </div>
                                    <div class="text-xs font-bold">Find & Pay Parking</div>
                                    <div class="text-[10px] text-blue-200">Near You</div>
                                </div>
                                <div class="bg-white/20 backdrop-blur-sm rounded-xl py-2 text-[11px] font-semibold">
                                    Scan & Park
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <x-footer />

    <!-- INTERACTIVE SCRIPTS -->
    <script>
        // Floor switcher in Step 2
        const floorData = {
            'B1': [
                { id: 'A01', status: 'available' }, { id: 'A02', status: 'occupied' }, { id: 'A03', status: 'available' }, { id: 'A04', status: 'reserved' }, { id: 'A05', status: 'available' },
                { id: 'A06', status: 'available' }, { id: 'A07', status: 'available' }, { id: 'A08', status: 'occupied' }, { id: 'A09', status: 'reserved' }, { id: 'A10', status: 'available' }
            ],
            'B2': [
                { id: 'B01', status: 'available' }, { id: 'B02', status: 'available' }, { id: 'B03', status: 'occupied' }, { id: 'B04', status: 'occupied' }, { id: 'B05', status: 'available' },
                { id: 'B06', status: 'reserved' }, { id: 'B07', status: 'available' }, { id: 'B08', status: 'available' }, { id: 'B09', status: 'occupied' }, { id: 'B10', status: 'available' }
            ],
            'L1': [
                { id: 'L01', status: 'occupied' }, { id: 'L02', status: 'occupied' }, { id: 'L03', status: 'occupied' }, { id: 'L04', status: 'available' }, { id: 'L05', status: 'available' },
                { id: 'L06', status: 'available' }, { id: 'L07', status: 'reserved' }, { id: 'L08', status: 'available' }, { id: 'L09', status: 'occupied' }, { id: 'L10', status: 'available' }
            ],
            'L2': [
                { id: 'R01', status: 'available' }, { id: 'R02', status: 'available' }, { id: 'R03', status: 'available' }, { id: 'R04', status: 'available' }, { id: 'R05', status: 'reserved' },
                { id: 'R06', status: 'available' }, { id: 'R07', status: 'occupied' }, { id: 'R08', status: 'available' }, { id: 'R09', status: 'available' }, { id: 'R10', status: 'available' }
            ]
        };

        function switchFloor(floor, btn) {
            // Update button styles
            document.querySelectorAll('#floorTabs button').forEach(b => {
                b.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-600 hover:text-slate-900';
            });
            btn.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all bg-blue-600 text-white shadow-sm';

            // Render slots
            const slots = floorData[floor] || floorData['B1'];
            const container = document.getElementById('slotMatrix');
            if (!container) return;

            container.innerHTML = slots.map(s => {
                let colorClass = 'bg-emerald-100 text-emerald-800 border-emerald-300';
                if (s.status === 'occupied') {
                    colorClass = 'bg-rose-100 text-rose-800 border-rose-300';
                } else if (s.status === 'reserved') {
                    colorClass = 'bg-amber-100 text-amber-800 border-amber-300';
                }
                return `<div class="py-3 rounded-xl text-center font-bold text-xs ${colorClass} border shadow-sm transition-transform hover:scale-105 cursor-pointer">${s.id}</div>`;
            }).join('');
        }

        // FAQ Toggle
        function toggleHiwFaq(btn) {
            const card = btn.closest('.faq-card');
            const drawer = card.querySelector('.faq-drawer');
            const icon = card.querySelector('.faq-toggle-icon');

            const isCurrentlyHidden = drawer.classList.contains('hidden');

            // Close all
            document.querySelectorAll('.faq-card .faq-drawer').forEach(d => d.classList.add('hidden'));
            document.querySelectorAll('.faq-card .faq-toggle-icon').forEach(i => i.classList.remove('rotate-180'));

            if (isCurrentlyHidden) {
                drawer.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        }
    </script>
</body>
</html>
