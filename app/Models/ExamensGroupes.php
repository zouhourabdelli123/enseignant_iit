<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamensGroupes extends Model
{
    protected $fillable = [
        'id_specialite',
        'id_niveau',
        'id_matiere',
        'id_type_evaluation',
        'salles',
        'annee',
        'semestre',
        'nombre_groupe',
        'date_debut_examan',
        'date_fin_examan',
        'id_emploi_examan'
    ];

    public function evaluation()
    {
        return $this->belongsTo(TypesEvaluations::class, "id_type_evaluation")
            ->select('id', 'nom');
    }

    public function specialite()
    {
        return $this->belongsTo(Specialites::class, "id_specialite")
            ->select('id', 'specialite_en_francais','id_diplome');
    }

    public function matiere()
    {
        return $this->belongsTo(Matieres::class, "id_matiere")
            ->select('id', 'nom');
    }

    
    public function niveau()
    {
        return $this->belongsTo(Niveaux::class, "id_niveau")
            ->select('id', 'nom');
    }
}
