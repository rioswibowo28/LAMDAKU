<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'mobile',
        'email',
        'website',
        'logo',
        'description',
        'social_media',
        'is_active'
    ];

    protected $casts = [
        'social_media' => 'array',
        'is_active' => 'boolean'
    ];

    public static function getActiveCompanyInfo()
    {
        return self::where('is_active', true)->first();
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/logos/' . $this->logo);
        }
        return null;
    }

    public function getFormattedPhoneAttribute()
    {
        return $this->phone ? '+62 ' . ltrim($this->phone, '0') : null;
    }

    public function getFormattedMobileAttribute()
    {
        return $this->mobile ? '+62 ' . ltrim($this->mobile, '0') : null;
    }
}
