<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buku Umum & Fiksi',
                'description' => 'Novel, biografi, pengembangan diri, dan berbagai bacaan populer lainnya.',
                'icon_color' => 'emerald',
            ],
            [
                'name' => 'Referensi Pelajaran',
                'description' => 'Buku pelajaran sekolah, modul latihan, dan materi pendukung pembelajaran.',
                'icon_color' => 'sky',
            ],
            [
                'name' => 'Literatur Anak & Keluarga',
                'description' => 'Cerita anak, buku bergambar, serta bacaan edukatif yang ramah keluarga.',
                'icon_color' => 'violet',
            ],
            [
                'name' => 'Teknik & Ilmu Komputer',
                'description' => 'Buku tentang pemrograman, jaringan, basis data, dan teknologi informasi.',
                'icon_color' => 'amber',
            ],
            [
                'name' => 'Sejarah & Budaya',
                'description' => 'Buku sejarah Indonesia, budaya lokal, dan dokumentasi peristiwa penting.',
                'icon_color' => 'emerald',
            ],
            [
                'name' => 'Sains & Pengetahuan Umum',
                'description' => 'Buku sains populer, pengetahuan umum, dan eksplorasi dunia ilmu pengetahuan.',
                'icon_color' => 'sky',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
