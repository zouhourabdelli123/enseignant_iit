<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamensGroupesEtudiants extends Model
{
    protected $fillable = [
        'id_examen_groupe',
        'code_etudiant',
        'numero_groupe',
        'code_genere',
        'code_enseigniant_genere',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, "code_etudiant", "code_etudiant")
            ->select('code_etudiant', 'nom', 'prenom', "email");
    }
}
