<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="">SDS Job Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                {{-- <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> --}}
                {{-- <li class="nav-item cta cta-colored mr-md-2"><a href="{{ route('want-a-job') }}" class="nav-link">Want a Job</a></li>
                <li class="nav-item cta mr-md-2"><a href="{{ route('job.create') }}" class="nav-link">Post a Job</a></li> --}}
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->account_type == 'employer')
                            <li class="nav-item"><a href="{{ url('/employer/dashboard') }}" class="nav-link">Go to Dashboard</a></li>
                        @elseif(auth()->user()->account_type == 'jobseeker')
                            <li class="nav-item"><a href="{{ url('/jobseeker/dashboard') }}" class="nav-link">
                            <span style="font-style: italic;font-weight: bold;padding-right: 10px">Welcome {{ Auth::user()->name }}</span>
                            <span class="badge bg-primary" style="padding: 10px;"> Go to Dashboard</span></a></li>
                        @elseif(auth()->user()->account_type == 'admin')
                            <li class="nav-item"><a href="{{ url('/admin/dashboard') }}" class="nav-link">Admin Dashboard</a></li>
                        @endif
                    @else
                        <li class="nav-item cta cta-colored mr-md-2"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item cta mr-md-2"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endif
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>