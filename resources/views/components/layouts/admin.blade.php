@props(['activeNav' => 'dashboard', 'title' => 'National Dashboard — Super Admin NusaPark'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="text-slate-800 bg-[#F8FAFC] antialiased min-h-screen flex flex-col font-sans">

    <div class="flex-1 flex min-h-screen">
        
        <!-- ================= SUPER ADMIN SIDEBAR (DESKTOP) ================= -->
        <aside class="hidden lg:flex flex-col w-68 bg-[#0B1120] text-slate-300 border-r border-slate-800 shrink-0 select-none z-30 sticky top-0 h-screen">
            
            <!-- Brand Header -->
            <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800/80 bg-[#090D1A]">
                <a href="/admin/dashboard" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-extrabold text-base shadow-sm shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                        N
                    </div>
                    <div>
                        <div class="font-bold text-base tracking-tight text-white leading-tight">
                            Nusa<span class="text-indigo-400">Park</span>
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Super Admin Portal
                        </div>
                    </div>
                </a>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-950 text-indigo-300 border border-indigo-700/50">
                    Root
                </span>
            </div>

            <!-- National Cluster & Node Status -->
            <div class="p-3 mx-3 my-3 bg-slate-900/90 border border-slate-800 rounded-xl">
                <div class="flex items-center justify-between text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    <span>Cluster Node</span>
                    <span class="flex items-center gap-1 text-emerald-400 font-mono">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Live
                    </span>
                </div>
                <div class="text-xs font-mono font-bold text-slate-100 truncate mt-1">ID-JKT-DC1 (Primary)</div>
                <div class="text-[11px] text-slate-400 flex items-center justify-between mt-1 pt-1 border-t border-slate-800/80">
                    <span>Latency: 82ms</span>
                    <span class="text-emerald-400 font-medium">99.98% SLA</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto px-3 space-y-5 py-2 scrollbar-thin text-xs">
                
                <!-- Group 1: Executive Oversight -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Executive Oversight
                    </div>
                    <div class="space-y-1">
                        <!-- Page 37: National Dashboard (Active) -->
                        <a href="/admin/dashboard" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'dashboard' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="9"></rect>
                                    <rect x="14" y="3" width="7" height="5"></rect>
                                    <rect x="14" y="12" width="7" height="9"></rect>
                                    <rect x="3" y="16" width="7" height="5"></rect>
                                </svg>
                                <span>National Dashboard</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-indigo-500/30 text-indigo-200 font-mono font-semibold">P37</span>
                        </a>

                        <!-- Page 38: Indonesia Map (Page 38) -->
                        <a href="/admin/map" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'map' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                    <line x1="8" y1="2" x2="8" y2="18"></line>
                                    <line x1="16" y1="6" x2="16" y2="22"></line>
                                </svg>
                                <span>Indonesia Map</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'map' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P38</span>
                        </a>
                    </div>
                </div>

                <!-- Group 2: Tenant & Location Operations -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Multi-Tenant Operations
                    </div>
                    <div class="space-y-1">
                        <!-- Page 39: Tenant Management (Page 39) -->
                        <a href="/admin/tenants" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'tenants' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Tenant Management</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'tenants' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P39</span>
                        </a>

                        <!-- Page 40: Location Registry -->
                        <a href="/admin/locations" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'locations' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Location Management</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'locations' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P40</span>
                        </a>

                        <!-- Page 41: User Management -->
                        <a href="/admin/users" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'users' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>User Management</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'users' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P41</span>
                        </a>

                        <!-- Page 42: IoT Monitoring -->
                        <a href="/admin/iot" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'iot' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                    <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                    <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                </svg>
                                <span>IoT Monitoring</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'iot' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P42</span>
                        </a>
                    </div>
                </div>

                <!-- Group 3: Financial Operations -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Financial Operations
                    </div>
                    <div class="space-y-1">
                        <!-- Page 43: Transaction Monitoring -->
                        <a href="/admin/transactions" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'transactions' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                                <span>Transactions</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'transactions' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P43</span>
                        </a>

                        <!-- Page 44: Revenue Analytics -->
                        <a href="/admin/revenue" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'revenue' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                <span>Revenue Analytics</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'revenue' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P44</span>
                        </a>

                        <!-- Page 45: Subscription Management -->
                        <a href="/admin/subscriptions" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'subscriptions' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                                <span>Subscriptions</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'subscriptions' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P45</span>
                        </a>

                        <!-- Page 46: Billing Platform -->
                        <a href="/admin/billing" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'billing' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span>Billing Platform</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'billing' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P46</span>
                        </a>
                    </div>
                </div>

                <!-- Group 4: Platform Reliability & Ops -->
                <div>
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">
                        Platform Reliability
                    </div>
                    <div class="space-y-1">
                        <!-- Page 47: System Health -->
                        <a href="/admin/system-health" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'system-health' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>
                                <span>System Health</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'system-health' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P47</span>
                        </a>

                        <!-- Page 48: Operational Alerts -->
                        <a href="/admin/alerts" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'alerts' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span>Alerts</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'alerts' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P48</span>
                        </a>

                        <!-- Page 49: Incident Management -->
                        <a href="/admin/incidents" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'incidents' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                <span>Incidents</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'incidents' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P49</span>
                        </a>

                        <!-- Page 50: API Management -->
                        <a href="/admin/api-management" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'api-management' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="16 18 22 12 16 6"></polyline>
                                    <polyline points="8 6 2 12 8 18"></polyline>
                                </svg>
                                <span>API Management</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'api-management' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P50</span>
                        </a>

                        <!-- Page 51: Audit Logs -->
                        <a href="/admin/audit-logs" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'audit-logs' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                <span>Audit Logs</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'audit-logs' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P51</span>
                        </a>

                        <!-- Page 52: Roles & Permissions -->
                        <a href="/admin/roles-permissions" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'roles-permissions' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Roles & Permissions</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'roles-permissions' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P52</span>
                        </a>

                        <!-- Page 53: Platform Settings -->
                        <a href="/admin/platform-settings" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'platform-settings' ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white font-medium' }}">
                            <div class="flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                                <span>Platform Settings</span>
                            </div>
                            <span class="text-[9px] px-1.5 py-0.5 rounded font-mono font-semibold {{ $activeNav === 'platform-settings' ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-800 text-slate-400' }}">P53</span>
                        </a>
                    </div>
                </div>

            </nav>

            <!-- Sidebar Footer & Portal Switcher -->
            <div class="p-3 border-t border-slate-800/80 bg-[#090D1A] space-y-2">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-1">
                    Fast Portal Switcher
                </div>
                <a href="/vendor/dashboard" 
                   class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-semibold transition-colors border border-slate-800">
                    <span class="flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                        Vendor Portal
                    </span>
                    <span class="text-[10px] text-slate-400">&rarr;</span>
                </a>

                <a href="/dashboard" 
                   class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-semibold transition-colors border border-slate-800">
                    <span class="flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        Driver Portal
                    </span>
                    <span class="text-[10px] text-slate-400">&rarr;</span>
                </a>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT WRAPPER ================= -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- SUPER ADMIN TOPBAR -->
            <header class="h-16 bg-[#0B1120] text-slate-200 border-b border-slate-800 sticky top-0 z-20 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
                
                <!-- Left: Mobile Toggle & Context -->
                <div class="flex items-center gap-3">
                    <button type="button" 
                            id="admin-mobile-menu-btn"
                            class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 focus:outline-none"
                            aria-label="Toggle navigation drawer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-white hidden sm:inline">
                            National Command Center
                        </span>
                        <span class="text-slate-600 hidden sm:inline">•</span>
                        <span class="text-xs text-slate-400 font-medium hidden md:inline">
                            Live Multi-Tenant Telemetry (6 Provinces)
                        </span>
                    </div>
                </div>

                <!-- Right: Quick Status & Super Admin Profile -->
                <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                    
                    <!-- System SLA Badge -->
                    <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] font-mono text-emerald-400">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                        <span>99.98% SLA</span>
                    </div>

                    <!-- Super Admin Profile Badge -->
                    <div class="flex items-center gap-2.5 pl-2 border-l border-slate-800">
                        <div class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                            SA
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-xs font-bold text-white leading-tight">Super Admin</div>
                            <div class="text-[10px] text-indigo-400 font-mono">National Root Ops</div>
                        </div>
                    </div>

                    <!-- Sign Out -->
                    <a href="/logout" 
                       class="p-2 text-slate-400 hover:text-rose-400 rounded-lg hover:bg-slate-800 transition-colors" 
                       title="Sign out of Super Admin Portal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </div>
            </header>

            <!-- MOBILE NAVIGATION DRAWER -->
            <div id="admin-mobile-drawer" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-xs hidden lg:hidden">
                <div class="w-72 max-w-[85vw] h-full bg-[#0B1120] text-slate-300 flex flex-col p-4 shadow-2xl">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-extrabold text-sm">N</div>
                            <div class="font-bold text-sm text-white">NusaPark Super Admin</div>
                        </div>
                        <button type="button" id="admin-close-mobile-drawer" class="p-1.5 text-slate-400 hover:text-white rounded-lg">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>

                    <div class="my-4 p-3 bg-slate-900 border border-slate-800 rounded-xl text-xs">
                        <div class="text-[10px] font-bold uppercase text-slate-400">Node Status</div>
                        <div class="font-mono text-emerald-400 font-bold mt-0.5">ID-JKT-DC1 (Operational)</div>
                    </div>

                    <nav class="flex-1 space-y-1 text-xs">
                        <a href="/admin/dashboard" class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-indigo-600 text-white font-bold">
                            <span>National Dashboard</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-indigo-500/30">P37</span>
                        </a>
                        <a href="/admin/map" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'map' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Indonesia Map</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'map' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P38</span>
                        </a>
                        <a href="/admin/tenants" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'tenants' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Tenant Management</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'tenants' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P39</span>
                        </a>
                        <a href="/admin/locations" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'locations' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Location Management</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'locations' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P40</span>
                        </a>
                        <a href="/admin/users" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'users' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>User Management</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'users' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P41</span>
                        </a>
                        <a href="/admin/iot" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'iot' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>IoT Monitoring</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'iot' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P42</span>
                        </a>
                        <a href="/admin/transactions" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'transactions' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Transactions</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'transactions' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P43</span>
                        </a>
                        <a href="/admin/revenue" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'revenue' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Revenue Analytics</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'revenue' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P44</span>
                        </a>
                        <a href="/admin/subscriptions" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'subscriptions' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Subscriptions</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'subscriptions' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P45</span>
                        </a>
                        <a href="/admin/billing" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'billing' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Billing Platform</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'billing' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P46</span>
                        </a>
                        <a href="/admin/system-health" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'system-health' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>System Health</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'system-health' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P47</span>
                        </a>
                        <a href="/admin/alerts" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'alerts' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Alerts</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'alerts' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P48</span>
                        </a>
                        <a href="/admin/incidents" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'incidents' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Incidents</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'incidents' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P49</span>
                        </a>
                        <a href="/admin/api-management" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'api-management' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>API Management</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'api-management' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P50</span>
                        </a>
                        <a href="/admin/audit-logs" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'audit-logs' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Audit Logs</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'audit-logs' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P51</span>
                        </a>
                        <a href="/admin/roles-permissions" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'roles-permissions' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Roles & Permissions</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'roles-permissions' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P52</span>
                        </a>
                        <a href="/admin/platform-settings" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'platform-settings' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800' }}">
                            <span>Platform Settings</span>
                            <span class="text-[9px] font-mono px-1.5 py-0.5 rounded {{ $activeNav === 'platform-settings' ? 'bg-indigo-500/30 text-white' : 'bg-slate-800 text-slate-400' }}">P53</span>
                        </a>
                    </nav>

                    <div class="pt-4 border-t border-slate-800 space-y-2 text-xs">
                        <a href="/vendor/dashboard" class="block px-3 py-2 rounded-xl bg-slate-900 text-slate-300 font-medium">Switch to Vendor Portal</a>
                        <a href="/dashboard" class="block px-3 py-2 rounded-xl bg-slate-900 text-slate-300 font-medium">Switch to Driver Portal</a>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
                {{ $slot }}
            </main>

            <!-- Admin Footer -->
            <footer class="border-t border-slate-200 bg-white py-4 px-4 sm:px-6 lg:px-8 text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2 mt-auto">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-700">NusaPark Smart Parking SaaS</span>
                    <span class="text-slate-300">•</span>
                    <span>National Architecture v3.4.0</span>
                    <span class="text-slate-300">•</span>
                    <span class="font-mono text-emerald-600 font-medium">Production Node Active</span>
                </div>
                <div class="text-[11px] text-slate-400">
                    Cross-Tenant Aggregate Monitoring System • Authorized Personnel Only
                </div>
            </footer>

        </div>
    </div>

    <!-- Script for mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openBtn = document.getElementById('admin-mobile-menu-btn');
            const drawer = document.getElementById('admin-mobile-drawer');
            const closeBtn = document.getElementById('admin-close-mobile-drawer');

            if (openBtn && drawer && closeBtn) {
                openBtn.addEventListener('click', function () {
                    drawer.classList.remove('hidden');
                });
                closeBtn.addEventListener('click', function () {
                    drawer.classList.add('hidden');
                });
                drawer.addEventListener('click', function (e) {
                    if (e.target === drawer) {
                        drawer.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
