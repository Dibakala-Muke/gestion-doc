<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
