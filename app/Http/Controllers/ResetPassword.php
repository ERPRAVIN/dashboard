<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;
use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function update(Request $request)
    {
 
        $res=$request->validate([
        'password'       => 'required|min:6|max:10',
        'newpassword'       => 'required|min:6|max:10',
        'confirmpassword'   => 'required|same:newpassword|min:6|max:10'
        ]); 
           
        


        $current_user=auth()->user();      //to get authenticated user
        if(Hash::check($request->password,$current_user->password)){
            $current_user->update([
                'password'=>Hash::make($request->newpassword)
            ]);
            $successMsg='Your Password change Successfully.';
            $productArr=Product::all();
            return redirect()->route('dashboard')->with(compact('successMsg','productArr'));
        }else{
            return redirect()->back()->with('fail','Your Password does\'t match.');
        } 
    }
    
}