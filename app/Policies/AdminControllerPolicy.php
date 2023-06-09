<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminControllerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function viewAdminPart(?User $user){
        if($user && $user->role == 'admin'){
            return Response::allow();
        }
        return Response::deny('Страница не найдена', 404);
    }
}
