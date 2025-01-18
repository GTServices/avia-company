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

                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Действия
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="{{ route('admin.translates.create') }}">
                         Добавить слово
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!--end breadcrumb-->

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.translates.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск по ключу или значению" value="{{ $searchQuery }}">
            <button class="btn btn-primary" type="submit">Искать</button>
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
                @if($searchQuery && !empty($filteredTranslations[$language->lang_code]))
                    <!-- Axtarış Nəticələri -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Ключ</th>
                            <th>Значение</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($filteredTranslations[$language->lang_code] as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td contenteditable="true"
                                    class="editable"
                                    data-lang-code="{{ $language->lang_code }}"
                                    data-key="{{ $key }}">{{ $value }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-btn"
                                            data-lang-code="{{ $language->lang_code }}"
                                            data-key="{{ $key }}"> <i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @elseif(!$searchQuery && !empty($translationsByLanguage[$language->lang_code]))
                    <!-- Ümumi Tərcümələr -->
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
                                <td>
                                    <button class="btn btn-danger btn-sm delete-btn"
                                            data-lang-code="{{ $language->lang_code }}"
                                            data-key="{{ $key }}"> <i class="bi bi-trash"></i></button>

                                </td>
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
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const langCode = this.getAttribute('data-lang-code');
                    const key = this.getAttribute('data-key');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This translation will be deleted!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ route('admin.translations.destroy') }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ lang_code: langCode, key: key })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Translation has been deleted.',
                                            'success'
                                        );
                                        location.reload(); // Yeniləyin
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.message || 'An error occurred.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    Swal.fire(
                                        'Error!',
                                        'Unable to delete the translation. Please try again.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
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
