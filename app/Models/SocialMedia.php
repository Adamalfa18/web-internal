<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $casts = [
    //     'content' => 'array',
    // ];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function media()
    {
        return $this->hasMany(PostMedia::class, 'post_id', 'id');
    }
}
