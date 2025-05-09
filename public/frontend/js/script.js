document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    
    if (mobileMenuToggle && sidebar) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    // Close sidebar when clicking overlay
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Mobile user menu toggle
    const mobileUserBtn = document.querySelector('.mobile-user-btn');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    
    if (mobileUserBtn && mobileDropdown) {
        mobileUserBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileDropdown.classList.toggle('active');
        });
        
        // Close dropdown when clicking elsewhere
        document.addEventListener('click', function() {
            if (mobileDropdown.classList.contains('active')) {
                mobileDropdown.classList.remove('active');
            }
        });
    }
    
    // Category modal handling
    const categoryModal = document.getElementById('categoryModal');
    const openModalBtn = document.getElementById('openCategoryModal');
    const closeModalBtn = document.getElementById('closeCategoryModal');
    
    if (categoryModal && openModalBtn && closeModalBtn) {
        openModalBtn.addEventListener('click', function() {
            categoryModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
        
        closeModalBtn.addEventListener('click', function() {
            categoryModal.style.display = 'none';
            document.body.style.overflow = '';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === categoryModal) {
                categoryModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    }
    
    // Image preview for forms
    const imgLinkInput = document.getElementById('imglink');
    const imagePreview = document.getElementById('imagePreview');
    
    if (imgLinkInput && imagePreview) {
        imgLinkInput.addEventListener('input', function() {
            if (this.value) {
                imagePreview.src = this.value;
            } else {
                imagePreview.src = 'https://via.placeholder.com/300x200?text=Preview';
            }
        });
    }
});