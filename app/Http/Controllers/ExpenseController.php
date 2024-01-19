<?php

namespace App\Http\Controllers;

use App\Models\Debt;
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
    //create a function to store expense from web
    public function storeExpense(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'notes' => 'required|string',
        ]);

        // Create a new debt
        Expense::create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'category' => $request->input('category'),
            'notes' => $request->input('notes'),
            'date' => now(),
        ]);

        return back()->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //get all expense records
        $expenses = Expense::latest()->paginate(20);
        //sort expenses by date
        $expenses = Expense::orderBy('date', 'desc')->paginate(20);
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
    public function updateAmount(Request $request, string $id)
    {
        //validate the request
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer',
        ]);
        //if validation fails return error message
        if ($validator->fails()) {
            return back()->with('error', 'Validation failed');
        }
        //find the expense
        $expense = Expense::findOrFail($id);
        //update the expense amount
        $expense->amount = $request->amount;
        //save the expense
        $expense->save();
        //return success message
        return back()->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete expense
        $expense = Expense::findOrFail($id);
        $expense->delete();
        //return success message
        return back()->with('success', 'Expense deleted successfully.');
    }
}
