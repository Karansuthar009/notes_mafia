<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Notes Mafia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
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
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* General styles for the navbar */
        .navbar-nav {
            align-items: center;
        }

        /* Styles for individual nav items */
        .nav-item {
            margin: 0 10px;
            /* Adjust spacing between nav items */
        }

        /* Styles for active nav link */
        .nav-link.active {
            font-weight: bold;
            /* Highlight the active link */
        }

        /* Styles for profile dropdown */
        .nav-item.dropdown {
            position: relative;
            /* Ensure dropdown positioning is relative */
        }

        /* Dropdown toggle (profile picture) */


        /* Profile picture styling */
        .nav-link.dropdown-toggle img {
            border-radius: 50%;
            /* Make the profile picture round */
            height: 40px;
            /* Fixed height */
            width: 40px;
            /* Fixed width */
            object-fit: cover;
            /* Ensure image covers the container */
            margin-left: 10px;
            /* Space between profile picture and text */
        }

        /* Dropdown menu alignment */
        .dropdown-menu {
            right: 0;
            /* Align dropdown menu to the right */
            left: auto;
            /* Override default left alignment */
            top: 100%;
            /* Position below the toggle */
            transform: translateY(0);
            /* Adjust dropdown position */
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Show only 3 items per row */
            gap: 1.5rem;
            /* Space between grid items */
        }

        .course-item {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .text-danger {
            color: red;
        }

        .uniform-size {
            width: 100%;
            /* Ensures the width adapts to the container */
            height: 250px;
            /* Set the height to be uniform for all items */
            object-fit: cover;
            /* Ensures the content fits within the defined height and width */
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
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="#contectSection" class="nav-item nav-link">Contact</a>
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
                            <li><a class="dropdown-item" href="{{ url('logout/' . Auth::user()->id) }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('registerlogin') }}" class="nav-item nav-link active">Sign In</a>
                @endif
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    @php
        $allpdf = $data->where('category', 'Pdf');
    @endphp

    @if ($allpdf->isEmpty())
        <div class="row g-4 justify-content-center">
            <div class="col-lg-2 col-md-3 wow" data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <img src="{{ asset('image/chala_ja.jpeg') }}" class="img-fluid mt-4" style="border-radius:1px;">
                </div>
            </div>
            <p class="text-primary text-center">PDF ARE NOT AVAILABLE</p>
        </div>
    @else
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">PDF</h6>
                    <h1 class="mb-5">All PDF</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($allpdf as $file)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item bg-light">
                                <div class="overflow-hidden">
                                    @if (pathinfo($file->file_path, PATHINFO_EXTENSION) == 'pdf')
                                        <!-- For PDFs -->
                                        <a href="{{ url('view/' . $file->id) }}" target="_blank">
                                            <iframe src="{{ asset('storage/' . $file->file_path) }}"
                                                class="img-fluid uniform-size"></iframe>
                                        </a>
                                    @else
                                        <!-- For images -->
                                        <a href="{{ url('view/' . $file->id) }}">
                                            <img class="img-fluid uniform-size"
                                                src="{{ asset('storage/' . $file->file_path) }}"
                                                alt="{{ $file->title }}">
                                        </a>
                                    @endif
                                </div>

                                <div class="text-center p-4">
                                    <h3 class="mb-4">{{ $file->title }}</h3>
                                    <p>{{ $file->description }}</p>
                                </div>

                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-user-tie text-primary me-2"></i>
                                        <a href="{{ url('profile/' . $file->username) }}">{{ $file->username }}</a>
                                    </small>
                                    <small class="flex-fill text-center border-end py-2">
                                        <a class="view-count" data-id="{{ $file->id }}">
                                            <i class="fa fa-eye text-primary me-2"></i>
                                            <span id="view-count-{{ $file->id }}">{{ $file->view }}</span>
                                        </a>
                                    </small>
                                    <small class="flex-fill text-center border-end py-2">
                                        <a class="like-dislike">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
