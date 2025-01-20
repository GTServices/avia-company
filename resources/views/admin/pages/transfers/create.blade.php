@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Добавить новый трансфер</div>
    </div>

    <form method="POST" action="{{ route('admin.transfers.store') }}" novalidate enctype="multipart/form-data">
        @csrf

        <!-- Tabs for languages -->
        <ul class="nav nav-tabs mb-3">
            @foreach($languages as $language)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $language->lang_code }}">
                        {{ strtoupper($language->lang_code) }} ({{ $language->lang_name }})
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            @foreach($languages as $language)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->lang_code }}">
                    <div class="mb-3">
                        <label for="title-{{ $language->lang_code }}" class="form-label">Название трансфера ({{ strtoupper($language->lang_code) }})</label>
                        <input type="text" name="title[{{ $language->lang_code }}]" id="title-{{ $language->lang_code }}" class="form-control" placeholder="Введите название на {{ strtoupper($language->lang_code) }}" required>
                        @error("title.{$language->lang_code}")
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description-{{ $language->lang_code }}" class="form-label">Описание трансфера ({{ strtoupper($language->lang_code) }})</label>
                        <textarea name="description[{{ $language->lang_code }}]" id="description-{{ $language->lang_code }}" class="form-control ckeditor" placeholder="Введите описание на {{ strtoupper($language->lang_code) }}" rows="4"></textarea>
                        @error("description.{$language->lang_code}")
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Preview -->
        <div class="mb-3">
            <img id="image-preview" src="#" alt="Выбранное изображение" style="display: none; max-width: 300px; height: auto; margin-top: 10px;">
        </div>

        <!-- Date and Time -->
        <div class="mb-3">
            <label for="datetime" class="form-label">Дата и время</label>
            <input type="datetime-local" name="datetime" id="datetime" class="form-control" required>
            @error('datetime')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Passenger Count -->
        <div class="mb-3">
            <label for="count" class="form-label">Количеств</label>
            <input type="number" name="count" id="count" class="form-control" min="1" required>
            @error('count')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Departure Airport -->
        <div class="mb-3">
            <label for="departure_airport_id" class="form-label">Аэропорт вылета</label>
            <select name="departure_airport_id" id="departure_airport_id" class="form-control" required>
                <option value="">Выберите аэропорт</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->getTranslation('name', 'ru') }}</option>
                @endforeach
            </select>
            @error('departure_airport_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Arrival Airport -->
        <div class="mb-3">
            <label for="arrival_airport_id" class="form-label">Аэропорт прилета</label>
            <select name="arrival_airport_id" id="arrival_airport_id" class="form-control" required>
                <option value="">Выберите аэропорт</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->getTranslation('name', 'ru') }}</option>
                @endforeach
            </select>
            @error('arrival_airport_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" name="price" id="price" class="form-control" min="0" step="0.01" required>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
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
