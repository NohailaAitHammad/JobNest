<?php

namespace App\Http\Services;

use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;
use App\Models\ProfileCandidat;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompetenceService
{

    public function getAllCompetences()
    {
        return Competence::all();
    }

    public function addCompetence(CompetenceRequest $request)
    {
        return Competence::create($request->validated());
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
        $competence->update($request->validated());
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
        $profileCandidat->competences()->sync($validated['competences']);
        return true;
    }

    public function removeCompetence( ProfileCandidat $profileCandidat, Competence $competence )
    {
        try {
            $profileCandidat->competences()->findOrFail($competence->id);
        }catch (NotFoundHttpException $exception){
            throw new  $exception;
        }
        $profileCandidat->competences()->detach($competence->id);
        return $profileCandidat->load(["competences", "experiences", "certifications"]);
    }
}
