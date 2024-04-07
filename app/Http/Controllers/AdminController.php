<?php

namespace App\Http\Controllers;
use App\Models\User;  // Importing the User model

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){
        return view('admin.index');
    }

    // Method to fetch all users and display them in a list
    public function usersList(Request $request){

        $users=User::all();  // Fetching all users from the database
        
        return view('admin.users_list',compact('users'));  // Passing users data to the view
    }
    

    // Method to change the status of a user (activate/deactivate)
    public function changeUserStatus(Request $request ,$id ,$status=1 ){
        
        $user=User::find($id);  // Finding the user by ID
        if(!empty($user)){
            $user->is_active=$status;  // Changing the status
            $user->save();              // Saving the changes to the database
            return redirect()->route('admin_user_list')->with('success','Deactivated');    // Redirecting back with success message
        }
        else{
            return redirect()->route('admin_user_list')->with('danger','oho');
        }

    }
    
}
