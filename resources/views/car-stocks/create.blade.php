@extends('layouts.base')

@section('title', 'Добавить автомобиль на склад')

@section('content')
    <div class="container">
        <h1>Добавить автомобиль на склад</h1>

        <a href="{{ route('car-stock.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

        <form method="POST" action="{{ route('car-stock.store') }}">
            @csrf

            <!-- Выбор бренда -->
            <div class="mb-3">
                <label for="brend_id" class="form-label">Бренд</label>
                <select name="brend_name" id="brend_id" class="form-control @error('brend_id') is-invalid @enderror">
                    <option value="">Выберите бренд</option>
                    @foreach($brends as $brend)
                        <option value="{{ $brend->name }}" {{ old('brend_name') == $brend->name ? 'selected' : '' }}>
                            {{ $brend->name }}
                        </option>
                    @endforeach
                </select>
                @error('brend_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Выбор цвета -->
            <div class="mb-3">
                <label for="color_id" class="form-label">Цвет</label>
                <select
                    name="color"
                    id="color_id"
                    class="form-control @error('color_id') is-invalid @enderror"
                >
                    <option value="">Выберите цвет</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->name }}" {{ old('color') == $color->name ? 'selected' : '' }}>
                            {{ $color->name }}
                        </option>
                    @endforeach
                </select>
                @error('color_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Цена автомобиля -->
            <div class="mb-3">
                <label for="price" class="form-label">Цена (₽)</label>
                <input type="number" step="0.01" name="price" id="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price') }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Количество на складе -->
            <div class="mb-3">
                <label for="number" class="form-label">Количество</label>
                <input type="number" name="number" id="number" min="1"
                       class="form-control @error('number') is-invalid @enderror"
                       value="{{ old('number') }}" required>
                @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Описание -->
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" rows="4"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
