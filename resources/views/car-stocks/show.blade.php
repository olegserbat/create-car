@extends('layouts.base')

@section('title', 'Просмотр автомобиля на складе #' . $carStock->id)

@section('content')
    <div class="container">
        <h1>Просмотр автомобиля на складе #{{ $carStock->id }}</h1>

        <!-- Кнопка "Назад" -->
        <a href="{{ route('car-stock.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

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
                        <td>{{ $carStock->id }}</td>
                    </tr>
                    <tr>
                        <th>Бренд</th>
                        <td>{{ $carStock->brend_name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Цвет</th>
                        <td>{{ $carStock->color ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Цена</th>
                        <td>{{ number_format($carStock->price, 2) }} ₽</td>
                    </tr>
                    <tr>
                        <th>Количество</th>
                        <td>{{ $carStock->number }}</td>
                    </tr>
                    <tr>
                        <th>Статус</th>
                        <td>
                            @if($carStock->is_booked)
                                <span class="badge bg-danger">Забронирован</span>
                            @else
                                <span class="badge bg-success">В наличии</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Описание</th>
                        <td>{{ $carStock->description ?? 'Нет' }}</td>
                    </tr>
                    <tr>
                        <th>Дата поступления автомобиля на склад</th>
                        <td>{{ $carStock->created_at->format('d.m.Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Действия: редактировать / удалить -->
        @auth
            <div>
                <a href="{{ route('car-stock.edit', $carStock) }}" class="btn btn-warning me-2">Редактировать</a>

                <form action="{{ route('car-stock.destroy', $carStock) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Вы уверены, что хотите удалить этот автомобиль из стока?')">
                        Удалить
                    </button>
                </form>
            </div>
        @endauth
    </div>
@endsection
