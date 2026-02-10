@extends('dashbaord.main')

@section('content')
<link href="{{ asset('css/custom_datatables.css') }}" rel="stylesheet">

<div class="page-container">

    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Historique des présences des étudiants</h2>
            <p class="page-subtitle">le {{$date_debut}}</p>
        </div>

    </div>
    <div class="table-card">
        <div class="table-card-header">
            <h3 class="table-title">Liste des étudiants</h3>
        </div>

        <table id="suiviTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>CODE ÉTUDIANT</th>
                    <th>NOM & PRÉNOM</th>
                    <th class="no-sort">STATUT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presences as $presence)
                <tr>
                    <td><span class="code-badge">{{ $presence->code_etudiant }}</span></td>
                    <td><span class="student-name">{{ $presence->etudiant->nom }} {{ $presence->etudiant->prenom }}</span></td>
                    <td>
                        @if ($presence->est_present == 0)
                        <span class="status-badge status-absent">
                            <i class="fas fa-times-circle"></i> Absent
                        </span>
                        @elseif($presence->est_present == 1)
                        <span class="status-badge status-present">
                            <i class="fas fa-check-circle"></i> Présent
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/custom_datatables.js') }}"></script>
<script src="{{ asset('js/afficher_presences_etudiants.js') }}"></script>
@endsection