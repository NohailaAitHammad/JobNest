<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileCandidatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "user" => new UserResource($this->user),
            "ville" => $this->ville,
            "telephone" => $this->telephone,
            "image_url" => $this->imageURL,
            "portfolio_url" => $this->portfolio_url,
            "cv_url" => $this->cv_url,
            "est_visible" => $this->est_visible,
            "competences" =>  CompetenceResource::collection($this->whenLoaded("competences")),
            "certifications" => CertificationResource::collection($this->whenLoaded("certifications")),
            "experiences" => ExperienceResource::collection($this->whenLoaded("experiences"))
            ];
    }
}
