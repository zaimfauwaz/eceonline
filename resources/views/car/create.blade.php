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
    <form action="{{ route('car.store') }}" method="POST" class="tab-content" style="min-height: 450px">
        @csrf
        
        <div class="tab-pane fade show active" id="basic">
            <h2 class="mb-4">Add New Car</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    <div class="mb-3">
                        <label for="car_brand" class="form-label"><i class="fas fa-car text-primary me-2"></i>Brand</label>
                        <input type="text" class="form-control" id="car_brand" name="car_brand">
                    </div>
                    <div class="mb-3">
                        <label for="car_model" class="form-label"><i class="fas fa-info text-primary me-2"></i>Model</label>
                        <input type="text" class="form-control" id="car_model" name="car_model">
                    </div>
                    <div class="mb-3">
                        <label for="car_color" class="form-label"><i class="fas fa-palette text-primary me-2"></i>Color</label>
                        <select class="form-control" id="car_color" name="car_color">
                            <option value="">Select Color</option>
                            <option value="Black">Black</option>
                            <option value="White">White</option>
                            <option value="Silver">Silver</option>
                            <option value="Red">Red</option>
                            <option value="Blue">Blue</option>
                            <option value="Grey">Grey</option>
                            <option value="Brown">Brown</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_type" class="form-label"><i class="fas fa-car text-primary me-2"></i>Type</label>
                        <select class="form-control" id="car_type" name="car_type">
                            <option value="">Select Type</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Van">Van</option>
                            <option value="Pickup">Pickup</option>
                            <option value="Sports Car">Sports Car</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_transmission" class="form-label"><i class="fas fa-cog text-primary me-2"></i>Transmission</label>
                        <select class="form-control" id="car_transmission" name="car_transmission">
                            <option value="" disabled selected>Select Transmission</option>
                            <option value="0">Automatic</option>
                            <option value="1">Manual</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="car_generation" class="form-label"><i class="fas fa-calendar text-primary me-2"></i>Generation</label>
                        <input type="number" class="form-control" id="car_generation" name="car_generation">
                    </div>
                    <div class="mb-3">
                        <label for="car_market_price" class="form-label"><i class="fas fa-tag text-primary me-2"></i>Market Price (RM)</label>
                        <input type="number" step="0.01" class="form-control" id="car_market_price" name="car_market_price">
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Branch Information</h5>
                    <div class="mb-3">
                        <label for="branch_id" class="form-label"><i class="fas fa-building text-primary me-2"></i>Branch</label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{ $branch->branch_id }}">
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
                <textarea class="form-control" id="car_description" name="car_description" rows="5" maxlength="255"></textarea>
            </div>
        </div>

        <div class="tab-pane fade" id="gallery">
            <h2 class="mb-4">Car Gallery</h2>
            <div class="mb-3">
                <label for="car_image_url" class="form-label"><i class="fas fa-image text-primary me-2"></i>Image URL</label>
                <input type="text" class="form-control" id="car_image_url" name="car_image_url">
            </div>
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
                                <input type="number" class="form-control" id="car_horsepower" name="car_horsepower">
                            </div>
                            <div class="mb-3">
                                <label for="car_top_speed" class="form-label"><i class="fas fa-bolt text-primary me-2"></i>Top Speed (km/h)</label>
                                <input type="number" class="form-control" id="car_top_speed" name="car_top_speed">
                            </div>
                            <div class="mb-3">
                                <label for="car_mileage" class="form-label"><i class="fas fa-road text-primary me-2"></i>Mileage (km)</label>
                                <input type="number" class="form-control" id="car_mileage" name="car_mileage">
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
                                    <option value="Petrol">Petrol</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Electric">Electric</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_seats" class="form-label"><i class="fas fa-users text-primary me-2"></i>Number of Seats</label>
                                <select class="form-control" id="car_seats" name="car_seats">
                                    <option value="">Select Number of Seats</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_engine" class="form-label"><i class="fas fa-wrench text-primary me-2"></i>Engine</label>
                                <input type="text" class="form-control" id="car_engine" name="car_engine">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary mx-2">
                <i class="fas fa-plus me-2"></i>Create Car
            </button>
            <a href="{{ route('car.index') }}" class="btn btn-warning">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
        </div>
    </form>
@endsection
