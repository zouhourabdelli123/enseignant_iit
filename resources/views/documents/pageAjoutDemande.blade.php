@extends('dashbaord.main')

@section('content')

<link href="{{ asset('css/add_document.css') }}" rel="stylesheet">

<div class="page-container">
    <div class="header-section">
        <div class="header-text">
            <h2 class="page-title">Liste des documents</h2>
            <p class="page-subtitle">Gérez vos documents administratifs et académiques</p>
        </div>
    </div>



    <div class="form-section">
        <form method="post" action="{{ route('ajout_demande_document') }}" enctype="multipart/form-data">
            @csrf

            <!-- Attachement -->
            <div class="form-group">
                <label class="form-label" for="attachement">
                    Document <span class="required">*</span>
                </label>
                <select id="nom_document" name="nom_document" class="form-select" required>
                    <option value="">-- Sélectionnez un type --</option>
                    <option value="CV">CV</option>
                    <option value="Autorisation">Autorisation</option>
                    <option value="Rib">Rib</option>
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