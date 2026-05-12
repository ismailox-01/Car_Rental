@extends('layouts.app')

@section('title', 'Contact Our Concierge')

@section('content')
<!-- Hero Section -->
<section class="position-relative" style="background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.95)), url('https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1920') center/cover; height: 50vh; display: flex; align-items: center;">
    <div class="container position-relative z-index-2 text-center mt-5">
        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 mb-3 rounded-pill gsap-fade-up tracking-wider small fw-bold">24/7 SUPPORT</span>
        <h1 class="display-4 fw-bold mb-3 text-white gsap-reveal-left" style="font-family: serif; font-style: italic;">Contact Our Concierge</h1>
        <p class="lead opacity-75 text-white-50 col-lg-6 mx-auto gsap-reveal-right">Whether you need assistance with a booking or a custom itinerary, our dedicated team is at your service.</p>
    </div>
</section>

<!-- Contact Info & Form Section -->
<section class="py-5 bg-light position-relative" style="margin-top: -50px; z-index: 10;">
    <div class="container pb-5">
        <div class="row g-5">
            <!-- Left: Contact Details -->
            <div class="col-lg-5 gsap-reveal-left">
                <div class="card border-0 shadow-lg rounded-4 p-5 h-100 bg-white">
                    <h3 class="fw-bold mb-5 text-dark" style="font-family: 'Outfit', sans-serif;">Reach Out Directly</h3>

                    <div class="d-flex align-items-center mb-5 group">
                        <div class="info-icon-box me-4 bg-light rounded-circle d-flex align-items-center justify-content-center transition group-hover-bg-primary" style="width: 60px; height: 60px;">
                            <i class="bi bi-geo-alt fs-4 text-dark transition group-hover-text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-1 tracking-wider">Headquarters</h6>
                            <p class="mb-0 fw-bold fs-5 text-dark">laayoune<br>layoune, 70000</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-5 group">
                        <div class="info-icon-box me-4 bg-light rounded-circle d-flex align-items-center justify-content-center transition group-hover-bg-primary" style="width: 60px; height: 60px;">
                            <i class="bi bi-telephone fs-4 text-dark transition group-hover-text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-1 tracking-wider">Direct Line</h6>
                            <p class="mb-0 fw-bold fs-5 text-dark">+212 644496104</p>
                            <p class="text-muted small mb-0 fw-medium">Mon - Sat: 8:00 AM - 8:00 PM</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-5 group">
                        <div class="info-icon-box me-4 bg-light rounded-circle d-flex align-items-center justify-content-center transition group-hover-bg-primary" style="width: 60px; height: 60px;">
                            <i class="bi bi-envelope-paper fs-4 text-dark transition group-hover-text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-1 tracking-wider">Electronic Support</h6>
                            <p class="mb-0 fw-bold fs-5 text-dark">contact@carrental.ma</p>
                            <p class="text-muted small mb-0 fw-medium">Responses typically within 2 hours</p>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-top opacity-75">
                        <h6 class="text-muted small text-uppercase fw-bold mb-3 tracking-wider">Connect Socially</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="col-lg-7 gsap-reveal-right">
                <div class="card border-0 shadow-sm rounded-4 p-5 h-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h3 class="fw-bold mb-0 text-dark" style="font-family: 'Outfit', sans-serif;">Send a Dispatch</h3>
                        <i class="bi bi-envelope-check text-primary fs-3"></i>
                    </div>

                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-muted tracking-wider">Full Name</label>
                                <input type="text" name="name" class="form-control premium-input shadow-none" placeholder="e.g. James Bond" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-muted tracking-wider">Email Address</label>
                                <input type="email" name="email" class="form-control premium-input shadow-none" placeholder="james@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-muted tracking-wider">Inquiry Type</label>
                                <select name="inquiry_type" class="form-select premium-input shadow-none cursor-pointer">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Booking Modification">Booking Modification</option>
                                    <option value="Chauffeur Services">Chauffeur Services</option>
                                    <option value="Long-term Corporate Lease">Long-term Corporate Lease</option>
                                    <option value="Partnership Proposal">Partnership Proposal</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-muted tracking-wider">Your Message</label>
                                <textarea name="message" class="form-control premium-input shadow-none" rows="5" placeholder="How may we elevate your travel experience today?" required></textarea>
                            </div>
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-dark w-100 py-3 rounded-3 fw-bold tracking-wider interaction-btn">
                                    DISPATCH INQUIRY <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Success/Error Messages -->
                    <div id="formSuccess" class="alert d-none mt-4 border border-primary text-center py-4 rounded-4" style="background-color: rgba(212, 175, 55, 0.1);">
                        <i class="bi bi-check-circle-fill fs-1 text-primary mb-3 d-block"></i>
                        <h4 class="fw-bold text-dark">Message Dispatched</h4>
                        <p class="text-muted mb-0">Our concierge will contact you shortly.</p>
                    </div>
                    <div id="formError" class="alert alert-danger d-none mt-4 text-center rounded-4">
                        Oops! There was a problem submitting your form. Please try again.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Global Presence / Map -->
