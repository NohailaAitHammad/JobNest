<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DomaineRequest;
use App\Http\Resources\DomaineResource;
use App\Http\Services\DomaineService;
use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    private DomaineService $domaineService;

    /**
     * @param DomaineService $domaineService
     */
    public function __construct(DomaineService $domaineService)
    {
        $this->domaineService = $domaineService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaines = $this->domaineService->getAllDomaines();
        return response()->json([
            "success" => true,
            "message" => "Liste des domaines",
            "data" =>  DomaineResource::collection($domaines)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DomaineRequest $request)
    {
        $domaine = $this->domaineService->addDomaine($request);
        return response()->json([
            "success" => true,
            "message" => "Domaine cree avec success",
            "data" => new DomaineResource($domaine)
        ], 201);
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
    public function update(DomaineRequest $request, Domaine $domaine)
    {
        $this->domaineService->updateDomaine($request, $domaine);
        return response()->json([
            "success" => true,
            "message" => "Domaine modifier avec success",
            "data" => new DomaineResource($domaine)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $this->domaineService->delete($domaine);
        return response()->json([
            "success" => true,
            "message" => "Domaine cree avec success",
            "data" => new DomaineResource($domaine)
        ]);
    }
}
