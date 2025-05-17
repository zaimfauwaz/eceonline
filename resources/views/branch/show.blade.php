@extends('layouts.forms')

@section('form_title', 'Branch Details')
@section('form_description', 'View the details of the branch below.')
@section('form_icon', 'fas fa-eye')
@section('form_icon_color', 'white')
@section('content')
<div class="card-body">
    <div class="form-group mb-2">
        <label for="branch_name">Branch Name</label>
        <p id="branch_name" class="form-control-plaintext">{{ $branch->branch_name }}</p>
    </div>
    <div class="form-group mb-2">
        <label for="branch_location">Branch Location</label>
        <p id="branch_location" class="form-control-plaintext">{{ $branch->branch_location }}</p>
    </div>
    <a href="{{ route('branch.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Return to Branches
    </a>
</div>
@endsection
