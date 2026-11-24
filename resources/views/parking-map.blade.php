@push('styles')
    <link rel="stylesheet" href="{{ asset('css/parking-map.css') }}">
    <style>
        /* Mobile overrides for authenticated shell */
        @media (max-width: 768px) {
            .map-workspace {
                padding-bottom: 64px;
            }
            .map-controls-overlay {
                bottom: calc(16px + 64px) !important;
            }
            .slot-drawer {
                bottom: 64px !important;
            }
            .legend-bar {
                padding-bottom: 12px; 
            }
        }
        /* Rendered slot base styles handled by CSS */
    </style>
@endpush

<x-layouts.app activeNav="parking-map" containerClass="map-page-body w-full max-w-full p-0 space-y-0 relative min-h-screen">

    <!-- COMPACT HEADER / BREADCRUMB -->
    <header class="map-page-header">
        <div class="header-top">
            <div>
                <div class="breadcrumb-small mb-2">
                    <a href="/app/search">Find Parking</a> / 
                    <a href="/location-detail" class="font-medium">Mall XYZ</a> / 
                    <span style="color:var(--primary); font-weight:600;">Parking Map</span>
                </div>
                <h1 class="page-title text-xl md:text-2xl font-bold flex items-center gap-3">
                    Mall XYZ
                    <span class="text-xs font-semibold px-2 py-1 bg-green-100 text-green-700 rounded-md whitespace-nowrap">Open now</span>
                </h1>
                <p class="page-subtitle mt-1">Jakarta Selatan</p>
            </div>
            
            <div style="display:flex; flex-direction:column; align-items:flex-end; justify-content:space-between; gap:8px;">
                <div class="live-status">
                    <span class="dot"></span>
                    <span id="lastUpdatedText">Updated 1 min ago</span>
                </div>
                <div class="location-selector" style="pointer-events: none; padding: 4px 10px; font-size: 0.75rem;">
                    🚗 Car
                </div>
            </div>
        </div>
    </header>

    <!-- TOOLBAR -->
    <section class="map-toolbar">
        <div class="toolbar-left">
            <div class="floor-selector" id="floorSelector">
                <!-- Floors rendered via JS -->
            </div>
            
            <div class="zone-selector" id="zoneSelector">
                <!-- Zones rendered via JS -->
            </div>
        </div>
        
        <div class="parking-summary flex gap-4">
            <div class="summary-item available">
                <span class="val text-lg" id="summaryAvailable">0 / 0</span>
                <span class="label">Available</span>
            </div>
        </div>
    </section>

    <!-- LEGEND -->
    <div class="legend-bar">
        <div class="legend-item avail"><div class="legend-color"></div> Available</div>
        <div class="legend-item occ"><div class="legend-color"></div> Occupied</div>
        <div class="legend-item res"><div class="legend-color"></div> Reserved</div>
        <div class="legend-item ev"><div class="legend-color"></div> EV</div>
        <div class="legend-item dis"><div class="legend-color">
            <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        </div> Disabled</div>
        <div class="legend-item vip"><div class="legend-color"></div> VIP</div>
    </div>

    <!-- MAIN WORKSPACE -->
    <div class="map-workspace relative">
        
        <div class="map-container" id="mapContainer">
            
            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="slotSearch" class="search-slot-input" placeholder="Search slot (e.g. A01)" onkeyup="handleSearch(event)">
            
            <div class="map-controls-overlay">
                <div class="map-ctrl-group">
                    <button class="map-ctrl-btn" onclick="zoomMap(0.2)" aria-label="Zoom In"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                    <button class="map-ctrl-btn" onclick="zoomMap(-0.2)" aria-label="Zoom Out"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                </div>
                <div class="map-ctrl-group">
                    <button class="map-ctrl-btn" onclick="fitFloor()" title="Fit Floor" aria-label="Fit Floor"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 14l-2 2v4h4l2-2M20 14l2 2v4h-4l-2-2M14 4l2-2h4v4l-2 2M10 4L8 2H4v4l2 2"/></svg></button>
                    <button class="map-ctrl-btn" onclick="resetMap()" title="Center Map" aria-label="Center Map"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg></button>
                </div>
            </div>

            <!-- CANVAS -->
            <div class="map-canvas" id="mapCanvas">
                <!-- Rendered by JS -->
            </div>
        </div>
        
        <!-- SLOT DETAIL DRAWER -->
        <div class="slot-drawer" id="slotDrawer">
            <div class="drawer-header">
                <div>
                    <div class="text-xs text-gray-500 font-semibold mb-1 uppercase tracking-wider">Parking Spot</div>
                    <div class="slot-drawer-title" id="sdTitle">--</div>
                    <div class="slot-drawer-status success" id="sdStatus">--</div>
                </div>
                <button class="drawer-close" onclick="closeDrawer()" aria-label="Close detail"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
            </div>
            <div class="drawer-body">
                <div class="drawer-info-row">
                    <span class="drawer-info-label">Type</span>
                    <span class="drawer-info-val" id="sdType">--</span>
                </div>
                <div class="drawer-info-row">
                    <span class="drawer-info-label">Floor</span>
                    <span class="drawer-info-val" id="sdFloor">--</span>
                </div>
                <div class="drawer-info-row">
                    <span class="drawer-info-label">Zone</span>
                    <span class="drawer-info-val" id="sdZone">--</span>
                </div>
                
                <div style="margin-top:24px; padding:16px; background:var(--background); border-radius:var(--radius-md); font-size:0.875rem;" id="drawerLandmarkArea">
                    <div style="font-weight:600; color:var(--primary); margin-bottom:8px;">Nearby Landmarks</div>
                    <div style="display:flex; align-items:center; gap:8px; color:var(--text-muted); margin-bottom: 4px;" id="sdLandmark">
                        --
                    </div>
                </div>
            </div>
            <div class="drawer-footer">
                <button class="btn btn-primary" style="width:100%;" id="btnSelectSpot" onclick="confirmSelection()">Select this spot</button>
                <button class="btn btn-secondary" style="width:100%;" id="btnPathToSpot" onclick="showPathToSpot()">Path to spot</button>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        // --- STRUCTURED DATA MODEL ---
        const facilityData = {
            id: 'mall-xyz',
            name: 'Mall XYZ',
            floors: [
                { id: 'B2', name: 'Basement 2', level: -2, totalSlots: 400, availableSlots: 10, zones: ['All', 'Zone C', 'Zone D'] },
                { id: 'B1', name: 'Basement 1', level: -1, totalSlots: 450, availableSlots: 317, zones: ['All', 'Zone A', 'Zone B'] },
                { id: 'L1', name: 'Level 1', level: 1, totalSlots: 0, availableSlots: 0, zones: [] },
                { id: 'L2', name: 'Level 2', level: 2, totalSlots: 200, availableSlots: 0, zones: ['All'] }
            ]
        };

        const mockSlotsB1 = [
            { id: 'A01', floorId: 'B1', zoneId: 'Zone A', type: 'car', status: 'available', coords: { x: 1220, y: 1000 }, rotation: 0 },
            { id: 'A02', floorId: 'B1', zoneId: 'Zone A', type: 'car', status: 'occupied', coords: { x: 1220, y: 1110 }, rotation: 0 },
            { id: 'A03', floorId: 'B1', zoneId: 'Zone A', type: 'car', status: 'available', coords: { x: 1220, y: 1220 }, rotation: 0 },
            { id: 'A04', floorId: 'B1', zoneId: 'Zone A', type: 'car', status: 'reserved', coords: { x: 1400, y: 1000 }, rotation: 0 },
            { id: 'A05', floorId: 'B1', zoneId: 'Zone A', type: 'ev', status: 'available', coords: { x: 1400, y: 1110 }, rotation: 0 },
            { id: 'A06', floorId: 'B1', zoneId: 'Zone A', type: 'car', status: 'unknown', coords: { x: 1400, y: 1220 }, rotation: 0 },
            
            { id: 'B01', floorId: 'B1', zoneId: 'Zone B', type: 'disabled', status: 'available', coords: { x: 1700, y: 1000 }, rotation: 0 },
            { id: 'B02', floorId: 'B1', zoneId: 'Zone B', type: 'vip', status: 'occupied', coords: { x: 1700, y: 1110 }, rotation: 0 },
            { id: 'B03', floorId: 'B1', zoneId: 'Zone B', type: 'car', status: 'available', coords: { x: 1700, y: 1220 }, rotation: 0 },
            { id: 'B04', floorId: 'B1', zoneId: 'Zone B', type: 'car', status: 'available', coords: { x: 1800, y: 1220 }, rotation: 45 },
            { id: 'B05', floorId: 'B1', zoneId: 'Zone B', type: 'motorcycle', status: 'available', coords: { x: 1800, y: 1110 }, rotation: 90, width: 40, height: 80 }
        ];

        const mockLandmarksB1 = [
            { type: 'entry', label: 'ENTRANCE A', coords: { x: 1000, y: 800 } },
            { type: 'exit', label: 'EXIT B', coords: { x: 1800, y: 800 } },
            { type: 'elevator', label: 'ELEVATOR', coords: { x: 1400, y: 700 } },
            { type: 'ramp', label: 'RAMP UP TO L1', coords: { x: 1000, y: 1300 } }
        ];

        const mockLanesB1 = [
            { label: 'MAIN DRIVEWAY', coords: { x: 1000, y: 900 }, width: 950, height: 80 },
            { label: 'ZONE A AISLE', coords: { x: 1300, y: 980 }, width: 80, height: 400 },
            { label: 'ZONE B AISLE', coords: { x: 1600, y: 980 }, width: 80, height: 400 }
        ];

        const mockZoneBoundsB1 = [
            { label: 'Zone A', coords: { x: 1180, y: 970 }, width: 300, height: 420 },
            { label: 'Zone B', coords: { x: 1580, y: 970 }, width: 300, height: 420 }
        ];

        // --- STATE ---
        let currentFloorId = 'B1';
        let currentZoneId = 'All';
        let currentSlotId = null;

        // Map View State
        let scale = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;
        const container = document.getElementById('mapContainer');
        const canvas = document.getElementById('mapCanvas');

        // --- INITIALIZATION ---
        function init() {
            renderFloorSelector();
            setFloor('B1'); // triggers renderMap
            bindMapEvents();
        }

        // --- RENDERERS ---
        function renderFloorSelector() {
            const fs = document.getElementById('floorSelector');
            fs.innerHTML = facilityData.floors.map(f => `
                <button class="floor-btn ${f.id === currentFloorId ? 'active' : ''}" 
                        onclick="setFloor('${f.id}')"
                        aria-label="Floor ${f.name}">
                    ${f.id}
                </button>
            `).join('');
        }

        function renderZoneSelector(zones) {
            const zs = document.getElementById('zoneSelector');
            if(zones.length <= 1) {
                zs.innerHTML = '';
                return;
            }
            zs.innerHTML = zones.map(z => `
                <button class="zone-btn ${z === currentZoneId ? 'active' : ''}" 
                        onclick="setZone('${z}')">
                    ${z}
                </button>
            `).join('');
        }

        function updateSummary() {
            const floor = facilityData.floors.find(f => f.id === currentFloorId);
            if(floor) {
                document.getElementById('summaryAvailable').textContent = `${floor.availableSlots} / ${floor.totalSlots}`;
            }
        }

        function renderMap() {
            closeDrawer();
            canvas.innerHTML = '';
            
            const floor = facilityData.floors.find(f => f.id === currentFloorId);
            
            if (floor.totalSlots === 0) {
                canvas.innerHTML = `<div style="position:absolute; top:1000px; left:1500px; transform:translate(-50%, -50%); font-size:1.5rem; color:var(--text-muted); font-weight:bold;">No parking spaces are configured for this floor.</div>`;
                return;
            }
            
            // Only B1 has mock data in this demo
            if (currentFloorId !== 'B1') {
                canvas.innerHTML = `<div style="position:absolute; top:1000px; left:1500px; transform:translate(-50%, -50%); font-size:1.5rem; color:var(--text-muted); font-weight:bold;">No available parking on this floor.</div>`;
                return;
            }

            // Render Zones
            mockZoneBoundsB1.forEach(z => {
                const zDiv = document.createElement('div');
                zDiv.style.cssText = `position:absolute; top:${z.coords.y}px; left:${z.coords.x}px; width:${z.width}px; height:${z.height}px; border:2px dashed rgba(59,130,246,0.3); border-radius:12px; pointer-events:none;`;
                zDiv.innerHTML = `<div style="position:absolute; top:-12px; left:12px; background:#F1F5F9; padding:0 8px; color:#3B82F6; font-weight:bold;">${z.label}</div>`;
                canvas.appendChild(zDiv);
            });

            // Render Lanes
            mockLanesB1.forEach(l => {
                const lDiv = document.createElement('div');
                lDiv.className = 'drive-lane';
                lDiv.style.cssText = `top:${l.coords.y}px; left:${l.coords.x}px; width:${l.width}px; height:${l.height}px;`;
                lDiv.textContent = l.label;
                canvas.appendChild(lDiv);
            });

            // Render Landmarks
            mockLandmarksB1.forEach(lm => {
                const lmDiv = document.createElement('div');
                lmDiv.className = `gate-marker ${lm.type === 'entry' ? 'entry' : (lm.type === 'exit' ? 'exit' : '')}`;
                if (lm.type !== 'entry' && lm.type !== 'exit') {
                    lmDiv.style.borderColor = '#64748B';
                    lmDiv.style.color = '#64748B';
                }
                lmDiv.style.top = `${lm.coords.y}px`;
                lmDiv.style.left = `${lm.coords.x}px`;
                
                let icon = '';
                if(lm.type==='entry') icon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`;
                else if(lm.type==='exit') icon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>`;
                else if(lm.type==='elevator') icon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><line x1="12" y1="8" x2="12" y2="16"/><polyline points="8 12 12 8 16 12"/></svg>`;
                else if(lm.type==='ramp') icon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>`;
                
                lmDiv.innerHTML = `${icon} ${lm.label}`;
                canvas.appendChild(lmDiv);
            });

            // Render Slots
            mockSlotsB1.forEach(slot => {
                if(currentZoneId !== 'All' && slot.zoneId !== currentZoneId) return;

                const sDiv = document.createElement('div');
                // Construct classes
                let classes = `slot ${slot.status}`;
                if (slot.type === 'ev') classes += ' ev';
                if (slot.type === 'disabled') classes += ' disabled';
                if (slot.type === 'vip') classes += ' vip';
                
                sDiv.className = classes;
                sDiv.id = `slot-${slot.id}`;
                sDiv.style.top = `${slot.coords.x}px`; // Note: x is mapped to left below
                sDiv.style.top = `${slot.coords.y}px`;
                sDiv.style.left = `${slot.coords.x}px`;
                
                if (slot.rotation) sDiv.style.transform = `rotate(${slot.rotation}deg)`;
                if (slot.width) sDiv.style.width = `${slot.width}px`;
                if (slot.height) sDiv.style.height = `${slot.height}px`;

                // Add tabindex for accessibility
                if(slot.status === 'available') {
                    sDiv.setAttribute('tabindex', '0');
                    sDiv.setAttribute('aria-label', `Parking slot ${slot.id}, available, ${slot.type}`);
                    sDiv.onclick = () => selectSlot(slot.id);
                    sDiv.onkeydown = (e) => { if(e.key==='Enter') selectSlot(slot.id); };
                } else {
                    sDiv.setAttribute('aria-hidden', 'true');
                }

                let innerHTML = `<div class="slot-id" style="${slot.rotation ? `transform: rotate(-${slot.rotation}deg)` : ''}">${slot.id}</div>`;
                if (slot.type === 'ev') innerHTML += `<svg class="slot-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>`;
                if (slot.type === 'disabled') innerHTML += `<svg class="slot-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>`;

                sDiv.innerHTML = innerHTML;
                canvas.appendChild(sDiv);
            });

            // Mock Nav Path Layer
            const pathDiv = document.createElement('div');
            pathDiv.className = 'nav-path';
            pathDiv.id = 'navPathOverlay';
            pathDiv.style.display = 'none';
            // Hardcoded mock path
            pathDiv.innerHTML = `
                <div style="position:absolute; top: 940px; left: 1080px; width: 160px; height: 10px; background:var(--accent);"></div>
                <div style="position:absolute; top: 940px; left: 1235px; width: 10px; height: 60px; background:var(--accent);"></div>
            `;
            canvas.appendChild(pathDiv);
            
            fitFloor();
        }

        // --- ACTIONS ---
        function setFloor(id) {
            currentFloorId = id;
            currentZoneId = 'All'; // Reset zone on floor change
            const floor = facilityData.floors.find(f => f.id === id);
            
            renderFloorSelector();
            renderZoneSelector(floor ? floor.zones : []);
            updateSummary();
            renderMap();
        }

        function setZone(id) {
            currentZoneId = id;
            renderZoneSelector(facilityData.floors.find(f => f.id === currentFloorId).zones);
            renderMap(); // Re-render to filter slots visually
        }

        function handleSearch(e) {
            if(e.key === 'Enter') {
                const query = e.target.value.toUpperCase();
                const slotData = mockSlotsB1.find(s => s.id === query);
                
                if (!slotData || slotData.floorId !== currentFloorId) {
                    alert(`Slot ${query} wasn't found on this floor.`);
                    return;
                }
                if (slotData.status !== 'available') {
                    alert(`Slot ${query} is occupied or unavailable.`);
                    return;
                }
                
                // If it's in a different zone, switch zone to All to ensure it's visible
                if(currentZoneId !== 'All' && slotData.zoneId !== currentZoneId) {
                    setZone('All');
                }
                
                selectSlot(query);
            }
        }

        function selectSlot(id) {
            // Find data
            const slotData = mockSlotsB1.find(s => s.id === id);
            if(!slotData) return;
            
            currentSlotId = id;
            
            // Visual highlight
            document.querySelectorAll('.slot').forEach(s => s.classList.remove('selected'));
            const slotEl = document.getElementById(`slot-${id}`);
            if(slotEl) slotEl.classList.add('selected');
            
            // Pan map
            translateX = -(slotData.coords.x - 1500) * scale;
            translateY = -(slotData.coords.y - 1000) * scale;
            if(window.innerWidth > 768) translateX -= 180;
            else translateY -= 150;
            updateTransform();
            
            // Populate Drawer
            const drawer = document.getElementById('slotDrawer');
            document.getElementById('sdTitle').textContent = id;
            
            const types = { car: 'Car', motorcycle: 'Motorcycle', ev: 'EV Charging', disabled: 'Accessible', vip: 'VIP' };
            document.getElementById('sdType').textContent = types[slotData.type] || 'Standard';
            document.getElementById('sdFloor').textContent = slotData.floorId;
            document.getElementById('sdZone').textContent = slotData.zoneId;
            
            const sdStatus = document.getElementById('sdStatus');
            sdStatus.className = 'slot-drawer-status'; 
            
            if(slotData.type === 'ev') {
                sdStatus.textContent = 'EV Charging';
                sdStatus.style.background = '#E0F2FE'; sdStatus.style.color = '#0284C7';
            } else if(slotData.type === 'vip') {
                sdStatus.textContent = 'VIP Parking';
                sdStatus.style.background = '#FEF3C7'; sdStatus.style.color = '#B45309';
            } else if(slotData.type === 'disabled') {
                sdStatus.textContent = 'Accessible';
                sdStatus.style.background = '#E0E7FF'; sdStatus.style.color = '#4338CA';
            } else {
                sdStatus.textContent = 'Available';
                sdStatus.classList.add('success');
            }
            
            // Landmarks mock
            const lm = document.getElementById('sdLandmark');
            if(slotData.zoneId === 'Zone A') {
                lm.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg> Entrance A (20m)`;
            } else {
                lm.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><line x1="12" y1="8" x2="12" y2="16"/><polyline points="8 12 12 8 16 12"/></svg> Elevator (15m)`;
            }
            
            // Hide path on selection change
            const pathOverlay = document.getElementById('navPathOverlay');
            if(pathOverlay) pathOverlay.style.display = 'none';
            
            document.getElementById('btnPathToSpot').textContent = 'Path to spot';
            
            drawer.classList.add('open');
        }

        function closeDrawer() {
            document.getElementById('slotDrawer').classList.remove('open');
            const el = document.getElementById(`slot-${currentSlotId}`);
            if(el) el.classList.remove('selected');
            currentSlotId = null;
            
            const pathOverlay = document.getElementById('navPathOverlay');
            if(pathOverlay) pathOverlay.style.display = 'none';
        }

        function confirmSelection() {
            if(!currentSlotId) return;
            alert(`Spot ${currentSlotId} selected. This sets your navigation target.`);
            closeDrawer();
        }

        function showPathToSpot() {
            if(!currentSlotId) return;
            const pathOverlay = document.getElementById('navPathOverlay');
            if(pathOverlay) {
                if(pathOverlay.style.display === 'none') {
                    pathOverlay.style.display = 'block';
                    document.getElementById('btnPathToSpot').textContent = 'Hide path';
                    // Pan so path is visible
                    fitFloor();
                } else {
                    pathOverlay.style.display = 'none';
                    document.getElementById('btnPathToSpot').textContent = 'Path to spot';
                }
            }
        }

        // --- MAP CONTROLS ---
        function resetMap() {
            scale = 1;
            translateX = -350; translateY = -50;
            updateTransform();
        }

        function fitFloor() {
            scale = 0.55; translateX = 0; translateY = 0;
            updateTransform();
        }

        function zoomMap(delta) {
            scale += delta;
            if(scale < 0.2) scale = 0.2;
            if(scale > 4) scale = 4;
            updateTransform();
        }

        function updateTransform() {
            canvas.style.transform = `translate(calc(-50% + ${translateX}px), calc(-50% + ${translateY}px)) scale(${scale})`;
        }

        function bindMapEvents() {
            container.addEventListener('mousedown', (e) => {
                if(e.target.closest('.slot') || e.target.closest('.map-controls-overlay') || e.target.closest('.search-slot-input') || e.target.closest('.slot-drawer')) return;
                isDragging = true;
                startX = e.clientX - translateX;
                startY = e.clientY - translateY;
                container.style.cursor = 'grabbing';
            });
            window.addEventListener('mousemove', (e) => {
                if(!isDragging) return;
                translateX = e.clientX - startX;
                translateY = e.clientY - startY;
                updateTransform();
            });
            window.addEventListener('mouseup', () => { isDragging = false; container.style.cursor = 'grab'; });
            container.addEventListener('touchstart', (e) => {
                if(e.target.closest('.slot') || e.target.closest('.map-controls-overlay') || e.target.closest('.slot-drawer')) return;
                isDragging = true;
                startX = e.touches[0].clientX - translateX;
                startY = e.touches[0].clientY - translateY;
            }, {passive: true});
            window.addEventListener('touchmove', (e) => {
                if(!isDragging) return;
                translateX = e.touches[0].clientX - startX;
                translateY = e.touches[0].clientY - startY;
                updateTransform();
            }, {passive: true});
            window.addEventListener('touchend', () => { isDragging = false; });
            container.addEventListener('wheel', (e) => {
                if(e.target.closest('.slot-drawer') || e.target.closest('.map-controls-overlay') || e.target.closest('.legend-bar')) return;
                e.preventDefault();
                zoomMap(e.deltaY > 0 ? -0.1 : 0.1);
            }, {passive: false});
        }

        // Start
        init();
    </script>
    @endpush
</x-layouts.app>
