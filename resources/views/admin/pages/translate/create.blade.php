@extends('admin.layouts.app')

@section("content")
    @include('admin.layouts.includes.partials._breadcrumb')
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Форма языка</h5>
                    <form action="{{ route('admin.translates.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="langCode" class="col-sm-3 col-form-label">Код языка</label>
                            <div class="col-sm-9">
                                <input type="text" name="lang_code" class="form-control" id="langCode" placeholder="Введите код языка" value="{{ old('lang_code') }}">
                                @error('lang_code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="siteLangCode" class="col-sm-3 col-form-label">Код языка сайта</label>
                            <div class="col-sm-9">
                                <input type="text" name="site_lang_code" class="form-control" id="siteLangCode" placeholder="Введите код языка сайта" value="{{ old('site_lang_code') }}">
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
                                    <option value="1" {{ old('is_main') == 1 ? 'selected' : '' }}>Да</option>
                                    <option value="0" {{ old('is_main') == 0 ? 'selected' : '' }}>Нет</option>
                                </select>
                                @error('is_main')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="langName" class="col-sm-3 col-form-label">Название языка</label>
                            <div class="col-sm-9">
                                <input type="text" name="lang_name" class="form-control" id="langName" placeholder="Введите название языка" value="{{ old('lang_name') }}">
                                @error('lang_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="siteName" class="col-sm-3 col-form-label">Название сайта</label>
                            <div class="col-sm-9">
                                <input type="text" name="site_name" class="form-control" id="siteName" placeholder="Введите название сайта" value="{{ old('site_name') }}">
                                @error('site_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-grd-primary px-4" style="color: white;">Отправить</button>
                                    <button type="reset" class="btn btn-grd-royal px-4" style="color: white;">Сбросить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
