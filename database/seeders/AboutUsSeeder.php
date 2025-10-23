<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutUs = [
            'content' => [
                'az' => [
                    'title' => 'Haqqımızda',
                    'description' => 'Şirkət haqqında məlumatlar burada əks olunacaq.'
                ],
                'en' => [
                    'title' => 'About Us',
                    'description' => 'Company information will be displayed here.'
                ],
                'ru' => [
                    'title' => 'О нас',
                    'description' => 'Информация о компании будет отображаться здесь.'
                ]
            ]
        ];

        AboutUs::updateOrCreate(
            ['id' => 1],
            $aboutUs
        );
    }
}
