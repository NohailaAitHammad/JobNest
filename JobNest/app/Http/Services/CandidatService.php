<?php

namespace App\Http\Services;

use App\Http\Requests\ProfileCandidatRequest;
use App\Models\ProfileCandidat;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CandidatService
{
    public function getProfile(ProfileCandidat $profileCandidat)
    {
        return ProfileCandidat::where("id", $profileCandidat->id)->with(["user", "competences", "certifications", "experiences"])->first();
    }

    public function createProfileCandidat(User $user)
    {
        return (ProfileCandidat::create(['user_id' => $user->id]))->load(["user", "competences", "certifications", "experiences"]);
    }

    public function updateProfile(ProfileCandidatRequest $request, ProfileCandidat $profileCandidat)
    {
        $validated = $request->validated();
        $userData = [
            'firstName' => $validated['firstName'] ?? $profileCandidat->user->firstName,
            'lastName'  => $validated['lastName'] ?? $profileCandidat->user->lastName,
            'email'     => $validated['email'] ?? $profileCandidat->user->email,
        ];
        $profileCandidat->user->update($userData);

        $profileData = array_intersect_key($validated, array_flip([
            'ville', 'telephone', 'est_visible'
        ]));
        $profileData['est_visible'] = true;

        $profileCandidat->update($profileData);

        if ($request->hasFile('imageURL')) {
            $this->uploadImage($request, $profileCandidat);
        }

        if ($request->hasFile('cv_url')) {
            $this->uploadCV($request, $profileCandidat);
        }

        if ($request->hasFile('portfolio_url')) {
            $this->uploadPortfolio($request, $profileCandidat);
        }

        return $profileCandidat->load(["user", "competences", "certifications", "experiences"]);
    }

    public function toggleVisibility(User $user)
    {
        $profileCandidat = ProfileCandidat::where('user_id', $user->id)->firstOrFail();
        $profileCandidat->update([
            'est_visible' => !$profileCandidat->est_visible
        ]);
        return $profileCandidat->est_visible;
    }

    public function uploadCV(Request $request, ProfileCandidat $profileCandidat)
    {
        $file = $request->file('cv_url');
        if($file !== null && !$file->getError()){
            if($profileCandidat->cv_url && Storage::disk("public")->exists($profileCandidat->cv_url)){
                Storage::disk("public")->delete($profileCandidat->cv_url);
            }
            $path = $file->store('cvs', 'public');
        }
        $profileCandidat->update(['cv_url' => $path]);
        return $path;
    }
    public function uploadPortfolio(Request $request, ProfileCandidat $profileCandidat)
    {
        $file = $request->file('portfolio_url');
        if($file !== null && !$file->getError()){
            if($profileCandidat->portfolio_url && Storage::disk('public')->exists($profileCandidat->portfolio_url)){
                Storage::disk("public")->delete($profileCandidat->portfolio_url);
            }
            $path = $file->store('portfolios', 'public');
        }
        $profileCandidat->update(['portfolio_url' => $path]);
        return $path;
    }

    public function uploadImage(Request $request, ProfileCandidat $profileCandidat)
    {
        $file = $request->file('imageURL');

        if($file !== null && !$file->getError()){
            if($profileCandidat->imageURL && Storage::disk("public")->exists($profileCandidat->imageURL)) {
                Storage::disk("public")->delete($profileCandidat->imageURL);
            }
            $path = $file->store('images', 'public');
            $profileCandidat->update(['imageURL' => $path]);
            return $path;
            }
            return $profileCandidat->imageURL;
    }
    public function addExperience()
    {

    }

    public function deleteExperience()
    {

    }

    public function addCertification()
    {

    }

    public function deleteCertification()
    {

    }

    public function addCompetence()
    {

    }

    public function removeCompetence()
    {

    }

    public function getDashboardStats()
    {

    }

    public function deleteProfileCandidat(Request $request, ProfileCandidat $profileCandidat)
    {
        if($request->user()->id!== $profileCandidat->user_id){
            return false;
        }
        $profileCandidat->delete();
        $request->user()->delete();
        return true;
    }
}
