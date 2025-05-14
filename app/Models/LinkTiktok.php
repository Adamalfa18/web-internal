<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkTiktok extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'link_tiktok';

    protected $fillable = [
        'url',
        'name',
        'profile_id'
    ];
    public function linked()
    {
        return $this->belongsTo(ProfileSa::class);
    }

    public function linkto()
    {
        return $this->belongsTo(ProfileSa::class, 'profile_id', 'id');
    }
}
