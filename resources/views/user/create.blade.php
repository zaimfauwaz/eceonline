@extends('layouts.forms')

@section('form_title', 'Create User')
@section('form_description', 'Fill in the details below to create a new user.')
@section('form_icon', 'fas fa-user-plus')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('user.store') }}" method="POST">
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
        <div class="form-group mb-2">
            <label for="user_name">User Name</label>
            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name') }}" required>
            @error('user_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="user_email">User Email</label>
            <input type="email" name="user_email" id="user_email" class="form-control" value="{{ old('user_email') }}" required>
            @error('user_email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="user_role">User Role</label>
            <select name="user_role" id="user_role" class="form-control" required>
                <option value="" disabled selected>Select Role</option>
                <option value="3">Staff</option>
                <option value="9">Administrator</option>
            </select>
            @error('user_role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="branch_id">User Branch</label>
            <select name="branch_id" id="branch_id" class="form-control" required>
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->branch_id }}">
                        {{ $branch->branch_name }} - {{ $branch->branch_location }}
                    </option>
                @endforeach
            </select>
            @error('branch_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="user_password">User Password</label>
            <input type="password" name="user_password" id="user_password" class="form-control" required>
            @error('user_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="user_password_confirmation">Confirm Password</label>
            <input type="password" name="user_password_confirmation" id="user_password_confirmation" class="form-control" required>
            @error('user_password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Users
        </a>
    </form>
</div>
@endsection
