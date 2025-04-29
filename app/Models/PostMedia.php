<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'post_media';

    protected $fillable = [
        'post',
        'post_id'
    ];
    public function post_media()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function postingan()
    {
        return $this->belongsTo(SocialMedia::class, 'post_id', 'id');
    }
}
