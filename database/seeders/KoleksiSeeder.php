<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Koleksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class KoleksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $umumFiksi = Category::where('name', 'Buku Umum & Fiksi')->first();
        $referensi = Category::where('name', 'Referensi Pelajaran')->first();
        $anak = Category::where('name', 'Literatur Anak & Keluarga')->first();
        $teknik = Category::where('name', 'Teknik & Ilmu Komputer')->first();
        $sejarah = Category::where('name', 'Sejarah & Budaya')->first();
        $sains = Category::where('name', 'Sains & Pengetahuan Umum')->first();

        // Subjects to query from Google Books API
        $subjects = [
            'fiction' => $umumFiksi->id ?? 1,
            'non-fiction' => $referensi->id ?? 2,
            'science' => $sains->id ?? 6,
            'history' => $sejarah->id ?? 5,
            'biography' => $anak->id ?? 3,
        ];

        $client = new Client();
        $booksData = [];

        foreach ($subjects as $subject => $categoryId) {
            try {
                $response = $client->get("https://www.googleapis.com/books/v1/volumes?q=subject:{$subject}&maxResults=20&orderBy=relevance", [
                    'timeout' => 30,
                ]);

                if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody(), true);
                    $items = $data['items'] ?? [];

                    foreach ($items as $item) {
                        $volumeInfo = $item['volumeInfo'] ?? [];
                        $booksData[] = [
                            'judul' => $volumeInfo['title'] ?? 'Judul Tidak Tersedia',
                            'penulis' => isset($volumeInfo['authors']) ? implode(', ', $volumeInfo['authors']) : 'Penulis Tidak Diketahui',
                            'isbn' => $this->getIsbn($volumeInfo['industryIdentifiers'] ?? []),
                            'tahun_terbit' => isset($volumeInfo['publishedDate']) ? (int) substr($volumeInfo['publishedDate'], 0, 4) : 2023,
                            'penerbit' => $volumeInfo['publisher'] ?? 'Penerbit Tidak Diketahui',
                            'deskripsi' => $volumeInfo['description'] ?? 'Deskripsi tidak tersedia.',
                            'status' => 'tersedia',
                            'cover_path' => $volumeInfo['imageLinks']['smallThumbnail'] ?? $volumeInfo['imageLinks']['thumbnail'] ?? 'covers/placeholder.jpg',
                            'category_id' => $categoryId,
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Skip if API fails for this subject
            }
        }

        // Take only 100 books
        $booksData = array_slice($booksData, 0, 100);

        // Insert into database
        foreach ($booksData as $book) {
            try {
                Koleksi::create($book);
            } catch (\Exception $e) {
                // Skip if duplicate or other error
            }
        }
    }

    private function getIsbn($identifiers)
    {
        foreach ($identifiers as $id) {
            if ($id['type'] == 'ISBN_13') {
                return $id['identifier'];
            }
        }
        foreach ($identifiers as $id) {
            if ($id['type'] == 'ISBN_10') {
                return $id['identifier'];
            }
        }
        return null;
    }
}
