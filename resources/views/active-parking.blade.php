<x-layouts.app activeNav="active-parking">
    <div class="w-full space-y-6 md:space-y-8">
        
        <!-- HEADER -->
        <header class="flex flex-col gap-1 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)]">Active Parking</h1>
            <p class="text-[var(--text-muted)] text-sm md:text-base">Your current parking session</p>
        </header>

        @if($hasActiveSession)
            <!-- ACTIVE SESSION LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                
                <!-- LEFT COLUMN: PRIMARY CARD -->
                <div class="lg:col-span-8 flex flex-col gap-6 lg:gap-8">
                    
                    <!-- ACTIVE SESSION CARD -->
                    <section class="dashboard-card border-[var(--primary)] border-2 relative overflow-hidden">
                        <!-- Decorative glow -->
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-[var(--primary)] rounded-full blur-3xl opacity-10"></div>
                        
                        <div class="p-6 md:p-8 relative z-10">
                            <!-- Status Label -->
                            <div class="flex items-center gap-3 mb-6 bg-blue-50/50 w-fit px-4 py-2 rounded-lg border border-blue-100">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--success)] opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-[var(--success)]"></span>
                                </span>
                                <div>
                                    <span class="text-sm font-bold text-[var(--text)] tracking-wide uppercase">Active</span>
                                    <p class="text-xs text-[var(--text-muted)] mt-0.5">Your parking session is currently active.</p>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-1">
                                    <h2 class="text-2xl md:text-3xl font-bold text-[var(--text)]">Mall XYZ</h2>
                                    <span class="text-xs font-semibold px-2 py-1 bg-green-100 text-green-700 rounded-md whitespace-nowrap">Open now</span>
                                </div>
                                <p class="text-[var(--text-muted)] flex items-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Jakarta Selatan
                                </p>
                            </div>

                            <!-- Vehicle & Slot Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                <div class="bg-[var(--background)] p-4 rounded-xl border border-[var(--border)] flex items-start gap-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500 shrink-0">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[var(--text-muted)] mb-1 uppercase font-semibold tracking-wider">Vehicle</p>
                                        <p class="font-bold text-[var(--text)] text-sm">Toyota Avanza</p>
                                        <p class="text-xs text-[var(--text-muted)] font-mono mt-0.5">B •••• XYZ</p>
                                    </div>
                                </div>
                                
                                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-[var(--primary)] shrink-0 shadow-sm">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-[var(--primary)] mb-1 uppercase font-semibold tracking-wider opacity-80">Parking Spot</p>
                                        <p class="font-bold text-[var(--primary)] text-lg">B1 · A01</p>
                                        <p class="text-xs text-[var(--primary)] opacity-80 mt-0.5">Zone A</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Timing & Fee -->
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 pt-6 border-t border-[var(--border)]">
                                <div>
                                    <p class="text-xs text-[var(--text-muted)] mb-1 uppercase font-semibold tracking-wider">Entry Time</p>
                                    <p class="font-bold text-[var(--text)] text-lg" id="sessionEntry">10:32 AM</p>
                                </div>
                                <div>
                                    <p class="text-xs text-[var(--text-muted)] mb-1 uppercase font-semibold tracking-wider">Duration</p>
                                    <p class="font-bold text-[var(--text)] text-lg flex items-center gap-2">
                                        <span id="sessionDuration">--</span>
                                    </p>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <div class="flex items-center justify-between md:block">
                                        <p class="text-xs text-[var(--text-muted)] mb-1 uppercase font-semibold tracking-wider">Estimated Fee</p>
                                        <p class="font-bold text-[var(--text)] text-2xl text-[var(--primary)]">Rp 12.000</p>
                                    </div>
                                    <a href="/pricing" class="text-[10px] text-[var(--primary)] font-semibold hover:underline mt-1 inline-block">View parking rates</a>
                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- PAYMENT CONTEXT -->
                    <section class="dashboard-card p-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-400">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-[var(--text)]">Payment required upon exit</h3>
                                    <p class="text-sm text-[var(--text-muted)] mt-0.5">Available methods depend on location.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full uppercase tracking-wide">Unpaid</span>
                                <a href="/payment?type=session" class="bg-[var(--primary)] text-white text-xs font-bold px-4 py-2 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm inline-flex items-center gap-1.5">
                                    <span>Pay Fee</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- RIGHT COLUMN: SECONDARY ACTIONS & CONTEXT -->
                <div class="lg:col-span-4 flex flex-col gap-6 lg:gap-8">
                    
                    <!-- PARKING MAP PREVIEW -->
                    <section class="dashboard-card flex flex-col h-full max-h-96">
                        <div class="p-5 border-b border-[var(--border)] flex items-center justify-between">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)]">Facility Map</h3>
                            <a href="/parking-map" class="text-sm text-[var(--primary)] font-semibold hover:underline">Open Map</a>
                        </div>
                        
                        <div class="flex-1 map-preview-bg relative overflow-hidden cursor-pointer group min-h-[200px]" onclick="window.location.href='/parking-map'">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-32 border-2 dashed border-[var(--primary)] opacity-20 rounded-xl"></div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                <div class="bg-[var(--primary)] text-white px-2 py-1 rounded shadow-lg text-xs font-bold mb-1 group-hover:-translate-y-1 transition-transform">
                                    A01
                                </div>
                                <div class="w-3 h-3 bg-[var(--primary)] rounded-full border-2 border-white shadow-md"></div>
                                <div class="w-8 h-2 bg-black/10 rounded-[100%] mt-1 blur-[2px]"></div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-[var(--surface)] text-sm text-[var(--text-muted)] flex justify-between items-center">
                            <span>Floor: <strong>B1</strong></span>
                            <span>Zone: <strong>Zone A</strong></span>
                        </div>
                    </section>

                    <!-- SESSION TIMELINE -->
                    <section class="dashboard-card p-5">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)] mb-6">Session Timeline</h3>
                        
                        <div class="relative pl-6 border-l-2 border-[var(--border)] space-y-6">
                            <!-- Timeline Item: Current -->
                            <div class="relative">
                                <div class="absolute -left-[31px] bg-[var(--surface)] p-1">
                                    <div class="w-3 h-3 bg-[var(--primary)] rounded-full animate-pulse"></div>
                                </div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-[var(--primary)]">Currently parked</h4>
                                        <p class="text-xs text-[var(--text-muted)] mt-0.5">Session active</p>
                                    </div>
                                    <span class="text-xs font-semibold text-[var(--text-muted)]">Now</span>
                                </div>
                            </div>
                            
                            <!-- Timeline Item: Detection -->
                            <div class="relative">
                                <div class="absolute -left-[31px] bg-[var(--surface)] p-1">
                                    <div class="w-3 h-3 border-2 border-[var(--border)] bg-white rounded-full"></div>
                                </div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-[var(--text)]">Vehicle recognized</h4>
                                        <p class="text-xs text-[var(--text-muted)] mt-0.5">ANPR camera verified plate</p>
                                    </div>
                                    <span class="text-xs font-semibold text-[var(--text-muted)]" id="timelineDetected">10:33 AM</span>
                                </div>
                            </div>

                            <!-- Timeline Item: Entry -->
                            <div class="relative">
                                <div class="absolute -left-[31px] bg-[var(--surface)] p-1">
                                    <div class="w-3 h-3 border-2 border-[var(--border)] bg-white rounded-full"></div>
                                </div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-[var(--text)]">Entered parking</h4>
                                        <p class="text-xs text-[var(--text-muted)] mt-0.5">Barrier opened</p>
                                    </div>
                                    <span class="text-xs font-semibold text-[var(--text-muted)]" id="timelineEntry">10:32 AM</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- MOBILE STICKY ACTION -->
            <div class="md:hidden fixed bottom-16 left-0 w-full p-4 z-40 bg-gradient-to-t from-[var(--background)] to-transparent pointer-events-none">
                <a href="/parking-map" class="pointer-events-auto w-full bg-[var(--primary)] text-white font-bold py-3.5 px-4 rounded-xl shadow-[0_8px_16px_rgba(37,99,235,0.25)] flex items-center justify-center gap-2 hover:bg-[var(--accent)] transition-colors active:scale-[0.98]">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><map x="2" y="4" width="20" height="16" rx="2"></map><path d="M8 4v16"></path><path d="M16 4v16"></path></svg>
                    View Parking Spot
                </a>
            </div>

            @push('scripts')
            <script>
                const backendSessionEntry = new Date();
                backendSessionEntry.setHours(backendSessionEntry.getHours() - 1);
                backendSessionEntry.setMinutes(backendSessionEntry.getMinutes() - 24);

                function formatTime(date) {
                    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                }

                function updateDuration() {
                    const now = new Date();
                    const diffMs = now - backendSessionEntry;
                    const diffMins = Math.floor(diffMs / 60000);
                    
                    const hours = Math.floor(diffMins / 60);
                    const mins = diffMins % 60;
                    
                    let durationStr = '';
                    if (hours > 0) durationStr += `${hours}h `;
                    durationStr += `${mins}m`;
                    
                    document.getElementById('sessionDuration').textContent = durationStr;
                }

                document.getElementById('sessionEntry').textContent = formatTime(backendSessionEntry);
                document.getElementById('timelineEntry').textContent = formatTime(backendSessionEntry);
                
                const detectedTime = new Date(backendSessionEntry.getTime() + 60000);
                document.getElementById('timelineDetected').textContent = formatTime(detectedTime);

                updateDuration();
                setInterval(updateDuration, 60000);
            </script>
            @endpush

        @else
            <!-- EMPTY STATE (NO ACTIVE SESSION) -->
            <div class="flex flex-col items-center justify-center py-16 md:py-32 px-4 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-6">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-[var(--text)] mb-3">You don't have an active parking session</h2>
                <p class="text-[var(--text-muted)] mb-8 max-w-md">Find a parking location to start your next parking session.</p>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="/app/search" class="bg-[var(--primary)] text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Find Parking
                    </a>
                    <a href="/history" class="bg-[var(--background)] text-[var(--text)] px-8 py-3.5 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors flex items-center justify-center">
                        View Parking History
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
