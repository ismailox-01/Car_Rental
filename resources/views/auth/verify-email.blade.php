@extends('layouts.app')

@section('title', 'Verify Your Email')

@section('content')
<section class="min-vh-100 d-flex align-items-center position-relative overflow-hidden" style="background: #020617;">
    <!-- Animated Mesh Background -->
    <div class="position-absolute w-100 h-100" style="z-index: 1;">
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20" style="background: radial-gradient(circle at 50% 50%, #1e293b 0%, #020617 100%);"></div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png'); opacity: 0.03;"></div>
    </div>
    
    <div class="container position-relative z-index-2 py-5" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 gsap-fade-up">
                <div class="glass-card border-0 shadow-2xl rounded-5 overflow-hidden position-relative" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05) !important;">
                    <!-- Top Accent Bar -->
                    <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, transparent, var(--accent-color), transparent);"></div>
                    
                    <div class="card-body p-5 text-center">
                        <div class="mb-5">
                            <div class="avatar-wrapper d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px; background: linear-gradient(45deg, rgba(212, 175, 55, 0.1), transparent); border-radius: 50%; border: 1px solid rgba(212, 175, 55, 0.2); padding: 5px;">
                                <div class="bg-dark rounded-circle w-100 h-100 d-flex align-items-center justify-content-center border border-white border-opacity-10 shadow-lg">
                                    <i class="bi bi-envelope-open-heart text-primary fs-1"></i>
                                </div>
                            </div>
                            <h2 class="fw-extrabold text-white mb-2" style="font-size: 2.25rem; letter-spacing: -0.03em;">Awaiting Verification</h2>
                            <p class="text-white-50 px-4">Your premium access is one click away. We've sent an activation link to your inbox.</p>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert bg-success bg-opacity-10 text-success border border-success border-opacity-20 rounded-4 mb-5 small fw-bold py-3 animate-fade-in d-flex align-items-center justify-content-center">
                                <i class="bi bi-patch-check-fill me-2 fs-5"></i>
                                {{ __('A fresh activation link has been delivered.') }}
                            </div>
                        @endif

                        <div class="d-grid gap-3">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-extrabold tracking-wider shadow-lg hover-scale">
                                    {{ __('RESEND ACTIVATION EMAIL') }} <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-white-50 text-decoration-none small fw-bold mt-2 opacity-75 hover-opacity-100 transition-all">
                                    <i class="bi bi-box-arrow-right me-1"></i> {{ __('Log Out & Try Later') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="bg-black bg-opacity-40 p-4 text-center border-top border-white border-opacity-5">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <span class="text-white-50 x-small fw-bold tracking-widest text-uppercase">
                                <i class="bi bi-shield-lock-fill text-primary me-2"></i> Encrypted Authentication
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5 gsap-fade-up" style="transition-delay: 0.2s">
                    <p class="text-white-50 small">
                        Didn't receive the email? Check your <strong>Spam</strong> folder <br>
                        or contact our <a href="{{ route('contact') }}" class="text-primary text-decoration-none fw-bold">elite support team</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .fw-extrabold { font-weight: 800; }
    .tracking-widest { letter-spacing: 0.25em; }
    .tracking-wider { letter-spacing: 0.1em; }
    .x-small { font-size: 0.7rem; }
    
    .hover-scale { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .hover-scale:hover { transform: scale(1.03) translateY(-2px); box-shadow: 0 15px 30px rgba(212, 175, 55, 0.2) !important; }
    
    .hover-opacity-100:hover { opacity: 1 !important; color: white !important; }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    .glass-card {
        border-radius: 2.5rem !important;
    }
</style>
@endsection
