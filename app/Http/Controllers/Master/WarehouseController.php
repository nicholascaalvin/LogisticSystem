<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function getIndex(){
        $contents = Warehouse::all();
        return view('Master.warehouse', ['title' => 'Warehouse', 'contents' => $contents]);
    }
}
