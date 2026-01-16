@extends('dashbaord.main')

@section('content')
    <div class="page-container">
        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Mes Évaluations</h2>
                <p class="page-subtitle">Gérez vos groupes et semestres</p>
            </div>
      
        </div>

        <div class="classes-grid" id="classesGrid">
            <!-- DV -->
            <div class="class-card" onclick="openSessionModal(null, 'DS', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">DS</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- EXA_PRI -->
            <div class="class-card" onclick="openSessionModal(null, 'EXA_PRI', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">EXA_PRI</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- TP -->
            <div class="class-card" onclick="openSessionModal(null, 'TP', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">TP</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- PROJET -->
            <div class="class-card" onclick="openSessionModal(null, 'PROJET', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">PROJET</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- ORAL -->
            <div class="class-card" onclick="openSessionModal(null, 'ORAL', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-microphone-alt"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">ORAL</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- STAGE -->
            <div class="class-card" onclick="openSessionModal(null, 'STAGE', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">STAGE</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- EXA_RAT -->
            <div class="class-card" onclick="openSessionModal(null, 'EXA_RAT', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-redo"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">EXA_RAT</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>

            <!-- TEST -->
            <div class="class-card" onclick="openSessionModal(null, 'TEST', null)">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">TEST</h3>
                    <p class="card-subtitle">Évaluation</p>
                </div>
            </div>
        </div>
    </div>

    <div id="semesterModal" class="modal-overlay" onclick="closeModalOnOutside(event, 'semesterModal')">
        <div class="modal-box" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeSemesterModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>



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

    <div id="sessionModal" class="modal-overlay" onclick="closeModalOnOutside(event, 'sessionModal')">
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
                <h3 class="modal-title">Nouvelle Évaluation</h3>
                <p class="modal-subtitle">Remplissez les informations de l'évaluation</p>
            </div>

            <form id="sessionForm">
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
                        <input type="datetime-local" id="sessionDate" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="sessionDuration">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Durée de l'évaluation
                        </label>
                        <select id="sessionDuration" class="form-select" required>
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
                            Type d'évaluation
                        </label>
                        <select id="sessionType" class="form-select" required>
                            <option value="">Sélectionner le type...</option>
                            <option value="cours">📚 DS</option>
                            <option value="td">✏️ EXA_PRI</option>
                            <option value="tp">💻 TP</option>
                            <option value="tp">📋 PROJET</option>
                            <option value="tp">🎤 ORAL</option>
                            <option value="tp">🏢 STAGE</option>
                            <option value="tp">📝 EXA_RAT</option>
                            <option value="tp">📊 TEST</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sessionRoom">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            Salle
                        </label>
                        <select id="sessionRoom" class="form-select" required>
                            <option value="">Sélectionner la salle...</option>
                            <option value="principale">🏛️ Salle principale</option>
                            <option value="salle-1">🚪 Salle 1</option>
                            <option value="salle-2">🚪 Salle 2</option>
                            <option value="labo-1">🔬 Laboratoire 1</option>
                            <option value="labo-2">🔬 Laboratoire 2</option>
                        </select>
                    </div>
                </div>

                <div class="modal-actions">
                 
                
                       <a type="button" id="validateBtn" class="btn btn-primary" href="{{ route('index_notes.index') }}">
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
    <script src="{{ asset('js/notes.js') }}"></script>

@endsection