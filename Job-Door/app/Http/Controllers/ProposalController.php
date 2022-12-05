<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewProposalValidation;
use App\Models\InterviewProposal;
use App\Models\Job_Seeker;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobProvider;
use App\Models\JobVacency;
use App\Models\UserModel;
use Illuminate\Http\Request;

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
}
