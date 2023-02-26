<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //this is for call toastr css
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }//end method


    public function Profile()
    {
        //after the user login, so we can get the uer id
        $id = Auth::user()->id;
        //if we want to use authentication from User database
        //we should use User model that declate on top
        $adminData = User::find($id);
        //after we get the id from user
        //then we can lempar it to compact method
        return view('admin.admin_profile_view', compact('adminData'));
        
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;

        }

        $data->save();

        //this is for call toastr css
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }//end method

    public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }//end method

    public function UpdatePassword(Request $request)
    {

    }//end method

}
