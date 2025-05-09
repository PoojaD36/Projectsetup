// filename: app.js (or whatever your existing script file is named)
document.addEventListener('DOMContentLoaded', function() {
    // Navigation elements (existing code)
    const sidebar = document.querySelector('.sidebar');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    const mobileUserBtn = document.querySelector('.mobile-user-btn');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    
    // Modal elements (existing + added subcategory modal)
    const openCategoryModalBtn = document.getElementById('openCategoryModal');
    const openCategoryModalEmptyBtn = document.getElementById('openCategoryModalEmpty');
    const categoryModal = document.getElementById('categoryModal');
    const subcategoryModal = document.getElementById('subcategoryModal');
    
    // ===== EXISTING FUNCTIONALITY =====
    // Toggle mobile sidebar (existing)
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    // Close sidebar when clicking overlay (existing)
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Mobile user menu toggle (existing)
    if (mobileUserBtn) {
        mobileUserBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileDropdown.classList.toggle('active');
        });
    }
    
    // Close dropdown when clicking elsewhere (existing)
    document.addEventListener('click', function() {
        if (mobileDropdown && mobileDropdown.classList.contains('active')) {
            mobileDropdown.classList.remove('active');
        }
    });
    
    // ===== ENHANCED IMAGE PREVIEW ===== (existing, modified for subcategory)
    function setupImagePreview(inputId, previewId) {
        const imageInput = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);
        
        if (imageInput && previewElement) {
            // For URL inputs (Category form)
            if (imageInput.type === 'text') {
                if (imageInput.value) {
                    previewElement.src = imageInput.value;
                }
                
                imageInput.addEventListener('input', function() {
                    if (this.value && this.value.trim() !== '') {
                        previewElement.src = this.value;
                    } else {
                        previewElement.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
                    }
                });
            }
            // For file inputs (Subcategory form)
            else if (imageInput.type === 'file') {
                imageInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewElement.src = e.target.result;
                        }
                        reader.readAsDataURL(this.files[0]);
                        
                        // Update the file input label
                        const label = this.nextElementSibling;
                        if (label && label.classList.contains('custom-file-label')) {
                            label.textContent = this.files[0].name;
                        }
                    } else {
                        previewElement.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
                    }
                });
            }
        }
    }
    
    // Set up image previews (existing + subcategory)
    setupImagePreview('imglink', 'categoryImagePreview');
    setupImagePreview('image', 'subcategoryImagePreview'); // Added for subcategory
    
    // Handle window resize (existing)
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            if (sidebar) sidebar.classList.add('active');
            if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        } else {
            if (sidebar) sidebar.classList.remove('active');
        }
    });
    
    // ===== MODAL FUNCTIONALITY ===== (existing, extended for subcategory)
    function setupModal(openBtn, modal) {
        if (openBtn && modal) {
            openBtn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $(modal).modal('show');
                } else {
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            });
        }
    }
    
    // Set up modal buttons (existing)
    setupModal(openCategoryModalBtn, categoryModal);
    setupModal(openCategoryModalEmptyBtn, categoryModal);
    
    // Close modal when clicking the close button (existing)
    function setupModalClose(modal) {
        if (modal) {
            const closeButtons = modal.querySelectorAll('[data-dismiss="modal"], .close');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (typeof $ !== 'undefined' && $.fn.modal) {
                        $(modal).modal('hide');
                    } else {
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                    }
                });
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    if (typeof $ !== 'undefined' && $.fn.modal) {
                        $(modal).modal('hide');
                    } else {
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                    }
                }
            });
        }
    }
    
    setupModalClose(categoryModal);
    setupModalClose(subcategoryModal); // Added for subcategory modal
    
    // ===== SUBCATEGORY-SPECIFIC FUNCTIONALITY ===== (new additions)
    // Edit subcategory buttons
    document.querySelectorAll('.edit-subcategory').forEach(btn => {
        btn.addEventListener('click', function() {
            const subcategoryId = this.getAttribute('data-id');
            // Here you would fetch the subcategory data via AJAX
            // and populate the edit form in the modal
            $('#subcategoryModal').modal('show');
        });
    });
    
    // Delete subcategory buttons
    document.querySelectorAll('.delete-subcategory').forEach(btn => {
        btn.addEventListener('click', function() {
            const subcategoryId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this subcategory?')) {
                fetch(`/subcategories/${subcategoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
    
    // Initialize modals with jQuery if available (existing)
    if (typeof $ !== 'undefined' && $.fn.modal) {
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        
        // Reset subcategory form when modal is hidden
        $('#subcategoryModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            const preview = document.getElementById('subcategoryImagePreview');
            if (preview) {
                preview.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
            }
            $('.custom-file-label').text('Choose file...');
        });
    }
});
