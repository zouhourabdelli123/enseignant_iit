
document.addEventListener('DOMContentLoaded', function() {
    
    document.querySelectorAll('.radio-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.radio-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const documentInput = document.getElementById('document');
    if (documentInput) {
        documentInput.addEventListener('change', function(e) {
            const fileNameDiv = document.getElementById('fileName');
            const fileNameText = document.getElementById('fileNameText');

            if (e.target.files[0]) {
                fileNameText.textContent = e.target.files[0].name;
                fileNameDiv.style.display = 'flex';
            } else {
                fileNameDiv.style.display = 'none';
            }
        });
    }


});
