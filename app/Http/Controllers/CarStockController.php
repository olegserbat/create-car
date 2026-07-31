<?php

namespace App\Http\Controllers;

use App\Models\CarStock;
use Illuminate\Http\Request;
use App\Http\Requests\CarStockRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Color;
use App\Models\Brend;
use App\Http\Requests\UpdateCarStockRequest;

class CarStockController extends Controller
{
    public function index(): View
    {
        $carStocks = CarStock::paginate(15);
        return view('car-stocks.index', compact('carStocks'));
    }

    public function create(): View
    {
        $colors = Color::all();
        $brends = Brend::all();
        return view('car-stocks.create', compact('colors', 'brends'));
    }

    public function store(CarStockRequest $request): RedirectResponse
    {
        CarStock::create($request->validated());

        return redirect()
            ->route('car-stock.index')
            ->with('success', 'Автомобиль успешно добавлен на склад');
    }

    public function show(CarStock $carStock): View
    {
        return view('car-stocks.show', compact('carStock'));
    }

    public function edit(CarStock $carStock): View
    {
        return view('car-stocks.edit', compact('carStock'));
    }

    public function update(UpdateCarStockRequest $request, CarStock $carStock): RedirectResponse
    {
        $carStock->update($request->only('price', 'number'));

        return redirect()
            ->route('car-stock.index', $carStock)
            ->with('status', 'Данные автомобиля обновлены');
    }

    public function destroy(CarStock $carStock): RedirectResponse
    {
        $carStock->delete();

        return redirect()
            ->route('car-stock.index')
            ->with('status', 'Автомобиль удалён со склада');
    }
}
