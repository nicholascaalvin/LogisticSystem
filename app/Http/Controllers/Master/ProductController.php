<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getIndex(){
        $contents = Product::all();
        return view('Master.product', ['title' => 'Product', 'contents' => $contents]);
    }
}
