<?php

namespace App\Http\Services;

use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;

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
}
