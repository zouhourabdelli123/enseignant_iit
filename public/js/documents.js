$(document).ready(function() {
    // Initialisation DataTable
    $('#documentsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
        },
        order: [[0, 'desc']], // Trier par date décroissante
        pageLength: 10
    });
});

// Ouvrir le modal d'ajout
function openAddDocumentModal() {
    const modal = document.getElementById('addDocumentModal');
    modal.style.display = 'flex';
}

// Fermer le modal
function closeAddDocumentModal() {
    const modal = document.getElementById('addDocumentModal');
    modal.style.display = 'none';
    
    // Réinitialiser les champs
    document.getElementById('statutInput').value = '';
    document.getElementById('etablissementInput').value = '';
    document.getElementById('gradeInput').value = '';
    document.getElementById('fileInput').value = '';
}

// Ajouter un document
function addDocument() {
    const statut = document.getElementById('statutInput').value;
    const etablissement = document.getElementById('etablissementInput').value;
    const grade = document.getElementById('gradeInput').value;
    const file = document.getElementById('fileInput').files[0];
    
    if (!statut || !etablissement || !grade || !file) {
        alert('Veuillez remplir tous les champs et sélectionner un fichier.');
        return;
    }
    
    // Simulation d'ajout
    alert('Document "' + file.name + '" ajouté avec succès !');
    closeAddDocumentModal();
    
    // TODO: Ajouter l'appel AJAX pour uploader le document
    // const formData = new FormData();
    // formData.append('statut', statut);
    // formData.append('etablissement', etablissement);
    // formData.append('grade', grade);
    // formData.append('file', file);
    // 
    // $.ajax({
    //     url: '/documents/upload',
    //     method: 'POST',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function(response) {
    //         alert('Document ajouté !');
    //         closeAddDocumentModal();
    //         location.reload();
    //     }
    // });
}

// Modifier un document
function editDocument(id) {
    alert('Modifier le document #' + id);
    // TODO: Implémenter la modification
}

// Télécharger un document
function downloadDocument(id) {
    alert('Télécharger le document #' + id);
    // TODO: Implémenter le téléchargement
    // window.location.href = '/documents/' + id + '/download';
}

// Fermer le modal en cliquant en dehors
document.addEventListener('click', function(event) {
    const modal = document.getElementById('addDocumentModal');
    if (event.target === modal) {
        closeAddDocumentModal();
    }
});
