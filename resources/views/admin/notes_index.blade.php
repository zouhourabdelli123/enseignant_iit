@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">

    <div class="page-container">
        <div class="header-section">
            <div class="header-content">
                <div class="header-text">
                    <h2 class="page-title">Notes </h2>
                    <p class="page-subtitle">Saisie des notes pour l'évaluation</p>
                </div>

            </div>
        </div>



        <!-- DATATABLE -->
        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-title">Liste de Présence</h3>
            </div>

            <table id="notesTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Étudiant</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Numéro</th>
                        <th>Statut</th>
                        <th>Présences</th>
                        <th>Absences</th>
                        <th>Justifiés</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Données chargées via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>





    <script>
        const notesIndexUrl = "{{ route('notes.index') }}";
    </script>
    <script src="{{ asset('js/notes_index.js') }}"></script>
@endsection