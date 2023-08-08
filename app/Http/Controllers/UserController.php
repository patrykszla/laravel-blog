<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function logout() {
        auth()->logout();
        // return 'you now are logged out';
        return redirect('/')->with('success', 'Successfully logged out');
    }
    
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            //with give flash message
            return redirect('/')->with('success', 'Successfully logged in');
        } else {
            return redirect('/')->with('failure', 'Invalid login');
        }
    }

    public function showCorrectHomepage(Request $request) {
        if(auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    public function register(Request $request) {
        // var_dump($request);
        $incomingFields = $request->validate([
            // Class Rule unique - first table in database second column
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            //laravel looking for password_confirmation and check is the same as password
            'password' => ['required', 'min:5', 'confirmed'],
        ]);
        $user = User::create($incomingFields);
        auth()->login($user);
        // var_dump($incomingFields);
        return redirect('/')->with('success', 'Thank you for creating an account' );
    }

    public function profile() {
        return view('profile-posts');
    }
    
}
