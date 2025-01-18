@extends('admin.layouts.app')

@section('content')
<!-- Хлебные крошки -->
<div class="page-breadcrumb d-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Добавить новый перевод</div>
</div>

<!-- Форма -->
<form method="POST" action="{{ route('admin.tours.store') }}" enctype="multipart/form-data" novalidate>
    @csrf

    <!-- Поле для изображения -->
    <div class="mb-3">
        <label for="image" class="form-label">Выберите изображение</label>
        <input type="file" name="img" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
        @error('image')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Предпросмотр изображения -->
    <div class="mb-3">
        <img id="image-preview" src="#" alt="Выбранное изображение" style="display: none; max-width: 300px; height: auto; margin-top: 10px;">
    </div>

    <!-- Поле для цены -->
    <div class="mb-3">
        <label for="price" class="form-label">Цена</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Введите цену" required>
        @error('price')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле для даты и времени -->
    <div class="mb-3">
        <label for="datetime" class="form-label">Дата и время</label>
        <input type="datetime-local" name="datetime" id="datetime" class="form-control" required>
        @error('datetime')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле для статуса -->
    <div class="mb-3">
        <label for="status" class="col-sm-3 col-form-label">Статус</label>
        <div class="col-sm-9">
            <div class="form-check form-switch">
                <input name="status" class="form-check-input" type="checkbox" id="status" {{ old('status', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Активен</label>
            </div>
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Вкладки -->
    <ul class="nav nav-tabs mb-3">
        @foreach($languages as $language)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $language->lang_code }}">
                {{ strtoupper($language->lang_code) }} ({{ $language->lang_name }})
            </a>
        </li>
        @endforeach
    </ul>

    <!-- Содержимое вкладок -->
    <div class="tab-content">
        @foreach($languages as $language)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->lang_code }}">
            <div class="mb-3">
                <label for="title-{{ $language->lang_code }}" class="form-label">Перевод для {{ strtoupper($language->lang_code) }}</label>
                <input type="text" name="title[{{ $language->lang_code }}]" id="title-{{ $language->lang_code }}" class="form-control" placeholder="Введите перевод для {{ strtoupper($language->lang_code) }}" required>
                @error("title.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="desc-{{ $language->lang_code }}" class="form-label">Описание для {{ strtoupper($language->lang_code) }}</label>
                <textarea name="desc[{{ $language->lang_code }}]" id="desc-{{ $language->lang_code }}" class="form-control ckeditor" placeholder="Введите описание для {{ strtoupper($language->lang_code) }}" required></textarea>
                @error("desc.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endforeach
    </div>

    <!-- Кнопка отправки -->
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

@endsection

@push("scripts")
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "#";
                preview.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.ckeditor').forEach((element) => {
                ClassicEditor
                    .create(element, {
                        toolbar: [
                            'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                            'blockQuote', 'insertTable', 'undo', 'redo'
                        ],
                        removePlugins: ['MediaEmbed', 'EasyImage']
                    })
                    .then(editor => {
                        editor.ui.view.editable.element.style.height = "400px";
                    })
                    .catch(error => {
                        console.error("Ошибка CKEditor:", error);
                    });
            });
        });
    </script>
@endpush

