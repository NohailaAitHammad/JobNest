<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService  $authService)
    {
        $this->authService = $authService;
    }

    public function showSignUpCondidiat(){

        return view('auth.register.signUpCondidat');

    }
    public function showSignUpRecruter(){
        return view('auth.register.signUpRecruter');
    }

    public  function showLogin()
    {
        return view('auth.login');

    }

    public function registerCondidat(RegisterRequest $request)
    {
        $role = Role::where('role', 'condidat')->first();
        $user = $this->authService->register($request, $role->id);
        //dd($user);
        return redirect()->route('condidat.dashboard');
    }

    public function registerRrecruter(RegisterRequest $request)
    {
        $role = Role::where('role', 'recruter')->first();
        $user = $this->authService->register($request, $role->id);
        return redirect()->route('recruter.dashboard');
    }

    public function login(LoginRequest $request)
    {
        //dd($request);
        $user = $this->authService->login($request);
        //dd($x);
        if($user === 'admin'){
            return redirect()->route('admin.dashboard');
        }else if($user === 'recruter'){
            return redirect()->route('recruter.dashboard');
        }else if($user === 'condidat'){
            return redirect()->route('condidat.dashboard');
        }else{
            return back();
        }


    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
