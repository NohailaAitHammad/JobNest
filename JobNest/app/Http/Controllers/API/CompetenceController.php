<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Http\Requests\CompetenceRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\CompetenceService;
use App\Models\Experience;
use App\Models\Competence;
use App\Models\ProfileCandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompetenceController extends Controller
{
    private CompetenceService $competenceService;

    public function __construct(CompetenceService $competenceService)
    {
        $this->competenceService = $competenceService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $profileCandidat = $user->profileCandidat;
            $allCompetences = $this->competenceService->getAllCompetences();
            return view('candidat.competences.index', compact('allCompetences', 'profileCandidat'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function addCompetence(Request $request)
    {
        $request->validate([
            "competences" => "required|array",
            "competences.*" => "exists:competences,id"
        ]);

        try {
            $profileCandidat = Auth::user()->profileCandidat;
            $this->competenceService->add($request, $profileCandidat);

            return redirect()->route('candidats.competences.index')
                ->with('success', 'Vos compétences ont été mises à jour !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }


    public function adminIndex()
    {
        $competences = $this->competenceService->getAllCompetences();
        return view('admin.competences.index', compact('competences'));
    }

    public function create()
    {
        return view('admin.competences.create');
    }


    public function store(CompetenceRequest $request)
    {
        try {
        $this->competenceService->addCompetence($request);
        return redirect()->route('admin.competences.index')->with('success', 'Compétence ajoutée !');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }

    }

    public function edit(Competence $competence)
    {
        return view('admin.competences.edit', compact('competence'));
    }


//    public function show(Competence $competence)
//    {
//    }


    public function update(CompetenceRequest $request, Competence $competence)
    {
        try {
        $this->competenceService->updateCompetence($request, $competence);
        return redirect()->route('admin.competences.index')->with('success', 'Compétence modifiée !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }


    public function destroy(Competence $competence)
    {
        try {
        $this->competenceService->deleteCompetence($competence);
        return redirect()->route('admin.competences.index')->with('success', 'Compétence supprimée !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
