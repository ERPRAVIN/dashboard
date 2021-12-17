<?php

//reset passord using mai
//========================

// namespace App\Mail;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;
// use App\Http\Controllers\ForgotPasswordController;
// class SendMail extends Mailable
// {
//     public $details;
//     public function __construct($details)
//     {
//         $this->details =$details;       
//     }
//     /**
//      * Build the message.
//      *
//      * @return $this
//      */
//     public function build()
//     {
//     return $this->from("mail@vivanshinfotech.com", "Laravel")->subject('Password Reset Link')->view('email_reset');
//     }
// }


//job to send email

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ForgotPasswordController;
class SendMail extends Mailable
{
   
    public function __construct()
    {
         
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    return $this->from("mail@vivanshinfotech.com", "Email-job")->subject('job to send email')->view('myjob');
    }
}