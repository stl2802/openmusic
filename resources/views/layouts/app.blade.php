<html>
    <head>
        <!-- Подключение Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
        <link href="styles/main.css" rel="stylesheet">

        <title>
            @yield('title')
        </title>
        <style>
            .container-fluid{
                color: white !important;
            }
            body{
                background-color: black;
            }
            .card{
                border: 0.1rem solid #ffffff;
            }
            .card-body{
                background-color: #000000 !important;
            }
        </style>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="{{ route('index') }}" class="navbar-brand">Главная</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключить навигацию">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="" class="nav-link">Задонатить</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Вход</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                 <a href="{{ route('home') }}" class="d-inline-block" style="width: 3rem; height: 3rem;">
                                     <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="фото профиля" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                 </a>
                            </li>
                            @if(Auth::check() && Auth::user()->isAdmin())
                                 <li class="nav-item">
                                      <a href="{{ route('admin.index') }}" class="nav-link">Админ панель</a>
                                 </li>
                            @endif
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link">Выход</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </head>
    <body>
        <div class="music_index">
                @yield('content')
        </div>
    </body>
    <script src="scripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
</html>
