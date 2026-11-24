@props(['active' => 'dashboard'])
@php
    $unreadNotifCount = app(\App\Services\NotificationService::class)->getUnreadCount();
    $driverProfile = app(\App\Services\ProfileService::class)->getProfile(Auth::user());
@endphp

<!-- DESKTOP AUTH NAVBAR -->
<nav class="hidden md:block sticky top-0 w-full bg-[var(--surface)] border-b border-[var(--border)] z-50 shadow-xs" aria-label="Authenticated Navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-[72px] flex items-center justify-between gap-4 lg:gap-8">
        
        <!-- Left: Brand + Navigation Links -->
        <div class="flex items-center gap-6 lg:gap-8 h-full min-w-0">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-2.5 shrink-0 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--primary)] rounded-lg py-1 px-1 -ml-1">
                <div class="w-8 h-8 bg-[var(--primary)] rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md group-hover:scale-105 transition-transform shrink-0">
                    N
                </div>
                <span class="font-bold text-xl tracking-tight text-[var(--primary)] shrink-0">Nusa<span class="text-[var(--accent)]">Park</span></span>
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-1 lg:space-x-1.5 h-full overflow-x-auto scrollbar-none">
                @php
                    $navItems = [
                        ['id' => 'dashboard', 'label' => 'Dashboard', 'href' => '/dashboard'],
                        ['id' => 'search', 'label' => 'Find Parking', 'href' => '/app/search'],
                        ['id' => 'active-parking', 'label' => 'Active Parking', 'href' => '/active-parking'],
                        ['id' => 'reservations', 'label' => 'Reservations', 'href' => '/reservations'],
                        ['id' => 'history', 'label' => 'History', 'href' => '/history'],
                        ['id' => 'vehicles', 'label' => 'Vehicles', 'href' => '/vehicles'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isCurrent = ($active === $item['id']); @endphp
                    <a href="{{ $item['href'] }}" 
                       class="relative h-full flex items-center px-3 lg:px-3.5 text-xs lg:text-sm font-semibold whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--primary)] rounded-t-sm
                              {{ $isCurrent 
                                 ? 'text-[var(--primary)]' 
                                 : 'text-[var(--text-muted)] hover:text-[var(--primary)]' }}">
                        <span>{{ $item['label'] }}</span>
                        @if($isCurrent)
                            <span class="absolute bottom-0 left-0 right-0 h-[2.5px] bg-[var(--primary)] rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Right: Notifications + User Account Menu -->
        <div class="flex items-center gap-3 lg:gap-4 shrink-0">
            <!-- Notifications -->
            <a href="/notifications" 
               class="relative p-2.5 {{ $active === 'notifications' ? 'text-[var(--primary)] bg-[var(--background)] ring-1 ring-[var(--border)]' : 'text-[var(--text-muted)] hover:text-[var(--primary)] hover:bg-[var(--background)]' }} transition-colors rounded-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--primary)]"
               aria-label="View notifications">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                @if($unreadNotifCount > 0)
                    <span id="desktop-notif-badge" class="absolute top-2 right-2 w-2 h-2 bg-[var(--danger)] rounded-full ring-2 ring-[var(--surface)]"></span>
                @endif
            </a>

            <!-- User Dropdown -->
            <div class="relative" id="user-menu-container">
                <button type="button"
                        id="user-menu-button"
                        class="flex items-center gap-2.5 p-1 pl-1.5 pr-3 bg-[var(--background)] border border-[var(--border)] rounded-full hover:border-[var(--primary)] transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--primary)] cursor-pointer"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="user-menu-dropdown">
                    <div class="w-8 h-8 bg-blue-100 text-[var(--primary)] rounded-full flex items-center justify-center font-bold text-sm shrink-0">
                        {{ $driverProfile['avatar_initials'] ?? 'U' }}
                    </div>
                    <span class="text-sm font-semibold text-[var(--text)]">{{ $driverProfile['first_name'] ?? (Auth::user()?->name ? explode(' ', trim(Auth::user()->name))[0] : 'Driver') }}</span>
                    <svg id="user-menu-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--text-muted)] group-hover:text-[var(--primary)] transition-transform duration-200">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                
                <div id="user-menu-dropdown"
                     class="hidden absolute right-0 top-full mt-2 w-56 bg-[var(--surface)] border border-[var(--border)] rounded-xl shadow-xl z-50 overflow-hidden"
                     role="menu"
                     aria-orientation="vertical"
                     aria-labelledby="user-menu-button">
                    <div class="p-4 border-b border-[var(--border)] bg-slate-50/50">
                        <div class="font-semibold text-sm text-[var(--text)]">{{ $driverProfile['name'] ?? (Auth::user()?->name ?? 'Driver Account') }}</div>
                        <div class="text-xs text-[var(--text-muted)] truncate">{{ $driverProfile['email'] ?? (Auth::user()?->email ?? '') }}</div>
                    </div>
                    <div class="py-1">
                        <a href="/profile" class="block px-4 py-2 text-sm {{ $active === 'profile' ? 'text-[var(--primary)] font-semibold bg-[var(--background)]' : 'text-[var(--text-muted)]' }} hover:bg-[var(--background)] hover:text-[var(--primary)] transition-colors" role="menuitem">Profile</a>
                        <a href="/settings" class="block px-4 py-2 text-sm text-[var(--text-muted)] hover:bg-[var(--background)] hover:text-[var(--primary)] transition-colors" role="menuitem">Settings</a>
                    </div>
                    <div class="border-t border-[var(--border)] py-1">
                        <a href="/logout" class="block px-4 py-2 text-sm text-[var(--danger)] hover:bg-red-50 transition-colors" role="menuitem">Sign out</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>

<!-- MOBILE TOP BAR -->
<div class="md:hidden sticky top-0 w-full bg-[var(--surface)] border-b border-[var(--border)] z-50 px-4 h-14 flex items-center justify-between shadow-sm">
    <a href="/" class="flex items-center gap-2">
        <div class="w-7 h-7 bg-[var(--primary)] rounded-md flex items-center justify-center text-white font-bold text-base shadow-sm">
            N
        </div>
        <span class="font-bold text-lg tracking-tight text-[var(--primary)]">Nusa<span class="text-[var(--accent)]">Park</span></span>
    </a>
    <div class="flex items-center gap-3">
        <a href="/notifications" class="relative p-2 {{ $active === 'notifications' ? 'text-[var(--primary)]' : 'text-[var(--text-muted)]' }}" aria-label="View notifications">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            @if($unreadNotifCount > 0)
                <span id="mobile-notif-badge" class="absolute top-1 right-2 w-2 h-2 bg-[var(--danger)] rounded-full border border-[var(--surface)]"></span>
            @endif
        </a>
        <a href="/profile" class="w-8 h-8 bg-blue-100 text-[var(--primary)] rounded-full flex items-center justify-center font-bold text-sm {{ $active === 'profile' ? 'ring-2 ring-[var(--accent)]' : '' }}">
            {{ $driverProfile['avatar_initials'] ?? (Auth::user()?->name ? strtoupper(substr(trim(Auth::user()->name), 0, 1)) : 'U') }}
        </a>
    </div>
</div>

<!-- MOBILE BOTTOM NAVIGATION -->
<div class="md:hidden fixed bottom-0 w-full bg-[var(--surface)] border-t border-[var(--border)] z-50 pb-safe shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
    <div class="flex items-center justify-around h-16">
        <a href="/dashboard" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'dashboard' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="9"></rect>
                <rect x="14" y="3" width="7" height="5"></rect>
                <rect x="14" y="12" width="7" height="9"></rect>
                <rect x="3" y="16" width="7" height="5"></rect>
            </svg>
            <span class="text-[10px] font-medium">Dashboard</span>
        </a>
        
        <a href="/app/search" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'search' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <span class="text-[10px] font-medium">Find</span>
        </a>

        <a href="/active-parking" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'active-parking' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <div class="relative">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-[var(--success)] rounded-full border border-[var(--surface)]"></span>
            </div>
            <span class="text-[10px] font-medium">Active</span>
        </a>

        <a href="/reservations" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'reservations' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="text-[10px] font-medium">Reserve</span>
        </a>

        <a href="/history" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'history' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span class="text-[10px] font-medium">History</span>
        </a>

        <a href="/profile" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ $active === 'profile' ? 'text-[var(--primary)] font-semibold' : 'text-[var(--text-muted)]' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="text-[10px] font-medium">Profile</span>
        </a>
    </div>
</div>

<style>
    /* Safe area padding for mobile bottom bar (iOS home indicator) */
    @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .pb-safe {
            padding-bottom: env(safe-area-inset-bottom);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('user-menu-button');
        const menu = document.getElementById('user-menu-dropdown');
        const chevron = document.getElementById('user-menu-chevron');
        const container = document.getElementById('user-menu-container');

        if (!btn || !menu || !container) return;

        function setMenuOpen(open) {
            if (open) {
                menu.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = !menu.classList.contains('hidden');
            setMenuOpen(!isOpen);
        });

        let hoverTimer = null;
        container.addEventListener('mouseenter', function() {
            clearTimeout(hoverTimer);
            setMenuOpen(true);
        });
        container.addEventListener('mouseleave', function() {
            hoverTimer = setTimeout(function() {
                setMenuOpen(false);
            }, 180);
        });

        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                setMenuOpen(false);
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                setMenuOpen(false);
                btn.focus();
            }
        });
    });
</script>
