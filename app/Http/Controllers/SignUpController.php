<?php


namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;
use Hash;

class SignUpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'mobile' => 'required|numeric',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|max:10',
        ]);

        $user                = new User;
        $user->name          = $request->name;
        $user->mobile_no     = $request->mobile;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $res=$user->save();
        if($res){
            
        return redirect()->back()->with('success','You Have Registered Successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong');
        }

    }
}
