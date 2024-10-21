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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Modal styling */
        .modal {
            position: absolute;
            left: 0;
            top: 40px;
            width: 300px;
            border-radius: 5px;
            */ padding: 15px;
            margin-left: 10px;
        }


        .close-btn {
            margin-left: 10px;
            float: right;
            font-size: 20px;
            font-weight: bold;
            /* cursor: pointer; */
        }

        /* Bell badge */
        #notification-count {
            position: absolute;
            top: -5px;
            right: -10px;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
            background-color: #dc3545;
            color: white;
        }

        #notification-message {
            margin-left: 10px;
        }
        <style>
        .uniform-size-large {
        height: 600px; /* Adjust the height to make the image/pdf larger */
        width: 100%;   /* Ensure it takes the full width of the container */
        object-fit: cover; /* Makes the content fit nicely inside the given dimensions */
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
            <div class="d-flex justify-content-center w-100">
                <div class="position-relative search-container">
                    <i class="fa fa-search position-absolute search-icon"></i>
                    <input type="search" id="search-input" class="form-control form-input ps-5"
                        placeholder="Search anything...">
                </div>
            </div>

            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link" id="bell-icon">
                    <i class="fa-regular fa-bell" style="position: relative;">
                        @if (Session::has('login_notification'))
                            <span class="badge bg-danger" id="notification-count">
                                {{ Session::has('login_notification') }}
                            </span>
                        @endif
                    </i>
                </a>

                <!-- Modal for Notification Message -->
                <div id="notification-modal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <p id="notification-message"> {{ Session::get('login_notification') }}</p>
                    </div>
                </div>


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
                            <li><a class="dropdown-item" href="{{ url('logout/' . Auth::user()->id) }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('registerlogin') }}" class="nav-item nav-link active">
                        <i class="fa-duotone fa-solid fa-right-to-bracket"></i>
                    </a>
                @endif
            </div>
        </div>
    </nav>



    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown">The Best Notes Platform</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                    stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                    eirmod elitr.</p>
                                <a href=""
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your
                                    Home</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                    stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                    eirmod elitr.</p>
                                <a href=""
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <div id="searchResults" class="row g-4 justify-content-center mt-4">

    </div>

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x bi bi-journal-bookmark-fill text-primary mb-4"></i>
                            <h5 class="mb-3">Notes</h5>
                            <a href="{{ route('notes') }}">Click Here To Access</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x bi bi-collection-fill text-primary mb-4"></i>
                            <h5 class="mb-3">Old Paper </h5>

                            <a href="{{ route('oldpaper') }}">Click Here To Access</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x bi bi-kanban-fill text-primary mb-4"></i>
                            <h5 class="mb-3">PDF</h5>
                            <a href="{{ route('allpdf') }}">Click Here To Access</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Projects & Assign. </h5>
                            <a href="/">Click Here To Access</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt=""
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to Notes<span style="color: red">M</span>afia</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam
                        et eos. Clita erat ipsum et lorem et sit.</p>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam
                        et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat
                        amet</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Quality Notes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Old Paper </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Projects &
                                Assignments </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Books & PDF</p>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                <h1 class="mb-5">Courses Categories</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/cat-1.jpg" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                    style="margin: 1px;">
                                    <h5 class="m-0">Web Design</h5>
                                    <small class="text-primary">49 Courses</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/cat-2.jpg" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                    style="margin: 1px;">
                                    <h5 class="m-0">Graphic Design</h5>
                                    <small class="text-primary">49 Courses</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/cat-3.jpg" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                    style="margin: 1px;">
                                    <h5 class="m-0">Video Editing</h5>
                                    <small class="text-primary">49 Courses</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/cat-4.jpg" alt=""
                            style="object-fit: cover;">
                        <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                            style="margin:  1px;">
                            <h5 class="m-0">Online Marketing</h5>
                            <small class="text-primary">49 Courses</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories Start -->


    <!-- course -->
    @if (count($topFiles) > 0)

        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Top Files</h6>
                    <h1 class="mb-5">Most Viewed Files</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($topFiles as $file)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
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

                                <div class="text-left p-2">
                                    <h3 class="mb-2 text-primary">{{ $file->title }}</h3>
                                    <h5 class="mb-2 text-danger">{{ $file->category }}</h5>
                                    <p>{{ $file->description }}</p>
                                </div>

                                <div class="text-left p-2">
                                    <p class="btn btn-success">{{ $file->year }}</p>
                                    <p class="btn btn-primary">{{ $file->semester }}</p>
                                    {{-- @foreach ($data as $datas)
                                        <p class="btn btn-danger">{{ $datas->subjects->subject_name }}</p>
                                    @endforeach --}}
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
                                        <a class="favorite-icon" data-id="{{ $file->id }}">
                                            <i class="fa fa-heart me-2" id="heart-icon-{{ $file->id }}"></i>
                                            <span id="favorite-icon-{{ $file->id }}"></span>
                                        </a>
                                    </small>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        {{-- <p>No top files available.</p> --}}
    @endif
    <!-- end course -->



    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">NotesMafia Team</h6>
                <h1 class="mb-5">About Us</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Sanjiv Suthar</h5>
                            <small>Project Manager</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Karan Suthar</h5>
                            <small>Laravel Developer</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Manmohan Suthar</h5>
                            <small>UI Ux & Frontend Developer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Users Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-1.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div id="contentsection" class="col-lg-3 col-md-6">
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
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
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


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
    <script>
        document.getElementById('bell-icon').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent link from navigating

            // Get the bell icon's position
            const bellIcon = event.target.getBoundingClientRect();
            const modal = document.getElementById('notification-modal');

            // Set the modal's position below the bell icon
            modal.style.left = `${bellIcon.left}px`;
            modal.style.top = `${bellIcon.bottom + window.scrollY}px`;

            // Show the modal
            modal.style.display = 'block';

            // Remove the notification count (badge)
            const notificationCount = document.getElementById('notification-count');
            if (notificationCount) {
                notificationCount.remove();
            }

            // Send an AJAX request to clear the notification from session
            fetch('/clear-notification', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    console.log('Notification cleared from session');
                }
            }).catch(error => {
                console.error('Error clearing notification:', error);
            });
        });

        // Handle close button in the modal
        document.querySelector('.close-btn').addEventListener('click', function() {
            const modal = document.getElementById('notification-modal');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('clear-notification') }}",

                success: function(response) {
                    if (response.success) {
                        alert('Notification cleared successfully');
                    } else {
                        alert('Failed to clear notification');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ', error);
                }
            });
            modal.style.display = 'none';
        });


        // View count update
        $(document).on('click', '.view-count', function(e) {
            e.preventDefault();

            var fileId = $(this).data('id');
            console.log(fileId); // To verify the correct file ID

            $.ajax({
                url: '/update-view/' + fileId,
                type: 'GET',
                success: function(response) {
                    location.reload();
                    $('#view-count-' + fileId).text(response.newViewCount);
                },
                error: function(xhr) {
                    console.error('Error occurred:', xhr.responseText);
                }
            });
        });


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

        $(document).ready(function() {
            $('#search-input').on('input', function() {
                let query = $(this).val();
                $.ajax({
                    url: '{{ route('search') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#searchResults').empty();

                        if (response.length > 0) {

                            response.forEach(function(file) {
                                console.log(file);
                                let resultItem = `
                               
                                <div class="col-lg-3 col-md-6">
                                    <div class="team-item bg-light">
                                        <div class="overflow-hidden">
                                            ${file.file_extension == 'pdf' ? `
                                                                                        <a href="/view/${file.id}" target="_blank">
                                                                                            <iframe src="storage/${file.file_path}" class="img-fluid uniform-size"></iframe>
                                                                                        </a>` : `
                                                                                        <a href="/view/${file.id}">
                                                                                            <img class="img-fluid uniform-size" src="storage/${file.file_path}" alt="${file.title}">
                                                                                        </a>`
                                            }
                                        </div>

                                        <div class="text-left p-2">
                                            <h3 class="mb-2 text-primary">${file.title}</h3>
                                            <h5 class="mb-2 text-danger">${file.category}</h5>
                                            <p>${file.description}</p>
                                        </div>

                                        <div class="text-left p-2">
                                            <p class="btn btn-success">${file.year}</p>
                                            <p class="btn btn-primary">${file.semester}</p>
                                        </div>

                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-user-tie text-primary me-2"></i>
                                                <a href="/profile/${file.username}">${file.username}</a>
                                            </small>
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-eye text-primary me-2"></i>${file.view}
                                            </small>
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-heart me-2"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            `;
                                $('#searchResults').append(resultItem);
                            });
                        } else {
                            alert('No results found');
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>
