<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bahasa\Language;

class BahasaSeeder extends Seeder
{
    public function run()
    {
        Language::create([
            'name' => 'Bahasa Madura',
            'native_name' => 'Basa Madhura',
            'difficulty' => 'mudah',
            'indicator_color' => 'red',
            'speakers' => 15000000,
            'total_lessons' => 4,
            'description' => 'Bahasa Madura adalah bahasa yang digunakan oleh suku Madura'
        ]);

        Language::create([
            'name' => 'Bahasa Jawa',
            'native_name' => 'Basa Jawa',
            'difficulty' => 'sedang',
            'indicator_color' => 'green',
            'speakers' => 75000000,
            'total_lessons' => 4,
            'description' => 'Bahasa Jawa adalah bahasa yang digunakan oleh suku Jawa'
        ]);

        Language::create([
            'name' => 'Bahasa Osing',
            'native_name' => 'Basa Using',
            'difficulty' => 'mudah',
            'indicator_color' => 'blue',
            'speakers' => 400000,
            'total_lessons' => 4,
            'description' => 'Bahasa Osing adalah bahasa yang digunakan oleh suku Osing'
        ]);
    }
}
