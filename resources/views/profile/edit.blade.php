@extends('layouts.app')

@section('title', 'Refine Your Profile')

@section('styles')
<style>
    .glass-card {
        background: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 2rem;
        transition: all 0.4s ease;
    }
    
    .form-control-glass {
        background: rgba(15, 23, 42, 0.03);
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 1rem;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }
    
    [data-bs-theme="dark"] .form-control-glass {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: white;
    }
    
    .form-control-glass:focus {
        background: transparent;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    }
    
    .doc-upload-box {
        position: relative;
        border: 2px dashed rgba(0,0,0,0.1);
        border-radius: 1.5rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: rgba(0,0,0,0.01);
    }
    
    [data-bs-theme="dark"] .doc-upload-box {
        border-color: rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.01);
    }
    
    .doc-upload-box:hover {
        border-color: var(--accent-color);
        background: rgba(212, 175, 55, 0.02);
    }
    
    .avatar-upload {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--accent-color);
    }
</style>
@endsection

@section('content')
<div class="py-5 min-vh-100">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Left Column: Identity -->
            <div class="col-lg-4 gsap-reveal-left">
                <div class="glass-card p-4 text-center sticky-top shadow-sm border-0" style="top: 100px; z-index: 1000;">
                    <div class="profile-hero text-center mb-0">
                        <div class="avatar-wrapper mb-4">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar-upload shadow-lg" alt="{{ $user->name }}">
                            @else
                                <div class="avatar-upload shadow-lg d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary font-monospace fs-1 fw-bold mx-auto" style="width: 120px; height: 120px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' '), 1, 1)) ?: '' }}
                                </div>
                            @endif
                        </div>
                        <h4 class="fw-extrabold mb-1 text-theme-dark">{{ $user->name }}</h4>
                        <p class="text-muted small px-3">Maintain your account details for a premium rental experience.</p>
                    </div>
                    
                    <div class="nav flex-column nav-pills gap-3 text-start mt-2">
                        <a href="{{ route('profile.show') }}" class="nav-link rounded-pill px-4 py-3 border-0 text-muted d-flex align-items-center transition-all hover-bg-light">
                            <i class="bi bi-grid-1x2 me-3 fs-5"></i>
                            <span class="fw-bold">Dashboard Overview</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="nav-link active rounded-pill px-4 py-3 border-0 d-flex align-items-center transition-all bg-primary text-white shadow-sm">
                            <i class="bi bi-pencil-square me-3 fs-5"></i>
                            <span class="fw-bold">Refine Profile</span>
                        </a>
                        <a href="{{ route('bookings.history') }}" class="nav-link rounded-pill px-4 py-3 border-0 text-muted d-flex align-items-center transition-all hover-bg-light">
                            <i class="bi bi-calendar-check me-3 fs-5"></i>
                            <span class="fw-bold">My Bookings</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Form -->
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5 shadow-sm gsap-fade-up border-0">
                    <header class="mb-5">
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3 small">ACCOUNT MANAGEMENT</div>
                        <h2 class="fw-extrabold text-theme-dark mb-2" style="font-size: 2.5rem;">Refine Personal Details</h2>
                        <p class="text-muted lead">Update your verified information and digital identity.</p>
                    </header>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="return_to" value="{{ request('return_to', old('return_to')) }}">
                        
                        <!-- Section: Identity -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-4 text-theme-dark d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem">01</span>
                                CORE IDENTITY
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="bg-light p-4 rounded-4 border border-dashed text-theme-dark transition-all hover-border-primary">
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="bg-white p-3 rounded-circle shadow-sm"><i class="bi bi-camera fs-3 text-primary"></i></div>
                                            <div class="flex-grow-1">
                                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider mb-1">Profile Portrait</label>
                                                <input type="file" name="avatar" class="form-control form-control-sm border-0 bg-transparent shadow-none p-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Full Legal Name</label>
                                    <input type="text" name="name" class="form-control form-control-glass shadow-none" value="{{ old('name', $user->name) }}" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Registered Email</label>
                                    <input type="email" class="form-control form-control-glass bg-light opacity-75" value="{{ $user->email }}" disabled>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Contact Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 px-3 text-muted rounded-start-4">+212</span>
                                        <input type="text" name="phone" class="form-control form-control-glass shadow-none" value="{{ old('phone', $user->phone) }}" placeholder="6 00 00 00 00">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">License Certificate #</label>
                                    <input type="text" name="license_number" class="form-control form-control-glass shadow-none" value="{{ old('license_number', $user->license_number) }}" placeholder="MC123456">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Primary Residence</label>
                                    <textarea name="address" class="form-control form-control-glass shadow-none" rows="3" placeholder="Street, City, Morocco">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Verification -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-4 text-theme-dark d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem">02</span>
                                TRUST DOCUMENTS
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="doc-upload-box transition-all">
                                        <div class="mb-3 text-primary opacity-50"><i class="bi bi-person-bounding-box" style="font-size: 2.5rem"></i></div>
                                        <label class="fw-bold small text-muted text-uppercase d-block mb-3">ID / Passport</label>
                                        <input type="file" name="id_card_image" class="form-control form-control-sm bg-transparent border-0 shadow-none text-center custom-file-input">
                                        @if($user->id_card_image)
                                            <div class="mt-3 badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">
                                                <i class="bi bi-check-lg me-1"></i> CURRENTLY ACTIVE
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="doc-upload-box transition-all">
                                        <div class="mb-3 text-primary opacity-50"><i class="bi bi-card-checklist" style="font-size: 2.5rem"></i></div>
                                        <label class="fw-bold small text-muted text-uppercase d-block mb-3">Driving License Card</label>
                                        <input type="file" name="driving_license_image" class="form-control form-control-sm bg-transparent border-0 shadow-none text-center">
                                        @if($user->driving_license_image)
                                            <div class="mt-3 badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">
                                                <i class="bi bi-check-lg me-1"></i> CURRENTLY ACTIVE
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pt-5 border-top gap-4">
                            <div class="d-flex align-items-center text-muted small">
                                <div class="bg-light p-2 rounded-circle me-3"><i class="bi bi-lock-fill"></i></div>
                                <span>End-to-end encrypted profile data management.</span>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-extrabold py-3 shadow-lg transition-all hover-scale">
                                UPDATE & AUTHENTICATE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-extrabold { font-weight: 800; }
    .tracking-wider { letter-spacing: 0.1em; }
    .hover-border-primary:hover { border-color: var(--accent-color) !important; border-style: solid !important; }
    .hover-scale:hover { transform: scale(1.02) translateY(-2px); }
    .form-control-glass:hover { border-color: rgba(212, 175, 55, 0.3); }
    .rounded-start-4 { border-top-left-radius: 1rem !important; border-bottom-left-radius: 1rem !important; }
</style>
@endsection
