document.addEventListener('DOMContentLoaded', function() {
    // Obtenir le paramètre 'type' de l'URL pour changer le titre
    const urlParams = new URLSearchParams(window.location.search);
    const evalType = urlParams.get('type');
    if (evalType) {
        document.getElementById('evalTypeTitle').textContent = evalType;
    }

    // Initialisation DataTables
    $('#notesEntryTable').DataTable({
        paging: true,
        searching: true,
        info: true,
        lengthChange: true, // Permettre de changer le nombre d'éléments par page
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
        }
    });

    updateStats();
});

function updateStats() {
    const inputs = document.querySelectorAll('.note-input');
    const totalStudents = inputs.length;
    let completedNotes = 0;
    let sum = 0;

    inputs.forEach(input => {
        const value = parseFloat(input.value);
        const row = input.closest('tr');
        const statusBadge = row.querySelector('.status-badge');

        if (value > 0) {
            completedNotes++;
            sum += value;
            statusBadge.textContent = 'Complété';
            statusBadge.className = 'status-badge completed';
        } else {
            statusBadge.textContent = 'En attente';
            statusBadge.className = 'status-badge pending';
        }
    });

    document.getElementById('totalStudents').textContent = totalStudents;
    document.getElementById('completedNotes').textContent = completedNotes;

    if (completedNotes > 0) {
        const average = (sum / completedNotes).toFixed(2);
        document.getElementById('averageGrade').textContent = average + '/20';
    } else {
        document.getElementById('averageGrade').textContent = '-';
    }
}

function resetNotes() {
    if (confirm('Êtes-vous sûr de vouloir réinitialiser toutes les notes ?')) {
        document.querySelectorAll('.note-input').forEach(input => {
            input.value = 0;
        });
        updateStats();
    }
}

function saveDraft() {
    alert('Brouillon sauvegardé avec succès !');
}

function submitNotes() {
    const inputs = document.querySelectorAll('.note-input');
    let allFilled = true;

    inputs.forEach(input => {
        if (parseFloat(input.value) === 0) {
            allFilled = false;
        }
    });

    if (!allFilled) {
        if (!confirm('Certaines notes n\'ont pas été saisies. Voulez-vous quand même valider ?')) {
            return;
        }
    }

    alert('Notes validées avec succès !');
    if (typeof notesIndexUrl !== 'undefined') {
        window.location.href = notesIndexUrl;
    } else {
        console.error('Route notes.index non définie');
    }
}
