document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const fileLabel = document.querySelector('.custom-file-label');
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Update file label
                fileLabel.textContent = file.name;
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                fileLabel.textContent = 'Choose file...';
                imagePreview.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
            }
        });
    }
    
    // Initialize Select2 if available
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $('#category_id').select2({
            placeholder: "Select a category",
            allowClear: true,
            dropdownParent: $('#subcategoryModal')
        });
    }
});