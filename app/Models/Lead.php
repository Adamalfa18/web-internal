<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function performaBulanan()
    {
        return $this->belongsTo(PerformanceBulanan::class, 'performance_bulanan_id');
    }
}
