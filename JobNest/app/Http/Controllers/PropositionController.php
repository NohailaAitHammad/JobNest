<?php

namespace App\Http\Controllers;

use App\Http\Services\PropositionService;
use App\Models\Proposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropositionController extends Controller
{

    private PropositionService $propositionService;

    public function __construct(PropositionService $propositionService)
    {
        $this->propositionService = $propositionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $propositions = $this->propositionService->getAllPropositionReceivedByCandidat($user);

            return view('candidat.propositions.index', compact('propositions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
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
    public function show(Proposition $proposition)
    {
        try {
            if ($proposition->candidat_id !== Auth::id()) {
                abort(403, 'Action non autorisée');
            }

            return view('candidat.propositions.show', compact('proposition'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function accepter(Proposition $proposition)
    {
        try {
            $this->propositionService->accepte($proposition);
            return redirect()->route('candidats.propositions.index')->with('success', 'Vous avez accepté la proposition !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function refuser(Proposition $proposition)
    {
        try {
            $this->propositionService->refuser($proposition);
            return redirect()->route('candidats.propositions.index')->with('success', 'Vous avez refusé la proposition.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
