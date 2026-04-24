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
        $validated["est_visible"] = true;
        $profileCandidat->update($validated);
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
//        $request->validate([
//            "cv_url" => "required|file|mimes:pdf|max:2048"
//        ]);
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
//        $request->validate([
//            "portfolio_url" => "required|file|mimes:pdf|max:2048"
//        ]);
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
//        $request->validate([
//            "imageURL" => "required|image|mimes:jpeg,jpg,png,gif"
//        ]);
        $file = $request->file('imageURL');
        $new_name = rand() . '.' . $file->getClientOriginalExtension();

        if($file !== null && !$file->getError()){
            if($profileCandidat->imageURL && Storage::disk("public")->exists($profileCandidat->imageURL)){
                Storage::disk("public")->delete($profileCandidat->imageURL);
            }
            $path = $file->store('images', 'public');
            //$path = $file->move(public_path('images' . $new_name));
      }

      $profileCandidat->update(['imageURL' => $path]);
      return $path;
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
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 403);
        }
        $request->user()->currentAccessToken()->delete();

        $profileCandidat->delete();
        $request->user()->delete();
    }
}
