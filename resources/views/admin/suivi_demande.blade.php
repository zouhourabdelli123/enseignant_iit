@extends('dashbaord.main') 

@section('content')

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

        <table id="attendanceTable" class="display" style="width:100%">
            <thead>
                <tr>
                  
                    <th>Titre</th>
                    <th>Etat</th>
                    <th>Commentaires</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@endsection
