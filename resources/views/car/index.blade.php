@extends('layouts.catalog')

@section('showcase')
    @php
        $randomCar = $cars->random();
    @endphp

    <div class="showcase-section position-relative mb-5 bg-light rounded-3 overflow-hidden">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 position-relative showcase-image">
                @if (!empty($randomCar->car_image_url))
                    <img src="{{ $randomCar->car_image_url }}" 
                         alt="{{ $randomCar->car_brand }} {{ $randomCar->car_model }}" 
                         class="img-fluid w-100" 
                         style="height: 400px; object-fit: cover;">
                @endif
                <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-dark">
                    <span class="badge bg-primary mb-2">Featured</span>
                    <h2 class="text-white mb-0">{{ $randomCar->car_brand }} {{ $randomCar->car_model }}</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 p-lg-5">
                    <div class="mb-4">
                        <h3 class="display-6 fw-bold text-primary mb-3">Discover Excellence</h3>
                        <p class="lead mb-4">{{ $randomCar->car_description }}</p>
                        <div class="specs-grid mb-4">
                            <div class="spec-item">
                                <i class="fas fa-tachometer-alt text-primary mb-2"></i>
                                <span class="d-block text-muted">{{ $randomCar->car_horsepower }} HP</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-gas-pump text-primary mb-2"></i>
                                <span class="d-block text-muted">{{ $randomCar->car_fuel_type }}</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-car text-primary mb-2"></i>
                                <span class="d-block text-muted">{{ $randomCar->car_engine }}</span>
                            </div>
                        </div>
                        <a href="{{ route('car.show', $randomCar->car_id) }}" 
                           class="btn btn-primary btn-lg">
                            Explore Now <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-relative mb-4">
        <div class="text-center">
            <h2 class="display-5 fw-bold mb-3">Available Cars</h2>
            <p class="lead text-muted mb-0">Discover our extensive collection of premium vehicles</p>
        </div>
        @can('manage-cars')
        <div class="position-absolute top-0 end-0">
            <a href="{{ route('car.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Car
            </a>
        </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row g-4">
        @foreach ($cars as $car)
        <div class="col-lg-4 col-md-6">
            <div class="card car-card h-100 border-0 shadow-sm">
                @if (!empty($car->car_image_url))
                    <img src="{{ $car->car_image_url }}" 
                         class="card-img-top" 
                         alt="{{ $car->car_brand }} {{ $car->car_model }}"
                         style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <a href="{{ route('car.show', $car->car_id) }}" 
                               class="text-decoration-none text-dark hover-text-primary">
                                {{ $car->car_brand }} {{ $car->car_model }}
                            </a>
                        </h5>
                        <span class="badge @if ($car->car_transmission==0) bg-danger @else bg-primary @endif">
                            {{ $car->transmission_type }}
                        </span>
                    </div>
                    <p class="card-text text-muted">{{ Str::limit($car->car_description, 100) }}</p>
                    <div class="car-features mb-3">
                        <span class="me-3"><i class="fas fa-tachometer-alt text-primary me-2"></i> {{ $car->car_horsepower }} HP</span>
                        <span class="me-3"><i class="fas fa-road text-primary me-2"></i> {{ number_format($car->car_mileage) }} km</span>
                        <span><i class="fas fa-users text-primary me-2"></i> {{ $car->car_seats }} seats</span>
                    </div>
                    <div class="price-tag mb-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-tag me-2"></i> RM {{ number_format($car->car_market_price) }}
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('car.show', $car->car_id) }}" 
                           class="btn btn-outline-primary">View Details</a>
                        @can('manage-cars')
                        <div class="btn-group">
                            <a href="{{ route('car.edit', $car->car_id) }}" 
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('car.destroy', $car->car_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this car? This action cannot be undone.')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <style>
        .showcase-section {
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }
        .bg-gradient-dark {
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        }
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            text-align: center;
        }
        .spec-item {
            padding: 1rem;
            background: rgba(0,0,0,0.03);
            border-radius: 8px;
        }
        .car-card {
            transition: transform 0.3s ease;
        }
        .car-card:hover {
            transform: translateY(-5px);
        }
        .hover-text-primary:hover {
            color: var(--bs-primary) !important;
        }
        .car-features {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('pagination')
    <div class="mt-5">
        {{ $cars->links() }}
    </div>
@endsection