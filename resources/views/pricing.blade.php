<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Pricing - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pricing-page-body">

    <!-- NAVBAR (Reused) -->
    <x-navbar active="pricing" />

    <!-- HERO SECTION -->
    <section class="pricing-hero">
        <div class="container">
            <div class="pricing-hero-grid">
                <div class="hero-content">
                    <h1>Simple, transparent parking pricing.</h1>
                    <p>Know what to expect before you park. Parking rates can vary by location, vehicle type, parking area, and applicable conditions.</p>
                    <div class="hero-actions">
                        <a href="/search" class="btn btn-primary">Find Parking</a>
                        <a href="#how-it-works" class="btn btn-secondary">How It Works</a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="mock-receipt">
                        <div class="mock-receipt-header">
                            <h3>Mall XYZ</h3>
                            <p>Jakarta Selatan</p>
                        </div>
                        <div class="mock-row"><span>Vehicle</span><span>Car (Regular)</span></div>
                        <div class="mock-row"><span>First hour</span><span>Rp 5.000</span></div>
                        <div class="mock-row"><span>Duration</span><span>3 hours</span></div>
                        <div class="mock-row"><span>Payment</span><span>QRIS</span></div>
                        <div class="mock-row total"><span>Est. Total</span><span>Rp 13.000</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRANSPARENCY CONTEXT -->
    <section class="transparency-section">
        <div class="container transparency-content">
            <div class="transparency-text">
                <h2>Parking rates depend on the location.</h2>
                <p>Because NusaPark connects various properties, the exact price differs based on location rules, vehicle category, and duration. We don't hide this behind fake universal claims.</p>
            </div>
            <div class="transparency-card">
                <h3>Exact price before you park</h3>
                <p>Select a parking location to see its applicable tariff rules immediately.</p>
                <a href="#pricing-selector" class="btn btn-secondary" style="width:100%; border-color:white; color:var(--primary); background:white;">Check Location Pricing</a>
            </div>
        </div>
    </section>

    <!-- PRICING SELECTOR -->
    <section class="pricing-core-section" id="pricing-selector">
        <div class="container">
            <div class="pricing-core-grid">
                
                <!-- Left: Location Select -->
                <div class="location-select-panel">
                    <h3 class="panel-title">Check a location</h3>
                    <div class="search-loc-wrapper">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" class="search-loc-input" placeholder="Search location...">
                    </div>
                    <div class="suggested-locs">
                        <button class="loc-btn active" onclick="setMockLocation('Mall XYZ', this)">NusaPark Central Jakarta (Mall XYZ)</button>
                        <button class="loc-btn" onclick="setMockLocation('Subang Square', this)">NusaPark Subang Square</button>
                        <button class="loc-btn" onclick="setMockLocation('Bandung Center', this)">NusaPark Bandung City Center</button>
                        <button class="loc-btn" onclick="setMockLocation('Surabaya Center', this)">NusaPark Surabaya Central</button>
                    </div>
                </div>

                <!-- Right: Pricing View -->
                <div class="pricing-view-panel">
                    
                    <div class="vehicle-selector">
                        <button class="veh-btn active" onclick="setMockVehicle('car', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg> Car
                        </button>
                        <button class="veh-btn" onclick="setMockVehicle('moto', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg> Motorcycle
                        </button>
                        <button class="veh-btn" onclick="setMockVehicle('ev', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg> EV Charging
                        </button>
                    </div>

                    <div id="pricing-content-area">
                        <div class="pricing-summary-box">
                            <div class="demo-disclaimer">Sample Tariff — Actual rates depend on the location</div>
                            <div style="font-size: 1.125rem; font-weight: 600; margin-bottom: 12px; color: var(--primary);">Estimated Base Rate</div>
                            <div class="pricing-hero-val" id="heroVal">Rp 5.000 <span>/ first hour</span></div>
                            <div style="color: var(--text-muted); font-size: 0.875rem;">Next hour: +Rp 4.000/hr • Daily Max: Rp 40.000</div>
                            
                            <div class="tariff-table-wrapper">
                                <table class="tariff-table">
                                    <thead>
                                        <tr>
                                            <th>Duration</th>
                                            <th class="val-col">Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tariffTbody">
                                        <tr class="highlight-row">
                                            <td>First hour</td>
                                            <td class="val-col">Rp 5.000</td>
                                        </tr>
                                        <tr>
                                            <td>Second hour</td>
                                            <td class="val-col">+ Rp 4.000</td>
                                        </tr>
                                        <tr>
                                            <td>Subsequent hours</td>
                                            <td class="val-col">+ Rp 4.000 / hr</td>
                                        </tr>
                                        <tr>
                                            <td>Daily maximum</td>
                                            <td class="val-col">Rp 40.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- VEHICLE COMPARISON -->
    <section class="comparison-section">
        <div class="container">
            <div class="section-header">
                <h2>Different vehicles, different parking needs.</h2>
                <p>NusaPark systems automatically adapt to standard vehicle categories configured by our location partners.</p>
            </div>
            <div class="vehicle-comparison-grid">
                
                <div class="veh-price-card">
                    <div class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg></div>
                    <h3>Car</h3>
                    <span class="base-price">Rp 5.000 / hr</span>
                    <ul>
                        <li>Standard parking slot</li>
                        <li>ANPR recognition supported</li>
                        <li>Barrier access</li>
                    </ul>
                </div>

                <div class="veh-price-card">
                    <div class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg></div>
                    <h3>Motorcycle</h3>
                    <span class="base-price">Rp 2.000 / hr</span>
                    <ul>
                        <li>Dedicated motorcycle area</li>
                        <li>QR or RFID access</li>
                        <li>High capacity zones</li>
                    </ul>
                </div>

                <div class="veh-price-card" style="border-color: var(--accent); background: white;">
                    <div class="icon" style="background: rgba(37,99,235,0.1); border-color: transparent;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg></div>
                    <h3>EV Parking</h3>
                    <span class="base-price">Rp 10.000 / hr</span>
                    <ul>
                        <li>EV charging included</li>
                        <li>Dedicated charging slot</li>
                        <li>May require reservation</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ESTIMATOR -->
    <section class="estimator-section">
        <div class="container">
            <div class="section-header">
                <h2>Estimate your parking cost</h2>
                <p>Calculate your expected parking fee before you arrive.</p>
            </div>
            <div class="estimator-module">
                <div class="est-form">
                    <div class="form-group">
                        <label class="form-label">Location (Mock)</label>
                        <select class="custom-select" id="estLoc" onchange="calculateEstimate()">
                            <option value="mall">Mall XYZ</option>
                            <option value="subang">Subang Square</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Vehicle Type</label>
                        <select class="custom-select" id="estVeh" onchange="calculateEstimate()">
                            <option value="car">Car</option>
                            <option value="moto">Motorcycle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Duration</label>
                        <select class="custom-select" id="estDur" onchange="calculateEstimate()">
                            <option value="1">1 Hour</option>
                            <option value="2">2 Hours</option>
                            <option value="3">3 Hours</option>
                            <option value="4">4 Hours</option>
                            <option value="10">Overnight (10 Hours)</option>
                        </select>
                    </div>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">This is an estimate. Final charges follow the tariff configured for the selected parking location.</p>
                </div>
                
                <div class="est-result-panel">
                    <div style="font-weight: 600; color: var(--primary);">Estimated Total</div>
                    <div class="est-total" id="estTotalVal">Rp 5.000</div>
                    
                    <div style="border-top: 1px solid var(--border); padding-top: 16px; margin-top: 16px;">
                        <div class="est-breakdown">
                            <span>Base Rate (1st hr)</span>
                            <span id="estBase">Rp 5.000</span>
                        </div>
                        <div class="est-breakdown">
                            <span>Additional Duration</span>
                            <span id="estAdd">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="how-it-works-section" id="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>How your parking fee is calculated</h2>
            </div>
            <div class="timeline-grid">
                <div class="timeline-step">
                    <div class="step-num">01</div>
                    <div class="step-desc"><strong>Enter</strong><br>Drive in, vehicle is recognized via ANPR or card tap.</div>
                </div>
                <div class="timeline-step">
                    <div class="step-num">02</div>
                    <div class="step-desc"><strong>Record</strong><br>System records the exact entry timestamp securely.</div>
                </div>
                <div class="timeline-step">
                    <div class="step-num">03</div>
                    <div class="step-desc"><strong>Calculate</strong><br>Tariff is calculated based on location rules upon exit.</div>
                </div>
                <div class="timeline-step">
                    <div class="step-num">04</div>
                    <div class="step-desc"><strong>Pay</strong><br>Settle payment via preferred cashless method.</div>
                </div>
            </div>
            
            <div style="margin-top: 64px;">
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 24px; color: var(--primary);">Pay your way.</h3>
                <div class="payment-methods-grid">
                    <div class="payment-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12V7H5a2 2 0 0 1 2-2h14v4z"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                        <h4>E-Wallet</h4>
                    </div>
                    <div class="payment-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="3"/><rect x="14" y="7" width="3" height="3"/><rect x="7" y="14" width="3" height="3"/><rect x="14" y="14" width="3" height="3"/></svg>
                        <h4>QRIS</h4>
                    </div>
                    <div class="payment-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        <h4>NFC Card</h4>
                    </div>
                    <div class="payment-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        <h4>Auto App Pay</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <h2>Frequently asked questions</h2>
            </div>
            <div class="accordion" style="max-width: 800px; margin: 0 auto;">
                
                <div class="accordion-item open">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        Are parking rates the same at every NusaPark location?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        No. Parking rates are determined by the property management or local regulations of each specific location. Always check the pricing for your destination before parking.
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        How is my parking fee calculated?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        Fees are typically calculated based on a base rate for the first hour, plus an incremental rate for each subsequent hour. Some locations also apply daily maximums or special overnight rates.
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        Why does the estimated price differ from the final charge?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        Estimates are based on the duration you input. Real-world traffic, delays in exiting, or passing into a new billing hour threshold can alter the final recorded duration.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="pricing-cta-section">
        <div class="container">
            <h2>Find a parking location and check its price.</h2>
            <p>Choose your destination and see parking availability, location details, and applicable rates immediately.</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="/search" class="btn btn-secondary">Find Parking</a>
                <a href="/locations" class="btn btn-secondary" style="background:transparent; color:white;">Explore Locations</a>
            </div>
        </div>
    </section>

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
                        <li><a href="/pricing">Pricing</a></li>
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
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NusaPark. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        // Mock Data for Pricing
        const mockPricingData = {
            'mall': {
                car: { base: 5000, next: 4000, max: 40000 },
                moto: { base: 2000, next: 2000, max: 20000 },
                ev: { base: 10000, next: 10000, max: 80000 }
            },
            'subang': {
                car: { base: 4000, next: 3000, max: 30000 },
                moto: { base: 1500, next: 1500, max: 15000 },
                ev: null // Not available mock state
            }
        };

        let currentLocation = 'mall';
        let currentVehicle = 'car';

        function setMockLocation(locKeyRaw, btnElem) {
            document.querySelectorAll('.loc-btn').forEach(b => b.classList.remove('active'));
            btnElem.classList.add('active');
            
            // map mock key
            currentLocation = locKeyRaw.toLowerCase().includes('subang') ? 'subang' : 'mall';
            updatePricingUI();
        }

        function setMockVehicle(vehKey, btnElem) {
            document.querySelectorAll('.veh-btn').forEach(b => b.classList.remove('active'));
            btnElem.classList.add('active');
            
            currentVehicle = vehKey;
            updatePricingUI();
        }

        function updatePricingUI() {
            const data = mockPricingData[currentLocation][currentVehicle];
            const contentArea = document.getElementById('pricing-content-area');

            // Simulate loading state
            contentArea.innerHTML = `
                <div class="pricing-summary-box">
                    <div class="skeleton-line" style="width: 40%;"></div>
                    <div class="skeleton-line" style="width: 70%; height: 40px;"></div>
                    <div class="skeleton-line" style="width: 30%;"></div>
                </div>
            `;

            setTimeout(() => {
                if (!data) {
                    contentArea.innerHTML = `
                        <div class="state-container">
                            <h3 style="color:var(--primary); margin-bottom:8px;">Pricing unavailable</h3>
                            <p style="color:var(--text-muted); font-size:0.875rem;">There is no configured tariff for this vehicle type at this location.</p>
                        </div>
                    `;
                    return;
                }

                const baseStr = data.base.toLocaleString('id-ID');
                const nextStr = data.next.toLocaleString('id-ID');
                const maxStr = data.max.toLocaleString('id-ID');

                contentArea.innerHTML = `
                    <div class="pricing-summary-box">
                        <div class="demo-disclaimer">Sample Tariff — Actual rates depend on the location</div>
                        <div style="font-size: 1.125rem; font-weight: 600; margin-bottom: 12px; color: var(--primary);">Estimated Base Rate</div>
                        <div class="pricing-hero-val">Rp ${baseStr} <span>/ first hour</span></div>
                        <div style="color: var(--text-muted); font-size: 0.875rem;">Next hour: +Rp ${nextStr}/hr • Daily Max: Rp ${maxStr}</div>
                        
                        <div class="tariff-table-wrapper">
                            <table class="tariff-table">
                                <thead>
                                    <tr>
                                        <th>Duration</th>
                                        <th class="val-col">Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="highlight-row">
                                        <td>First hour</td>
                                        <td class="val-col">Rp ${baseStr}</td>
                                    </tr>
                                    <tr>
                                        <td>Second hour</td>
                                        <td class="val-col">+ Rp ${nextStr}</td>
                                    </tr>
                                    <tr>
                                        <td>Subsequent hours</td>
                                        <td class="val-col">+ Rp ${nextStr} / hr</td>
                                    </tr>
                                    <tr>
                                        <td>Daily maximum</td>
                                        <td class="val-col">Rp ${maxStr}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }, 300);
        }

        // Estimator Logic
        function calculateEstimate() {
            const loc = document.getElementById('estLoc').value;
            const veh = document.getElementById('estVeh').value;
            const dur = parseInt(document.getElementById('estDur').value);
            
            const data = mockPricingData[loc][veh];
            
            if (!data) {
                document.getElementById('estTotalVal').textContent = 'N/A';
                document.getElementById('estBase').textContent = '-';
                document.getElementById('estAdd').textContent = '-';
                return;
            }
            
            let total = data.base;
            let added = 0;
            if(dur > 1) {
                added = (dur - 1) * data.next;
                total += added;
            }
            
            if(total > data.max) total = data.max;

            document.getElementById('estTotalVal').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('estBase').textContent = 'Rp ' + data.base.toLocaleString('id-ID');
            document.getElementById('estAdd').textContent = 'Rp ' + added.toLocaleString('id-ID');
        }

        // FAQ Toggle
        function toggleFaq(btn) {
            const item = btn.parentElement;
            item.classList.toggle('open');
        }
    </script>
</body>
</html>
