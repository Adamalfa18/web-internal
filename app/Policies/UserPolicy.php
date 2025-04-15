<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user)
    {
        return $user->user_role_id === 1; // Hanya izinkan role 1 untuk menghapus
    }
} 
