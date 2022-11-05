<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use App\Models\JobProvider;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function show()
    {
        $u = new UserModel();
        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            return view('dashboard')->with('un', $user->uname);
        }
    }

    function showAdmin()
    {
        if (session()->has("uid")) {
            return view('adminDashboard');
        }
    }

    function showJobProvider()
    {
        $u = new UserModel();
        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $u->where('id', $name)->first();
            return view('dashboard')->with('un', $user->uname);
        }
    }
}
