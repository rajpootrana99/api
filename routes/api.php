<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgetController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\TaskController;
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
Route::post('/forget', [ForgetController::class, 'forget']);
Route::post('/reset', [ForgetController::class, 'reset']);
Route::post('/checkToken', [ForgetController::class], 'checkToken');

Route::group(['middleware' => ['auth:sanctum', 'user_verified']], function () {
    Route::get('/user', [AuthController::class], 'user');
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/updatUser', [AuthController::class, 'update']);
    Route::get('/fetchSites', [SiteController::class, 'fetchSites']);
    Route::post('/createTask', [TaskController::class, 'createTask']);
    Route::post('/sendMessage', [MessageController::class, 'sendMessage']);
    Route::post('/addItem', [TaskController::class, 'addItem']);
    Route::get('/fetchTasks', [TaskController::class, 'fetchTasks']);
    Route::get('/groupTasks', [TaskController::class, 'groupTasks']);
});
