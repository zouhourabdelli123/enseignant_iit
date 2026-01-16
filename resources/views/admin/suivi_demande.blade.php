@extends('dashbaord.main')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/suivi_demande.css') }}">

    <div class="page-container">
        <!-- HEADER -->
        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Suivi des demandes</h2>
                <p class="page-subtitle">Gérez les demandes des enseignants</p>
            </div>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-title">Liste de demandes</h3>
            </div>

            <table id="suiviTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Données de démo -->
                    <tr>
                        <td>Correction d'erreur sur relevé</td>
                        <td>Rectification</td>
                        <td>15 Jan 2025</td>
                        <td><span class="status-badge pending">En cours</span></td>
                    </tr>
                    <tr>
                        <td>Demande de rattrapage</td>
                        <td>Planification</td>
                        <td>12 Jan 2025</td>
                        <td><span class="status-badge completed">Traitée</span></td>
                    </tr>
                    <tr>
                        <td>Problème projecteur Salle 2</td>
                        <td>Matériel</td>
                        <td>10 Jan 2025</td>
                        <td><span class="status-badge completed">Résolu</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/suivi_demande.js') }}"></script>

@endsection