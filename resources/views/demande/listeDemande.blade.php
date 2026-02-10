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
            <div class="header-actions">
                <a class="semester-selector-btn action-btn" href="{{ route('afficher_ajout_demandes') }}">
                    <i class="fas fa-plus"></i>
                    <span id="currentSemesterDisplay">Ajouter une demande</span>
                </a>
            </div>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-title">Liste de demandes</h3>
            </div>
            <table id="suiviTable" class="display" style="width:100%" data-page-length="7">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Contenue</th>
                        <th>Message Admin</th>
                        <th>État</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demandes as $demande)
                        <tr>
                            <td>{{ $demande->titre }}</td>
                            <td>
                                {{ $demande->message }}
                                <br>
                                {{ $demande->document }}
                            </td>
                            <td>
                                @if ($demande->commentaire)
                                    {{ $demande->commentaire }}
                                @else
                                    Pas de commentaire
                                @endif
                            </td>
                            <td>
                                @if ($demande->statut == 0)
                                    <span class="status-badge pending">En cours</span>
                                @elseif ($demande->statut == 1)
                                    <span class="status-badge completed">Acceptée</span>
                                @elseif ($demande->statut == 2)
                                    <span class="status-badge refused">Refusée</span>
                                @endif
                            </td>
                            <td>
                                @if ($demande->document)
                                    <a class="btn btn-primary"
                                        href="{{ route('telecharger_document_bureau', ['name_document' => $demande->document]) }}">
                                        <i class="fas fa-download"></i>
                                        Télécharger
                                    </a>
                                @else
                                    Pas d'ACTION
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <input id="ajout" hidden value="{{ session('ajout') }}">

    <script src="{{ asset('js/suivi_demande.js') }}"></script>
@endsection
