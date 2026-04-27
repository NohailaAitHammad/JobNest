<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCandidatRequest;
use App\Http\Requests\PropositionRequest;
use App\Http\Services\CandidatService;
use App\Http\Services\DashboardService;
use App\Http\Services\PropositionService;
use App\Models\Proposition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatController extends Controller
{
    private CandidatService $candidatService;
    private PropositionService $propositionService;
    private DashboardService $dashboardService;

    /**
     * @param CandidatService $candidatService
     */
    public function __construct(CandidatService $candidatService, PropositionService $propositionService, DashboardService $dashboardService)
    {
        $this->candidatService = $candidatService;
        $this->propositionService = $propositionService;
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('candidat.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        if (!$profileCandidat) {
            return redirect()->route('home')->with('error', 'Profil non trouvé.');
        }

        $profile = $this->candidatService->getProfile($profileCandidat);

        return view('candidat.show', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profileCandidat;
        if (!$profile) {
            return redirect()->route('home')->with('error', 'Profil non trouvé.');
        }
        return view('candidat.update', compact('user', 'profile'));

    }

    public function update(ProfileCandidatRequest $request)
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        $this->candidatService->updateProfile($request, $profileCandidat);

        return redirect()->back()->with('success', 'Profil Candidat modifié avec succès');
    }

    public function toggleVisibility(Request $request)
    {
        $user = Auth::user();
        $visible = $this->candidatService->toggleVisibility($user);

        $message = $visible ? "Visibilité du profil activée" : "Visibilité du profil désactivée";
        return redirect()->back()->with('success', $message);
    }

        public function uploadCV(ProfileCandidatRequest $request)
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        $this->candidatService->uploadCV($request, $profileCandidat);

        return redirect()->back()->with('success', 'CV importé avec succès');
    }
    public function uploadPortfolio(Request $request)
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        $this->candidatService->uploadPortfolio($request, $profileCandidat);

        return redirect()->back()->with('success', 'Portfolio importé avec succès');
    }
    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        $this->candidatService->uploadImage($request, $profileCandidat);

        return redirect()->back()->with('success', 'Image importée avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;

        $this->candidatService->deleteProfileCandidat($request, $profileCandidat);

        return redirect()->route('home')->with('success', 'Compte supprimé avec succès');
    }

    public function getAllPropositionReceivedByCandidat()
    {
        $propositions = $this->propositionService->getAllPropositionReceivedByCandidat(auth()->user());
        return view('candidat.propositions', compact('propositions'));
    }


    public function accepterProposition(PropositionRequest $propositionRequest,Proposition $proposition)
    {
        $this->propositionService->accepte($proposition);
        return redirect()->back()->with('success', 'Proposition acceptée');
    }

    public function refuserProposition(Proposition $proposition)
    {
        $this->propositionService->refuser($proposition);
        return redirect()->back()->with('success', 'Proposition refusée');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;
        $propositions = $this->propositionService->getAllPropositionReceivedByCandidat($user);

        // $stats = $this->dashboardService->candidateDashboard($profileCandidat);

        return view('candidat.dashboard', compact('user', 'profileCandidat', 'propositions'));
    }
}
