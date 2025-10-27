@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Banner-lər</div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">Yeni Banner</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Şəkil</th>
            <th>Keyword</th>
            <th>Status</th>
            <th>Order</th>
            <th>Əməliyyatlar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($banners as $banner)
        <tr>
            <td>
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->keyword }}" style="max-width: 150px; height: auto;">
            </td>
            <td>{{ $banner->getTranslation('keyword', app()->getLocale()) }}</td>
            <td>
                @if($banner->status)
                    <span class="badge bg-success">Aktiv</span>
                @else
                    <span class="badge bg-danger">Qeyri-aktiv</span>
                @endif
            </td>
            <td>{{ $banner->order }}</td>
            <td>
                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">Redaktə</a>
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Banner-i silmək istədiyinizə əminsiniz?')">Sil</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

