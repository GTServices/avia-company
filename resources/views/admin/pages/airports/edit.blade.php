@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <h3>Редактировать аэропорт</h3>
    </div>

    <form method="POST" action="{{ route('admin.airports.update', $airport->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- City Selection -->
        <div class="mb-3">
            <label for="city_id" class="form-label">Город</label>
            <select name="city_id" id="city_id" class="form-control" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ $airport->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->getTranslation('name', 'ru') }}
                    </option>
                @endforeach
            </select>
        </div>


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
                        <label for="name-{{ $language->lang_code }}" class="form-label">Название аэропорта ({{ strtoupper($language->lang_code) }})</label>
                        <input type="text" name="name[{{ $language->lang_code }}]" id="name-{{ $language->lang_code }}" class="form-control" placeholder="Введите название аэропорта на {{ strtoupper($language->lang_code) }}" value="{{ $airport->getTranslation('name', $language->lang_code) }}" required>
                        @error("name.{$language->lang_code}")
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
