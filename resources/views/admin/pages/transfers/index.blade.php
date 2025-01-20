@extends('admin.layouts.app')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tours</li>
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
                        <a class="dropdown-item" href="{{ route('admin.transfers.create') }}">Добавить тур</a>
                    </li>
                    <li>
                        <button class="dropdown-item" id="delete-selected-btn">Удалить выбранные</button>
                    </li>
                    <li>
                        <form class="p-2" action="{{ route('admin.transfers.index') }}" method="GET" style="margin-bottom: 20px;">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Введите для поиска..." value="{{ request('search') }}">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="page-breadcrumb">
        <h3>Трансферы</h3>
    </div>


    <table id="transfers-table" class="table table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>Название</th>
            <th>Дата и время</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Аэропорт вылета</th>
            <th>Аэропорт прилета</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transfers as $transfer)
            <tr data-id="{{ $transfer->id }}">
                <td><input type="checkbox" class="select-checkbox" data-id="{{ $transfer->id }}"></td>
                <td>{{ $transfer->getTranslation('title', 'ru') }}</td>
                <td>{{ $transfer->datetime }}</td>
                <td>{{ $transfer->count }}</td>
                <td>{{ $transfer->price }}</td>
                <td>{{ $transfer->departureAirport->getTranslation("name", "ru") }}</td>
                <td>{{ $transfer->arrivalAirport->getTranslation("name", "ru") }}</td>
                <td>
                    <a href="{{ route('admin.transfers.edit', $transfer->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form class="delete-form" action="{{ route('admin.transfers.destroy', $transfer->id) }}" method="POST" style="display: inline-block; margin: 0;">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

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

            // Handle delete all selected
            $('#delete-selected-btn').on('click', function () {
                if (selectedIds.length === 0) {
                    Swal.fire('Внимание', 'Выберите хотя бы один трансфер.', 'warning');
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
                            url: '{{ route('admin.transfers.delete_selected') }}',
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            data: { selected_ids: selectedIds },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Успех', 'Выбранные трансферы успешно удалены.', 'success')
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
