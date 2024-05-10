@extends('layout')

@section('content')
    <div class="container">
        <div class="row d-flex col-md-offset-3">
            <div class="col-md-6">
                <h2 class="mt-5">Profile</h2>
                <form id="registrationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" value="{{ $user?->username }}"
                            name="username">
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" value="{{ $user?->name }}"
                            name="name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" value="{{ $user?->address }}"
                            name="address">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="text" class="form-control" id="contact" value="{{ $user?->contact }}"
                            name="contact">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" value="{{ $user?->email }}"
                            name="email">
                    </div>

                    {{-- <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" value="{{$user?->password}}" name="password">
                    </div> --}}

                    <div class="form-group">
                        <label for="profile_picture">Profile Picture:</label>
                        <br />
                        <img id="profile" src="{{ $user?->profile_picture }}"
                            style="border-radius: 50%;width: 20%;height: auto;" />
                        <input type="hidden" class="form-control-file" id="profile_picture_old"
                            value="{{ $user?->profile_picture }}" name="profile_picture_old">
                        <button type="button" class="btn btn-danger remove-profile-image">Remove</button>
                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" value="{{ $user?->dob }}"
                            name="dob">
                    </div>

                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $("#registrationForm").validate({
                rules: {
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    contact: {
                        required: true,
                        digits: true, // Assuming contact is a numeric value
                        minlength: 10, // Adjust as needed
                        maxlength: 15 // Adjust as needed
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    username: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    profile_picture: {
                        required: false,
                    },
                    dob: {
                        required: true,
                        date: true // Assuming dob is a date
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name"
                    },
                    address: {
                        required: "Please enter your address"
                    },
                    contact: {
                        required: "Please enter your contact number",
                        digits: "Please enter only digits",
                        minlength: "Contact number must be at least 10 digits",
                        maxlength: "Contact number cannot exceed 15 digits"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    username: {
                        required: "Please enter your username"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    profile_picture: {
                        required: "Please provide a profile picture",
                    },
                    dob: {
                        required: "Please enter your date of birth",
                        date: "Please enter a valid date"
                    }
                }
            });

            $("#registrationForm").submit(function(event) {
                event.preventDefault();

                if ($(this).valid()) {
                    // Create a FormData object
                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        type: "POST",
                        url: "updateProfile/" + "{!! $user->id !!}", // Specify your PHP file here to handle registration
                        data: formData,
                        processData: false, // Don't process the files
                        contentType: false, // Set content type to false as FormData will handle it
                        success: function(response) {
                            if (response.status) {
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error(xhr.responseJSON.message);
                        }
                    });
                }
            });

            $('.remove-profile-image').on('click', function() {
                $('#profile_picture_old').val('');
                $('#profile').attr('src', '');
            })

            $('#profile_picture').on('change', function(e) {
                file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#profile")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
