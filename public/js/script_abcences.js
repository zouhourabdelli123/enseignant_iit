let selectedSemester = null;
let currentClass = null;
window.addEventListener('DOMContentLoaded', function() {
    const savedSemester = sessionStorage.getItem('selectedSemester');
    
    if (!savedSemester) {
        openSemesterModal();
    } else {
        selectedSemester = parseInt(savedSemester);
        updateSemesterDisplay();
        updateAllClassCards();
    }

    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('sessionDate').value = now.toISOString().slice(0, 16);
});

function openSemesterModal() {
    document.getElementById('semesterModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeSemesterModal() {
 
    
    document.getElementById('semesterModal').classList.remove('show');
    document.body.style.overflow = 'auto';
}

function selectSemester(semester) {
    selectedSemester = semester;
    
    document.querySelectorAll('.semester-option').forEach(opt => {
        opt.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
    
    document.getElementById('confirmBtn').disabled = false;
}

function confirmSemester() {
 
    
    sessionStorage.setItem('selectedSemester', selectedSemester);
    updateSemesterDisplay();
    updateAllClassCards();
    closeSemesterModal();
}

function updateSemesterDisplay() {
    const display = document.getElementById('currentSemesterDisplay');
    display.innerHTML = `<span class="current-semester-badge">Semestre ${selectedSemester}</span>`;
}

function updateAllClassCards() {
    document.querySelectorAll('.class-card').forEach(card => {
        const group = card.querySelector('.card-badge').textContent.replace('G', '');
        const semesterValueEl = document.getElementById(`semesterValue${group}`);
        if (semesterValueEl) {
            semesterValueEl.textContent = selectedSemester;
        }
    });
}

function openSessionModal(group, name, level) {
    if (!selectedSemester) {
        openSemesterModal();
        return;
    }

    currentClass = { group, name, level, semester: selectedSemester };
    
    document.getElementById('sessionForm').reset();
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('sessionDate').value = now.toISOString().slice(0, 16);
    
    document.getElementById('sessionModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeSessionModal() {
    document.getElementById('sessionModal').classList.remove('show');
    document.body.style.overflow = 'auto';
    currentClass = null;
}

function closeModalOnOutside(event, modalId) {
    if (event.target.id === modalId) {
        if (modalId === 'semesterModal') {
            closeSemesterModal();
        } else {
            closeSessionModal();
        }
    }
}

function validateSession() {
    const form = document.getElementById('sessionForm');
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const sessionData = {
        class: currentClass,
        date: document.getElementById('sessionDate').value,
        duration: document.getElementById('sessionDuration').value,
        type: document.getElementById('sessionType').value,
        room: document.getElementById('sessionRoom').value
    };



    
    closeSessionModal();
}

// Fermer les modals avec Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (document.getElementById('sessionModal').classList.contains('show')) {
            closeSessionModal();
        } else if (selectedSemester && document.getElementById('semesterModal').classList.contains('show')) {
            closeSemesterModal();
        }
    }
});
