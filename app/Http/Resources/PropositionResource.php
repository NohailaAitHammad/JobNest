<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'recruteur_id' => new UserResource($this->recruteur),
            'candidat_id' => new UserResource($this->candidat),
            'titre' => $this->titre,
            'description' => $this->description,
            'type' => $this->type,
            'duree' => $this->duree,
            'status' => $this->status
        ];
    }
}
