@extends('layouts.app')

@section('title', 'Complete Payment | Premium Car Rental')

@section('content')
<div class="bg-dark text-white min-vh-100 position-relative pb-5">
    <!-- Atmospheric Background -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(212,175,55,0.15), transparent 40%), linear-gradient(180deg, #0f172a 0%, #000000 100%); z-index: 0;"></div>

    <div class="container py-5 position-relative" style="z-index: 1;">
        <!-- Header -->
        <div class="row text-center mb-5 gsap-fade-up pt-4">
            <div class="col-md-8 mx-auto">
                <span class="badge bg-white px-3 py-2 rounded-pill text-dark tracking-wider small fw-bold mb-3">SECURE CHECKOUT</span>
                <h1 class="display-4 fw-bold mb-3" style="font-family: serif; font-style: italic;">Finalize Your Reservation</h1>
                <p class="lead text-white-50">Complete your secure payment to confirm your premium vehicle.</p>
            </div>
        </div>

        <div class="row justify-content-center g-5 perspective-wrapper">
            
            <!-- Payment Form -->
            <div class="col-lg-6 gsap-reveal-left">
                <div class="card border-0 bg-white bg-opacity-10 backdrop-blur rounded-5 p-4 p-md-5 shadow-lg h-100 luxury-card-3d" style="transform-style: preserve-3d;">
                    <div style="transform: translateZ(30px);">
                        <div class="d-flex align-items-center justify-content-between mb-5 border-bottom border-light pb-4 border-opacity-25">
                            <h4 class="fw-bold mb-0 text-white"><i class="bi bi-credit-card me-3 text-primary"></i>Payment Details</h4>
                            <div class="d-flex gap-2">
                                <i class="bi bi-cc-visa fs-3 opacity-75"></i>
                                <i class="bi bi-cc-mastercard fs-3 opacity-75"></i>
                                <i class="bi bi-cc-amex fs-3 opacity-75"></i>
                            </div>
                        </div>

                        <form action="{{ route('bookings.payment.process', $booking) }}" method="POST" id="paymentForm">
                            @csrf
                            
                            <!-- Payment Method Selection -->
                            <div class="mb-5">
                                <label class="form-label text-uppercase small tracking-wider fw-bold text-white-50 mb-3">Select Method</label>
                                <div class="d-flex flex-column gap-3">
                                    <div class="position-relative">
                                        <input type="radio" class="btn-check payment-method-radio" name="payment_method" id="method_card" value="card" checked autocomplete="off">
                                        <label class="btn btn-outline-secondary text-white w-100 text-start p-3 rounded-4 d-flex align-items-center border-opacity-50 transition payment-label" for="method_card">
                                            <i class="bi bi-credit-card fs-4 me-3 text-primary"></i>
                                            <div class="fw-bold flex-grow-1">Credit / Debit Card</div>
                                            <i class="bi bi-check-circle-fill text-primary ms-auto check-icon" style="opacity: 1;"></i>
                                        </label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="radio" class="btn-check payment-method-radio" name="payment_method" id="method_paypal" value="paypal" autocomplete="off">
                                        <label class="btn btn-outline-secondary text-white w-100 text-start p-3 rounded-4 d-flex align-items-center border-opacity-50 transition payment-label" for="method_paypal">
                                            <i class="bi bi-paypal fs-4 me-3 text-primary"></i>
                                            <div class="fw-bold flex-grow-1">PayPal</div>
                                            <i class="bi bi-check-circle-fill text-primary ms-auto check-icon" style="opacity: 0;"></i>
                                        </label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="radio" class="btn-check payment-method-radio" name="payment_method" id="method_cash" value="cash" autocomplete="off">
                                        <label class="btn btn-outline-secondary text-white w-100 text-start p-3 rounded-4 d-flex align-items-center border-opacity-50 transition payment-label" for="method_cash">
                                            <i class="bi bi-cash-coin fs-4 me-3 text-primary"></i>
                                            <div class="fw-bold flex-grow-1">Cash on Delivery</div>
                                            <i class="bi bi-check-circle-fill text-primary ms-auto check-icon" style="opacity: 0;"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Details section (Hidden when PayPal/Cash selected) -->
                            <div id="cardDetailsSection">
                                <div class="mb-4">
                                    <label class="form-label text-uppercase small tracking-wider fw-bold text-white-50 mb-2">Name on Card</label>
                                    <input type="text" name="card_name" id="cardNameInput" class="form-control form-control-lg bg-dark text-white border-secondary border-opacity-50 py-3 px-4 rounded-4 focus-ring focus-ring-primary" placeholder="Mr. John Doe" required value="{{ old('card_name', auth()->user()->name) }}">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label text-uppercase small tracking-wider fw-bold text-white-50 mb-2">Card Number</label>
                                    <div class="position-relative">
                                        <input type="text" name="card_number" id="cardNumber" class="form-control form-control-lg bg-dark text-white border-secondary border-opacity-50 py-3 px-4 rounded-4 focus-ring focus-ring-primary" placeholder="0000 0000 0000 0000" maxlength="19" required>
                                        <i class="bi bi-credit-card-2-front position-absolute top-50 end-0 translate-middle-y me-4 text-white-50"></i>
                                    </div>
                                </div>

                                <div class="row g-4 mb-5">
                                    <div class="col-6">
                                        <label class="form-label text-uppercase small tracking-wider fw-bold text-white-50 mb-2">Expiry Date</label>
                                        <input type="text" name="expiry" id="expiryDate" class="form-control form-control-lg bg-dark text-white border-secondary border-opacity-50 py-3 px-4 rounded-4 focus-ring focus-ring-primary" placeholder="MM/YY" maxlength="5" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-uppercase small tracking-wider fw-bold text-white-50 mb-2">Security Code</label>
                                        <div class="position-relative">
                                            <input type="text" name="cvc" id="cvc" class="form-control form-control-lg bg-dark text-white border-secondary border-opacity-50 py-3 px-4 rounded-4 focus-ring focus-ring-primary" placeholder="CVC" maxlength="4" required>
                                            <i class="bi bi-info-circle position-absolute top-50 end-0 translate-middle-y me-4 text-white-50" data-bs-toggle="tooltip" title="3 digits on back of card (4 for Amex)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="paypalMessageSection" style="display: none;" class="mb-5 text-center text-white-50">
                                <i class="bi bi-paypal fs-1 text-primary mb-3 d-block"></i>
                                <p>You will be redirected to PayPal to complete your secure payment.</p>
                            </div>

                            <div id="cashMessageSection" style="display: none;" class="mb-5 text-center text-white-50">
                                <i class="bi bi-cash-coin fs-1 text-primary mb-3 d-block"></i>
                                <p>You will pay the total amount directly to our agent when you pick up your vehicle.</p>
                            </div>

                            <button type="submit" id="submitBtn" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg interaction-btn text-dark mt-2 d-flex align-items-center justify-content-center">
                                <span class="me-2" id="submitBtnText">PAY {{ number_format($booking->total_price, 2) }} MAD</span>
                                <i class="bi bi-shield-lock-fill" id="submitBtnIcon"></i>
                            </button>
                            <p class="text-center mt-4 mb-0 small text-white-50"><i class="bi bi-lock-fill me-1"></i> Payments are securely simulated for this demonstration.</p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Booking Summary Sidebar -->
            <div class="col-lg-5 gsap-reveal-right">
                <div class="card border border-secondary border-opacity-25 bg-dark rounded-5 overflow-hidden shadow-lg h-100 luxury-card-3d" style="transform-style: preserve-3d;">
                    
                    <!-- Car Header Image inside card -->
                    <div class="position-relative" style="height: 200px;">
                        <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="{{ $booking->car->brand }}">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(0deg, #18181b 0%, transparent 100%);"></div>
                    </div>

                    <div class="p-4 p-md-5 pt-0 position-relative" style="transform: translateZ(20px); margin-top: -30px;">
                        
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <div>
                                <h3 class="fw-bold mb-1 text-white">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
                                <div class="badge bg-primary px-2 rounded-pill text-dark">{{ $booking->car->year }}</div>
                            </div>
                        </div>

                        <div class="p-4 bg-white bg-opacity-10 rounded-4 mb-4 backdrop-blur">
                            <div class="d-flex mb-3">
                                <div class="text-primary me-3 pt-1"><i class="bi bi-geo-alt-fill fs-5"></i></div>
                                <div>
                                    <div class="small text-white-50 text-uppercase tracking-wider">Pickup</div>
                                    <div class="fw-bold">{{ $booking->pickupLocation->name }}</div>
                                    <div class="small text-white-50">{{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }}</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="text-primary me-3 pt-1"><i class="bi bi-flag-fill fs-5"></i></div>
                                <div>
                                    <div class="small text-white-50 text-uppercase tracking-wider">Return</div>
                                    <div class="fw-bold">{{ $booking->dropoffLocation->name }}</div>
                                    <div class="small text-white-50">{{ \Carbon\Carbon::parse($booking->return_date)->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-light border-opacity-25 pt-4">
                            <h6 class="text-uppercase tracking-wider text-white-50 small mb-4">Price Breakdown</h6>
                            <div class="d-flex justify-content-between mb-3 text-white-50">
                                <span>Base Rate ({{ $booking->total_days }} days)</span>
                                <span>{{ number_format($booking->price_per_day * $booking->total_days, 2) }} MAD</span>
                            </div>
                            
                            @if($booking->extras_price > 0)
                            <div class="d-flex justify-content-between mb-3 text-white-50">
                                <span>Extras Included</span>
                                <span>{{ number_format($booking->extras_price, 2) }} MAD</span>
                            </div>
                            @endif

                            @if($booking->discount > 0)
                            <div class="d-flex justify-content-between mb-3 text-success">
                                <span>Discount</span>
                                <span>-{{ number_format($booking->discount, 2) }} MAD</span>
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top border-light border-opacity-25">
                            <span class="fs-5 text-uppercase tracking-wider text-white-50">Total</span>
                            <span class="display-6 fw-bold text-primary">{{ number_format($booking->total_price, 2) }} <span class="fs-5">MAD</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .backdrop-blur { backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); }
    .tracking-wider { letter-spacing: 0.1em; }
    .perspective-wrapper { perspective: 1200px; }
    
    .interaction-btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
        border: none;
        transition: all 0.3s ease;
    }
    .interaction-btn::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background-color: white;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: -1;
    }
    .interaction-btn:hover {
        color: var(--primary-color) !important;
        transform: translateY(-2px);
    }
    .interaction-btn:hover::before {
        height: 100%;
    }
    
    /* Input Base Styling */
    .form-control {
        transition: all 0.3s ease;
    }
    .form-control:focus {
        background-color: #1a202c !important;
        color: white !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25) !important;
    }
    .form-control::placeholder {
        color: rgba(255,255,255,0.3) !important;
    }
    .btn-check:checked + .payment-label {
        border-color: var(--primary-color) !important;
        background-color: rgba(212, 175, 55, 0.05);
    }
    .payment-label .check-icon {
        transition: opacity 0.3s ease;
    }
    .btn-check:not(:checked) + .payment-label .check-icon {
        opacity: 0 !important;
    }
