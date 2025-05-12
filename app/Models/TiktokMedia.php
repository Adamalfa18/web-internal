<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'tiktok_media';

    protected $fillable = [
        'media',
        'post_id'
    ];

    public function tiktok_media()
    {
        return $this->belongsTo(Tiktok::class);
    }

    public function post_tiktok()
    {
        return $this->belongsTo(Tiktok::class, 'post_id', 'id');
    }
}
