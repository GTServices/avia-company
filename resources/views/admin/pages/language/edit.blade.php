@extends('admin.layouts.app')

@section("content")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Language</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Редактировать язык</h5>
                    <form action="{{ route('admin.languages.update', $language->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="langCode" class="col-sm-3 col-form-label">Код языка</label>
                            <div class="col-sm-9">
                                <input type="text" name="lang_code" class="form-control" id="langCode" placeholder="Введите код языка" value="{{ old('lang_code', $language->lang_code) }}">
                                @error('lang_code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="siteLangCode" class="col-sm-3 col-form-label">Код отображения на сайте</label>
                            <div class="col-sm-9">
                                <input type="text" name="site_lang_code" class="form-control" id="siteLangCode" placeholder="Введите код отображения на сайте" value="{{ old('site_lang_code', $language->site_lang_code) }}">
                                @error('site_lang_code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="isMain" class="col-sm-3 col-form-label">Основной язык</label>
                            <div class="col-sm-9">
                                <select name="is_main" class="form-select" id="isMain">
                                    <option value="" selected>Выберите</option>
                                    <option value="1" {{ old('is_main', $language->is_main) == 1 ? 'selected' : '' }}>Да</option>
                                    <option value="0" {{ old('is_main', $language->is_main) == 0 ? 'selected' : '' }}>Нет</option>
                                </select>
                                @error('is_main')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="langName" class="col-sm-3 col-form-label">Название языка</label>
                            <div class="col-sm-9">
                                <input type="text" name="lang_name" class="form-control" id="langName" placeholder="Введите название языка" value="{{ old('lang_name', $language->lang_name) }}">
                                @error('lang_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">Статус</label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch">
                                    <input name="status" class="form-check-input" type="checkbox" id="status" {{ old('status', $language->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Активен</label>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
