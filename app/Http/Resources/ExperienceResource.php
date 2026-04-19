<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
//            'profile_candidat_id' => $this->profile_candidat_id,
//            "profile_candidat" => new ProfileCandidatResource($this->profileCandidat),
            'poste' => $this->poste,
            'entreprise' => $this->entreprise,
            'description' => $this->description,
            'dateDebut' => $this->dateDebut,
            'dateFin' => $this->dateFin
        ];
    }
}
