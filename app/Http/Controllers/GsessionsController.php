<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Gsessions;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class GsessionsController extends Controller
{

    public function index()
    {}
    public function  login(){
        return view('home');
    }
    public function store(Request $request)
    {


        $sessions = [];

        foreach ($request->json() as $sessionData) {
            $session = new Gsessions($sessionData);
            $session->save();
            $sessions[] = $session; // Collect saved sessions
        }

        return response()->json(['message' => 'Sessions created successfully', 'sessions' => $sessions], 201);
    }

    public function show()
    {

    }
    public function update(Request $request, string $id)
    {
        //update the session by id
        $session = Gsessions::find($id);
        $session->update($request->all());
        return back()->with('success', 'Session updated successfully.');
    }

    public function destroy($noteId)
    {
        //delete session by id
        $session = Gsessions::find($noteId);
        $session->delete();
        return back()->with('success', 'Session deleted successfully.');
    }
public function allSessions(){
//return all sessions by paginate
    $sessions = Gsessions::paginate(20);
    //sort sessions by date
    $sessions = Gsessions::orderBy('date', 'desc')->paginate(20);
    $allSessions = Gsessions::all();
    //return sessions by today
    $todaySessions = Gsessions::whereDate('date', now()->format('Y-m-d'))->get();
    //return sessions by month
    $monthSessions = Gsessions::where('date', '>=', now()->subDays(30))->get();
    return view('sessions', compact('sessions', 'allSessions', 'todaySessions', 'monthSessions'));
}


}
