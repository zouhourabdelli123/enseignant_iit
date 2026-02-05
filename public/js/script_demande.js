        // Initialize TinyMCE
        tinymce.init({
            selector: '#texte',
            height: 300,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | ' +
                'bold italic underline strikethrough forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image table emoticons | ' +
                'removeformat | help',
            content_style: `
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; 
            font-size: 14px; 
            line-height: 1.6; 
            color: #1E293B;
        }
        .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
            color: #94A3B8;
            font-style: italic;
        }
    `,
            placeholder: 'Rédigez votre texte de notification ici...',
            language: 'fr_FR',
            branding: false,
            promotion: false,
            emoticons_database: 'emojiimages',
            file_picker_types: 'file image media',
            images_upload_url: '/api/upload',
            automatic_uploads: true
        });

        // Character counters
        const titleInput = document.getElementById('titre');
        const bodyTextarea = document.getElementById('body');
        const titleCounter = document.getElementById('titleCounter');
        const bodyCounter = document.getElementById('bodyCounter');

        function updateCounter(element, counter, max) {
            const length = element.value.length;
            counter.textContent = length;

            if (length > max * 0.9) {
                counter.parentElement.classList.add('warning');
                counter.parentElement.classList.remove('danger');
            } else if (length > max) {
                counter.parentElement.classList.add('danger');
                counter.parentElement.classList.remove('warning');
            } else {
                counter.parentElement.classList.remove('warning', 'danger');
            }
        }

        titleInput.addEventListener('input', () => updateCounter(titleInput, titleCounter, 100));
        bodyTextarea.addEventListener('input', () => updateCounter(bodyTextarea, bodyCounter, 2000));

        // Initialize counters
        updateCounter(titleInput, titleCounter, 100);
        updateCounter(bodyTextarea, bodyCounter, 2000);

        // File Upload Handler
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('pieceJointe');
        const selectedFilesContainer = document.getElementById('selectedFiles');
        const submitBtn = document.getElementById('submitBtn');
        let selectedFiles = [];

        // Click to upload
        fileUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // File selection
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        // Drag and drop
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            handleFiles([e.dataTransfer.files[0]]);
        });


        async function handleFiles(files) {
            const file = files[0];

            if (!file) return;

            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                alert(`Le fichier dépasse la taille maximale de 10MB`);
                return;
            }

            selectedFiles = [];
            selectedFilesContainer.innerHTML = '';

            await simulateUpload(file);

            selectedFiles = [file];
            updateFileInput();
        }


        function simulateUpload(file) {
            return new Promise(resolve => {
                const fileItem = createFileElement(file);
                selectedFilesContainer.appendChild(fileItem);

                // Simulate progress
                const progressBar = fileItem.querySelector('.file-progress-bar');
                let progress = 0;

                const interval = setInterval(() => {
                    progress += 10;
                    progressBar.style.width = `${progress}%`;

                    if (progress >= 100) {
                        clearInterval(interval);
                        fileItem.classList.add('uploaded');
                        resolve();
                    }
                }, 50);
            });
        }

        function createFileElement(file) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.setAttribute('data-filename', file.name);

            const fileSize = formatFileSize(file.size);
            const fileExt = file.name.split('.').pop().toUpperCase().slice(0, 3);

            fileItem.innerHTML = `
        <div class="file-info">
            <div class="file-icon">${fileExt}</div>
            <div class="file-details">
                <div class="file-name">${file.name}</div>
                <div class="file-size">${fileSize} • En cours de chargement...</div>
                <div class="file-progress">
                    <div class="file-progress-bar"></div>
                </div>
            </div>
        </div>
        <button type="button" class="file-remove" onclick="removeFile('${file.name}')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    `;

            return fileItem;
        }

        function displayFiles() {
            // Remove loading files that are now in selectedFiles
            const displayedFiles = Array.from(selectedFilesContainer.querySelectorAll('.file-item'));
            displayedFiles.forEach(item => {
                const filename = item.getAttribute('data-filename');
                if (!selectedFiles.find(f => f.name === filename)) {
                    item.remove();
                }
            });

            // Add files that aren't displayed yet
            selectedFiles.forEach(file => {
                const isDisplayed = selectedFilesContainer.querySelector(`[data-filename="${file.name}"]`);
                if (!isDisplayed) {
                    const fileItem = createFileElement(file);
                    fileItem.querySelector('.file-progress-bar').style.width = '100%';
                    fileItem.querySelector('.file-size').textContent = `${formatFileSize(file.size)} • Chargé`;
                    selectedFilesContainer.appendChild(fileItem);
                }
            });
        }

        function removeFile(filename) {
            selectedFiles = selectedFiles.filter(file => file.name !== filename);
            displayFiles();
            updateFileInput();
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            if (selectedFiles[0]) {
                dataTransfer.items.add(selectedFiles[0]);
            }
            fileInput.files = dataTransfer.files;
        }


        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Form validation and submission
        document.getElementById('requestForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            // Update TinyMCE content
            tinymce.triggerSave();

            // Validate form
            if (!validateForm()) {
                return false;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
        <div class="loading"></div>
        Envoi en cours...
    `;

            try {
                // You can add AJAX submission here instead of direct form submit
                // Example:
                // const formData = new FormData(this);
                // const response = await fetch('/your-endpoint', {
                //     method: 'POST',
                //     body: formData
                // });

                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1500));

                // Show success message
                showNotification('Demande envoyée avec succès !', 'success');

                // Submit form after delay
                setTimeout(() => {
                    this.submit();
                }, 1000);

            } catch (error) {
                showNotification('Erreur lors de l\'envoi de la demande', 'error');
                submitBtn.disabled = false;
                submitBtn.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Envoyer la demande
        `;
            }
        });

        function validateForm() {
            let isValid = true;

            // Validate title
            const title = document.getElementById('titre');
            if (!title.value.trim()) {
                showError(title, 'Le titre est requis');
                isValid = false;
            } else if (title.value.length > 100) {
                showError(title, 'Le titre ne doit pas dépasser 100 caractères');
                isValid = false;
            } else {
                clearError(title);
            }

            // Validate body
            const body = document.getElementById('body');
            if (!body.value.trim()) {
                showError(body, 'La description est requise');
                isValid = false;
            } else if (body.value.length > 2000) {
                showError(body, 'La description ne doit pas dépasser 2000 caractères');
                isValid = false;
            } else {
                clearError(body);
            }

            return isValid;
        }

        function showError(element, message) {
            element.classList.add('error');

            // Remove existing error message
            const existingError = element.parentElement.querySelector('.error-message');
            if (existingError) existingError.remove();

            // Add new error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12" y2="16"/>
        </svg>
        ${message}
    `;

            element.parentElement.appendChild(errorDiv);
        }

        function clearError(element) {
            element.classList.remove('error');
            const errorDiv = element.parentElement.querySelector('.error-message');
            if (errorDiv) errorDiv.remove();
        }

        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#10B981' : '#EF4444'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    `;

            notification.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            ${type === 'success' ? 
                '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>' :
                '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>'
            }
        </svg>
        ${message}
    `;

            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Add slideOut animation
        const style = document.createElement('style');
        style.textContent = `
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
        document.head.appendChild(style);
