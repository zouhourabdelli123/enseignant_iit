    <aside class="sidebar" id="sidebar">
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
                <div class="status-indicator"></div>
                <div>
                    <span>Connecté</span>
                    <small>· Dernière activité: <span id="lastActivity">08:45</span></small>
                </div>
            </div>
        </div>
        <div class="nav-container">
            <p class="nav-title">Navigation Principale</p>
            <ul class="nav-links">
                <li><a href="{{ route('absences.index') }}" class="active"><i class="fas fa-home"></i> Gestion des Absences</a></li>
                <li><a href="{{ route('demande.index') }}"><i class="fas fa-calendar-alt" ></i> Gestion des demandes</a></li>
                <li><a href="#"><i class="fas fa-book-open"></i> Mes Cours</a></li>
                <li><a href="#"><i class="fas fa-tasks"></i> Tâches & Devoirs</a></li>
            </ul>

            <p class="nav-title" style="margin-top: 1.5rem;">Gestion</p>
            <ul class="nav-links">
                <li><a href="#"><i class="fas fa-users"></i> Étudiants</a></li>
                <li><a href="#"><i class="fas fa-file-alt"></i> Évaluations</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i> Messagerie</a></li>
                <li><a href="#"><i class="fas fa-cloud-upload-alt"></i> Ressources</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
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
