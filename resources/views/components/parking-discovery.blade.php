@props(['isAuthenticated' => false])

<!-- SEARCH HEADER SECTION -->
<section class="search-header-section">
    <div class="container">
        <div class="search-titles">
            <h1>Find Parking</h1>
            <p>Discover available parking near your destination.</p>
            @if($isAuthenticated)
                <div style="margin-top: 8px; display: inline-flex; align-items: center; gap: 8px; background: var(--background); padding: 4px 12px; border-radius: 100px; border: 1px solid var(--border); font-size: 0.75rem;">
                    <span style="color: var(--text-muted);">Parking for</span>
                    <span style="font-weight: 600; color: var(--text);">🚗 Toyota Avanza · B •••• XYZ</span>
                    <a href="/vehicles" style="color: var(--primary); margin-left: 4px; font-weight: 600;">Change</a>
                </div>
            @endif
        </div>
        
        <div class="search-controls">
            <div class="search-input-wrapper" id="searchInputWrapper">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Search mall, building, area, or address" autocomplete="off">
                
                <!-- Autocomplete Dropdown -->
                <div class="autocomplete-dropdown">
                    @if($isAuthenticated)
                        <div style="padding: 8px 16px; background: var(--background); font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Recent Searches</div>
                        <div class="ac-item" onclick="selectLocation('Grand Indonesia')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-muted); margin-right: 8px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <span class="ac-title" style="flex:1;">Grand Indonesia</span>
                        </div>
                    @endif
                    <div class="ac-item" onclick="selectLocation('Mall XYZ')">
                        <span class="ac-title">Mall XYZ</span>
                        <span class="ac-subtitle">Jakarta Selatan</span>
                    </div>
                    <div class="ac-item" onclick="selectLocation('Subang Square')">
                        <span class="ac-title">Subang Square</span>
                        <span class="ac-subtitle">Subang</span>
                    </div>
                    <div class="ac-item" onclick="selectLocation('Parking Building ABC')">
                        <span class="ac-title">Parking Building ABC</span>
                        <span class="ac-subtitle">Bandung</span>
                    </div>
                    <div style="padding: 8px 16px; background: var(--background); font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Suggested Areas</div>
                    <div class="ac-item" onclick="selectLocation('Jakarta Selatan')"><span class="ac-title">Jakarta Selatan</span></div>
                    <div class="ac-item" onclick="selectLocation('Bandung')"><span class="ac-title">Bandung</span></div>
                </div>
            </div>
            
            <button class="location-btn" id="locationBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                <span id="locationText">Use my location</span>
            </button>
        </div>
        
        <div class="quick-filters">
            <button class="filter-action" id="openFiltersBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filters
                <span style="background: var(--primary); color: white; border-radius: 10px; padding: 2px 6px; font-size: 10px; margin-left: 4px; display: none;" id="filterCount">0</span>
            </button>
            <div style="width: 1px; height: 32px; background: var(--border); margin: 0 4px;"></div>
            <button class="filter-chip active" onclick="toggleChip(this)">Available Now</button>
            <button class="filter-chip" onclick="toggleChip(this)">Nearest</button>
            <button class="filter-chip" onclick="toggleChip(this)">Lowest Price</button>
            <button class="filter-chip active" onclick="toggleChip(this)">Car</button>
            <button class="filter-chip" onclick="toggleChip(this)">Motorcycle</button>
            <button class="filter-chip" onclick="toggleChip(this)">EV</button>
            <button class="filter-chip" onclick="toggleChip(this)">VIP</button>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<main class="search-main-content">
    <!-- LEFT: RESULTS -->
    <div class="results-panel">
        <div class="results-header">
            <div>
                <h3 style="font-size: 1rem; color: var(--primary); margin-bottom: 2px;">Parking near Jakarta Selatan</h3>
                <p style="font-size: 0.875rem; color: var(--text-muted);" id="resultCountText">128 locations found</p>
            </div>
            <div class="sort-control">
                <label for="sortSelect">Sort:</label>
                <select id="sortSelect" class="sort-select">
                    <option value="nearest">Nearest</option>
                    <option value="available">Most Available</option>
                    <option value="price">Lowest Price</option>
                    <option value="rating">Top Rated</option>
                </select>
            </div>
        </div>
        
        <div class="results-list">
            
            <!-- Card 1 (Recommended) -->
            <div class="result-card" id="card-1" data-lat="-6.235" data-lng="106.820" data-status="success" data-slots="327" onmouseover="hoverMarker(1)" onmouseout="unhoverMarker(1)" onclick="selectCard(1)">
                <div class="card-recommended">Recommended</div>
                <div class="card-header" style="margin-top: 12px;">
                    <div class="card-title-area">
                        <h3>Mall XYZ</h3>
                        <div class="card-subtitle">Jakarta Selatan • <span style="color: var(--success); font-weight: 500;">Open now</span></div>
                    </div>
                    <div class="card-rating">
                        4.8 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                </div>
                
                <div class="card-availability">
                    <div class="avail-badge success">Available</div>
                    <div class="avail-text">327 slots available</div>
                </div>
                
                <div class="card-details">
                    <div class="detail-item">
                        <span class="detail-label">Distance</span>
                        <span class="detail-value">2.4 km</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Price</span>
                        <span class="detail-value">Rp5.000/hour</span>
                    </div>
                </div>
                
                <div class="card-facilities">
                    <div class="facility-icon" title="EV Charging"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg></div>
                    <div class="facility-icon" title="CCTV Monitoring"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                    <div class="facility-icon" title="24/7 Access"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                </div>
                
                <div class="card-actions">
                    <button class="btn btn-primary" onclick="event.stopPropagation(); window.location.href='/location-detail'">View Parking</button>
                    @if($isAuthenticated)
                    <button class="btn btn-secondary" style="border-color: var(--primary); color: var(--primary);" onclick="event.stopPropagation(); window.location.href='/reservations'">Reserve</button>
                    @else
                    <button class="btn btn-secondary" onclick="event.stopPropagation(); alert('Navigating...')">Navigate</button>
                    @endif
                </div>
            </div>

            <!-- Card 2 (Limited) -->
            <div class="result-card" id="card-2" data-lat="-6.240" data-lng="106.810" data-status="warning" data-slots="24" onmouseover="hoverMarker(2)" onmouseout="unhoverMarker(2)" onclick="selectCard(2)">
                <div class="card-header">
                    <div class="card-title-area">
                        <h3>Subang Square</h3>
                        <div class="card-subtitle">Subang • <span style="color: var(--success); font-weight: 500;">Open now</span></div>
                    </div>
                    <div class="card-rating">
                        4.5 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                </div>
                
                <div class="card-availability">
                    <div class="avail-badge warning">Limited</div>
                    <div class="avail-text">24 slots available</div>
                </div>
                
                <div class="card-details">
                    <div class="detail-item">
                        <span class="detail-label">Distance</span>
                        <span class="detail-value">3.1 km</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Price</span>
                        <span class="detail-value">Rp4.000/hour</span>
                    </div>
                </div>
                
                <div class="card-facilities">
                    <div class="facility-icon" title="CCTV Monitoring"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                </div>
                
                <div class="card-actions">
                    <button class="btn btn-primary" onclick="event.stopPropagation(); window.location.href='/location-detail'">View Parking</button>
                    @if($isAuthenticated)
                    <button class="btn btn-secondary" onclick="event.stopPropagation(); alert('Navigating...')">Navigate</button>
                    @else
                    <button class="btn btn-secondary" onclick="event.stopPropagation(); alert('Navigating...')">Navigate</button>
                    @endif
                </div>
            </div>

            <!-- Card 3 (Full) -->
            <div class="result-card" id="card-3" data-lat="-6.220" data-lng="106.830" data-status="danger" data-slots="0" onmouseover="hoverMarker(3)" onmouseout="unhoverMarker(3)" onclick="selectCard(3)">
                <div class="card-header">
                    <div class="card-title-area">
                        <h3>Parking Building ABC</h3>
                        <div class="card-subtitle">Bandung • <span style="color: var(--success); font-weight: 500;">Open now</span></div>
                    </div>
                    <div class="card-rating">
                        4.2 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                </div>
                
                <div class="card-availability">
                    <div class="avail-badge danger">Full</div>
                    <div class="avail-text">0 slots available</div>
                </div>
                
                <div class="card-details">
                    <div class="detail-item">
                        <span class="detail-label">Distance</span>
                        <span class="detail-value">4.5 km</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Price</span>
                        <span class="detail-value">Rp6.000/hour</span>
                    </div>
                </div>
                
                <div class="card-actions">
                    <button class="btn btn-secondary" style="width:100%" onclick="event.stopPropagation(); window.location.href='/location-detail'">View Location</button>
                </div>
            </div>
            
            <!-- Loading Skeleton Example (Hidden by default) -->
            <div id="skeletonLoader" style="display:none; flex-direction:column; gap:16px;">
                <div class="result-card" style="border:none;">
                    <div class="skeleton" style="height: 24px; width: 60%; margin-bottom: 8px;"></div>
                    <div class="skeleton" style="height: 16px; width: 40%; margin-bottom: 24px;"></div>
                    <div class="skeleton" style="height: 32px; width: 120px; margin-bottom: 16px;"></div>
                    <div style="display:flex; gap:16px; margin-bottom:24px;">
                        <div class="skeleton" style="height: 40px; width: 50%;"></div>
                        <div class="skeleton" style="height: 40px; width: 50%;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- RIGHT: MAP -->
    @php
        $googleMapsKey = env('VITE_GOOGLE_MAPS_API_KEY', '');
    @endphp
    <div class="map-panel" style="position: relative;">
        @if(empty($googleMapsKey))
            <!-- LEAFLET MAP PROVIDER -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
            <div id="leafletMap" style="width: 100%; height: 100%; z-index: 1;"></div>
        @else
            <div id="googleMap" style="width: 100%; height: 100%; z-index: 1;"></div>
        @endif

        <div class="map-controls" style="z-index: 3;">
            <div class="map-btn-group">
                <button class="map-btn" aria-label="Zoom In" id="mapZoomIn"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                <button class="map-btn" aria-label="Zoom Out" id="mapZoomOut"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
            </div>
            <button class="map-btn" aria-label="Current Location" id="mapCurrentLoc"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg></button>
        </div>
    </div>
