<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
use Illuminate\Database\Seeder;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyInfo = [
            'email' => 'info@example.com',
            'phone' => '+994123456789',
            'email_2' => 'contact@example.com',
            'phone_2' => '+994987654321',
            'address' => [
                'az' => 'Bakı şəhəri, Nəsimi rayonu, Xətai pr. 10',
                'en' => '10 Khatai Avenue, Nasimi district, Baku',
                'ru' => 'пр. Хатаи 10, Насиминский район, г. Баку'
            ],
            'instagram' => 'https://instagram.com/example',
            'whatsapp' => 'https://wa.me/994123456789',
            'facebook' => 'https://facebook.com/example',
            'x' => 'https://x.com/example',
            'youtube' => 'https://youtube.com/example',
            'copyright_text' => [
                'az' => '© 2025 Bütün hüquqlar qorunur',
                'en' => '© 2025 All rights reserved',
                'ru' => '© 2025 Все права защищены'
            ]
        ];

        // Check if record with ID 1 exists, if not create it
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            $companyInfo
        );
    }
}
