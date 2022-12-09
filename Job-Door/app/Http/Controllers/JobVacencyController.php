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

    public function manageCandidateList()
    {
        $jv = new JobVacency();
        $jobSeeker = new Job_Seeker();
        $jobProvider = new JobProvider();
        $u = new UserModel();
        $pr = new Portfolio();
        $jvc = new Job_Vacency_Candidate();

        $user = $u->where('id', session()->get('uid'))->first();

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
            array_push($lst, $c);
        }

        return view('manageJobVacency', ['candidate' => $lst]);
    }

    public function viewCandidatePortfolio($id = null)
    {
        $p = new Portfolio();
        // $js = new Job_Seeker();
        $sk = new SkillModel();
        $wk = new WorkExperienceModel();
        $sl = new ServiceModel();
        $cv = new CVModel();
        $u = new UserModel();
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
            session()->put("prid", $port->id);
            $rethtml = view('viewportfolio')
                ->with('port', $port->portfolio_title)
                ->with('sk_list', $skillList)
                ->with('cv_path', $path)
                ->with('wk_list', $workExpList)
                ->with('s_list', $servicesList)->render();
            return response()->json([
                'html' => $rethtml
            ]);
        }
        return response()->json([], 404);
    }

    public function acceptCandidateReq($id = null)
    {
        $jvc = new Job_Vacency_Candidate();

        $post = $jvc->where('id', $id)->first();

        $post->status = "ACCEPTED";

        $post->save();
        $feedback = new job_seeker_feedback();

        $feedback->job_seeker_id = $post->candidate_id;
        $feedback->phase = 'Screening Phase';
        $feedback->status = 'ACCEPTED';
        $feedback->save();
        return redirect('manageCandidate');
    }

    public function rejectCandidateReq($id = null)
    {
        $jvc = new Job_Vacency_Candidate();

        $post = $jvc->where('id', $id)->first();
        $jv = new JobVacency();
        $post->status = "REJECTED";
        $post->save();
        $job = $jv->where('id', $post->job_post_id)->first();
        $job->vacency_count = $job->vacency_count + 1;
        $job->save();
        $feedback = new job_seeker_feedback();

        $feedback->job_seeker_id = $post->candidate_id;
        $feedback->phase = 'Technical Interview';
        $feedback->status = 'REJECTED';
        $feedback->feedback = "Need to improve technical skills";
        $feedback->save();
        return redirect('manageCandidate');
    }
}
