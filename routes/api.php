<?php

use App\Http\Controllers\Nyt\BestSellerController;
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

Route::group([
    'prefix'     => '/1',
    'as'         => 'v1.',
], function () {
    Route::group([
        'prefix'     => '/nyt',
        'as'         => 'nyt.',
    ], function () {
        Route::controller(BestSellerController::class)
            ->prefix('/best-sellers')
            ->name('best-sellers.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
    });
});
