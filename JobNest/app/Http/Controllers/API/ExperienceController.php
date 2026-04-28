<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\ExperienceService;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    private ExperienceService $experienceService;


    public function __construct(ExperienceService $experienceService)
    {
        $this->experienceService = $experienceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profileCandidat = $user->profileCandidat;
        $experiences = $this->experienceService->listExperiences($profileCandidat);

        return view('candidat.experiences.index', compact('experiences'));
    }

    public function create()
    {
       return view('candidat.experiences.create');
    }


    public function store(ExperienceRequest $request)
    {
        $profileCandidat = Auth::user()->profileCandidat;
        $this->experienceService->createExperience($request, $profileCandidat);
        return redirect()->route('candidats.experience.store')->with('success', 'Expérience ajoutée avec succès !');
    }

    /*
     * Display the specified resource.
     */
    public function show( ProfileCandidat $profileCandidat, Experience $experience)
    {
        $experience = $this->experienceService->showExperience($experience, $profileCandidat );
        return  view('candidat.experiences.show', compact('experience'));
    }

    public function edit(Experience $experience)
    {
        if ($experience->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403, 'Action non autorisée');
        }
        return view('candidat.experiences.edit', compact('experience'));
    }
    public function update(ExperienceRequest $request, Experience $experience)
    {
        if ($experience->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403);
        }
        $profileCandidat = Auth::user()->profileCandidat;
        $this->experienceService->updateExperience($request, $experience,$profileCandidat);
        return redirect()->route('candidats.experiences.index')->with('success', 'Expérience mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Experience $experience)
    {
        if ($experience->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403);
        }
        $profileCandidat = Auth::user()->profileCandidat;
        $this->experienceService->deleteExpereince($profileCandidat,$experience);
        return redirect()->route('candidats.experiences.index')->with('success', 'Experience est bien supprimer avec success');
    }
}
