<?php

use App\Helpers\GeneralHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Technical\app\Http\Controllers\TechnicalController;

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

Route::group(['prefix' => 'technicals', 'middleware' => [GeneralHelper::authMiddleware()]], function (){
    Route::get('', [TechnicalController::class, 'index']);
    Route::post('', [TechnicalController::class, 'store'])->withoutMiddleware('auth:sanctum');
    Route::get('{id}', [TechnicalController::class, 'show']);
    Route::post('{id}', [TechnicalController::class, 'update']);
    Route::delete('{id}', [TechnicalController::class, 'destroy']);
});
