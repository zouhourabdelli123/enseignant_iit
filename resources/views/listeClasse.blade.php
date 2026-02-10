@extends('dashbaord.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/form_validation_alert.css') }}">

<div class="page-container">
    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Mes Classes</h2>
            <p class="page-subtitle">Gérez vos groupes et semestres</p>
        </div>
        <button class="semester-selector-btn" onclick="openSemesterModal()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 6v6l4 2" />
            </svg>
            <span id="currentSemesterDisplay">Choisir un semestre</span>
        </button>
    </div>

    <div class="classes-grid" id="classesContainer">

    </div>
</div>

<div id="semesterModal" class="modal-overlay">
    <div class="modal-box" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeSemesterModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round">
                <path d="M18 6L6 18M6 6l12 12" />
            </svg>
        </button>

        <div class="modal-header">
            <h3 class="modal-title">Choisir un semestre</h3>
        </div>

        <div class="form-group">
            <div class="semester-options" id="semesterOptions">
                <div class="semester-option" onclick="selectSemester(1)">
                    <span class="semester-option-label">Semestre</span>
                    <span class="semester-option-value">1</span>
                </div>
                <div class="semester-option" onclick="selectSemester(2)">
                    <span class="semester-option-label">Semestre</span>
                    <span class="semester-option-value">2</span>
                </div>
            </div>
        </div>

        <div class="modal-actions">
            <button class="btn btn-primary" id="confirmBtn" onclick="confirmSemester()" disabled>
                Confirmer
            </button>
        </div>
    </div>
</div>

<div id="sessionModal" class="modal-overlay">
    <div class="modal-box modal-box-large" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeSessionModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round">
                <path d="M18 6L6 18M6 6l12 12" />
            </svg>
        </button>

        <div class="modal-header">
            <div class="modal-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
            <h3 class="modal-title">Nouvelle Séance</h3>
            <p class="modal-subtitle">Remplissez les informations de la séance</p>
        </div>

        <form method="post" action="{{ route('affiche_presences_etudiants') }}" id='sessionForm'>
            @csrf

            <div id="danger-alert" style="display: none;"></div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="sessionDate">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        Date et heure
                    </label>
                    <input type="datetime-local" id="sessionDate" name="date" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="sessionDuration">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        Durée de la séance
                    </label>
                    <select id="sessionDuration" name="duree" class="form-select" required>
                        <option value="">Sélectionner la durée...</option>
                        <option value="1">1 heure</option>
                        <option value="1.5">1h30</option>
                        <option value="2">2 heures</option>
                        <option value="2.5">2h30</option>
                        <option value="3">3 heures</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sessionType">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                        </svg>
                        Type de séance
                    </label>
                    <select id="sessionType" name="type_cours" class="form-select" required>
                        <option value="">Sélectionner le type...</option>
                        <option value="Cours magistral">📚 Cours magistral</option>
                        <option value="Travaux dirigés (TD)">✏️ Travaux dirigés (TD)</option>
                        <option value="Travaux pratiques (TP)">💻 Travaux pratiques (TP)</option>
                        <option value="Surveillance">👀 Surveillance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sessionRoom">Type de cours</label>
                    <select id="type_seance" name="type_seance" class="form-select" required>
                        <option value="">Sélectionner le type ...</option>
                        <option value="Principale">🏛️ Principale</option>
                        <option value="Rattrapage">🎯 Rattrapage</option>
                    </select>
                </div>

            </div>

            <input name="specialite" id="specialite" hidden>
            <input name="niveau" id="niveau" hidden>
            <input name="groupe" id="groupe" hidden>
            <input name="matiere" id="matiere" hidden>
            <input name="semester" id="semester" hidden>


            <div class="modal-actions">

                <button type="button" class="btn btn-secondary" onclick="closeSessionModal()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                    Annuler
                </button>
                <a type="button" class="btn btn-primary" onclick="validateSession()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Valider
                </a>
            </div>
        </form>
    </div>
</div>
<input id="type_page" hidden value="{{ $type }}">


<script src="{{ asset('js/script_liste_classe.js') }}"></script>
<script>
    const filterClasseRoute = "{{ route('affiche_liste_classe_par_semester') }}";
    const listeEtudiantRoute = "{{ route('affiche_liste_etudiants') }}";
</script>
@endsection