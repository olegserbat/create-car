@extends('layouts.base')

@section('content')
    <h3 class="container">Редактирование комментариев по бренду {{$name}}</h3>
    <form class="container" action="/brends/update" method="post">
        @method('PATCH')
        @csrf
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарии</label>
            <input  class="form-control" id="comment" name="comment" placeholder="старый комментарий: {{$comment}}">
            <div  class="form-text">Корректируем старый комментарий</div>
            @if ($errors->get('comment'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('price') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input hidden name="id" value="{{$id}}">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
