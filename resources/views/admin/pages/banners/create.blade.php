@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Добавить баннер</div>
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

<form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this, 'image-preview')" required>
        @error('image')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <img id="image-preview" src="#" alt="Preview" style="display:none;max-width:300px;height:auto;margin-top:10px;">
    </div>

    <div class="mb-3">
        <label for="keyword" class="form-label">Keyword</label>
        <input type="text" name="keyword" id="keyword" class="form-control" value="{{ old('keyword') }}">
        @error('keyword')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-check form-switch">
            <input name="status" class="form-check-input" type="checkbox" id="status" checked>
            <label class="form-check-label" for="status">Активен</label>
        </div>
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
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
@endpush
@endsection

