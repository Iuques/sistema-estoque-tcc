<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fontes do google -->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <!-- Ícones do Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        <div class="sidebar close">
            <div class="logo-details">
                <img src="{{ URL::asset("img/logo-emstock.png") }}" alt="Logo EMStock">
                <span class="logo_name">Navegação</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="/">
                        <i class='bx bx-grid-alt' ></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="/">Dashboard</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                    <a href="/products">
                        <i class='bx bxs-package'></i>
                        <span class="link_name">Produtos</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="/products">Produtos</a></li>
                        <li><a href="/products/departaments">Departamentos</a></li>
                        <li><a href="/products/suppliers">Fornecedores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/sales">
                        <i class='bx bx-money-withdraw'></i>
                        <span class="link_name">Vendas</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="/sales">Vendas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/users">
                        <i class='bx bxs-user-detail' ></i>
                        <span class="link_name">Usuários</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="/users">Usuários</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/clients">
                        <i class='bx bxs-user-badge' ></i>
                        <span class="link_name">Clientes</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="/clients">Clientes</a></li>
                    </ul>
                </li>
                <div class="profile-details">
                    <div class="profile-content">
                        <a class="nav-link" href="/users/profile/{{Auth::id()}}">
                            <img src="{{ URL::asset("img/profile.png")}}" alt="profileImg">
                        </a>
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                            <a class="nav-link" href="/users/profile/{{Auth::id()}}">
                                {{Auth::User()->name}} {{Auth::User()->surname}}
                            </a>
                        </div>
                        <div class="job">
                            @if (Auth::User()->type == 1)
                                Admnistrador
                            @else
                                Funcionário
                            @endif
                        </div>
                    </div>
                    <div class="log-out">
                        <a href="/dashboard/logout">
                            <i class='bx bx-log-out'></i>
                        </a>
                    </div>
                </div>
            </ul>
        </div>
        <section class="home-section">
            <div class="home-content">
                <div class="col">
                    <i class='bx bx-menu' ></i>
                </div>
                <div class="col-10">
                    @if ($errors->all())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger text-center" role="alert" style="font-size: 20px">
                                <b>{{$error}}</b>
                            </div>
                        @endforeach
                    @endif
                    @if (session('msg'))
                        <div class="alert alert-success text-center" role="alert" style="font-size: 20px">
                            <b>{{session('msg')}}</b>
                        </div>
                     @endif
                </div>
                <div class="col text-end" >
                    
                </div>
            </div>
            <div class="container-fluid mt-3">
                @yield('content')
            </div>
        </section>
        <script>
            let arrow = document.querySelectorAll(".arrow");
            for (var i = 0; i < arrow.length; i++) {
                arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
                });
            }
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".bx-menu");
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", ()=>{
                sidebar.classList.toggle("close");
            });
        </script>
    </body>
</html>