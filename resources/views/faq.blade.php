<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Help Center - NusaPark</title>
    <meta name="description" content="Find quick answers about parking, payments, locations, reservations, and your NusaPark experience.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50/60 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <x-navbar active="faq" />

    <!-- SVG ClipPath Definition for the Organic S-Curve in Hero -->
    <svg width="0" height="0" class="absolute pointer-events-none">
        <defs>
            <clipPath id="faq-organic-curve" clipPathUnits="objectBoundingBox">
                <path d="M 0.18,0 
                         C 0.08,0.14 0,0.28 0,0.44 
                         C 0,0.62 0.06,0.76 0.22,0.88 
                         C 0.38,0.97 0.65,1 1,1 
                         L 1,0 Z" />
            </clipPath>
        </defs>
    </svg>

    <main class="flex-grow">
        <!-- HERO & SEARCH SECTION (NAVY WITH S-CURVE GARAGE BACKGROUND) -->
        <section class="relative overflow-hidden pt-8 pb-16 lg:pt-12 lg:pb-20 bg-slate-950 text-white">
            
            <!-- Desktop Right Curved Graphic with Parking Photo -->
            <div class="hidden lg:block absolute top-0 right-0 bottom-0 w-[50%] xl:w-[48%] z-0 pointer-events-none">
                <div class="relative w-full h-full overflow-hidden shadow-2xl bg-slate-900" style="clip-path: url(#faq-organic-curve);">
                    <img src="{{ asset('images/hero-parking.jpg') }}" alt="NusaPark Support Parking" class="w-full h-full object-cover object-center opacity-70 scale-105 hover:scale-100 transition-transform duration-1000" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-2xl">
                    <!-- Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-semibold mb-6">
                        <svg class="w-3.5 h-3.5 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                        </svg>
                        <span>Help Center</span>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white mb-4 leading-tight">
                        How Can We <span class="text-blue-400">Help You?</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8 max-w-xl">
                        Find quick answers about parking, payments, locations, reservations, and your NusaPark experience.
                    </p>

                    <!-- Search Input Bar -->
                    <div class="relative max-w-2xl bg-white rounded-2xl p-1.5 shadow-2xl flex items-center mb-5">
                        <div class="pl-4 text-slate-400">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </div>
                        <input type="text" id="faqSearchInput" oninput="handleFaqSearch(this.value)" placeholder="Search for answers, e.g. &quot;How is the parking fee calculated?&quot;" class="w-full px-3 py-3 text-sm text-slate-800 placeholder-slate-400 bg-transparent focus:outline-none" />
                        <button type="button" onclick="performSearchClick()" class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs tracking-wide shadow-md transition-all shrink-0">
                            Search
                        </button>
                    </div>

                    <!-- Popular Searches Pills -->
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-400">
                        <span class="font-medium text-slate-300">Popular searches:</span>
                        <button type="button" onclick="applyQuickSearch('Parking fee')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-colors">
                            <svg class="w-3 h-3 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
                            <span>Parking fee</span>
                        </button>
                        <button type="button" onclick="applyQuickSearch('Payment methods')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-colors">
                            <svg class="w-3 h-3 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            <span>Payment methods</span>
                        </button>
                        <button type="button" onclick="applyQuickSearch('Gate issue')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-colors">
                            <svg class="w-3 h-3 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                            <span>Gate issue</span>
                        </button>
                        <button type="button" onclick="applyQuickSearch('Find location')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-colors">
                            <svg class="w-3 h-3 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>Find location</span>
                        </button>
                    </div>

                </div>
            </div>
        </section>

        <!-- 7 CATEGORY TABS BAR -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-8 relative z-20">
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4" id="categoryTabs">
                
                <!-- Tab 1: All Questions (Active) -->
                <button type="button" onclick="filterByCategory('all', this)" class="cat-tab active p-4 rounded-2xl bg-white border-2 border-blue-600 shadow-md shadow-blue-500/10 text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-blue-700">All Questions</div>
                    <div class="text-[10px] text-blue-500 font-medium">View all FAQs</div>
                </button>

                <!-- Tab 2: Getting Started -->
                <button type="button" onclick="filterByCategory('getting-started', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Getting Started</div>
                    <div class="text-[10px] text-slate-500 font-medium">New to NusaPark?</div>
                </button>

                <!-- Tab 3: Find Parking -->
                <button type="button" onclick="filterByCategory('find-parking', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Find Parking</div>
                    <div class="text-[10px] text-slate-500 font-medium">Search & availability</div>
                </button>

                <!-- Tab 4: Pricing -->
                <button type="button" onclick="filterByCategory('pricing', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Pricing</div>
                    <div class="text-[10px] text-slate-500 font-medium">Rates & charges</div>
                </button>

                <!-- Tab 5: Enter & Exit -->
                <button type="button" onclick="filterByCategory('enter-exit', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Enter & Exit</div>
                    <div class="text-[10px] text-slate-500 font-medium">Gate, ticket, ANPR</div>
                </button>

                <!-- Tab 6: Payment -->
                <button type="button" onclick="filterByCategory('payment', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Payment</div>
                    <div class="text-[10px] text-slate-500 font-medium">Methods & issues</div>
                </button>

                <!-- Tab 7: Reservation -->
                <button type="button" onclick="filterByCategory('reservation', this)" class="cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div class="text-xs font-extrabold text-slate-900">Reservation</div>
                    <div class="text-[10px] text-slate-500 font-medium">Booking & changes</div>
                </button>

            </div>
        </section>

        <!-- MAIN TWO-COLUMN SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- LEFT COLUMN: "STILL NEED HELP?" SUPPORT CARD -->
                <div class="lg:col-span-4 xl:col-span-4 sticky top-24">
                    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/40 p-6 sm:p-7 text-center">
                        
                        <!-- 3D Support Headset Avatar Graphic -->
                        <div class="w-20 h-20 mx-auto rounded-3xl bg-gradient-to-tr from-blue-500 to-cyan-400 p-0.5 shadow-lg shadow-blue-500/20 mb-4 flex items-center justify-center">
                            <div class="w-full h-full bg-blue-50 rounded-[22px] flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/faq-headset.png') }}" alt="Support Headset" class="w-14 h-auto object-contain drop-shadow" />
                            </div>
                        </div>

                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight mb-1.5">
                            Still need help?
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                            Our support team is ready to assist you.
                        </p>

                        <!-- Action Buttons -->
                        <div class="space-y-3 mb-6">
                            <a href="https://wa.me/6281234567890?text=Halo%20NusaPark%20Support" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm shadow-md shadow-blue-500/20 transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                <span>Contact Support</span>
                            </a>
                            <a href="mailto:support@nusapark.id" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs sm:text-sm border border-slate-200 transition-all">
                                <svg class="w-4 h-4 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                <span>Send an Email</span>
                            </a>
                        </div>

                        <!-- Support Hours -->
                        <div class="p-3.5 rounded-2xl bg-blue-50/70 border border-blue-100 flex items-center gap-3 text-left">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-slate-900">Support Hours</div>
                                <div class="text-[10px] text-slate-500">Mon - Sun, 08:00 - 22:00 WIB</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: QUESTIONS & ACCORDION LIST -->
                <div class="lg:col-span-8 xl:col-span-8 space-y-8">
                    
                    <!-- POPULAR QUESTIONS (2X2 GRID) -->
                    <div id="popularSection" class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7">
                        <div class="mb-5">
                            <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Popular Questions</h3>
                            <p class="text-xs text-slate-500">The most common questions from NusaPark users.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <!-- Card 1 -->
                            <button type="button" onclick="openFaqById('faq-05')" class="p-4 rounded-xl border border-slate-200/80 hover:border-blue-400 hover:bg-blue-50/30 text-left transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    </div>
                                    <span class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">How is my parking fee calculated?</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>

                            <!-- Card 2 -->
                            <button type="button" onclick="openFaqById('faq-09')" class="p-4 rounded-xl border border-slate-200/80 hover:border-blue-400 hover:bg-blue-50/30 text-left transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    </div>
                                    <span class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">What payment methods does NusaPark support?</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>

                            <!-- Card 3 -->
                            <button type="button" onclick="openFaqById('faq-08')" class="p-4 rounded-xl border border-slate-200/80 hover:border-blue-400 hover:bg-blue-50/30 text-left transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <span class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">What happens when I enter?</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>

                            <!-- Card 4 -->
                            <button type="button" onclick="openFaqById('faq-02')" class="p-4 rounded-xl border border-slate-200/80 hover:border-blue-400 hover:bg-blue-50/30 text-left transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                    </div>
                                    <span class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-blue-600 transition-colors">How do I find a parking location?</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- ALL QUESTIONS SECTION -->
                    <div>
                        <div class="mb-4">
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight" id="sectionHeaderTitle">All Questions</h2>
                            <p class="text-xs sm:text-sm text-slate-500" id="sectionHeaderDesc">Browse all available frequently asked questions.</p>
                        </div>

                        <!-- Accordion List Container -->
                        <div class="space-y-3" id="faqAccordionContainer">
                            
                            <!-- FAQ 01 (Open by default) -->
                            <div class="faq-row bg-blue-50/60 rounded-2xl border border-blue-200 overflow-hidden transition-all duration-200" data-category="getting-started" id="faq-01">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base">
                                    <span>What is NusaPark?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 text-sm font-black transition-transform">−</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed block border-t border-blue-100 pt-2.5">
                                    NusaPark is a smart parking platform that helps you find, access, and pay for parking easily and securely. We integrate IoT and ANPR (Automatic Number Plate Recognition) to provide a faster, safer, and more convenient parking experience.
                                </div>
                            </div>

                            <!-- FAQ 02 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="find-parking" id="faq-02">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>How do I find a parking location?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    You can use the Find Parking page to explore nearby connected malls, office towers, or transit hubs. You can filter by vehicle type, view slot availability, and navigate directly using GPS.
                                </div>
                            </div>

                            <!-- FAQ 03 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="find-parking" id="faq-03">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Can I see available parking spaces?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Yes! All NusaPark connected properties provide real-time slot occupancy data so you can check exact available, occupied, and reserved spaces before leaving your home.
                                </div>
                            </div>

                            <!-- FAQ 04 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="pricing" id="faq-04">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Are parking rates the same everywhere?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    No. Parking rates are determined by each property management and regional municipality regulations. You can check the specific rate breakdown for each location on our Pricing page.
                                </div>
                            </div>

                            <!-- FAQ 05 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="pricing" id="faq-05">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>How is my parking fee calculated?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Fees are calculated based on your vehicle category (Car, Motorcycle, EV) and duration of stay. Generally, there is an initial base rate for the first hour and an incremental rate for subsequent hours, subject to a daily maximum cap.
                                </div>
                            </div>

                            <!-- FAQ 06 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="pricing" id="faq-06">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Why can the estimated price differ from the final charge?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Estimates reflect your expected duration. Real-world traffic delays or crossing over into a new billing hour threshold by a few minutes will adjust the final timestamp recorded at the barrier gate.
                                </div>
                            </div>

                            <!-- FAQ 07 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="enter-exit" id="faq-07">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>How does vehicle recognition work?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    High-resolution ANPR optical cameras read and verify your license plate digits in under 200 milliseconds as you approach the gate, logging your entry without needing paper tickets.
                                </div>
                            </div>

                            <!-- FAQ 08 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="enter-exit" id="faq-08">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>What happens when I enter?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Drive up slowly to the entrance gate. The ANPR camera will capture your license plate, display your plate number on the screen, raise the barrier, and log your session timestamp in the cloud.
                                </div>
                            </div>

                            <!-- FAQ 09 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="payment" id="faq-09">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>What payment methods does NusaPark support?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    NusaPark supports QRIS (BCA, Mandiri, BRI, BNI, and all Indonesian banking apps), major e-wallets (GoPay, OVO, Dana, ShopeePay), contactless bank cards, and automated in-app debit.
                                </div>
                            </div>

                            <!-- FAQ 10 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="payment" id="faq-10">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>My payment failed. What should I do?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    You can try scanning the QRIS code again with a different banking or e-wallet app, tap an alternative NFC card, or request on-site attendant assistance via the intercom button.
                                </div>
                            </div>

                            <!-- FAQ 11 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="reservation" id="faq-11">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Can I reserve a parking space?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Yes! For selected premium locations and EV charging bays, reservations can be made up to 24 hours in advance through the NusaPark mobile app or website.
                                </div>
                            </div>

                            <!-- FAQ 12 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="getting-started" id="faq-12">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Do I need to log in?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    You can browse parking locations and calculate pricing without logging in. Logging in is recommended to save your vehicle license plate, store receipts, and enable auto-pay.
                                </div>
                            </div>

                            <!-- FAQ 13 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="technical" id="faq-13">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>The parking map is not loading.</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    Ensure your browser has location permission enabled and clear your browser cache. If problems persist, try disabling restrictive ad-blockers for the mapping service.
                                </div>
                            </div>

                            <!-- FAQ 14 -->
                            <div class="faq-row bg-white rounded-2xl border border-slate-200/90 overflow-hidden transition-all duration-200" data-category="enter-exit" id="faq-14">
                                <button type="button" onclick="toggleFaqRow(this)" class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-blue-600 transition-colors">
                                    <span>Why didn't the barrier open?</span>
                                    <span class="faq-icon-pill w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 text-sm font-black transition-transform">+</span>
                                </button>
                                <div class="faq-answer px-5 pb-4 text-xs sm:text-sm text-slate-600 leading-relaxed hidden border-t border-slate-100 pt-2.5">
                                    The gate may pause if the license plate is obscured by mud or heavy glare, or if an exit payment is pending. Simply press the call button on the gate pillar for assistance.
                                </div>
                            </div>

                        </div>

                        <!-- Empty Search Results State -->
                        <div id="noResultsState" class="hidden p-8 text-center bg-white rounded-2xl border border-slate-200">
                            <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 mb-1">No matching questions found</h4>
                            <p class="text-xs text-slate-500 mb-4">Try using broader search terms or contact our support team.</p>
                            <button type="button" onclick="applyQuickSearch('')" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold">Reset Search</button>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- BOTTOM CTA BANNER: READY TO EXPERIENCE SMARTER PARKING? -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white shadow-2xl p-8 sm:p-12 lg:p-14">
                
                <!-- Modern Building Photo on Right -->
                <div class="absolute top-0 right-0 bottom-0 w-full sm:w-1/2 opacity-35 sm:opacity-50 mix-blend-luminosity pointer-events-none">
                    <img src="{{ asset('images/mall-xyz.jpg') }}" alt="NusaPark Smart Parking Hub" class="w-full h-full object-cover object-center" />
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
                </div>

                <div class="relative z-10 max-w-xl">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">
                        Ready to Experience <br>
                        <span class="text-blue-400">Smarter Parking?</span>
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8">
                        Find a parking location, check availability, and enjoy a smoother parking experience.
                    </p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="/search" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs sm:text-sm shadow-lg transition-all">
                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                            <span>Find Parking</span>
                        </a>
                        <a href="/how-it-works" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-blue-600/30 hover:bg-blue-600/50 text-white font-semibold text-xs sm:text-sm backdrop-blur-sm border border-blue-400/30 transition-all">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                            <span>How It Works</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <x-footer />

    <!-- INTERACTIVE FAQ SCRIPTS -->
    <script>
        let currentSelectedCategory = 'all';

        // Toggle Accordion Rows
        function toggleFaqRow(button) {
            const row = button.closest('.faq-row');
            const answer = row.querySelector('.faq-answer');
            const icon = row.querySelector('.faq-icon-pill');
            const isCurrentlyHidden = answer.classList.contains('hidden');

            if (isCurrentlyHidden) {
                // Open this
                answer.classList.remove('hidden');
                icon.textContent = '−';
                row.classList.add('bg-blue-50/60', 'border-blue-200');
                row.classList.remove('bg-white', 'border-slate-200/90');
                icon.classList.add('bg-blue-100', 'text-blue-700');
                icon.classList.remove('bg-slate-100', 'text-slate-500');
            } else {
                // Close this
                answer.classList.add('hidden');
                icon.textContent = '+';
                row.classList.remove('bg-blue-50/60', 'border-blue-200');
                row.classList.add('bg-white', 'border-slate-200/90');
                icon.classList.remove('bg-blue-100', 'text-blue-700');
                icon.classList.add('bg-slate-100', 'text-slate-500');
            }
        }

        // Open specific FAQ from popular quick cards
        function openFaqById(faqId) {
            const target = document.getElementById(faqId);
            if (!target) return;

            // Switch category to all if filtered out
            if (currentSelectedCategory !== 'all') {
                const allTabBtn = document.querySelector('#categoryTabs .cat-tab');
                filterByCategory('all', allTabBtn);
            }

            // Ensure visible
            target.style.display = 'block';
            const answer = target.querySelector('.faq-answer');
            const icon = target.querySelector('.faq-icon-pill');
            
            answer.classList.remove('hidden');
            icon.textContent = '−';
            target.classList.add('bg-blue-50/60', 'border-blue-200');
            target.classList.remove('bg-white', 'border-slate-200/90');
            icon.classList.add('bg-blue-100', 'text-blue-700');
            icon.classList.remove('bg-slate-100', 'text-slate-500');

            // Scroll into view smoothly
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Filter by Category Tabs
        function filterByCategory(categoryKey, btn) {
            currentSelectedCategory = categoryKey;

            // Reset tab styles
            document.querySelectorAll('#categoryTabs .cat-tab').forEach(b => {
                b.className = 'cat-tab p-4 rounded-2xl bg-white border border-slate-200/90 hover:border-slate-300 hover:bg-slate-50 shadow-sm text-left transition-all duration-200';
                const iconBox = b.querySelector('div:first-child');
                if (iconBox) iconBox.className = 'w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-2.5';
                const title = b.querySelector('div:nth-child(2)');
                if (title) title.className = 'text-xs font-extrabold text-slate-900';
                const sub = b.querySelector('div:nth-child(3)');
                if (sub) sub.className = 'text-[10px] text-slate-500 font-medium';
            });

            // Set active tab style
            btn.className = 'cat-tab active p-4 rounded-2xl bg-white border-2 border-blue-600 shadow-md shadow-blue-500/10 text-left transition-all duration-200';
            const activeIconBox = btn.querySelector('div:first-child');
            if (activeIconBox) activeIconBox.className = 'w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-2.5';
            const activeTitle = btn.querySelector('div:nth-child(2)');
            if (activeTitle) activeTitle.className = 'text-xs font-extrabold text-blue-700';
            const activeSub = btn.querySelector('div:nth-child(3)');
            if (activeSub) activeSub.className = 'text-[10px] text-blue-500 font-medium';

            // Filter rows
            const rows = document.querySelectorAll('#faqAccordionContainer .faq-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const cat = row.getAttribute('data-category');
                if (categoryKey === 'all' || cat === categoryKey) {
                    row.style.display = 'block';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update titles
            const titleEl = document.getElementById('sectionHeaderTitle');
            const descEl = document.getElementById('sectionHeaderDesc');
            if (categoryKey === 'all') {
                titleEl.textContent = 'All Questions';
                descEl.textContent = 'Browse all available frequently asked questions.';
            } else {
                titleEl.textContent = btn.querySelector('div:nth-child(2)')?.textContent || 'Questions';
                descEl.textContent = `Showing questions for ${titleEl.textContent}.`;
            }
        }

        // Live Search Handler
        function handleFaqSearch(keyword) {
            const query = (keyword || '').toLowerCase().trim();
            const rows = document.querySelectorAll('#faqAccordionContainer .faq-row');
            const noResults = document.getElementById('noResultsState');
            let matchCount = 0;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = 'block';
                    matchCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (matchCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        // Quick Search Pill Click
        function applyQuickSearch(term) {
            const input = document.getElementById('faqSearchInput');
            if (input) {
                input.value = term;
                handleFaqSearch(term);
            }
            if (term !== '') {
                const container = document.getElementById('faqAccordionContainer');
                container?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function performSearchClick() {
            const input = document.getElementById('faqSearchInput');
            handleFaqSearch(input?.value || '');
            const container = document.getElementById('faqAccordionContainer');
            container?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    </script>
</body>
</html>
