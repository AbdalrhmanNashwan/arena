<?php

namespace App\Http\Controllers;

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
        $validator = Validator::make($request->all(), [
            '*.game_type' => 'required',
            '*.device_number' => 'required|integer',
            // Add validation rules for other fields
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

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
        //return session by paginate
        $sessionsDevices = Gsessions::paginate(20);
        $itemNames = Gsessions::all();
        $itemQuantities = Gsessions::all();

        return view('home', compact('sessionsDevices', 'itemNames', 'itemQuantities'));
    }
    public function update(Request $request, $noteId)
    {}
    public function destroy($noteId)
    {}
public function allSessions(){
//return all sessions by paginate
    $sessions = Gsessions::paginate(20);
    $allSessions = Gsessions::all();
    return view('sessions', compact('sessions', 'allSessions'));
}


}
