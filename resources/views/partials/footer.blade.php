<footer class="footer mt-auto py-5 bg-dark text-white shadow-lg overflow-hidden position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand mb-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-car-front-fill me-2 text-primary"></i>CAR<span class="text-primary">RENTAL</span></h4>
                    <p class="text-white-50 mt-3 small leading-relaxed">Redefining the Moroccan road trip experience since 2018. We provide the keys to the Kingdom's most beautiful journeys with a premium fleet and unmatched service.</p>
                </div>
                <div class="social-links hstack gap-3">
                    <a href="#" class="social-icon rounded-circle flex-center"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon rounded-circle flex-center"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon rounded-circle flex-center"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon rounded-circle flex-center"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h6 class="text-uppercase fw-bold mb-4 tracking-wider">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="mb-3"><a href="{{ route('cars.index') }}" class="text-white-50 text-decoration-none">Our Fleet</a></li>
                    <li class="mb-3"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About Our Legacy</a></li>
                    <li class="mb-3"><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">Contact Concierge</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h6 class="text-uppercase fw-bold mb-4 tracking-wider">Support</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none">FAQs</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none">Terms of Service</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none">Insurance Details</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4">
                <h6 class="text-uppercase fw-bold mb-4 tracking-wider">Local Presence</h6>
                <div class="vstack gap-3 text-white-50 small">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-geo-alt-fill text-primary"></i>
                        <span>Boulevard d'Anfa, Maarif, Casablanca<br>Morocco 20000</span>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-telephone-fill text-primary"></i>
                        <span>+212 (0) 522 123 456</span>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-envelope-fill text-primary"></i>
                        <span>contact@carrental.ma</span>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <img src="https://help.zazzle.com/hc/article_attachments/360010513393/Logos-01.png" alt="Trusted Payments" height="25" class="opacity-50 grayscale hover-opacity-100 transition">
                </div>
            </div>
        </div>
        
        <hr class="my-5 border-white border-opacity-10">
        
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-white-50 small fw-medium">&copy; {{ date('Y') }} CarRental Morocco. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="text-white-50 small">Luxury & Convenience <i class="bi bi-dot mx-1"></i> Morocco's #1 Fleet</span>
            </div>
        </div>
    </div>
    
    <!-- Decorative Circle -->
    <div class="position-absolute top-100 start-50 translate-middle rounded-circle bg-primary opacity-10 blur-3xl pointer-events-none" style="width: 600px; height: 600px;"></div>
</footer>

<style>
    .footer {
        background: #0f172a !important; /* Deep Obsidian */
        border-top: 1px solid rgba(212, 175, 55, 0.1); /* Subtle Gold border */
    }
    .tracking-wider { letter-spacing: 0.1em; }
    .leading-relaxed { line-height: 1.6; }
    .pointer-events-none { pointer-events: none; }
    
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.03);
        color: rgba(255,255,255,0.6);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .social-icon:hover {
        background: var(--accent-color);
        color: #000; /* Dark icon on Gold background */
        transform: translateY(-5px) scale(1.1);
        border-color: var(--accent-color);
        box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
    }
    
    .footer-links a {
        transition: all 0.3s ease;
        display: inline-block;
    }
    .footer-links a:hover {
        color: var(--accent-color) !important;
        transform: translateX(8px);
    }
    
    .grayscale { filter: grayscale(1) opacity(0.5); }
    .hover-opacity-100 { transition: all 0.4s ease; }
    .hover-opacity-100:hover { opacity: 1 !important; filter: grayscale(0); transform: scale(1.05); }
    .blur-3xl { filter: blur(100px); }
</style>
