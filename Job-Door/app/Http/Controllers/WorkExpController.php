<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkExpRequest;
use App\Models\WorkExperienceModel;
use Illuminate\Http\Request;

class WorkExpController extends Controller
{
    //

    public function getForm()
    {
        return view('workExp');
    }

    public function submitForm(WorkExpRequest $req)
    {

        $val = $req->validated();

        $model = new WorkExperienceModel();

        $model->work_title = $val['wtitle'];
        $model->company_name = $val['cname'];
        $model->work_description = $val['workdesc'];
        $model->start_date = $val['stime'];
        $model->end_date = $val['etime'];
        $model->pr_id = session()->get('prid');

        $model->save();

        return redirect('portfolio');
    }

    public function deleteExp($id = null)
    {

        $model = new WorkExperienceModel();

        $model->where('id', $id)->delete();

        return redirect('portfolio');
    }


    public function updateFormShow($id = null)
    {
        // $val = $req->validated();

        $model = new WorkExperienceModel();

        $u_model = $model->where('id', $id)->first();


        return view('updateWorkExp')->with('val', $u_model);
    }

    public function updateForm(WorkExpRequest $req, $id = null)
    {
        $val = $req->validated();

        $model = new WorkExperienceModel();

        $u_model = $model->where('id', $id)->first();

        $u_model->work_title = $val['wtitle'];
        $u_model->company_name = $val['cname'];
        $u_model->work_description = $val['workdesc'];
        $u_model->start_date = $val['stime'];
        $u_model->end_date = $val['etime'];
        $u_model->pr_id = session()->get('prid');

        $u_model->save();

        return view(
            'updateWorkExp',
            ['sucess' => 'Work Experience update sucessfully', 'val' => $u_model]
        );
    }
}
