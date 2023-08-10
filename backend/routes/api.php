<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IpListController;
use App\Http\Controllers\API\LogHistoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
// Route::get('login', function(){
//     return "hello";
// });
 //Route::post('/iplists', [IpListController::class, 'store']);

Route::middleware('auth:sanctum')->group( function (){
    Route::apiResource('ip_lists', IpListController::class)->only([
        'index', 'show', 'store', 'update'
    ]);
    Route::get('/log_histories', [LogHistoryController::class, 'index']);
});
Route::get('/login', function () {
    return response()->json(['message'=>'unauthorized eeeeentry'], 401);

})->name('login');

