@extends('dashbaord.main')

@section('content')
<link href="{{ asset('css/custom_datatables.css') }}" rel="stylesheet">

<div class="page-container">

    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Historique Des Présences</h2>
            <p class="page-subtitle">Consultez l'historique des présences par année et semestre</p>
        </div>

    </div>

    <div class="table-card">
        <div class="table-card-header">
            <h3 class="table-title">Liste des séances</h3>
        </div>

        <table id="suiviTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>DATE DEBUT</th>
                    <th>MATIÈRE & INFO</th>
                    <th class="no-sort">ACTION</th>
                </tr>
            </thead>
            <tbody id='adminsTableBody'>
                <!-- Les données seront chargées après sélection -->
            </tbody>
        </table>
    </div>
</div>

<script>
    const affichePresanceRoute = "{{ route('filtere_liste_presance') }}";
</script>

<script src="{{ asset('js/custom_datatables.js') }}"></script>
<script src="{{ asset('js/historique_presences.js') }}"></script>

@endsection