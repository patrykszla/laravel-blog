<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function register(Request $request) {
        // var_dump($request);
        $incomingFields = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create($incomingFields);
        // var_dump($incomingFields);
        return 'hello from register function';
    }
}
