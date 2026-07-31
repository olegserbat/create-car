@extends('layouts.base')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Список автомобилей на складе</h2>

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

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Бренд</th>
                    <th scope="col">Цвет</th>
                    <th scope="col" class="text-end">Цена</th>
                    <th scope="col" class="text-end">Количество</th>
                    <th scope="col" class="text-center">Статус</th>
                    <th scope="col" class="text-end">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carStocks as $carStock)
                    <tr>
                        <td class="text-center"><a href="/car-stocks/{{$carStock->id}}">{{ $carStock->id }}</a></td>
                        <td>{{ $carStock->brend_name }}</td>
                        <td>{{ $carStock->color ?? '-' }}</td>
                        <td class="text-end">{{ number_format($carStock->price, 2) }} ₽</td>
                        <td class="text-end">{{ $carStock->number }}</td>
                        <td class="text-center">
                            @if ($carStock->is_booked)
                                <span class="badge bg-danger">Забронирован</span>
                            @else
                                <span class="badge bg-success">В наличии</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="/car-stocks/{{ $carStock->id }}" class="btn btn-outline-primary btn-sm me-2">Просмотреть</a>
                        @auth
                                <a href="/car-stocks/{{ $carStock->id }}/edit" class="btn btn-outline-primary btn-sm me-2">Изменить</a>
                                @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                                    <form action="{{ url('/car-stocks/'.$carStock->id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Удалить этот автомобиль из стока?');">Удалить</button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @auth
        <div class="d-flex justify-content-center my-4">
            <a href="/car-stocks/create" class="btn btn-primary rounded-pill px-5 py-2 fs-5 shadow-sm" style="background-color: #ff6b6b; border: none;">
                Добавить автомобиль
            </a>
        </div>
    @endauth
        <div class="mt-3 text-center text-muted small">
            {{ $carStocks->links() }}
        </div>
    </div>
@endsection
