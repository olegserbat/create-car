@extends('layouts.base')

@section('title', 'Просмотр автомобиля #' . $car->id)

@section('content')
    <div class="container">
        <h1>Просмотр автомобиля #{{ $car->id }}</h1>

        <!-- Кнопка "Назад" -->
        <a href="{{ route('cars.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

        <!-- Сообщения об успехе/ошибках -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Карточка с данными автомобиля -->
        <div class="card mb-4">
            <div class="card-header">
                <strong>Информация об автомобиле</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 20%;">ID</th>
                        <td>{{ $car->id }}</td>
                    </tr>
                    <tr>
                        <th>Бренд</th>
                        <td>{{ $car->brend->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Цвет</th>
                        <td>{{ $car->color->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Цена</th>
                        <td>{{ number_format($car->total_price, 2) }} ₽</td>
                    </tr>
                    <tr>
                        <th>Комментарий</th>
                        <td>{{ $car->comment ?? 'Нет' }}</td>
                    </tr>
                    <tr>
                        <th>Владелец</th>
                        <td>{{ $car->owner->name }}</td>
                    </tr>
                    <tr>
                        <th>Дата создания</th>
                        <td>{{ $car->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Действия: редактировать / удалить -->
        @auth
        <div>
            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning me-2">Редактировать</a>

            <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Вы уверены, что хотите удалить этот автомобиль?')">
                    Удалить
                </button>
            </form>
        </div>
        @endauth
    </div>
@endsection
