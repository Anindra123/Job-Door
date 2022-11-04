<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getForm()
    {
        return view('services');
    }

    public function submitForm(ServiceRequest $sr, $id = null)
    {
        $service_val = $sr->validated();

        $s_model = new ServiceModel();
        $s_model->service_title = $service_val['stitle'];
        $s_model->service_description = $service_val['servicedesc'];
        $s_model->pr_id = session()->get('prid');

        $s_model->save();

        return redirect('portfolio');
    }
    public function updateFormShow($id = null)
    {

        $s_model = new ServiceModel();
        $model = $s_model->where('id', $id)->first();
        return view(
            'updateServices'
        )->with('val', $model);
    }
    public function updateForm(ServiceRequest $sr, $id = null)
    {
        $s_model = new ServiceModel();
        $service_val = $sr->validated();
        $model = $s_model->where('id', $id)->first();
        $model->service_title = $service_val['stitle'];
        $model->service_description = $service_val['servicedesc'];
        $model->pr_id = session()->get('prid');
        $model->save();

        return view(
            'updateServices',
            ['sucess' => 'Services update sucessfully', 'val' => $model]
        );
    }

    public function deleteForm($id = null)
    {
        $s_model = new ServiceModel();

        $s_model->where('id', $id)->delete();

        return redirect('portfolio');
    }
}
