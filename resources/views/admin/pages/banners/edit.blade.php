@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Редактировать баннер</div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this, 'image-preview')">
        @error('image')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <img id="image-preview" src="{{ asset('storage/' . $banner->image) }}" alt="Current Image" style="max-width: 300px; height: auto; {{ $banner->image ? '' : 'display: none;' }}">
    </div>

    <div class="mb-3">
        <div class="form-check form-switch">
            <input name="status" class="form-check-input" type="checkbox" id="status" {{ $banner->status ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Активен</label>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        @foreach($languages as $language)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $language->lang_code }}">
                {{ strtoupper($language->lang_code) }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($languages as $language)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->lang_code }}">
            <div class="mb-3">
                <label for="keyword-{{ $language->lang_code }}" class="form-label">Keyword ({{ strtoupper($language->lang_code) }})</label>
                <input type="text" name="keyword[{{ $language->lang_code }}]" id="keyword-{{ $language->lang_code }}" 
                       class="form-control" value="{{ $banner->getTranslation('keyword', $language->lang_code) }}">
                @error("keyword.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Назад</a>
</form>

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection

