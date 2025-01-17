<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Support\Facades\File;
 class LanguageRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

     public function getTranslations(string $langCode): array
     {
         $filePath = resource_path("lang/{$langCode}.json");

         if (File::exists($filePath)) {
             return json_decode(File::get($filePath), true) ?? [];
         }

         return [];
     }

}
