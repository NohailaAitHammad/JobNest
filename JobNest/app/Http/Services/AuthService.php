<?php

namespace App\Http\Services;

use App\Enums\RoleUser;
use App\Enums\StatusUser;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Candidat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use const http\Client\Curl\AUTH_ANY;

class AuthService
{

    public function register($request, $role)
    {
        $validatedCondidat = $request->validated();
        $user = User::create([
            'firstName' => $validatedCondidat['firstName'],
            'lastName' => $validatedCondidat['lastName'],
            'email' => $validatedCondidat['email'],
            'password' => Hash::make($validatedCondidat['password']),
            'role_id' => $role,
            'status' => StatusUser::active,
            ]);
        return $user;
    }

    public function  login(LoginRequest $request)
    {
        $data = $request->validated();
        if(Auth::attempt($data)){
            return Auth::user();
        }
            return false;
    }

}
