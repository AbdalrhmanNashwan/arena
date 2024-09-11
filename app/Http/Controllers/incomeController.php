<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\Gsessions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class incomeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::today();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::today()->endOfDay();
        $tableToShow = $request->input('table', 'sessions');

        // Fetch all session data within the range
        $allSessions = Gsessions::whereBetween('date', [$startDate, $endDate])->get();
        $uniqueSessions = $allSessions->unique('date');


        $totalBarCost = $allSessions->sum('bar_cost');
        $totalIncome = $uniqueSessions->sum('cost_after_promo'); // Total income from unique sessions

        $totalPlayingCost=$totalIncome-$totalBarCost;

        $totalDebts = Debt::whereBetween('date', [$startDate, $endDate])->sum('amount');
        $totalExpenses = Expense::whereBetween('date', [$startDate, $endDate])->sum('amount');

        // Net Income calculation might need to account for total income rather than playing cost
        $totalNetIncome = $totalIncome - $totalDebts - $totalExpenses;

        // Fetch and paginate the selected table
        $itemsQuery = [
            'sessions' => Gsessions::whereBetween('date', [$startDate, $endDate]),
            'debts' => Debt::whereBetween('date', [$startDate, $endDate]),
            'expenses' => Expense::whereBetween('date', [$startDate, $endDate])
        ][$tableToShow];

        $items = $itemsQuery->paginate(10);
        $items->appends($request->except('page'));

        return view('income', compact(
            'items',
            'tableToShow',
            'totalPlayingCost',
            'totalBarCost',
            'totalDebts',
            'totalExpenses',
            'totalNetIncome'
        ));
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
