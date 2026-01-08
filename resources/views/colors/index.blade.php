@extends('layouts.base')


@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <table class="mt-4 table table-success table-striped table-bordered container " >
        <thead>
        <tr >
            <th>id</th>
            <th>Название цвета</th>
            <th>Доплнительная оплата за цвет</th>
            <th>Возможность изменить стоимость</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($colors as $color)
        <tr>
            <td>{{$color->id}}</td>
            <td>{{$color->name}}</td>
            <td>{{$color->price}}</td>
            <td><a href="/colors/{{$color->id}}/edit">Изменить стоимость</a></td>
            <td>
                <form action="{{ url('/colors/'.$color->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit"  class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Удалить </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/colors/create" class="container" style="text-align:center"><h4>Создать новый цвет</h4></a>
@endsection
