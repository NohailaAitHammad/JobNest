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
            'titre' => $this->titre,
            'description' => $this->description,
            'type' => $this->type,
            'duree' => $this->duree,
            'status' => $this->status,
            'recruteur' => new UserResource($this->recruteur),
            'candidat' => new UserResource($this->candidat)
        ];
    }
}
