<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use session;
use Illuminate\Http\Request;

class LogInController extends Controller
{
    public function userLogin(Request $request)
    {        
        // $request->validate([

        //     'email' => 'required|email',
        //     'password' => 'required|min:6|max:10',
        // ]); 
        // $credentials = $request->only('email', 'password');
        
        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('dashboard'); 
        // } 
        // else 
        // {
        //     return redirect()->back()->with('signin_fail','Invalid User');
        // }

        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('dashboard'); 
            }else{
                return redirect()->route('dashboard'); 
            }
        }else{
            return redirect()->back()->with('signin_fail','Email-Address And Password Are Wrong.');
        }
    }
}




