<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInfo::create([
            "company_name" => "PT. LAMDAKU Akreditasi Indonesia",
            "address" => "Jl. Akreditasi No. 123, Jakarta Pusat 10110, Indonesia",
            "phone" => "021 1234 5678",
            "mobile" => "0812 3456 7890",
            "email" => "info@lamdaku.co.id",
            "website" => "https://www.lamdaku.co.id",
            "description" => "Perusahaan akreditasi terpercaya yang memberikan layanan sertifikasi dan akreditasi berkualitas tinggi untuk berbagai industri di Indonesia.",
            "social_media" => [
                "facebook" => "https://facebook.com/lamdaku",
                "twitter" => "https://twitter.com/lamdaku",
                "instagram" => "https://instagram.com/lamdaku",
                "linkedin" => "https://linkedin.com/company/lamdaku"
            ],
            "is_active" => true
        ]);
    }
}
