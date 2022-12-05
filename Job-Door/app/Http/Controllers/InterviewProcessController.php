<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewProcessValidation;
use App\Models\InterviewProcess;
use App\Models\InterviewProposal;
use App\Models\Job_Seeker;
use App\Models\job_seeker_feedback;
use App\Models\Job_Vacency_Candidate;
use App\Models\JobProvider;
use App\Models\JobVacency;
use App\Models\technical_interview_submission;
use App\Models\UserModel;
use Illuminate\Http\Request;

class InterviewProcessController extends Controller
{
    public function showMenu()
    {
        $jobPost = new JobVacency();

        $ti = new InterviewProcess();
        $posts = $jobPost->get();
        foreach ($posts as $p) {
            $process = $ti->where('jv_id', $p->id)->first();

            if (!empty($process)) $p['interview'] = $process;
        }

        return view('interviewProcess')->with('jobs', $posts);
    }


    public function viewTechnicalInterviewForm($id = null)
    {

        $ti = new InterviewProcess();

        $jv = new JobVacency();

        $jobpost = $jv->where('id', $id)->first();

        return view('interviewProcessCreate');
    }

    public function updateTechnicalInterviewFormView($id = null)
    {
        $ti = new InterviewProcess();

        $jv = new JobVacency();

        $jobpost = $jv->where('id', $id)->first();

        $interview = $ti->where('jv_id', $jobpost->id)->first();

        return view('interviewProcessUpdate')->with('val', $interview);
    }

    public function submitTechnicalInterviewForm(InterviewProcessValidation $req, $id = null)
    {

        $res = $req->validated();

        $ti = new InterviewProcess();
        $proposal = new InterviewProposal();
        $jv = new JobVacency();

        $jobpost = $jv->where('id', $id)->first();
        $ti->title = $res['title'];
        $ti->stime = $res['stime'];
        $ti->etime = $res['etime'];
        $ti->date = $res['date'];
        $ti->description = $res['desc'];
        $ti->question = $res['ques'];
        $ti->jv_id = $jobpost->id;
        $ti->save();

        return redirect('showTechnical');
    }

    public function updateTechnicalInterviewForm(InterviewProcessValidation $req, $id = null)
    {
        $res = $req->validated();
        $interview = new InterviewProcess();
        $jv = new JobVacency();

        $jobpost = $jv->where('id', $id)->first();

        $ti = $interview->where('jv_id', $jobpost->id)->first();



        $ti->title = $res['title'];
        $ti->stime = $res['stime'];
        $ti->etime = $res['etime'];
        $ti->date = $res['date'];
        $ti->description = $res['desc'];
        $ti->question = $res['ques'];
        $ti->jv_id = $jobpost->id;

        $ti->save();


        return view(
            'interviewProcessUpdate',
            ['sucess' => 'Technical interview update sucessfully', 'val' => $ti]
        );
    }


    public function deleteTechnicalForm($id = null)
    {
        $interview = new InterviewProcess();

        $jv = new JobVacency();

        $jobpost = $jv->where('id', $id)->first();

        $interview->where('jv_id', $jobpost->id)->delete();

        return redirect('showTechnical');
    }

    public function approveProcess($id = null)
    {
        $interview = new InterviewProcess();


        $ti = $interview->where('id', $id)->first();

        $ti->status = 'APPROVED';
        $ti->save();

        return back();
    }

    public function declineProcess($id = null)
    {
        $interview = new InterviewProcess();


        $ti = $interview->where('id', $id)->first();

        $ti->status = 'DECLINED';
        $ti->save();

        return back();
    }

    public function viewTechnicalInterviewJP()
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobProvider = $jp->where('id', $user->profile_id)->first();

        $interview = new InterviewProposal();
        $it = $interview->where('jp_id', $jobProvider->id)->first();

        $process = new InterviewProcess();

