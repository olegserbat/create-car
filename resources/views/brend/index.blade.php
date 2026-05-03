{{--@extends('layouts.base')--}}

{{--@section('content')--}}
{{--    @if (session('status'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('status') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @if (session('warning'))--}}
{{--        <div class="alert alert-warning">--}}
{{--            {{ session('warning') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <table class="mt-4 table table-success table-striped table-bordered container ">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>id</th>--}}
{{--            <th>Название бренда</th>--}}
{{--            <th>Комментарии</th>--}}
{{--            @auth()--}}
{{--                <th>Возможность изменить комментарии</th>--}}
{{--                @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')--}}
{{--                    <th>Удалить</th>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($brends as $brend)--}}
{{--            <tr>--}}
{{--                <td>{{$brend->id}}</td>--}}
{{--                <td>{{$brend->name}}</td>--}}
{{--                <td>{{$brend->comment}}</td>--}}
{{--                @auth()--}}
{{--                    <td><a href="/brends/{{$brend->id}}/edit">Изменить комментарии</a></td>--}}
{{--                    @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')--}}
{{--                        <td>--}}
{{--                            <form action="{{ url('/brends/'.$brend->id) }}" method="POST">--}}
{{--                                {{ csrf_field() }}--}}
{{--                                {{ method_field('DELETE') }}--}}
{{--                                <button type="submit" class="btn btn-danger">--}}
{{--                                    <i class="fa fa-btn fa-trash"></i>Удалить--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <a href="/brends/create" class="container" style="text-align:center"><h4>Создать новый бренд</h4></a>--}}
{{--@endsection--}}

@extends('layouts.base')
@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Список брендов</h2>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('alert'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('alert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach ($brends as $brend)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100 border-light">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $brend->name }}</h5>
                            <p class="card-text text-muted">
                                <small>Комментарий: {{ $brend->comment ?? 'Нет комментария' }}</small>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                @if(Auth::user()->name == 'admin' || Auth::user()->id == $brend->user_id)
                                <a href="/brends/{{ $brend->id }}/edit" class="btn btn-outline-primary btn-sm">Редактировать</a>
                                @endif
                                    @if(Auth::user()->name == 'admin')
                                <form action="/brends/{{ $brend->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Кнопка "Создать новый бренд" — по центру, в овале -->
        <div class="d-flex justify-content-center my-4">
            <a href="/brends/create" class="btn btn-primary rounded-pill px-5 py-2 fs-5 shadow-sm" style="background-color: #ff6b6b; border: none;">
                Создать новый бренд
            </a>
        </div>
    </div>
@endsection
