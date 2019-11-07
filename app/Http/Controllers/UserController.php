<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_USER');
    }

    public function index()
    {
        return view('user.home');
    }

    public function page1()
    {
        return view('user.page1');
    }
    
}

