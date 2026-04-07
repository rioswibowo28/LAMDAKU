<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About LAMDAKU',
                'slug' => 'about-lamdaku',
                'content' => 'LAMDAKU (Lembaga Akreditasi Mandiri Daerah Khusus) adalah lembaga akreditasi independen yang berkomitmen untuk memberikan layanan akreditasi berkualitas tinggi untuk berbagai sektor industri dan pendidikan.

Visi kami adalah menjadi lembaga akreditasi terpercaya yang berkontribusi dalam peningkatan kualitas dan standar di Indonesia. Kami memiliki tim ahli yang berpengalaman dan berkomitmen untuk memberikan pelayanan terbaik.

Tim LAMDAKU terdiri dari para profesional yang memiliki keahlian di berbagai bidang, termasuk:
- Akreditasi Pendidikan
- Akreditasi Rumah Sakit
- Akreditasi Laboratorium
- Sertifikasi ISO
- Audit Mutu

Dengan pengalaman lebih dari 10 tahun, LAMDAKU telah membantu ratusan organisasi mencapai standar kualitas internasional.',
                'meta_description' => 'LAMDAKU adalah lembaga akreditasi independen terpercaya dengan pengalaman lebih dari 10 tahun melayani berbagai sektor industri dan pendidikan di Indonesia.',
                'meta_keywords' => 'LAMDAKU, akreditasi, lembaga akreditasi, sertifikasi, ISO, pendidikan, rumah sakit, laboratorium',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => 'Kebijakan Privasi LAMDAKU

LAMDAKU menghormati privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda berikan kepada kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.

Informasi yang Kami Kumpulkan:
- Informasi kontak (nama, email, nomor telepon)
- Informasi perusahaan/organisasi
- Data yang diperlukan untuk proses akreditasi
- Informasi teknis dari website (cookies, IP address)

Penggunaan Informasi:
Informasi yang kami kumpulkan digunakan untuk:
- Memberikan layanan akreditasi
- Komunikasi terkait layanan
- Peningkatan kualitas layanan
- Kepatuhan terhadap regulasi

Keamanan Data:
Kami menggunakan teknologi keamanan terkini untuk melindungi data Anda, termasuk enkripsi SSL dan sistem keamanan berlapis.

Hak Anda:
Anda memiliki hak untuk mengakses, mengubah, atau menghapus informasi pribadi Anda. Hubungi kami jika Anda memiliki pertanyaan tentang kebijakan privasi ini.',
                'meta_description' => 'Kebijakan privasi LAMDAKU menjelaskan bagaimana kami melindungi dan menggunakan informasi pribadi Anda dengan aman dan bertanggung jawab.',
                'meta_keywords' => 'kebijakan privasi, privasi, perlindungan data, LAMDAKU, keamanan informasi',
                'is_published' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => 'Syarat dan Ketentuan Layanan LAMDAKU

Dengan menggunakan layanan LAMDAKU, Anda menyetujui syarat dan ketentuan berikut:

1. Definisi
LAMDAKU adalah lembaga akreditasi yang memberikan layanan penilaian dan sertifikasi sesuai dengan standar yang berlaku.

2. Lingkup Layanan
- Akreditasi institusi pendidikan
- Akreditasi fasilitas kesehatan
- Sertifikasi laboratorium
- Audit dan konsultasi mutu
- Pelatihan dan pengembangan kapasitas

3. Kewajiban Klien
- Memberikan informasi yang akurat dan lengkap
- Memenuhi persyaratan dokumentasi
- Membayar biaya layanan sesuai kesepakatan
- Mengikuti proses akreditasi sesuai prosedur

4. Kewajiban LAMDAKU
- Melakukan penilaian secara objektif dan profesional
- Menjaga kerahasiaan informasi klien
- Memberikan laporan hasil akreditasi
- Menyediakan layanan purna jual

5. Pembayaran
- Biaya layanan harus dibayar sesuai kesepakatan
- Pembayaran dapat dilakukan secara bertahap
- Keterlambatan pembayaran dapat menghentikan proses akreditasi

6. Pembatalan dan Pengembalian
- Pembatalan layanan harus dilakukan secara tertulis
- Pengembalian biaya mengikuti kebijakan yang berlaku

7. Tanggung Jawab
LAMDAKU tidak bertanggung jawab atas kerugian yang timbul akibat kelalaian klien dalam mengikuti prosedur akreditasi.',
                'meta_description' => 'Syarat dan ketentuan layanan LAMDAKU yang mengatur hak dan kewajiban dalam penggunaan layanan akreditasi kami.',
                'meta_keywords' => 'syarat ketentuan, terms of service, LAMDAKU, layanan akreditasi, kewajiban',
                'is_published' => true,
                'sort_order' => 11,
            ],
            [
                'title' => 'Contact Information',
                'slug' => 'contact-information',
                'content' => 'Informasi Kontak LAMDAKU

Kantor Pusat:
Jl. Sudirman No. 123
Jakarta Pusat 10220
Indonesia

Telepon: +62 21 1234 5678
Fax: +62 21 1234 5679
Email: info@lamdaku.org
Website: www.lamdaku.org

Jam Operasional:
Senin - Jumat: 08:00 - 17:00 WIB
Sabtu: 08:00 - 12:00 WIB
Minggu: Tutup

Kantor Cabang:

Surabaya:
Jl. Pemuda No. 456
Surabaya 60271
Telepon: +62 31 2345 6789

Medan:
Jl. Gatot Subroto No. 789
Medan 20123
Telepon: +62 61 3456 7890

Makassar:
Jl. AP Pettarani No. 321
Makassar 90234
Telepon: +62 411 4567 8901

Untuk informasi lebih lanjut atau konsultasi, silakan hubungi kami melalui kontak di atas atau gunakan formulir kontak online yang tersedia di website ini.',
                'meta_description' => 'Informasi kontak lengkap LAMDAKU termasuk alamat kantor pusat dan cabang, nomor telepon, email, dan jam operasional.',
                'meta_keywords' => 'kontak LAMDAKU, alamat kantor, telepon, email, jam operasional, cabang',
                'is_published' => true,
                'sort_order' => 12,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}