</main>

<!-- MOBILE VIEW TOGGLE -->
<div class="mobile-view-toggle">
    <button class="toggle-btn active" id="btnListMode" onclick="setMobileMode('list')">List</button>
    <button class="toggle-btn" id="btnMapMode" onclick="setMobileMode('map')">Map</button>
</div>

<!-- FILTER DRAWER OVERLAY & PANEL -->
<div class="filter-drawer-overlay" id="filterOverlay" onclick="closeFilters()"></div>
<div class="filter-drawer" id="filterDrawer">
    <div class="drawer-header">
        <h3>Advanced Filters</h3>
        <button class="close-btn" onclick="closeFilters()"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="drawer-body">
        <div class="filter-section">
            <h4>Availability</h4>
            <div class="filter-options">
                <div class="filter-option selected" onclick="this.classList.toggle('selected')">Available Now</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">Limited</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">Full</div>
            </div>
        </div>
        
        <div class="filter-section">
            <h4>Parking Type</h4>
            <div class="filter-options">
                <div class="filter-option selected" onclick="this.classList.toggle('selected')">Car</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">Motorcycle</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">EV</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">VIP</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">Disabled</div>
            </div>
        </div>
        
        <div class="filter-section">
            <h4>Distance</h4>
            <div class="filter-options">
                <div class="filter-option" onclick="this.classList.toggle('selected')">&lt; 1 km</div>
                <div class="filter-option selected" onclick="this.classList.toggle('selected')">1–3 km</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">3–5 km</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">5+ km</div>
            </div>
        </div>
        
        <div class="filter-section">
            <h4>Facilities</h4>
            <div class="filter-options">
                <div class="filter-option" onclick="this.classList.toggle('selected')">EV Charging</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">Disabled Parking</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">VIP Parking</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">CCTV</div>
                <div class="filter-option" onclick="this.classList.toggle('selected')">24/7</div>
            </div>
        </div>
    </div>
    <div class="drawer-footer">
        <button class="btn btn-secondary" onclick="clearFilters()">Clear All</button>
        <button class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    // Interactions and state
    
    // Autocomplete
    const searchInput = document.getElementById('searchInput');
    const wrapper = document.getElementById('searchInputWrapper');
    
    if (searchInput && wrapper) {
        searchInput.addEventListener('focus', () => wrapper.classList.add('active'));
        document.addEventListener('click', (e) => {
            if(!wrapper.contains(e.target)) wrapper.classList.remove('active');
        });
    }
    
    function selectLocation(val) {
        if(searchInput) searchInput.value = val;
        if(wrapper) wrapper.classList.remove('active');
        simulateSearch();
    }
    
    // Quick Filters
    function toggleChip(btn) {
        btn.classList.toggle('active');
        simulateSearch();
    }
    
    // Use My Location
    const locBtn = document.getElementById('locationBtn');
    const locText = document.getElementById('locationText');
    if (locBtn && locText) {
        locBtn.addEventListener('click', () => {
            locBtn.classList.toggle('active');
            if(locBtn.classList.contains('active')) {
                locText.textContent = 'Current location detected';
                // Trigger skeleton
                simulateSearch();
            } else {
                locText.textContent = 'Use my location';
            }
        });
    }
    
    function simulateSearch() {
        const cards = document.querySelectorAll('.result-card');
        const skeleton = document.getElementById('skeletonLoader');
        const countText = document.getElementById('resultCountText');
        
        if(cards) cards.forEach(c => c.style.display = 'none');
        if(skeleton) skeleton.style.display = 'flex';
        
        // Hide markers
        if (mapInstance) {
            Object.values(mapMarkers).forEach(m => {
                if (googleMapsKey) m.map = null;
                else mapInstance.removeLayer(m);
            });
        }
        
        setTimeout(() => {
            if(skeleton) skeleton.style.display = 'none';
            if(cards) cards.forEach(c => c.style.display = 'block');
            
            // Note: In a real app, only matching cards would be shown.
            // We reshow all markers for the mock search:
            if (mapInstance) {
                Object.values(mapMarkers).forEach(m => {
                    if (googleMapsKey) m.map = mapInstance;
                    else m.addTo(mapInstance);
                });
            }
            
            if(countText) countText.textContent = Math.floor(Math.random() * 50 + 10) + ' locations found';
        }, 800);
    }
    
    // Card and Marker Selection
    let selectedId = null;
    let mapInstance = null;
    let mapMarkers = {};
    
    const googleMapsKey = "{{ $googleMapsKey ?? '' }}";

    function getMarkerEl(id) {
        if (!mapMarkers[id]) return null;
        if (googleMapsKey) return mapMarkers[id].content;
        // Leaflet uses a wrapper div, so we select our inner .map-marker
        const el = mapMarkers[id].getElement();
        return el ? el.querySelector('.map-marker') : null;
    }
    
    function selectCard(id) {
        // Deselect previous
        if(selectedId) {
            const prevCard = document.getElementById('card-'+selectedId);
            if(prevCard) prevCard.classList.remove('selected');
            
            const prevEl = getMarkerEl(selectedId);
            if (prevEl) {
                prevEl.classList.remove('selected');
                if (googleMapsKey) { mapMarkers[selectedId].zIndex = 1; }
                else { prevEl.style.zIndex = 1; }
            }
        }
        
        // If clicking the same one, just toggle off
        if (selectedId == id) {
            selectedId = null;
            return;
        }
        
        selectedId = id;
        const card = document.getElementById('card-'+id);
        
        if (card) {
            card.classList.add('selected');
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        const el = getMarkerEl(id);
        if (el && mapInstance) {
            el.classList.add('selected');
            
            if (googleMapsKey) {
                mapMarkers[id].zIndex = 100;
                mapInstance.panTo(mapMarkers[id].position);
            } else {
                el.style.zIndex = 100;
                mapInstance.panTo(mapMarkers[id].getLatLng());
            }
        }
    }
    
    function hoverMarker(id) {
        if(selectedId != id) {
            const el = getMarkerEl(id);
            if (el) {
                el.style.transform = 'scale(1.05)';
                if (googleMapsKey) mapMarkers[id].zIndex = 10;
                else el.style.zIndex = 10;
            }
        }
    }
    
    function unhoverMarker(id) {
        if(selectedId != id) {
            const el = getMarkerEl(id);
            if (el) {
                el.style.transform = '';
                if (googleMapsKey) mapMarkers[id].zIndex = 1;
                else el.style.zIndex = 1;
            }
        }
    }

    // Mobile View Toggle
    function setMobileMode(mode) {
        const body = document.body;
        const btnList = document.getElementById('btnListMode');
        const btnMap = document.getElementById('btnMapMode');
        
        if(mode === 'map') {
            body.classList.add('map-mode');
            if(btnList) btnList.classList.remove('active');
            if(btnMap) btnMap.classList.add('active');
            // Force leaflet resize if needed
            if (!googleMapsKey && mapInstance) setTimeout(() => mapInstance.invalidateSize(), 100);
        } else {
            body.classList.remove('map-mode');
            if(btnMap) btnMap.classList.remove('active');
            if(btnList) btnList.classList.add('active');
        }
    }

    // Filter Drawer
    const overlay = document.getElementById('filterOverlay');
    const drawer = document.getElementById('filterDrawer');
    
    const openFiltersBtn = document.getElementById('openFiltersBtn');
    if (openFiltersBtn) {
        openFiltersBtn.addEventListener('click', () => {
            if (overlay) overlay.classList.add('active');
            if (drawer) drawer.classList.add('active');
        });
    }
    
    function closeFilters() {
        try {
            const ov = document.getElementById('filterOverlay');
            const dr = document.getElementById('filterDrawer');
            if(ov) ov.classList.remove('active');
            if(dr) dr.classList.remove('active');
        } catch(e) {
            console.error("Filter close error:", e);
        }
    }
    
    function clearFilters() {
        document.querySelectorAll('.filter-option.selected').forEach(el => el.classList.remove('selected'));
    }
    
    function applyFilters() {
        try {
            const countBadge = document.getElementById('filterCount');
            const count = document.querySelectorAll('.filter-option.selected').length;
            if(countBadge) {
                if(count > 0) {
                    countBadge.textContent = count;
                    countBadge.style.display = 'inline-block';
                } else {
                    countBadge.style.display = 'none';
                }
            }
        } catch(e) {
            console.error("Filter count update error:", e);
        }
        closeFilters();
        if(typeof simulateSearch === 'function') simulateSearch();
    }

    // --- MAP INITIALIZATION (Google Maps OR Leaflet) --- //

    async function initGoogleMaps() {
        try {
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
            
            mapInstance = new Map(document.getElementById("googleMap"), {
                center: { lat: -6.230, lng: 106.820 },
                zoom: 13,
                mapId: "DEMO_MAP_ID",
                disableDefaultUI: true, // using custom UI
            });
            
            const bounds = new google.maps.LatLngBounds();
            let hasLocations = false;

            document.querySelectorAll('.result-card').forEach(card => {
                const id = card.id.replace('card-', '');
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                const status = card.dataset.status;
                const slots = parseInt(card.dataset.slots);
                const title = card.querySelector('.card-title-area h3')?.textContent || 'Parking Location';

                if (!isNaN(lat) && !isNaN(lng)) {
                    hasLocations = true;
                    const pos = { lat, lng };
                    bounds.extend(pos);
                    
                    const markerDiv = document.createElement('div');
                    markerDiv.className = `map-marker ${status}`;
                    markerDiv.innerHTML = `<span class="ind" style="width:8px; height:8px; border-radius:50%;"></span> ${slots > 0 ? slots : 'FULL'}`;
                    markerDiv.style.position = 'relative'; // reset custom styles
                    markerDiv.style.cursor = 'pointer';
                    
                    const marker = new AdvancedMarkerElement({
                        map: mapInstance,
                        position: pos,
                        content: markerDiv,
                        title: title,
                    });
                    
                    marker.addListener('click', () => selectCard(id));
                    mapMarkers[id] = marker;
                }
            });
            
            if (hasLocations) mapInstance.fitBounds(bounds, { padding: 50 });
        } catch (e) {
            console.error("Google Maps init failed:", e);
        }
    }

    function initLeaflet() {
        const script = document.createElement('script');
        script.src = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js";
        script.onload = () => {
            mapInstance = L.map('leafletMap', { zoomControl: false }).setView([-6.230, 106.820], 13);
            
            // Using standard OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(mapInstance);
            
            const bounds = [];
            let hasLocations = false;

            document.querySelectorAll('.result-card').forEach(card => {
                const id = card.id.replace('card-', '');
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                const status = card.dataset.status;
                const slots = parseInt(card.dataset.slots);
                const title = card.querySelector('.card-title-area h3')?.textContent || 'Parking Location';

                if (!isNaN(lat) && !isNaN(lng)) {
                    hasLocations = true;
                    bounds.push([lat, lng]);
                    
                    const iconHtml = `<div class="map-marker ${status}" style="position:relative; transform:none;"><span class="ind" style="width:8px; height:8px; border-radius:50%;"></span> ${slots > 0 ? slots : 'FULL'}</div>`;
                    
                    const customIcon = L.divIcon({
                        html: iconHtml,
                        className: '', // prevent default leaflet styling
                        iconSize: [40, 24],
                        iconAnchor: [20, 24] // anchor bottom center
                    });
                    
                    const marker = L.marker([lat, lng], {icon: customIcon, title: title}).addTo(mapInstance);
                    marker.on('click', () => selectCard(id));
                    mapMarkers[id] = marker;
                }
            });
            
            if (hasLocations) mapInstance.fitBounds(bounds, { padding: [50, 50] });
        };
        document.head.appendChild(script);
    }

    // Map Controls
    const zoomInBtn = document.getElementById('mapZoomIn');
    const zoomOutBtn = document.getElementById('mapZoomOut');
    const currentLocBtn = document.getElementById('mapCurrentLoc');
    
    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', () => {
            if(mapInstance) {
                if (googleMapsKey) mapInstance.setZoom(mapInstance.getZoom() + 1);
                else mapInstance.zoomIn();
            }
        });
    }
    
    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', () => {
            if(mapInstance) {
                if (googleMapsKey) mapInstance.setZoom(mapInstance.getZoom() - 1);
                else mapInstance.zoomOut();
            }
        });
    }
    
    if (currentLocBtn) {
        currentLocBtn.addEventListener('click', () => {
            if(navigator.geolocation && mapInstance) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        if (googleMapsKey) {
                            mapInstance.panTo({lat: pos.coords.latitude, lng: pos.coords.longitude});
                            mapInstance.setZoom(15);
                        } else {
                            mapInstance.setView([pos.coords.latitude, pos.coords.longitude], 15);
                        }
                    },
                    (err) => { alert("Unable to access your location."); },
                    { timeout: 5000 }
                );
            } else if (!mapInstance) {
                alert("Map is not available yet.");
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        });
    }

    // Initialize appropriate map provider
    if (googleMapsKey) {
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: googleMapsKey,
          v: "weekly",
        });
        initGoogleMaps();
    } else {
        initLeaflet();
    }
</script>
