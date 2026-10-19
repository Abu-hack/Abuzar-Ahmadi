<?php

namespace App\Http\Controllers;

// Import the classes needed in this controller.
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register a new user.
    public function register(Request $request)
    {
        // Check if the name, email, and password are valid.
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user.
        $user = new User();

        // Save the user's name and email.
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Encrypt the password before saving it.
        $user->password = Hash::make($data['password']);

        // Save the user in the database.
        $user->save();

        // Send the user to the login page with a success message.
        return redirect()->route('login')
            ->with('success', 'Account created. Please log in.');
    }

    // Log in an existing user.
    public function login(Request $request)
    {
        // Check that the email and password were entered.
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check the user's email and password.
        $accepted = Auth::attempt($credentials);

        // If the login details are wrong, show an error.
        if (! $accepted) {
            return back()->withErrors([
                'email' => 'Email or password is incorrect.',
            ])->onlyInput('email');
        }

        // Create a new session ID after successful login.
        $request->session()->regenerate();

        // Send the user to the dashboard.
        return redirect()->intended(route('dashboard'));
    }

    // Log out the current user.
    public function logout(Request $request)
    {
        // Log the user out.
        Auth::logout();

        // Clear the current session.
        $request->session()->invalidate();

        // Create a new security token for future requests.
        $request->session()->regenerateToken();

        // Return the user to the login page.
        return redirect()->route('login');
    }
}
