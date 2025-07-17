<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Auth System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">MyApp</a>

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link">Logout</button>
            </form>
            @endauth
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>