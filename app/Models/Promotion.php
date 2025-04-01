<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'anneeAcademique', 'mention_id'];

    public function mention()
    {
        return $this->belongsTo(Mention::class);
    }
}
