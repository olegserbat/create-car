<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrendController extends Controller
{
    public function index()
    {
        return 'all brends';
    }

    public function create()
    {
        return 'new brend';
    }

    public function storage()
    {
        return "save brend";
    }

    public function show($brend)
    {
        return 'brend:'."$brend";
    }

    public function edit($brend)
    {
        return "edit $brend";
    }

    public function update()
    {
        return 'update';
    }

    public function destroy($brend)
    {
        return "delete ".$brend;
    }
}
