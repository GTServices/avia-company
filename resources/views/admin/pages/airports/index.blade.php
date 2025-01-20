@extends('admin.layouts.app')
@push('head')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Панель управления</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Города</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Действия
                </button>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.airports.create') }}">Добавить аэропорт</a>
                    </li>
                    <li>
                        <button class="dropdown-item" id="delete-selected-btn">Удалить выбранные</button>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="page-breadcrumb">
        <h3>Аэропорты</h3>
    </div>

    <div class="mb-3">
        <form method="GET" action="{{ route('admin.airports.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <select name="city_id" class="form-control">
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->getTranslation('name', 'ru') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Фильтр</button>
                </div>
            </div>
        </form>
    </div>

    <table id="airports-table" class="table table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>Город</th>
            <th>Название аэропорта</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($airports as $airport)
            <tr data-id="{{ $airport->id }}">
                <td><input type="checkbox" class="select-checkbox" data-id="{{ $airport->id }}"></td>
                <td>{{ $airport->city->getTranslation('name', 'ru') }}</td>
                <td>
                    @foreach($airport->getTranslations('name') as $locale => $translation)
                        <div><strong>{{ strtoupper($locale) }}:</strong> {{ $translation }}</div>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.airports.edit', $airport->id) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form class="delete-form" action="{{ route('admin.airports.destroy', $airport->id) }}" method="POST" style="display: inline-block; margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" type="button" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#airports-table').DataTable();

            let selectedIds = [];

            // Select all checkboxes
            $('#select-all').on('change', function () {
                const checkboxes = $('.select-checkbox');
                checkboxes.prop('checked', this.checked);
                selectedIds = this.checked ? checkboxes.map((_, el) => $(el).data('id')).get() : [];
            });

            // Track individual checkbox selections
            $('.select-checkbox').on('change', function () {
                const id = $(this).data('id');
                if (this.checked) {
                    selectedIds.push(id);
                } else {
                    selectedIds = selectedIds.filter(selectedId => selectedId !== id);
                }
            });

            // Handle delete selected
            $('#delete-selected-btn').on('click', function () {
                if (selectedIds.length === 0) {
                    Swal.fire('Внимание', 'Выберите хотя бы один аэропорт.', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Вы уверены?',
                    text: "Это действие нельзя отменить!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.airports.delete_selected') }}',
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            data: { selected_ids: selectedIds },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Успех', 'Выбранные аэропорты успешно удалены.', 'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Ошибка', 'Произошла ошибка при удалении.', 'error');
                                }
                            },
                            error: function () {
                                Swal.fire('Ошибка', 'Произошла ошибка при удалении.', 'error');
                            }
                        });
                    }
                });
            });

            // Handle individual delete
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Вы уверены?',
                        text: "Это действие нельзя отменить!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Да, удалить!',
                        cancelButtonText: 'Отмена'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
