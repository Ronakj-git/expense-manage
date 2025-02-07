<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{

    public function setting(){
        if(Auth::user()){
        $UserId =auth()->id();
        $users=User::all()->where('id', $UserId);
        return view('setting',compact('users'));
        }else{
            return redirect()->route('login')->with('error-msg','You need to login first');
        }
    }

    public function editprofile(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user=Auth()->id();
        $users= User::where('id', $user)->update([

            'username'=>$request->username


        ]);
        return response()->json(['success' => true, 'message' => 'Username updated successfully!']);
    }


}
