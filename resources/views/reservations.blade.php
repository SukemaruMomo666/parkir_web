<x-layouts.app activeNav="reservations">
    <div class="w-full">
        
        @if(!$supported)
            <!-- UNSUPPORTED STATE -->
            <div class="flex flex-col items-center justify-center py-16 md:py-32 text-center max-w-lg mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-6">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[var(--text)] mb-3">Reservations aren't available at this location.</h2>
                <p class="text-[var(--text-muted)] mb-8">The location you selected does not currently support advance parking reservations.</p>
                <a href="/app/search" class="bg-[var(--primary)] text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors w-full sm:w-auto text-center">
                    Find Another Parking Location
                </a>
            </div>
        @else
            <!-- HEADER / COMPACT SUMMARY -->
            <header class="mb-8 border-b border-[var(--border)] pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-[var(--primary)] bg-blue-50 px-2 py-1 rounded-md">Reserve Parking</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)] mb-1">Mall XYZ</h1>
                    <p class="text-[var(--text-muted)] flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Jakarta Selatan
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1.5 text-sm font-semibold text-[var(--success)]">
                        <span class="w-2 h-2 rounded-full bg-[var(--success)]"></span> Open now
                    </span>
                </div>
            </header>

            <div class="flex flex-col lg:flex-row gap-8 relative">
                
                <!-- LEFT COLUMN: MAIN FLOW -->
                <div class="lg:w-2/3">
                    
                    <!-- STEPPER NAV (Desktop mostly, mobile compact) -->
                    <div class="hidden md:flex items-center mb-8" id="stepperNav">
                        <div class="flex items-center text-[var(--primary)] font-bold">
                            <div class="w-8 h-8 rounded-full bg-[var(--primary)] text-white flex items-center justify-center mr-2 shadow-md">1</div>
                            Date & Time
                        </div>
                        <div class="flex-1 border-t-2 border-gray-200 mx-4" id="line1"></div>
                        <div class="flex items-center text-gray-400 font-semibold" id="step2Label">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-2 transition-colors">2</div>
                            Vehicle
                        </div>
                        <div class="flex-1 border-t-2 border-gray-200 mx-4" id="line2"></div>
                        <div class="flex items-center text-gray-400 font-semibold" id="step3Label">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-2 transition-colors">3</div>
                            Review
                        </div>
                    </div>
                    <div class="md:hidden mb-6 text-sm font-bold text-[var(--text-muted)] uppercase tracking-widest" id="mobileStepNav">
                        Step 1 of 3
                    </div>

                    <!-- ================= STEP 1: DATE & TIME ================= -->
                    <div class="step-item active" id="step1">
                        <div class="dashboard-card p-6 md:p-8">
                            <h2 class="text-xl font-bold mb-6">When do you want to park?</h2>
                            
                            <!-- Date Selection -->
                            <div class="mb-8">
                                <label for="resDate" class="block text-sm font-bold text-[var(--text)] mb-2">Date</label>
                                <input type="date" id="resDate" class="w-full md:w-1/2 p-3.5 border border-[var(--border)] rounded-xl focus:outline-none focus:ring-2 focus:ring-[var(--primary)] text-[var(--text)] bg-[var(--background)] font-medium" onchange="handleTimeChange()">
                                <p class="text-xs text-[var(--text-muted)] mt-2">Reservations are available up to 7 days in advance.</p>
                            </div>

                            <!-- Duration Selection (Optional context based on location) -->
                            <div class="mb-8">
                                <label class="block text-sm font-bold text-[var(--text)] mb-2">Estimated Duration</label>
                                <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="duration" value="2" class="peer sr-only" checked onchange="handleTimeChange()">
                                        <div class="text-center py-3 px-2 border border-[var(--border)] rounded-xl peer-checked:border-[var(--primary)] peer-checked:bg-blue-50 peer-checked:text-[var(--primary)] font-semibold transition-colors">2 hours</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="duration" value="4" class="peer sr-only" onchange="handleTimeChange()">
                                        <div class="text-center py-3 px-2 border border-[var(--border)] rounded-xl peer-checked:border-[var(--primary)] peer-checked:bg-blue-50 peer-checked:text-[var(--primary)] font-semibold transition-colors">4 hours</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="duration" value="8" class="peer sr-only" onchange="handleTimeChange()">
                                        <div class="text-center py-3 px-2 border border-[var(--border)] rounded-xl peer-checked:border-[var(--primary)] peer-checked:bg-blue-50 peer-checked:text-[var(--primary)] font-semibold transition-colors">8 hours</div>
                                    </label>
                                </div>
                            </div>

                            <!-- Time Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-bold text-[var(--text)] mb-2">Arrival Time</label>
                                <div class="grid grid-cols-4 md:grid-cols-6 gap-3" id="timeSlotsContainer">
                                    <!-- Populated by JS -->
                                </div>
                            </div>

                            <!-- Availability State -->
                            <div id="availabilityBox" class="hidden p-4 rounded-xl border mb-6 transition-all">
                                <!-- Populated by JS -->
                            </div>

                            <button id="btnNext1" onclick="goToStep(2)" class="w-full bg-[var(--primary)] text-white font-bold py-3.5 rounded-xl shadow-[0_8px_16px_rgba(37,99,235,0.25)] hover:bg-[var(--accent)] transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none" disabled>
                                Continue to Vehicle
                            </button>
                        </div>
                    </div>

                    <!-- ================= STEP 2: VEHICLE ================= -->
                    <div class="step-item" id="step2">
                        <div class="dashboard-card p-6 md:p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold">Select your vehicle</h2>
                                <a href="/vehicles" class="text-sm text-[var(--primary)] font-bold hover:underline">Add Vehicle</a>
                            </div>

                            <div class="space-y-4 mb-8" id="vehicleList">
                                <!-- Vehicle 1 (Default) -->
                                <label class="relative block cursor-pointer">
                                    <input type="radio" name="vehicle" value="v1" class="radio-card-input sr-only" checked onchange="updateSummary()">
                                    <div class="radio-card-content flex items-start gap-4 p-4 border border-[var(--border)] rounded-xl transition-all">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-check flex items-center justify-center shrink-0 mt-0.5 transition-colors">
                                            <svg class="hidden w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </div>
                                        <div class="w-10 h-10 bg-[var(--background)] rounded-lg flex items-center justify-center text-[var(--text-muted)] shrink-0 border border-[var(--border)]">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <p class="font-bold text-[var(--text)]" id="v1Name">Toyota Avanza</p>
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--primary)] bg-blue-100 px-2 py-0.5 rounded">Default</span>
                                            </div>
                                            <p class="text-sm font-mono text-[var(--text-muted)] mt-1" id="v1Plate">B •••• XYZ</p>
                                        </div>
                                    </div>
                                </label>

                                <!-- Vehicle 2 -->
                                <label class="relative block cursor-pointer">
                                    <input type="radio" name="vehicle" value="v2" class="radio-card-input sr-only" onchange="updateSummary()">
                                    <div class="radio-card-content flex items-start gap-4 p-4 border border-[var(--border)] rounded-xl transition-all">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-check flex items-center justify-center shrink-0 mt-0.5 transition-colors">
                                            <svg class="hidden w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </div>
                                        <div class="w-10 h-10 bg-[var(--background)] rounded-lg flex items-center justify-center text-[var(--text-muted)] shrink-0 border border-[var(--border)]">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <p class="font-bold text-[var(--text)]" id="v2Name">Honda Brio</p>
                                            </div>
                                            <p class="text-sm font-mono text-[var(--text-muted)] mt-1" id="v2Plate">B •••• ABC</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="flex flex-col-reverse sm:flex-row gap-3">
                                <button onclick="goToStep(1)" class="px-6 py-3.5 font-bold text-[var(--text-muted)] hover:text-[var(--text)] transition-colors text-center">Back</button>
                                <button onclick="goToStep(3)" class="flex-1 bg-[var(--primary)] text-white font-bold py-3.5 rounded-xl shadow-[0_8px_16px_rgba(37,99,235,0.25)] hover:bg-[var(--accent)] transition-all">Review Reservation</button>
                            </div>
                        </div>
                    </div>

                    <!-- ================= STEP 3: REVIEW ================= -->
                    <div class="step-item" id="step3">
                        <div class="dashboard-card p-6 md:p-8">
                            <h2 class="text-xl font-bold mb-6">Review & Confirm</h2>
                            
                            <div class="bg-[var(--background)] rounded-xl border border-[var(--border)] p-5 mb-6">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)] mb-4 border-b border-[var(--border)] pb-2">Reservation Details</h3>
                                
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Date</p>
                                        <p class="font-bold" id="revDate">10 Oct 2026</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[var(--text-muted)] mb-1">Time</p>
                                        <p class="font-bold" id="revTime">14:00 - 16:00</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-xs text-[var(--text-muted)] mb-1">Vehicle</p>
                                    <p class="font-bold" id="revVehicle">Toyota Avanza (B •••• XYZ)</p>
                                </div>
                                <div>
                                    <p class="text-xs text-[var(--text-muted)] mb-1">Parking Type</p>
                                    <p class="font-bold">Regular Car</p>
                                </div>
                            </div>

                            <div class="bg-[var(--background)] rounded-xl border border-[var(--border)] p-5 mb-8">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)] mb-4 border-b border-[var(--border)] pb-2">Pricing Breakdown</h3>
                                
                                <div class="flex justify-between items-center mb-3 text-sm">
                                    <span class="text-[var(--text-muted)]">Estimated Parking Fee (<span id="revDurLabel">2h</span>)</span>
                                    <span class="font-semibold" id="revParkFee">Rp 10.000</span>
                                </div>
                                <div class="flex justify-between items-center mb-4 text-sm">
                                    <span class="text-[var(--text-muted)]">Reservation Service Fee</span>
                                    <span class="font-semibold">Rp 5.000</span>
                                </div>
                                <div class="flex justify-between items-center border-t border-[var(--border)] pt-4">
                                    <span class="font-bold text-[var(--text)]">Estimated Total</span>
                                    <span class="font-bold text-2xl text-[var(--primary)]" id="revTotal">Rp 15.000</span>
                                </div>
                                <p class="text-xs text-[var(--text-muted)] mt-3">Final parking charges may depend on actual parking duration.</p>
                            </div>

                            <!-- Terms Checkbox -->
                            <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" id="termsCheck" class="w-5 h-5 rounded border-gray-300 text-[var(--primary)] focus:ring-[var(--primary)] transition-colors mt-0.5" onchange="toggleConfirmBtn()">
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-sm font-semibold text-[var(--text)] block mb-1">I agree to the reservation terms</span>
                                        <span class="text-xs text-[var(--text-muted)]">Cancellations must be made at least 1 hour before arrival. A no-show fee may apply.</span>
                                    </div>
                                </label>
                            </div>

                            <div class="flex flex-col-reverse sm:flex-row gap-3">
                                <button onclick="goToStep(2)" class="px-6 py-3.5 font-bold text-[var(--text-muted)] hover:text-[var(--text)] transition-colors text-center" id="btnBackReview">Back</button>
                                <button onclick="confirmReservation()" id="btnConfirm" class="flex-1 bg-[var(--primary)] text-white font-bold py-3.5 rounded-xl shadow-[0_8px_16px_rgba(37,99,235,0.25)] hover:bg-[var(--accent)] transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none" disabled>
                                    Confirm Reservation
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ================= STEP 4: SUCCESS ================= -->
                    <div class="step-item" id="step4">
                        <div class="dashboard-card p-8 md:p-12 text-center">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 mx-auto mb-6">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-[var(--text)] mb-3">Reservation confirmed!</h2>
                            <p class="text-[var(--text-muted)] mb-8">Your parking reservation has been successfully created.</p>

                            <div class="bg-[var(--background)] rounded-xl border border-[var(--border)] p-6 max-w-sm mx-auto mb-8 relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-[var(--primary)]"></div>
                                <p class="text-xs text-[var(--text-muted)] uppercase tracking-wider font-bold mb-1">Reservation ID</p>
                                <p class="text-xl font-mono font-bold text-[var(--text)] tracking-wider mb-6">NP-20261010-00421</p>
                                
                                <div class="grid grid-cols-2 gap-4 text-left border-t border-[var(--border)] pt-4">
                                    <div>
                                        <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wider font-bold">Date</p>
                                        <p class="text-sm font-semibold" id="succDate">10 Oct 2026</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wider font-bold">Time</p>
                                        <p class="text-sm font-semibold" id="succTime">14:00</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="/payment?type=reservation" class="bg-[var(--primary)] text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-[var(--accent)] transition-colors shadow-lg shadow-blue-500/20">
                                    Pay Deposit (Rp 15.000)
                                </a>
                                <a href="/active-parking" class="bg-[var(--background)] text-[var(--text)] px-8 py-3.5 rounded-xl font-semibold border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors">
                                    View Session
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: STICKY SUMMARY (Desktop) -->
                <div class="hidden lg:block lg:w-1/3">
                    <div class="sticky top-24 dashboard-card p-6" id="sidebarSummary">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--text-muted)] mb-6 border-b border-[var(--border)] pb-3">Your Reservation</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--text-muted)] shrink-0 mt-0.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <div>
                                    <p class="text-sm font-bold">Mall XYZ</p>
                                    <p class="text-xs text-[var(--text-muted)]">Jakarta Selatan</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--text-muted)] shrink-0 mt-0.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <div>
                                    <p class="text-sm font-bold" id="sumDate">Select Date</p>
                                    <p class="text-xs text-[var(--text-muted)]" id="sumTime">Select Time</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[var(--text-muted)] shrink-0 mt-0.5"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H8.32a2 2 0 00-1.93 1.46L4 12v4h3m5 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m14 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"></path></svg>
                                <div>
                                    <p class="text-sm font-bold" id="sumVehicle">Toyota Avanza</p>
                                    <p class="text-xs font-mono text-[var(--text-muted)]" id="sumPlate">B •••• XYZ</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-[var(--border)]">
                            <div class="flex justify-between items-end">
                                <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Estimated Total</span>
                                <span class="text-xl font-bold text-[var(--primary)]" id="sumTotal">--</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

    @if($supported)
    @push('scripts')
    <script>
        // State
        const state = {
            step: parseInt(new URLSearchParams(window.location.search).get('step') || '1'),
            date: '',
            time: '',
            duration: 2,
            vehicle: 'v1',
            availability: 'idle' // idle, checking, available, unavailable
        };

        // DOM Elements
        const elDate = document.getElementById('resDate');
        const elTimeContainer = document.getElementById('timeSlotsContainer');
        const elAvailBox = document.getElementById('availabilityBox');
        const elBtnNext1 = document.getElementById('btnNext1');

        // Initialization
        function init() {
            // Set min date to today
            const today = new Date().toISOString().split('T')[0];
            elDate.min = today;
            elDate.value = today;
            state.date = today;

            generateTimeSlots();
            updateSummary();
            goToStep(state.step);
        }

        // Stepper Navigation
        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-item').forEach(el => el.classList.remove('active'));
            document.getElementById(`step${step}`).classList.add('active');
            
            // Update mobile header
            const mobileNav = document.getElementById('mobileStepNav');
            if (mobileNav) mobileNav.textContent = `Step ${step} of 3`;

            // Update desktop stepper
            if(step <= 3) {
                const labels = [null, null, document.getElementById('step2Label'), document.getElementById('step3Label')];
                const lines = [null, document.getElementById('line1'), document.getElementById('line2')];
                
                for(let i=2; i<=3; i++) {
                    const circle = labels[i].querySelector('div');
                    if (step >= i) {
                        labels[i].classList.replace('text-gray-400', 'text-[var(--primary)]');
                        circle.classList.replace('bg-gray-100', 'bg-[var(--primary)]');
                        circle.classList.replace('text-gray-400', 'text-white'); // assuming default text is dark, need explicit white
                        circle.style.color = 'white';
                        if(lines[i-1]) lines[i-1].classList.replace('border-gray-200', 'border-[var(--primary)]');
                    } else {
                        labels[i].classList.replace('text-[var(--primary)]', 'text-gray-400');
                        circle.classList.replace('bg-[var(--primary)]', 'bg-gray-100');
                        circle.style.color = '';
                        if(lines[i-1]) lines[i-1].classList.replace('border-[var(--primary)]', 'border-gray-200');
                    }
                }
            } else {
                // Success step, hide sidebar and stepper
                const sidebar = document.getElementById('sidebarSummary');
                if(sidebar) sidebar.parentElement.style.display = 'none';
                const stepper = document.getElementById('stepperNav');
                if(stepper) stepper.style.display = 'none';
                if(mobileNav) mobileNav.style.display = 'none';
                document.querySelector('.lg\\:w-2\\/3').classList.replace('lg:w-2/3', 'w-full');
            }

            if (step === 3) populateReview();
        }

        // Time Slots Generation (Mock)
        function generateTimeSlots() {
            const startHour = 10;
            let html = '';
            // Generate 12 slots (10:00 to 15:30)
            for(let i=0; i<12; i++) {
                const h = startHour + Math.floor(i/2);
                const m = i%2 === 0 ? '00' : '30';
                const timeStr = `${h}:${m}`;
                // Mock some unavailable slots
                const isUnavailable = i === 4 || i === 5; 
                
                html += `
                    <label class="${isUnavailable ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'}">
                        <input type="radio" name="time" value="${timeStr}" class="peer sr-only" ${isUnavailable ? 'disabled' : ''} onchange="handleTimeChange()">
                        <div class="text-center py-2 border border-[var(--border)] rounded-lg text-sm font-semibold transition-colors 
                                    ${isUnavailable ? 'bg-gray-100 text-gray-400 border-gray-200' : 'peer-checked:border-[var(--primary)] peer-checked:bg-[var(--primary)] peer-checked:text-white hover:border-[var(--primary)]'}">
                            ${timeStr}
                        </div>
                    </label>
                `;
            }
            elTimeContainer.innerHTML = html;
        }

        // Handlers
        function handleTimeChange() {
            const selectedTime = document.querySelector('input[name="time"]:checked');
            state.date = elDate.value;
            state.duration = parseInt(document.querySelector('input[name="duration"]:checked').value);
            
            if (!state.date || !selectedTime) {
                elAvailBox.classList.add('hidden');
                elBtnNext1.disabled = true;
                return;
            }

            state.time = selectedTime.value;
            checkAvailability();
            updateSummary();
        }

        function checkAvailability() {
            // Mock API Check
            state.availability = 'checking';
            elBtnNext1.disabled = true;
            
            elAvailBox.className = 'p-4 rounded-xl border mb-6 bg-gray-50 border-gray-200 block';
            elAvailBox.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="animate-spin text-[var(--primary)]" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>
                    <span class="text-sm font-semibold">Checking availability...</span>
                </div>
            `;

            setTimeout(() => {
                // Simulate success for demo
                state.availability = 'available';
                elBtnNext1.disabled = false;
                
                elAvailBox.className = 'p-4 rounded-xl border mb-6 bg-green-50 border-green-200 block';
                elAvailBox.innerHTML = `
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <span class="text-sm font-bold text-green-800 block">Parking is available</span>
                            <span class="text-xs text-green-700 mt-0.5 block">You can proceed to book this time slot.</span>
                        </div>
                    </div>
                `;
            }, 800);
        }

        function updateSummary() {
            // Sidebar summary updates
            if(state.date) {
                const dateObj = new Date(state.date);
                document.getElementById('sumDate').textContent = dateObj.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            }
            if(state.time) {
                // calculate end time
                const [h, m] = state.time.split(':').map(Number);
                let endH = h + state.duration;
                document.getElementById('sumTime').textContent = `${state.time} - ${endH}:${m === 0 ? '00' : '30'} (${state.duration}h)`;
                
                // Estimate pricing: base 5000 + (dur * 5000)
                const total = 5000 + (state.duration * 5000);
                document.getElementById('sumTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
            }
            
            // Vehicle
            const selectedVeh = document.querySelector('input[name="vehicle"]:checked').value;
            state.vehicle = selectedVeh;
            const vName = document.getElementById(`${selectedVeh}Name`).textContent;
            const vPlate = document.getElementById(`${selectedVeh}Plate`).textContent;
            document.getElementById('sumVehicle').textContent = vName;
            document.getElementById('sumPlate').textContent = vPlate;
        }

        function populateReview() {
            document.getElementById('revDate').textContent = document.getElementById('sumDate').textContent;
            document.getElementById('revTime').textContent = document.getElementById('sumTime').textContent;
            document.getElementById('revVehicle').textContent = `${document.getElementById('sumVehicle').textContent} (${document.getElementById('sumPlate').textContent})`;
            
            const dur = document.querySelector('input[name="duration"]:checked').value;
            document.getElementById('revDurLabel').textContent = `${dur}h`;
            
            const parkFee = dur * 5000;
            document.getElementById('revParkFee').textContent = `Rp ${parkFee.toLocaleString('id-ID')}`;
            const total = parkFee + 5000;
            document.getElementById('revTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        function toggleConfirmBtn() {
            document.getElementById('btnConfirm').disabled = !document.getElementById('termsCheck').checked;
        }

        function confirmReservation() {
            const btn = document.getElementById('btnConfirm');
            btn.disabled = true;
            document.getElementById('btnBackReview').disabled = true;
            document.getElementById('termsCheck').disabled = true;
            
            btn.innerHTML = `
                <svg class="animate-spin inline mr-2 h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>
                Confirming reservation...
            `;
            
            // Simulate network request
            setTimeout(() => {
                // Populate success data
                document.getElementById('succDate').textContent = document.getElementById('sumDate').textContent;
                document.getElementById('succTime').textContent = state.time;
                goToStep(4);
            }, 1500);
        }

        init();

    </script>
    @endpush
    @endif
</x-layouts.app>
