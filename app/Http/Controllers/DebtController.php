<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DebtController extends Controller
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
        $debts = [];
        //loop through the data but validate first
        foreach ($data as $deptData) {
            //validate the data
            $validator = Validator::make($deptData, [
                'name' => 'required',
                'amount' => 'required|integer',
                'reason' => 'required',
            ]);
            //if validation fails return error message
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
            }
            //create new expense
            $deptData = new Debt($deptData);
            //save the expense
            $deptData->save();
            //collect the saved expense
            $debts[] = $deptData;
        }

        //return success message with the saved expense
        return response()->json(['message' => 'debts created successfully', 'debts' => $debts], 201);
    }
    //create a function to store debt from web
    public function storeDebt(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'reason' => 'required|string',

        ]);

        // Create a new debt
        Debt::create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'reason' => $request->input('reason'),
            'date' => now(),
        ]);

        return back()->with('success', 'Debt created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //get all expense records
        $debt = Debt::latest()->paginate(20);
        //make the paid recordes to be on bottom
        $debt = Debt::orderBy('paid', 'asc')->paginate(20);
        $allDebts = Debt::all();
        //return expense view with the records
        return view('debts', ['debts' => $debt, 'allDebts' => $allDebts]);
    }

    public function updatePaidStatus(Request $request, $debtId)
    {
        $debt = Debt::findOrFail($debtId);

        $debt->paid = $request->has('paid'); // Use boolean type casting
        $debt->paid_date = $debt->paid ? now() : null; // Set paid_date if paid, otherwise set to null
        $debt->save();

        return back()->with('success', 'Debt updated successfully.');
    }



    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $debt = Debt::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'reason' => 'required|string',
        ]);

        // Update the debt
        $debt->update($validatedData);

        // Return a response
        return response()->json(['message' => 'Debt updated successfully']);
    }
    public function updateAmount(Request $request, Debt $debt)
    {
        $debt->amount = $request->amount;
        $debt->save();

        return back()->with('success', 'Debt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();

        return back()->with('success', 'Debt deleted successfully.');
    }

}
