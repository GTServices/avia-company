@extends('admin.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add New Translation</div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.translates.store') }}" novalidate>
        @csrf

        <!-- Key Field -->
        <div class="mb-3">
            <label for="key" class="form-label">Translation Key</label>
            <input type="text" name="key" id="key" class="form-control" placeholder="Enter translation key" required>
            @error('key')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tabs -->
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
                        <label for="translation-{{ $language->lang_code }}" class="form-label">Translation for {{ strtoupper($language->lang_code) }}</label>
                        <input type="text" name="translations[{{ $language->lang_code }}]" id="translation-{{ $language->lang_code }}" class="form-control" placeholder="Enter translation for {{ strtoupper($language->lang_code) }}" required>
                        @error("translations.{$language->lang_code}")
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Add Translation</button>
    </form>
@endsection
