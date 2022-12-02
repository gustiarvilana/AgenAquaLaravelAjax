<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DependantDropdownController extends Controller
{

    public function provinces()
    {
        return \Indonesia::allProvinces();
    }

    public function cities()
    {
        return \Indonesia::all()->pluck('name', 'id');
    }

    public function districts(Request $request)
    {
        return \Indonesia::findCity($request->id, ['districts'])->districts->pluck('name', 'id');
    }

    public function villages(Request $request)
    {
        return \Indonesia::findDistrict($request->id, ['villages'])->villages->pluck('name', 'id');
    }
}
