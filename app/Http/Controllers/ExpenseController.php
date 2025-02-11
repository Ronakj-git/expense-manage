<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ExpenseController extends Controller
{
    public function Expense()
    {
       if(Auth::user()){
           return view('add_expense');
       }else{
           return redirect()->route('login')->with('error-msg','You need to login first');
       }

    }

    public function addExpense(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'description' => 'required',
            'category' => 'required',
            'date' => 'required'
        ]);

        $expensedate = Carbon::parse($validatedData['date'])->format('Y-m-d');

        $expense = Expense::create([
            'user_id' => auth()->id(),
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'date' => $expensedate
        ]);

        $totalExpense = Expense::where('user_id', auth()->id())->sum('amount');

        return response()->json([
            'expense' => $expense,
            'totalExpense' => $totalExpense
        ]);
    }

    public function viewExpense()
    {
        $expenses = Expense::where('user_id', Auth::id())->get()->map(function ($expense) {
            $expense->date = Carbon::parse($expense->date)->format('F j, Y');
            return $expense;
        });

        $totalExpense = Expense::where('user_id', Auth::id())->sum('amount'); // Calculate the total expense
        return response()->json([
            'expenses' => $expenses,
            'totalExpense' => $totalExpense,
        ]);

    }
}
