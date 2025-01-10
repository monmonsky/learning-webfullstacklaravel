<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/login', function () {
    return 'login page';
})->name('login');

Route::group([
    'middleware' => ['isAuth'],
    'prefix' => 'movie',
    'as' => 'movie.'
], function () {

    Route::get('/', [MovieController::class, 'index']);
    Route::get('/{id}', [MovieController::class, 'show'])->middleware(['isMember']);
    Route::post('/', [MovieController::class, 'store']);
    Route::put('/{id}', [MovieController::class, 'update']);
    Route::patch('/{id}', [MovieController::class, 'update']);
    Route::delete('/{id}', [MovieController::class, 'destroy']);

    Route::get('/pricing', function () {
        return 'please buy a membership to view this page';
    });
});

Route::get('/request', function(Request $request) {
    dd($request);
});