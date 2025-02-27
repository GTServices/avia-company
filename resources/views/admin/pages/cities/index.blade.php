@extends('admin.layouts.app')

@section("content")
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
                        <a class="dropdown-item" href="{{ route('admin.cities.create') }}">Добавить город</a>
                    </li>
                    <li>
                        <button class="dropdown-item" id="delete-selected-btn">Удалить выбранные</button>
                    </li>
                    <li>
                        <form class="p-2" action="{{ route('admin.cities.index') }}" method="GET" style="margin-bottom: 20px;">
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

    <div class="card">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table id="cities-table" style="width: 100%; min-width: 600px; border-collapse: collapse; margin-bottom: 0;">
                <thead style="background-color: #343a40; color: white;">
                <tr>
                    <th style="padding: 10px;"><input id="select-all" type="checkbox"></th>
                    <th style="padding: 10px;">#</th>
                    <th style="padding: 10px;">Название</th>
                    <th style="padding: 10px;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $key => $city)
                    <tr data-id="{{ $city->id }}">
                        <td style="padding: 10px;">
                            <input type="checkbox" class="form-check-input select-checkbox" data-id="{{ $city->id }}">
                        </td>
                        <td style="padding: 10px;">{{ $key + 1 }}</td>
                        <td style="padding: 10px;">
                            @foreach($city->getTranslations('name') as $locale => $translation)
                                <div>
                                    <strong>{{ strtoupper($locale) }}:</strong> {{ $translation }}
                                </div>
                            @endforeach
                        </td>
                        <td style="padding: 10px;">
                            <a href="{{ route('admin.cities.edit', $city->id) }}" style="text-decoration: none; padding: 5px 10px; background-color: #0d6efd; color: white; border-radius: 4px; display: inline-block;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form class="delete-form" action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display: inline-block; margin: 0;">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let selectedIds = [];

        // Выбрать все чекбоксы
        document.getElementById('select-all').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.select-checkbox');
            selectedIds = [];
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                if (this.checked) {
                    selectedIds.push(checkbox.dataset.id);
                }
            });
            console.log('Выбранные ID:', selectedIds);
        });

        // Выбрать индивидуальный чекбокс
        document.querySelectorAll('.select-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const id = this.dataset.id;
                if (this.checked) {
                    if (!selectedIds.includes(id)) selectedIds.push(id);
                } else {
                    selectedIds = selectedIds.filter(item => item !== id);
                }
                console.log('Выбранные ID:', selectedIds);
            });
        });

        // Удаление выбранных
        document.getElementById('delete-selected-btn').addEventListener('click', function () {
            if (selectedIds.length === 0) {
                Swal.fire('Внимание', 'Выберите хотя бы один город для удаления.', 'warning');
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
                    fetch("{{ route('admin.cities.delete_selected') }}", {
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
                                Swal.fire('Успех', 'Выбранные города успешно удалены!', 'success').then(() => {
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

        // Удаление отдельного города
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
    </script>
@endpush
