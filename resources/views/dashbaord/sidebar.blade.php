<aside class="sidebar" id="sidebar">
    <!-- HEADER -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="sidebar-logo-text">
                <h2>IIT Enseignant</h2>
                <p>Version 3.0</p>
            </div>
        </div>

        <div class="teacher-status">
            <span class="status-dot"></span>
            <div class="status-text">
                <span>Connecté</span>
                <small>· Dernière activité : <span id="lastActivity">08:45</span></small>
            </div>
        </div>
    </div>

    <!-- NAVIGATION -->
    <div class="nav-container">
        <p class="nav-title">Navigation Principale</p>

        <ul class="nav-links">
            <li>
                <a href="{{ route('absences.index') }}"
                   class="{{ request()->routeIs('absences.*') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Gestion des Absences</span>
                </a>
            </li>

            <li>
                <a href="{{ route('demande.index') }}"
                   class="{{ request()->routeIs('demande.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Gestion des demandes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('suivi_demande.index') }}"
                   class="{{ request()->routeIs('cours.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open"></i>
                    <span>Suivi demande</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fas fa-tasks"></i>
                    <span>Tâches & Devoirs</span>
                </a>
            </li>
        </ul>

        <p class="nav-title">Gestion</p>

        <ul class="nav-links">
            <li><a href="#"><i class="fas fa-users"></i> Étudiants</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Évaluations</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Messagerie</a></li>
            <li><a href="#"><i class="fas fa-cloud-upload-alt"></i> Ressources</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
        </ul>
    </div>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <i class="fas fa-headset"></i>
        <div>
            <p>Support technique</p>
            <strong>support@iit.tn</strong>
        </div>
    </div>
</aside>
