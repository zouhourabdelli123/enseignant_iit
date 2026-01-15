<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_heure',
        'date_heure_fin',
        'id_enseignant',
        'id_etudiant',
        'id_module',
        'isPresent',
        'etat',
        'type'
    ];
}
