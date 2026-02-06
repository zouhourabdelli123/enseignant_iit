$(document).ready(function () {
    var errore = document.getElementById('error').value;
    if (errore == 1) {
        Swal.fire({
            title: 'Erreur',
            text: 'Aucun étudiant trouvé.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    } else if (errore == 2) {
        Swal.fire({
            title: 'Erreur',
            text: 'Aucun groupe d’examen trouvé.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});
