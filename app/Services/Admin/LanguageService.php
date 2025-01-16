<?php
namespace App\Services\Admin;


use App\Models\Language;

class LanguageService
{
    protected $model;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }
    public function add($request)
    {
        $this->model::create($request->validated());
    }
}
