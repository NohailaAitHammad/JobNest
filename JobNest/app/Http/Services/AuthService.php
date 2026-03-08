<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register($request, $role)
    {
        //dd($request);
        $validatedCondidat = $request->validated();
        $validatedCondidat['role_id'] = $role;
        return User::create([
            'firstName' => $validatedCondidat['firstName'],
            'lastName' => $validatedCondidat['lastName'],
            'email' => $validatedCondidat['email'],
            'password' => Hash::make($validatedCondidat['password']),
            'role_id' => $role,
            'status' => 'active',
            ]);
    }

    public function  login($request)
    {
        $validatedUser = $request->validated();
        if(Auth::attempt($request->only('email', 'password'))){
            if(auth()->user()->role_id === 1){
                return 'admin';
            }else if(auth()->user()->role_id === 2){
                return 'recruter';
            }else if(auth()->user()->role_id === 3){
                return 'condidat';
            }else{
                return 'user';
            }
        }
        return 'inconue';
    }

}
