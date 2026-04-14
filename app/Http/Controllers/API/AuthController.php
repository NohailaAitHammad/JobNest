<?php

namespace App\Http\Controllers\API;

use App\Enums\StatusUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use App\Http\Services\CandidatService;
use App\Http\Services\RecruteurService;
use App\Models\ProfileCandidat;
use App\Models\Role;
use App\enums\RoleUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller
{

    private AuthService $authService;
    private CandidatService $candidatService;
    private RecruteurService $recruteurService;
    public function __construct(AuthService  $authService, CandidatService $candidatService, RecruteurService $recruteurService)
    {
        $this->authService = $authService;
        $this->candidatService = $candidatService;
        $this->recruteurService = $recruteurService;
    }

    public function registerCondidat(RegisterRequest $request)
    {
        $role = Role::where('role', RoleUser::candidat)->first();
        $data = $this->authService->register($request, $role->id);
        $candidatProfile = $this->candidatService->createProfileCandidat($data['user']);
        return response()->json([
            "success" => true,
            "message" => "Inscription d'un candidat avec success",
            "data" => new ProfileCandidatResource($candidatProfile),
            "token" => $data["token"]
        ]);
    }
    public function registerRrecruter(RegisterRequest $request)
    {
//        $role = Role::where('role', RoleUser::recruteur)->first();
//        $data = $this->authService->register($request, $role->id);
//        $this->recruteurService->createProfileRecruteur($data['user']);
//        return response()->json([
//            "success" => true,
//            "message" => "Inscription d'un recruteur avec success",
//            "data" => UserResource::collection($data["user"]),
//            "token" => $data["token"]
//        ]);
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
