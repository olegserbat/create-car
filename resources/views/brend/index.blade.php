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
    <table class="mt-4 table table-success table-striped table-bordered container ">
        <thead>
        <tr>
            <th>id</th>
            <th>Название бренда</th>
            <th>Комментарии</th>
            @auth()
                <th>Возможность изменить комментарии</th>
                @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                    <th>Удалить</th>
                @endif
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach($brends as $brend)
            <tr>
                <td>{{$brend->id}}</td>
                <td>{{$brend->name}}</td>
                <td>{{$brend->comment}}</td>
                @auth()
                    <td><a href="/brends/{{$brend->id}}/edit">Изменить комментарии</a></td>
                    @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                        <td>
                            <form action="{{ url('/brends/'.$brend->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Удалить
                                </button>
                            </form>
                        </td>
                    @endif
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/brends/create" class="container" style="text-align:center"><h4>Создать новый бренд</h4></a>
@endsection
