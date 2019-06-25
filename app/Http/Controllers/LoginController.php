<?php

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends Controller
{
    //登录
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $name = Input::get('Username');
            return redirect('/blog-admin/index?uid='.$name);

        }
        return view('admin_login');

    }



}
