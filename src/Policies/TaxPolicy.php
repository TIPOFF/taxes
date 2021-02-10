<?php

namespace Tipoff\Taxes\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Taxes\Models\Tax;

class TaxPolicy
{
    use HandlesAuthorization;
    
    /** @var Model $user */
    $user = app('user');

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('view taxes') ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param Tax $tax
     * @return mixed
     */
    public function view($user, Tax $tax)
    {
        return $user->hasPermissionTo('view taxes') ? true : false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create($user)
    {
        return $user->hasPermissionTo('create taxes') ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param Tax $tax
     * @return mixed
     */
    public function update($user, Tax $tax)
    {
        return $user->hasPermissionTo('update taxes') ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param Tax $tax
     * @return mixed
     */
    public function delete($user, Tax $tax)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param Tax $tax
     * @return mixed
     */
    public function restore($user, Tax $tax)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param Tax $tax
     * @return mixed
     */
    public function forceDelete($user, Tax $tax)
    {
        return false;
    }
}
