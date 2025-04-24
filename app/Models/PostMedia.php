<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function post_media()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function post()
    {
        return $this->belongsTo(SocialMedia::class, 'post_id');
    }
}
