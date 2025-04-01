<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'nom' => $this->nom,
            'postnom'  => $this->postnom,
            'prenom'=> $this->prenom,
            'fonction' => $this->fonction,
            'email' => new UserResource($this->user),
            'mention' => new MentionResource($this->mention),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
