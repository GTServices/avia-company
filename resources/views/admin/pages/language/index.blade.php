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
                    <a class="dropdown-item" href="{{ route('admin.languages.create') }}">Добавить язык</a>
                    <button class="dropdown-item" id="delete-selected-btn">Удалить выбранные</button>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table id="languages-table" style="width: 100%; min-width: 900px; border-collapse: collapse; margin-bottom: 0;">
                <thead style="background-color: #343a40; color: white;">
                <tr>
                    <th scope="col" style="padding: 10px; text-align: left;">#</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Выбор</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Язык</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Код языка</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Флаг</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Основной язык</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Статус</th>
                    <th scope="col" style="padding: 10px; text-align: left;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($languages as $key => $language)
                    <tr data-id="{{ $language->id }}">
                        <td style="padding: 10px;">{{ $key + 1 }}</td>
                        <td style="padding: 10px;">
                            <input class="form-check-input" type="checkbox" style="margin: 0; padding: 0;" data-id="{{ $language->id }}">
                        </td>
                        <td style="padding: 10px;">{{ $language->lang_name }}</td>
                        <td style="padding: 10px;">{{ $language->lang_code }}</td>
                        <td style="padding: 10px;">
                            <img src="https://flagcdn.com/w40/{{ $language->lang_code }}.png" alt="{{ $language->lang_name }} Flag">
                        </td>
                        <td style="padding: 10px;">
                            @if($language->is_main)
                                <span style="padding: 5px 10px; background-color: #198754; color: white; border-radius: 4px;">Да</span>
                            @else
                                <span style="padding: 5px 10px; background-color: #6c757d; color: white; border-radius: 4px;">Нет</span>
                            @endif
                        </td>
                        <td style="padding: 10px;">
                            @if($language->status)
                                <span style="padding: 5px 10px; background-color: #198754; color: white; border-radius: 4px;">Активен</span>
                            @else
                                <span style="padding: 5px 10px; background-color: #dc3545; color: white; border-radius: 4px;">Неактивен</span>
                            @endif
                        </td>
                        <td style="padding: 10px;">
                            <a href="{{ route('admin.languages.edit', $language->id) }}" style="text-decoration: none; padding: 5px 10px; background-color: #0d6efd; color: white; border-radius: 4px; display: inline-block;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form class="delete-form" action="{{ route('admin.languages.destroy', $language->id) }}" method="POST" style="display: inline-block; margin: 0;">
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
        </div>
    </div>
@endsection



@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableBody = document.querySelector('#languages-table tbody');
            const deleteSelectedButton = document.getElementById('delete-selected-btn');
            let selectedIds = [];

            // Initialize SortableJS on tbody
            if (tableBody) {
                new Sortable(tableBody, {
                    animation: 150,
                    onEnd: function (evt) {
                        let order = Array.from(tableBody.querySelectorAll('tr')).map(row => row.dataset.id);
                        console.log('New Order:', order);

                        fetch("{{ route('admin.languages.reorder') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Успех', 'Порядок языков успешно обновлен!', 'success');
                                } else {
                                    Swal.fire('Ошибка', 'Произошла ошибка при обновлении порядка.', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка:', error);
                                Swal.fire('Ошибка', 'Произошла ошибка при обновлении порядка.', 'error');
                            });
                    }
                });
            }

            // Handle checkbox change
            document.querySelectorAll('.form-check-input').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const id = this.dataset.id;
                    if (this.checked) {
                        if (!selectedIds.includes(id)) {
                            selectedIds.push(id);
                        }
                    } else {
                        selectedIds = selectedIds.filter(item => item !== id);
                    }
                    console.log('Selected IDs:', selectedIds);
                });
            });

            // Handle individual delete button click
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

            // Handle bulk delete button click
            if (deleteSelectedButton) {
                deleteSelectedButton.addEventListener('click', function () {
                    if (selectedIds.length === 0) {
                        Swal.fire('Внимание', 'Выберите хотя бы один язык для удаления.', 'warning');
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
                            fetch("{{ route('admin.delete_languages') }}", {
                                method: "POST",
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ selected_ids: selectedIds })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Успех', 'Выбранные языки успешно удалены!', 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Ошибка', 'Произошла ошибка при удалении.', 'error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Ошибка:', error);
                                    Swal.fire('Ошибка', 'Произошла ошибка при удалении.', 'error');
                                });
                        }
                    });
                });
            }
        });

    </script>
@endpush


