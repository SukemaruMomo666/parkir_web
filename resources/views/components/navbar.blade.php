@props(['active' => ''])

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
            <a href="/login" class="px-5 py-2 rounded-full border border-slate-200 text-slate-700 hover:border-slate-300 hover:bg-slate-50 text-sm font-semibold transition-all">Sign In</a>
            <a href="/search" class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm hover:shadow-md hover:shadow-blue-500/20 transition-all">Find Parking</a>
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
            <a href="/login" class="w-full text-center py-2.5 rounded-full border border-slate-200 text-slate-700 font-semibold text-sm">Sign In</a>
            <a href="/search" class="w-full text-center py-2.5 rounded-full bg-blue-600 text-white font-semibold text-sm shadow-sm">Find Parking</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>
