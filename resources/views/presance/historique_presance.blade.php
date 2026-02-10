@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/historique_presences.css') }}" rel="stylesheet">

    <div class="page-container">
   <div class="header-text">
            <h2 class="page-title">Historique Des Présences</h2>
            <p class="page-subtitle">Consultez l'historique des présences par année et semestre</p>
        </div>

        <div class="table-card">
            <table id="historiqueTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>MATIÈRE</th>
                        <th>ACTION</th>
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

    <script src="{{ asset('js/historique_presences.js') }}"></script>

@endsection