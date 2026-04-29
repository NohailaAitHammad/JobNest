<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Http\Services\CertificationService;
use App\Models\Certification;
use Illuminate\Support\Facades\Auth;

class CertificatController extends Controller
{
    private CertificationService $certificationService;

    /**
     * @param CertificationService $certificationService
     */
    public function __construct(CertificationService $certificationService)
    {
        $this->certificationService = $certificationService;
    }

    public function index()
    {
        $profileCandidat = Auth::user()->profileCandidat;
        $certifications = $this->certificationService->getAllCertification($profileCandidat);
        return view('candidat.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('candidat.certifications.create');
    }

    public function store(CertificationRequest $request)
    {
        $profileCandidat = Auth::user()->profileCandidat;
        $certification = $this->certificationService->addCertification($request, $profileCandidat);
        return redirect()->route('candidats.certifications.index')->with('success', 'Certification ajoutée avec succès !');
    }


    public function edit(Certification $certification)
    {
        if ($certification->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403, 'Action non autorisée');
        }

        return view('candidat.certifications.edit', compact('certification'));
    }
    public function update(CertificationRequest $request, Certification $certification)
    {
        if ($certification->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403);
        }
        $profileCandidat = Auth::user()->profileCandidat;
        $this->certificationService->updateCertification($request, $certification, $profileCandidat);
        return redirect()->route('candidats.certifications.index')->with('success', 'Certification mise à jour avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        if ($certification->profile_candidat_id !== Auth::user()->profileCandidat->id) {
            abort(403);
        }

        $profileCandidat = Auth::user()->profileCandidat;
        $this->certificationService->deleteCertification($certification, $profileCandidat);

        return redirect()->route('candidats.certifications.index')->with('success', 'Certification supprimée avec succès !');
    }
}
