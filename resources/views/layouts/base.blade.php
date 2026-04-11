{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Bootstrap demo</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">--}}
{{--</head>--}}
{{--<body>--}}
{{--<nav class="navbar navbar-expand-lg   bg-primary" data-bs-theme="dark">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="#">Выбор машины</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            @if(\Illuminate\Support\Facades\Auth::user())--}}
{{--                <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" aria-current="page" href="/brends">Бренды</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="/colors">Цвета</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" aria-disabled="true">В разработке</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            @endif--}}
{{--            @if(\Illuminate\Support\Facades\Auth::user())--}}
{{--                <form class=navbar-toggler" action="/profile">--}}
{{--                    <button class="btn btn-outline-success" style="color: red" type="submit">{{\Illuminate\Support\Facades\Auth::user()->name}}</button>--}}
{{--                </form>--}}
{{--                <form class=navbar-toggler"  action="/logout">--}}
{{--                    <button class="btn btn-outline-success" style="color: red" type="submit">Выйти из профиля</button>--}}
{{--                </form>--}}
{{--            @else--}}
{{--            <form class=navbar-toggler"  action="/register">--}}
{{--                <button class="btn btn-outline-success" style="color: red" type="submit">Регистрация</button>--}}
{{--            </form>--}}
{{--                <form class=navbar-toggler"  action="/login">--}}
{{--                    <button class="btn btn-outline-success" style="color: red" type="submit">Войти в профиль</button>--}}
{{--                </form>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>--}}
{{--@yield('content')--}}
{{--</body>--}}
{{--</html>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Выбор машины</a>
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
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">В разработке</a>
                    </li>
                </ul>
            @endif
        </div>

        <!-- Правая часть: кнопки регистрации, входа, профиля -->
        <div class="d-flex">
            @if(\Illuminate\Support\Facades\Auth::user())
                <form action="/profile" method="GET" class="d-inline-block me-2">
                    <button class="btn btn-outline-light" type="submit">{{ \Illuminate\Support\Facades\Auth::user()->name }}</button>
                </form>
                <form action="/logout" method="POST" class="d-inline-block">
                    @csrf
                    <button class="btn btn-outline-light" type="submit">Выйти</button>
                </form>
            @else
                <form action="/register" method="GET" class="d-inline-block me-2">
                    <button class="btn btn-outline-light" type="submit">Регистрация</button>
                </form>
                <form action="/login" method="GET" class="d-inline-block">
                    <button class="btn btn-outline-light" type="submit">Войти</button>
                </form>
            @endif
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@yield('content')
</body>
</html>
