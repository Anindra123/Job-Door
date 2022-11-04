<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function show()
    {
        $js = new Job_Seeker();
        if (session()->has("uid")) {
            $name = session()->get('uid');
            $user = $js->where('id', $name)->first();
            return view('dashboard')->with('un', $user->uname);
        }
    }
}
