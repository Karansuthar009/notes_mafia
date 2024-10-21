<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (optional, if needed) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: rgb(99, 39, 120);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8;
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none;
        }

        .profile-button:hover {
            background: #682773;
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none;
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none;
        }

        .back:hover {
            color: #682773;
            cursor: pointer;
        }

        .labels {
            font-size: 11px;
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #BA68C8;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #682773;
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5 position-relative">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if ($users->photo)
                        <img class="rounded-circle mt-2" height="160px" width="160px" src="{{ asset('storage/' . $users->photo) }}"
                            alt="Profile Picture">
                    @else
                        <img class="rounded-circle mt-3" width="150px"
                        src="{{asset('image/user.png')}}" alt="Default Profile Picture">
                    @endif

                    <span class="font-weight-bold mt-2">{{ $users->name }}</span>
                    <span class="text-black-50">{{ $users->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <form action="{{ url('updateprofile/' . $users->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">User Profile</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" placeholder="name" value="{{ $users->name }}" name="name">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Username</label>
                                <input type="text" class="form-control" placeholder="username" value="{{ $users->username }}" name="username">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="labels">Email ID</label>
                            <input type="email" class="form-control" placeholder="enter email id" value="{{ $users->email }}" name="email">
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="enter phone number" name="mobile_num" value="{{ $users->mobile_num }}">
                            </div>

                            <div class="col-md-12">
                                <label class="labels">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="0" {{ (old('gender', $users->gender) == '0') ? 'selected' : '' }}>Male</option>
                                    <option value="1" {{ (old('gender', $users->gender) == '1') ? 'selected' : '' }}>Female</option>
                                    <option value="2" {{ (old('gender', $users->gender) == '2') ? 'selected' : '' }}>Other</option>
                                </select>
                            
                                <div class="col-md-12">
                                    <label class="labels">Profession</label>
                                    <input type="text" class="form-control" placeholder="profession" name="profession" value="{{ old('profession', $users->profession) }}">
                                </div>
                            
                                <div class="col-md-12">
                                    <label class="labels">Profile Photo </label>
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>
                            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">State</label>
                                    <select name="state_id" id="state" class="form-control">
                                        <option>Select State</option>
                                        @foreach ($state as $states)
                                            <option value="{{ $states->id }}" {{ (old('state_id', $users->state_id) == $states->id) ? 'selected' : '' }}>{{ $states->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">City</label>
                                    <select name="city_id" id="city" class="form-control">
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ (old('city_id', $users->city_id) == $city->id) ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                        <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#state').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId, // Your route to fetch cities
                        type: 'GET',
                        success: function(response) {
                            $('#city').empty();
                            $('#city').append('<option value="">Select City</option>');
                            $.each(response.cities, function(index, city) {
                                $('#city').append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                }
            });
        });
    </script>
</body>

</html>
