<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiktok extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'tiktok';

    protected $fillable = [
        'caption',
        'client_id',
        'created_at',
        'cover',
        'status',
        'note'
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function tiktok_media()
    {
        return $this->hasMany(TiktokMedia::class, 'post_id', 'id');
    }
}
