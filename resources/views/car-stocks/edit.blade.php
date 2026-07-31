@extends('layouts.base')

@section('title', 'Обновление цены автомобиля #' . $carStock->id)

@section('content')
    <div class="container">
        <h1>Обновление цены автомобиля #{{ $carStock->id }} — {{ $carStock->brend_name }}</h1>

        <!-- Кнопка "Назад" -->
        <a href="{{ route('car-stock.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

        <!-- Карточка с текущими данными (только для чтения) -->
        <div class="card mb-4">
            <div class="card-header">
                <strong>Текущая информация (не подлежит изменению)</strong>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th style="width: 25%;">Бренд</th>
                        <td>{{ $carStock->brend_name }}</td>
                    </tr>
                    <tr>
                        <th>Цвет</th>
                        <td>{{ $carStock->color ?? '—' }}</td>
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
                </table>
            </div>
        </div>

        <!-- Форма редактирования (цена и количество) -->
        <div class="card">
            <div class="card-header">
                <strong>Изменить цену и количество</strong>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('car-stock.update', $carStock) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="price" class="form-label">Цена (₽)</label>
                        <input type="number" step="0.01" name="price" id="price"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $carStock->price) }}" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Количество</label>
                        <input type="number" name="number" id="number"
                               class="form-control @error('number') is-invalid @enderror"
                               value="{{ old('number', $carStock->number) }}" min="0" required>
                        @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">Обновить</button>
                        <a href="{{ route('car-stock.index') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
