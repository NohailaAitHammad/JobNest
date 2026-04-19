<?php

namespace App\Http\Services;

use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;
use App\Models\ProfileCandidat;
use Illuminate\Http\Request;

class CompetenceService
{

    public function getAllCompetences()
    {
        return Competence::all();
    }

    public function addCompetence(CompetenceRequest $request)
    {
        $validated  = $request->validated();

        $competences = Competence::create($validated);

        return $competences;
    }

    public function showCompetence(Competence $competence)
    {
        try {
            Competence::findOrFail($competence->id);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $competence;
    }

    public function updateCompetence(CompetenceRequest $request, Competence $competence)
    {
        try {
            Competence::findOrFail($competence->id);
        }catch (\Exception $exception){
            throw $exception;
        }
        $validated = $request->validated();
        $competence->libelle = $validated['libelle'];
        $competence->save();
        return $competence;
    }

    public function deleteCompetence(Competence $competence)
    {
        try {
            Competence::findOrFail($competence->id);
        }catch (\Exception $exception){
            throw $exception;
        }

        return $competence->delete();

    }


    public function add(Request $request, ProfileCandidat $profileCandidat)
    {
        $validated = $request->validate([
            "competences" => "array",
            "competences.*" => "exists:competences,id"
        ]);
        $profileCandidat->competences()->sync($request->competences);
        return $profileCandidat->load(["competences", "experiences", "certifications"]);
    }

    public function removeCompetence( ProfileCandidat $profileCandidat, Competence $competence )
    {
        $profileCandidat->competences()->detach($competence->id);
        return $profileCandidat->load(["competences", "experiences", "certifications"]);
    }
}
