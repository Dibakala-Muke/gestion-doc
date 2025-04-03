<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttenteResource extends JsonResource
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
            'dateCreation' => $this->dateCreation,
            'anneeAcademique' => $this->anneeAcademique,
            'numeroUnique' => $this->numeroUnique,
            'typeDocument' => new TypeDocumentResource($this->typeDocument),
            'user' => $this->user->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
