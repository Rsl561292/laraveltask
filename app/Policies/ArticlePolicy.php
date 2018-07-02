<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;
use App\Role;
use App\User;

class ArticlePolicy
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

    public function create(User $user)
    {
        $role = Role::where('slug_system', 'admin')->first();

        if(!empty($role) && $user->role_id == $role->id) {

            return true;
        }

        return false;
    }

    public function update(User $user)
    {
        $roles = Role::whereIn('slug_system', [
            'admin',
            'manager',
        ])->pluck('name', 'id');

        if(Arr::exists($roles, $user->role_id)) {

            return true;
        }

        return false;
    }


    public function delete(User $user)
    {
        $role = Role::where('slug_system', 'admin')->first();

        if(!empty($role) && $user->role_id == $role->id) {

            return true;
        }

        return false;
    }
}
