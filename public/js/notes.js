let selectedSemester = null;
let currentClass = null;

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function () {
    // Vérification du semestre sauvegardé
    const savedSemester = sessionStorage.getItem('selectedSemester');

    // Initialisation de la date
    const dateInput = document.getElementById('sessionDate');
    if (dateInput) {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        dateInput.value = now.toISOString().slice(0, 16);
    }

    // Gestion de l'affichage initial du semestre
    if (savedSemester) {
        selectedSemester = parseInt(savedSemester);
        updateSemesterDisplay();
    } else {
        // Optionnel : ouvrir le modal de semestre au démarrage si non sélectionné
        const semesterModal = document.getElementById('semesterModal');
        if (semesterModal) openSemesterModal();
    }
});

// --- Gestion du Modal Semestre ---

function openSemesterModal() {
    const modal = document.getElementById('semesterModal');
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}

function closeSemesterModal() {
    const modal = document.getElementById('semesterModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}

function selectSemester(semester) {
    selectedSemester = semester;

    // Mise à jour visuelle de la sélection
    document.querySelectorAll('.semester-option').forEach(opt => {
        opt.classList.remove('active');
    });
    event.currentTarget.classList.add('active');

    // Activation du bouton confirmer
    const confirmBtn = document.getElementById('confirmBtn');
    if (confirmBtn) confirmBtn.disabled = false;
}

function confirmSemester() {
    if (selectedSemester) {
        sessionStorage.setItem('selectedSemester', selectedSemester);
        updateSemesterDisplay();
        closeSemesterModal();
    }
}

function updateSemesterDisplay() {
    // Mise à jour de l'affichage du semestre si nécessaire
    const display = document.getElementById('currentSemesterDisplay');
    if (display) {
        display.innerHTML = `<span class="current-semester-badge">Semestre ${selectedSemester}</span>`;
    }
}

// --- Gestion du Modal Session (Notes) ---

function openSessionModal(group, name, level) {
    // Si pas de semestre sélectionné, on demande d'abord le semestre
    if (!selectedSemester) {
        openSemesterModal();
        return;
    }

    currentClass = { group, name, level, semester: selectedSemester };

    // Reset du formulaire
    const form = document.getElementById('sessionForm');
    if (form) {
        form.reset();
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        const dateInput = document.getElementById('sessionDate');
        if (dateInput) dateInput.value = now.toISOString().slice(0, 16);
    }

    const modal = document.getElementById('sessionModal');
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';

        // Mettre à jour le lien de validation avec le type d'examen
        const validateBtn = document.getElementById('validateBtn');
        if (validateBtn) {
            const baseUrl = validateBtn.getAttribute('href').split('?')[0];
            validateBtn.setAttribute('href', `${baseUrl}?type=${name}`);
        }
    }
}

function closeSessionModal() {
    const modal = document.getElementById('sessionModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    currentClass = null;
}

// --- Utilitaires ---

function closeModalOnOutside(event, modalId) {
    if (event.target.id === modalId) {
        if (modalId === 'semesterModal') {
            closeSemesterModal();
        } else {
            closeSessionModal();
        }
    }
}

// Fermeture avec la touche Echap
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const sessionModal = document.getElementById('sessionModal');
        const semesterModal = document.getElementById('semesterModal');

        if (sessionModal && sessionModal.classList.contains('show')) {
            closeSessionModal();
        } else if (semesterModal && semesterModal.classList.contains('show')) {
            closeSemesterModal();
        }
    }
});
