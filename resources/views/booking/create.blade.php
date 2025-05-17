@extends('layouts.forms')

@section('form_title', 'Create Booking')
@section('form_description', 'Fill in the details below to create a new booking.')
@section('form_icon', 'fas fa-calendar-check')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @can('manage-bookings')
        <div class="form-group mb-2">
            <label for="user_id">Person for Booking?</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endcan

        @can('check-bookings')
        <div class="form-group mb-2">
            <label for="user_id">Your Booking?</label>
            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->user_id }}">
            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ auth()->user()->name }}" readonly>
        </div>
        @endcan

        <div class="form-group mb-2">
            <label for="booking_start">Booking Start Date</label>
            <input type="datetime-local" name="booking_start" id="booking_start" class="form-control" value="{{ old('booking_start') ? date('Y-m-d\TH:i', strtotime(old('booking_start'))) : '' }}" required>
            @error('booking_start')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="booking_end">Booking End Date</label>
            <input type="datetime-local" name="booking_end" id="booking_end" class="form-control" value="{{ old('booking_end') ? date('Y-m-d\TH:i', strtotime(old('booking_end'))) : '' }}" required>
            @error('booking_end')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @can('check-bookings')
            <input type="hidden" name="booking_status" id="booking_status" value="0">
        @endcan

        @can('manage-bookings')
        <div class="form-group mb-2">
            <label for="booking_status">Booking Status</label>
            <select name="booking_status" id="booking_status" class="form-control">
                <option value="0" {{ old('booking_status') == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ old('booking_status') == '1' ? 'selected' : '' }}>Approved</option>
                <option value="2" {{ old('booking_status') == '2' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('booking_status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endcan

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
                                <input class="form-check-input" type="checkbox" name="car_ids[]" id="car_{{ $car->car_id }}" value="{{ $car->car_id }}" {{ in_array($car->car_id, old('car_ids', [])) ? 'checked' : '' }}>
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
        <button type="submit" class="btn btn-success">Create Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Bookings
        </a>
    </form>
</div>
@endsection
