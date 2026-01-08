@extends('layouts.base')

@section('content')
    <h3 class="container">Редактирование данных по цвету {{$name}}</h3>
    <form class="container" action="/colors/update" method="post">
    @method('PATCH')
        @csrf

        <div class="mb-3">
            <label for="price" class="form-label">Стоимость цвета</label>
            <input  class="form-control" id="price" name="price" placeholder="старая цена: {{$price}}">
            <div  class="form-text">Определяем стоимость цвета в рублях</div>
            @if ($errors->get('price'))
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
