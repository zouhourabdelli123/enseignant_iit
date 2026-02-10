@extends('dashbaord.main')

@section('content')

<link href="{{ asset('css/historique_presences.css') }}" rel="stylesheet">

<div class="page-container">
    <div class="header-text">
        <h2 class="page-title">Historique Des Présences</h2>
        <p class="page-subtitle">Consultez l'historique des présences par année et semestre</p>
    </div>

    <div class="table-card">
        <table id="historiqueTable" style="width:100%">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>MATIÈRE</th>
                    <th>PRÉSENCE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les données seront chargées après sélection -->
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL AUTO-OPEN -->
<div id="filterModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="modal-title">Historique des présences</h3>

        <div class="modal-group">
            <label class="modal-label">Choisir une année :</label>
            <select id="anneeSelect" class="modal-select">
                <option value="">Sélectionnez une année</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
        </div>

        <div class="modal-group">
            <label class="modal-label">Choisir une semestre :</label>
            <select id="semestreSelect" class="modal-select">
                <option value="">Choisir une semestre</option>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
            </select>
        </div>

        <div class="modal-actions">
            <button class="btn btn-primary" onclick="afficherHistorique()">
                <i class="fas fa-check"></i>
                Afficher
            </button>
        </div>
    </div>
</div>

<script src="{{ asset('js/historique_presences.js') }}"></script>

@endsection