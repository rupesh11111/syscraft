@extends('layout')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">User Profile</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <p class="form-control-static"> {{ $user?->username }} </p>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <p class="form-control-static"> {{ $user?->name }} </p>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <p class="form-control-static">{{ $user?->email }}</p>
                </div>
                <div class="form-group">
                    <label for="location">Address:</label>
                    <p class="form-control-static">{{ $user?->address }}</p>
                </div>

                <div class="form-group">
                    <label for="location">Date Of Birth:</label>
                    <p class="form-control-static">{{ $user?->dob }}</p>
                </div>

                <div class="form-group">
                    <label for="location">Role:</label>
                    <p class="form-control-static btn btn-primary">{{ $user?->role?->name }}</p>
                </div>

                <div class="text-center">
                    <a href="{{ route('editProfile') }}" class="btn btn-primary">Edit Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
