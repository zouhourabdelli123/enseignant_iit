<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TypesEvaluations;
use App\Models\CursusEtudiant;
use App\Models\ExamensGroupes;
use App\Models\ExamensGroupesEtudiants;
use App\Models\MatieresNotes;


class NotesController extends Controller
{
    public function typeEvaluation()
    {
        $evaluations = TypesEvaluations::all();

        return view('notes.typeEvaluation', compact('evaluations'));
    }

    public function listeClasse($type_evaliuation)
    {
        session(['type_evaliuation' => $type_evaliuation]);
        $type = 'notes';
        return view('listeClasse', compact('type'));
    }

    public function listEtudiants($specialte, $niveau, $group, $matiere, $semestre, $evaluation, $annee)
    {
       
        if ($evaluation->nom == "Examen Principal" || $evaluation->nom == "Examen Rattrappage") {

            $examGroup = ExamensGroupes::where([
                ["annee", $annee],
                ["id_specialite", $specialte],
                ["id_niveau", $niveau],
                ["semestre", $semestre],
                ["id_matiere", $matiere],
            ])->orderBy("id", "desc")->first();

            if ($examGroup == null) 
                return null;
            

            $etudians = ExamensGroupesEtudiants::with("etudiant")
                ->join('cursus_etudiants', 'examens_groupes_etudiants.code_etudiant', 'cursus_etudiants.code_etudiant')
                ->where('id_exam_group', '=', $examGroup->id)
                ->where("cursus_etudiants.annee", "=", $annee)
                ->where("cursus_etudiants.id_specialite", "=", $specialte)
                ->where("cursus_etudiants.id_niveau", "=", $niveau)
                ->where("cursus_etudiants.groupe", "=", $group)
                ->where('cursus_etudiants.etat', 'actif')
                ->get();
            $etudiansCodes = $etudians->pluck("code_genere")->toArray();

            $notes = MatieresNotes::select("id", "code_etudiant",  "note", "autoriser", "code_genere_examan")
                ->where("id_enseignant", auth()->user()->id_enseignant)
                ->where("annee", $annee)
                ->where("id_matiere", $matiere)
                ->where("id_type_evaluation", $evaluation->id)
                ->whereIn("code_genere_examan", $etudiansCodes)
                ->get();

            if (count($notes) > 0) {
                foreach ($etudians as $etudian) {
                    $note = $notes->where('code_genere_examan', $etudian->code_genere_examan)->first();
                    if ($note) {
                        $etudian->note = $note->note;
                        $etudian->noteLocked = $note->autoriser;
                    }
                }
            }
        } else { 
            $etudians = CursusEtudiant::where("cursus_etudiants.annee",  $annee)
                ->with("etudiant")
                ->where("id_specialite",  $specialte)
                ->where("id_niveau", $niveau)
                ->where("groupe",  $group)
                ->where('etat', 'actif')
                ->get();

          

            $etudiansCodes = $etudians->pluck("code_etudiant")->toArray();

            $notes = MatieresNotes::select("id", "code_etudiant",  "note", "autoriser")
                ->where("id_enseignant", auth()->user()->id_enseignant)
                ->where("annee", $annee)
                ->where("id_matiere", $matiere)
                ->where("id_type_evaluation", $evaluation->id)
                ->whereIn("code_etudiant", $etudiansCodes)
                ->get();

            foreach ($etudians as $etudian) {
                $note = $notes->where('code_etudiant', $etudian->code_etudiant)->first();
                if ($note) {
                    $etudian->note = $note->note;
                    $etudian->noteLocked = $note->autoriser;
                }
            }
        }
        return $etudians;
    }

    public function listeNotes(Request $request)
    {
        $annee = CursusEtudiant::max('annee');
        $evaluation = TypesEvaluations::find(session('type_evaliuation'));

        $etudians = $this->listEtudiants($request->id_specialite, $request->id_niveau, $request->group, $request->id_matiere, $request->semester, $evaluation, $annee);

        if ($etudians == null)
            return redirect()->route('afficher_liste_evaluations')->with('error', 1);

        $valider = 0;
        foreach ($etudians as $etudian) {
            if ($etudian->note > 0) {
                $valider = 1;
                break;
            }
        }
        $etudiansCode = $etudians->pluck('code_etudiant');
        $etudiansCodeExam = $etudians->pluck('code_genere_examan');

        if (count($etudiansCodeExam) == 0 && ($evaluation->nom == "Examen Principal" || $evaluation->nom == "Examen Rattrappage"))
            return redirect()->route('afficher_liste_evaluations')->with('error', 2);


        session(['annee' => $annee]);
        session(['id_matiere' => $request->id_matiere]);
        session(['evaluation' => $evaluation]);
        session(['etudiansCode' => $etudiansCode]);
        session(['etudiansCodeExam' => $request->etudiansCodeExam]);
        session(['etudians' => $etudians]);

        return $this->affichePageListeEtudiants($evaluation->nom, $valider);
    }

    public function affichePageListeEtudiants($nom_evaluation, $valider)
    {
        $etudians = session('etudians');
        $etudiansCode = session('etudiansCode');
        $etudiansCodeExam = session('etudiansCodeExam');
        return view("notes.listeEtudiants", compact(
            "nom_evaluation",
            "etudians",
            "etudiansCode",
            'etudiansCodeExam',
            'valider'
        ));
    }

    public function affecterNotes(Request $request)
    {
        $notes = $request->all();

        $evaluation = session('evaluation');
        if ($evaluation->nom == "Examen Principal" || $evaluation->nom == "Examen Rattrappage") {
            $etudiansCodeExam = session('etudiansCodeExam');
            $etudians = session('etudians');
            foreach ($etudiansCodeExam as $etudian) {
                $code_etudiants = $etudians->where('code_genere_examan', $etudian)->first();
                MatieresNotes::create([
                    "annee" => session('annee'),
                    "id_enseignant" => auth()->user()->id_enseignant,
                    "id_matiere" => $request->module,
                    "id_type_evaluation" => session('id_matiere'),
                    "id_etuditan" => $code_etudiants->code_etudiant,
                    "code" => $etudian,
                    "note" => $notes[$etudian]
                ]);
            }
        } else {
            $etudiansCode = session('etudiansCode');
            foreach ($etudiansCode as $etudian) {
                MatieresNotes::create([
                    "annee" => session('annee'),
                    "id_enseignant" => auth()->user()->id_enseignant,
                    "code_etudiant" => $etudian,
                    "id_matiere" => session('id_matiere'),
                    "id_type_evaluation" => $evaluation->id,
                    "note" =>  $notes[$etudian]
                ]);
            }
        }

        $valider = 1;
        return $this->affichePageListeEtudiants($evaluation->nom, $valider);
    }
}
