<x-layouts.app activeNav="dashboard">
    @php
        $firstName = Auth::user() ? (explode(' ', trim(Auth::user()->name))[0] ?? Auth::user()->name) : 'Driver';
    @endphp
    <!-- HEADER -->
    <header class="flex flex-col gap-1">
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)]">Good morning, {{ $firstName }}.</h1>
        <p class="text-[var(--text-muted)] text-sm md:text-base">Here's what's happening with your parking today.</p>
    </header>

    <!-- MAIN DASHBOARD GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

        <!-- LEFT COLUMN (Main Content) -->
        <div class="lg:col-span-8 flex flex-col gap-6 lg:gap-8">

            <!-- CONDITIONAL PRIMARY STATE -->
            @if(isset($hasActiveParking) && $hasActiveParking)
                <!-- STATE A: ACTIVE PARKING -->
                <section class="dashboard-card border-[var(--primary)] border-2 relative overflow-hidden group">
                    <!-- Decorative glow -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-[var(--primary)] rounded-full blur-3xl opacity-10"></div>
                    
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="relative flex h-3 w-3">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--success)] opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-3 w-3 bg-[var(--success)]"></span>
                                    </span>
                                    <span class="text-sm font-semibold text-[var(--success)] tracking-wide uppercase">Currently Parked</span>
                                </div>
                                
                                <h2 class="text-3xl font-bold text-[var(--text)] mb-1">Mall XYZ Jakarta</h2>
                                <p class="text-[var(--text-muted)] flex items-center gap-2 mb-6">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Jakarta Selatan
                                </p>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div class="bg-[var(--background)] p-3 rounded-xl border border-[var(--border)]">
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Vehicle</p>
                                        <p class="font-semibold text-[var(--text)]">B 1234 XYZ</p>
                                    </div>
                                    <div class="bg-[var(--background)] p-3 rounded-xl border border-[var(--border)]">
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Entry</p>
                                        <p class="font-semibold text-[var(--text)]">10:32 AM</p>
                                    </div>
                                    <div class="bg-[var(--background)] p-3 rounded-xl border border-[var(--border)]">
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Duration</p>
                                        <p class="font-semibold text-[var(--text)]">1h 24m</p>
                                    </div>
                                    <div class="bg-[var(--background)] p-3 rounded-xl border border-[var(--border)]">
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Slot</p>
                                        <p class="font-semibold text-[var(--text)]">L2 · B-24</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 bg-blue-50/50 rounded-xl border border-blue-100 mb-6">
                                    <div>
                                        <span class="text-sm font-medium text-[var(--text-muted)] block">Estimated Fee (Live)</span>
                                        <span class="text-xl font-bold text-[var(--text)]">Rp 12.000</span>
                                    </div>
                                    <a href="/payment?type=session" class="bg-[var(--primary)] text-white text-xs font-bold px-4 py-2.5 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm">
                                        Pay Fee &rarr;
                                    </a>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="/active-parking" class="bg-[var(--background)] text-[var(--text)] px-6 py-3 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors text-center flex-1 sm:flex-none">
                                        View Active Session
                                    </a>
                                    <a href="/parking-map" class="bg-[var(--background)] text-[var(--text)] px-6 py-3 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors text-center flex-1 sm:flex-none">
                                        View Map
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <!-- STATE B: NO ACTIVE PARKING -->
                <section class="dashboard-card bg-gradient-to-br from-[var(--surface)] to-[var(--background)] relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1/2 h-full bg-[var(--primary)] opacity-5 transform skew-x-12 translate-x-10"></div>
                    <div class="p-6 md:p-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex-1 text-center md:text-left">
                            <h2 class="text-2xl md:text-3xl font-bold text-[var(--text)] mb-3">Ready to park?</h2>
                            <p class="text-[var(--text-muted)] mb-6 max-w-md mx-auto md:mx-0">Find nearby parking locations, check real-time availability, and secure your spot before you arrive.</p>
                            
                            <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                                <a href="/app/search" class="bg-[var(--primary)] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors shadow-lg shadow-blue-500/20 text-center flex items-center justify-center gap-2">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    Find Parking
                                </a>
                                <a href="/locations" class="bg-[var(--background)] text-[var(--text)] px-6 py-3 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors text-center">
                                    Explore Locations
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block w-32 h-32 opacity-20">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-full h-full text-[var(--primary)]"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                    </div>
                </section>
            @endif

            <!-- QUICK ACTIONS -->
            <section>
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    Quick Actions
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                    <a href="/app/search" class="dashboard-card p-4 flex flex-col items-center justify-center text-center gap-3 hover:border-[var(--primary)] transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-[var(--primary)] flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        <span class="text-sm font-semibold">Find Parking</span>
                    </a>
                    <a href="/parking-map" class="dashboard-card p-4 flex flex-col items-center justify-center text-center gap-3 hover:border-[var(--primary)] transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><map x="2" y="4" width="20" height="16" rx="2"></map><path d="M8 4v16"></path><path d="M16 4v16"></path></svg>
                        </div>
                        <span class="text-sm font-semibold">Parking Map</span>
                    </a>
                    <a href="/reservations" class="dashboard-card p-4 flex flex-col items-center justify-center text-center gap-3 hover:border-[var(--primary)] transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <span class="text-sm font-semibold">Reservations</span>
                    </a>
                    <a href="/vehicles" class="dashboard-card p-4 flex flex-col items-center justify-center text-center gap-3 hover:border-[var(--primary)] transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                        </div>
                        <span class="text-sm font-semibold">My Vehicles</span>
                    </a>
                </div>
            </section>

            <!-- NEARBY PARKING -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold">Parking near you</h3>
                    <a href="/app/search" class="text-sm font-semibold text-[var(--primary)] hover:underline">View all</a>
                </div>
                
                <div class="flex flex-col gap-4">
                    <!-- Location Card 1 -->
                    <div class="dashboard-card p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between hover:border-[var(--primary)] transition-colors cursor-pointer" onclick="window.location.href='/location-detail'">
                        <div class="flex gap-4 items-center">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-[var(--primary)] shrink-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[var(--text)] mb-1">Mall XYZ</h4>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-[var(--text-muted)]">
                                    <span class="flex items-center gap-1"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 2.4 km</span>
                                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-[var(--success)]"></span> Open</span>
                                    <span class="font-semibold text-[var(--success)]">327 slots available</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 w-full sm:w-auto mt-2 sm:mt-0 justify-between sm:justify-end">
                            <div class="text-left sm:text-right">
                                <div class="text-sm font-bold text-[var(--text)]">Rp 5.000</div>
                                <div class="text-xs text-[var(--text-muted)]">per hour</div>
                            </div>
                            <button class="p-2 bg-[var(--background)] border border-[var(--border)] rounded-lg hover:bg-[var(--primary)] hover:text-white transition-colors">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Location Card 2 -->
                    <div class="dashboard-card p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between hover:border-[var(--primary)] transition-colors cursor-pointer" onclick="window.location.href='/location-detail'">
                        <div class="flex gap-4 items-center">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-[var(--primary)] shrink-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[var(--text)] mb-1">Stasiun Sentral</h4>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-[var(--text-muted)]">
                                    <span class="flex items-center gap-1"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 3.1 km</span>
                                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-[var(--warning)]"></span> Open</span>
                                    <span class="font-semibold text-[var(--warning)]">14 slots available</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 w-full sm:w-auto mt-2 sm:mt-0 justify-between sm:justify-end">
                            <div class="text-left sm:text-right">
                                <div class="text-sm font-bold text-[var(--text)]">Rp 4.000</div>
                                <div class="text-xs text-[var(--text-muted)]">per hour</div>
                            </div>
                            <button class="p-2 bg-[var(--background)] border border-[var(--border)] rounded-lg hover:bg-[var(--primary)] hover:text-white transition-colors">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <!-- RIGHT COLUMN (Sidebar context) -->
        <div class="lg:col-span-4 flex flex-col gap-6">

            <!-- UPCOMING RESERVATION -->
            <section class="dashboard-card p-5">
                <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)] mb-4">Upcoming Reservation</h3>
                
                @if(true) <!-- Mock condition: true to show prompt, false to show reservation -->
                    <div class="flex flex-col items-center justify-center py-4 text-center">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <h4 class="font-bold text-[var(--text)] mb-1">Planning ahead?</h4>
                        <p class="text-sm text-[var(--text-muted)] mb-4">Reserve parking at supported locations.</p>
                        <a href="/app/search?filter=reservable" class="text-sm font-semibold text-[var(--primary)] bg-blue-50 px-4 py-2 rounded-lg hover:bg-blue-100 transition-colors">Explore Parking</a>
                    </div>
                @else
                    <!-- Example actual reservation state -->
                @endif
            </section>

            <!-- VEHICLES SUMMARY -->
            <section class="dashboard-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)]">Your Vehicles</h3>
                    <a href="/vehicles" class="text-sm text-[var(--primary)] font-semibold hover:underline">Manage</a>
                </div>
                
                <div class="flex items-center justify-between p-3 border border-[var(--border)] rounded-xl bg-[var(--background)]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                        </div>
                        <div>
                            <div class="font-bold text-[var(--text)] text-sm">Toyota Avanza</div>
                            <div class="text-xs text-[var(--text-muted)] tracking-widest font-mono">B •••• XYZ</div>
                        </div>
                    </div>
                    <span class="text-[10px] uppercase font-bold text-[var(--primary)] bg-blue-50 px-2 py-1 rounded-md">Default</span>
                </div>
            </section>

            <!-- NOTIFICATIONS SUMMARY -->
            <section class="dashboard-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)]">Recent Alerts</h3>
                    <a href="/notifications" class="text-sm text-[var(--primary)] font-semibold hover:underline">View all</a>
                </div>
                
                <div class="flex flex-col gap-3">
                    <div class="flex gap-3 items-start p-2 hover:bg-[var(--background)] rounded-lg transition-colors cursor-pointer">
                        <div class="w-2 h-2 mt-1.5 rounded-full bg-[var(--primary)] shrink-0"></div>
                        <div>
                            <div class="text-sm font-semibold text-[var(--text)]">Parking session completed</div>
                            <div class="text-xs text-[var(--text-muted)]">Mall XYZ · Rp 12.000 paid</div>
                            <div class="text-[10px] text-gray-400 mt-1">Yesterday, 14:20</div>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start p-2 hover:bg-[var(--background)] rounded-lg transition-colors cursor-pointer">
                        <div class="w-2 h-2 mt-1.5 rounded-full bg-transparent border border-gray-300 shrink-0"></div>
                        <div>
                            <div class="text-sm font-semibold text-[var(--text)]">Welcome to NusaPark!</div>
                            <div class="text-xs text-[var(--text-muted)]">Your account is ready to use.</div>
                            <div class="text-[10px] text-gray-400 mt-1">Oct 2, 09:00</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- RECENT ACTIVITY -->
            <section class="dashboard-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)]">Recent Activity</h3>
                    <a href="/history" class="text-sm text-[var(--primary)] font-semibold hover:underline">History</a>
                </div>
                
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[var(--background)] rounded-lg flex items-center justify-center text-[var(--text-muted)]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path></svg>
                            </div>
                            <div>
                                <div class="font-bold text-[var(--text)] text-sm">Mall XYZ</div>
                                <div class="text-xs text-[var(--text-muted)]">Yesterday · 1h 24m</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-[var(--text)] text-sm">Rp 12.000</div>
                            <div class="text-[10px] font-semibold text-[var(--success)] uppercase">Completed</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[var(--background)] rounded-lg flex items-center justify-center text-[var(--text-muted)]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path></svg>
                            </div>
                            <div>
                                <div class="font-bold text-[var(--text)] text-sm">Stasiun Sentral</div>
                                <div class="text-xs text-[var(--text-muted)]">Oct 4 · 4h 10m</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-[var(--text)] text-sm">Rp 20.000</div>
                            <div class="text-[10px] font-semibold text-[var(--success)] uppercase">Completed</div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-layouts.app>
