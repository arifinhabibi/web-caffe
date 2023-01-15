<?php

namespace App\Http\Controllers\API;

use App\Models\Menu;
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
    public function order(Request $request){
        $validator = Validator::make($request->all(), [
            'order' => 'required|string',

        ]);
    }
}
