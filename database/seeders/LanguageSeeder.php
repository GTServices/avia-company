<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'lang_name' => 'Azərbaycan',
                'lang_code' => 'az',
                'site_name' => 'Azərbaycan dili',
                'order' => 1,
                'is_main' => true,
                'status' => true,
            ],
           
            [
                'lang_name' => 'Русский',
                'lang_code' => 'ru',
                'site_name' => 'Русский',
                'order' => 3,
                'is_main' => false,
                'status' => true,
            ]
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(
                ['lang_code' => $language['lang_code']],
                $language
            );
        }
    }
}
