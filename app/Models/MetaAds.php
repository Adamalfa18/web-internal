<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaAds extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function performaHarian()
    {
        return $this->belongsTo(PerformaHarian::class, 'id_performa_harian');
    }
}
