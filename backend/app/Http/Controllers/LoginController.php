<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function allUsers()
    {
        return User::all();
    }

    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed:confirmPassword',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function forgot_password(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;
        if (!User::where('email', $email)->first()) {
            return response()->json(['message' => 'Email not found'], 422);
        }
        
        $code = random_int(100000, 999999);
        
        session()->put('verify_email', $email);
        session()->put('verify_code', $code);
        \Log::info('Reset code is ' . $code);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => 'required|string|confirmed:confirmPassword',
        ]);
        $code = session()->get('verify_code');
        $email = session()->get('verify_email');
        if (!($email == $request->email && $code == $request->code)) {
            return response()->json(['message' => 'Invalid code'], 422);
        }
        else {
            $user = User::where('email', $email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            $request->session()->forget(['verify_email', 'verify_code']);
            return response()->json(['message' => 'Password reset successfully'], 201);
        }
    }

    public function nologin()
    {
        return 'Please login';
    }
}
