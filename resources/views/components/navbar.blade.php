@props(['active' => ''])

<nav class="navbar bg-surface border-b border-border shadow-sm" id="navbar">
    <div class="container nav-container">
        <a href="/" class="logo text-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                <circle cx="7" cy="17" r="2"/>
                <path d="M9 17h6"/>
                <circle cx="17" cy="17" r="2"/>
            </svg>
            NusaPark
        </a>
        <div class="nav-links">
            <a href="/" class="{{ $active === 'home' ? 'active' : '' }}">Home</a>
            <a href="/search" class="{{ $active === 'search' ? 'active' : '' }}">Find Parking</a>
            <a href="/locations" class="{{ $active === 'locations' ? 'active' : '' }}">Locations</a>
            <a href="/pricing" class="{{ $active === 'pricing' ? 'active' : '' }}">Pricing</a>
            <a href="/how-it-works" class="{{ $active === 'how-it-works' ? 'active' : '' }}">How It Works</a>
            <a href="/faq" class="{{ $active === 'faq' ? 'active' : '' }}">FAQ</a>
        </div>
        <div class="nav-actions">
            <a href="/login" class="font-medium text-text-muted hover:text-primary transition-colors">Sign in</a>
            <a href="/search" class="btn btn-primary bg-primary text-white hover:bg-primary-light">Find Parking</a>
        </div>
        <button class="menu-toggle text-primary" aria-label="Toggle menu">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>
</nav>
