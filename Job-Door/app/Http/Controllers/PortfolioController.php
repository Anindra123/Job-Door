<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Job_Seeker;
use App\Models\SkillModel;
use App\Models\WorkExperienceModel;
use Illuminate\Support\Facades\Validator;



class PortfolioController extends Controller
{

    public function showPortfolioInfo()
    {
        $p = new Portfolio();
        $js = new Job_Seeker();
        $sk = new SkillModel();
        $wk = new WorkExperienceModel();


        if (session()->has('uid')) {
            $uid = session()->get('uid');
            $user = $js->where('id', $uid)->first();
            $port = $p->where('js_id', $uid)->first();

            if (!empty($port)) {
                $skills = $sk->where('pr_id', $port->id)->first();
                $workExpList = $wk->where('pr_id', $port->id)->get();
                $skillList = null;
                if (!empty($skills)) $skillList = explode(',', $skills->skill_list);
                session()->put("prid", $port->id);
                return view('portfolio')
                    ->with('port', $port->portfolio_title)
                    ->with('un', $user->uname)
                    ->with('sk_list', $skillList)
                    ->with('wk_list', $workExpList);
            }
            if (session()->has('prid')) session()->forget('prid');
            return view('portfolio')->with('un', $user->uname);
        }
    }

    public function showPortfolioForm()
    {
        return view('createPortfolio');
    }



    public function createPortfolio(Request $req)
    {
        $pr = new Portfolio();
        $this->validate(
            $req,
            ['prtitle' => 'required|max:20'],
            [
                'prtitle.required' => 'Portfolio title cannot be empty',
                'prtitle.max' => 'Portfolio title can be max 20 characters'
            ]
        );

        $pr->portfolio_title = $req->prtitle;
        $pr->js_id = session()->get('uid');

        $pr->save();

        return redirect('portfolio');
    }

    public function showUpdatePortfolioForm()
    {
        $p = new Portfolio();
        $js = new Job_Seeker();




        if (session()->has('uid')) {
            $uid = session()->get('uid');
            $user = $js->where('id', $uid)->first();
            $port = $p->where('js_id', $uid)->first();

            if (!empty($port)) {

                return view('updatePortfolio')
                    ->with('port', $port->portfolio_title)
                    ->with('un', $user->uname);
            } else {

                return view('updatePortfolio')->with('un', $user->uname);
            }
        }
    }

    public function updatePortfolio(Request $req)
    {
        $pr = new Portfolio();
        $uid = session()->get('uid');
        $upr = $pr->where('js_id', $uid)->first();
        $this->validate(
            $req,
            ['prtitle' => 'required|max:20'],
            [
                'prtitle.required' => 'Portfolio title cannot be empty',
                'prtitle.max' => 'Portfolio title can be max 20 characters'
            ]
        );

        $upr->portfolio_title = $req->prtitle;
        $upr->save();

        return view(
            'updatePortfolio',
            ['sucess' => 'Portfolio update sucessfully', 'port' => $upr->portfolio_title]
        );
    }

    public function deletePortfolio()
    {
        $p = new Portfolio();
        //$sk = new SkillModel();
        $uid = session()->get('uid');
        $p->where('js_id', $uid)->delete();

        if (session()->has('prid')) session()->forget('prid');
        return view('portfolio');
    }
}
