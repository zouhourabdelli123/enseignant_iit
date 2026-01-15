@extends('dashbaord.main')

@section('content')
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

        <div class="classes-grid" id="classesGrid">
            @php
                // Exemple de données - À remplacer par vos vraies données
                $classes = [
                    [
                        'group' => 1,
                        'level' => 2,
                        'name' => 'Administration réseaux et systèmes d\'informations',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 2,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 3,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 4,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 5,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 6,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 7,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                    [
                        'group' => 8,
                        'level' => 2,
                        'name' => 'Génie logiciel et informatique décisionnelle',
                        'subtitle' => 'Développement des systèmes Communicants',
                    ],
                ];
            @endphp

            @foreach ($classes as $class)
                <div class="class-card"
                    onclick="openSessionModal({{ $class['group'] }}, '{{ $class['name'] }}', {{ $class['level'] }})">
                    <div class="card-header">
                        <div class="card-badge">G{{ $class['group'] }}</div>
                        <div class="card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                <path d="M6 12v5c3 3 9 3 12 0v-5" />
                            </svg>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">{{ $class['name'] }}</h3>
                        <p class="card-subtitle">{{ $class['subtitle'] }}</p>
                    </div>

                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-label">Niveau</span>
                            <span class="meta-value">{{ $class['level'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Groupe</span>
                            <span class="meta-value">{{ $class['group'] }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Semestre</span>
                            <span class="meta-value" id="semesterValue{{ $class['group'] }}">-</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
                <h3 class="modal-title">Nouvelle Séance</h3>
                <p class="modal-subtitle">Remplissez les informations de la séance</p>
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
                            Durée de la séance
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
                            Type de séance
                        </label>
                        <select id="sessionType" class="form-select" required>
                            <option value="">Sélectionner le type...</option>
                            <option value="cours">📚 Cours magistral</option>
                            <option value="td">✏️ Travaux dirigés (TD)</option>
                            <option value="tp">💻 Travaux pratiques (TP)</option>
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
                 
                    <button type="button" class="btn btn-secondary" onclick="closeSessionModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                        Annuler
                    </button>
                       <a type="button" class="btn btn-primary" onclick="validateSession()" href="{{ route('affichage.index') }}">
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
    <script src="{{ asset('js/script_abcences.js') }}" ></script>

@endsection
