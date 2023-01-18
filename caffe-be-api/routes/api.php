<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// authentication
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);


Route::group(['middleware' => ['userToken']], function() {
    // add menu
    Route::post('/list-menu', [MenuController::class, 'addListMenu']);
    // update menu
    Route::post('list-menu/update/{id}', [MenuController::class, 'updateMenu']);
    // delete menu
    Route::get('/list-menu/delete/{id}', [MenuController::class, 'deleteMenu']);
    // list menu
    Route::get('/orders', [OrdersController::class, 'listMenu']);
    // orders caffe
    Route::post('/orders', [OrdersController::class, 'orders']);
    // history transaction
    Route::get('/history', [OrdersController::class, 'history']);
    // delete history transaction
    Route::get('/history/delete/{id}', [OrdersController::class, 'deleteHistory']);
});