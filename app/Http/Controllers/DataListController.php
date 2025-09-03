<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPks;
use App\Models\ListKebun;
use App\Models\ListAfdeling;

class DataListController extends Controller
{
    public function index()
    {
        $pks = ListPks::all();
        $kebun = ListKebun::all();
        $afdeling = ListAfdeling::all();

        return view('admin.dataList', compact('pks', 'kebun', 'afdeling'))
            ->with('title', 'Manager Data List');
    }
}
