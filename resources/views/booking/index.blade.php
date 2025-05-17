@extends('layouts.tableview')

@section('create-button')
    @can('manage-bookings')
        <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus me-2"></i>Create Booking
        </a>
    @endcan
    @can('check-bookings')
        <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus me-2"></i>Create Booking
        </a>
    @endcan
@endsection

@section('table-header')
    <tr>
        <th scope="col">Booked By</th>
        <th scope="col">Booking Start Date</th>
        <th scope="col">Booking Expires On</th>
        <th scope="col">Booking Status</th>
        <th scope="col">Approved by</th>
        <th scope="col">Actions</th>
    </tr>
@endsection

@section('table-body')
    @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->user->name }}</td>
            <td>{{ $booking->booking_start->format('Y-m-d H:i') }}</td>
            <td>{{ $booking->booking_end->format('Y-m-d H:i') }}</td>
            <td>{{ $booking->status }}</td>
            <td>{{ optional($booking->approvedBy)->name ?? 'Not Available' }}</td>
            <td>
                <a href="{{ route('booking.show', $booking->booking_id) }}" class="btn btn-primary">
                    View Details
                </a>
                @can('manage-bookings')
                    <a href="{{ route('booking.edit', $booking->booking_id) }}" class="btn btn-warning">
                    Edit
                </a>
                <form action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                        Delete
                    </button>
                </form>
                @endcan
            </td>
        </tr>
    @endforeach
@endsection