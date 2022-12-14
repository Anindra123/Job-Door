<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacencyValidation;
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

class ManageCandidateController extends Controller
{
    public function getView()
    {
        return view('manageJobVacency');
    }

    public function manageCandidateList()
    {
        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();
        $jobProvider = new JobProvider();
        $u = new UserModel();
        $pr = new Portfolio();
        $jvc = new Job_Vacency_Candidate();


        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];
        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();

        $jp = $jobProvider->where('id', $user->profile_id)->first();

        $post = $jvc->where('provider_id', $jp->id)->get();

        $lst = array();

        foreach ($post as $p) {
            $port = $pr->where('js_id', $p->candidate_id)->first();
            $profile = $jobSeeker->where('id', $port->js_id)->first();
            $ustatus = $u->where('profile_id', $profile->id)->first();
            $jobpost = $jv->where('id', $p->job_post_id)->first();

            $c['name'] = $profile->fname . ' ' . $profile->lname;
            $c['status'] = $ustatus->status;

            $c['position'] = $jobpost->job_title;
            $c['port'] = $port->id;
            $c['id']  = $p->id;
            $c['state'] = $p->status;
            $c['approval'] = $p->approval;
            array_push($lst, $c);
        }

        return response()->json(['res' => $lst]);
    }

    public function viewCandidatePortfolio($id = null)
    {
        $p = new Portfolio();
        // $js = new Job_Seeker();
        $sk = new SkillModel();
        $wk = new WorkExperienceModel();
        $sl = new ServiceModel();
        $cv = new CVModel();
        // $u = new UserModel();
        $port = $p->where('id', $id)->first();
        $path = null;
        $skillList = null;
        if (!empty($port)) {
            $skills = $sk->where('pr_id', $port->id)->first();
            $workExpList = $wk->where('pr_id', $port->id)->get();
            $servicesList = $sl->where('pr_id', $port->id)->get();
            $cv_path = $cv->where('pr_id', $port->id)->first();
            if (!empty($skills)) $skillList = explode(',', $skills->skill_list);
            if (!empty($cv_path)) $path = $cv_path->cv_file_path;
            // session()->put("prid", $port->id);
            // $rethtml = view('viewportfolio')
            //     ->with('port', $port->portfolio_title)
            //     ->with('sk_list', $skillList)
            //     ->with('cv_path', $path)
            //     ->with('wk_list', $workExpList)
            //     ->with('s_list', $servicesList)->render();
            $u_port['title'] = $port->portfolio_title;
            $u_port['skills'] = $skillList;
            $u_port['workExp'] = $workExpList;
            $u_port['cv_path'] = $path;
            $u_port['services'] = $servicesList;


            return response()->json([
                'res' => $u_port
            ]);
        }
        return response()->json([], 404);
    }

    public function acceptCandidateReq($id = null)
    {
        $jvc = new Job_Vacency_Candidate();

        $post = $jvc->where('id', $id)->first();

        $post->approval = "APPROVED";

        $post->save();
        $feedback = new job_seeker_feedback();

        $feedback->job_seeker_id = $post->candidate_id;
        $feedback->job_post_id = $post->job_post_id;
        $feedback->phase = 'SCR';
        $feedback->status = 'APPROVED';
        $feedback->save();

        return response()->json(['res' => true]);
    }

    public function rejectCandidateReq(Request $req)
    {

        $jvc = new Job_Vacency_Candidate();

        $post = $jvc->where('id', $req["id"])->first();
        $jv = new JobVacency();
        $post->approval = "REJECTED";
        $post->save();
        $job = $jv->where('id', $post->job_post_id)->first();
        $job->vacency_count = $job->vacency_count + 1;
        $job->save();

        $feedback = new job_seeker_feedback();
        $feedback->job_seeker_id = $post->candidate_id;
        $feedback->job_post_id = $post->job_post_id;
        $feedback->phase = 'SCR';
        $feedback->status = 'REJECTED';
        $feedback->feedback = $req['feedback'];
        $feedback->save();

        return response()->json(['res' => true]);
    }
}
