<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    function show()
    {
        $js = new Job_Seeker();

        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $js->where('id', $name)->first();
            return view('profile')->with('up', $user);
        }
        //  else {
        //     return view('login')->with('err', 'User is not validated. Try again');
        // }
    }

    function updateProfile()
    {
        $js = new Job_Seeker();
        if (session()->has('uid')) {
            $name = session()->get('uid');
            $user = $js->where('id', $name)->first();
            return view('update')->with('profile', $user);
        }
        // else {
        //     return view('login')->with('err', 'User is not validated. Try again');
        // }
    }

    function update(Request $req)
    {
        $this->validate($req, [
            'fname' => 'required|max:20', 'lname' => 'required|max:20',
            'curr_occup' => 'required|max:20',
        ], [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'curr_occup.required' => 'Please select your current occupation'
        ]);

        $js = new Job_Seeker();
        $uid = session()->get('uid');
        $js->where('id', $uid)->update([
            'fname' => $req->fname,
            'lname' => $req->lname, 'current_occupation' => $req->curr_occup
        ]);

        return view('update')->with('msg', 'Profile updated sucessfully');
    }
}
