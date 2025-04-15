<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformaHarian extends Model
{
    
    use HasFactory;

    protected $guarded = ['id'];

    public function metaAds()
    {
        return $this->hasOne(MetaAds::class, 'performa_harian_id');
    }

    public function googleAds()
    {
        return $this->hasOne(GoogleAds::class, 'performa_harian_id');
    }

    public function shopeeAds()
    {
        return $this->hasOne(ShopeeAds::class, 'performa_harian_id');
    }

    public function tokpedAds()
    {
        return $this->hasOne(TokpedAds::class, 'performa_harian_id');
    }

    public function tiktokAds()
    {
        return $this->hasOne(TiktokAds::class, 'performa_harian_id');
    }
    public function performaBulanan()
    {
        return $this->belongsTo(PerformanceBulanan::class, 'performance_bulanan_id');
    }
}
