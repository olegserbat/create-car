@extends('layouts.base')

@section('title', 'Добавить автомобиль')

@section('content')
    <div class="container">
        <h1>Добавить автомобиль</h1>

        <a href="{{ route('cars.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

        <form method="POST" action="{{ route('cars.store') }}">
            @csrf

            <div class="mb-3">
                <label for="brend_id" class="form-label">Бренд</label>
                <select name="brend_id" id="brend_id" class="form-control @error('brend_id') is-invalid @enderror" required>
                    <option value="">Выберите бренд</option>
                    @foreach($brends as $brend)
                        <option value="{{ $brend->id }}" {{ old('brend_id') == $brend->id ? 'selected' : '' }}>
                            {{ $brend->name }}
                        </option>
                    @endforeach
                </select>
                @error('brend_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="color_id" class="form-label">Цвет</label>
                <select name="color_id" id="color_id" class="form-control @error('color_id') is-invalid @enderror" required>
                    <option value="">Выберите цвет</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                            {{ $color->name }} {{ ", к цене будет добавлена дополнительная цена за цвет $color->price" }}
                        </option>
                    @endforeach
                </select>
                @error('color_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Цена</label>
                <input type="number" step="0.01" name="total_price" id="total_price"
                       class="form-control @error('total_price') is-invalid @enderror"
                       value="{{ old('total_price') }}" required>
                @error('total_price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea name="comment" id="comment" rows="4"
                          class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
