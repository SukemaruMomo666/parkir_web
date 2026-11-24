<?php
// NusaPark - Smart Parking for a Smarter Indonesia
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaPark - Smart Parking for a Smarter Indonesia</title>
    <meta name="description" content="Find available parking, check real-time occupancy, and pay digitally in one seamless experience across Indonesia.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white">

    <!-- NAVBAR -->
    <x-navbar active="home" />

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden pt-4 pb-16 lg:pt-8 lg:pb-24 bg-white">
        <!-- SVG ClipPath Definition for the Organic S-Curve -->
        <svg width="0" height="0" class="absolute">
            <defs>
                <clipPath id="hero-organic-curve" clipPathUnits="objectBoundingBox">
                    <path d="M 0.18,0 
                             C 0.08,0.14 0,0.28 0,0.44 
                             C 0,0.62 0.06,0.76 0.22,0.88 
                             C 0.38,0.97 0.65,1 1,1 
                             L 1,0 Z" />
                </clipPath>
            </defs>
        </svg>

        <!-- Desktop Right Curved Graphic (Absolute spanning to right edge) -->
        <div class="hidden lg:block absolute top-0 right-0 bottom-8 w-[54%] xl:w-[52%] z-10 pointer-events-auto">
            <div class="relative w-full h-full overflow-hidden shadow-2xl bg-slate-900" style="clip-path: url(#hero-organic-curve);">
                <!-- Parking Garage Photo -->
                <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Smart Parking System" class="w-full h-full object-cover object-center scale-105 hover:scale-100 transition-transform duration-1000" />

                <!-- Subtle Ambient Gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-slate-950/20 pointer-events-none"></div>

                <!-- Overhead Digital Sign [P] Available 327 / 350 -->
                <div class="absolute top-8 right-12 xl:right-16 flex flex-col items-center">
                    <!-- Hanging Brackets -->
                    <div class="flex justify-between w-32 px-4 -mb-1">
                        <div class="w-0.5 h-6 bg-slate-500/80 shadow-sm"></div>
                        <div class="w-0.5 h-6 bg-slate-500/80 shadow-sm"></div>
                    </div>
                    <!-- Sign Box -->
                    <div class="flex items-center bg-slate-950/90 rounded-2xl p-2.5 sm:p-3 border-2 border-cyan-400 shadow-[0_0_25px_rgba(34,211,238,0.45)] backdrop-blur-md">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-blue-600 flex items-center justify-center font-black text-xl text-white shadow-inner mr-3 shrink-0">
                            P
                        </div>
                        <div class="pr-3">
                            <div class="text-[11px] font-bold uppercase tracking-wider text-cyan-400 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                                Available
                            </div>
                            <div class="text-lg sm:text-xl font-black tracking-tight text-white">
                                <span class="text-emerald-400 font-extrabold">327</span> <span class="text-xs font-semibold text-slate-400">/ 350</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pillar B2 Marker -->
                <div class="absolute top-[45%] left-[16%] -translate-y-1/2">
                    <div class="bg-blue-600 text-white font-black text-xl xl:text-2xl px-4 py-2 rounded-xl shadow-[0_0_20px_rgba(37,99,235,0.5)] border border-blue-400/50 flex items-center gap-1">
                        <span>B2</span>
                    </div>
                </div>

                <!-- Glowing Cyan Floor Directional Chevrons -->
                <div class="absolute bottom-8 left-[58%] -translate-x-1/2 flex flex-col items-center gap-0.5 pointer-events-none drop-shadow-[0_0_12px_rgba(34,211,238,0.9)] opacity-90">
                    <svg class="w-8 h-8 text-cyan-400 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 15l7-7 7 7"/>
                    </svg>
                    <svg class="w-8 h-8 text-cyan-400 -mt-4 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 15l7-7 7 7"/>
                    </svg>
                    <svg class="w-8 h-8 text-cyan-400 -mt-4 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 15l7-7 7 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Hero Content -->
                <div class="lg:col-span-7 xl:col-span-6 pt-2 pb-6">
                    <!-- Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Smart Parking Platform
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl sm:text-5xl lg:text-[54px] font-extrabold text-slate-900 tracking-tight leading-[1.14]">
                        Smart Parking for a<br>
                        <span class="text-slate-900">Smarter Indonesia</span>
                    </h1>

                    <!-- Description -->
                    <p class="mt-5 mb-8 text-base sm:text-lg text-slate-600 max-w-xl leading-relaxed">
                        Find available parking, check real-time occupancy, and pay digitally in one seamless experience.
                    </p>

                    <!-- CTA Actions -->
                    <div class="flex flex-wrap items-center gap-3.5 mb-12">
                        <a href="/search" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/25 hover:shadow-lg hover:shadow-blue-500/35 transition-all group">
                            Find Parking
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="/locations" class="inline-flex items-center px-7 py-3.5 rounded-full bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm border border-slate-200/90 shadow-sm transition-all hover:border-slate-300">
                            Explore Locations
                        </a>
                    </div>

                    <!-- 4 Feature Highlights Row -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 pt-6 border-t border-slate-100 max-w-2xl">
                        <!-- 1. Real-Time -->
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 leading-tight">Real-Time</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Slot availability</p>
                            </div>
                        </div>

                        <!-- 2. ANPR -->
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <circle cx="12" cy="13" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 leading-tight">ANPR</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Auto vehicle recognition</p>
                            </div>
                        </div>

                        <!-- 3. Digital Payment -->
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                                    <line x1="2" y1="10" x2="22" y2="10"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 leading-tight">Digital Payment</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Cashless & secure</p>
                            </div>
                        </div>

                        <!-- 4. Smart Map -->
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <circle cx="12" cy="10" r="2"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 leading-tight">Smart Map</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Navigate to your slot</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile & Tablet Visual (Shown only below lg) -->
                <div class="lg:hidden mt-4">
                    <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-100 aspect-[16/10] bg-slate-900">
                        <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Smart Parking" class="w-full h-full object-cover" />
                        <!-- Mobile Available Card -->
                        <div class="absolute top-4 right-4 bg-slate-950/90 border border-cyan-400 rounded-xl px-3 py-2 flex items-center gap-2.5 shadow-lg">
                            <div class="w-7 h-7 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-sm text-white">P</div>
                            <div>
                                <div class="text-[9px] uppercase tracking-wider text-cyan-400 font-bold">Available</div>
                                <div class="text-sm font-extrabold text-white"><span class="text-emerald-400">327</span> / 350</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section class="py-16 sm:py-20 bg-slate-50/70 border-y border-slate-100" id="how-it-works">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    How It <span class="text-blue-600">Works</span>
                </h2>
                <p class="mt-3 text-slate-500 text-sm sm:text-base">
                    A simple and seamless parking experience from arrival to exit.
                </p>
            </div>

            <!-- 5 Steps Timeline with Connecting Line -->
            <div class="relative">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden lg:block absolute top-10 left-[10%] right-[10%] h-0.5 border-t-2 border-dashed border-slate-200 z-0"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 sm:gap-6 relative z-10">
                    <!-- Step 01: Find Parking -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-blue-600 mb-4 group-hover:scale-105 group-hover:border-blue-500 group-hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8"/>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-1">01</span>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Find Parking</h3>
                        <p class="text-xs text-slate-500 max-w-[170px] leading-relaxed">Search and choose your location</p>
                    </div>

                    <!-- Step 02: Arrive -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-4 group-hover:scale-105 group-hover:border-blue-500 group-hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-600 flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                                    <circle cx="7" cy="17" r="2"/>
                                    <path d="M9 17h6"/>
                                    <circle cx="17" cy="17" r="2"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 tracking-widest uppercase mb-1">02</span>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Arrive</h3>
                        <p class="text-xs text-slate-500 max-w-[170px] leading-relaxed">Drive to the location with navigation</p>
                    </div>

                    <!-- Step 03: Park -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-4 group-hover:scale-105 group-hover:border-blue-500 group-hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-600 flex items-center justify-center transition-colors">
                                <span class="font-bold text-lg">P</span>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 tracking-widest uppercase mb-1">03</span>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Park</h3>
                        <p class="text-xs text-slate-500 max-w-[170px] leading-relaxed">Enter and park at the assigned slot</p>
                    </div>

                    <!-- Step 04: Pay -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-4 group-hover:scale-105 group-hover:border-blue-500 group-hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-600 flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                                    <line x1="2" y1="10" x2="22" y2="10"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 tracking-widest uppercase mb-1">04</span>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Pay</h3>
                        <p class="text-xs text-slate-500 max-w-[170px] leading-relaxed">Make a cashless payment</p>
                    </div>

                    <!-- Step 05: Exit -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 mb-4 group-hover:scale-105 group-hover:border-blue-500 group-hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 group-hover:bg-blue-50 group-hover:text-blue-600 flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 tracking-widest uppercase mb-1">05</span>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Exit</h3>
                        <p class="text-xs text-slate-500 max-w-[170px] leading-relaxed">Leave the parking area effortlessly</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIVE MALL XYZ & PARKING MAP SECTION -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Left Card: Mall XYZ Live Info (Dark Card) -->
                <div class="lg:col-span-5 bg-[#0B1528] rounded-[2rem] p-7 sm:p-8 text-white shadow-xl flex flex-col justify-between relative overflow-hidden border border-slate-800">
                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight text-white">Mall XYZ</h3>
                                <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    Jakarta Selatan • 1,250 Total Slots
                                </p>
                            </div>
                            <a href="/locations" class="px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 text-white text-xs font-semibold backdrop-blur-sm transition-all whitespace-nowrap">
                                View Parking →
                            </a>
                        </div>

                        <!-- Mall Image Preview -->
                        <div class="my-6 rounded-2xl overflow-hidden aspect-[16/10] bg-slate-800 border border-slate-700/60 shadow-inner group">
                            <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ Exterior" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        </div>
                    </div>

                    <!-- 3 Stats Columns -->
                    <div class="grid grid-cols-3 gap-2 pt-4 border-t border-slate-800/80 text-center">
                        <div>
                            <div class="flex items-center justify-center gap-1.5 text-emerald-400 font-extrabold text-lg sm:text-xl">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                                327
                            </div>
                            <span class="text-[11px] text-slate-400">Available</span>
                        </div>
                        <div>
                            <div class="flex items-center justify-center gap-1.5 text-blue-400 font-extrabold text-lg sm:text-xl">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                                923
                            </div>
                            <span class="text-[11px] text-slate-400">Occupied</span>
                        </div>
                        <div>
                            <div class="flex items-center justify-center gap-1.5 text-amber-400 font-extrabold text-lg sm:text-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                12
                            </div>
                            <span class="text-[11px] text-slate-400">Reserved</span>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Parking Map Visualizer (White Card) -->
                <div class="lg:col-span-7 bg-white rounded-[2rem] p-7 sm:p-8 border border-slate-100 shadow-xl flex flex-col justify-between">
                    <div>
                        <!-- Header & View Full Map -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-slate-900">Parking Map – Mall XYZ</h3>
                            <a href="/locations" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                View Full Map
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Floor Selector Tabs -->
                        <div class="flex items-center gap-2 mb-6" id="floor-tabs">
                            <button type="button" class="floor-btn px-4 py-1.5 rounded-lg text-xs font-bold bg-blue-600 text-white shadow-sm transition-all" data-floor="B1">B1</button>
                            <button type="button" class="floor-btn px-4 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-all" data-floor="B2">B2</button>
                            <button type="button" class="floor-btn px-4 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-all" data-floor="L1">L1</button>
                            <button type="button" class="floor-btn px-4 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-all" data-floor="L2">L2</button>
                        </div>

                        <!-- Interactive 10-Slot Visual Grid -->
                        <div class="grid grid-cols-5 gap-3 sm:gap-4 my-4" id="slots-grid">
                            <!-- Row 1 -->
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-emerald-100 text-emerald-800 border border-emerald-200 hover:scale-105 cursor-pointer shadow-sm">
                                A01
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-rose-100 text-rose-800 border border-rose-200 hover:scale-105 cursor-pointer shadow-sm">
                                A02
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-emerald-100 text-emerald-800 border border-emerald-200 hover:scale-105 cursor-pointer shadow-sm">
                                A03
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-amber-100 text-amber-800 border border-amber-200 hover:scale-105 cursor-pointer shadow-sm">
                                A04
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-amber-100 text-amber-800 border border-amber-200 hover:scale-105 cursor-pointer shadow-sm">
                                A05
                            </div>

                            <!-- Row 2 -->
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-emerald-100 text-emerald-800 border border-emerald-200 hover:scale-105 cursor-pointer shadow-sm">
                                A06
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-emerald-100 text-emerald-800 border border-emerald-200 hover:scale-105 cursor-pointer shadow-sm">
                                A07
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-rose-100 text-rose-800 border border-rose-200 hover:scale-105 cursor-pointer shadow-sm">
                                A08
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-rose-100 text-rose-800 border border-rose-200 hover:scale-105 cursor-pointer shadow-sm">
                                A09
                            </div>
                            <div class="slot-item py-4 rounded-xl text-center text-xs font-bold transition-all bg-emerald-100 text-emerald-800 border border-emerald-200 hover:scale-105 cursor-pointer shadow-sm">
                                A10
                            </div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="flex items-center justify-center gap-6 pt-6 border-t border-slate-100 text-xs text-slate-600">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <span>Available</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                            <span>Occupied</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                            <span>Reserved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DESIGNED FOR MODERN MOBILITY SECTION -->
    <section class="py-16 sm:py-20 bg-slate-50/60 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Designed for <span class="text-blue-600">Modern Mobility</span>
                </h2>
                <p class="mt-3 text-slate-500 text-sm sm:text-base">
                    Everything you need for a frictionless parking experience.
                </p>
            </div>

            <!-- 4 Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1: ANPR Recognition -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <circle cx="12" cy="13" r="3"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">ANPR Recognition</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Auto vehicle identification with license plate.</p>
                </div>

                <!-- 2: Ticketless Parking -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Ticketless Parking</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Enter and exit without a physical ticket.</p>
                </div>

                <!-- 3: Real-Time Availability -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Real-Time Availability</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Get live slot updates and avoid the hassle of searching.</p>
                </div>

                <!-- 4: Digital Payment -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="5" width="20" height="14" rx="2"/>
                            <line x1="2" y1="10" x2="22" y2="10"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Digital Payment</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Pay easily with QRIS, e-wallets, or bank cards.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY DRIVERS CHOOSE NUSAPARK SECTION -->
    <section class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                <!-- Left Image: Parking Booth -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-[2rem] overflow-hidden shadow-xl aspect-[16/10] bg-slate-900 border border-slate-100 group">
                        <img src="{{ asset('images/parking-booth.jpg') }}" alt="NusaPark Smart Barrier Gate" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                    </div>
                </div>

                <!-- Right Content: Why Choose NusaPark -->
                <div class="lg:col-span-6 space-y-6">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Why Drivers Choose <span class="text-blue-600">NusaPark</span>
                    </h2>

                    <div class="space-y-5 pt-2">
                        <!-- 1 -->
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Faster parking discovery</h4>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Find available slots in seconds.</p>
                            </div>
                        </div>

                        <!-- 2 -->
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Higher convenience</h4>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">From entry to payment, all in one app.</p>
                            </div>
                        </div>

                        <!-- 3 -->
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Safe and reliable</h4>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Monitored and secured parking environment.</p>
                            </div>
                        </div>

                        <!-- 4 -->
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Modern technology</h4>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Powered by IoT and AI for a smarter experience.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NATIONAL INDONESIA SCALE STATS BANNER -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#0B1528] rounded-[2.5rem] p-8 sm:p-12 lg:p-14 text-white shadow-2xl relative overflow-hidden border border-slate-800">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Left Headline -->
                    <div class="lg:col-span-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight">
                            One Parking Platform.<br>
                            Connected Across Indonesia.
                        </h2>
                    </div>

                    <!-- Right Stats (4 Columns) -->
                    <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center sm:text-left">
                        <!-- Stat 1: Locations -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-center sm:justify-start gap-2 text-blue-400 font-extrabold text-2xl sm:text-3xl">
                                <svg class="w-5 h-5 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                4,821+
                            </div>
                            <p class="text-xs text-slate-400">Locations</p>
                        </div>

                        <!-- Stat 2: Slots -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-center sm:justify-start gap-2 text-white font-extrabold text-2xl sm:text-3xl">
                                <span class="w-5 h-5 rounded-md bg-blue-600 flex items-center justify-center text-[10px] font-black text-white shrink-0">P</span>
                                3.4M+
                            </div>
                            <p class="text-xs text-slate-400">Parking Slots</p>
                        </div>

                        <!-- Stat 3: Vehicles -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-center sm:justify-start gap-2 text-white font-extrabold text-2xl sm:text-3xl">
                                <svg class="w-5 h-5 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                                8.9M+
                            </div>
                            <p class="text-xs text-slate-400">Vehicles Today</p>
                        </div>

                        <!-- Stat 4: Transactions -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-center sm:justify-start gap-2 text-blue-400 font-extrabold text-2xl sm:text-3xl">
                                <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                12M+
                            </div>
                            <p class="text-xs text-slate-400">Transactions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COMMON QUESTIONS (FAQ) SECTION -->
    <section class="py-16 sm:py-24" id="faq">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14">
                <!-- Left Title -->
                <div class="lg:col-span-5">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Common<br>
                        <span class="text-blue-600">Questions</span>
                    </h2>
                    <p class="mt-4 text-slate-500 text-sm sm:text-base leading-relaxed">
                        Everything you need to know about parking with NusaPark.
                    </p>
                    <div class="mt-8">
                        <a href="/faq" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700">
                            View full Help Center
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Accordion List -->
                <div class="lg:col-span-7 space-y-3.5" id="faq-accordion">
                    <!-- Q1 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                        <button type="button" class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                            <span>How does ticketless parking work?</span>
                            <span class="faq-icon text-slate-400 font-bold text-xl transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-body hidden px-6 pb-5 text-xs sm:text-sm text-slate-500 leading-relaxed border-t border-slate-100 pt-3">
                            Our advanced ANPR (Automatic Number Plate Recognition) cameras scan your license plate as you approach the barrier. If your vehicle is registered or you have the app active, the barrier opens automatically within milliseconds.
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                        <button type="button" class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                            <span>Is my payment information secure?</span>
                            <span class="faq-icon text-slate-400 font-bold text-xl transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-body hidden px-6 pb-5 text-xs sm:text-sm text-slate-500 leading-relaxed border-t border-slate-100 pt-3">
                            Yes. We use bank-level encryption (AES-256) and PCI-DSS certified payment processors. We do not store your raw credit card numbers or banking passwords.
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                        <button type="button" class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                            <span>How accurate is the real-time availability?</span>
                            <span class="faq-icon text-slate-400 font-bold text-xl transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-body hidden px-6 pb-5 text-xs sm:text-sm text-slate-500 leading-relaxed border-t border-slate-100 pt-3">
                            Our data is synchronized every 3 seconds directly with on-ground ultrasonic sensors and entrance/exit barrier cameras, ensuring over 99.5% accuracy.
                        </div>
                    </div>

                    <!-- Q4 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                        <button type="button" class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                            <span>Can I reserve a parking spot in advance?</span>
                            <span class="faq-icon text-slate-400 font-bold text-xl transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-body hidden px-6 pb-5 text-xs sm:text-sm text-slate-500 leading-relaxed border-t border-slate-100 pt-3">
                            Yes! At participating locations such as malls, train stations, and airports, you can reserve a spot up to 24 hours ahead through the NusaPark mobile app or web platform.
                        </div>
                    </div>

                    <!-- Q5 -->
                    <div class="faq-card bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                        <button type="button" class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                            <span>What happens if the ANPR camera can't read my plate?</span>
                            <span class="faq-icon text-slate-400 font-bold text-xl transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-body hidden px-6 pb-5 text-xs sm:text-sm text-slate-500 leading-relaxed border-t border-slate-100 pt-3">
                            In case of extreme weather or a dirty license plate, you can instantly scan a dynamic QR code generated in your NusaPark app, or tap a registered contactless card at the gate terminal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOTTOM CTA BANNER -->
    <section class="py-12 sm:py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2.5rem] bg-gradient-to-r from-blue-50/80 via-indigo-50/60 to-blue-50/80 border border-blue-100/90 py-12 px-6 sm:px-12 text-center shadow-sm">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-8">
                    Make every parking journey simpler.
                </h2>
                <div class="flex flex-wrap items-center justify-center gap-3.5">
                    <a href="/search" class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/25 transition-all">
                        Find Parking
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                    <a href="/locations" class="inline-flex items-center px-7 py-3 rounded-full bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm border border-slate-200/90 shadow-sm transition-all hover:border-slate-300">
                        Explore Locations
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer />

    <!-- JAVASCRIPT FOR INTERACTIVITY -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Accordion Toggle
            const faqCards = document.querySelectorAll('.faq-card');
            faqCards.forEach(card => {
                const toggle = card.querySelector('.faq-toggle');
                const body = card.querySelector('.faq-body');
                const icon = card.querySelector('.faq-icon');

                toggle.addEventListener('click', () => {
                    const isOpen = !body.classList.contains('hidden');
                    
                    // Close others
                    faqCards.forEach(c => {
                        c.querySelector('.faq-body').classList.add('hidden');
                        c.querySelector('.faq-icon').textContent = '+';
                        c.classList.remove('border-blue-200', 'shadow-md');
                    });

                    if (!isOpen) {
                        body.classList.remove('hidden');
                        icon.textContent = '−';
                        card.classList.add('border-blue-200', 'shadow-md');
                    }
                });
            });

            // Interactive Floor Tabs in Parking Map
            const floorBtns = document.querySelectorAll('.floor-btn');
            const slotItems = document.querySelectorAll('.slot-item');

            // Sample slot state configurations for different floors
            const floorData = {
                'B1': [
                    { id: 'A01', status: 'available' }, { id: 'A02', status: 'occupied' },
                    { id: 'A03', status: 'available' }, { id: 'A04', status: 'reserved' },
                    { id: 'A05', status: 'reserved' }, { id: 'A06', status: 'available' },
                    { id: 'A07', status: 'available' }, { id: 'A08', status: 'occupied' },
                    { id: 'A09', status: 'occupied' }, { id: 'A10', status: 'available' }
                ],
                'B2': [
                    { id: 'B01', status: 'occupied' }, { id: 'B02', status: 'available' },
                    { id: 'B03', status: 'available' }, { id: 'B04', status: 'available' },
                    { id: 'B05', status: 'occupied' }, { id: 'B06', status: 'occupied' },
                    { id: 'B07', status: 'reserved' }, { id: 'B08', status: 'available' },
                    { id: 'B09', status: 'available' }, { id: 'B10', status: 'occupied' }
                ],
                'L1': [
                    { id: 'L01', status: 'available' }, { id: 'L02', status: 'available' },
                    { id: 'L03', status: 'occupied' }, { id: 'L04', status: 'occupied' },
                    { id: 'L05', status: 'available' }, { id: 'L06', status: 'reserved' },
                    { id: 'L07', status: 'available' }, { id: 'L08', status: 'available' },
                    { id: 'L09', status: 'occupied' }, { id: 'L10', status: 'available' }
                ],
                'L2': [
                    { id: 'U01', status: 'reserved' }, { id: 'U02', status: 'occupied' },
                    { id: 'U03', status: 'available' }, { id: 'U04', status: 'available' },
                    { id: 'U05', status: 'available' }, { id: 'U06', status: 'available' },
                    { id: 'U07', status: 'occupied' }, { id: 'U08', status: 'available' },
                    { id: 'U09', status: 'available' }, { id: 'U10', status: 'available' }
                ]
            };

            const classMap = {
                available: 'bg-emerald-100 text-emerald-800 border-emerald-200',
                occupied: 'bg-rose-100 text-rose-800 border-rose-200',
                reserved: 'bg-amber-100 text-amber-800 border-amber-200'
            };

            floorBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update active button styling
                    floorBtns.forEach(b => {
                        b.classList.remove('bg-blue-600', 'text-white', 'shadow-sm', 'font-bold');
                        b.classList.add('text-slate-600', 'hover:bg-slate-100', 'font-semibold');
                    });
                    btn.classList.add('bg-blue-600', 'text-white', 'shadow-sm', 'font-bold');
                    btn.classList.remove('text-slate-600', 'hover:bg-slate-100', 'font-semibold');

                    const floor = btn.dataset.floor;
                    const slots = floorData[floor] || floorData['B1'];

                    // Update slot items with smooth animation
                    slotItems.forEach((slotEl, idx) => {
                        if (slots[idx]) {
                            slotEl.style.opacity = '0.3';
                            slotEl.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                slotEl.textContent = slots[idx].id;
                                slotEl.className = 'slot-item py-4 rounded-xl text-center text-xs font-bold transition-all border hover:scale-105 cursor-pointer shadow-sm ' + classMap[slots[idx].status];
                                slotEl.style.opacity = '1';
                                slotEl.style.transform = 'scale(1)';
                            }, 150);
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>