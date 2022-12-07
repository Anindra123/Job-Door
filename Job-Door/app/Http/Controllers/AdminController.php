<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');

        $admin = new AdminModel();

        $login = $admin->where('email', $credentials['email'])
            ->where("password", $credentials['password'])->first();

        if (empty($login)) return response()->json("Invalid Credentials. Try again", 400);


        return response()->json("sucess", 200);
    }
}
