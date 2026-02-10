<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Absences;
use App\Models\Specialites;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PresancesController extends Controller
{
    public function affichePage()
    {
        return view('presance.historique_presance');
    }

    public function affichePresance(Request $request)
    {

        $semester = [
            1 => [9, 10, 11, 12],
            2 => [1, 2, 3, 4, 5, 6],
        ];

        $idEns = auth()->user()->id_enseignant;

        $presences = Absences::select('date_debut', 'id_matiere', 'date_fin', 'groupe', 'date_fin')
            ->with('matiere')
            ->join('cursus_etudiants', 'etudiants_absences.code_etudiant', 'cursus_etudiants.code_etudiant')
            ->where('id_enseignant', $idEns)
            ->whereYear('date_debut', $request->annee)
            ->whereDate('date_debut', '<=', Carbon::today())
            ->whereMonth('date_debut', $semester[$request->semester])
            ->groupBy('date_debut', 'id_matiere', 'date_fin', 'groupe', 'date_fin')
            ->orderBy('date_debut')
            ->get();
        $data['presences'] = $presences;

        $informationsClasse = Specialites::select('specialite_en_francais', 'matieres.id as id_matiere', 'modules.nom as niveau')
            ->join('modules', 'specialites.id', 'modules.id_specialite')
            ->join('matieres', 'modules.id', 'matieres.id_module')
            ->whereIn('matieres.id', $presences->pluck('id_matiere'))
            ->get();
        $data['informationsClasse'] = $informationsClasse;

        return $data;
    }


    public function affichePresanceEtudiant($date_debut, $id_matiere)
    {
        $idEns = auth()->user()->id_enseignant;

        $presences = Absences::select('code_etudiant', 'est_present')
            ->with('etudiant')
            ->where('id_enseignant', $idEns)
            ->where('id_matiere', $id_matiere)
            ->where('date_debut', $date_debut)
            ->get();
            
        return view('presance.historique_presance_etudiant', compact('presences', 'date_debut'));
    }
}
