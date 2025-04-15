<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'client_layanan');
    }

    public function layanans()
    {
        return $this->belongsToMany(Layanan::class, 'client_layanan', 'client_id', 'layanan_id')
                    ->withTimestamps(); // jika tabel pivot memiliki timestamps
    }

    public function monthlyReports()
    {
        return $this->hasMany(PerformanceBulanan::class);
    }
    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    
    
}
