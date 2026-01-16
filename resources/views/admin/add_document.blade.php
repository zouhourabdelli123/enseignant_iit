@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/add_document.css') }}" rel="stylesheet">

    <div class="page-container">
        <!-- HEADER -->
        <div class="header-section">
            <div class="header-text">
                <h2 class="page-title">Liste des documents</h2>
                <p class="page-subtitle">Gérez vos documents administratifs et académiques</p>
            </div>
        </div>

        <!-- FORMULAIRE -->
        <div class="form-section">
            <form id="addDocumentForm" enctype="multipart/form-data">
                @csrf

                <!-- Statut -->
                <div class="form-group">
                    <label class="form-label">
                        Statut <span class="required">*</span>
                    </label>
                    <div class="radio-group">
                        <label class="radio-option active" data-radio="universitaire">
                            <input type="radio" name="statut" value="Universitaire" checked>
                            <span>Universitaire</span>
                        </label>
                        <label class="radio-option" data-radio="industriel">
                            <input type="radio" name="statut" value="Industriel">
                            <span>Industriel</span>
                        </label>
                    </div>
                </div>

                <!-- Établissement -->
                <div class="form-group">
                    <label class="form-label" for="etablissement">
                        Établissement (entreprise) d'origine <span class="required">*</span>
                    </label>
                    <input type="text" id="etablissement" name="etablissement" class="form-input"
                        placeholder="Ex: IIT, ISET, Entreprise..." required>
                </div>

                <!-- Grade -->
                <div class="form-group">
                    <label class="form-label" for="grade">
                        Grade <span class="required">*</span>
                    </label>
                    <input type="text" id="grade" name="grade" class="form-input"
                        placeholder="Ex: Licence, Master, Ingénieur..." required>
                </div>

                <!-- Attachement -->
                <div class="form-group">
                    <label class="form-label" for="attachement">
                        Attachement <span class="required">*</span>
                    </label>
                    <select id="attachement" name="attachement" class="form-select" required>
                        <option value="">-- Sélectionnez un type --</option>
                        <option value="CV">CV</option>
                        <option value="Diplôme">Diplôme</option>
                        <option value="Attestation">Attestation</option>
                        <option value="Certificat">Certificat</option>
                        <option value="Relevé de notes">Relevé de notes</option>
                        <option value="Lettre de motivation">Lettre de motivation</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <!-- Document -->
                <div class="form-group">
                    <label class="form-label" for="document">
                        Document <span class="required">*</span>
                    </label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="document" name="document" class="file-upload-input" required
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div id="fileName" class="file-name" style="display: none;">
                            <i class="fas fa-file-alt"></i>
                            <span id="fileNameText">Aucun fichier sélectionné</span>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter le document
                    </button>

                </div>
            </form>
        </div>
    </div>
    </div>

    <script src="{{ asset('js/add_document.js') }}"></script>

@endsection