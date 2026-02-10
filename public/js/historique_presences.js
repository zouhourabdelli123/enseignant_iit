
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        title: "Choisir l'année et le semestre",
        html: `
                <input id="annee" class="swal2-input" placeholder="Entrer l'année">

                <div style="text-align:left; margin-top:10px;">
                    <label>
                    <input type="radio" name="semester" value="1"> Semestre 1
                    </label><br>
                    <label>
                    <input type="radio" name="semester" value="2"> Semestre 2
                    </label>
                </div>
            `,
        confirmButtonText: "Confirmer",
        showCancelButton: false,
        focusConfirm: false,
        preConfirm: () => {
            const annee = document.getElementById("annee").value;
            const semester = document.querySelector('input[name="semester"]:checked');

            if (!annee || !semester) {
                Swal.showValidationMessage(
                    "❌ Veuillez choisir l'année et le semestre"
                );
                return false;
            }

            return {
                annee: annee,
                semester: semester.value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: affichePresanceRoute,
                type: 'GET',
                data: {
                    annee: result.value.annee,
                    semester: result.value.semester,
                },
                dataType: 'json',
                beforeSend: function () {
                    chargementAlert();
                },
                success: function (data) {
                    Swal.close();
                    presences = data['presences'];
                    informationsClasse = data['informationsClasse'];
                    const tbody = document.getElementById('adminsTableBody');
                    tbody.innerHTML = '';
                    presences.forEach(presence => {
                        let classInfo = informationsClasse.find(info => info.id_matiere === presence.id_matiere);
                        let start = new Date(presence.date_debut);
                        let end = new Date(presence.date_fin);
                        let diffMs = end - start;
                        let totalMinutes = Math.floor(diffMs / (1000 * 60));
                        let hours = Math.floor(totalMinutes / 60);
                        let minutes = totalMinutes % 60;
                        tbody.innerHTML += `
                            <tr>
                                <td>${presence.date_debut}</td>
                                <td>
                                    ${classInfo.specialite_en_francais}<br>
                                    Niveau:${classInfo.niveau}<br>
                                    Groupe:${presence.groupe}<br>
                                    Semester:${result.value.semester}<br>
                                    Matiere:${presence.matiere.nom}<br>
                                    Durée séance:${hours}h et ${minutes}m
                                </td>
                                <td>
                                    <a href="/affiche_presance_etudiant/${presence.date_debut}/${presence.id_matiere}" class="btn btn-primary" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                                        <i class="fas fa-eye"></i>
                                        Absences étudiants
                                    </a>
                                </td>
                            </tr>
                        `;
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});

function chargerDonnees(annee, semestre) {
    const donneesDemo = [{
            id: 1,
            date: 'le 2025-09-15 08:30:00',
            matiere: 'Génie logiciel et informatique décisionnelle',
            presence: 'Présent'
        },
        {
            id: 2,
            date: 'le 2025-09-15 12:30:00',
            matiere: 'Génie logiciel et informatique décisionnelle',
            presence: 'Présent'
        },
        {
            id: 3,
            date: 'le 2025-09-16 08:30:00',
            matiere: 'Développement des systèmes Communicants',
            presence: 'Absent'
        },
        {
            id: 4,
            date: 'le 2025-09-17 08:30:00',
            matiere: 'Développement des systèmes Communicants',
            presence: 'Présent'
        },
    ];


    const tbody = document.querySelector('#historiqueTable tbody');
    tbody.innerHTML = '';

    donneesDemo.forEach(row => {
        const statusClass = row.presence === 'Présent' ? 'status-present' : 'status-absent';
        tbody.innerHTML += `
            <tr>
                <td>${row.date}</td>
                <td>${row.matiere}</td>
                <td><span class="status-badge ${statusClass}">${row.presence}</span></td>
                <td>
                    <a href="/afficher-presences-etudiants/${row.id}" class="btn btn-primary" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                        <i class="fas fa-eye"></i>
                        Absences étudiants
                    </a>
                </td>
            </tr>
        `;
    });
}
