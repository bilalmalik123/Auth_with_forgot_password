<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $token;
    protected $userModel;

    public function __construct($token, User $userModel)
    {
        //
        $this->token = $token;
        $this->userModel = $userModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $userEmail = $this->userModel->email;
        $userName = $this->userModel->name;
        $subject = 'Password Reset';

        return $this->view('emails.demo')
                    ->to($userEmail)
                    ->subject($subject)
                    ->with([
                            'token'   => $this->token,
                            'userEmail' => $userEmail,
                            'userName'  => $userName
                        ]);

        //return $this->view('view.name');
    }
}
