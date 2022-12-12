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



class JobVacencyController extends Controller
{

    public function get()
    {
        $jv = new JobVacency();
        $u = new UserModel();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobVac = $jv->where('jp_id', $user->profile_id)->get();
        if (count($jobVac) > 0) return view('jobvacency')->with('job', $jobVac);
        return view('jobvacency');
    }

    public function getJobVacencyList()
    {
        return JobVacency::all();
    }

    public function showForm()
    {
        return view('jobvacencyCreate');
    }

    public function getJobPost($id = null)
    {
        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();

        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();
        $js = $jobSeeker->where('id', $user->profile_id)->first();

        $jobVac = $jv->where('id', $id)->first();
        $candidate = $jvc->where('candidate_id', $js->id)->where('job_post_id', $id)
            ->first();

        return response()->json([
            'job' => $jobVac,
            'applied' => $candidate,
        ]);
    }

    public function searchList($search = null)
    {
        $jv = new JobVacency();
        $post = $jv->where('job_title', 'LIKE', '%' . $search . '%')->first();
        if (empty($post)) {
            $post  = JobVacency::all();
            return response()->json(['job' => $post]);
        }
        return response()->json(['job' => $post]);
    }

    public function submitForm(JobVacencyValidation $req)
    {

        $res = $req->validated();
        $jv = new JobVacency();
        $u = new UserModel();
        $user = $u->where('id', session()->get('uid'))->first();

        $jv->job_title = $res['jtitle'];
        $jv->job_type = $res['jtype'];
        $jv->company_name = $res['cname'];
        $jv->job_description = $res['jdesc'];
        $jv->salary =  $res['salary'];
        $jv->address = $res['addr'];
        $jv->job_location_type = $res['jltype'];
        $jv->vacency_count = $res['vcount'];
        $jv->jp_id = $user->profile_id;

        $jv->save();

        return redirect()->to('/vacency');
    }

    public function deletePost($id = null)
    {
        $jv = new JobVacency();
        $jv->where('id', $id)->delete();

        return redirect('/vacency');
    }

    public function showUpdateForm($id = null)
    {
        $jv = new JobVacency();
        $jobVac = $jv->where('id', $id)->first();

        return view('jobvacencyUpdate')->with('val', $jobVac);
    }


    public function updatePost(JobVacencyValidation $req, $id = null)
    {
        $res = $req->validated();

        $jv = new JobVacency();
        $u = new UserModel();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobVac = $jv->where('id', $id)->first();

        $jobVac->job_title = $res['jtitle'];
        $jobVac->job_type = $res['jtype'];
        $jobVac->job_description = $res['jdesc'];
        $jobVac->company_name = $res['cname'];
        $jobVac->salary = $res['salary'];
        $jobVac->address = $res['addr'];
        $jobVac->job_location_type = $res['jltype'];
        $jobVac->vacency_count = $res['vcount'];
        $jobVac->jp_id = $user->profile_id;

        $jobVac->save();

        return view('jobvacencyUpdate', [
            'val' => $jobVac,
            'sucess' => 'Post updated sucessfully'
        ]);
    }

    public function getCandidateJobPost()
    {

        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();
        $u = new UserModel();
        $pr = new Portfolio();
        $jvc = new Job_Vacency_Candidate();

        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();
        $js = $jobSeeker->where('id', $user->profile_id)->first();
        $port = $pr->where('js_id', $js->id)->first();
        $jobVac = $jv->get();
        $candidate = $jvc->where('candidate_id', $js->id)->get();

        return response()->json([
            'port' => $port,
            'job' => $jobVac,
            'applied' => $candidate,
        ]);
    }

    public function showCandidateJobPost()
    {
        // dd(session()->get('uid'));
        return view('applyJob');
    }

    public function applyVacantJob($id = null)
    {

        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();

        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();


        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();
        // $user = $u->where('id', session()->get('uid'))->first();
        $js = $jobSeeker->where('id', $user->profile_id)->first();
        $jobpost = $jv->where('id', $id)->first();
        $jobpost->vacency_count =  $jobpost->vacency_count - 1;

        $jobpost->save();

        $jvc->candidate_id = $js->id;
        $jvc->job_post_id = $jobpost->id;
        $jvc->provider_id = $jobpost->jp_id;
        $jvc->provider_id = $jobpost->jp_id;
        $jvc->approval = "PENDING";

        $jvc->save();

        return response()->json(['res' => true]);
    }

    public function declineVacantJob($id = null)
    {
        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();

        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();

        $job = $jv->where('id', $id)->first();

        $job->vacency_count = $job->vacency_count + 1;
        $job->save();

        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('id', $uid)->first();
        $js = $jobSeeker->where('id', $user->profile_id)->first();

        $jobpost = $jvc->where('job_post_id', $id)->where('candidate_id', $js->id)->first();
        $jobpost->delete();



        return response()->json(['res' => true]);
    }
}
