<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hidran Arias">
    <meta name="generator" content="phpstorm">
    <title>@yield('title', 'Home')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/0352d48ad0.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="/css/lightbox.css" rel="stylesheet" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        table.albums td .btn {
            width: 100px;
            border: 0px solid red;
        }
        .editbuttons .btn {
           width: 120px;
        }
    </style>

      <script>
          window.Laravel =@json( ['csrf_token' => csrf_token(),'csrfToken' => csrf_token()] )
  </script>

</head>
<body class="pt-24">

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @auth
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                    </li>
                @endauth
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @guest
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>

                </ul>
            @endguest
            @auth
                <div class="dropdown ms-4">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                            <form id="logout-form" action="{{ route('logout')}}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-default">Logout</button>
                            </form>
                        </li>

                    </ul>
                </div>

            @endauth

        </div>
    </div>
</nav>

<main role="main" class="container-fluid">
    @yield('content')
    {{$slot ?? ''}}
</main><!-- /.container -->
@section('footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/lightbox.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
@show
</body>
</html>
