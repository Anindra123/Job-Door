<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\SkillModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class SkillsController extends Controller
{
    public function showSkillForm()
    {
        return view('skills');
    }


    public function addSkill(SkillRequest $req)
    {
        $val = $req->validated();

        $sk = new SkillModel();

        $sk->skill_list = $val['skillsList'];
        $sk->pr_id = session()->get('prid');

        $sk->save();

        return redirect('portfolio');
    }

    public function updateSkillShow()
    {
        $sk = new SkillModel();
        $prid = session()->get('prid');
        $skill = $sk->where('pr_id', $prid)->first();

        return view('updateSkill')->with('sk_list', $skill->skill_list);
    }

    public function updateSkill(SkillRequest $req)
    {
        $val = $req->validated();
        $sk = new SkillModel();
        $prid = session()->get('prid');
        $skill = $sk->where('pr_id', $prid)->first();

        $skill->skill_list = $val['skillsList'];
        $skill->pr_id = $prid;

        $skill->save();
        return view(
            'updateSkill',
            ['sucess' => 'Skills update sucessfully', 'sk_list' => $skill->skill_list]
        );
    }

    public function deleteSkill()
    {
        $sk = new SkillModel();
        $prid = session()->get('prid');
        $sk->where('pr_id', $prid)->delete();
        return redirect('portfolio');
    }
}
