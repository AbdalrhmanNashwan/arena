<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\Gsessions;
use Illuminate\Http\Request;

class dashBoardController extends Controller
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
    public function show()
    {
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Return all sessions for the current month and year
        $sessionsDevices = Gsessions::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        $uniqueDates = $sessionsDevices->unique('date');


        // Return monthly expenses for the current month and year
        $monthlyExpenses = Expense::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        // Return monthly debts for the current month and year
        $monthlyDebts = Debt::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();


        // Return the total cost for every game type for the current month
        $totalCost = [];
        foreach ($sessionsDevices as $session) {
            $totalCost[$session->game_type] = isset($totalCost[$session->game_type])
                ? $totalCost[$session->game_type] + $session->total_cost
                : $session->total_cost;
        }
        arsort($totalCost);
        $totalCostCollection = collect($totalCost);

        $currentMonthIncome = $uniqueDates->sum('cost_after_promo');
        $currentMonthDebts = $monthlyDebts->sum('amount');
        $currentMonthExpenses = $monthlyExpenses->sum('amount');
        $currentMonthNet = $currentMonthIncome - $currentMonthDebts - $currentMonthExpenses;

        return view('home', compact('sessionsDevices', 'monthlyExpenses',  'monthlyDebts', 'totalCostCollection', 'currentMonthIncome', 'currentMonthDebts', 'currentMonthExpenses', 'currentMonthNet'));
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
