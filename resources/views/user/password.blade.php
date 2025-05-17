@extends('layouts.forms')

@section('form_title', 'Edit User')
@section('form_description', 'Update the details below to edit the user.')
@section('form_icon', 'fas fa-edit')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('password.update', $user->user_id) }}" method="POST">
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
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Password</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Users
        </a>
    </form>
</div>
@endsection
