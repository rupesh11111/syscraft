<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Syscraft') }}</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            @if (in_array(Auth::user()->role->name, ['customer', 'vendor']))
                                <a href="{{ route('cart') }}" id="cartCount">
                                    Cart ({{ config('cart_count') }})
                                </a>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile') }}">{{ __('Profile') }} </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" id="content">
            @yield('content')
        </main>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function isValidHttpUrl(string) {
                let url;
                try {
                    url = new URL(string);
                } catch (_) {
                    return false;
                }
                return url.protocol === "http:" || url.protocol === "https:";
            }

            function mapColummns(cols) {
                return cols.map(function(value) {
                    if (['image','profile_picture'].includes(value.name)) {
                        value['render'] = function(data, type, full, meta) {
                            return `<img src="${data}" style="border-radius: 50%;width: 13%;"/>`;
                        }
                    }
                    return value;
                })
            }
        </script>
        @stack('script')
        @stack('style')
    </div>
</body>

</html>
