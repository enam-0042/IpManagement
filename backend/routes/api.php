<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\IpListController;

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

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
// Route::get('login', function(){
//     return "hello";
// });
 //Route::post('/iplists', [IpListController::class, 'store']);

Route::middleware('auth:sanctum')->group( function (){
    //here is function store
    // Route::get('/sanctum',function(){
    //     return auth()->user();
    // });
   
   Route::resource('iplists', IpListController::class);
});
Route::get('/login', function () {
    return response()->json(['message'=>'unauthorized eeeeentry'], 401);

})->name('login');
