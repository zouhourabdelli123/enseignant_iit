@extends('dashbaord.main')

@section('content')


<div class="page-container">
    <!-- HEADER -->
    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Feuille de Présence</h2>
            <p class="page-subtitle">Gérez les présences de votre classe</p>
        </div>
    </div>

    <!-- SESSION INFO -->
    <div class="session-info-card">
        <div class="session-header">
            <div class="session-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>
            <div class="session-content">
                <h3 class="session-title">Génie logiciel et informatique décisionnelle</h3>
                <p class="session-subtitle">Développement des systèmes Communicants</p>
            </div>
            <div class="session-badge">G2</div>
        </div>

        <div class="session-details">
            <div class="detail-item">
                <span class="detail-label">Niveau</span>
                <span class="detail-value">2</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Groupe</span>
                <span class="detail-value">2</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Semestre</span>
                <span class="detail-value">Semestre 2</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Date & Heure</span>
                <span class="detail-value">15 Jan 2025, 10:30</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Durée</span>
                <span class="detail-value">2 heures</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Type</span>
                <span class="detail-value">Cours magistral</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Salle</span>
                <span class="detail-value">Salle principale</span>
            </div>
        </div>
    </div>

    <!-- STATISTICS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Étudiants</span>
                <div class="stat-icon total">👥</div>
            </div>
            <div class="stat-value">35</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Présents</span>
                <div class="stat-icon success">✓</div>
            </div>
            <div class="stat-value" id="presentCount">31</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Absents</span>
                <div class="stat-icon danger">✕</div>
            </div>
            <div class="stat-value" id="absentCount">3</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Justifiés</span>
                <div class="stat-icon warning">!</div>
            </div>
            <div class="stat-value" id="justifiedCount">1</div>
        </div>
    </div>

    <!-- DATATABLE -->
    <div class="table-card">
        <div class="table-card-header">
            <h3 class="table-title">Liste de Présence</h3>
        </div>

        <table id="attendanceTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Étudiant</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Numéro</th>
                    <th>Statut</th>
                    <th>Présences</th>
                    <th>Absences</th>
                    <th>Justifiés</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Données chargées via JavaScript -->
            </tbody>
        </table>
    </div>
</div>


@endsection