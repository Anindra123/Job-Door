<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function show()
    {
        return view('sendcontactmail');
    }


    public function sendMail(Request $req)
    {

        $c  = new ContactModel();


        $c->fname = $req->fname;
        $c->lname = $req->lname;
        $c->phone = $req->tel;
        $c->mail = $req->mail;
        $c->message = $req->message;

        $c->save();

        Mail::to('customercare@abc.com')->send(new ContactMail($c));
    }
}
