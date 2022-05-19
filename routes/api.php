<?php

use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/channel', [ChannelController::class, 'getDataRs'])->name('channel');
Route::get('/channels/api/access_key={apikey}', [ChannelController::class, 'getDataRs'])->middleware('ApiKey');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('/channel', [ChannelController::class, 'getDataRs'])->name('channel');
});
