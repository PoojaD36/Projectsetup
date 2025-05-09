document.addEventListener('DOMContentLoaded', function() {
    // Modal handling
    const openModalButtons = document.querySelectorAll('#openCategoryModal, #openCategoryModalEmpty');
    const categoryModal = document.getElementById('categoryModal');
    
    openModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            $(categoryModal).modal('show');
        });
    });
    
    // Image URL preview
    const imgLinkInput = document.getElementById('imglink');
    const imagePreview = document.getElementById('imagePreview');
    
    if (imgLinkInput && imagePreview) {
        imgLinkInput.addEventListener('input', function() {
            if (this.value) {
                imagePreview.src = this.value;
            } else {
                imagePreview.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
            }
        });
    }
    
    // Responsive table enhancements
    function setupResponsiveTable() {
        const table = document.getElementById('categoriesTable');
        if (!table) return;
        
        const rows = table.querySelectorAll('tbody tr');
        const headers = table.querySelectorAll('thead th');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                if (headers[index]) {
                    cell.setAttribute('data-label', headers[index].textContent.trim());
                }
            });
        });
    }
    
    // Initialize on load and on resize
    setupResponsiveTable();
    window.addEventListener('resize', setupResponsiveTable);
    
    // Tooltip initialization
    $('[data-toggle="tooltip"]').tooltip();
});