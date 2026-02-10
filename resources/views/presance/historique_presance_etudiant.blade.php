@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">

    <div class="page-container">

        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Historique des présences des étudiants</h2>
                <p class="page-subtitle">le {{$date_debut}}</p>
            </div>

        </div>
        <div class="table-card">
            <table id="etudiantsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>CODE ÉTUDIANT</th>
                        <th>NOM</th>
                        <th>PRÉSENCE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $presence->code_etudiant }}</td>
                            <td>{{ $presence->etudiant->nom }} {{ $presence->etudiant->prenom }}</td>
                            <td>
                                @if ($presence->est_present == 0)
                                    
                                    <span class="status-badge status-absent">Absant</span>
                                @elseif($presence->est_present == 1)
                                    <span class="status-badge status-present">Présent</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/afficher_presences_etudiants.js') }}"></script>
@endsection
