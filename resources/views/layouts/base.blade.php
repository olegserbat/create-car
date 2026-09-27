
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Выбор машины</title>
    @vite(['resources/css/bootstrap.css', 'resources/js/vendor-bootstrap.js'])
    @livewireStyles
    <style>
        body {
            background: linear-gradient(135deg, #1f2933 0%, #3b4a54 100%);
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: #333; /* Тёмный текст для светлого фона */
        }
        .content-overlay {
            background-color: rgba(255, 255, 255, 0.7); /* Светлый полупрозрачный слой */
            min-height: 100vh;
            padding: 20px 0;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #000 !important;
        }
        .btn-outline-light {
            border-color: rgba(0, 0, 0, 0.3);
            color: #000;
        }
        .btn-outline-light:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="content-overlay">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">На главную страницу</a>
            <a class="navbar-brand" href="/cars">Выбор машины под заказ</a>
            <a class="navbar-brand" href="/car-stocks">Автомобили на складе</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Левая часть: ссылки (если авторизован) -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/brends">Бренды</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/colors">Цвета</a>
                        </li>
                    </ul>
                @endif
            </div>

            <!-- Правая часть: кнопки регистрации, входа, профиля -->
            <div class="d-flex">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <form action="/profile" method="GET" class="d-inline-block me-2">
                        <button class="btn btn-outline-dark" type="submit">{{ \Illuminate\Support\Facades\Auth::user()->name }}</button>
                    </form>
                    <form action="/logout" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-outline-dark" type="submit">Выйти</button>
                    </form>
                @else
                    <form action="/register" method="GET" class="d-inline-block me-2">
                        <button class="btn btn-outline-dark" type="submit">Регистрация</button>
                    </form>
                    <form action="/login" method="GET" class="d-inline-block">
                        <button class="btn btn-outline-dark" type="submit">Войти</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</div>

@livewireScripts
</body>
</html>
