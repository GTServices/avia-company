@extends('admin.layouts.app')

@section("content")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Languages</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Settings</button>
                <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="{{ route('admin.translates.create') }}">Добавить слово</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.languages.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by key or value" value="{{ $searchQuery }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        @foreach($languages as $language)
            <li class="nav-item">
                <a class="nav-link {{ $language->lang_code === 'ru' ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $language->lang_code }}">
                    {{ strtoupper($language->lang_code) }} ({{ $language->lang_name }})
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        @foreach($languages as $language)
            <div class="tab-pane fade {{ $language->lang_code === 'ru' ? 'show active' : '' }}" id="tab-{{ $language->lang_code }}">
                @if(!empty($translationsByLanguage[$language->lang_code]))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($translationsByLanguage[$language->lang_code] as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td contenteditable="true"
                                    class="editable"
                                    data-lang-code="{{ $language->lang_code }}"
                                    data-key="{{ $key }}">{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No translations available for this language.</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editableElements = document.querySelectorAll('.editable');

            editableElements.forEach(element => {
                element.addEventListener('blur', function () {
                    const langCode = this.getAttribute('data-lang-code');
                    const key = this.getAttribute('data-key');
                    const value = this.textContent.trim();

                    // AJAX ilə backend-ə göndər
                    fetch('{{ route('admin.translations.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ lang_code: langCode, key: key, value: value })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Translation Updated',
                                    text: 'Translation updated successfully!',
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'An error occurred while updating translation.',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to update translation. Please try again.',
                            });
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endpush
