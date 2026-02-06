<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CursusEtudiant;
use App\Models\Enseignements;
use App\Models\Absences;
use App\Models\Specialites;
use App\Models\Niveaux;
use App\Models\Matieres;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AbsenceController extends Controller
{
    public function listeClasse()
    {
        $type='absances';
        return view('listeClasse',compact('type'));
    }

    public function classParSemester(Request $request)
    {
        $annee = CursusEtudiant::max('annee');
        session(['annee' => $annee]);
        
        $classes = Enseignements::select('groupe', 'id_specialite', 'id_niveau', 'id_matiere')
            ->with("specialite", "matiere", "niveau")
            ->where("annee", $annee)
            ->where("semestre", $request->semester)
            ->where('id_enseignant', auth()->user()->id_enseignant)
            ->get();

        return $classes;
    }

    public function pagePresance(Request $request)
    {
        $annee = session('annee');

        $date_debut = Carbon::createFromFormat('Y-m-d\TH:i', $request->date);
        session(['date_debut' => $date_debut]);

        $date_fin = $date_debut->copy()->addMinutes((int) $request->duree);
        session(['date_fin' => $date_fin]);

        $etudiants = CursusEtudiant::with("etudiant")
            ->select("code_etudiant")
            ->where("annee", $annee)
            ->where("id_specialite", $request->specialite)
            ->where("id_niveau",  $request->niveau)
            ->where("groupe",  $request->groupe)
            ->where('etat', 'actif')
            ->get();
        session(['etudiants' => $etudiants]);

        $nom_specialite = Specialites::find($request->specialite)->specialite_en_francais;
        session(['nom_specialite' => $nom_specialite]);

        $nom_niveau = Niveaux::find($request->niveau)->nom;
        session(['nom_niveau' => $nom_niveau]);

        $nom_matiere = Matieres::find($request->matiere)->nom;
        session(['id_matiere' => $request->matiere]);
        session(['nom_matiere' => $nom_matiere]);
        $type_cours = $request->type_cours;
        session(['type_cours' => $type_cours]);
        $type_seance = $request->type_seance;
        session(['type_seance' => $type_seance]);

        $groupe = $request->groupe;
        session(['groupe' => $groupe]);

        $semester = $request->semester;
        session(['semester' => $semester]);

        $validez=0;
        return $this->affichePagePresance($request->matiere, $date_debut, $date_fin, $etudiants,$validez);
    }

    public function affichePagePresance($matiere, $date_debut, $date_fin, $etudiants,$validez)
    {
        $nom_specialite = session('nom_specialite');
        $nom_niveau = session('nom_niveau');
        $nom_matiere = session('nom_matiere');
        $type_cours = session('type_cours');
        $type_seance = session('type_seance');
        $groupe = session('groupe');
        $semester = session('semester');



        $absences = Absences::where('id_enseignant', auth()->user()->id_enseignant)
            ->where('id_matiere', $matiere)
            ->where('date_debut', '<=', $date_debut)
            ->where('date_fin', '>=', $date_fin)
            ->select(
                'code_etudiant',
                'est_present',
                DB::raw('MAX(id) as id')
            )
            ->groupBy('code_etudiant', 'est_present')
            ->get();


        foreach ($etudiants as $etudiant) {
            $absence = $absences->where('code_etudiant', $etudiant->code_etudiant)->first();
            if ($absence) {
                if ($absence->est_present == 0)
                    $etudiant->est_present = 0;
                else
                    $etudiant->est_present = 1;
                $etudiant->existe_absance = $absence->id;
            } else
                $etudiant->est_present = 1;
        }
        $historiqueAbsances = Absences::select(
            DB::raw('SUM(CASE WHEN est_present = 0 AND est_justifier = 0 THEN 1 ELSE 0 END) as absences_non_justifier'),
            DB::raw('SUM(CASE WHEN est_present = 0 AND est_justifier = 1 THEN 1 ELSE 0 END) as absences_justifier'),
            DB::raw('SUM(CASE WHEN est_present = 1 THEN 1 ELSE 0 END) as presences'),
            'code_etudiant'
        )
            ->whereIn('code_etudiant', $etudiants->pluck('code_etudiant'))
            ->where('id_matiere', $matiere)
            ->groupBy('code_etudiant')
            ->get();

        return view('affecter_absances', compact(
            'etudiants',
            'historiqueAbsances',
            'nom_specialite',
            'nom_niveau',
            'nom_matiere',
            'date_debut',
            'type_cours',
            'type_seance',
            'groupe',
            'semester','validez'
        ));
    }

    public function validezPresance(Request $request)
    {
        $date_debut = session('date_debut');
        $date_fin = session('date_fin');
        $id_matiere = session('id_matiere');
        $type_cours = session('type_cours');
        $etudiants = session('etudiants');

        $liste_presance = $request->presances ?? [];
        
        foreach ($etudiants as $etudiant) {
            $present = in_array($etudiant->code_etudiant, $liste_presance);
            if ($present)
                $est_presant = 1;
            else
                $est_presant = 0;
            if ($etudiant->existe_absance) {
                Absences::where('id', $etudiant->existe_absance)
                    ->update(['est_present' => $est_presant]);
            } else {
                Absences::create([
                    "code_etudiant" => $etudiant->code_etudiant,
                    "id_matiere" => $id_matiere,
                    "id_enseignant" => auth()->user()->id_enseignant,
                    "date_debut" => $date_debut,
                    "date_fin" => $date_fin,
                    "type_seance" => $type_cours,
                    "est_present" => $est_presant,
                ]);
            }
        }
        $validez=1;
        return $this->affichePagePresance($id_matiere, $date_debut, $date_fin, $etudiants,$validez);
    }

    /* **************************************************************************** */

    public function message()
    {
        return view('admin.message');
    }

    public function documents()
    {
        return view('admin.documents');
    }

    public function add_document()
    {
        return view('admin.add_document');
    }

    public function historique_presences()
    {
        return view('admin.historique_presences');
    }

    public function afficher_presences_etudiants($id)
    {
        // TODO: Récupérer les données réelles depuis la base de données
        return view('admin.afficher_presences_etudiants', compact('id'));
    }
}
