<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|unique:users,email',
            'password'  => 'required|string|confirmed',
            'role'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'role'      => $request->input('role')
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validated();
        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('myapptoken')->plainTextToken;

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'check your email or password',
            ], 401);
        }
        return response()->json([
            'message' => 'Authenticated',
            'token' => $token
        ]);
    }
}
