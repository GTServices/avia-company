@extends('admin.layouts.app')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.tours.store') }}" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="mb-3">
        <label for="img" class="form-label">Изображение</label>
        <input type="file" name="img" id="img" class="form-control" accept="image/*" onchange="previewImage(this)">
        @error('img')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <img id="image-preview" src="#" alt="Предпросмотр" style="display:none;max-width:300px;height:auto;margin-top:10px;">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Цена</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="form-control" required>
        @error('price')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="biletstockcount" class="form-label">Количество</label>
        <input type="number" name="biletstockcount" id="biletstockcount" value="{{ old('biletstockcount') }}" class="form-control" required>
        @error('biletstockcount')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="datetime" class="form-label">Дата и время</label>
        <input type="datetime-local" name="datetime" id="datetime" value="{{ old('datetime') }}" class="form-control" required>
        @error('datetime')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-check form-switch">
            <input name="status" class="form-check-input" type="checkbox" id="status" {{ old('status', 1) ? 'checked' : '' }}>
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
                <label for="title-{{ $language->lang_code }}" class="form-label">Название ({{ strtoupper($language->lang_code) }})</label>
                <input type="text" name="title[{{ $language->lang_code }}]" id="title-{{ $language->lang_code }}"
                       value="{{ old('title.' . $language->lang_code) }}" class="form-control" required>
                @error("title.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="desc-{{ $language->lang_code }}" class="form-label">Описание ({{ strtoupper($language->lang_code) }})</label>
                <textarea name="desc[{{ $language->lang_code }}]" id="desc-{{ $language->lang_code }}"
                          class="form-control ckeditor" required>{{ old('desc.' . $language->lang_code) }}</textarea>
                @error("desc.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="card_description-{{ $language->lang_code }}" class="form-label">Краткое описание для карточки ({{ strtoupper($language->lang_code) }})</label>
                <textarea name="card_description[{{ $language->lang_code }}]" id="card_description-{{ $language->lang_code }}"
                          class="form-control" rows="3" placeholder="Краткое описание для отображения на карточке тура">{{ old('card_description.' . $language->lang_code) }}</textarea>
                @error("card_description.{$language->lang_code}")
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

@push("scripts")
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
function previewImage(input){
    const preview=document.getElementById('image-preview');
    if(input.files&&input.files[0]){
        const reader=new FileReader();
        reader.onload=e=>{
            preview.src=e.target.result;
            preview.style.display='block';
        };
        reader.readAsDataURL(input.files[0]);
    }else{
        preview.src="#";
        preview.style.display='none';
    }
}
document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('.ckeditor').forEach(el=>{
        ClassicEditor.create(el).catch(err=>console.error(err));
    });
});
</script>
@endpush
@endsection
