@extends('dashbaord.main')
@section('content')
<main class="dashboard-shell">
    <section class="dashboard-hero">
        <div class="hero-text">
            <div class="hero-badge">
                <i class="fas fa-leaf"></i>
                <span>Vue d'ensemble</span>
            </div>
            <h1>Bonjour, Professeur {{ auth()->user()->nom }}</h1>
            <p>Voici un resume clair de votre journee, des cours et des priorites.</p>
            <div class="hero-actions">
                <a class="hero-btn primary" href="{{ route('affiche_liste_classe') }}">
                    <i class="fas fa-user-clock"></i>
                    <span>Absences</span>
                </a>
                <a class="hero-btn" href="{{ route('afficher_liste_evaluations') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Notes</span>
                </a>
            </div>
        </div>
        <div class="hero-panel">
            <div class="panel-card">
                <p class="panel-title">Aujourd'hui</p>
                <div class="panel-value">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}</div>
                <div class="panel-row">
                    <div class="panel-pill">
                        <i class="fas fa-calendar-check"></i>
                        <span>3 cours</span>
                    </div>
                    <div class="panel-pill">
                        <i class="fas fa-envelope"></i>
                        <span>8 messages</span>
                    </div>
                </div>
            </div>
            <div class="panel-card soft">
                <p class="panel-title">Prochaine session</p>
                <div class="panel-value">10:30 - 12:30</div>
                <p class="panel-sub">Algorithmique avancee · Salle B204</p>
            </div>
        </div>
    </section>

    <section class="stats-row">
        <article class="stat-tile">
            <div>
                <p class="stat-label">Etudiants inscrits</p>
                <h3>142</h3>
            </div>
            <div class="stat-chip up">
                <i class="fas fa-arrow-up"></i>
                <span>+8%</span>
            </div>
        </article>
        <article class="stat-tile">
            <div>
                <p class="stat-label">Heures de cours</p>
                <h3>32h</h3>
            </div>
            <div class="stat-chip up">
                <i class="fas fa-arrow-up"></i>
                <span>+5h</span>
            </div>
        </article>
        <article class="stat-tile">
            <div>
                <p class="stat-label">Taux de presence</p>
                <h3>96%</h3>
            </div>
            <div class="stat-chip up">
                <i class="fas fa-arrow-up"></i>
                <span>+3%</span>
            </div>
        </article>
        <article class="stat-tile">
            <div>
                <p class="stat-label">Note moyenne</p>
                <h3>4.7</h3>
            </div>
            <div class="stat-chip down">
                <i class="fas fa-arrow-down"></i>
                <span>-0.1</span>
            </div>
        </article>
    </section>

    <section class="dashboard-grid">
        <div class="card-box">
            <div class="card-head">
                <h2>Cours a venir</h2>
                <a href="#">Voir agenda</a>
            </div>
            <ul class="list-stack">
                <li class="list-item">
                    <div>
                        <p class="list-title">Algorithmique avancee</p>
                        <p class="list-sub">10:30 - 12:30 · Salle B204 · INFO-4A</p>
                    </div>
                    <span class="list-tag">Aujourd'hui</span>
                </li>
                <li class="list-item">
                    <div>
                        <p class="list-title">Base de donnees</p>
                        <p class="list-sub">14:00 - 16:00 · Salle A107 · INFO-3B</p>
                    </div>
                    <span class="list-tag">Aujourd'hui</span>
                </li>
                <li class="list-item">
                    <div>
                        <p class="list-title">Reunion departement</p>
                        <p class="list-sub">09:00 - 11:00 · Salle de conference</p>
                    </div>
                    <span class="list-tag">Demain</span>
                </li>
            </ul>
        </div>

        <div class="card-box">
            <div class="card-head">
                <h2>Taches prioritaires</h2>
                <a href="#">Voir toutes</a>
            </div>
            <ul class="list-stack">
                <li class="list-item">
                    <div>
                        <p class="list-title">Corriger devoir Algorithmique</p>
                        <p class="list-sub">Echeance: demain, 10:00</p>
                    </div>
                    <span class="list-tag danger">Haute</span>
                </li>
                <li class="list-item">
                    <div>
                        <p class="list-title">Preparer support cours IA</p>
                        <p class="list-sub">Complete · Pour jeudi</p>
                    </div>
                    <span class="list-tag success">Termine</span>
                </li>
                <li class="list-item">
                    <div>
                        <p class="list-title">Envoyer notes mi-semestre</p>
                        <p class="list-sub">Echeance: vendredi</p>
                    </div>
                    <span class="list-tag warning">Moyenne</span>
                </li>
            </ul>
        </div>
    </section>
</main>
@endsection
