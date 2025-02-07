<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of expenses to be exported
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Expense::where('user_id', auth()->id())
        -> select('Amount','Description','Category','Date')
        ->get();
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
             'Amount', 'Description','Category', 'Date'];
    }
}
