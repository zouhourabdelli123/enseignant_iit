@extends('dashbaord.main')

@section('content')


<div class="page-container">

    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Historique des présences des étudiants</h2>
            <p class="page-subtitle">le 2025-09-15 08:30:00</p>
        </div>

    </div>
    <div class="table-card">
        <table id="etudiantsTable" style="width:100%">
            <thead>
                <tr>
                    <th>CODE ÉTUDIANT</th>
                    <th>NOM</th>
                    <th>PRÉSENCE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>241058</td>
                    <td>ABID ISLEM</td>
                    <td><span class="status-badge status-present">Présent</span></td>
                </tr>



            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/afficher_presences_etudiants.js') }}"></script>

@endsection