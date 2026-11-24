@props(['active' => 'dashboard'])

@php
    $user = Auth::user();
    $unreadNotifCount = 0;
    if ($user) {
        try {
            $unreadNotifCount = app(\App\Services\NotificationService::class)->getUnreadCount();
        } catch (\Throwable $e) {
            $unreadNotifCount = 0;
        }
    }

    $name = trim($user?->name ?? 'Prabu');
    $parts = explode(' ', $name);
    $initials = strtoupper(substr($parts[0] ?? 'P', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : (strlen($parts[0]) > 1 ? substr($parts[0], 1, 1) : 'A')));
    $firstName = $parts[0] ?? 'Prabu';
@endphp

<!-- DESKTOP AUTH NAVBAR -->
<nav class="sticky top-0 w-full bg-white/95 backdrop-blur-md border-b border-slate-100 z-50 transition-all duration-200" aria-label="Authenticated Navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-6">
        
        <!-- Left: Brand + Navigation Links -->
        <div class="flex items-center gap-8 h-full min-w-0">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-2.5 shrink-0 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-blue-500/25 group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5 fill-none stroke-current stroke-[2.5]" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 19V5l12 14V5" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">Nusa<span class="text-blue-600">Park</span></span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center gap-6 lg:gap-8 h-full">
                @php
                    $navItems = [
                        ['id' => 'dashboard', 'label' => 'Dashboard', 'href' => '/dashboard'],
                        ['id' => 'search', 'label' => 'Find Parking', 'href' => '/search'],
                        ['id' => 'active-parking', 'label' => 'Active Parking', 'href' => '/active-parking'],
                        ['id' => 'reservations', 'label' => 'Reservations', 'href' => '/reservations'],
                        ['id' => 'history', 'label' => 'History', 'href' => '/history'],
                        ['id' => 'vehicles', 'label' => 'Vehicles', 'href' => '/vehicles'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isCurrent = ($active === $item['id']); @endphp
                    <a href="{{ $item['href'] }}" 
                       class="relative py-2 text-sm font-medium transition-colors whitespace-nowrap
                              {{ $isCurrent 
                                 ? 'text-blue-600 font-semibold after:absolute after:-bottom-4 after:left-0 after:right-0 after:h-0.5 after:bg-blue-600 after:rounded-full' 
                                 : 'text-slate-600 hover:text-blue-600' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Right: Notifications + User Account Menu -->
        <div class="flex items-center gap-3.5 shrink-0">
            <!-- Notifications Bell -->
            <a href="/notifications" 
               class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-slate-50 transition-colors rounded-full"
               aria-label="View notifications">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                @if($unreadNotifCount > 0 || true)
                    <span id="desktop-notif-badge" class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
                @endif
            </a>

            <!-- User Dropdown -->
            <div class="relative" id="user-menu-container">
                <button type="button"
                        id="user-menu-button"
                        class="flex items-center gap-2 p-1 pl-1.5 pr-2.5 bg-white border border-slate-200 rounded-full hover:border-slate-300 transition-all cursor-pointer shadow-xs">
                    <div class="w-8 h-8 bg-slate-100 text-slate-700 rounded-full flex items-center justify-center font-bold text-xs shrink-0">
                        {{ $initials }}
                    </div>
                    <span class="text-sm font-semibold text-slate-800 max-w-[110px] truncate">{{ $firstName }}</span>
                    <svg id="user-menu-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-slate-400 transition-transform duration-200">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                
                <div id="user-menu-dropdown"
                     class="hidden absolute right-0 top-full mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden py-1">
                    <div class="p-4 border-b border-slate-100 bg-slate-50/70">
                        <div class="font-bold text-sm text-slate-900 truncate">{{ $user?->name ?? 'Prabu' }}</div>
                        <div class="text-xs text-slate-500 truncate">{{ $user?->email ?? 'prabu@example.com' }}</div>
                    </div>
                    <div class="py-1">
                        <a href="/profile" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors">Profile & Settings</a>
                        <a href="/vehicles" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors">My Vehicles</a>
                        <a href="/history" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors">Parking History</a>
                    </div>
                    <div class="border-t border-slate-100 py-1">
                        <a href="/logout" class="block px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors">Sign Out</a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <button id="auth-mobile-menu-btn" class="md:hidden p-2 text-slate-600 hover:text-blue-600" aria-label="Toggle Mobile Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

    </div>

    <!-- Mobile Drawer for Authenticated User -->
    <div id="auth-mobile-menu" class="hidden md:hidden px-4 pt-2 pb-6 bg-white border-b border-slate-100 shadow-xl space-y-2">
        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-2">
            <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-700 font-bold text-sm flex items-center justify-center shrink-0">
                {{ $initials }}
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-bold text-slate-900 truncate">{{ $user?->name ?? 'Prabu' }}</div>
                <div class="text-xs text-slate-500 truncate">{{ $user?->email ?? 'prabu@example.com' }}</div>
            </div>
        </div>

        @foreach($navItems as $item)
            @php $isCurrent = ($active === $item['id']); @endphp
            <a href="{{ $item['href'] }}" class="block px-3 py-2 rounded-lg text-sm {{ $isCurrent ? 'text-blue-600 font-bold bg-blue-50' : 'text-slate-700 font-medium hover:bg-slate-50' }}">
                {{ $item['label'] }}
            </a>
        @endforeach

        <div class="pt-2 border-t border-slate-100">
            <a href="/logout" class="block w-full text-center py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-sm hover:bg-red-50">
                Sign Out
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userBtn = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-menu-dropdown');
        const userChevron = document.getElementById('user-menu-chevron');

        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
                if (userChevron) userChevron.classList.toggle('rotate-180');
            });

            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target) && !userBtn.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                    if (userChevron) userChevron.classList.remove('rotate-180');
                }
            });
        }

        const mobBtn = document.getElementById('auth-mobile-menu-btn');
        const mobMenu = document.getElementById('auth-mobile-menu');
        if (mobBtn && mobMenu) {
            mobBtn.addEventListener('click', function() {
                mobMenu.classList.toggle('hidden');
            });
        }
    });
</script>
