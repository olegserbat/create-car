<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColorRequest;
use App\Models\Color;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




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
        if(Auth::user()->name !== 'admin')
        {
            abort(403);
        }
        $color->delete();
        return redirect()->route('color.index')->with("warning", "Цвет $color->name успешно удален");
    }
}
