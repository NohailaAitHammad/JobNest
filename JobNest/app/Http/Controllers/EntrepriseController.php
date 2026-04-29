<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\EntreRequest;
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
