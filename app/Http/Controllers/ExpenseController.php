<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //handle the data as list of json
         $data = $request->json()->all();
            //loop through the data but validate first
            foreach ($data as $expenseData) {
                //validate the data
                $validator = Validator::make($expenseData, [
                    'name' => 'required',
                    'amount' => 'required|integer',
                    'category' => 'required',
                    'notes' => 'required',
                ]);
                //if validation fails return error message
                if ($validator->fails()) {
                    return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
                }
                //create new expense
                $expense = new Expense($expenseData);
                //save the expense
                $expense->save();
                //collect the saved expense
                $expenses[] = $expense;
            }

            //return success message with the saved expense
            return response()->json(['message' => 'Expense created successfully', 'expenses' => $expenses], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //get all expense records
        $expenses = Expense::latest()->paginate(20);
        $allExpenses = Expense::all();
        //return expense view with the records
        return view('expense', ['expenses' => $expenses, 'allExpenses' => $allExpenses]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
