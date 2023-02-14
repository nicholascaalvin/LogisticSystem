<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function getIndex(){
        $contents = Supplier::all();
        return view('Master.supplier', ['title' => 'Supplier', 'contents' => $contents]);
    }
}
