<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntrepriseResource extends JsonResource
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
            'nom' => $this->nom,
            'ville' => $this->ville,
            'dateCreation' => $this->dateCreation,
            'nombreEmployees' => $this->nombreEmployees,
            'description' => $this->description,
            //'domaine' =>  DomaineResource::collection($this->whenLoaded("domaines"))
            'domaine' => DomaineResource::collection($this->domaines)
        ];
    }
}