<section class="py-5 bg-white mb-5">
    <div class="container pt-4">
        <div class="row align-items-center gsap-fade-up">
            <div class="col-lg-12 text-center mb-5">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Global Standard, Local Expertise</span>
                <h2 class="display-6 fw-bold mt-2 text-dark" style="font-family: serif; font-style: italic;">Find Us Across Morocco</h2>
            </div>
            <div class="col-12">
                <div class="map-placeholder shadow-sm rounded-5 d-flex align-items-center justify-content-center overflow-hidden position-relative group p-0" style="height: 400px;">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54680.23!2d-13.1985!3d27.1418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc3b4bbf70898661%3A0x7fcf0b6c9a8b0a00!2sLaayoune!5e0!3m2!1sen!2sma!4v1"
                        class="w-100 h-100 position-absolute top-0 start-0 border-0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="filter: grayscale(30%) contrast(1.1);">
                    </iframe>

                    <div class="position-absolute w-100 h-100 top-0 start-0 bg-dark opacity-10"></div>

                    <div class="bg-white p-5 rounded-4 shadow-lg text-center position-relative z-index-2" style="max-width: 350px;">
                        <i class="bi bi-geo-alt-fill fs-1 text-primary mb-3"></i>
                        <h4 class="fw-bold text-dark">LAAYOUNE</h4>
                        <p class="text-muted small mb-4">Experience our flagship luxury fleet in person at our primary showroom in LAAYOUNE.</p>
                        <a href="https://maps.app.goo.gl/b2apnTixXkiquQGi8" target="_blank" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium w-100">Get Directions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .tracking-wider { letter-spacing: 0.1em; }
    .transition { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .duration-700 { transition-duration: 0.7s; }
    .z-index-2 { z-index: 2; }
    .cursor-pointer { cursor: pointer; }

    .premium-input {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 500;
        color: #334155;
        transition: all 0.3s ease;
    }
    .premium-input:focus {
        background-color: #fff;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1) !important;
    }

    .social-btn {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc;
        color: var(--secondary-color);
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    .social-btn:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        border-color: var(--primary-color);
    }

    .map-placeholder {
        height: 450px;
        background-color: #e2e8f0;
    }

    .group:hover .group-hover-scale { transform: scale(1.05); }
    .group:hover .group-hover-opacity-25 { opacity: 0.25 !important; }
    .group:hover .group-hover-translate-y { transform: translateY(-10px); }
    .group:hover .group-hover-bg-primary { background-color: var(--primary-color) !important; }
    .group:hover .group-hover-text-white { color: white !important; }

    .interaction-btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
        border: none;
    }
    .interaction-btn::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background-color: var(--accent-color); /* Changed from primary to accent color (Gold) */
        transition: all 0.3s ease;
        z-index: -1;
    }
    .interaction-btn:hover {
        color: #000 !important;
    }
    .interaction-btn:hover::before {
        height: 100%;
    }
</style>

@section('scripts')
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("contactForm");
        const successMsg = document.getElementById("formSuccess");
        const errorMsg = document.getElementById("formError");

        if(form) {
            form.addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevent the default formspree redirect

                const data = new FormData(form);
                const btn = form.querySelector('button[type="submit"]');
                const originalText = btn.innerHTML;

                // Show loading state
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> DISPATCHING...';
                btn.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: form.method,
                        body: data,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        form.reset();
                        form.classList.add('d-none');
                        successMsg.classList.remove('d-none');

                        // Premium SweetAlert Replacement
                        Swal.fire({
                            title: 'Message Dispatched',
                            text: 'Thank you! Your information has been successfully sent to our concierge.',
                            icon: 'success',
                            confirmButtonText: 'Return to Site',
                            confirmButtonColor: '#0f172a', // Obsidian Primary
                            background: '#ffffff',
                            color: '#334155',
                            iconColor: '#d4af37', // Gold Accent
                            customClass: {
                                popup: 'rounded-4 shadow-lg border-0',
                                title: 'fw-bold',
                                confirmButton: 'btn btn-dark rounded-pill px-4 py-2 fw-medium'
                            }
                        });
                    } else {
                        errorMsg.classList.remove('d-none');
                    }
                } catch (error) {
                    errorMsg.classList.remove('d-none');
                } finally {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            });
        }
    });
</script>
@endsection
@endsection
