// filename: app.js
document.addEventListener('DOMContentLoaded', function() {
    // ===== MOBILE NAVIGATION =====
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    const mobileUserBtn = document.querySelector('.mobile-user-btn');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    
    // Toggle Sidebar
    if (mobileMenuToggle && sidebar) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            
            // Close dropdown if open
            if (mobileDropdown.classList.contains('active')) {
                mobileDropdown.classList.remove('active');
            }
        });
    }
    
    // Toggle User Dropdown
    if (mobileUserBtn && mobileDropdown) {
        mobileUserBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileDropdown.classList.toggle('active');
            
            // Close sidebar if open
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        });
    }
    
    // Close Dropdown and Sidebar when clicking outside
    document.addEventListener('click', function(e) {
        // Close dropdown
        if (mobileDropdown.classList.contains('active') && 
            !e.target.closest('.mobile-user-menu')) {
            mobileDropdown.classList.remove('active');
        }
        
        // Close sidebar
        if (sidebar.classList.contains('active') && 
            !e.target.closest('.sidebar') && 
            !e.target.closest('.mobile-menu-toggle')) {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        }
    });
    
    // Close when clicking on overlay
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            this.classList.remove('active');
            
            // Also close dropdown if open
            if (mobileDropdown.classList.contains('active')) {
                mobileDropdown.classList.remove('active');
            }
        });
    }
    
    // Close when clicking ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            mobileDropdown.classList.remove('active');
        }
    });
    
    // Close dropdown/sidebar when clicking on links
    document.querySelectorAll('.mobile-dropdown a, .sidebar-menu a').forEach(link => {
        link.addEventListener('click', function() {
            mobileDropdown.classList.remove('active');
            if (window.innerWidth < 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        });
    });

    // ===== MODAL FUNCTIONALITY =====
    const modals = {
        category: document.getElementById('categoryModal'),
        subcategory: document.getElementById('subcategoryModal'),
        product: document.getElementById('productModal'),
        editCategory: document.getElementById('editCategoryModal')
    };

    // Generic modal setup function
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

    // Generic modal close function
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

    // Initialize all modals
    Object.values(modals).forEach(modal => {
        if (modal) setupModalClose(modal);
    });

    // Set up specific modal triggers
    const openCategoryModalBtn = document.getElementById('openCategoryModal');
    const openCategoryModalEmptyBtn = document.getElementById('openCategoryModalEmpty');
    if (openCategoryModalBtn) setupModal(openCategoryModalBtn, modals.category);
    if (openCategoryModalEmptyBtn) setupModal(openCategoryModalEmptyBtn, modals.category);

    // Edit category modal setup
    document.querySelectorAll('.edit-category').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const fulldesc = this.dataset.fulldesc;
            const img_link = this.dataset.img_link;
            
            const form = modals.editCategory.querySelector('form');
            form.action = `/category/update/${id}`;
            form.querySelector('#name').value = name;
            form.querySelector('#fulldesc').value = fulldesc;
            form.querySelector('#img_link').value = img_link;
            
            const preview = form.querySelector('#imagePreview');
            preview.src = img_link || 'https://via.placeholder.com/300x200?text=Image+Preview';
            
            if (typeof $ !== 'undefined' && $.fn.modal) {
                $(modals.editCategory).modal('show');
            } else {
                modals.editCategory.style.display = 'block';
            }
        });
    });

    // ===== IMAGE PREVIEW FUNCTIONALITY =====
    function setupImagePreview(inputId, previewId) {
        const imageInput = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);
        
        if (imageInput && previewElement) {
            if (imageInput.type === 'text') {
                // For URL inputs
                if (imageInput.value) {
                    previewElement.src = imageInput.value;
                }
                
                imageInput.addEventListener('input', function() {
                    previewElement.src = this.value.trim() || 'https://via.placeholder.com/300x200?text=Image+Preview';
                });
            } else if (imageInput.type === 'file') {
                // For file inputs
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

    // Set up all image previews
    setupImagePreview('imglink', 'categoryImagePreview');
    setupImagePreview('image', 'subcategoryImagePreview');
    setupImagePreview('image', 'productImagePreview');
    setupImagePreview('img_link', 'imagePreview');

    // File input label updates
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.value.split('\\').pop();
            const label = e.target.nextElementSibling;
            if (label.classList.contains('custom-file-label')) {
                label.textContent = fileName;
            }
        });
    });

    // ===== CATEGORY-SUBCATEGORY RELATIONSHIP =====
    // const categorySelect = document.getElementById('category_id');
    // const subcategorySelect = document.getElementById('subcategory_id');
    
    // if (categorySelect && subcategorySelect) {
    //     const subcategoryOptions = Array.from(subcategorySelect.options);
        
    //     function filterSubcategories() {
    //         const selectedCategoryId = categorySelect.value;
    //         subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            
    //         subcategoryOptions.forEach(option => {
    //             const categoryId = option.getAttribute('data-category-id');
    //             if (categoryId === selectedCategoryId) {
    //                 subcategorySelect.appendChild(option);
    //             }
    //         });
    //     }

    //     categorySelect.addEventListener('change', filterSubcategories);
    //     if (categorySelect.value) filterSubcategories();
    // }

    // // ===== PRODUCT MANAGEMENT =====
    // // Dynamic subcategory loading via API
    // if (categorySelect && subcategorySelect) {
    //     categorySelect.addEventListener('change', function() {
    //         const categoryId = this.value;
    //         subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            
    //         if (categoryId) {
    //             fetch(`/api/subcategories?category_id=${categoryId}`)
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     data.forEach(subcategory => {
    //                         const option = document.createElement('option');
    //                         option.value = subcategory.id;
    //                         option.textContent = subcategory.name;
    //                         subcategorySelect.appendChild(option);
    //                     });
    //                 })
    //                 .catch(console.error);
    //         }
    //     });
        
    //     if (categorySelect.value) {
    //         categorySelect.dispatchEvent(new Event('change'));
    //     }
    // }


//     document.addEventListener('DOMContentLoaded', function () {
//     const categorySelect = document.getElementById('category_id');
//     const subcategorySelect = document.getElementById('subcategory_id');

//     // Save initial subcategory options in a separate array (deep clone)
//     const allSubcategories = Array.from(subcategorySelect.querySelectorAll('option'))
//         .map(option => ({
//             value: option.value,
//             text: option.textContent,
//             categoryId: option.dataset.categoryId || null
//         }));

//     function filterSubcategories(categoryId) {
//         // Clear subcategories (keep placeholder)
//         subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

//         // Filter subcategories by selected categoryId & append new options
//         allSubcategories.forEach(subcat => {
//             if (subcat.categoryId === categoryId) {
//                 const newOption = document.createElement('option');
//                 newOption.value = subcat.value;
//                 newOption.textContent = subcat.text;
//                 subcategorySelect.appendChild(newOption);
//             }
//         });
//     }

//     // Category change event
//     categorySelect.addEventListener('change', function () {
//         const selectedCategoryId = this.value;
//         filterSubcategories(selectedCategoryId);
//     });

//     // On page load, trigger it to restore old values (if any)
//     const selectedCategoryId = categorySelect.value;
//     if (selectedCategoryId) {
//         filterSubcategories(selectedCategoryId);

//         // Restore old subcategory value if exists
//         const oldSubcategory = "{{ old('subcategory_id') }}";
//         if (oldSubcategory) {
//             subcategorySelect.value = oldSubcategory;
//         }
//     }
// });


    




    
    // Edit product functionality
    document.querySelectorAll('.edit-product').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            fetch(`/products/${productId}/edit`)
                .then(response => response.json())
                .then(product => {
                    // Populate form fields
                    document.getElementById('name').value = product.name;
                    document.getElementById('description').value = product.description;
                    // document.getElementById('price').value = product.price;
                    document.getElementById('category_id').value = product.category_id;
                    
                    // Trigger subcategory loading
                    const categorySelect = document.getElementById('category_id');
                    if (categorySelect) {
                        categorySelect.dispatchEvent(new Event('change'));
                        setTimeout(() => {
                            document.getElementById('subcategory_id').value = product.subcategory_id;
                        }, 300);
                    }
                    
                    document.getElementById('status').value = product.status;
                    
                    // Set image preview
                    const preview = document.getElementById('productImagePreview');
                    if (product.image_url) preview.src = product.image_url;
                    
                    // Update form action
                    const form = modals.product.querySelector('form');
                    form.action = `/products/${productId}`;
                    
                    // Add method spoofing for PUT
                    let methodInput = form.querySelector('input[name="_method"]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        form.appendChild(methodInput);
                    }
                    methodInput.value = 'PUT';
                    
                    // Show modal
                    if (typeof $ !== 'undefined' && $.fn.modal) {
                        $(modals.product).modal('show');
                    } else {
                        modals.product.style.display = 'block';
                    }
                })
                .catch(console.error);
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Add rupee symbol to price input
        const priceInput = document.getElementById('price');
        if (priceInput) {
            priceInput.addEventListener('focus', function() {
                if (!this.value.startsWith('₹')) {
                    this.value = '₹' + this.value;
                }
            });
            
            priceInput.addEventListener('blur', function() {
                if (this.value === '₹') {
                    this.value = '';
                }
            });
        }
    });
    
    // Delete product functionality
    document.querySelectorAll('.delete-product').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this product?')) {
                fetch(`/products/${productId}`, {
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
                    } else {
                        alert('Error deleting product: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting product');
                });
            }
        });
    });

    // jQuery modal enhancements if available
    if (typeof $ !== 'undefined' && $.fn.modal) {
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        
        $('#subcategoryModal, #productModal').on('hidden.bs.modal', function() {
            const form = $(this).find('form')[0];
            form.reset();
            
            const previewId = this.id === 'subcategoryModal' ? 
                'subcategoryImagePreview' : 'productImagePreview';
            const preview = document.getElementById(previewId);
            if (preview) preview.src = 'https://via.placeholder.com/300x200?text=Image+Preview';
            
            $('.custom-file-label').text('Choose file...');
            
            if (this.id === 'productModal') {
                form.action = '/products';
                $('input[name="_method"]').remove();
                
                const subcategorySelect = document.getElementById('subcategory_id');
                if (subcategorySelect) {
                    subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
                }
            }
        });
    }
});

