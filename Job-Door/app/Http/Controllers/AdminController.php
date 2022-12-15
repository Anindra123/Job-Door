<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;

use App\Http\Requests\InterviewProposalValidation;
use App\Models\InterviewProcess;
use App\Models\InterviewProposal;
use App\Models\Job_Seeker;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobProvider;
use App\Models\JobVacency;
use App\Models\ProposalPhaseModel;
use App\Models\UserModel;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;

class AdminController extends Controller
{
    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');

        $admin = new AdminModel();

        $login = $admin->where('email', $credentials['email'])
            ->where("password", $credentials['password'])->first();

        if (empty($login)) return response()->json("Invalid Credentials. Try again", 400);



        return response()->json("sucess", 200);
    }

    public function approve($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();

        $pphase = new ProposalPhaseModel();
        $tech = new InterviewProcess();
        $t = $tech->where('id', $id)->first();

        $t['status'] = 'APPROVED';

        $t->save();

        return response()->json(['res' => $t['status']]);
    }

    public function getProposals()
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();

        $pphase = new ProposalPhaseModel();
        $tech = new InterviewProcess();
        $tech = $tech->get();
        $lst = [];
        foreach ($tech as $t) {
            $pphase = $pphase->where("id", $t->jv_id)->first();

            $jv = $jv->where('id', $pphase->job_post_id)->first();
            $jp = $jp->where('id', $pphase->jp_id)->first();

            $c['comp'] = $jv->company_name;
            $c['name'] = $jp->fname . ' ' . $jp->lname;
            $c['title'] = $jv->job_title;
            $c['proposal'] = $t;
            array_push($lst, $c);
        }

        return response()->json(['res' => $lst]);
    }
}
