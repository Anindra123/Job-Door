<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companyinfo;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;


class CompanyInfocontroller extends Controller
{


    function getCompanyinfo()
    {
        return view('Companyinfo');
    }


    public function updateCompanyifo()
    {
        $cf = new Companyinfo();
        $cfid = session()->get('cfid');
        $companyinfo = $cf->where('cf_id', $cfid)->first();


        $companyinfo->save();
        return view('companyInfo');
    }

    public function DeleteCompanyinfo()
    {
        $cf = new CompanyInfo();
        $cfid = session()->get('cfid');
        $companyinfo = $cf->where('cf_id', $cfid)->delete();

        $companyinfo->save();
        return view('companyInfo');
    }



    function showCompanyinfo(Request $req)
    {
        $this->validate($req, [
            'ctittle' => 'required|max:20', 'lname' => 'required|max:20',
            'cemail' => 'required|max:50|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users',
            'caddress' => 'required|max:100',
            'cwebsite' => 'required|max:50|regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i|unique:users',
            'cfbpage' => 'required|max:20',
            'cservice' => 'required|max:20',
        ], [
            'ctittle.required' => 'Company title is required',
            'caddress.required' => 'Last name is required',
            'cwebsite.required' => 'User invalied url ',
            'cemail.required' => "Must be company mail ",

            'cfbpage.required' => "page link  cannot be empty",
            'cservice.confirmed' => "Please say somthing about company",

        ]);

        $cf = new Companyinfo();

        $cf->ctittle = $req->cemail;
        $cf->cemail = $req->cemail;
        $cf->caddress = $req->caddress;
        $cf->cservice = $req->cservice;
        $cf->cwebsite = $req->cwebsite;
        $cf->cfbpage = $req->cfbpage;
        $cf->current_occupation = $req->curr_occup;

        $cf->save();



        return redirect('/companyInfo');
    }
}
