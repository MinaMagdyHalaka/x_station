<?php

use App\Helpers\GeneralHelper;
use Modules\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/users', 'middleware' => ['permission:admin_management', GeneralHelper::authMiddleware()]], function (){
    Route::get('', [UserController::class, 'index']);
    Route::post('', [UserController::class, 'store']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});
