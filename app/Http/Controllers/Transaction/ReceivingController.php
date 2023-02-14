<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivingController extends Controller
{
    public function getIndex(){
        $contents = DB::table('transaksi_penerimaan')->get();
        return view('Transaction.receiving', ['title' => 'Receiving', 'contents' => $contents]);
    }
    public function getAddForm(){
        $supplier = Supplier::all();
        $warehouse = Warehouse::all();
        $product = Product::all();
        return view('Transaction.receiving_form', ['title' => 'Add New Receiving', 'supplier' => $supplier, 'warehouse' => $warehouse, 'date' => date('Y-m-d H:i:s'), 'product' => $product]);
    }
    public function save(Request $request){
        $request = $request->all();
        $transaction_number = $request['transaction_number'];
        $transaction_date = $request['transaction_date'];
        $supplier_id = $request['supplier_id'];
        $warehouse_id = $request['warehouse_id'];
        $transaction_notes = $request['transaction_notes'];
        $products_id = $request['products_id'];
        $products_qty_dus = $request['products_qty_dus'];
        $products_qty_pcs = $request['products_qty_pcs'];

        $id = DB::table('transaksi_penerimaan')->insertGetId(
            [
                'TrxInNo' => $transaction_number,
                'WhsIdf' => $warehouse_id,
                'TrxInDate' => $transaction_date,
                'TrxInSuppIdf' => $supplier_id,
                'TrxInNotes' => $transaction_notes,
            ]
        );
        foreach ($products_id as $key => $value) {
            DB::table('transaksi_penerimaan_detail')->insert(
                [
                    'TrxInIDF' => $id,
                    'TrxInDProductIdf' => $value,
                    'TrxInDQtyDus' => $products_qty_dus[$key],
                    'TrxInDQtyPcs' => $products_qty_pcs[$key],
                ]
            );
        }
        return 'Successfully add receiving!';
    }
}
