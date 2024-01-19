<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\Gsessions;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function show()
    {
        $allSessions = Gsessions::all();
        $allDebts = Debt::all();
        $allExpenses = Expense::all();

        //calculate total income
        $todayIncome = 0;
        $monthlyIncome = 0;

        $todaydebt = 0;
        $monthlydebt = 0;

        $todayExpense = 0;
        $monthlyExpense = 0;


        $todayDeviceIncome = 0;
        $monthlyDeviceIncome = 0;

        $todayBarIncome = 0;
        $monthlyBarIncome = 0;


        $monthlySessionsList = [];
        $monthlyDebtsList = [];
        $monthlyExpensesList = [];

        $yearlySessionsList = [];
        $yearlyDebtsList = [];
        $yearlyExpensesList = [];
        //calculate today income by date only
        foreach ($allSessions as $session) {
            $formattedDate = Carbon::parse($session->date);
            if ($formattedDate->isToday()) {
                $todayIncome += $session->cost_after_promo;
                $todayDeviceIncome += ($session->cost_after_promo - $session->bar_cost);
                $todayBarIncome += $session->bar_cost;

                //add session to today sessions list
                $todaySessionsList[] = $session;
            }
            if ($formattedDate->isCurrentMonth()) {
                $monthlyIncome += $session->cost_after_promo;
                $monthlyDeviceIncome += ($session->cost_after_promo - $session->bar_cost);
                $monthlyBarIncome += $session->bar_cost;
                $monthlyBarIncome += $session->bar_cost;
                //add session to monthly sessions list
                $monthlySessionsList[] = $session;
            }
            if ($formattedDate->isCurrentYear()) {
                //add session to yearly sessions list
                $yearlySessionsList[] = $session;
            }
        }

        //calculate today debt by date only
        foreach ($allDebts as $debt) {
            $formattedDate = Carbon::parse($debt->date);
            if ($formattedDate->isToday()) {
                $todaydebt += $debt->amount;
                //add debt to today debts list
                $todayDebts[] = $debt;
            }
            if ($formattedDate->isCurrentMonth()) {
                $monthlydebt += $debt->amount;
                //add debt to monthly debts list
                $monthlyDebtsList[] = $debt;
            }
            if ($formattedDate->isCurrentYear()) {
                //add debt to yearly debts list
                $yearlyDebtsList[] = $debt;
            }
        }

        //calculate today expense by date only
        foreach ($allExpenses as $expense) {
            $formattedDate = Carbon::parse($expense->date);
            if ($formattedDate->isToday()) {
                $todayExpense += $expense->amount;
                //add expense to today expenses list
                $todayExpenses[] = $expense;
            }
            if ($formattedDate->isCurrentMonth()) {
                $monthlyExpense += $expense->amount;
                //add expense to monthly expenses list
                $monthlyExpensesList[] = $expense;
            }
            if ($formattedDate->isCurrentYear()) {
                //add expense to yearly expenses list
                $yearlyExpensesList[] = $expense;
            }
        }


        //calculate today net income by date only
        $todayNetIncomeDevice = $todayIncome - $todaydebt - $todayExpense- $todayBarIncome;
        $todayNetIncome = $todayIncome - $todaydebt - $todayExpense;
        $monthlyNetIncome = $monthlyIncome - $monthlydebt - $monthlyExpense;
        $monthlyNetIncomeDevice = $monthlyIncome - $monthlydebt - $monthlyExpense;


        return view('income', compact('allSessions','todayNetIncome','monthlyNetIncomeDevice', 'todayIncome', 'monthlyIncome', 'todayDeviceIncome', 'monthlyDeviceIncome','todayDeviceIncome', 'todayBarIncome', 'monthlyBarIncome', 'todayNetIncomeDevice', 'monthlyNetIncome', 'todaydebt', 'monthlydebt', 'todayExpense', 'monthlyExpense', 'yearlySessionsList', 'yearlyDebtsList', 'yearlyExpensesList', 'monthlySessionsList', 'monthlyDebtsList', 'monthlyExpensesList'));
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
