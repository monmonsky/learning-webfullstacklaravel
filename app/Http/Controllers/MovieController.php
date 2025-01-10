<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{

    public $movies;

    public function __construct()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->movies[] = [
                'title' => 'Movie ' . $i,
                'year' => 2022,
                'genre' => 'Action',
            ];
        }
    }

    public static function middleware()
    {
        return [
            'isAuth',
            new Middleware('isMember', only: ['show']),
            // new Middleware('isMember', except: ['show']),
        ]
    }

    public function index()
    {
        return $this->movies;
    }

    public function show($id)
    {
        return $this->movies[$id];
    }

    public function store(Request $request)
    {
        $this->movies[] = [
            'title' => $request->title,
            'year' => $request->year,
            'genre' => $request->genre,
        ];

        return $this->movies;
    }

    public function update(Request $request, $id)
    {
        $this->movies[$id] = [
            'title' => $request->title,
            'year' => $request->year,
            'genre' => $request->genre,
        ];

        return $this->movies;
    }

    public function destroy($id)
    {
        unset($this->movies[$id]);

        return $this->movies;
    }
}
