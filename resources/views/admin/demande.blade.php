@extends('dashbaord.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/demande.css') }}">
    <div class="page-container">
        <!-- HEADER -->
        <div class="page-header">
            <h2 class="page-title">Demandes Enseignant</h2>
            <p class="page-subtitle">Créez une nouvelle demande administrative ou pédagogique</p>
        </div>

        <!-- FORM -->
        <div class="form-card">
            <form id="requestForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- TITRE -->
                <div class="form-group">
                    <label for="titre" class="form-label">Titre de la demande</label>
                    <input type="text" id="titre" name="titre" class="form-input"
                        placeholder="Ex: Demande d'équipement pédagogique" required maxlength="100">
                    <div class="char-counter">
                        <span id="titleCounter">0</span>/100 caractères
                    </div>
                </div>

                <!-- TEXTE DE NOTIFICATION -->
                <div class="form-group">
                    <label for="texte" class="form-label">Texte de notification</label>
                    <div class="editor-wrapper">
                        <textarea id="texte" name="texte" class="form-textarea"
                            placeholder="Rédigez le texte qui apparaîtra dans la notification..."></textarea>
                    </div>
                </div>

                <!-- CORPS -->
                <div class="form-group">
                    <label for="body" class="form-label">Description détaillée</label>
                    <textarea id="body" name="body" class="form-textarea"
                        placeholder="Décrivez votre demande en détail, incluant le contexte, les besoins spécifiques et les éventuelles contraintes..."
                        required maxlength="2000"></textarea>
                    <div class="char-counter">
                        <span id="bodyCounter">0</span>/2000 caractères
                    </div>
                </div>

                <!-- PIÈCE JOINTE -->
                <div class="form-group">
                    <label class="form-label">Pièces jointes</label>
                    <div class="file-upload-area" id="fileUploadArea">
                        <input type="file" id="pieceJointe" name="piece_jointe[]" class="file-input" multiple
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xlsx,.pptx,.zip">
                        <div class="upload-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                        </div>
                        <div class="upload-text">Déposez vos fichiers ici</div>
                        <div class="upload-hint">ou cliquez pour parcourir</div>
                        <div class="file-types">
                            <span class="file-type-tag">PDF</span>
                            <span class="file-type-tag">DOC</span>
                            <span class="file-type-tag">DOCX</span>
                            <span class="file-type-tag">JPG/PNG</span>
                            <span class="file-type-tag">XLSX</span>
                            <span class="file-type-tag">ZIP</span>
                        </div>
                    </div>
                    <div id="selectedFiles" class="selected-files"></div>
                </div>

                <!-- ACTIONS -->
                <div class="form-actions">
                
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 2L11 13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                        </svg>
                        Envoyer la demande
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/script_demande.js') }}"></script>
@endsection
