@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Баннеры</div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">Добавить баннер</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Изображение</th>
            <th>Ключевое слово</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($banners as $banner)
        <tr>
            <td>
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->keyword }}" style="max-width: 150px; height: auto;">
            </td>
            <td>{{ $banner->keyword }}</td>
            <td>
                @if($banner->status)
                    <span class="badge bg-success">Активен</span>
                @else
                    <span class="badge bg-danger">Неактивен</span>
                @endif
            </td>
            <td>
             
                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены, что хотите удалить баннер?')">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderInputs = document.querySelectorAll('.order-input');
    
    orderInputs.forEach(input => {
        input.addEventListener('change', function() {
            const bannerId = this.getAttribute('data-id');
            const newOrder = this.value;
            
            fetch(`/admin/banners/${bannerId}/update-order`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ order: newOrder })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Порядок обновлен');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
    });
});
</script>
@endpush
