<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Nowyouwerkn\WeCommerce\Models\StoreTheme; 

class StoreThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreTheme::create([
            'name' => 'werkn-backbone-bootstrap',
            'description' => 'Apariencia inicial para cualquier excelente plataforma de e-commerce usando wecommerce, basado exlusivamente en Bootstrp',
            'image' => 'werkn-backbone-bootstrap.jpg',
            'is_active' => true,
            'version' => '1.5'
        ]);
    }
}
