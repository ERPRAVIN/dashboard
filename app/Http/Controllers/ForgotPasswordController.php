<?php
namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendMail;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class ForgotPasswordController extends Controller
{

    public function submitForgetPassword(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|exists:users', //validation to check email is exist in user table or not
        ]);

        // generate  and insert token in password_reset table
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $details = [
            'email' => $request->email,
            'token' => $token,
        ];

        Mail::to($request->email)->send(new SendMail($details));
        if (Mail::failures() != 0) {
            return view('login_page')->with('success', 'Password reset link has been sent to your email');
        }
        return redirect()->back()->with('Fail', 'Error to send email');
    }

    public function resetPasswordUsingMail(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'newpassword' => 'required|min:6|max:10',
            'confirmpassword' => 'required|same:newpassword|min:6|max:10',
        ]);
        // code to check token
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();
        // if token is not available
        if (!$updatePassword) {
            return dd('error:Invalid token!');
        } else {
            //code for if token matched change password
            $user = User::where('email', $request->email)->update(['password' => Hash::make($request->newpassword)]);
            DB::table('password_resets')->where(['email' => $request->email])->delete(); //to delete used token
            return
            view('login_page')->with('successMsg', 'Your Password change Successfully.');
            // dd('message Your password has been changed!');
        }
    }
    public function sendEmail()
    {
        $emailJob = (new SendEmailJob());
        dispatch($emailJob);

        echo 'email sent';
    }

}

// $request->validate([
//     'email' => 'required|email|exists:users',
// ]);

// $token = Str::random(64);

// DB::table('password_resets')->insert([
//     'email' => $request->email,
//     'token' => $token,
//     'created_at' => now()
// ]);

// Mail::to($request->email)->send(new SendMail( ['token' => $token]));
// if(Mail::failures() != 0) {
//     return back()->with('success', 'Success! password reset link has been sent to your email');
// }
// return back()->with('failed', 'Failed! there is some issue with email provider');
// }
