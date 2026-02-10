

document.addEventListener("DOMContentLoaded", function () {
    // Initial popup
    showSelectionPopup();
});


function showSelectionPopup() {
    Swal.fire({
        title: "Période académique",
        html: `
            <div style="text-align: left; padding: 0 0.5rem;">
                <p style="color:#64748b; font-size:0.9rem; margin-bottom:1.5rem; text-align:center;">
                    Veuillez sélectionner l'année universitaire et le semestre pour consulter l'historique.
                </p>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display:block; margin-bottom:0.75rem; font-weight:600; color:#334155; font-size:0.95rem;">
                        <i class="fas fa-calendar-alt" style="margin-right:8px; color:#4f46e5;"></i>Année Universitaire
                    </label>
                    <input id="annee" class="swal2-input" placeholder="ex: 2025" 
                           style="margin:0; width:100%; box-sizing:border-box; border-radius:8px; font-size:1rem; padding:0.75rem 1rem; border:1px solid #cbd5e1; transition:all 0.2s;">
                </div>

                <div>
                    <label style="display:block; margin-bottom:0.75rem; font-weight:600; color:#334155; font-size:0.95rem;">
                        <i class="fas fa-clock" style="margin-right:8px; color:#4f46e5;"></i>Semestre
                    </label>
                    <div style="display:flex; gap:1rem;">
                        <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem; cursor:pointer; 
                                    border:1px solid #e2e8f0; padding:0.75rem; border-radius:8px; transition:border 0.2s;" 
                               onmouseover="this.style.borderColor='#4f46e5'; this.style.backgroundColor='#f8fafc'" 
                               onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='white'">
                            <input type="radio" name="semester" value="1" style="accent-color:#4f46e5;"> 
                            <span style="color:#1e293b; font-weight:500;">Semestre 1</span>
                        </label>
                        <label style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem; cursor:pointer;
                                    border:1px solid #e2e8f0; padding:0.75rem; border-radius:8px; transition:border 0.2s;"
                               onmouseover="this.style.borderColor='#4f46e5'; this.style.backgroundColor='#f8fafc'" 
                               onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='white'">
                            <input type="radio" name="semester" value="2" style="accent-color:#4f46e5;"> 
                            <span style="color:#1e293b; font-weight:500;">Semestre 2</span>
                        </label>
                    </div>
                </div>
            </div>
        `,
        confirmButtonText: "Charger l'historique",
        confirmButtonColor: "#4f46e5",
        showCancelButton: false,
        width: '450px',
        padding: '2rem',
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            title: 'swal-title-custom',
            popup: 'swal-popup-custom',
            confirmButton: 'swal-confirm-btn-custom'
        },
        didOpen: () => {
             // Set default year
            document.getElementById('annee').value = new Date().getFullYear();
        },
        preConfirm: () => {
            const annee = document.getElementById("annee").value;
            const semester = document.querySelector('input[name="semester"]:checked');

            if (!annee || !semester) {
                Swal.showValidationMessage("Veuillez remplir tous les champs");
                return false;
            }

            return {
                annee: annee,
                semester: semester.value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            loadData(result.value.annee, result.value.semester);
        }
    });
}

function loadData(annee, semester) {
    $.ajax({
        url: affichePresanceRoute,
        type: 'GET',
        data: {
            annee: annee,
            semester: semester,
        },
        dataType: 'json',
        beforeSend: function () {
            Swal.fire({
                title: 'Chargement...',
                text: 'Récupération des données en cours',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (data) {
            Swal.close();
            const presences = data['presences'];
            const informationsClasse = data['informationsClasse'];
            
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('#suiviTable')) {
                $('#suiviTable').DataTable().destroy();
            }

            const tbody = document.getElementById('adminsTableBody');
            tbody.innerHTML = '';

            if (presences.length === 0) {
                 Swal.fire({
                    icon: 'info',
                    title: 'Aucun résultat',
                    text: 'Aucune présence trouvée pour cette période.',
                    confirmButtonText: 'Nouvelle recherche',
                    confirmButtonColor: '#4f46e5'
                }).then((result) => {
                    if (result.isConfirmed) {
                        showSelectionPopup();
                    }
                });
                return;
            }

            presences.forEach(presence => {
                let classInfo = informationsClasse.find(info => info.id_matiere === presence.id_matiere);
                let start = new Date(presence.date_debut);
                let end = new Date(presence.date_fin);
                let diffMs = end - start;
                let minutes = Math.floor((diffMs / (1000 * 60)) % 60);
                let hours = Math.floor((diffMs / (1000 * 60)) / 60);

                let infoBadge = `<div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-weight:600; color:#1e293b;">${presence.matiere.nom}</span>
                    <span style="font-size:0.85rem; color:#64748b;">${classInfo.specialite_en_francais} • Niveau ${classInfo.niveau}</span>
                    <span style="font-size:0.85rem; color:#64748b;">Groupe ${presence.groupe} • Semestre ${semester}</span>
                    <span style="font-size:0.8rem; background:#f1f5f9; padding:2px 6px; border-radius:4px; width:fit-content;">Durée: ${hours}h ${minutes}m</span>
                </div>`;

                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div style="font-weight:600; color:#1e293b;">${presence.date_debut.split(' ')[0]}</div>
                            <div style="font-size:0.85rem; color:#64748b;">${presence.date_debut.split(' ')[1]}</div>
                        </td>
                        <td>${infoBadge}</td>
                        <td>
                            <a href="/affiche_presance_etudiant/${presence.date_debut}/${presence.id_matiere}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i>
                                Détails
                            </a>
                        </td>
                    </tr>
                `;
            });

            // Re-initialize DataTable using common config
            // We assume custom_datatables.js will handle the #suiviTable initialization
            // But since this is dynamic content, we explicitly init logic here:
             $('#suiviTable').DataTable({
                language: {
                    search: "Rechercher:",
                    lengthMenu: "Afficher _MENU_ éléments",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    infoEmpty: "Aucun élément trouvé",
                    infoFiltered: "(filtré de _MAX_ éléments au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    zeroRecords: "Aucun élément trouvé"
                },
                pagingType: "simple_numbers",
                pageLength: 25,
                columnDefs: [{
                        orderable: false,
                        targets: 'no-sort'
                    }
                ]
            });

        },
        error: function (xhr, status, error) {
            Swal.fire('Erreur', 'Une erreur est survenue lors du chargement des données', 'error');
            console.error(xhr.responseText);
        }
    });
}