</style>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        // Initialize tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Format Card Number input
        const cardInput = document.getElementById('cardNumber');
        cardInput.addEventListener('input', function (e) {
            let target = e.target;
            let val = target.value.replace(/\D/g, '').substring(0,16);
            if (val != '') {
                val = val.match(/.{1,4}/g).join(' ');
            }
            target.value = val;
        });

        // Format Expiry Date
        const expiryDate = document.getElementById('expiryDate');
        expiryDate.addEventListener('input', function (e) {
            let target = e.target;
            let val = target.value.replace(/\D/g, '').substring(0,4);
            if (val.length >= 2) {
                val = val.substring(0,2) + '/' + val.substring(2);
            }
            target.value = val;
        });

        // Payment Method Toggle Logic
        const paymentRadios = document.querySelectorAll('.payment-method-radio');
        const cardDetailsSection = document.getElementById('cardDetailsSection');
        const paypalMessageSection = document.getElementById('paypalMessageSection');
        const cashMessageSection = document.getElementById('cashMessageSection');
        
        const cardNameInput = document.getElementById('cardNameInput');
        const cvcInput = document.getElementById('cvc');
        
        const submitBtnText = document.getElementById('submitBtnText');
        const submitBtnIcon = document.getElementById('submitBtnIcon');

        function updateFormState() {
            const selectedMethod = document.querySelector('.payment-method-radio:checked').value;
            
            // Hide all sections first
            cardDetailsSection.style.display = 'none';
            paypalMessageSection.style.display = 'none';
            cashMessageSection.style.display = 'none';
            
            // Disable required on card inputs when not using card
            cardNameInput.required = false;
            cardInput.required = false;
            expiryDate.required = false;
            cvcInput.required = false;

            if (selectedMethod === 'card') {
                cardDetailsSection.style.display = 'block';
                cardNameInput.required = true;
                cardInput.required = true;
                expiryDate.required = true;
                cvcInput.required = true;
                submitBtnText.innerText = 'PAY {{ number_format($booking->total_price, 2) }} MAD';
                submitBtnIcon.className = 'bi bi-shield-lock-fill';
                
            } else if (selectedMethod === 'paypal') {
                paypalMessageSection.style.display = 'block';
                submitBtnText.innerText = 'PROCEED TO PAYPAL';
                submitBtnIcon.className = 'bi bi-arrow-right-circle-fill';
                
            } else if (selectedMethod === 'cash') {
                cashMessageSection.style.display = 'block';
                submitBtnText.innerText = 'CONFIRM BOOKING';
                submitBtnIcon.className = 'bi bi-check-circle-fill';
            }
        }

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', updateFormState);
        });
        
        // Initialize state
        updateFormState();

        // GSAP Animations
        const luxuryCards = document.querySelectorAll('.luxury-card-3d');
        luxuryCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const xPos = e.clientX - rect.left; 
                const yPos = e.clientY - rect.top;  
                
                const xFilter = gsap.utils.mapRange(0, rect.width, -8, 8, xPos);
                const yFilter = gsap.utils.mapRange(0, rect.height, 8, -8, yPos);
                
                gsap.to(card, {
                    rotationY: xFilter,
                    rotationX: yFilter,
                    transformPerspective: 1200,
                    ease: "power2.out",
                    duration: 0.6,
                    overwrite: "auto"
                });
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotationY: 0,
                    rotationX: 0,
                    ease: "bounce.out",
                    duration: 1.5,
                    overwrite: "auto"
                });
            });
        });

        // Entrance Animations
        gsap.set('.gsap-fade-up', { y: 30, opacity: 0 });
        gsap.to('.gsap-fade-up', {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power3.out",
            stagger: 0.1
        });

        gsap.set('.gsap-reveal-left', { x: -50, opacity: 0 });
        gsap.to('.gsap-reveal-left', {
            x: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power4.out",
            delay: 0.3
        });

        gsap.set('.gsap-reveal-right', { x: 50, opacity: 0 });
        gsap.to('.gsap-reveal-right', {
            x: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power4.out",
            delay: 0.4
        });
    });
</script>
@endsection
@endsection
