@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b>Role: 
                    @if(Auth::user()->role == 9)
                        {{ __('Administrator') }}
                    @elseif(Auth::user()->role == 3)
                        {{ __('Staff') }}
                    @elseif(Auth::user()->role == 7)
                        {{ __('Customer') }}
                    @endif </b></br>

                    Welcome, <b>{{ Auth::user()->name }}</b><br>

                    {{ __('You are logged in !') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
