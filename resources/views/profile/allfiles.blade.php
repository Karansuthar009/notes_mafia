@extends('profile.profile')

@section('content')

    @if ($allfiles->count() == 0)
        <div class="row g-4 justify-content-center">
            <div class="col-lg-2 col-md-3 wow " data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <img src="{{ asset('image/chala_ja.jpeg') }}" class="img-fluid" style="border-radius:1px;">
                </div>
            </div>
            <p class="text-primary text-center">NOT ANY FILES AVAILABLE</p>
        </div>
    @else
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach ($files as $file)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light">
                            <div class="overflow-hidden uniform-size-container">
                                @if (pathinfo($file->file_path, PATHINFO_EXTENSION) == 'pdf')
                                    <!-- For PDFs -->
                                    <a href="{{ url('view/' . $file->id) }}" target="_blank">
                                        <iframe src="{{ asset('storage/' . $file->file_path) }}"
                                            class="img-fluid uniform-size" style="border:none;"></iframe>
                                    </a>
                                @else
                                    <!-- For images -->
                                    <a href="{{ url('view/' . $file->id) }}">
                                        <img class="img-fluid uniform-size"
                                            src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->title }}">
                                    </a>
                                @endif
                            </div>
    
                            <div class="text-center p-4">
                                <h3 class="mb-4">{{ $file->title }}</h3>
                                <p>{{ $file->description }}</p>
                            </div>
    
                            @if (Auth::user() && Auth::user()->id == $users->id)
                                <div class="text-center p-4">
                                    <a href="{{ url('edit/uploadfile/' . $file->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('delete/uploadfile/' . $file->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            @endif
    
                            <div class="d-flex border-top">
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

@endsection
