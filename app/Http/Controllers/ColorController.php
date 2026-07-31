<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColorRequest;
use App\Models\Color;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Car;
use function PHPUnit\Framework\isNull;


class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', ['colors' => $colors]);
    }


    public function create(Request $request)
    {
        return view('colors.color_create', ['payment'=>$request->payment]);
    }


    public function storage(StoreColorRequest $request)
    {
        if(isset($request->service))
        {
            return redirect()->route('color.create', ['payment'=>$request->payment]);
        }
        else {
            $validateData = $request->validated();
            $isFree = $request->payment == 'free' ? true : false;
            $validateData['isFree'] = $isFree;
            $color = new Color();
            $color->fill($validateData);
            $color->save();
            return redirect()->route('color.index')->with("status", "Цвет $color->name успешно добавлен");

        }
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return view('colors.edit', ['id'=>$id, 'name'=>$color->name, 'price'=>$color->price]);
    }

    public function update(StoreColorRequest $request)
    {
        $color = Color::find($request->id);
        if($color->cars->count() != 0){
            return redirect()->route('color.index')->with("warning",
                "Цвет $color->name используется и не может быть изменен");
        }
        $validateData = $request->validated();
        $isFree = $request->price == 0 ? true : false;
        $validateData['isFree'] = $isFree;
        $color->fill($validateData);
        $color->save();
        return redirect()->route('color.index')->with("status", "Цвет $color->name успешно обновлен");
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        if($color->cars->count() != 0){
            return redirect()->route('color.index')->with("warning",
                "Цвет $color->name используется и не может быть удален");
        }
        if(Auth::user()->name !== 'admin')
        {
            abort(403);
        }
        $color->delete();
        return redirect()->route('color.index')->with("warning", "Цвет $color->name успешно удален");
    }
}
