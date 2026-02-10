<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $fillable = [
        'nom',
        'credit',
        'coefficient',
        'regime',
        'id_specialite',
        'id_niveau',
        'semestre',
    ];

    public function specialite()
    {
        return $this->belongsTo(Specialites::class, "id_specialite")
            ->select('id', 'specialite_en_francais');
    }

    public function niveau()
    {
        return $this->belongsTo(Niveaux::class, "id_niveau")
            ->select('id', 'nom');
    }
}
