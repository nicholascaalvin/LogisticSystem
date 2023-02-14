<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryTransactionController extends Controller
{
    public function getIndex(){
        return view('Report.historytransaction', ['title' => 'History Transaction']);
    }
    public function search(Request $request){
        $request = $request->all();

        $transaksi_penerimaan = DB::table('transaksi_penerimaan as a')
        ->join('transaksi_penerimaan_detail as b', 'a.TrxInPK', 'b.TrxInIDF')
        ->join('master_warehouses as c', 'a.WhsIdf', 'c.WhsPK')
        ->join('master_products as d', 'b.TrxInDProductIdf', 'd.ProductPK')
        ->select('a.TrxInNo as transaction_number', 'a.TrxInDate as transaction_date', 'c.WhsName', 'd.ProductName', 'b.TrxInDQtyDus as qty_dus', 'b.TrxInDQtyPcs as qty_pcs', DB::raw('"penerimaan" as type'))
        ->orderBy('a.TrxInPK');

        $transaksi_pengeluaran = DB::table('transaksi_pengeluaran as a')
        ->join('transaksi_pengeluaran_detail as b', 'a.TrxOutPK', 'b.TrxOutIDF')
        ->join('master_warehouses as c', 'a.WhsIdf', 'c.WhsPK')
        ->join('master_products as d', 'b.TrxOutDProductIdf', 'd.ProductPK')
        ->select('a.TrxOutNo as transaction_number', 'a.TrxOutDate as transaction_date', 'c.WhsName', 'd.ProductName', 'b.TrxOutDQtyDus as qty_dus', 'b.TrxOutDQtyPcs as qty_pcs', DB::raw('"pengeluaran" as type'))
        ->orderBy('a.TrxOutPK');

        $itemStock = DB::table('transaksi_penerimaan_detail as A')
        ->join('transaksi_pengeluaran_detail as B', 'A.TrxInDProductIdf', 'B.TrxOutDProductIdf')
        ->join('master_products as C', 'C.ProductPK', 'A.TrxInDProductIdf')
        ->selectRaw('C.ProductName, sum(A.TrxInDQtyDus) - sum(B.TrxOutDQtyDus) as qty_dus, sum(A.TrxInDQtyPcs) - sum(B.TrxOutDQtyPcs) as qty_pcs')
        ->where('C.ProductName', $request['item_name'])
        ->groupBy('C.ProductName')
        ->first();

        if($request['item_name'] != null){
            $transaksi_penerimaan->where('d.ProductName', 'LIKE', ''.$request['item_name'].'');
            $transaksi_pengeluaran->where('d.ProductName', 'LIKE', ''.$request['item_name'].'');
        }

        $query = $transaksi_pengeluaran->union($transaksi_penerimaan);
        return ['query' => $query->get(), 'itemStock' => $itemStock];
    }
}
