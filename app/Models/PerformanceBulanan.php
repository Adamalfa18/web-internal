<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerformanceBulanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function performaHarian()
    {
        return $this->hasMany(PerformaHarian::class);
    }
    public function lead()
    {
        return $this->hasMany(Lead::class);
    }
    


}
