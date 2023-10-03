<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sessio extends Model
{

    protected $guarded=[];
    use HasFactory;
    public function classes() {
        return $this->belongsToMany(Classe::class);
    }
}
