<?php

namespace App\Http\Controllers;

use App\Models\CVModel;
use App\Models\Job_Seeker;
use App\Models\job_seeker_feedback;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobProvider;
use App\Models\JobVacency;
use App\Models\Portfolio;
use App\Models\ServiceModel;
use App\Models\SkillModel;
use App\Models\UserModel;
use App\Models\WorkExperienceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

use Laravel\Sanctum\PersonalAccessToken;

class InterviewHistoryController extends Controller
{
    public function get()
    {
        return view('interviewhistory');
    }

    public function getHistory()
    {
        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();
        $jobProvider = new JobProvider();
        $u = new UserModel();
        $pr = new Portfolio();
        $jvc = new Job_Vacency_Candidate();

        $feedback = new job_seeker_feedback();


        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];
        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $f = $feedback->where('job_seeker_id', $uid)->get();

        $lst = [];

        foreach ($f as $i) {
            $post = $jv->where('id', $i->job_post_id)->first();
            $c['position'] = $post->job_title;
            $c['company'] = $post->company_name;
            $c['phase'] = $i->phase;
            $c['feedback'] = $i->feedback;
            $c['status'] = $i->status;
            array_push($lst, $c);
        }
        return response()->json(['res' => $lst]);
    }
}
