<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function show()
    {
        $js = new Job_Seeker();
        $u = new UserModel();
        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            return view('dashboard')->with('un', $user->uname);
        }
    }
}
