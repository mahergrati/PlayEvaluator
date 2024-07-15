<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class Usercontroller extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function adduser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'birthday' => 'required',
            'cin' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        // Hachage du mot de passe
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            if (!$token = JWTAUth::attempt($credentials)) {
                return response()->json([
                    'Success' => false,
                    'Message' => 'Invalid Email or Password',
                ], 400);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'Success' => false,
                'Message' => 'Could not create token',
            ], 500);
        }
        return response()->json([
            'Success' => true,
            'token' => $token,
            'user_details'=>$credentials
        ]);
    }
}
