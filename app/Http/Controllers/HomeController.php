<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use View;

class HomeController extends Controller
{
    public function home(){
        return view('layouts.index');
    }
    public function search(){
        return view('layouts.search');
    }
    public function myprofile(){
        return view('layouts_profile.myprofile');
    }
    public function mysetting(){
        return view('layouts_profile.setting');
    }
    public function register(){
        return view('layouts.register');
    }
    public function login(){
        return view('layouts.login');
    }
    public function forgot_password(){
        return view('layouts.forgot_password');
    }
    public function advertise(){
        return view('layouts.advertise');
    }
    public function privacy_policy(){
        return view('layouts.privacy-policy');
    }
    public function create_business(){
        $category = Category::All();
        return view('layouts.create_business',compact('category'));
    }
}
