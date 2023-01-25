<?php

namespace App\Http\Controllers\API;

use App\Models\Menu;
use App\Models\BillOrder;
use App\Models\MenuOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    // list menu
    public function listMenu(Request $request){
        $menus = Menu::all();

        if ($menus == null) {
            # code...
            return response()->json([
                'message' => 'menus is empty'
            ], 402);
        }

        return response()->json([
            'menus' => $menus
        ], 200);
    }

    // order
    public function orders(Request $request){
        $validator = Validator::make($request->all(), [
            'no_order' => 'required|string',
            'buyer' => 'required|string',
            'no_table' => 'required|string',
            'menu_orders' => 'array'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 402);
        }

        $bill = BillOrder::create([
            'no_order' => $request->no_order,
            'buyer' => $request->buyer,
            'no_table' => $request->no_table,
            'total_payment' => $request->total_payment,
            'cash' => $request->cash,
            'date_order' => date('Y-m-d')
        ]);

        foreach ($request->menu_orders as $menu_order) {
            MenuOrder::create([
                'menu' => $menu_order[0],
                'price' => $menu_order[1],
                'quantity' => $menu_order[2],
                'bill_order_id' => $bill->id
            ]);
        }

        return response()->json([
            'message' => 'pemesanan berhasil!'
        ], 200);
    }

    // history transaction
    public function history(Request $request){
        $billOrders = BillOrder::with(['menuOrders'])->get();

        $month = date('F Y');

        foreach ($billOrders as $billOrder) {
            # code...
            date_format(date_create($billOrder->date_order), "F Y") == $month ?  $billOrder->month = $month : $billOrder->moonth = null;

            $billOrder->date_order = date_format(date_create($billOrder->date_order), "d F Y");
        }

        return response()->json([
            'history_bills' => $billOrders,
            'month' => $month
        ], 200);
    }

    // delete history transaction
    public function deleteHistory(Request $request, $id) {
        $history = BillOrder::find($id);

        if (!$history) {
            # code...
            return response()->json([
                'message' => 'riwayat transaksi tidak ditemukan' 
            ], 402);
        }

        $history->delete();

        return response()->json([
            'messaage' => 'riwayat transaksi berhasil dihapus'
        ], 200);
    }
}
