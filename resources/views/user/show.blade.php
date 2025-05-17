@extends('layouts.forms')

@section('form_title', 'User Details')
@section('form_description', 'View the details of the user below.')
@section('form_icon', 'fas fa-eye')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <div class="form-group mb-2">
        <label for="user_name">User Name</label>
        <p id="user_name" class="form-control-plaintext">{{ $user->name }}</p>
    </div>
    <div class="form-group mb-2">
        <label for="user_email">User Email</label>
        <p id="user_email" class="form-control-plaintext">{{ $user->email }}</p>
    </div>

    @auth
        @if ($user->role != 7)
            <div class="form-group mb-2">
                <label for="user_role">User Role</label>
                <p id="user_role" class="form-control-plaintext">
                    {{ $user->role == 3 ? 'Staff' : ($user->role == 9 ? 'Administrator' : 'Unknown') }}
                </p>
            </div>
        @endif

        @if ($user->role != 7)
            <div class="form-group mb-2">
                <label for="user_branch">User Branch</label>
                <p id="user_branch" class="form-control-plaintext">
                    {{ $user->branch ? $user->branch->branch_name . ' - ' . $user->branch->branch_location : 'Not Assigned' }}
                </p>
            </div>
        @endif
    @endauth

    <a href="{{ route('user.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Return to Users
    </a>
</div>
@endsection
