<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products', [ApiController::class, 'index']);
Route::post('/products/store', [ApiController::class, 'store']);
Route::get('/products/show/{id}', [ApiController::class, 'show']);
Route::put('/products/update/{id}', [ApiController::class, 'update']);
Route::delete('/products/delete/{id}', [ApiController::class, 'destroy']);