<?php

use App\Http\Controllers\Api\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/index', [AuthController::class], 'index');
Route::post('/forget', [ForgetController::class, 'forget']);
Route::post('/reset', [ForgetController::class, 'reset']);
Route::post('/checkToken', [ForgetController::class], 'checkToken');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/logout', [AuthController::class, 'logout']);
});