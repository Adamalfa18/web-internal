<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_layanan'];

    // public function clients()
    // {
    //     return $this->belongsToMany(Client::class, 'client_layanan');
    // }
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_layanan', 'layanan_id', 'client_id')
                    ->withTimestamps(); // jika tabel pivot memiliki timestamps
    }
}
