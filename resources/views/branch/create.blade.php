@extends('layouts.forms')

@section('form_title', 'Create Branch')
@section('form_description', 'Fill in the details below to create a new branch.')
@section('form_icon', 'fas fa-plus-circle')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <form action="{{ route('branch.store') }}" method="POST">
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
            <label for="branch_name">Branch Name</label>
            <input type="text" name="branch_name" id="branch_name" class="form-control" value="{{ old('branch_name') }}" required>
            @error('branch_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="branch_location">Branch Location</label>
            <input type="text" name="branch_location" id="branch_location" class="form-control" value="{{ old('branch_location') }}" required>
            @error('branch_location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Branch</button>
        <a href="{{ route('branch.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Return to Branches
        </a>
    </form>
</div>
@endsection
