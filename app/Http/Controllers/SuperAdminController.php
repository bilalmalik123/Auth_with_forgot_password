<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class SuperAdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_SUPERADMIN');
    }

    
     public function index()
    {

        $user_id = Auth::user()->id;

        $data  = DB::SELECT("SELECT ru.role_id, ru.user_id, r.name as role_name, u.name as user_name 
                             FROM role_user ru
                             LEFT JOIN roles r
                             ON ru.role_id = r.id 
                             LEFT JOIN users u
                             ON u.id = ru.user_id
                             where ru.user_id = $user_id");

        //print_r($data);
        return view('superadmin.home')->with("datas", $data);

        // return view('superadmin.home',$data);

        // return view('superadmin.home', compact('data'));

    }


    public function page1()
    {
        return view('superadmin.page1');
    }
}
