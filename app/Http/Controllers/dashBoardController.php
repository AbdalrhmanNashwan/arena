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
        // Return all sessions without paginate for the last 30 days
        $sessionsDevices = Gsessions::where('date', '>=', now()->subDays(30))->get();
        // Return monthly expenses for the last 30 days
        $monthlyExpenses = Expense::where('created_at', '>=', now()->subDays(30))->get();
        $monthlyDebts = Debt::where('created_at', '>=', now()->subDays(30))->get();

        $itemData = [];
        foreach ($sessionsDevices as $session) {
            $barItemsString = $session->bar_items;
            $items = explode('-', $barItemsString);
            foreach ($items as $item) {
                $itemParts = explode(' ', trim($item));
                if (count($itemParts) === 2) {
                    $quantity = intval($itemParts[0]);
                    $itemName = $itemParts[1];
                    $itemData[$itemName] = isset($itemData[$itemName])
                        ? $itemData[$itemName] + $quantity
                        : $quantity;
                }
            }
        }
        arsort($itemData);
        $itemDataCollection = collect($itemData);
        //return the total cost for every game type
        $totalCost = [];
        foreach ($sessionsDevices as $session) {
            $totalCost[$session->game_type] = isset($totalCost[$session->game_type])
                ? $totalCost[$session->game_type] + $session->total_cost
                : $session->total_cost;
        }
        arsort($totalCost);
        $totalCostCollection = collect($totalCost);

        return view('home', compact('sessionsDevices', 'monthlyExpenses', 'itemDataCollection', 'monthlyDebts', 'totalCostCollection'));
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
