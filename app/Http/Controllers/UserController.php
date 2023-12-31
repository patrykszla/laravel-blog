<?php

namespace App\Http\Controllers;

use App\Events\OurExampleEvent;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function storeAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|max:3000'
        ]);
        $user = auth()->user();
        $filename = $user->id . '-' . uniqid() . '.jpg';
        // $request->file('avatar')->store('public/avatar');
        $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/avatars/'. $filename, $imgData);
        
        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if($oldAvatar != "/fallback-avatar.jpg") {
            Storage::delete(str_replace("/storage", "public/", $oldAvatar));
        }
        
        return back()->with('success', 'Congrats on the new avatar');
    }

    public function showAvatarForm(){
        return view('avatar-form');
    }

    public function logout() {
        event(new OurExampleEvent(['username' => auth()->user()->username, 'action' => 'logout']));
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
            event(new OurExampleEvent(['username' => auth()->user()->username, 'action' => 'login']));
            //with give flash message
            return redirect('/')->with('success', 'Successfully logged in');
        } else {
            return redirect('/')->with('failure', 'Invalid login');
        }
    }

    public function showCorrectHomepage(Request $request) {
        if(auth()->check()) {
            return view('homepage-feed', ['posts' => auth()->user()->feedPosts()->latest()->paginate(5)]);
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
        return redirect('/')->with('success', 'Thank you for creating an account' );
    }

    private function getSharedData($user) {
        $currentlyFollowing = 0;
    
        if(auth()->check()) {
            $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id],['followeduser', '=', $user->id]])->count();
        } 

        View::share('sharedData', [
            'currentlyFollowing' => $currentlyFollowing,
            'avatar' =>$user->avatar,
            'username' => $user->username, 
            'postCount' => $user->posts()->count(),
            'followerCount' => $user->followers()->count(),
            'followingCount' => $user->followingTheseUsers()->count()
        ]);
    }

    public function profile(User $user) {
        $this->getSharedData($user);
        return view('profile-posts', [
        'posts' => $user->posts()->latest()->get(), 
    ]);
    }

    public function profileFollowers(User $user) {
        $this->getSharedData($user);
        // return $user->followers()->latest()->get();
        return view('profile-followers', [
            'followers' => $user->followers()->latest()->get(), 
        ]);
    }

    public function profileFollowing(User $user) {
        $this->getSharedData($user);

        return view('profile-following', [
            'following' => $user->followingTheseUsers()->latest()->get(), 
        ]);
    }
    
}
