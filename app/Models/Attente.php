<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attente extends Model
{
    use HasFactory;

    protected $fillable = ['numeroUnique', 'dateCreation', 'anneeAcademique', 'objet', 'typeDocument_id', 'user_id'];

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
