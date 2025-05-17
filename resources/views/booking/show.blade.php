@extends('layouts.forms')

@section('form_title', 'View Booking')
@section('form_description', 'Details of the booking are shown below.')
@section('form_icon', 'fas fa-eye')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <div class="form-group mb-2">
        <label for="booking_start">Booking Start Date</label>
        <input type="datetime-local" name="booking_start" id="booking_start" class="form-control" value="{{ $booking->booking_start->format('Y-m-d\TH:i') }}" readonly>
    </div>
    <div class="form-group mb-2">
        <label for="booking_end">Booking End Date</label>
        <input type="datetime-local" name="booking_end" id="booking_end" class="form-control" value="{{ $booking->booking_end->format('Y-m-d\TH:i') }}" readonly>
    </div>
    <div class="form-group mb-2">
        <label for="booking_status">Booking Status</label>
        <input type="text" name="booking_status" id="booking_status" class="form-control" value="{{ $booking->booking_status == '0' ? 'Pending' : ($booking->booking_status == '1' ? 'Approved' : 'Rejected') }}" readonly>
    </div>

    @can('check-bookings')
    <div class="form-group mb-2">
        <label for="customer_name">Approval by</label>
        <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $booking->approved_by ? $booking->approvedBy->name : 'N/A' }}" readonly>
    </div>
    @endcan

    <div class="form-group mb-4">
        <label for="car_ids">Cars in Booking</label>
        <div id="car_ids" class="row">
            @foreach ($booking->cars as $car)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="car_{{ $car->car_id }}" value="{{ $car->car_id }}" checked disabled>
                        <label class="form-check-label" for="car_{{ $car->car_id }}">
                            {{ $car->car_brand }} {{ $car->car_model }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('booking.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Return to Bookings
    </a>
</div>
@endsection
