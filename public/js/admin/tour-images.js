document.addEventListener('DOMContentLoaded', function() {
    const uploadForm = document.getElementById('upload-image-form');
    const imageInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');
    const imageList = document.getElementById('image-list');
    const dropZone = document.getElementById('drop-zone');
    const tourId = document.querySelector('meta[name="tour-id"]')?.content;

    if (!tourId) return;

    // Handle file selection
    if (imageInput) {
        imageInput.addEventListener('change', handleFileSelect);
    }

    // Handle drag and drop
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);
    }

    // Handle image deletion
    if (imageList) {
        imageList.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-image')) {
                e.preventDefault();
                const imageId = e.target.dataset.id;
                deleteImage(imageId);
            }
        });

        // Initialize sortable
        new Sortable(imageList, {
            animation: 150,
            onEnd: function() {
                updateImageOrder();
            }
        });
    }

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropZone.classList.add('border-primary');
    }

    function unhighlight() {
        dropZone.classList.remove('border-primary');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (!files.length) return;

        const formData = new FormData();
        formData.append('image', files[0]);

        uploadImage(formData);
    }

    function uploadImage(formData) {
        fetch(`/admin/tours/${tourId}/images`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addImageToGallery(data.image);
                showToast('success', 'Image uploaded successfully');
            } else {
                showToast('error', data.message || 'Failed to upload image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'An error occurred while uploading the image');
        });
    }

    function deleteImage(imageId) {
        if (!confirm('Are you sure you want to delete this image?')) return;

        fetch(`/admin/tours/${tourId}/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`.image-item[data-id="${imageId}"]`).remove();
                showToast('success', 'Image deleted successfully');
            } else {
                showToast('error', data.message || 'Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'An error occurred while deleting the image');
        });
    }

    function updateImageOrder() {
        const items = imageList.querySelectorAll('.image-item');
        const orderData = Array.from(items).map((item, index) => ({
            id: item.dataset.id,
            order: index
        }));

        fetch(`/admin/tours/${tourId}/images/reorder`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ images: orderData })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                showToast('error', data.message || 'Failed to update image order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'An error occurred while updating the image order');
        });
    }

    function addImageToGallery(image) {
        const imageItem = document.createElement('div');
        imageItem.className = 'image-item';
        imageItem.dataset.id = image.id;
        imageItem.style.order = image.order;
        
        imageItem.innerHTML = `
            <div class="card">
                <img src="${image.url}" class="card-img-top" alt="Tour image">
                <div class="card-body p-2 text-center">
                    <button type="button" class="btn btn-sm btn-danger delete-image" data-id="${image.id}">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;
        
        if (imageList) {
            imageList.appendChild(imageItem);
        }
    }

    function showToast(type, message) {
        // Implement your toast notification here or use a library
        alert(message); // Simple fallback
    }
});
