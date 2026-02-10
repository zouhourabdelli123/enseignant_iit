



function afficherHistorique() {
    const annee = document.getElementById('anneeSelect').value;
    const semestre = document.getElementById('semestreSelect').value;

    if (!annee || !semestre) {
        alert('Veuillez sélectionner une année et un semestre.');
        return;
    }

    document.getElementById('filterModal').classList.add('hidden');

    chargerDonnees(annee, semestre);
}

function chargerDonnees(annee, semestre) {
    const donneesDemo = [
        {id: 1, date: 'le 2025-09-15 08:30:00', matiere: 'Génie logiciel et informatique décisionnelle', presence: 'Présent'},
        {id: 2, date: 'le 2025-09-15 12:30:00', matiere: 'Génie logiciel et informatique décisionnelle', presence: 'Présent'},
        {id: 3, date: 'le 2025-09-16 08:30:00', matiere: 'Développement des systèmes Communicants', presence: 'Absent'},
        {id: 4, date: 'le 2025-09-17 08:30:00', matiere: 'Développement des systèmes Communicants', presence: 'Présent'},
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

function ouvrirModal() {
    document.getElementById('filterModal').classList.remove('hidden');
}
