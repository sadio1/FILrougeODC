<?php

namespace App\Models;

use App\Models\Sessio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;
    public function sessions() {
        return $this->belongsToMany(Sessio::class);
    }
}
