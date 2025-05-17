@extends('layouts.forms')

@section('form_title', 'Edit User')
@section('form_description', 'Update the details below to edit the user.')
@section('form_icon', 'fas fa-edit')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('user.update', $user->user_id) }}" method="POST">
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
            <label for="user_name">User Name</label>
            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name', $user->name) }}" required>
            @error('user_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="user_email">User Email</label>
            <input type="email" name="user_email" id="user_email" class="form-control" value="{{ old('user_email', $user->email) }}" required>
            @error('user_email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        @auth
            @if ($user->role != 7)
                <div class="form-group mb-2">
                    <label for="user_role">User Role</label>
                    <select name="user_role" id="user_role" class="form-control" required>
                        <option value="" disabled>Select Role</option>
                        <option value="3" {{ old('user_role', $user->role) == '3' ? 'selected' : '' }}>Staff</option>
                        <option value="9" {{ old('user_role', $user->role) == '9' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('user_role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <input type="hidden" name="user_role" value="{{ $user->role }}" required>
            @endif

            @if ($user->role != 7)
                <div class="form-group mb-2">
                    <label for="branch_id">User Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                        <option value="" disabled>Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->branch_id }}" {{ old('branch_id', $user->branch_id) == $branch->branch_id ? 'selected' : '' }}>
                                {{ $branch->branch_name }} - {{ $branch->branch_location }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        @endauth

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Users
        </a>
    </form>
</div>
@endsection
