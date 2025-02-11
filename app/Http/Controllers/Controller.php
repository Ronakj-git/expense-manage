<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Mail\registermail;
use App\Models\User;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function Dashboard()
    {

        if(Auth::user()){


        $UserId=auth()->id();

        // total expenses of logged in user
        $amount=Expense::where('user_id', $UserId)
        ->sum('amount');

        // $amount = $amount ?? 0;

        //total amount on top category
        $maxamount = Expense::select('category', DB::raw('SUM(amount) as total_amount'))
        ->where('user_id', $UserId)
        ->groupBy('category')
        ->orderbydesc('total_amount')
        ->first();

        // $maxamount = $maxamount ?? 0;

        //for bar chart making
        $category = Expense::select('category', DB::raw('SUM(amount) as total_amount'))
        ->where('user_id', $UserId)
        ->groupBy('category')
        ->get();

        $categories = $category->pluck('category');
        $amounts = $category->pluck('total_amount');


       // for recent expenses
        $recentExpenses = Expense::where('user_id', $UserId)
        ->orderByDesc('id')
        ->take(3)
        ->get();

        return view('Dashboard',compact('amount','maxamount','categories','amounts','recentExpenses'));
    }else{
        return redirect()->route('login')->with('error-msg','You need to login first');
    }
    }


    public function login()
    {
        return view('login');
    }



    public function loginsave(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && !$user->is_verified) {
            return redirect()->back()->with('error', 'Please verify your email before logging in.');
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('Dashboard')->with('loginsuccess','You have been logged in');

        }else{

            return redirect()->back()->with(['error' => 'Invalid login details']);
            }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logoutsuccess','You have been logged out');
    }

    public function register()
    {
        return view ('register');
    }

    public function registersave(Request $request)
    {
        $data=$request->validate([
            'username'=>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

       $user= User::create([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password' => Hash::make($data['password']),
            'verification_token'=>Str::random(32)
        ]);


        Mail::to($user->email)->queue(new registermail($user));

        if ($user) {
            return redirect()->route('login')->with('registersuccess', 'registered successfully');
        } else {
            return redirect()->back()->with('error', 'registration failed');
        }
    }

    public function verifyemail($token){
        // print_r($token);die();
       $user= User::where ('verification_token' , $token)->first();

       if(!$user){
        return redirect()->route('register')->with('verifyfail','invalid token');
       }

        $user->update([
            'is_verified' => true,
            'verification_token' => null,
        ]);
       return redirect()->route('login')->with('verifiedsuccess','verification done');
       }

    }



