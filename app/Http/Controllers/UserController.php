<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function register(Request $request) {
        // var_dump($request);
        $incomingFields = $request->validate([
            // Class Rule unique - first table in database second column
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            //laravel looking for password_confirmation and check is the same as password
            'password' => ['required', 'min:5', 'confirmed'],
        ]);
        User::create($incomingFields);
        // var_dump($incomingFields);
        return 'hello from register function';
    }
}
