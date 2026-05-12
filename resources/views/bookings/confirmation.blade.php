@extends('layouts.app')

@section('title', 'État de la réservation')

@section('content')
@php
    // Nettoyage de la variable pour assurer la correspondance exacte avec la base de données
    $status = strtolower(trim($booking->status));
@endphp

<div class="py-5 bg-white min-vh-100 d-flex align-items-center">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="mb-4">
                    @if($status === 'confirmed')
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-check-lg fs-1"></i>
                        </div>
                    @elseif($status === 'cancelled')
                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-x-lg fs-1"></i>
                        </div>
                    @elseif($status === 'completed')
                        <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-flag-fill fs-1"></i>
                        </div>
                    @else
                        <div class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-clock fs-1"></i>
                        </div>
                    @endif
                </div>

                <h1 class="fw-bold mb-4">
                    @if($status === 'confirmed') Réservation confirmée
                    @elseif($status === 'cancelled') Réservation annulée
                    @elseif($status === 'completed') Réservation terminée
                    @else Réservation en attente
                    @endif
                </h1>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=800' }}" class="img-fluid h-100" style="object-fit: cover;" alt="Voiture">
                        </div>
                        <div class="col-md-8 text-start p-4">
                            @php
                                $badgeColor = ($status === 'confirmed' ? 'success' : ($status === 'cancelled' ? 'danger' : ($status === 'completed' ? 'info' : 'warning')));
                            @endphp
                            <div class="badge bg-{{ $badgeColor }} rounded-pill px-3 mb-2">
                                {{ strtoupper($status) }}
                            </div>
                            <h5 class="fw-bold">{{ $booking->car->brand }} {{ $booking->car->model }}</h5>
                            <p class="text-muted small">Code de réservation : {{ $booking->booking_number }}</p>
                        </div>
                    </div>
                </div>

                @if($status === 'confirmed')
                    <div class="alert alert-success border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold">Votre réservation est confirmée !</h5>
                        <p class="mb-2">Tout est prêt. Notre équipe vous attend au lieu de prise en charge.</p>
                        
                        <a href="{{ route('bookings.download-pdf', $booking->id) }}" class="btn btn-success mt-2 rounded-pill px-4">
                            <i class="bi bi-file-earmark-pdf"></i> Télécharger le billet PDF
                        </a>
                    </div>
                @elseif($status === 'cancelled')
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold">Votre réservation a été annulée.</h5>
                        <p class="mb-0">Cette réservation n'est plus active.</p>
                    </div>
                @elseif($status === 'completed')
                    <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold">Réservation terminée !</h5>
                        <p class="mb-0">Merci d'avoir choisi nos services. Au plaisir de vous revoir.</p>
                    </div>
                @else
                    <div class="alert alert-warning border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold">Votre réservation est en attente.</h5>
                        <p class="mb-0">Nous traitons votre demande et reviendrons vers vous rapidement.</p>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-dark rounded-pill px-5">RETOUR À L'ACCUEIL</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection