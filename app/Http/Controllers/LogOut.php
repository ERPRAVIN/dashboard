<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;

class LogOut extends Controller
{
    public function userLogOut(Request $request)
    {

        Session::flush();
        return redirect('/');
    }
}