<?php


namespace App\Http\Controllers\store\login;

use App\Http\Controllers\store\BaseController;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class LoginController extends BaseController
{
    function loginIn(Request $request)
    {

        $array = [
            'username' => $request->input("username"),
            'password' => $request->input("password")
        ];

        $flag = Admin::guard()->attempt($array);

        if ($flag){

        }
    }

}