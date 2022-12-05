<?php

namespace App\Http\Controllers;

use App\Models\CVModel;
use App\Models\Job_Seeker;
use App\Models\JobProvider;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    function show()
    {
        $js = new Job_Seeker();
        $u = new UserModel();

        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            $details = $js->where('id', $user->profile_id)->first();
            return view('profile')->with('up', $user)->with('ud', $details);
        }
    }

    function showJobProviderProfile()
    {
        $js = new JobProvider();
        $u = new UserModel();

        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            $details = $js->where('id', $user->profile_id)->first();
            return view('jobProviderProfile')->with('up', $user)->with('ud', $details);
        }
    }

    function updateProfile()
    {
        $js = new Job_Seeker();
        $u = new UserModel();
        if (session()->has('uid')) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            $details = $js->where('id', $user->profile_id)->first();
            return view('update')->with('profile', $details);
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
        $u = new UserModel();
        $uid = session()->get('uid');
        $user = $u->where('id', $uid)->first();
        $profile = $js->where('id', $user->profile_id)->first();
        $profile->fname = $req->fname;
        $profile->lname = $req->lname;
        $profile->current_occupation = $req->curr_occup;
        $profile->save();
        return view('update')->with('msg', 'Profile updated sucessfully')
            ->with('profile', $profile);
    }

    function deleteProfile()
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();
        if (!empty($file)) {
            if (Storage::disk('local')->exists($file->cv_file_path)) {

                unlink(storage_path('app/' . $file->cv_file_path));
            }
        }
        $js = new Job_Seeker();
        $u = new UserModel();
        $uid = session()->get('uid');
        $user = $u->where('id', $uid)->first();
        $js->where('id', $user->profile_id)->delete();
        $user->delete();
        return redirect('logout');
    }
}
