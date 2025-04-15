<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeAds extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function performaHarian()
    {
        return $this->belongsTo(PerformaHarian::class, 'performa_harian_id');
    }
}
