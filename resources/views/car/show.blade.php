@extends('layouts.catpreview')

@section('attributes')
    <a href="#basic" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
        <i class="fas fa-info-circle me-2"></i> Basic Details
    </a>
    <a href="#description" class="list-group-item list-group-item-action" data-bs-toggle="tab">
        <i class="fas fa-align-left me-2"></i> Description
    </a>
    <a href="#gallery" class="list-group-item list-group-item-action" data-bs-toggle="tab">
        <i class="fas fa-images me-2"></i> Car Gallery
    </a>
    <a href="#specs" class="list-group-item list-group-item-action" data-bs-toggle="tab">
        <i class="fas fa-cogs me-2"></i> Advanced Specifications
    </a>
    @guest
        <div class="text-center mt-4">
            <p class="lead">Please log in or register to book this car.</p>
        </div>
    @endguest
    @can('check-bookings')
        <div class="text-center mt-4">
            <a href="{{ route('booking.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-calendar-check me-2"></i> Book This Car Now
            </a>
        </div>
    @endcan
@endsection

@section('description')
    <div class="tab-content" style="min-height: 450px">
        <div class="tab-pane fade show active" id="basic">
            <h2 class="mb-4">{{ $car->car_brand }} {{ $car->car_model }}</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-palette text-primary me-2"></i> Color: {{ $car->car_color }}</li>
                        <li class="mb-2"><i class="fas fa-car text-primary me-2"></i> Type: {{ $car->car_type }}</li>
                        <li class="mb-2"><i class="fas fa-cog text-primary me-2"></i> Transmission: {{ $car->transmission_type }}</li>
                        <li class="mb-2"><i class="fas fa-calendar text-primary me-2"></i> Generation: {{ $car->car_generation ?? 'N/A' }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Location</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-building text-primary me-2"></i> Branch: {{ $car->branch->branch_name }}</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Location: {{ $car->branch->branch_location }}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h5 class="mb-2"><i class="fas fa-tag text-primary me-2"></i> Market Price</h5>
                        <p class="h3 mb-0">RM {{ number_format($car->car_market_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="description">
            <h2 class="mb-4">Car Description</h2>
            <p class="lead">{{ $car->car_description }}</p>
        </div>

        <div class="tab-pane fade" id="gallery">
            <h2 class="mb-4">Car Gallery</h2>
            @if ($car->car_image_url)
                <img src="{{ $car->car_image_url }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" 
                     class="img-fluid rounded mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
            @else
                <div class="alert alert-info">No images available for this car.</div>
            @endif
        </div>

        <div class="tab-pane fade" id="specs">
            <h2 class="mb-4">Advanced Specifications</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Performance</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-tachometer-alt text-primary me-2"></i> Horsepower: {{ $car->car_horsepower }} HP</li>
                                <li class="mb-2"><i class="fas fa-bolt text-primary me-2"></i> Top Speed: {{ $car->car_top_speed }} km/h</li>
                                <li class="mb-2"><i class="fas fa-road text-primary me-2"></i> Mileage: {{ number_format($car->car_mileage) }} km</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Additional Details</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-gas-pump text-primary me-2"></i> Fuel Type: {{ $car->car_fuel_type }}</li>
                                <li class="mb-2"><i class="fas fa-users text-primary me-2"></i> Seats: {{ $car->car_seats }}</li>
                                <li class="mb-2"><i class="fas fa-wrench text-primary me-2"></i> Engine: {{ $car->car_engine }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection