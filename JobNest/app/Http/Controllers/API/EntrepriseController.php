<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntrepriseResource;
use App\Http\Services\EntrepriseService;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{

    private EntrepriseService $entrepriseService;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entreprises = $this->entrepriseService->getAllEntreprises();
        return response()->json([
            "success" => true,
            "message" => "Liste des entreprises",
            "data" => EntrepriseResource::collection($entreprises)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntreRequest $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
