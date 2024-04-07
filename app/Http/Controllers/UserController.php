<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile(Request $request)
    {
        $user = auth()->user();  // Retrieve line items associated with the user
        $lineitems = LineItem::where("user_id", $user->id)->orderBy('id', 'DESC')->get();
        // Return the view with user profile data and line items
        return view('user_profile', compact('user', 'lineitems'));
    }
    //profile update
    public function userProfileUpdate(Request $request)
    {
        // Extract user profile update data from the request
        $requestData = $request->except(['token', 'method', 'regist']);
        // Find the authenticated user
        $user = User::find(auth()->user()->id);
        // Update the user profile
        $user->update($requestData);
// Flash success message and redirect back to user profile page
        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('user_profile');
    }
    //profile image update 
    public function userProfileImageUpdate(Request $request)
    {
        // Extract user profile image update data from the request
        $requestData = $request->except(['token', 'method', 'regist']);

        // Generate a unique image name
        $imgName = 'lv_' . rand() . '.' . $request->profile->extension();

        // Move the uploaded profile image to the profiles directory
        $request->profile->move(public_path('profiles/'), $imgName);

        // Update the user profile with the new image
        $requestData['profile'] = $imgName;
        $user = User::find(auth()->user()->id);
        $existingProfile = $user->profile;
        $user->update($requestData);

        // Delete the previous profile image
        $profileExists = public_path("profiles/$existingProfile");
        if (file_exists($profileExists)) {
            unlink("profiles/$existingProfile");
        }

        // Redirect back to user profile page with success message
        return redirect()->route('user_profile')->with('success', 'User profile image updated!');
    }
}
