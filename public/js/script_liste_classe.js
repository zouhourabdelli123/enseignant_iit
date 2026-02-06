let selectedSemester = null;
window.addEventListener('DOMContentLoaded', function () {

    openSemesterModal();

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
    closeSemesterModal();
    const display = document.getElementById('currentSemesterDisplay');

    display.innerHTML = `<span class="current-semester-badge">Semestre ${selectedSemester}</span>`;

    $.ajax({
        url: filterClasseRoute,
        type: 'GET',
        data: {
            semester: selectedSemester,
        },
        dataType: 'json',
        beforeSend: function () {
            chargementAlert();
        },
        success: function (data) {
            Swal.close();
            const container = document.getElementById("classesContainer");
            container.innerHTML = '';

            let type_page = document.getElementById('type_page').value;
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            data.forEach(item => {
                let group = item.groupe;
                let niveau = item.niveau.nom;
                let specialite = item.specialite.specialite_en_francais;
                let matiere = item.matiere.nom;


                let cardInner = `
                        <div class="card-header">
                            <div class="card-badge">G${group}</div>
                            <div class="card-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                                </svg>
                            </div>
                        </div>

                        <div class="card-content">
                            <h3 class="card-title">${specialite}</h3>
                            <p class="card-subtitle">${matiere}</p>
                        </div>

                        <div class="card-meta">
                            <div class="meta-item">
                                <span class="meta-label">Niveau</span>
                                <span class="meta-value">${niveau}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Groupe</span>
                                <span class="meta-value">${group}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Semestre</span>
                                <span class="meta-value" id="semesterValue${group}">${selectedSemester}</span>
                            </div>
                        </div>
                    `;

                let card = '';

                if (type_page === 'absances') {
                    card = `
                        <div class="class-card"
                            onclick="openSessionModal('${item.id_specialite}', ${item.id_niveau}, ${group}, ${item.id_matiere})">
                            ${cardInner}
                        </div>
                    `;
                } else if (type_page === 'notes') {
                    card = `
                        <form method="POST" action="${listeEtudiantRoute}">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <div class="class-card" onclick="this.closest('form').submit()">
                                ${cardInner}

                                <input name="id_specialite" type="hidden" value="${item.id_specialite}">
                                <input name="id_niveau" type="hidden" value="${item.id_niveau}">
                                <input name="group" type="hidden" value="${group}">
                                <input name="id_matiere" type="hidden" value="${item.id_matiere}">
                                <input name="semester" type="hidden" value="${selectedSemester}">
                            </div>
                        </form>
                    `;
                }
                container.insertAdjacentHTML("beforeend", card);
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function openSessionModal(specialite, niveau, groupe, matiere) {
    if (!selectedSemester) {
        openSemesterModal();
        return;
    }
    document.getElementById('sessionForm').reset();
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('sessionDate').value = now.toISOString().slice(0, 16);

    document.getElementById('sessionModal').classList.add('show');
    document.body.style.overflow = 'hidden';

    document.getElementById('specialite').value = specialite;
    document.getElementById('niveau').value = niveau;
    document.getElementById('groupe').value = groupe;
    document.getElementById('matiere').value = matiere;
    document.getElementById('semester').value = selectedSemester;
}

function closeSessionModal() {
    document.getElementById('sessionModal').classList.remove('show');
    document.body.style.overflow = 'auto';
}

function validateSession() {
    msg = '';
    find = 0;
    msgerr = document.getElementById("danger-alert");
    sessionDate = document.getElementById('sessionDate').value;
    sessionDuration = document.getElementById("sessionDuration").value;
    sessionType = document.getElementById("sessionType").value;
    type_seance = document.getElementById("type_seance").value;

    if (sessionDate == '') {
        msg = msg + "- Vous devez choisir la date!</br>";
        find = 1;
    }
    if (sessionDuration == '') {
        msg = msg + "- Vous devez choisir la durée!</br>";
        find = 1;
    }
    if (sessionType == '') {
        msg = msg + "- Vous devez choisir le type du cours!</br>";
        find = 1;
    }
    if (type_seance == '') {
        msg = msg + "- Vous devez choisir une séance!</br>";
        find = 1;
    }

    if (find == 0) {
        document.getElementById('sessionForm').submit();
    } else {
        msgerr.style.display = "block";
        msgerr.innerHTML = msg;
    }
}
