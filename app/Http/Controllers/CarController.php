<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Car;
use App\Models\Color;
use App\Models\Brend;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{

    /**
     * Показать список всех автомобилей.
     */
    public function index(): View
    {
        $cars = Car::with(['brend', 'color', 'owner'])->get();
        return view('cars.index', compact('cars'));
    }

    /**
     * Показать форму создания автомобиля.
     */
    public function create(): View
    {
        $colors = Color::all();
        $brends = Brend::all();
        return view('cars.create', compact('colors', 'brends'));
    }

    /**
     * Сохранить новый автомобиль в БД.
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        $color = Color::findOrFail($request->color_id);
        $car = Car::create([
            'color_id' => $request->color_id,
            'brend_id' => $request->brend_id,
            'comment' => $request->comment,
            'total_price' => $request->total_price + $color->price,
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('cars.index')->with('success', 'Автомобиль успешно добавлен!');
    }

    public function show($id): View
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    /**
     * Показать форму редактирования автомобиля.
     */
    public function edit(Car $car): View
    {
        // Авторизация: только владелец может редактировать
        $this->authorizeOwner($car);

        $colors = Color::all();
        $brends = Brend::all();

        return view('cars.edit', compact('car', 'colors', 'brends'));
    }

    /**
     * Обновить автомобиль в БД.
     */
    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        // Авторизация: только владелец может обновить
        $this->authorizeOwner($car);

        $car->update($request->validated());

        return redirect()->route('cars.index')->with('success', 'Автомобиль успешно обновлён!');
    }

    /**
     * Удалить автомобиль.
     */
    public function destroy(Car $car): RedirectResponse
    {
        // Авторизация: только владелец может удалить
        $this->authorizeOwner($car);

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Автомобиль успешно удалён!');
    }

    /**
     * Проверка, что пользователь — владелец автомобиля
     */
    private function authorizeOwner(Car $car): void
    {
        if ($car->owner_id !== auth()->id()) {
            abort(403, 'Вы не можете выполнять это действие.');
        }
    }
}
