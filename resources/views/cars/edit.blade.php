@extends('layouts.base')

@section('title', 'Редактирование автомобиля #' . $car->id)

@section('content')
    <div class="container">
        <h1>Редактирование автомобиля с номером {{ $car->id ." бренд:". $car->brend->name}}</h1>

        <!-- Кнопка "Назад" -->
        <a href="{{ route('cars.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

        <!-- Сообщения об успехе/ошибках -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Форма редактирования -->
        <div class="card">
            <div class="card-header">
                <strong>Изменить данные автомобиля</strong>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cars.update', $car) }}">
                    @csrf
                    @method('PUT')

                    <!-- Поле: Бренд -->
                    <div class="mb-3">
                        <label for="brend_id" class="form-label">Бренд</label>
                        <select name="brend_id" id="brend_id"
                                class="form-control @error('brend_id') is-invalid @enderror" required>
                            <option value="">Выберите бренд</option>
                            @foreach($brends as $brend)
                                <option value="{{ $brend->id }}"
                                    {{ old('brend_id', $car->brend_id) == $brend->id ? 'selected' : '' }}>
                                    {{ $brend->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brend_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Поле: Цвет -->
                    <div class="mb-3">
                        <label for="color_id" class="form-label">Цвет</label>
                        <select name="color_id" id="color_id"
                                class="form-control @error('color_id') is-invalid @enderror" required>
                            <option value="">Выберите цвет</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ old('color_id', $car->color_id) == $color->id ? 'selected' : '' }}>
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('color_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Поле: Цена -->
                    <div class="mb-3">
                        <label for="total_price" class="form-label">Цена</label>
                        <input type="number" step="0.01" name="total_price" id="total_price"
                               class="form-control @error('total_price') is-invalid @enderror"
                               value="{{ old('total_price', $car->total_price) }}" required>
                        @error('total_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Поле: Комментарий -->
                    <div class="mb-3">
                        <label for="comment" class="form-label">Комментарий</label>
                        <textarea name="comment" id="comment" rows="4"
                                  class="form-control @error('comment') is-invalid @enderror">{{ old('comment', $car->comment) }}</textarea>
                        @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Кнопки -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Обновить автомобиль</button>
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
