<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>@yield('title', 'Home')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('albums.index')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('albums.index')}}">Albums</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('albums.create')}}">New Album</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('photos.create')}}">New Image</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            @guest
                <li>
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>
            @endguest
            @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle  nav-link" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>

                            <form id="logout-form" action="{{ route('logout')}}" method="POST" >
                                {{ csrf_field() }}
                                <button class="btn btn-default">Logout</button>
                            </form>
                        </li>

                    </ul>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<main role="main" class="container">
    @yield('content')
    {{$slot ?? ''}}
</main><!-- /.container -->
@section('footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@show
</body>
</html>
