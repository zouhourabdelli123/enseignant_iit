<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demandes extends Model
{
    protected $table = "enseignants_demandes";

    protected $fillable = [
        'id_enseignant',
        'titre',
        'message',
        'commentaire',
        'document',
        'statut',
    ];
}
