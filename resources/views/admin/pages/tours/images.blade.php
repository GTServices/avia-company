@extends('admin.layouts.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Управление изображениями тура</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.tours.index') }}"><i class="bi bi-arrow-left"></i> Назад к списку туров</a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Редактировать тур
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Изображения тура: {{ $tour->title }}</h5>
        </div>
        <div class="card-body">
            <!-- Upload Form -->
            <div class="mb-4">
                <form id="upload-form" action="{{ route('admin.tours.images.store', $tour->id) }}" method="POST" class="mb-4" enctype="multipart/form-data" onsubmit="return handleFormSubmit(event)">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="images[]" class="form-control" id="image-input" 
                               accept="image/jpeg,image/png,image/gif,image/webp" multiple required>
                        <button class="btn btn-primary" type="submit" id="upload-button">
                            <i class="bi bi-upload"></i> Загрузить выбранные
                        </button>
                    </div>
                    <div class="form-text">
                        Поддерживаемые форматы: JPG, PNG, GIF, WEBP. Максимальный размер: 4MB на файл
                    </div>
                    <div id="file-list" class="mt-2 mb-2"></div>
                    <div id="upload-status" class="mt-2"></div>
                    <div id="progress-container" class="progress mt-2" style="display: none;">
                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" style="width: 0%"></div>
                    </div>
                </form>
            </div>

            <!-- Images Grid -->
            <div id="images-container" class="row g-3">
                @foreach($tour->images->sortBy('order') as $image)
                    <div class="col-md-4 col-lg-3 image-item" data-id="{{ $image->id }}">
                        <div class="card h-100">
                            <img src="{{ $image->image_url }}" class="card-img-top" alt="Tour image">
                            <div class="card-body p-2 text-center">
                                <button type="button" class="btn btn-sm btn-danger delete-image" 
                                        data-id="{{ $image->id }}" 
                                        data-url="{{ route('admin.tours.images.destroy', [$tour->id, $image->id]) }}">
                                    <i class="bi bi-trash"></i> Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подтверждение удаления</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить это изображение?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Удалить</button>
                </div>
            </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show selected files
                const fileInput = document.getElementById('image-input');
                const fileList = document.getElementById('file-list');
                
                if (fileInput && fileList) {
                    fileInput.addEventListener('change', function() {
                        fileList.innerHTML = '';
                        const files = Array.from(this.files);
                        
                        if (files.length === 0) {
                            fileList.innerHTML = '<div class="text-muted">Файлы не выбраны</div>';
                            return;
                        }
                        
                        files.forEach((file) => {
                            const fileItem = document.createElement('div');
                            fileItem.className = 'd-flex justify-content-between align-items-center mb-1';
                            fileItem.innerHTML = `
                                <div class="text-truncate" style="max-width: 70%;" title="${file.name}">
                                    <i class="bi bi-file-image"></i> ${file.name}
                                </div>
                                <div class="text-muted small">${formatFileSize(file.size)}</div>
                            `;
                            fileList.appendChild(fileItem);
                        });
                    });
                }
                
                // Initialize Sortable for image reordering
                const imagesContainer = document.getElementById('images-container');
                if (imagesContainer) {
                    new Sortable(imagesContainer, {
                        animation: 150,
                        onEnd: function() {
                            const order = [];
                            document.querySelectorAll('.image-item').forEach((item, index) => {
                                order.push({
                                    id: item.dataset.id,
                                    order: index + 1
                                });
                            });
                            
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '{{ route('admin.tours.images.reorder', $tour->id) }}';
                            form.innerHTML = `
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="images" value='${JSON.stringify(order)}'>
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
                
                // Format file size helper function
                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }
            });

            // Confirm delete
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-image')) {
                    animation: 150,
                    onEnd: function() {
                        updateImageOrder();
                    }
                });

                // Handle image upload
                const uploadForm = document.getElementById('upload-form');
                uploadForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const files = document.getElementById('image-input').files;
                    if (files.length === 0) return;

                    const formData = new FormData();
                    for (let i = 0; i < files.length; i++) {
                        formData.append('images[]', files[i]);
                    }

                    const uploadButton = document.getElementById('upload-button');
                    uploadButton.disabled = true;
                    uploadButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Загрузка...';

                    fetch(`/admin/tours/${tourId}/images`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.message || 'Ошибка при загрузке изображений');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Произошла ошибка при загрузке изображений');
                    })
                    .finally(() => {
                        uploadButton.disabled = false;
                        uploadButton.innerHTML = '<i class="bi bi-upload"></i> Загрузить';
                    });
                });

                // Handle delete button click
                document.querySelectorAll('.delete-image').forEach(button => {
                    button.addEventListener('click', function() {
                        imageToDelete = this.dataset.id;
                        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                        modal.show();
                    });
                });

                // Confirm delete
                document.getElementById('confirm-delete').addEventListener('click', function() {
                    if (!imageToDelete) return;

                    fetch(`/admin/tours/${tourId}/images/${imageToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`.image-item[data-id="${imageToDelete}"]`).remove();
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                            modal.hide();
                        } else {
                            alert(data.message || 'Ошибка при удалении изображения');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Произошла ошибка при удалении изображения');
                    });
                });

                // Handle set as main
                document.querySelectorAll('.set-as-main').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            const imageId = this.dataset.id;
                            fetch(`/admin/tours/${tourId}/images/${imageId}/set-main`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.success) {
                                    this.checked = false;
                                    alert(data.message || 'Ошибка при обновлении главного изображения');
                                } else {
                                    // Uncheck other main checkboxes
                                    document.querySelectorAll('.set-as-main').forEach(cb => {
                                        if (cb !== this) cb.checked = false;
                                    });
                                }
                            });
                        }
                    });
                });
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ images: orderData })
                    });
                }
                });
            });
        </script>
        <style>
            .image-item {
                transition: transform 0.2s;
            }
            .image-item:hover {
                transform: scale(1.02);
            }
            .sortable-ghost {
                opacity: 0.5;
                background: #c8ebfb;
            }
        </style>
    @endpush
@endsection
