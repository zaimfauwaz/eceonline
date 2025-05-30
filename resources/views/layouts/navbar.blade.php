<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i><b>{{ config('app.name', 'Laravel') }}</b></h2>
    </a>

    <div>
        @auth
            @if (Auth::user()->branch_id)
                <span class="nav-link">{{ Auth::user()->branch->branch_name ?? 'No Branch Assigned' }}</span>
            @endif
        @endauth
    </div>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" style="margin-right: 1rem;">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        @guest
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('car.index') }}" class="nav-item nav-link @if (Request::is('car')) active @endif">Browse Car</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{ route('login') }}" class="dropdown-item @if (Request::is('login')) active @endif">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="dropdown-item @if (Request::is('register')) active @endif">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
        @else        <div class="navbar-nav ms-auto p-4 p-lg-0">
            
            @if(Auth::user()->role != 9)
            <a href="{{ route('car.index') }}" class="nav-item nav-link  @if (Request::is('car')) active @endif">Browse Car</a>
            @endif
            
            {{-- Admin Role --}}
            @auth
                {{-- Admin Role --}}
                @if (Auth::user()->role == 9)
                    <a href="{{ route('branch.index') }}" class="nav-item nav-link @if (Request::is('booking')) active @endif">Branch Manager</a>
                    <a href="{{ route('car.index') }}" class="nav-item nav-link @if (Request::is('car')) active @endif">Car Manager</a>
                    <a href="{{ route('user.index') }}" class="nav-item nav-link @if (Request::is('user')) active @endif">User Manager</a>
                @endif

                {{-- Staff Role --}}
                @if (Auth::user()->role == 3)
                    <a href="{{ route('booking.index') }}" class="nav-item nav-link @if (Request::is('booking')) active @endif">Booking Manager</a>
                @endif

                {{-- Customer Role --}}
                @if (Auth::user()->role == 7)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Booking</a>
                    <div class="dropdown-menu fade-up m-0">    
                        <a href="{{ route('booking.create') }}" class="nav-item nav-link @if (Request::is('booking')) active @endif">Book Now</a>
                        <a href="{{ route('booking.index') }}" class="nav-item nav-link @if (Request::is('booking')) active @endif">Booking History</a>
                    </div>
                </div>
                @endif
        

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                

            @endauth
        </div>
        
        @endguest
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fix for navbar collapse toggle
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('#navbarCollapse');

            navbarToggler.addEventListener('click', function () {
                if (navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                } else {
                    navbarCollapse.classList.add('show');
                }
            });

            // Close the navbar when clicking outside
            document.addEventListener('click', function (e) {
                if (!navbarCollapse.contains(e.target) && !navbarToggler.contains(e.target)) {
                    navbarCollapse.classList.remove('show');
                }
            });
        });
    </script>



</nav>