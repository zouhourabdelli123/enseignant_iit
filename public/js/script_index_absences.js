const studentsData = [
    {id: 1, avatar: 'https://i.pravatar.cc/150?img=1', firstName: 'Mohamed', lastName: 'YOUSSEF', number: '2048', status: 'present', presences: 3, absences: 0, justified: 0},
    {id: 2, avatar: 'https://i.pravatar.cc/150?img=2', firstName: 'Ahmed', lastName: 'LEYOUB', number: '14545', status: 'present', presences: 2, absences: 1, justified: 0},
   
];


$(document).ready(function() {
    const table = $('#attendanceTable').DataTable({
        data: studentsData,
        columns: [
            { data: 'id' },
            { 
                data: null,
                orderable: false,
                render: function(data) {
                    return `
                        <div class="student-cell">
                            <img src="${data.avatar}" alt="${data.firstName}" class="student-avatar">
                            <span class="student-name">${data.firstName} ${data.lastName}</span>
                        </div>
                    `;
                }
            },
            { data: 'firstName' },
            { data: 'lastName' },
            { data: 'number' },
            {
                data: 'status',
                render: function(data) {
                    const statusMap = {
                        'present': { label: 'Présent', class: 'present' },
                        'absent': { label: 'Absent', class: 'absent' },
                        'justified': { label: 'Justifié', class: 'justified' }
                    };
                    const status = statusMap[data];
                    return `<span class="status-badge ${status.class}"><span class="status-dot"></span>${status.label}</span>`;
                }
            },
            { data: 'presences' },
            { data: 'absences' },
            { data: 'justified' },
            {
                data: null,
                orderable: false,
                render: function(data, type, row) {
                    return `
                        <div class="action-buttons">
                            <button class="btn-action btn-present" onclick="markStatus(${row.id}, 'present')" title="Présent">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </button>
                            <button class="btn-action btn-absent" onclick="markStatus(${row.id}, 'absent')" title="Absent">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                            <button class="btn-action btn-justified" onclick="markStatus(${row.id}, 'justified')" title="Justifié">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            "lengthMenu": "Afficher _MENU_ étudiants par page",
            "zeroRecords": "Aucun étudiant trouvé",
            "info": "Page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun étudiant disponible",
            "infoFiltered": "(filtré de _MAX_ étudiants au total)",
            "search": "Rechercher:",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
        order: [[0, 'asc']],
        drawCallback: function() {
            updateStats();
        }
    });

    function updateStats() {
        const data = table.rows().data();
        let present = 0, absent = 0, justified = 0;
        
        data.each(function(student) {
            if(student.status === 'present') present++;
            else if(student.status === 'absent') absent++;
            else if(student.status === 'justified') justified++;
        });
        
        $('#presentCount').text(present);
        $('#absentCount').text(absent);
        $('#justifiedCount').text(justified);
    }

    updateStats();
});

function markStatus(id, newStatus) {
    const table = $('#attendanceTable').DataTable();
    const rowData = table.rows().data().toArray();
    const studentIndex = rowData.findIndex(s => s.id === id);
    
    if(studentIndex !== -1) {
        rowData[studentIndex].status = newStatus;
        
        if(newStatus === 'present') {
            rowData[studentIndex].presences++;
        } else if(newStatus === 'absent') {
            rowData[studentIndex].absences++;
        } else if(newStatus === 'justified') {
            rowData[studentIndex].justified++;
        }
        
        table.clear().rows.add(rowData).draw();
    }
}