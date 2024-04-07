<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthenticationController extends Controller
{
    // Method to display the registration form
    public function register(Request $request)
    {
        return view('register');
    }

    // Method to store user data after registration
    public function storeUser(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'email' => 'required|email|unique:users,email', // unique rule checks if the email doesn't already exist in the database
            'password' => 'required|min:4',
        ], [
            'email.unique' => 'The email has already been taken.', // Custom error message for unique constraint
        ]);
    
        // Create a new user instance
        $user = new User;
        $user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->password = Hash::make($request->input('password'));
        $user->email = $request['email'];
        $user->contact = $request['contact'];
        $user->gender = $request['gender'];
        $user->address = $request['address'];
    
        // Upload and save profile picture
        $imgName = 'lv_' . rand() . '.' . $request->file('profile')->getClientOriginalExtension();
        $request->file('profile')->move(public_path('profiles/'), $imgName);
        $user->profile = $imgName;
    
        $user->role_id = User::USER_ROLE; // Assign user role
        $user->save(); // Save user data
    
        return redirect()->route('login', [], 301)->with('success', 'User registered successfully');
    }
    

    // Method to display the login form
    public function login(Request $request)
    {
        return view('login');
    }

    // Method to authenticate user login
    // Method to authenticate user login
public function authenticate(Request $request)
{
    $credentials = $request->only('email', 'password'); // Get login credentials from request

    if (Auth::attempt($credentials)) { // Attempt to authenticate user
        if (auth()->user()->role_id == User::ADMIN_ROLE) { // Check if user is admin
            return redirect()->route('admin_home', [], 301); // Redirect admin to admin home
        } else {
            return redirect()->route('home', [], 301); // Redirect user to home
        }
    } else {
        return redirect()->route('login')->with('error', 'Invalid email or password'); // Redirect back to login with error message
    }
}

    // Method to display forget password form
    

    // Method to log out user
    public function logout(Request $request)
    {
        Session::flush(); // Clear session data
        Auth::logout(); // Log out user
        return redirect('login', 301); // Redirect to login page
    }
}
