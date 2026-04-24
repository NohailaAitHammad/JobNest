<?php

namespace App\Http\Services;

use App\Http\Requests\DomaineRequest;
use App\Models\Domaine;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DomaineService
{

    public function getAllDomaines()
    {
        return Domaine::all();
    }

    public function addDomaine(DomaineRequest $request)
    {
        $validated = $request->validated();
        return Domaine::create($validated);
    }

    public function updateDomaine(DomaineRequest $request, Domaine $domaine)
    {
        try {
            Domaine::findOrFail($domaine->id);
        }catch (NotFoundHttpException $exception){
            throw new $exception;
        }
        $validated = $request->validated();
        return $domaine->update($validated);
    }

    public function delete(Domaine $domaine)
    {
        try {
            Domaine::findOrFail($domaine->id);
        }catch (NotFoundHttpException $exception){
            throw new $exception;
        }
        return $domaine->delete();
    }
}
