@props(['activeNav' => 'dashboard', 'title' => 'Vendor Dashboard - NusaPark Enterprise'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="text-[var(--text)] bg-[var(--background)] antialiased min-h-screen flex flex-col">

    <div class="flex-1 flex min-h-screen">
        
        <!-- ================= VENDOR SIDEBAR (DESKTOP) ================= -->
        <aside class="hidden lg:flex flex-col w-64 bg-[var(--surface)] border-r border-[var(--border)] shrink-0 select-none z-30 sticky top-0 h-screen">
            <!-- Brand Header -->
            <div class="h-16 flex items-center justify-between px-5 border-b border-[var(--border)]">
                <a href="/vendor/dashboard" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-[var(--primary)] rounded-lg flex items-center justify-center text-white font-bold text-base shadow-sm group-hover:scale-105 transition-transform">
                        N
                    </div>
                    <div>
                        <div class="font-bold text-base tracking-tight text-[var(--primary)] leading-tight">
                            Nusa<span class="text-[var(--accent)]">Park</span>
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Vendor Portal
                        </div>
                    </div>
                </a>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                    Ops
                </span>
            </div>

            <!-- Operator Tenant Chip -->
            <div class="p-3.5 mx-3 my-3 bg-slate-50 border border-[var(--border)] rounded-xl">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Operator Tenant</div>
                <div class="text-xs font-bold text-[var(--text)] truncate mt-0.5">PT Parkir Cipta Nusantara</div>
                <div class="text-[11px] text-[var(--text-muted)] flex items-center gap-1.5 mt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>3 Facilities Active</span>
                </div>
            </div>

            <!-- Navigation Links (Roadmap items) -->
            <nav class="flex-1 overflow-y-auto px-3 space-y-5 py-2 scrollbar-thin">
                
                <!-- Group 1: Operations -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Operations
                    </div>
                    <div class="space-y-0.5 text-xs font-semibold">
                        <a href="/vendor/dashboard" 
                           class="flex items-center gap-2.5 px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'dashboard' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="9"></rect>
                                <rect x="14" y="3" width="7" height="5"></rect>
                                <rect x="14" y="12" width="7" height="9"></rect>
                                <rect x="3" y="16" width="7" height="5"></rect>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="/vendor/locations" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'locations' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>Locations</span>
                            </div>
                            @if($activeNav !== 'locations')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/parking-areas" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'areas' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                <span>Parking Area</span>
                            </div>
                            @if($activeNav !== 'areas')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/parking-map" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'map' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                <span>Parking Map</span>
                            </div>
                            @if($activeNav !== 'map')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/parking-slots" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'slots' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><circle cx="7" cy="15" r="2"></circle><circle cx="17" cy="15" r="2"></circle></svg>
                                <span>Parking Slots</span>
                            </div>
                            @if($activeNav !== 'slots')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/gates" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'gates' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span>Barrier Gates</span>
                            </div>
                            @if($activeNav !== 'gates')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/anpr" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'anpr' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                <span>ANPR Cameras</span>
                            </div>
                            @if($activeNav !== 'anpr')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/iot-devices" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'iot' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line></svg>
                                <span>IoT Devices</span>
                            </div>
                            @if($activeNav !== 'iot')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/parking-sessions" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'sessions' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <span>Parking Sessions</span>
                            </div>
                            @if($activeNav !== 'sessions')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Group 2: Financial & Reports -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Finance & Reports
                    </div>
                    <div class="space-y-0.5 text-xs font-semibold">
                        <a href="/vendor/transactions" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'transactions' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <span>Transactions</span>
                            </div>
                            @if($activeNav !== 'transactions')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/revenue" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'revenue' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <span>Revenue</span>
                            </div>
                            @if($activeNav !== 'revenue')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/reports" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'reports' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                <span>Reports</span>
                            </div>
                            @if($activeNav !== 'reports')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Group 3: Administration -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Administration
                    </div>
                    <div class="space-y-0.5 text-xs font-semibold">
                        <a href="/vendor/staff" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'staff' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Operator Staff</span>
                            </div>
                            @if($activeNav !== 'staff')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/dashboard?notice=subscription_planned" 
                           class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            <span>Subscription</span>
                        </a>

                        <a href="/vendor/billing" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'billing' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line></svg>
                                <span>Billing & Invoices</span>
                            </div>
                            @if($activeNav !== 'billing')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        @php
                            $vdrUnread = app(\App\Services\VendorService::class)->getNotificationUnreadCount();
                        @endphp
                        <a href="/vendor/notifications" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'notifications' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                <span>Notifications</span>
                            </div>
                            @if($vdrUnread > 0)
                            <span class="text-[10px] px-1.5 py-0.2 rounded-full font-bold {{ $activeNav === 'notifications' ? 'bg-white text-[var(--primary)]' : 'bg-red-500 text-white' }}">{{ $vdrUnread }}</span>
                            @elseif($activeNav !== 'notifications')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>

                        <a href="/vendor/settings" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl transition-colors {{ $activeNav === 'settings' ? 'bg-[var(--primary)] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-[var(--primary)]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                <span>Settings</span>
                            </div>
                            @if($activeNav !== 'settings')
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-[var(--accent)] font-semibold">Live</span>
                            @endif
                        </a>
                    </div>
                </div>

            </nav>

            <!-- Sidebar Footer -->
            <div class="p-3 border-t border-[var(--border)]">
                <a href="/dashboard" 
                   class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-100 hover:bg-blue-50 text-[var(--accent)] text-xs font-semibold transition-colors">
                    <span class="flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        Driver Portal
                    </span>
                    <span class="text-[10px] text-slate-400">Exit Ops &rarr;</span>
                </a>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT WRAPPER ================= -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- VENDOR TOPBAR -->
            <header class="h-16 bg-[var(--surface)] border-b border-[var(--border)] sticky top-0 z-20 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
                
                <!-- Left: Mobile Toggle & Tenant Title -->
                <div class="flex items-center gap-3">
                    <button type="button" 
                            id="vendor-mobile-menu-btn"
                            class="lg:hidden p-2 text-slate-500 hover:text-[var(--primary)] rounded-lg hover:bg-slate-100 focus:outline-none"
                            aria-label="Toggle navigation drawer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-700 hidden sm:inline">
                            PT Parkir Cipta Nusantara
                        </span>
                        <span class="text-slate-300 hidden sm:inline">•</span>
                        <span class="text-xs text-[var(--text-muted)] font-medium">
                            Live Smart Gate Operations
                        </span>
                    </div>
                </div>

                <!-- Right: Quick Actions & Operator Menu -->
                <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                    <!-- Notifications Quick Access -->
                    <a href="/vendor/notifications" 
                       class="relative p-2 text-slate-500 hover:text-[var(--primary)] hover:bg-slate-100 rounded-lg transition-colors cursor-pointer" 
                       title="Vendor Operational Notifications ({{ $vdrUnread }} unread)"
                       aria-label="View Operational Notifications">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        @if($vdrUnread > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-red-500 ring-2 ring-white animate-pulse"></span>
                        @endif
                    </a>

                    <!-- Switch to Driver Portal -->
                    <a href="/dashboard" 
                       class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:text-[var(--primary)] bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <circle cx="7" cy="15" r="2"></circle>
                            <circle cx="17" cy="15" r="2"></circle>
                        </svg>
                        <span>Driver View</span>
                    </a>

                    <!-- Operator Profile -->
                    <div class="flex items-center gap-2.5 pl-2 border-l border-[var(--border)]">
                        <div class="w-8 h-8 rounded-full bg-[var(--primary)] text-white font-bold text-xs flex items-center justify-center shadow-xs">
                            BS
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-xs font-bold text-[var(--text)] leading-tight">Budi Santoso</div>
                            <div class="text-[10px] text-[var(--text-muted)]">Operations Lead</div>
                        </div>
                    </div>

                    <!-- Sign Out -->
                    <a href="/logout" 
                       class="p-2 text-slate-400 hover:text-red-600 rounded-lg transition-colors" 
                       title="Sign out of Vendor Portal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </div>

            </header>

            <!-- MAIN BODY -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6 md:space-y-8 max-w-7xl w-full mx-auto">
                {{ $slot }}
            </main>

            <!-- VENDOR FOOTER -->
            <footer class="px-6 py-4 border-t border-[var(--border)] bg-[var(--surface)] text-center text-xs text-slate-400">
                NusaPark Enterprise Operations Platform &copy; 2026 PT NusaPark Digital Indonesia. Authorized Operator Portal.
            </footer>

        </div>

    </div>

    <!-- ================= MOBILE DRAWER BACKDROP ================= -->
    <div id="vendor-mobile-drawer" class="lg:hidden fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" id="vendor-drawer-backdrop"></div>
        <div class="fixed top-0 bottom-0 left-0 w-72 bg-[var(--surface)] shadow-2xl z-10 flex flex-col p-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                <div class="font-bold text-sm text-[var(--primary)]">Vendor Operations Menu</div>
                <button type="button" id="vendor-drawer-close" class="p-1 text-slate-400 hover:text-slate-600">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-3 space-y-1 text-xs font-semibold">
                <a href="/vendor/dashboard" class="block px-3 py-2 rounded-lg {{ $activeNav === 'dashboard' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                <a href="/vendor/locations" class="block px-3 py-2 rounded-lg {{ $activeNav === 'locations' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Locations</a>
                <a href="/vendor/parking-areas" class="block px-3 py-2 rounded-lg {{ $activeNav === 'areas' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Parking Area</a>
                <a href="/vendor/parking-map" class="block px-3 py-2 rounded-lg {{ $activeNav === 'map' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Parking Map</a>
                <a href="/vendor/parking-slots" class="block px-3 py-2 rounded-lg {{ $activeNav === 'slots' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Parking Slots</a>
                <a href="/vendor/gates" class="block px-3 py-2 rounded-lg {{ $activeNav === 'gates' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Barrier Gates</a>
                <a href="/vendor/anpr" class="block px-3 py-2 rounded-lg {{ $activeNav === 'anpr' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">ANPR Cameras</a>
                <a href="/vendor/iot-devices" class="block px-3 py-2 rounded-lg {{ $activeNav === 'iot' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">IoT Devices</a>
                <a href="/vendor/parking-sessions" class="block px-3 py-2 rounded-lg {{ $activeNav === 'sessions' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Parking Sessions</a>
                <a href="/vendor/transactions" class="block px-3 py-2 rounded-lg {{ $activeNav === 'transactions' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Transactions</a>
                <a href="/vendor/revenue" class="block px-3 py-2 rounded-lg {{ $activeNav === 'revenue' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Revenue</a>
                <a href="/vendor/reports" class="block px-3 py-2 rounded-lg {{ $activeNav === 'reports' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Reports</a>
                <a href="/vendor/staff" class="block px-3 py-2 rounded-lg {{ $activeNav === 'staff' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Operator Staff</a>
                <a href="/vendor/billing" class="block px-3 py-2 rounded-lg {{ $activeNav === 'billing' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Billing & Invoices</a>
                <a href="/vendor/notifications" class="flex items-center justify-between px-3 py-2 rounded-lg {{ $activeNav === 'notifications' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    <span>Notifications</span>
                    @if(($vdrUnread ?? 0) > 0)
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full font-bold bg-red-500 text-white">{{ $vdrUnread }}</span>
                    @endif
                </a>
                <a href="/vendor/settings" class="block px-3 py-2 rounded-lg {{ $activeNav === 'settings' ? 'bg-[var(--primary)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">Settings</a>
                <a href="/dashboard" class="block px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100">Driver Portal</a>
                <a href="/logout" class="block px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">Sign Out</a>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const drawer = document.getElementById('vendor-mobile-drawer');
        const openBtn = document.getElementById('vendor-mobile-menu-btn');
        const closeBtn = document.getElementById('vendor-drawer-close');
        const backdrop = document.getElementById('vendor-drawer-backdrop');

        if (openBtn && drawer) {
            openBtn.addEventListener('click', () => drawer.classList.remove('hidden'));
        }
        if (closeBtn && drawer) {
            closeBtn.addEventListener('click', () => drawer.classList.add('hidden'));
        }
        if (backdrop && drawer) {
            backdrop.addEventListener('click', () => drawer.classList.add('hidden'));
        }
    });
</script>
@endpush

    @stack('scripts')
</body>
</html>
