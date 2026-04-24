<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileRecruteurResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "user" => new UserResource($this->user),
            'imageURL' => $this->imageURL,
            'ville' => $this->ville,
            'telephone' => $this->telephone,
            'poste' => $this->poste,
            'entreprise' => new EntrepriseResource($this->entreprise)
        ];
    }
}
