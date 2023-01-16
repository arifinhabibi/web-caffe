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

        foreach ($billOrders as $billOrder) {
            # code...
            $billOrder->date_order = date_format(date_create($billOrder->date_order), "d F Y");
        }

        return response()->json($billOrders, 200);
    }
}
