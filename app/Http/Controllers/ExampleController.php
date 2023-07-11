<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homePage() {
        // return '<h1>Homepage</h1><a href="/about">About page</a>';
        $ourName = 'Patryk';

        $animals = ['Kot', 'Drugi kot', 'Trzeci kot'];

        return view('homepage', ['name' => $ourName, 'catname' => 'KOCUUR']);
    }

    public function aboutPage() {
        return '<h1>About page</h1><a href="/">Home page</a>';
    }

}
