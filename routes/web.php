<?php

use Illuminate\Support\Facades\Route;

$movies = [];

for ($i = 0; $i < 10; $i++) {
    $movies[] = [
        'title' => 'Movie ' . $i,
        'year' => 2022,
        'genre' => 'Action',
    ];
}

Route::get('/login', function () {
    return 'Login Page';
})->name('login');

Route::group([
    'middleware' => ['isAuth'],
    'prefix' => 'movie',
    'as' => 'movie.'
], function () use ($movies) {

    Route::get('/', function () use ($movies) {
        return $movies;
    });

    Route::get('/{id}', function ($id) use ($movies) {
        return $movies[$id];
    })->middleware(['isMember']);

    Route::post('', function () use ($movies) {
        $movies[] = [
            'title' => request('title'),
            'year' => request('year'),
            'genre' => request('genre'),
        ];

        return $movies;
    });

    Route::patch('/{id}', function ($id) use ($movies) {

        $movies[$id]['title'] = request('title');
        $movies[$id]['year'] = request('year');
        $movies[$id]['genre'] = request('genre');

        return $movies;
    });

    Route::delete('/{id}', function ($id) use ($movies) {

        unset($movies[$id]);

        return $movies;
    });

    Route::get('/pricing', function () {
        return 'please buy a membership to view this page';
    });
});
