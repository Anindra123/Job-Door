<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewProposalValidation;
use App\Models\InterviewProcess;
use App\Models\InterviewProposal;
use App\Models\Job_Seeker;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobProvider;
use App\Models\JobVacency;
use App\Models\ProposalPhaseModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;

class ProposalController extends Controller
{

    public function showProposal()
    {

        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $ip = new InterviewProposal();

        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();

        $applied = null;
        $post = $jv->where('jp_id', $jobProvider->id)->get();
        foreach ($post as $p) {

            $applied = $jvc->where('job_post_id', $p->id)->where('status', 'ACCEPTED')->get();
            $proposal = $ip->where('jv_id', $p->id)->first();
            if (count($applied) > 0) $p['clist'] = $applied;
            // dd($proposal);
            if (!empty($proposal)) $p['prop'] = $proposal;
        }

        // dd($post);


        return view('interviewPropsal', ['jobs' => $post]);
    }


    public function getForm()
    {
        return view('interviewProposalCreate');
    }

    public function submitProposalPartial(Request $req)
    {
    }

    public function submitForm(InterviewProposalValidation $req, $jvid = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();


        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();
        $prop = $req->validated();
        $ip = new InterviewProposal();

        $ip->title = $prop['title'];
        $ip->venue = $prop['venue'];
        $ip->stime = $prop['stime'];
        $ip->etime = $prop['etime'];
        $ip->date = $prop['date'];
        $ip->type = $prop['type'];
        $ip->platform = $prop['platform'] ?? null;
        $ip->link = $prop['link'] ?? null;
        $ip->duration = $prop['duration'] ?? null;
        $ip->notes = $prop['notes'] ?? null;
        $ip->jv_id = $jvid;
        $ip->jp_id = $jobProvider->id;
        $ip->save();
        return redirect('showInterviewProposal');
    }

    public function updateFormShow($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();
        $propsal = new InterviewProposal();
        $ip = $propsal->where('jp_id', $jobProvider->id)->first();
        return view('updateInterviewProposal')->with('val', $ip);
    }

    public function updateForm(InterviewProposalValidation $req)
    {
        $prop = $req->validated();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();
        $propsal = new InterviewProposal();
        $ip = $propsal->where('jp_id', $jobProvider->id)->first();



        $ip->title = $prop['title'];
        $ip->venue = $prop['venue'];
        $ip->stime = $prop['stime'];
        $ip->etime = $prop['etime'];
        $ip->date = $prop['date'];
        $ip->platform = $prop['platform'];
        $ip->link = $prop['link'];
        $ip->type = $prop['type'];
        $ip->duration = $prop['duration'];
        $ip->notes = $prop['notes'];

        $ip->save();

        return view(
            'updateInterviewProposal',
            ['sucess' => 'Interview proposal updated sucessfully', 'val' => $ip]
        );
    }

    public function deleteInterviewProposal()
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();
        $propsal = new InterviewProposal();
        $propsal->where('jp_id', $jobProvider->id)->delete();

        return redirect('showInterviewProposal');
    }

    public function fullProposalView()
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();

        $propsal = new InterviewProposal();

        $prop = $propsal->get();

        $lst = [];
        foreach ($prop as $p) {
            $jobProvider = $jp->where('id', $p->jp_id)->first();
            $user = $u->where('profile_id', $jobProvider->id)->first();
            $post = $jv->where('id', $p->jv_id)->first();
            $c['mail'] = $user->mail;
            $c['position'] = $jobProvider->work_position;
            $c['post_title'] = $post->job_title;
            $c['post_id'] = $post->id;
            $c['id'] = $p->id;
            array_push($lst, $c);
        }


        return view('proposalview')->with('proposals', $lst);
    }

    public function viewProposal($id = null)
    {

        $propsal = new InterviewProposal();
        $prop = $propsal->where('id', $id)->first();

        $retHtml = view('viewProposal')->with('j', $prop)->render();

        return response()->json(['html' => $retHtml]);
    }

    public function getApprovedCandidates($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();

        $post = $jvc->where('job_post_id', $id)->where('approval', 'APPROVED')->get();

        if (!empty($post)) {
            $list = [];

            foreach ($post as $p) {
                $js = $jobS->where('id', $p->candidate_id)->first();

                array_push($list, $js);
            }

            return response()->json(['res' => $list]);
        }
        return response()->json(['res' => $post]);
    }

    public function saveProposalPhases(Request $req)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();
        $pphase = new ProposalPhaseModel();
        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('profile_id', $uid)->first();
        $jobP = $jp->where('id', $user->profile_id)->first();
        $pphase->job_post_id = $req['jv_id'];
        $pphase->num_of_phases = $req['num_of_phases'];
        $pphase->jp_id = $jobP->id;

        $pphase->save();

        return response()->json(['res' => true]);
    }

    public function getProposalPhaseByID($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();
        $pphase = new ProposalPhaseModel();
        // return response()->json($id);
        $lst = [];
        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('profile_id', $uid)->first();
        $jobP = $jp->where('id', $user->profile_id)->first();

        $pp = $pphase->where('jp_id', $jobP->id)->where('job_post_id', $id)->first();
        // return response()->json(['res' => $pp]);

        // foreach ($pp as $p) {
        //     $post = $jv->where('id', $p->job_post_id)->first();
        //     $c['post'] = $post->job_title;
        //     $c['num_of_phases'] = $p->num_of_phases;
        //     $c['id'] = $p->id;
        //     array_push($lst, $c);
        // }

        if (!empty($pp)) return response()->json(['res' => true]);
        return response()->json(['res' => false]);
    }
    public function getProposalPhase()
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();
        $pphase = new ProposalPhaseModel();

        $lst = [];
        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('profile_id', $uid)->first();
        $jobP = $jp->where('id', $user->profile_id)->first();

        $pp = $pphase->where('jp_id', $jobP->id)->get();
        // return response()->json(['res' => $pp]);

        foreach ($pp as $p) {
            $post = $jv->where('id', $p->job_post_id)->first();
            $c['post'] = $post->job_title;
            $c['num_of_phases'] = $p->num_of_phases;
            $c['id'] = $p->id;
            array_push($lst, $c);
        }

        if (!empty($pp)) return response()->json(['res' => $lst]);
        return response()->json(['res' => []]);
    }

    public function saveProposal(Request $req)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();

        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('profile_id', $uid)->first();
        $jobP = $jp->where('id', $user->profile_id)->first();

        $tech = new InterviewProcess();
        if ($req['type'] === 'TECH') {

            $tech['jp_id'] = $jobP->id;
            $tech['title'] = $req['title'];
            $tech['description'] = $req['description'];
            $tech['stime'] = $req['stime'];
            $tech['etime'] = $req['etime'];
            $tech['date'] = $req['date'];
            $tech['question'] = $req['question'];

            $tech['jv_id'] = $req['id'];
            $tech->save();
        }



        return response()->json(['res' => true]);
    }

    public function getInterviewProposal($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $jvc = new Job_Vacency_Candidate();
        $jobS = new Job_Seeker();

        $token = explode('|', Crypt::decrypt(Cookie::get('token'), false))[1];

        $tokenID = PersonalAccessToken::where('token', $token)->first();
        $uid = $tokenID->tokenable->id;

        $user = $u->where('profile_id', $uid)->first();
        $jobP = $jp->where('id', $user->profile_id)->first();

        $tech = new InterviewProcess();

        $t = $tech->where('jv_id', $id)->where('jp_id', $jobP->id)->first();

        if (!empty($t)) return response()->json(['res' => $t, 'type' => 'TECH']);
        return response()->json(null);
    }
}
