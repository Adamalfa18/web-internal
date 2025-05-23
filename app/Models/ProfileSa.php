<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSa extends Model
{
    use HasFactory;

    protected $table = 'profile_sa';

    protected $guarded = ['id'];

    protected $fillable = [
        'client_id',
        'username',
        'name',
        'followers',
        'following',
        'bio'
    ];
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function links()
    {
        return $this->hasMany(LinkSa::class, 'profile_id', 'id');
    }
}
