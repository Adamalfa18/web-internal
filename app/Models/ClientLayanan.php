<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLayanan extends Model
{
    use HasFactory;

    protected $table = 'client_layanan';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function monthlyReports()
    {
        return $this->hasMany(PerformanceBulanan::class);
    }
}
