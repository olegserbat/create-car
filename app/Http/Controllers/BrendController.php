<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrendRequest;
use App\Models\Brend;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class BrendController extends Controller
{
    public function index()
    {
        $brends = Brend::all();
        return view('brend.index', compact('brends'));
    }

    public function create()
    {
        return view('brend.create');
    }

    public function store(StoreBrendRequest $request):RedirectResponse
    {
        $validatedData = $request->validated();
        $brend = new Brend();
        $brend->fill($validatedData);
        $brend->user_id = Auth::id();
        $brend->save();
        return redirect()->route('brend.index')->with("status", "Бренд ".$brend->name." успешно добавлен");
    }

    public function edit($id)
    {
        $brend = Brend::find($id);
        if (!$brend) {
            abort(404);
        }
        if($brend->user_id != Auth::id()){
            return redirect()->route('brend.index')->with("alert", "комментарий к бренду ".$brend->name."
            не может быть изменен не создателем этого бренда");
        }
         return view('brend.edit', ['name'=>$brend->name, 'id'=>$brend->id, 'comment'=>$brend->comment]);
    }

    public function update(StoreBrendRequest $request):RedirectResponse
    {
        $brend = Brend::find($request->id);
        if($brend->user_id != Auth::id()){
            abort(403, 'Доступ запрещен');
        }
        $validatedData = $request->validated();
        $brend->fill($validatedData);
        $brend->save();
        return redirect()->route('brend.index')->with("status", "Бренд ".$brend->name." успешно изменен");
    }

    public function destroy($id):RedirectResponse
    {
        $brend = Brend::find($id);
        if($brend->cars->count() > 0) {
            return redirect()->route('brend.index')->with("alert", "Бренд удалить нельзя,
            есть машины с этим брендом");

        }
        if(Auth::user()->name !== 'admin'){
            abort(403, 'Доступ запрещен');
        }
        $brend->delete();
        return redirect()->route('brend.index')->with("status", "Бренд успешно удален");
    }


}
