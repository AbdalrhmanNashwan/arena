<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Facades\JWTAuth;
//
//class AuthController extends Controller
//{
//    public function login(Request $request)
//    {
//        return back()->withInput()->withErrors(['error' => 'Invalid credentials']);
////        // Validate the request data
////        $validator = Validator::make($request->all(), [
////            'email' => 'required|email',
////            'password' => 'required',
////        ]);
////
////        if ($validator->fails()) {
////            return view('failed');
////        }
////
////        $credentials = $request->only('email', 'password');
////
////        // Check if the user exists and is active
////        $user = User::where('email', $credentials['email'])->first();
////
////
////        // Attempt authentication and generate a JWT token
////        try {
////            if (!$token = JWTAuth::attempt($credentials)) {
////                return view('failed');
////            }
////        } catch (JWTException $e) {
////            return view('failed');
////        }
////
////        // Return user details and the JWT token in the response
////        return view('home');
//    }
//    public function register(Request $request)
//    {
//        // Validate the request data
//        $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//        ]);
//
//        // Create a new user
//        $user = new User;
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = Hash::make($request->password);
//        $user->save();
//
//        // Redirect to a success page or login.blade.php page
//        return response()->json([
//            'message' => 'User created successfully',
//            'user' => $user,
//        ], 201);
//    }
//}
