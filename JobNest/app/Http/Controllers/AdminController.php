<?php

namespace App\Http\Controllers;

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
        return view('admin.users.index', compact('users'));
    }


    public function toggle(Request $request, User $user)
    {
        $this->adminService->toggleUserStatus($user);
        return redirect()->back()->with('success', "Status de l'utilisateur mis à jour.");
    }

    public function show()
    {
        $user = Auth::user();
        $user->load(['role', 'profileCandidat.experiences', 'profileCandidat.certifications', 'profileCandidat.competences', 'profileRecruteur.entreprise.domaines']);

        return view('admin.profile.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $this->adminService->deleteUser($user);
        return redirect()->back()->with('success', "Utilisateur supprimé définitivement");
    }

    public function dashboard()
    {
        $user= Auth::user();
        $stats = $this->adminService->getStats();
      return view('admin.dashboard', compact('user', 'stats'));
    }

}
