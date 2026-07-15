<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sapu & Pengki',
                'slug' => 'sapu-pengki',
                'description' => 'Berbagai jenis sapu dan pengki untuk membersihkan lantai dan halaman rumah.',
            ],
            [
                'name' => 'Pel & Alat Pel',
                'slug' => 'pel-alat-pel',
                'description' => 'Pel lantai, spin mop, flat mop, dan perlengkapan mengepel lainnya.',
            ],
            [
                'name' => 'Ember & Baskom',
                'slug' => 'ember-baskom',
                'description' => 'Ember, baskom, dan wadah air untuk berbagai kebutuhan rumah tangga.',
            ],
            [
                'name' => 'Rak & Lemari',
                'slug' => 'rak-lemari',
                'description' => 'Rak serbaguna, rak sepatu, rak dapur, dan lemari penyimpanan.',
            ],
            [
                'name' => 'Tempat Sampah',
                'slug' => 'tempat-sampah',
                'description' => 'Tempat sampah berbagai ukuran untuk indoor dan outdoor.',
            ],
            [
                'name' => 'Alat Dapur',
                'slug' => 'alat-dapur',
                'description' => 'Peralatan dapur seperti spatula, sendok, talenan, dan perlengkapan masak.',
            ],
            [
                'name' => 'Kotak Penyimpanan',
                'slug' => 'kotak-penyimpanan',
                'description' => 'Box penyimpanan, container, dan organizer untuk merapikan rumah.',
            ],
            [
                'name' => 'Keset & Alas',
                'slug' => 'keset-alas',
                'description' => 'Keset pintu, keset kamar mandi, dan alas lantai.',
            ],
            [
                'name' => 'Gantungan & Jemuran',
                'slug' => 'gantungan-jemuran',
                'description' => 'Gantungan baju, hanger, jemuran lipat, dan perlengkapan menjemur.',
            ],
            [
                'name' => 'Peralatan Kebersihan',
                'slug' => 'peralatan-kebersihan',
                'description' => 'Sikat, lap, spons, dan peralatan kebersihan rumah tangga lainnya.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
