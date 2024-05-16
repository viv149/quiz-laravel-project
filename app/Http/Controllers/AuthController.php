<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        try{
            $user->save();
            Auth::login($user);
            return Redirect::route('home')->with('success', 'You are register successfully!'); // Redirect to home or dashboard
        }catch(Exception $e){
            return redirect()->back()->withInput(['error' => $e->getMessage()]);
        }

    }

    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        try{
            // Validate the request data
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // Attempt to log the user in
            if (Auth::attempt($request->only('email', 'password'))) {
                // Redirect to home or dashboard with a success message
                return Redirect::route('home')->with('success', 'You are successfully logged in.');
            }

            // If the authentication attempt fails, return an error message
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }catch(Exception $e){
            // Catch any unexpected exceptions and return an error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    // logout
    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Redirect to the login page or any other page
        return Redirect::route('login.show')->with('success', 'You have been logged out successfully.');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Handle sending password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = User::sendResetLink($request->only('email'));

        return $status === User::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
