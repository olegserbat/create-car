
@extends('layouts.base')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Список цветов</h2>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach($colors as $color)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100 border-light">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $color->name }}</h5>
                            <p class="card-text text-muted">
                                <small>Дополнительная оплата: {{ $color->price }} ₽</small>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                @auth
                                    <a href="/colors/{{ $color->id }}/edit" class="btn btn-outline-primary btn-sm">Изменить стоимость</a>
                                    @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                                        <form action="{{ url('/colors/'.$color->id) }}" method="POST" class="d-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center my-4">
            <a href="/colors/create" class="btn btn-primary rounded-pill px-5 py-2 fs-5 shadow-sm" style="background-color: #ff6b6b; border: none;">
                Создать новый цвет
            </a>
        </div>
    </div>
@endsection
