<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobVacency;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;

class AppliedJobController extends Controller
{
    public function get()
    {
        $jv = new JobVacency();
        $jvc = new Job_Vacency_Candidate();

        $js = new Job_Seeker();
        $u = new UserModel();


        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();
        $js = $js->where('id', $user->profile_id)->first();


        $applied = $jvc->where("candidate_id", $js->id)->get();

        $lst = array();
        if (sizeof($applied) > 0) {


            foreach ($applied as  $p) {
                $a = $jv->where('id', $p->job_post_id)->first();
                $l['id'] = $a->id;
                $l['pos'] = $a->job_title;
                $l['comp'] = $a->company_name;
                $l['approval'] = $p->approval;
                array_push($lst, $l);
            }

            return response()->json(['res' => $lst]);
        }
        // return response()->json(['res' => $lst]);

        return response()->json([], 400);
    }

    public function getView()
    {
        return view('appliedjobs');
    }
}
