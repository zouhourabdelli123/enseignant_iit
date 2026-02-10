<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="sidebar-logo-text">
                <h2>IIT Enseignant</h2>
                <p>Espace professeur</p>
            </div>
        </div>

        <div class="teacher-status">
            <span class="status-dot"></span>
            <div class="status-text">
                <span>Connecte</span>
                <small>Derniere activite : <span id="lastActivity">08:45</span></small>
            </div>
        </div>
    </div>

    <div class="nav-container">
        <p class="nav-title">Navigation principale</p>

        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('affiche_liste_classe') }}" class="{{ request()->routeIs('absences.*') ? 'active' : '' }}">
                    <i class="fas fa-user-clock"></i>
                    <span>Gestion des absences</span>
                </a>
            </li>

            <li>
                <a href="{{ route('afficher_liste_demandes') }}" class="{{ request()->routeIs('suivi_demande.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>
                    <span>Suivi des demandes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('afficher_liste_evaluations') }}" class="{{ request()->routeIs('notes.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Notes</span>
                </a>
            </li>
        </ul>

        <p class="nav-title">Gestion</p>

        <ul class="nav-links">
            <li>
                <a href="{{ route('message.index') }}" class="{{ request()->routeIs('message.*') ? 'active' : '' }}">
                    <i class="fas fa-comment-dots"></i>
                    <span>Messagerie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('afficher_liste_documents') }}" class="{{ request()->routeIs('documents.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Documents</span>
                </a>
            </li>
            <li>
                <a href="{{ route('historique_presences.index') }}" class="{{ request()->routeIs('historique_presences.*') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>Historique presences</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-sliders-h"></i>
                    <span>Parametres</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <i class="fas fa-headset"></i>
        <div>
            <p>Support technique</p>
            <strong>support@iit.tn</strong>
        </div>
    </div>
</aside>
