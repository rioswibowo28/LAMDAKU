<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin and penulis users
        $adminUser = User::where('role', 'admin')->first();
        $penulisUser = User::where('role', 'penulis')->first();
        
        if (!$adminUser || !$penulisUser) {
            $this->command->info('Silakan jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $articles = [
            [
                'title' => 'Selamat Datang di Website Resmi Kami',
                'excerpt' => 'Artikel pertama yang menjelaskan tentang visi dan misi website resmi kami.',
                'content' => 'Selamat datang di website resmi kami! Kami menyediakan berbagai layanan dan informasi terkini.',
                'status' => 'published',
                'author_id' => $adminUser->id,
                'category' => 'Umum',
                'tags' => ['selamat datang', 'visi misi'],
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(7),
                'view_count' => 156,
            ],
            [
                'title' => 'Panduan Menggunakan Layanan Online',
                'excerpt' => 'Panduan lengkap cara menggunakan berbagai layanan online.',
                'content' => 'Untuk memudahkan akses masyarakat terhadap layanan kami, berikut panduan lengkap menggunakan layanan online.',
                'status' => 'published',
                'author_id' => $penulisUser->id,
                'category' => 'Tutorial',
                'tags' => ['panduan', 'layanan online'],
                'published_at' => Carbon::now()->subDays(3),
                'view_count' => 89,
            ],
            [
                'title' => 'Inovasi Digital dalam Pelayanan Publik',
                'excerpt' => 'Pembahasan tentang inovasi digital yang telah diterapkan.',
                'content' => 'Di era digital saat ini, transformasi digital menjadi kunci utama dalam meningkatkan kualitas pelayanan publik.',
                'status' => 'published',
                'author_id' => $adminUser->id,
                'category' => 'Teknologi',
                'tags' => ['inovasi', 'digital'],
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(1),
                'view_count' => 234,
            ],
            [
                'title' => 'Program Digitalisasi UMKM 2025',
                'excerpt' => 'Informasi lengkap tentang program digitalisasi UMKM tahun 2025.',
                'content' => 'Program Digitalisasi UMKM 2025 diluncurkan untuk mendukung pertumbuhan ekonomi digital.',
                'status' => 'draft',
                'author_id' => $penulisUser->id,
                'category' => 'Program',
                'tags' => ['umkm', 'digitalisasi'],
                'view_count' => 12,
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }

        $this->command->info('ArticleSeeder berhasil! 4 artikel sample telah dibuat.');
    }
}
