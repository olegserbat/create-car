@extends('layouts.base')
@section('content')
    <h3 class="container">Установление бренда</h3>
    <form class="container" action="/brends" method="POST">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя бренда</label>
                <input  class="form-control" id="name" name="name" value="{{ old('name') }}">
                <div  class="form-text">Определяем имя бренда</div>
                @if ($errors->get('name'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Комментарии</label>
                    <input  class="form-control" id="comment" name="comment" placeholder="Ваши комментарии">
                    <div  class="form-text">Комменетарии к бренду</div>
                    @if ($errors->get('comment'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('comment') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
