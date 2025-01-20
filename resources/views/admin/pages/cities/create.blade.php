@extends('admin.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Добавить новый город</div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.cities.store') }}" enctype="multipart/form-data" novalidate>
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
                        <label for="name-{{ $language->lang_code }}" class="form-label">Название города ({{ strtoupper($language->lang_code) }})</label>
                        <input type="text" name="name[{{ $language->lang_code }}]" id="name-{{ $language->lang_code }}" class="form-control" placeholder="Введите название города на {{ strtoupper($language->lang_code) }}" required>
                        @error("name.{$language->lang_code}")
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
