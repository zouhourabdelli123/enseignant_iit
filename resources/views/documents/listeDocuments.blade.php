@extends('dashbaord.main')

@section('content')


<div class="page-container">
    <!-- HEADER -->
    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Liste des documents</h2>
            <p class="page-subtitle">Gérez vos documents administratifs et académiques</p>
        </div>
        <a href="{{ route('page_ajout_demande_document') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Ajouter
        </a>
    </div>
    <div class="table-card documents-card">
        <div class="table-card-header">
            <h3 class="table-title">Documents</h3>
            <span class="table-hint">Historique des demandes</span>
        </div>
        <table id="documentsTable" class="documents-table" style="width:100%">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>DOCUMENT</th>
                    <th>STATUT</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td><span class="date-chip">{{ $document->created_at }}</span></td>
                    <td><span class="doc-name">{{ $document->nom_document }}</span></td>
                    <td>
                        @if ($document->statut == 0)
                        <span class="status-badge pending">En cours</span>
                        @elseif ($document->statut == 1)
                        <span class="status-badge completed">Acceptée</span>
                        @elseif ($document->statut == 2)
                        <span class="status-badge refused">Refusée</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('telecharger_document_bureau', ['name_document' => $document->document]) }}">
                            <i class="fas fa-download"></i>
                            Télécharger
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<input id="ajout" hidden value="{{ session('ajout') }}">

<script src="{{ asset('js/documents.js') }}"></script>
@endsection