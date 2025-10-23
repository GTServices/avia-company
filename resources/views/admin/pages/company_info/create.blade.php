@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Добавить информацию о компании</div>
    </div>

    <form method="POST" action="{{ route('admin.company_info.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Favicon Upload -->
        <div class="mb-3">
            <label for="favicon" class="form-label">Favicon</label>
            <input type="file" name="favicon" id="favicon" class="form-control" accept="image/*" onchange="previewImage(this, '#favicon-preview')">
            <img id="favicon-preview" src="#" alt="Favicon Preview" class="img-thumbnail mt-2" style="display: none; max-width: 100px;">
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this, '#image-preview')">
            <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail mt-2" style="display: none; max-width: 300px;">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email_2" class="form-label">Электронная почта 2</label>
            <input type="email" name="email_2" id="email_2" class="form-control">
        </div>
        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label for="phone_2" class="form-label">Телефон 2</label>
            <input type="text" name="phone_2" id="phone_2" class="form-control">
        </div>
        <!-- Social Media Links -->
        <h5 class="mt-4">Социальные сети</h5>
        <div class="mb-3">
            <label for="socials[instagram]" class="form-label">Instagram</label>
            <input type="url" name="instagram" id="socials[instagram]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="socials[facebook]" class="form-label">Facebook</label>
            <input type="url" name="facebook" id="socials[facebook]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="socials[whatsapp]" class="form-label">WhatsApp</label>
            <input type="url" name="whatsapp" id="socials[whatsapp]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="socials[twitter]" class="form-label">Twitter</label>
            <input type="url" name="x" id="socials[twitter]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="socials[youtube]" class="form-label">YouTube</label>
            <input type="url" name="youtube" id="socials[youtube]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="map" class="form-label">Ссылка карты</label>
            <textarea class="form-control" rows="3" name="map" id="map"></textarea>
        </div>
        <!-- Address Translations -->
        <h5 class="mt-4">Адрес</h5>
        <ul class="nav nav-tabs mb-3">
            @foreach($languages as $language)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#address-{{ $language->lang_code }}">
                        {{ strtoupper($language->lang_code) }} ({{ $language->lang_name }})
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($languages as $language)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="address-{{ $language->lang_code }}">
                    <div class="mb-3">
                        <label for="address[{{ $language->lang_code }}]" class="form-label">Адрес ({{ strtoupper($language->lang_code) }})</label>
                        <textarea name="address[{{ $language->lang_code }}]" id="address-{{ $language->lang_code }}" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Copyright Text Translations -->
        <h5 class="mt-4">Текст копирайта</h5>
        <ul class="nav nav-tabs mb-3">
            @foreach($languages as $language)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#copyright-{{ $language->lang_code }}">
                        {{ strtoupper($language->lang_code) }} ({{ $language->lang_name }})
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($languages as $language)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="copyright-{{ $language->lang_code }}">
                    <div class="mb-3">
                        <label for="copyright_text[{{ $language->lang_code }}]" class="form-label">Текст копирайта ({{ strtoupper($language->lang_code) }})</label>
                        <textarea name="copyright_text[{{ $language->lang_code }}]" id="copyright_text-{{ $language->lang_code }}" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection

@push('scripts')
    <script>
        function previewImage(input, previewElement) {
            const preview = document.querySelector(previewElement);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endpush
