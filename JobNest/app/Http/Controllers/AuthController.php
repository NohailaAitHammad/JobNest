<?php

namespace App\Http\Controllers;

use App\enums\RoleUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Resources\ProfileRecruteurResource;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use App\Http\Services\CandidatService;
use App\Http\Services\RecruteurService;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showRegisterCandidat()
    {
        return view('auth.register.signUpCondidat');
    }
    public function showRegisterRecruteur()
    {
        return view('auth.register.signUpRecruter');
    }

    public function registerCandidat(RegisterRequest $request)
    {
        $role = Role::where('role', RoleUser::candidat)->first();
        $user = $this->authService->register($request, $role->id);
        return redirect()->route('show.login');
    }
    public function registerRecruteur(RegisterRequest $request)
    {
        $role = Role::where('role', RoleUser::recruteur)->first();
        $user = $this->authService->register($request, $role->id);
        return redirect()->route('show.login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request);
        if ($user) {
            if ($user->role->role === RoleUser::recruteur) {
                $profileRecruteur = $this->recruteurService->createProfileRecruteur($user);
                return redirect()->route('recruteur.dashboard', $profileRecruteur);
            } else if ($user->role->role === RoleUser::candidat) {
                $candidatProfile = $this->candidatService->createProfileCandidat($user);
                return redirect()->route('candidat.dashboard',$candidatProfile);
            } else {
                    return redirect()->route('admin.dashboard',$user);
            }
        }
        return back()->with('error', "Erreur de Login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('show.login')->with('Déconnexion avec success');
    }
}
