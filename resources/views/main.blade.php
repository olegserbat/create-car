@extends('layouts.base')

@section('content')
    <div class="container-fluid px-0">
        <!-- Главный баннер -->
        <div class="bg-dark text-white text-center py-5 mb-4" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;">
            <h1 class="display-4 fw-bold">Выберите свою мечту</h1>
            <p class="lead">Широкий выбор автомобилей — от эконом до премиум класса</p>
            <a href="{{ route('cars.index') }}" class="btn btn-lg btn-outline-light mt-3">Просмотреть каталог</a>
        </div>

        <!-- Преимущества -->
        <div class="container my-5">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-tags fa-3x text-primary mb-3"></i>
                        <h3>Лучшие цены</h3>
                        <p>Гарантируем конкурентные цены и прозрачные условия.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                        <h3>Надёжность</h3>
                        <p>Только проверенные модели с полной историей обслуживания.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-headset fa-3x text-info mb-3"></i>
                        <h3>Поддержка 24/7</h3>
                        <p>Наши менеджеры всегда готовы помочь с выбором.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Призыв к действию -->
        <div class="bg-light py-5 text-center">
            <div class="container">
                <h2 class="mb-3">Готовы начать?</h2>
                <p class="lead text-muted mb-4">Закажите идеальный автомобиль уже сегодня</p>
                <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg px-4">Заказ машин</a>        </div>

            <!-- Призыв к действию -->
            <div class="bg-light py-5 text-center">
                <div class="container">
                    <p class="lead text-muted mb-4">Или найдите его на нашем складе</p>
                    <a href="{{ route('car-stock.index') }}" class="btn btn-primary btn-lg px-4">Выбор машины из наличия</a>        </div>


                <!-- Подвал -->
        <footer class="bg-dark text-white text-center py-4 mt-5">
            <div class="container">
                <p class="mb-0">&copy; {{ date('Y') }}  OlegTeamCarSelect — Ваш надёжный помощник в выборе автомобиля.</p>
                <small>Сделано с ❤️ для автолюбителей</small>
            </div>
        </footer>
    </div>
@endsection
