<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getIndex(){
        $contents = Customer::all();
        return view('Master.customer', ['title' => 'Customer', 'contents' => $contents]);
    }
}
