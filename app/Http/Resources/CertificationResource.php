<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'profile_candidat_id' => $this->profile_candidat_id,
            "profile_candidat" => new ProfileCandidatResource($this->profileCandidat),
            'titre' => $this->title,
            'organisme' => $this->organisme,
            'dateObtention' => $this->dateObtention
        ];
    }
}