        if (!empty($it)) {
            $pr = $process->where('jv_id', $it->jv_id)->get();

            return view('interviewProcessApproval')->with('job', $pr);
        }
        return view('interviewProcessApproval')->with('err', 'Please create a interview proposal first');
    }

    public function startProcess($id = null)
    {
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        // $jobProvider = $jp->where('id', $user->profile_id)->first();
        $ip = new InterviewProcess();
        $process = $ip->where('id', $id)->first();
        $process->status = 'Open';
        $process->save();
        $candidate = $jvc->where('job_post_id', $process->jv_id)->where('status', 'ACCEPTED')->get();
        foreach ($candidate as $c) {
            $tcs = new technical_interview_submission();
            $tcs->submitter_id = $c->candidate_id;
            $tcs->interview_id = $process->id;
            $tcs->provider_id = $c->provider_id;
            $tcs->save();
        }

        return redirect('showTechnical');
    }

    public function monitorProcess()
    {
        // $tcs = new technical_interview_submission();
        // $allSubmission = $tcs->get();
        // foreach ($allSubmission as $a) {
        // }
    }

    public function getAssessment()
    {
        $interview = new InterviewProcess();
        $tcs = new technical_interview_submission();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $user = $u->where('id', session()->get('uid'))->first();
        $jobSeeker = $js->where('id', $user->profile_id)->first();

        $u_tcs = $tcs->where('submitter_id', $jobSeeker->id)->first();
        if (!empty($u_tcs)) {
            $jobs = $interview->where('id', $u_tcs->interview_id)->first();
            return view('jobSeekerInterviewView')->with('val', $jobs)
                ->with('tcs', $u_tcs);
        }
        return view('jobSeekerInterviewView');
    }

    public function submitAssesment(Request $req)
    {
        // dd($req, $id);
        $interview = new InterviewProcess();
        $tcs = new technical_interview_submission();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();
        $u_tcs = $tcs->where('submitter_id', $req->input('id'))->first();

        $u_tcs->submission = $req->input('ans');
        $u_tcs->submission_time = date('H:i:s', time());
        $u_tcs->status = 'SUBMITTED';
        $u_tcs->save();

        // redirect('showInterview');
        return response()->json([
            'success' => true,
        ]);
    }


    public function showSubmissionList()
    {

        $interview = new InterviewProcess();
        $tcs = new technical_interview_submission();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();

        $submission = $tcs->get();
        $lst = [];
        foreach ($submission as $s) {
            $profile = $js->where('id', $s->submitter_id)->first();
            $user = $u->where('profile_id', $js->id)->first();
            $c['name'] = $profile->fname . ' ' . $profile->lname;
            $c['status'] = $user->status;
            $c['state'] = $s->status;
            $c['submission'] = $s->submission;
            $c['id'] = $s->id;
            array_push($lst, $c);
        }
        // dd($lst);
        return view('candidateApproval')->with('candidate', $lst);
    }

    public function hireInterviewCandidate($id = null)
    {
        $interview = new InterviewProcess();
        $tcs = new technical_interview_submission();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();

        $submission = $tcs->where('id', $id)->first();

        $submission->status = "HIRED";

        $submission->save();
        $feedback = new job_seeker_feedback();

        $feedback->job_seeker_id = $submission->submitter_id;
        $feedback->phase = 'Technical Interview';
        $feedback->status = 'ACCEPTED';
        $feedback->save();

        return back();
    }

    public function rejectInterviewCandidate($id = null)
    {
        $interview = new InterviewProcess();
        $tcs = new technical_interview_submission();
        $jv = new JobVacency();
        $jp = new JobProvider();
        $u = new UserModel();
        $js = new Job_Seeker();
        $jvc = new Job_Vacency_Candidate();

        $submission = $tcs->where('id', $id)->first();

        $submission->status = "REJECTED";

        $submission->save();
        $feedback = new job_seeker_feedback();

        $feedback->job_seeker_id = $submission->submitter_id;
        $feedback->phase = 'Technical Interview';
        $feedback->status = 'REJECTED';
        $feedback->feedback = "Need to improve technical skills";
        $feedback->save();

        return back();
    }
}
