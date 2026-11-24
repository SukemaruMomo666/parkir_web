<x-layouts.app activeNav="reservations">
    @php
        $user = Auth::user();
        $dateDefault = now()->format('d M Y');
    @endphp

    <div class="w-full space-y-6">

        <!-- HEADER HERO BANNER WITH MALL XYZ PHOTO -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-50/90 via-slate-50 to-indigo-50/60 border border-blue-100/80 p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-xs">
            
            <!-- Left Info -->
            <div class="relative z-10 max-w-md">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-xs font-semibold mb-3">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span>Reserve Parking</span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-1">
                    Mall XYZ
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Jakarta Selatan</span>
                </p>
            </div>

            <!-- Right Visual: Mall XYZ Photo with Open Now Badge -->
            <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Open Now</span>
                </span>

                <div class="relative w-48 sm:w-64 h-24 sm:h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white">
                    <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ Exterior" class="w-full h-full object-cover object-center" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                </div>
            </div>

        </div>

        <!-- 3-STEP FLOW STEPPER -->
        <div class="max-w-2xl mx-auto py-2">
            <div class="flex items-center justify-between relative" id="stepperContainer">
                
                <!-- Step 1 Indicator -->
                <div class="flex items-center gap-2.5 z-10" id="stepIndicator1">
                    <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-md shadow-blue-500/25">
                        1
                    </div>
                    <span class="text-xs font-bold text-slate-900">Date & Time</span>
                </div>

                <!-- Connector Line 1 -->
                <div class="flex-1 h-0.5 bg-blue-600 mx-3 sm:mx-6 transition-all duration-300" id="stepLine1"></div>

                <!-- Step 2 Indicator -->
                <div class="flex items-center gap-2.5 z-10" id="stepIndicator2">
                    <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs transition-colors">
                        2
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Vehicle</span>
                </div>

                <!-- Connector Line 2 -->
                <div class="flex-1 h-0.5 bg-slate-200 mx-3 sm:mx-6 transition-all duration-300" id="stepLine2"></div>

                <!-- Step 3 Indicator -->
                <div class="flex items-center gap-2.5 z-10" id="stepIndicator3">
                    <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs transition-colors">
                        3
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Review</span>
                </div>

            </div>
        </div>

        <!-- MAIN TWO-COLUMN CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
            
            <!-- LEFT COLUMN: MULTI-STEP FORMS -->
            <div class="lg:col-span-7 xl:col-span-8 space-y-6">
                
                <!-- ================= STEP 1: DATE & TIME ================= -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8 space-y-6" id="stepForm1">
                    
                    <!-- Header with Icon -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">
                                When do you want to park?
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Choose your date, estimated duration, and arrival time.
                            </p>
                        </div>
                    </div>

                    <!-- Date Selection & Parking Info Row -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
                        
                        <!-- Left Date Picker -->
                        <div class="md:col-span-7">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Date</label>
                            <div class="relative">
                                <input type="text" id="selectedDateInput" value="{{ $dateDefault }}" readonly onclick="focusDatePicker()" class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-semibold text-slate-800 cursor-pointer focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-blue-600">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Right Parking Information Callout -->
                        <div class="md:col-span-5 bg-blue-50/70 border border-blue-100 rounded-2xl p-4 space-y-2">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-blue-900">
                                <div class="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] font-black">i</div>
                                <span>Parking Information</span>
                            </div>
                            <ul class="space-y-1.5 text-[11px] text-slate-600">
                                <li class="flex items-start gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>Reservation is available up to 7 days in advance.</span>
                                </li>
                                <li class="flex items-start gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span>You can modify or cancel before the entry time.</span>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- Estimated Duration Selection -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2.5">Estimated Duration</label>
                        <div class="grid grid-cols-3 gap-3">
                            <button type="button" onclick="selectDuration('2', this)" class="dur-btn active py-2.5 px-4 rounded-xl border-2 border-blue-600 bg-blue-50/40 text-blue-700 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span>2 hours</span>
                            </button>
                            <button type="button" onclick="selectDuration('4', this)" class="dur-btn py-2.5 px-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span>4 hours</span>
                            </button>
                            <button type="button" onclick="selectDuration('8', this)" class="dur-btn py-2.5 px-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span>8 hours</span>
                            </button>
                        </div>
                    </div>

                    <!-- Arrival Time Matrix -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2.5">Arrival Time</label>
                        <div class="grid grid-cols-3 sm:grid-cols-6 gap-2.5" id="timeSlotsGrid">
                            <!-- Row 1 -->
                            <button type="button" onclick="selectTimeSlot('10:00', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">10:00</button>
                            <button type="button" onclick="selectTimeSlot('10:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">10:30</button>
                            <button type="button" onclick="selectTimeSlot('11:00', this)" class="slot-time-btn active py-2.5 rounded-xl bg-blue-600 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition-all">11:00</button>
                            <button type="button" onclick="selectTimeSlot('11:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">11:30</button>
                            <button type="button" onclick="selectTimeSlot('12:00', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">12:00</button>
                            <button type="button" onclick="selectTimeSlot('12:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">12:30</button>
                            
                            <!-- Row 2 -->
                            <button type="button" onclick="selectTimeSlot('13:00', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">13:00</button>
                            <button type="button" onclick="selectTimeSlot('13:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">13:30</button>
                            <button type="button" onclick="selectTimeSlot('14:00', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">14:00</button>
                            <button type="button" onclick="selectTimeSlot('14:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">14:30</button>
                            <button type="button" onclick="selectTimeSlot('15:00', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">15:00</button>
                            <button type="button" onclick="selectTimeSlot('15:30', this)" class="slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all">15:30</button>
                        </div>
                    </div>

                    <!-- Step 1 Button -->
                    <button type="button" onclick="goToStep(2)" class="w-full py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md shadow-blue-500/25 transition-all flex items-center justify-center gap-2 mt-4">
                        <span>Continue to Vehicle</span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>

                </div>

                <!-- ================= STEP 2: VEHICLE SELECTION (HIDDEN INITIALLY) ================= -->
                <div class="hidden bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8 space-y-6" id="stepForm2">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">
                                Select Your Vehicle
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">
                                ANPR barrier gates will recognize this vehicle plate upon arrival.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3" id="vehicleOptionsList">
                        <!-- Vehicle Option 1 (Default) -->
                        <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-blue-600 bg-blue-50/30 cursor-pointer transition-all">
                            <div class="flex items-center gap-3.5">
                                <input type="radio" name="vehSelect" value="Toyota Avanza (B 1234 XYZ)" checked onchange="updateSelectedVehicle(this.value)" class="text-blue-600 focus:ring-blue-500" />
                                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Toyota Avanza</div>
                                    <div class="text-xs text-slate-500 font-mono">B 1234 XYZ</div>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-700">DEFAULT</span>
                        </label>

                        <!-- Vehicle Option 2 -->
                        <label class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 cursor-pointer transition-all">
                            <div class="flex items-center gap-3.5">
                                <input type="radio" name="vehSelect" value="Honda PCX (B 5678 ABC)" onchange="updateSelectedVehicle(this.value)" class="text-blue-600 focus:ring-blue-500" />
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Honda PCX</div>
                                    <div class="text-xs text-slate-500 font-mono">B 5678 ABC</div>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-600">MOTORCYCLE</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" onclick="goToStep(1)" class="w-1/3 py-3.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                            ← Back
                        </button>
                        <button type="button" onclick="goToStep(3)" class="w-2/3 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md shadow-blue-500/25 transition-all flex items-center justify-center gap-2">
                            <span>Continue to Review</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- ================= STEP 3: REVIEW & CONFIRM ================= -->
                <div class="hidden bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8 space-y-6" id="stepForm3">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">
                                Review Your Reservation
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Confirm the details below to complete your slot booking.
                            </p>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200/80 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex justify-between items-center text-slate-600 pb-2 border-b border-slate-200/70">
                            <span>Destination</span>
                            <span class="font-bold text-slate-900">Mall XYZ (Jakarta Selatan)</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600 pb-2 border-b border-slate-200/70">
                            <span>Arrival Time</span>
                            <span class="font-bold text-slate-900" id="reviewArrival">11:00 AM • 24 Nov 2026</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600 pb-2 border-b border-slate-200/70">
                            <span>Duration</span>
                            <span class="font-bold text-slate-900" id="reviewDuration">2 Hours</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600 pb-2 border-b border-slate-200/70">
                            <span>Selected Vehicle</span>
                            <span class="font-bold text-slate-900" id="reviewVehicle">Toyota Avanza (B 1234 XYZ)</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-800 pt-1">
                            <span class="font-bold">Estimated Booking Deposit</span>
                            <span class="font-black text-blue-600 text-base" id="reviewFee">Rp 10.000</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" onclick="goToStep(2)" class="w-1/3 py-3.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                            ← Back
                        </button>
                        <button type="button" onclick="submitReservationSuccess()" class="w-2/3 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-500/25 transition-all flex items-center justify-center gap-2">
                            <span>Confirm & Book Slot</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </button>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: YOUR RESERVATION SUMMARY & TIPS -->
            <div class="lg:col-span-5 xl:col-span-4 space-y-6">
                
                <!-- CARD 1: YOUR RESERVATION SUMMARY -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 space-y-5">
                    
                    <!-- Header -->
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-900 pb-3 border-b border-slate-100">
                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>Your Reservation</span>
                    </div>

                    <!-- Venue Flex Row -->
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset('images/mall-xyz.jpg') }}" alt="Mall XYZ" class="w-20 h-16 rounded-xl object-cover shadow-xs shrink-0" />
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-bold text-slate-900 truncate">Mall XYZ</h4>
                            <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                                <span>📍 Jakarta Selatan</span>
                            </div>
                            <div class="mt-1">
                                <span class="text-[10px] font-bold text-emerald-600 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Open Now
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Itemized Details -->
                    <div class="space-y-3 pt-3 border-t border-slate-100 text-xs text-slate-600">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span id="summaryDateVal">{{ $dateDefault }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span id="summaryDurationVal">Estimated Duration: 2 hours</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                            <span id="summaryVehicleVal">Vehicle: -</span>
                        </div>
                    </div>

                    <!-- Estimated Total -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-900">Estimated Total</span>
                        <span class="text-lg font-black text-blue-600" id="summaryTotalVal">--</span>
                    </div>

                </div>

                <!-- CARD 2: TIPS -->
                <div class="bg-blue-50/70 rounded-3xl border border-blue-100 p-5 flex items-start gap-3.5 shadow-2xs">
                    <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 0 0-7-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 mb-0.5">Tips</h4>
                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Make sure your vehicle information is correct so the entry and exit process can run smoothly.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- INTERACTIVE RESERVATION SCRIPTS -->
    <script>
        let currentStep = 1;
        let selectedDuration = 2;
        let selectedTime = '11:00';
        let selectedVehicle = '-';

        function selectDuration(hours, btn) {
            selectedDuration = parseInt(hours, 10);
            document.querySelectorAll('.dur-btn').forEach(b => {
                b.className = 'dur-btn py-2.5 px-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all';
                const icon = b.querySelector('svg');
                if (icon) icon.className = 'w-4 h-4 text-slate-400';
            });
            btn.className = 'dur-btn active py-2.5 px-4 rounded-xl border-2 border-blue-600 bg-blue-50/40 text-blue-700 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all';
            const activeIcon = btn.querySelector('svg');
            if (activeIcon) activeIcon.className = 'w-4 h-4 text-blue-600';

            updateSummary();
        }

        function selectTimeSlot(time, btn) {
            selectedTime = time;
            document.querySelectorAll('.slot-time-btn').forEach(b => {
                b.className = 'slot-time-btn py-2.5 rounded-xl border border-slate-200/90 text-xs font-semibold text-slate-700 hover:border-blue-400 hover:bg-slate-50 transition-all';
            });
            btn.className = 'slot-time-btn active py-2.5 rounded-xl bg-blue-600 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition-all';

            updateSummary();
        }

        function updateSelectedVehicle(val) {
            selectedVehicle = val;
            updateSummary();
        }

        function updateSummary() {
            const summaryDuration = document.getElementById('summaryDurationVal');
            const summaryVehicle = document.getElementById('summaryVehicleVal');
            const summaryTotal = document.getElementById('summaryTotalVal');
            const reviewArrival = document.getElementById('reviewArrival');
            const reviewDuration = document.getElementById('reviewDuration');
            const reviewVehicle = document.getElementById('reviewVehicle');
            const reviewFee = document.getElementById('reviewFee');

            if (summaryDuration) summaryDuration.textContent = `Estimated Duration: ${selectedDuration} hours`;
            if (summaryVehicle) summaryVehicle.textContent = `Vehicle: ${selectedVehicle}`;
            
            // Calculate mock fee: 5.000 first hr + 4.000 next hr
            const total = 5000 + (selectedDuration - 1) * 4000;
            const formattedTotal = 'Rp ' + total.toLocaleString('id-ID');

            if (selectedVehicle !== '-') {
                if (summaryTotal) summaryTotal.textContent = formattedTotal;
            } else {
                if (summaryTotal) summaryTotal.textContent = '--';
            }

            if (reviewArrival) reviewArrival.textContent = `${selectedTime} AM • {{ $dateDefault }}`;
            if (reviewDuration) reviewDuration.textContent = `${selectedDuration} Hours`;
            if (reviewVehicle) reviewVehicle.textContent = selectedVehicle !== '-' ? selectedVehicle : 'Toyota Avanza (B 1234 XYZ)';
            if (reviewFee) reviewFee.textContent = formattedTotal;
        }

        function goToStep(step) {
            currentStep = step;

            // Forms toggle
            document.getElementById('stepForm1')?.classList.toggle('hidden', step !== 1);
            document.getElementById('stepForm2')?.classList.toggle('hidden', step !== 2);
            document.getElementById('stepForm3')?.classList.toggle('hidden', step !== 3);

            // Stepper styling
            const ind1 = document.getElementById('stepIndicator1')?.querySelector('div');
            const ind2 = document.getElementById('stepIndicator2')?.querySelector('div');
            const ind3 = document.getElementById('stepIndicator3')?.querySelector('div');
            const lbl2 = document.getElementById('stepIndicator2')?.querySelector('span');
            const lbl3 = document.getElementById('stepIndicator3')?.querySelector('span');
            const line1 = document.getElementById('stepLine1');
            const line2 = document.getElementById('stepLine2');

            if (step >= 2) {
                if (selectedVehicle === '-') {
                    selectedVehicle = 'Toyota Avanza (B 1234 XYZ)';
                    updateSummary();
                }
                ind2.className = 'w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-md shadow-blue-500/25';
                lbl2.className = 'text-xs font-bold text-slate-900';
                line1.className = 'flex-1 h-0.5 bg-blue-600 mx-3 sm:mx-6 transition-all duration-300';
            } else {
                ind2.className = 'w-7 h-7 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs transition-colors';
                lbl2.className = 'text-xs font-semibold text-slate-500';
                line1.className = 'flex-1 h-0.5 bg-slate-200 mx-3 sm:mx-6 transition-all duration-300';
            }

            if (step >= 3) {
                ind3.className = 'w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-md shadow-blue-500/25';
                lbl3.className = 'text-xs font-bold text-slate-900';
                line2.className = 'flex-1 h-0.5 bg-blue-600 mx-3 sm:mx-6 transition-all duration-300';
            } else {
                ind3.className = 'w-7 h-7 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs transition-colors';
                lbl3.className = 'text-xs font-semibold text-slate-500';
                line2.className = 'flex-1 h-0.5 bg-slate-200 mx-3 sm:mx-6 transition-all duration-300';
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function submitReservationSuccess() {
            alert('🎉 Reservation confirmed successfully! Your slot at Mall XYZ is secured.');
            window.location.href = '/active-parking';
        }

        function focusDatePicker() {
            // date input simulation
        }
    </script>
</x-layouts.app>
