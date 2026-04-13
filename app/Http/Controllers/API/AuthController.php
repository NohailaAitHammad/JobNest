<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use App\Models\Role;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private AuthService $authService;
    public function __construct(AuthService  $authService)
    {
        $this->authService = $authService;
    }

    public function registerCondidat(RegisterRequest $request)
    {
        $role = Role::where('role', 'condidat')->first();
        $data = $this->authService->register($request, $role->id);
        return response()->json([
            "success" => true,
            "message" => "Inscription d'un condidat avec success",
            "data" => $data["user"],
            "token" => $data["token"]
        ]);
    }
    public function registerRrecruter(RegisterRequest $request)
    {
        $role = Role::where('role', 'recruter')->first();
        $data = $this->authService->register($request, $role->id);
        return response()->json([
            "success" => true,
            "message" => "Inscription d'un condidat avec success",
            "data" => $data["user"],
            "token" => $data["token"]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request);
        return response()->json([
            "success" => true,
            "message" => "Connexion avec success",
            "data" => $data["user"],
            "token" => $data["token"]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => "Déconnexion reussie"
        ]);
    }
}
