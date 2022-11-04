<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\CVModel;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Job_Seeker;
use App\Models\ServiceModel;
use App\Models\SkillModel;
use App\Models\UserModel;
use App\Models\WorkExperienceModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class PortfolioController extends Controller
{

    public function showPortfolioInfo()
    {
        $p = new Portfolio();
        // $js = new Job_Seeker();
        $sk = new SkillModel();
        $wk = new WorkExperienceModel();
        $sl = new ServiceModel();
        $cv = new CVModel();
        $u = new UserModel();

        if (session()->has('uid')) {
            $uid = session()->get('uid');
            // $user = $js->where('id', $uid)->first()
            $val = $u->where('id', $uid)->first();;
            $port = $p->where('js_id', $val->profile_id)->first();
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
                return view('portfolio')
                    ->with('port', $port->portfolio_title)
                    // ->with('un', $user->uname)
                    ->with('sk_list', $skillList)
                    ->with('cv_path', $path)
                    ->with('wk_list', $workExpList)
                    ->with('s_list', $servicesList);
            }
            if (session()->has('prid')) session()->forget('prid');
            return view('portfolio');
        }
    }

    public function showPortfolioForm()
    {
        return view('createPortfolio');
    }



    public function createPortfolio(Request $req)
    {
        $pr = new Portfolio();

        $u = new UserModel();
        $this->validate(
            $req,
            ['prtitle' => 'required|max:20'],
            [
                'prtitle.required' => 'Portfolio title cannot be empty',
                'prtitle.max' => 'Portfolio title can be max 20 characters'
            ]
        );
        $val = $u->where('id', session()->get('uid'))->first();
        $pr->portfolio_title = $req->prtitle;
        // $pr->js_id = session()->get('uid');
        $pr->js_id = $val->profile_id;

        $pr->save();

        return redirect('portfolio');
    }

    public function showUpdatePortfolioForm()
    {
        $p = new Portfolio();
        $js = new Job_Seeker();

        $u = new UserModel();


        if (session()->has('uid')) {
            $uid = session()->get('uid');
            $val = $u->where('id', $uid)->first();
            $user = $js->where('id', $val->profile_id)->first();
            $port = $p->where('js_id', $val->profile_id)->first();

            if (!empty($port)) {

                return view('updatePortfolio')
                    ->with('port', $port->portfolio_title);
            } else {

                return view('updatePortfolio');
            }
        }
    }

    public function updatePortfolio(Request $req)
    {
        $pr = new Portfolio();
        $u = new UserModel();
        $uid = session()->get('uid');
        $val = $u->where('id', $uid)->first();
        $upr = $pr->where('js_id', $val->profile_id)->first();
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
        $u = new UserModel();
        $uid = session()->get('uid');
        $val = $u->where('id', $uid)->first();
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();
        if (!empty($file)) {
            if (Storage::disk('local')->exists($file->cv_file_path)) {

                unlink(storage_path('app/' . $file->cv_file_path));
            }
        }

        if (session()->has('prid')) session()->forget('prid');
        $p->where('js_id', $val->profile_id)->delete();
        return view('portfolio');
    }
}
