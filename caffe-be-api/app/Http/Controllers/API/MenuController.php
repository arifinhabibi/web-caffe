<?php

namespace App\Http\Controllers\API;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // add list menu
    public function addListMenu(Request $request){
        $validator = Validator::make($request->all(), [
            'menu' => 'required|string',
            'price' => 'required|integer',
            'image' => 'string|required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 402);
        }

        Menu::create([
            'menu' => $request->menu,
            'price' => $request->price,
            'image' => $request->image
        ]);

        return response()->json([
            'message' => 'berhasil menambahkan menu'
        ], 200);
    }

    // get menu
    public function getMenu(Request $request, $id){
        $menu = Menu::find($id);

        if (!$menu) {
            # code...
            return response()->json([
                'message' => 'menu tidak ditemukan'
            ], 402);
        }

        return \response()->json($menu, 200);
    }

    // update menu 
    public function updateMenu(Request $request, $id){
        $menu = Menu::find($id);

        if (!$menu) {
            # code...
            return response()->json([
                'message' => 'menu tidak ditemukan'
            ], 402);
        }

        $menu->update([
            'menu' => $request->menu,
            'price' => $request->price,
            'image' => $request->image
        ]);

        return response()->json([
            'message' => 'menu success diubah'
        ], 200);
    }

    // delete menu
    public function deleteMenu(Request $request, $id){
        $menu = Menu::find($id);

        if (!$menu) {
            # code...
            return response()->json([
                'message' => 'data menu tidak ditemukan'
            ], 402);
        }

        $menu->delete();

        return response()->json([
            'message' => 'data menu berhasil terhapus'
        ], 200);
    }
}
