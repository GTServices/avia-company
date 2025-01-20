@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Добавить новую политику конфиденциальности</div>
    </div>

    <form method="POST" action="{{ route('admin.privacy_policies.store') }}" novalidate>
        @csrf

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
                        <label for="policy-{{ $language->lang_code }}" class="form-label">Политика на {{ strtoupper($language->lang_code) }}</label>
                        <textarea name="policy[{{ $language->lang_code }}]" id="policy-{{ $language->lang_code }}" class="form-control ckeditor" placeholder="Введите политику на {{ strtoupper($language->lang_code) }}" rows="8"></textarea>
                        @error("policy.{$language->lang_code}")
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
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.ckeditor').forEach((element) => {
                ClassicEditor
                    .create(element)
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
