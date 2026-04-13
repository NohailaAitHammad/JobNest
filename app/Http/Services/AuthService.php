<?php

namespace App\Http\Services;

use App\Http\Requests\LoginRequest;
use App\Models\Candidat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register($request, $role)
    {
        $validatedCondidat = $request->validated();
        $validatedCondidat['role_id'] = $role;
        $user = User::create([
            'firstName' => $validatedCondidat['firstName'],
            'lastName' => $validatedCondidat['lastName'],
            'email' => $validatedCondidat['email'],
            'password' => Hash::make($validatedCondidat['password']),
            'role_id' => $role,
            'status' => 'active',
            ]);
        $token = $user->createToken('my_app_token')->plainTextToken;
        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function  login(LoginRequest $request)
    {
        $data = $request->validated();
        if(Auth::attempt($data)){
            if($request->user()->role->role === "recruter" ){
                $recruter = $request->user();
                $token  = $recruter->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $recruter,
                    'token' => $token
                ];
            }else if($request->user()->role->role === "condidat" ){
                $condidat = $request->user();
                $token  = $condidat->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $condidat,
                    'token' => $token
                ];
            }else {
                $admin = $request->user();
                $token  = $admin->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $admin,
                    'token' => $token
                ];
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects',
            ], 401);

        }
    }

}
