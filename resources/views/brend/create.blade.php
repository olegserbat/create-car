{{--@extends('layouts.base')--}}
{{--@section('content')--}}
{{--    <h3 class="container">Установление бренда</h3>--}}
{{--    <form class="container" action="/brends" method="POST">--}}
{{--        @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="name" class="form-label">Имя бренда</label>--}}
{{--                <input  class="form-control" id="name" name="name" value="{{ old('name') }}">--}}
{{--                <div  class="form-text">Определяем имя бренда</div>--}}
{{--                @if ($errors->get('name'))--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->get('name') as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="price" class="form-label">Комментарии</label>--}}
{{--                    <input  class="form-control" id="comment" name="comment" placeholder="Ваши комментарии">--}}
{{--                    <div  class="form-text">Комменетарии к бренду</div>--}}
{{--                    @if ($errors->get('comment'))--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->get('comment') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--        <button type="submit" class="btn btn-primary">Отправить</button>--}}
{{--    </form>--}}
{{--@endsection--}}

@extends('layouts.base')
@section('content')
    <h3 class="container text-center">Установление бренда</h3>
    <form class="container" action="/brends" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя бренда</label>
            <input class="form-control" id="name" name="name" value="{{ old('name') }}">
            <div class="form-text">Определяем имя бренда</div>
            @if ($errors->get('name'))
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->get('name') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Комментарии</label>
            <input class="form-control" id="comment" name="comment" placeholder="Ваши комментарии" value="{{ old('comment') }}">
            <div class="form-text">Комментарии к бренду</div>
            @if ($errors->get('comment'))
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->get('comment') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Кнопка в овале, по центру -->
        <div class="d-flex justify-content-center my-4">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fs-5 shadow-sm" style="background-color: #ff6b6b; border: none;">
                Создать новый бренд
            </button>
        </div>
    </form>
@endsection
