<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacencyValidation;
use App\Models\JobVacency;
use App\Models\UserModel;
use Illuminate\Http\Request;

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

    public function showForm()
    {
        return view('jobvacencyCreate');
    }

    public function submitForm(JobVacencyValidation $req)
    {

        $res = $req->validated();
        $jv = new JobVacency();
        $u = new UserModel();
        $user = $u->where('id', session()->get('uid'))->first();
        // $jobVac = $jv->where('id', $user->profile_id)->first();

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
}
