<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatieresNotes extends Model
{
    protected $fillable = [
        'annee',
        'id_enseignant',
        'code_etudiant',
        'id_matiere',
        'id_type_evaluation',
        'note',
        'code_genere_examan',
        'autoriser',/* ken  0 yjjim yraha snn laa */
        'valider'/* 0 par defaut mouch validez mayjimch el etudiant yaraha */
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, "code_etudiant", "code_etudiant")
            ->select('code_etudiant', 'nom', 'prenom');
    }
}
