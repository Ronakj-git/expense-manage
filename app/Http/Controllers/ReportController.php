<?php

namespace App\Http\Controllers;

use App\Exports\ExpensesExport;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function report()
    {
        if(Auth::user()){
            $expenses = Expense::where('user_id', Auth::id())->get();
            return view('report',compact('expenses'));
        }else{
            return redirect()->route('login')->with('error-msg','You need to login first');
        }
     }

     public function filterExpenses(Request $request)
     {
        $query = Expense::where('user_id', auth()->id());

        // Apply date filter
        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        // Apply category filter
        if ($request->category){
            $query->where('category', $request->category);
        }

        // Apply exact amount filter
        if ($request->amount) {
            $query->where('amount', $request->amount);
        }

        $expenses = $query->get();

        return response()->json($expenses);
    }



        public function exportExpenses()
        {
            // You can add filters here if necessary
            // $expenses = Expense::where(...)->get();

            return Excel::download(new ExpensesExport, 'expenses.xlsx');
        }
    }


