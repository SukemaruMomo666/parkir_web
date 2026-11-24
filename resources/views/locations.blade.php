<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Parking Locations - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}"> <!-- For shared filter drawer base -->
    <link rel="stylesheet" href="{{ asset('css/locations.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="locations-page-body">

    <!-- NAVBAR (Reused) -->
    <x-navbar active="locations" />

    <!-- PAGE HERO -->
    <header class="locations-hero">
        <div class="container">
            <h1>Explore Parking Locations</h1>
            <p>Discover connected NusaPark parking locations across cities and destinations.</p>
            
            <div class="search-container">
                <svg class="main-search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="main-search-input" placeholder="Search location, mall, building, city, or address">
                <button class="main-location-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                    Near me
                </button>
                
                <div class="city-exploration">
                    <span class="city-label">Popular:</span>
                    <button class="city-chip active">Jakarta</button>
                    <button class="city-chip">Bandung</button>
                    <button class="city-chip">Surabaya</button>
                    <button class="city-chip">Subang</button>
                    <button class="city-chip">Cirebon</button>
                </div>
            </div>
        </div>
    </header>

    <!-- FILTER TOOLBAR -->
    <section class="filter-toolbar-section">
        <div class="container">
            <div class="toolbar-flex">
                <div class="filter-dropdowns">
                    <button class="filter-dropdown-btn active">
                        Availability 
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button class="filter-dropdown-btn">
                        Distance 
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button class="filter-dropdown-btn active">
                        Vehicle: Car 
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button class="filter-dropdown-btn" onclick="openMobileFilters()">
                        More Filters 
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
                    </button>
                </div>
                
                <button class="filter-dropdown-btn mobile-filter-btn" onclick="openMobileFilters()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filters
                    <span style="background: var(--primary); color: white; border-radius: 10px; padding: 2px 6px; font-size: 10px; margin-left: 4px;">4</span>
                </button>
                
                <div class="view-controls">
                    <div class="sort-dropdown">
                        <label for="sortLocations">Sort:</label>
                        <select id="sortLocations">
                            <option value="nearest">Nearest</option>
                            <option value="available">Most Available</option>
                            <option value="popular">Popular</option>
                            <option value="price">Lowest Price</option>
                        </select>
                    </div>
                    
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="setViewMode('grid')" aria-label="Grid view">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        </button>
                        <button class="view-btn" onclick="setViewMode('list')" aria-label="List view">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="active-filters">
                <div class="active-chip">Jakarta <button class="remove-chip" aria-label="Remove filter"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
                <div class="active-chip">Available Now <button class="remove-chip" aria-label="Remove filter"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
                <div class="active-chip">Car <button class="remove-chip" aria-label="Remove filter"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
                <div class="active-chip">Within 5 km <button class="remove-chip" aria-label="Remove filter"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
                <button class="clear-all">Clear all</button>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="main-results-section">
        <div class="container">
            
            <div class="result-summary-bar">
                <div class="summary-text">
                    <h2>128 parking locations</h2>
                    <p>Connected locations near Jakarta</p>
                </div>
            </div>
            
            <div class="locations-grid" id="locationsGrid">
                
                <!-- Location 1 -->
                <div class="loc-card" onclick="alert('Navigating to Location Detail...')">
                    <div class="loc-image-wrapper">
                        <div class="loc-badge recommended">Recommended</div>
                        <img src="https://images.unsplash.com/photo-1621929747188-0b4dc28498d2?auto=format&fit=crop&q=80&w=600" alt="Mall XYZ Parking Exterior" class="loc-image">
                    </div>
                    <div class="loc-content">
                        <div class="loc-header">
                            <div>
                                <h3 class="loc-title">Mall XYZ</h3>
                                <div class="loc-subtitle">Jakarta Selatan • <span style="color: var(--success); font-weight: 500;">Open now</span></div>
                            </div>
                            <div class="loc-rating">
                                4.8 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                        </div>
                        
                        <div class="loc-availability">
                            <div class="avail-indicator success">Available</div>
                            <span class="avail-text">327 slots available</span>
                        </div>
                        
                        <div class="loc-details-grid">
                            <div class="loc-detail">
                                <span>Distance</span>
                                <span>2.4 km</span>
                            </div>
                            <div class="loc-detail">
                                <span>Starting Price</span>
                                <span>Rp5.000 / hr <a href="#" onclick="event.stopPropagation()">Pricing</a></span>
                            </div>
                        </div>
                        
                        <div class="loc-facilities">
                            <div class="facility-icon" title="EV Charging"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg></div>
                            <div class="facility-icon" title="CCTV Monitoring"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                            <div class="facility-icon" title="24/7 Access"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                        </div>
                        
                        <div class="loc-actions">
                            <button class="btn btn-primary" onclick="event.stopPropagation()">View Parking</button>
                            <button class="btn btn-secondary" onclick="event.stopPropagation()">Directions</button>
                        </div>
                    </div>
                </div>

                <!-- Location 2 -->
                <div class="loc-card" onclick="alert('Navigating to Location Detail...')">
                    <div class="loc-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=600" alt="Subang Square Parking" class="loc-image">
                    </div>
                    <div class="loc-content">
                        <div class="loc-header">
                            <div>
                                <h3 class="loc-title">Subang Square</h3>
                                <div class="loc-subtitle">Subang • <span style="color: var(--success); font-weight: 500;">Open now</span></div>
                            </div>
                            <div class="loc-rating">
                                4.5 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                        </div>
                        
                        <div class="loc-availability">
                            <div class="avail-indicator warning">Limited</div>
                            <span class="avail-text">24 slots available</span>
                        </div>
                        
                        <div class="loc-details-grid">
                            <div class="loc-detail">
                                <span>Distance</span>
                                <span>3.1 km</span>
                            </div>
                            <div class="loc-detail">
                                <span>Starting Price</span>
                                <span>Rp4.000 / hr <a href="#" onclick="event.stopPropagation()">Pricing</a></span>
                            </div>
                        </div>
                        
                        <div class="loc-facilities">
                            <div class="facility-icon" title="CCTV Monitoring"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                        </div>
                        
                        <div class="loc-actions">
                            <button class="btn btn-primary" onclick="event.stopPropagation()">View Parking</button>
                            <button class="btn btn-secondary" onclick="event.stopPropagation()">Directions</button>
                        </div>
                    </div>
                </div>

                <!-- Location 3 -->
                <div class="loc-card" onclick="alert('Navigating to Location Detail...')">
                    <div class="loc-image-wrapper">
                        <div class="loc-badge" style="background: var(--surface);">Popular</div>
                        <img src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&q=80&w=600" alt="Parking Building ABC" class="loc-image">
                    </div>
                    <div class="loc-content">
                        <div class="loc-header">
                            <div>
                                <h3 class="loc-title">Parking Building ABC</h3>
                                <div class="loc-subtitle">Bandung • <span style="color: var(--warning); font-weight: 500;">Closing soon</span></div>
                            </div>
                            <div class="loc-rating">
                                4.2 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                        </div>
                        
                        <div class="loc-availability">
                            <div class="avail-indicator danger">Full</div>
                            <span class="avail-text">0 slots available</span>
                        </div>
                        
                        <div class="loc-details-grid">
                            <div class="loc-detail">
                                <span>Distance</span>
                                <span>4.5 km</span>
                            </div>
                            <div class="loc-detail">
                                <span>Starting Price</span>
                                <span>Rp6.000 / hr <a href="#" onclick="event.stopPropagation()">Pricing</a></span>
                            </div>
                        </div>
                        
                        <div class="loc-facilities">
                            <div class="facility-icon" title="CCTV Monitoring"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                            <div class="facility-icon" title="VIP Parking"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                        </div>
                        
                        <div class="loc-actions">
                            <button class="btn btn-secondary" style="width:100%" onclick="event.stopPropagation()">View Location</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- PAGINATION -->
            <div class="pagination">
                <button class="page-btn page-text-btn" disabled>Previous</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">5</button>
                <button class="page-btn page-text-btn">Next</button>
            </div>
            
            <div class="load-more-container">
                <div class="load-more-text">24 of 128 locations</div>
                <button class="btn btn-secondary" style="width:100%; max-width: 300px;">Load More</button>
            </div>

        </div>
    </main>

    <!-- FOOTER (Reused) -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="logo" style="color: white;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <path d="M9 17h6"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                        NusaPark
                    </a>
                    <p>Smart Parking for a Smarter Indonesia. Revolutionizing urban mobility through enterprise-grade technology.</p>
                </div>
                <div class="footer-col">
                    <h4>Product</h4>
                    <ul>
                        <li><a href="/search">Find Parking</a></li>
                        <li><a href="/locations">Locations</a></li>
                        <li><a href="/#pricing">Pricing</a></li>
                        <li><a href="#">App Download</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <!-- Other footer cols truncated for brevity to match style -->
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NusaPark. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- MOBILE FILTER DRAWER -->
    <div class="filter-drawer-overlay" id="filterOverlay" onclick="closeMobileFilters()"></div>
    <div class="filter-drawer" id="filterDrawer">
        <div class="drawer-header">
            <h3>Advanced Filters</h3>
            <button class="close-btn" onclick="closeMobileFilters()"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <div class="drawer-body">
            <!-- Filter contents reused logically -->
            <div class="filter-section">
                <h4>Availability</h4>
                <div class="filter-options">
                    <div class="filter-option selected" onclick="this.classList.toggle('selected')">Available Now</div>
                    <div class="filter-option" onclick="this.classList.toggle('selected')">Limited</div>
                    <div class="filter-option" onclick="this.classList.toggle('selected')">Full</div>
                </div>
            </div>
            <div class="filter-section">
                <h4>City</h4>
                <div class="filter-options">
                    <div class="filter-option selected" onclick="this.classList.toggle('selected')">Jakarta</div>
                    <div class="filter-option" onclick="this.classList.toggle('selected')">Bandung</div>
                    <div class="filter-option" onclick="this.classList.toggle('selected')">Surabaya</div>
                </div>
            </div>
        </div>
        <div class="drawer-footer">
            <button class="btn btn-secondary" onclick="document.querySelectorAll('.filter-option.selected').forEach(e => e.classList.remove('selected'))">Clear All</button>
            <button class="btn btn-primary" onclick="closeMobileFilters()">Apply Filters</button>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // View Toggle (List/Grid)
        function setViewMode(mode) {
            const grid = document.getElementById('locationsGrid');
            const btns = document.querySelectorAll('.view-btn');
            
            btns.forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');
            
            if(mode === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        }

        // Mobile Filters
        const overlay = document.getElementById('filterOverlay');
        const drawer = document.getElementById('filterDrawer');
        
        function openMobileFilters() {
            const ov = document.getElementById('filterOverlay');
            const dr = document.getElementById('filterDrawer');
            if(ov) ov.classList.add('active');
            if(dr) dr.classList.add('active');
        }
        
        function closeMobileFilters() {
            try {
                const ov = document.getElementById('filterOverlay');
                const dr = document.getElementById('filterDrawer');
                if(ov) ov.classList.remove('active');
                if(dr) dr.classList.remove('active');
            } catch(e) {
                console.error("Filter close error:", e);
            }
        }

        // Remove Chip Mock
        document.querySelectorAll('.remove-chip').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.parentElement.style.display = 'none';
            });
        });

        // City Chip Mock
        document.querySelectorAll('.city-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.city-chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
