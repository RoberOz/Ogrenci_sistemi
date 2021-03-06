<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view(User $user, User $model)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, User $model)
    {
        if ($user->hasRole('admin')) {
          return true;
        }
        elseif($user->id == $model->id) {
          return true;
        }
          return false;
    }

    public function delete(User $user, User $model)
    {
    }

    public function restore(User $user, User $model)
    {
    }

    public function forceDelete(User $user, User $model)
    {
    }
}
