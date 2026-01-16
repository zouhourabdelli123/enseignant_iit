@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">

    <div class="page-container">
        <!-- HEADER -->
        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Liste des documents</h2>
                <p class="page-subtitle">Gérez vos documents administratifs et académiques</p>
            </div>
        </div>

        <!-- BOUTON AJOUTER -->
        <div style="margin-bottom: 1.5rem; display: flex; justify-content: flex-start;">
            <a href="{{ route('documents.add') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Ajouter
            </a>
        </div>

        <!-- DATATABLE DOCUMENTS -->
        <div class="table-card">
            <table id="documentsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>STATUT</th>
                        <th>ÉTABLISSEMENT</th>
                        <th>GRADE</th>
                        <th>DOCUMENT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Données de démo -->
                    <tr>
                        <td>2026-11-14 15:53:18</td>
                        <td>CV</td>
                        <td>Universitaire</td>
                        <td>IIT</td>
                        <td>chadi8iik</td>
                        <td>
                            <button class="btn-outline" style="margin-right: 0.5rem; border-color: #10b981; color: #10b981;"
                                onclick="editDocument(1)">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </button>
                            <button class="btn btn-primary" onclick="downloadDocument(1)">
                                <i class="fas fa-download"></i>
                                Télécharger
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2026-10-20 10:15:42</td>
                        <td>Diplôme</td>
                        <td>Universitaire</td>
                        <td>Licence</td>
                        <td>diplome_licence.pdf</td>
                        <td>
                            <button class="btn-outline" style="margin-right: 0.5rem; border-color: #10b981; color: #10b981;"
                                onclick="editDocument(2)">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </button>
                            <button class="btn btn-primary" onclick="downloadDocument(2)">
                                <i class="fas fa-download"></i>
                                Télécharger
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2026-09-05 14:22:10</td>
                        <td>Attestation</td>
                        <td>Professionnel</td>
                        <td>Master</td>
                        <td>attestation_travail.pdf</td>
                        <td>
                            <button class="btn-outline" style="margin-right: 0.5rem; border-color: #10b981; color: #10b981;"
                                onclick="editDocument(3)">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </button>
                            <button class="btn btn-primary" onclick="downloadDocument(3)">
                                <i class="fas fa-download"></i>
                                Télécharger
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL AJOUTER DOCUMENT -->
    <div id="addDocumentModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div
            style="background: white; border-radius: 16px; padding: 2rem; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
            <h3 style="margin: 0 0 1.5rem 0; color: #0c5eb1;">Ajouter un Document</h3>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1a202c;">Statut</label>
                <input type="text" id="statutInput" class="note-input" style="width: 100%;"
                    placeholder="CV, Diplôme, Attestation...">
            </div>

            <div style="margin-bottom: 1rem;">
                <label
                    style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1a202c;">Établissement</label>
                <input type="text" id="etablissementInput" class="note-input" style="width: 100%;"
                    placeholder="Universitaire, Professionnel...">
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1a202c;">Grade</label>
                <input type="text" id="gradeInput" class="note-input" style="width: 100%;"
                    placeholder="IIT, Licence, Master...">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1a202c;">Fichier</label>
                <input type="file" id="fileInput"
                    style="width: 100%; padding: 0.625rem; border: 2px solid #e2e8f0; border-radius: 10px;">
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button class="btn btn-secondary" onclick="closeAddDocumentModal()">Annuler</button>
                <button class="btn btn-primary" onclick="addDocument()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Enregistrer
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/documents.js') }}"></script>

@endsection