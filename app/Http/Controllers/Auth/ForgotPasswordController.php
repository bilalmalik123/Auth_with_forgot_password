<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\User;
use Mail;
use App\Mail\DemoMail;
use Redirect;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {

        try{
            $this->validate($request, ['email' => 'required|email']);
            
            $userModel = User::where('email', $request->only('email'))->first();

            // echo "<pre>";
            // print_r($userModel);

            // exit;

            if(empty($userModel))
            {

                return Redirect::to('password/reset')->with('message', "You've entered wrong email id or the email id does not exist.");
            }
            else
            {
                // echo "<pre>";
                // print_r($request->all());
                //$token =  bcrypt($request['_token']);
                //Mail::to($userModel->email)->send(new DemoMail($token, $userModel));

                $response = $this->broker()->sendResetLink(
                        $request->only('email')
                    );

                // print_r($response);
                // exit;
                return $response == Password::RESET_LINK_SENT
                                        ? $this->sendResetLinkResponse($response)
                                        : $this->sendResetLinkFailedResponse($request, $response);
            }
        }
        catch(Exception $e)
        {
            // $exception->getMessage();

            return Redirect::to('password/reset')->with('error', "Something went wrong");
        }
        
    }

    protected function sendResetLinkResponse($response)
    {
        return Redirect::to('/')->with('status', trans($response));
    }
}
