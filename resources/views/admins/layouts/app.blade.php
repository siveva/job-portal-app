<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Surigao del Sur - Job Portal</title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
        <link href="{{ asset('startboostrap/css/styles.css') }}" rel="stylesheet" />
        @stack('pages-css')

        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- SweetAlert CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>

   

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">SDS Job Portal</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                {{-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> --}}
            </form>
            <!-- Navbar-->
            
        @guest
            @if (Route::has('login'))
            <li class="nav-item active"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endif
        @else
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- <li><a class="dropdown-item" href="#!">Profile</a></li> --}}
                        <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li> <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @endguest

        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Job Posts
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                                Employers
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Job Seekers
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Categories
                            </a>                                                   
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }} ({{ Auth::user()->account_type }})
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')    
                    </div>  
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 10uSolutions 2023</div>
                            {{-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> --}}
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-overview" type="button" role="tab" aria-controls="profile-overview" aria-selected="true">Profile Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#profile-change-password" type="button" role="tab" aria-controls="profile-change-password" aria-selected="false">Change Password</button>
                    </li>
                </ul>

                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade show active" id="profile-overview" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="editProfileForm" method="POST" action="{{ route('user.admin.update', Auth::user()) }}">
                            @csrf
                            @method('PUT')

                            <!-- Your form fields for profile overview -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="account_type" class="form-label">Account Type</label>
                                <input type="text" class="form-control" id="account_type" name="account_type" value="{{ Auth::user()->account_type }}" readonly>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel" aria-labelledby="password-tab">
                        <!-- Change Password Form -->
                        <form id="changePasswordForm" method="POST" action="{{ route('user.employer.changePassword', Auth::user()) }}">
                            @csrf
                            @method('PUT')

                            <!-- Your form fields for changing password -->
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="current_password" type="password" class="form-control" id="currentPassword">
                                    @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password" type="password" class="form-control" id="newPassword">
                                    @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('startboostrap/js/scripts.js') }}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
        {{-- <script src="{{ asset('startboostrap/assets/demo/chart-area-demo.js') }}"></script> --}}
        {{-- <script src="{{ asset('startboostrap/assets/demo/chart-bar-demo.js') }}"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> --}}
        {{-- <script src="js/datatables-simple-demo.js"></script> --}}
        

        <script>
            // Listen for form submission
            $('#editProfileForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting

                // Make an AJAX request to update the profile
                $.ajax({
                    url: $(this).attr('action'), // URL from the form's action attribute
                    method: 'PUT',
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        // Close the modal
                        $('#profileModal').modal('hide');

                            // Show SweetAlert success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Profile Updated',
                                text: 'Your profile has been updated successfully.',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            
                            // console.log('SweetAlert triggered');

                        },
                        error: function(xhr, status, error) {
                            // Show error message if the AJAX request fails
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred. Please try again later.'
                            });
                    }
                });
            });

        </script>
        
        

        
        @stack('pages-script')

    </body>
</html>
