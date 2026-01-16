$(document).ready(function() {
    $('#suiviTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
        },
        lengthChange: false,
        pageLength: 10
    });
});
