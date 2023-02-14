<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function getIndex(){
        $contents = DB::table('transaksi_pengeluaran')->get();
        return view('Transaction.shipping', ['title' => 'Shipping', 'contents' => $contents]);
    }
    public function getAddForm(){
        $customer = Customer::all();
        $warehouse = Warehouse::all();
        $product = Product::all();
        return view('Transaction.shipping_form', ['title' => 'Add New Shipping', 'customer' => $customer, 'warehouse' => $warehouse, 'date' => date('Y-m-d H:i:s'), 'product' => $product]);
    }
    public function save(Request $request){
        $request = $request->all();
        $transaction_number = $request['transaction_number'];
        $transaction_date = $request['transaction_date'];
        $customer_id = $request['customer_id'];
        $warehouse_id = $request['warehouse_id'];
        $transaction_notes = $request['transaction_notes'];
        $products_id = $request['products_id'];
        $products_qty_dus = $request['products_qty_dus'];
        $products_qty_pcs = $request['products_qty_pcs'];

        $id = DB::table('transaksi_pengeluaran')->insertGetId(
            [
                'TrxOutNo' => $transaction_number,
                'WhsIdf' => $warehouse_id,
                'TrxOutDate' => $transaction_date,
                'TrxOutCustIdf' => $customer_id,
                'TrxOutNotes' => $transaction_notes,
            ]
        );
        foreach ($products_id as $key => $value) {
            DB::table('transaksi_pengeluaran_detail')->insert(
                [
                    'TrxOutIDF' => $id,
                    'TrxOutDProductIdf' => $value,
                    'TrxOutDQtyDus' => $products_qty_dus[$key],
                    'TrxOutDQtyPcs' => $products_qty_pcs[$key],
                ]
            );
        }
        return 'Successfully add shipping!';
    }
}
