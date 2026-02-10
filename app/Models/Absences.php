<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absences extends Model
{
    protected $table = "etudiants_absences";

    protected $fillable = [
        'code_etudiant',
        'id_matiere',
        'id_enseignant',
        'date_debut',
        'date_fin',
        'type_seance',
        'est_present',/* 0=>8ayb,1=>7a4r */
        'est_justifier',/* 1=>3andou justification,0=>ma3andouch justification */
        'justification',
        'validez',/* il seance valiez ou  non */
    ];

    public function matiere()
    {
        return $this->belongsTo(Matieres::class, "id_matiere")
            ->select('id', 'nom');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, "code_etudiant", "code_etudiant")
            ->select('code_etudiant', 'nom', 'prenom');
    }
}
