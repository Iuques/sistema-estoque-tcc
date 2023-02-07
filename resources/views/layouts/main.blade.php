<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fontes do google -->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <!-- CSS do Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- JS do Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- CSS interno -->
        <link rel="stylesheet" href="{{ URL::asset("css/style.css") }}">
        <!-- JS interno -->
        <script src="{{ URL::asset("/js/script.js") }}"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-secondary">
                <div class="container-fluid" id="navbar">
                    <a class="navbar-brand" href="/">
                        <img src="{{ URL::asset("img/logo-emstock.png") }}" alt="Logo EMStock">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users">Usuários</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/clients">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/sales">Vendas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users/profile/{{Auth::id()}}">Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="/dashboard/logout">Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            <div class="row">
                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{session('msg')}}
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
        <footer>
            <p> IFRN &copy; 2022 </p>
        </footer>
    </body>
</html>