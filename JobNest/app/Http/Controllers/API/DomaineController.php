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
        return view('admin.domaines.index', compact('domaines'));
    }


    public function create()
    {
        return view('admin.domaines.create');
    }

    public function store(DomaineRequest $request)
    {
        $domaine = $this->domaineService->addDomaine($request);
       return redirect()->route('admin.domaines.index')->with('success', "Domaine ajouté !");
    }

    public function edit(Domaine $domaine)
    {
        return view('admin.domaines.edit', compact('domaine'));
    }

    public function update(DomaineRequest $request, Domaine $domaine)
    {
        $this->domaineService->updateDomaine($request, $domaine);
        return redirect()->route('admin.domaines.index')->with('success', "Domaine mis à jour !");
    }

    public function destroy(Domaine $domaine)
    {
        $this->domaineService->delete($domaine);
        return redirect()->route('admin.domaines.index')->with('success', "Domaine supprimé !");
    }
}
