<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'content' => 'array',
    ];
    protected $fillable = ['content'];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
}
