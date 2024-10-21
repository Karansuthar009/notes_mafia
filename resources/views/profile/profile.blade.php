<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Notes Mafia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('profile/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('profile/css/style.css') }}" rel="stylesheet">
<style>
.uniform-size-container {
    width: 100%;
    height: 300px; /* Set the height for uniform sizing */
    overflow: hidden; /* Ensure the content stays within the boundary */
    position: relative;
}

.uniform-size {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures images cover the full area while maintaining aspect ratio */
}

iframe.uniform-size {
    display: block;
    width: 100%;
    height: 100%;
}

.team-item {
    margin-bottom: 20px;
    background-color: #f8f9fa;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}


</style>
</head>

<body>


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Notes<span style="color: red">M</span>afia</h2>
        </a>
        <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                {{-- <a href="courses.html" class="nav-item nav-link">Courses</a> --}}
                <a href="#contentsection" class="nav-item nav-link">Contact</a>
                @if (Auth::user())
                    <a href="{{ url('upload/file/') }}"><i style="font-size: 30px"
                            class="nav-item fa-solid fa-cloud-arrow-up"></i></a>
                @else
                @endif
                <!-- Profile Dropdown -->
                @if (Auth::user())
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user() && Auth::user()->photo)
                                <img class="rounded-circle" height="50px" width="50px"
                                    src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Picture">
                            @else
                                <img class="rounded-circle" width="50px" height="50px"
                                    src="{{ asset('image/user.png') }}" alt="Default Profile Picture">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ url('profile/' . Auth::user()->username) }}">Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ url('logout/' . Auth::user()->id) }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('registerlogin') }}" class="nav-item nav-link active">Sign In</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="header__wrapper">
        <div class="cols__container mt-4">
            <div class="left__col">
                <div class="img__container">
                    @if ($users->photo)
                        <img class="rounded-circle mt-4" height="150px" width="150px"
                            src="{{ asset('storage/' .$users->photo) }}" alt="Profile Picture">
                    @else
                        <img class="rounded-circle mt-3" width="150px" src="{{ asset('image/user.png') }}"
                            alt="Default Profile Picture">
                    @endif
                    <span></span>
                </div>

                <h2>{{ $users->name ?? '' }}</h2>
                <p>{{ $users->email ?? '' }}</p>


                <ul class="about">
                    <li><span>{{ $allfiles->count() }}</span>All Files</li>
                    <li><span>{{ $notespaths->count() }}</span>Total Notes</li>
                    <li><span>{{ $userPdfPaths->count() }}</span>Total PDF</li>
                    <li><span>{{ $oldpaperPaths->count() }}</span>Total Papers</li>
                </ul>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam erat volutpat. Morbi imperdiet,
                        mauris ac auctor dictum, nisl ligula egestas nulla.</p>
                    <ul>
                        <li><i class="fab fa-twitter"></i></li>
                        <i class="fab fa-pinterest"></i>
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-dribbble"></i>
                    </ul>
                </div>
            </div>



            <div class="right__col">
                <nav>
                    <ul>
                        
                        <li><a href="{{ url('allfiles/' . $users->id) }}"
                                class="{{ Request::is('old-paper') ? 'active' : '' }}">All Files</a></li>
                        <li><a href="{{ url('allpdfs/' . $users->id) }}"
                                class="{{ Request::is('old-paper') ? 'active' : '' }}">PDF</a></li>
                        <li><a href="{{ url('oldpapers/' . $users->id) }}"
                                class="{{ Request::is('old-paper') ? 'active' : '' }}">Old Paper</a></li>
                        <li><a href="{{ url('noteses/' . $users->id) }}"
                                class="{{ Request::is('notes') ? 'active' : '' }}">Notes</a>
                        </li>
                        @if (Auth::user() && Auth::user()->id == $users->id)
                            <li><a href="{{ url('favorate/' . $users->id) }}">Favorite</a>
                            </li>
                        @endif
                    </ul>
                </nav>
                @yield('content')
            </div>
        </div>
    </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-8">
                        <h4 class="text-white mb-3">Quick Link</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">FAQs & Help</a>
                    </div>
                    <div id="contentsection" class="col-lg-3 col-md-8">
                        <h4 class="text-white mb-3">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Ellenabad, Sirsa, Haryana</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>notesmafia007@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-8">
                        <h4 class="text-white mb-3">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <a href="{{ route('registerlogin') }}"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">NotesMafia</a>, All Right Reserved.
    
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">Coding Mafia</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    
    


    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('profile/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('profile/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('profile/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('profile/lib/owlcarousel/owl.carousel.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('profile/js/main.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

<script>
           $(document).on('click', '.favorite-icon', function(e) {
            e.preventDefault();

            var fileId = $(this).data('id');
            var heartIcon = $('#heart-icon-' + fileId);
            if (heartIcon.hasClass('text-danger')) {
                heartIcon.removeClass('text-danger');
                $.ajax({
                    url: '/remove-favorite',
                    method: 'POST',
                    data: {
                        id: fileId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Favorite removed');
                    }
                });
            } else {
                heartIcon.addClass('text-danger');
                $.ajax({
                    url: '/add-favorite',
                    method: 'POST',
                    data: {
                        id: fileId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Favorite added');
                    }
                });
            }
        });
</script>