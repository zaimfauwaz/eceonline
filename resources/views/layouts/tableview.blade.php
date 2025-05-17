@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">Booking List</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                @yield('create-button')
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        @yield('table-header')
                    </thead>
                    <tbody>
                        <!-- Example rows -->
                        @yield('table-body')
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                <div class="mt-3">
                    @yield('pagination')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection