<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        $role  = DB::SELECT("SELECT role_id, user_id from role_user where user_id = $user_id")[0];
        $role_id = $role->role_id;
        $user_id = $role->user_id;

        
        $data  = DB::SELECT("SELECT ru.role_id, ru.user_id, r.name as role_name, u.name as user_name 
                             FROM role_user ru
                             LEFT JOIN roles r
                             ON ru.role_id = r.id 
                             LEFT JOIN users u
                             ON u.id = ru.user_id
                             where ru.user_id = $user_id");
        
        try
        {
            if(count($data) < 0)
            {
                return view('user.page1')->with($data);
            }
            else
            {
                //super admin ko pehle check karo , then admin , then user
                $role_array = array();
                foreach ($data as $key => $value) {
                        $role = $value->role_name;
                        array_push($role_array , $role);
                }
               
               if (in_array("ROLE_SUPERADMIN", $role_array))
               {
                return redirect()->action('SuperAdminController@index')->with($data);
               }
               else if (in_array("ROLE_ADMIN", $role_array))
               {
                return redirect()->action('AdminController@index')->with($data);
               }
               else
               {
                // undefined role found, therefore user 
                return redirect()->action('UserController@index')->with($data);
               }
            }
        }
        catch(Exception $e)
        {
            report($e);
            return false;
        }

    }
}
