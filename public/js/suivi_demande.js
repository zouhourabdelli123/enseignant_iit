$(document).ready(function () {
    if (document.getElementById('ajout')) {
        var ajout = document.getElementById('ajout').value;
        if (ajout == 1) {
            Swal.fire({
                title: 'Succès',
                text: 'La demande a été envoyée avec succès.',
                icon: 'success',
                confirmButtonText: 'Merci'
            });
        }
    }
});
