@extends('dashbaord.main')

@section('content')
    <div class="page-container">
        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Mes Évaluations</h2>
                <p class="page-subtitle">Gérez vos groupes et semestres</p>
            </div>

        </div>

        <div class="classes-grid" id="classesGrid">
            @foreach ($evaluations as $evaluation)
                <a href="{{ route('affiche_liste_classes', ['type_evaliuation' => $evaluation->id]) }}">
                    <div class="class-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $evaluation->nom }}</h3>
                            <p class="card-subtitle">Évaluation</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <input type="hidden" id="error" value="{{ session('error') }}">

    <script src="{{ asset('js/script_type_evalusation.js') }}"></script>

@endsection
