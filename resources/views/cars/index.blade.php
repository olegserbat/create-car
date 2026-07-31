@extends('layouts.base')

@section('title', 'Список автомобилей')

@section('content')
    <div class="container">
        <h1>Автомобили под заказ</h1>
        @auth
        <a href="/cars/create" class="btn btn-primary mb-3">Добавить автомобиль</a>
        @endauth
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($cars->isEmpty())
            <p>Автомобилей пока нет.</p>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Бренд</th>
                    <th>Цвет</th>
                    <th>Цена</th>
                    <th>Владелец</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brend->name ?? '—' }}</td>
                        <td>{{ $car->color->name ?? '—' }}</td>
                        <td>{{ number_format($car->total_price, 2) }} ₽</td>
                        <td>{{ $car->owner->name }}</td>
                        <td>
                            <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">Просмотр</a>
                            @Auth
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Вы уверены?')">
                                    Удалить
                                </button>
                            </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
