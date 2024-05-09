@extends('layout')

@section('content')
    <div class="container">
        <div class="row d-flex col-md-offset-3">
            <div class="col-md-6">
                <h2 class="mt-5">Login</h2>
                <form id="loginForm">
                    <div class="form-group">
                        @csrf
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long"
                    }
                }
            });

            $("#loginForm").submit(function(event) {
                if ($(this).valid()) {
                    var formData = $(this).serialize(); // Serialize form data
                    $.ajax({
                        type: "POST",
                        url: "login",
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "/";
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error(xhr.responseJSON.message);
                        }
                    });
                } else {
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
