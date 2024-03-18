<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "email" => "required|email|unique:users",
                "password" => "required|confirmed"
            ]);

            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfully"
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    // Login API (POST, formdata)
    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            // Auth Facade
            if(Auth::attempt([
                "email" => $request->email,
                "password" => $request->password
            ])){

                $user = Auth::user();

                $token = $user->createToken("myToken")->accessToken;

                return response()->json([
                    "status" => true,
                    "message" => "Login successful",
                    "access_token" => $token
                ]);
            }

            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ], 422);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function profile()
    {
        $userdata = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    // Logout API (GET)
    public function logout()
    {
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
