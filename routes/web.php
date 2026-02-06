<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DemandesController;
use App\Http\Controllers\NotesController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/message', [AbsenceController::class, 'message'])->name('message.index');
    Route::get('/documents', [AbsenceController::class, 'documents'])->name('documents.index');
    Route::get('/documents/add', [AbsenceController::class, 'add_document'])->name('documents.add');
    Route::get('/historique-presences', [AbsenceController::class, 'historique_presences'])->name('historique_presences.index');
    Route::get('/afficher-presences-etudiants/{id}', [AbsenceController::class, 'afficher_presences_etudiants'])->name('afficher_presences_etudiants');
});

route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/liste_classe', [AbsenceController::class, 'listeClasse'])->name('affiche_liste_classe');
    Route::get('/liste_classe_par_semester', [AbsenceController::class, 'classParSemester'])->name('affiche_liste_classe_par_semester');

    /* absance */
    Route::post('/presences_etudiants', [AbsenceController::class, 'pagePresance'])->name('affiche_presences_etudiants');
    Route::post('/valisez_presences_etudiants', [AbsenceController::class, 'validezPresance'])->name('valisez_presences');

    /* demande */
    Route::get('liste_demandes', [DemandesController::class, 'affichePage'])->name('afficher_liste_demandes');
    Route::get('demande_ajout_demande', [DemandesController::class, 'pageAjoutDemande'])->name('afficher_ajout_demandes');
    Route::post('ajout_demande', [DemandesController::class, 'ajoutDemande'])->name('ajout_demande_enseigniant');

    /* notes */
    Route::get('liste_evaluations', [NotesController::class, 'typeEvaluation'])->name('afficher_liste_evaluations');
    Route::get('liste_classes/{type_evaliuation}', [NotesController::class, 'listeClasse'])->name('affiche_liste_classes');
    Route::post('liste_etudiants', [NotesController::class, 'listeNotes'])->name('affiche_liste_etudiants');
    Route::post('affecter_notes', [NotesController::class, 'affecterNotes'])->name('affecter_notes_etudiants');

});
require __DIR__ . '/auth.php';
