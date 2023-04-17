<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback and log in the user
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Unable to authenticate with Google.');
        }

        // Check if user already exists in database
        $existingUser = Student::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            // Create a new user
            $newUser = new Student();
            $newUser->student_id = $user->student_id;
            $newUser->class_id = $user->class_id;
            $newUser->name = $user->name;
            $newUser->contact = $user->contact;
            $newUser->email = $user->email;
            $newUser->save();

            Auth::login($newUser, true);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
