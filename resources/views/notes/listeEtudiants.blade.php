@extends('dashbaord.main')

@section('content')


<div class="page-container">
    <div class="header-section">
        <div class="header-content">
            <div class="header-text">
                <h2 class="page-title">Notes {{$nom_evaluation}}</h2>
                <p class="page-subtitle">Saisie des notes pour l'évaluation</p>
            </div>

        </div>
    </div>



    <!-- DATATABLE -->
    <div class="table-card">
        <div class="table-card-header">
            <h3 class="table-title">Liste de Présence</h3>
        </div>
        <form action="{{ route('affecter_notes_etudiants') }}" method="post" id='myForm'>
            @csrf
            @if ($valider == 0)
            <button type="submite" class="btn-danger">
                Valider
            </button>
            @endif
            <table id="notesTable" style="width:100%">
                <thead>
                    <tr>
                        @if ($nom_evaluation == 'Examen Principal' || $nom_evaluation == 'Examen Rattrappage')
                        <th>Code Examen</th>
                        @else
                        <th>Code Étudiant</th>
                        <th>Nom</th>
                        @endif
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etudians as $etudian)
                    <tr>
                        @if ($nom_evaluation == 'Examen Principal' || $nom_evaluation == 'Examen Rattrappage')
                        <td>
                            <input name='code_etudient{{ $etudian->code_genere_examan }}'
                                value='{{ $etudian->code_etudiant }}' hidden>
                            <div class="text-sm text-gray-900">
                                {{ $etudian->code_genere_examan }}
                            </div>
                        </td>
                        @else
                        <td>{{ $etudian->code_etudiant }}</td>
                        <td>{{ $etudian->etudiant->nom }} {{ $etudian->etudiant->prenom }}</td>
                        @endif
                        <td>
                            @if ($valider == 0)
                            <input type="number" max="20" min="0" step="0.05"
                                name='{{ isset($etudian->code_genere_examan) ? $etudian->code_genere_examan : $etudian->code_etudiant }}'
                                value="{{ isset($etudian->note) ? $etudian->note : 0 }}">
                            @else
                            {{ isset($etudian->note) ? $etudian->note : 0 }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>
    const notesIndexUrl = "{{ route('notes.index') }}";
</script>

@endsection