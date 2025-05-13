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
@endsection


@section('description')
    <form action="{{ route('car.update', $car->car_id) }}" method="POST" class="tab-content" style="min-height: 450px">
        @csrf
        @method('PUT')
        
        <div class="tab-pane fade show active" id="basic">
            <h2 class="mb-4">Edit Car Details</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    <div class="mb-3">
                        <label for="car_brand" class="form-label"><i class="fas fa-car text-primary me-2"></i>Brand</label>
                        <input type="text" class="form-control" id="car_brand" name="car_brand" value="{{ $car->car_brand }}">
                    </div>
                    <div class="mb-3">
                        <label for="car_model" class="form-label"><i class="fas fa-info text-primary me-2"></i>Model</label>
                            <input type="text" class="form-control" id="car_model" name="car_model" value="{{ $car->car_model }}">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_color" class="form-label"><i class="fas fa-palette text-primary me-2"></i>Color</label>
                        <select class="form-control" id="car_color" name="car_color">
                            <option value="">Select Color</option>
                            <option value="Black" {{ $car->car_color == 'Black' ? 'selected' : '' }}>Black</option>
                            <option value="White" {{ $car->car_color == 'White' ? 'selected' : '' }}>White</option>
                            <option value="Silver" {{ $car->car_color == 'Silver' ? 'selected' : '' }}>Silver</option>
                            <option value="Red" {{ $car->car_color == 'Red' ? 'selected' : '' }}>Red</option>
                            <option value="Blue" {{ $car->car_color == 'Blue' ? 'selected' : '' }}>Blue</option>
                            <option value="Grey" {{ $car->car_color == 'Grey' ? 'selected' : '' }}>Grey</option>
                            <option value="Brown" {{ $car->car_color == 'Brown' ? 'selected' : '' }}>Brown</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_type" class="form-label"><i class="fas fa-car text-primary me-2"></i>Type</label>
                        <select class="form-control" id="car_type" name="car_type">
                            <option value="">Select Type</option>
                            <option value="Sedan" {{ $car->car_type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="SUV" {{ $car->car_type == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Hatchback" {{ $car->car_type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                            <option value="Van" {{ $car->car_type == 'Van' ? 'selected' : '' }}>Van</option>
                            <option value="Pickup" {{ $car->car_type == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="Sports Car" {{ $car->car_type == 'Sports Car' ? 'selected' : '' }}>Sports Car</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_transmission" class="form-label"><i class="fas fa-cog text-primary me-2"></i>Transmission</label>
                        <select class="form-control" id="car_transmission" name="car_transmission">
                            <option value="1" {{ $car->car_transmission == 1 ? 'selected' : '' }}>Automatic</option>
                            <option value="0" {{ $car->car_transmission == 0 ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_generation" class="form-label"><i class="fas fa-calendar text-primary me-2"></i>Generation</label>
                        <input type="number" class="form-control" id="car_generation" name="car_generation" value="{{ $car->car_generation }}">
                    </div>
                    <div class="mb-3">
                        <label for="car_market_price" class="form-label"><i class="fas fa-tag text-primary me-2"></i>Market Price (RM)</label>
                        <input type="number" step="1" class="form-control" id="car_market_price" name="car_market_price" value="{{ $car->car_market_price }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Branch Information</h5>
                    <div class="mb-3">
                        <label for="branch_id" class="form-label"><i class="fas fa-building text-primary me-2"></i>Branch</label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{ $branch->branch_id }}" {{ $car->branch_id == $branch->branch_id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }} - {{ $branch->branch_location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="description">
            <h2 class="mb-4">Car Description</h2>
            <div class="mb-3">
                <label for="car_description" class="form-label"><i class="fas fa-align-left text-primary me-2"></i>Description</label>
                <textarea class="form-control" id="car_description" name="car_description" rows="5" maxlength="255">{{ $car->car_description }}</textarea>
            </div>
        </div>

        <div class="tab-pane fade" id="gallery">
            <h2 class="mb-4">Car Gallery</h2>
            <div class="mb-3">
                <label for="car_image_url" class="form-label"><i class="fas fa-image text-primary me-2"></i>Image URL</label>
                <input type="text" class="form-control" id="car_image_url" name="car_image_url" value="{{ $car->car_image_url }}">
            </div>
            @if ($car->car_image_url)
                <img src="{{ $car->car_image_url }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" 
                     class="img-fluid rounded mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
            @endif
        </div>

        <div class="tab-pane fade" id="specs">
            <h2 class="mb-4">Advanced Specifications</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Performance</h5>
                            <div class="mb-3">
                                <label for="car_horsepower" class="form-label"><i class="fas fa-tachometer-alt text-primary me-2"></i>Horsepower</label>
                                <input type="number" class="form-control" id="car_horsepower" name="car_horsepower" value="{{ $car->car_horsepower }}">
                            </div>
                            <div class="mb-3">
                                <label for="car_top_speed" class="form-label"><i class="fas fa-bolt text-primary me-2"></i>Top Speed (km/h)</label>
                                <input type="number" class="form-control" id="car_top_speed" name="car_top_speed" value="{{ $car->car_top_speed }}">
                            </div>
                            <div class="mb-3">
                                <label for="car_mileage" class="form-label"><i class="fas fa-road text-primary me-2"></i>Mileage (km)</label>
                                <input type="number" class="form-control" id="car_mileage" name="car_mileage" value="{{ $car->car_mileage }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Additional Details</h5>
                            <div class="mb-3">
                                <label for="car_fuel_type" class="form-label"><i class="fas fa-gas-pump text-primary me-2"></i>Fuel Type</label>
                                <select class="form-control" id="car_fuel_type" name="car_fuel_type">
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" {{ $car->car_fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="Diesel" {{ $car->car_fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="Hybrid" {{ $car->car_fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="Electric" {{ $car->car_fuel_type == 'Electric' ? 'selected' : '' }}>Electric</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_seats" class="form-label"><i class="fas fa-users text-primary me-2"></i>Number of Seats</label>
                                <select class="form-control" id="car_seats" name="car_seats">
                                    <option value="">Select Number of Seats</option>
                                    <option value="2" {{ $car->car_seats == '2' ? 'selected' : '' }}>2</option>
                                    <option value="4" {{ $car->car_seats == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $car->car_seats == '5' ? 'selected' : '' }}>5</option>
                                    <option value="7" {{ $car->car_seats == '7' ? 'selected' : '' }}>7</option>
                                    <option value="8" {{ $car->car_seats == '8' ? 'selected' : '' }}>8</option>
                                    <option value="9" {{ $car->car_seats == '9' ? 'selected' : '' }}>9</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_engine" class="form-label"><i class="fas fa-wrench text-primary me-2"></i>Engine</label>
                                <input type="text" class="form-control" id="car_engine" name="car_engine" value="{{ $car->car_engine }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary mx-2">
                <i class="fas fa-save me-2"></i>Save Changes
            </button>
            <a href="{{ route('car.index') }}" class="btn btn-warning">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
        </div>
    </form>
@endsection
