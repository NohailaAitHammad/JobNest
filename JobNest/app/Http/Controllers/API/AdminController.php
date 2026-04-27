<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Services\AdminService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    private AdminService $adminService;

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users= $this->adminService->getUsers();
        return response()->json([
            "success" => true,
            "message" => "Liste des utilisateurs",
            "data" => UserResource::collection($users)
        ]) ;

    }


    public function Toggle(Request $request, User $user)
    {
        $this->adminService->toggleUserStatus($user);
        return response()->json([
            "success" => true,
            'message' => "Utilisateur {$user->status}"
        ]);
    }

    public function stats()
    {
        $stats = $this->adminService->getStats();
        return response()->json([
            "success" => true,
            'message' => "Statistique de la platform",
            "data" => $stats
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->adminService->deleteUser($user);
        return response()->json([
            "success" => true,
            'message' => "Utilisateur bien Supprimer "
        ]);
    }

    public function dashboard()
    {
        $user= Auth::user();
      return view('admin.dashboard', compact('user'));
    }

}
