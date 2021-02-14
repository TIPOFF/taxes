<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Taxes\Models\Tax;

class TaxPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view taxes') ? true : false;
    }

    public function view(UserInterface $user, Tax $tax): bool
    {
        return $user->hasPermissionTo('view taxes') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create taxes') ? true : false;
    }

    public function update(UserInterface $user, Tax $tax): bool
    {
        return $user->hasPermissionTo('update taxes') ? true : false;
    }

    public function delete(UserInterface $user, Tax $tax): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Tax $tax): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Tax $tax): bool
    {
        return false;
    }
}
