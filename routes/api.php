<?php

use App\Enum\HttpStatusCodeEnum;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\AuthAdmin\ApiAuthAdminController;
use App\Http\Controllers\Plant\PlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group([], function () {
    // Passport routes...
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::get('/test',function(){
        return HttpStatusCodeEnum::cases();
    });
    Route::post('/login-admin', [ApiAuthAdminController::class, 'loginAdmin'])->name('login.admin');;
    Route::get('/test',function(){
        return HttpStatusCodeEnum::cases();
    });

});

Route::middleware(['auth:api'])->group(function () {
    // Passport routes...
    Route::group(['prefix' => 'plant'], function () {
        Route::get("/", [PlantController::class, "index"]);
        Route::post("/", [PlantController::class, "store"]);
        Route::post("/{id}", [PlantController::class, "update"]);
        Route::get("/{id}", [PlantController::class, "show"]);
        Route::delete("/{id}", [PlantController::class, "delete"]);
    });
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::post('/logout', [ApiAuthAdminController::class, 'logout'])->name('logout.api');


});
