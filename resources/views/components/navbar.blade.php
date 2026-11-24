@props(['active' => ''])

@php
    $user = Auth::user();
    $unreadNotifCount = 0;
    $initials = 'U';
    $firstName = 'User';
    $dashboardUrl = '/dashboard';

    if ($user) {
        try {
            $unreadNotifCount = app(\App\Services\NotificationService::class)->getUnreadCount();
        } catch (\Throwable $e) {
            $unreadNotifCount = 0;
        }

        $name = trim($user->name ?? 'User');
        $parts = explode(' ', $name);
        $initials = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
        if (strlen($initials) === 1 && strlen($parts[0]) > 1) {
            $initials = strtoupper(substr($parts[0], 0, 2));
        }
        $firstName = $parts[0] ?? 'User';

        if (($user->role ?? '') === 'admin') {
            $dashboardUrl = '/admin/dashboard';
        } elseif (($user->role ?? '') === 'vendor' || ($user->account_type ?? '') === 'vendor') {
            $dashboardUrl = '/vendor/dashboard';
        }
    }
@endphp

<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 transition-all duration-200" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-blue-500/25 group-hover:scale-105 transition-transform duration-200">
                <svg class="w-5 h-5 fill-none stroke-current stroke-[2.5]" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 19V5l12 14V5" />
                </svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-slate-900">Nusa<span class="text-blue-600">Park</span></span>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center gap-8">
            <a href="/" class="text-sm transition-colors {{ $active === 'home' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">Home</a>
            <a href="/search" class="text-sm transition-colors {{ $active === 'search' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">Find Parking</a>
            <a href="/locations" class="text-sm transition-colors {{ $active === 'locations' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">Locations</a>
            <a href="/pricing" class="text-sm transition-colors {{ $active === 'pricing' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">Pricing</a>
            <a href="/how-it-works" class="text-sm transition-colors {{ $active === 'how-it-works' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">How It Works</a>
            <a href="/faq" class="text-sm transition-colors {{ $active === 'faq' ? 'text-blue-600 font-semibold relative after:absolute after:-bottom-2 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' : 'text-slate-600 hover:text-blue-600 font-medium' }}">FAQ</a>
        </div>

        <!-- Desktop Actions -->
        <div class="hidden md:flex items-center gap-3">
            @auth
                <!-- Notifications Bell -->
                <a href="/notifications" class="relative p-2 text-slate-500 hover:text-blue-600 hover:bg-slate-50 rounded-full transition-colors" title="Notifications">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    @if($unreadNotifCount > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 rounded-full ring-2 ring-white"></span>
                    @endif
                </a>

                <!-- User Profile Dropdown Button -->
                <div class="relative" id="user-dropdown-wrapper">
                    <button type="button" id="user-dropdown-btn" class="flex items-center gap-2 p-1 pl-1.5 pr-2.5 rounded-full border border-slate-200 hover:border-blue-400 bg-white hover:bg-slate-50 transition-all cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                            {{ $initials }}
                        </div>
                        <span class="text-sm font-semibold text-slate-800 max-w-[110px] truncate">{{ $firstName }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" id="user-dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-dropdown-menu" class="hidden absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl border border-slate-200 shadow-2xl py-2 z-50">
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/70 rounded-t-2xl">
                            <p class="text-xs font-bold text-slate-900 truncate">{{ $user->name }}</p>
                            <p class="text-[11px] text-slate-500 truncate">{{ $user->email }}</p>
                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700">
                                {{ ucfirst($user->role ?? $user->account_type ?? 'Driver') }}
                            </span>
                        </div>

                        <!-- Links -->
                        <div class="py-1">
                            <a href="{{ $dashboardUrl }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="/active-parking" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                <span>Active Parking</span>
                            </a>
                            <a href="/history" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                                <span>Parking History</span>
                            </a>
                            <a href="/profile" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <span>Profile & Settings</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="border-t border-slate-100 pt-1">
                            <a href="/logout" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                <span>Sign Out</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Button -->
                <a href="{{ $dashboardUrl }}" class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm hover:shadow-md hover:shadow-blue-500/20 transition-all">Dashboard</a>
            @else
                <!-- Guest State -->
                <a href="/login" class="px-5 py-2 rounded-full border border-slate-200 text-slate-700 hover:border-slate-300 hover:bg-slate-50 text-sm font-semibold transition-all">Sign In</a>
                <a href="/search" class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm hover:shadow-md hover:shadow-blue-500/20 transition-all">Find Parking</a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600 hover:text-blue-600 focus:outline-none" aria-label="Toggle Navigation">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-6 bg-white border-b border-slate-100 shadow-xl space-y-3">
        <a href="/" class="block px-3 py-2 rounded-lg text-base {{ $active === 'home' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">Home</a>
        <a href="/search" class="block px-3 py-2 rounded-lg text-base {{ $active === 'search' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">Find Parking</a>
        <a href="/locations" class="block px-3 py-2 rounded-lg text-base {{ $active === 'locations' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">Locations</a>
        <a href="/pricing" class="block px-3 py-2 rounded-lg text-base {{ $active === 'pricing' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">Pricing</a>
        <a href="/how-it-works" class="block px-3 py-2 rounded-lg text-base {{ $active === 'how-it-works' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">How It Works</a>
        <a href="/faq" class="block px-3 py-2 rounded-lg text-base {{ $active === 'faq' ? 'text-blue-600 font-semibold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">FAQ</a>
        
        <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
            @auth
                <!-- Mobile User Info Card -->
                <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-sm flex items-center justify-center shrink-0 shadow-sm">
                        {{ $initials }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-sm font-bold text-slate-900 truncate">{{ $user->name }}</div>
                        <div class="text-xs text-slate-500 truncate">{{ $user->email }}</div>
                    </div>
                </div>

                <a href="{{ $dashboardUrl }}" class="w-full text-center py-2.5 rounded-full bg-blue-600 text-white font-semibold text-sm shadow-sm">Dashboard</a>
                <a href="/active-parking" class="w-full text-center py-2.5 rounded-full border border-slate-200 text-slate-700 font-semibold text-sm">Active Parking</a>
                <a href="/profile" class="w-full text-center py-2.5 rounded-full border border-slate-200 text-slate-700 font-semibold text-sm">Profile & Settings</a>
                <a href="/logout" class="w-full text-center py-2.5 rounded-full border border-red-200 text-red-600 hover:bg-red-50 font-semibold text-sm">Sign Out</a>
            @else
                <a href="/login" class="w-full text-center py-2.5 rounded-full border border-slate-200 text-slate-700 font-semibold text-sm">Sign In</a>
                <a href="/search" class="w-full text-center py-2.5 rounded-full bg-blue-600 text-white font-semibold text-sm shadow-sm">Find Parking</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        // Desktop User dropdown toggle
        const userBtn = document.getElementById('user-dropdown-btn');
        const userMenu = document.getElementById('user-dropdown-menu');
        const userArrow = document.getElementById('user-dropdown-arrow');

        if (userBtn && userMenu) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
                if (userArrow) userArrow.classList.toggle('rotate-180');
            });

            document.addEventListener('click', function(e) {
                if (!userMenu.contains(e.target) && !userBtn.contains(e.target)) {
                    userMenu.classList.add('hidden');
                    if (userArrow) userArrow.classList.remove('rotate-180');
                }
            });
        }
    });
</script>
