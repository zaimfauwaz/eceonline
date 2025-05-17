@extends('layouts.forms')

@section('form_title', 'Edit Booking')
@section('form_description', 'Update the details below to edit the booking.')
@section('form_icon', 'fas fa-edit')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('booking.update', $booking->booking_id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group mb-2">
            <label for="user_id">Your Booking?</label>
            <input type="hidden" name="user_id" id="user_id" value="{{ $booking->user_id }}">
            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ $booking->user->name }}" readonly>
        </div>

        <div class="form-group mb-2">
            <label for="booking_start">Booking Start Date</label>
            <input type="datetime-local" name="booking_start" id="booking_start" class="form-control" value="{{ old('booking_start') ? date('Y-m-d\TH:i', strtotime(old('booking_start'))) : $booking->booking_start->format('Y-m-d\TH:i') }}" required>
            @error('booking_start')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="booking_end">Booking End Date</label>
            <input type="datetime-local" name="booking_end" id="booking_end" class="form-control" value="{{ old('booking_end') ? date('Y-m-d\TH:i', strtotime(old('booking_end'))) : $booking->booking_end->format('Y-m-d\TH:i') }}" required>
            @error('booking_end')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="booking_status">Booking Status</label>
            <select name="booking_status" id="booking_status" class="form-control">
                <option value="0" {{ $booking->booking_status == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ $booking->booking_status == '1' ? 'selected' : '' }}>Approved</option>
                <option value="2" {{ $booking->booking_status == '2' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('booking_status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="car_ids">Select Cars</label>
            <div id="car_ids" class="row">
                @foreach ($cars as $branchName => $branchCars)
                    <div class="col-12">
                        <strong>{{ $branchName }}</strong>
                    </div>
                    @foreach ($branchCars as $index => $car)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="car_ids[]" id="car_{{ $car->car_id }}" value="{{ $car->car_id }}" {{ in_array($car->car_id, $selectedCars ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="car_{{ $car->car_id }}">
                                    {{ $car->car_brand }} {{ $car->car_model }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            @error('car_ids')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Bookings
        </a>
    </form>
</div>
@endsection
