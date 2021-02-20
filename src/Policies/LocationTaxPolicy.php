<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Taxes\Models\LocationTax;

class LocationTaxPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view location taxes');
    }

    public function view(UserInterface $user, LocationTax $locationTax): bool
    {
        return $user->hasPermissionTo('view location taxes');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create location taxes');
    }

    public function update(UserInterface $user, LocationTax $locationTax): bool
    {
        return $user->hasPermissionTo('update location taxes');
    }

    public function delete(UserInterface $user, LocationTax $locationTax): bool
    {
        return false;
    }

    public function restore(UserInterface $user, LocationTax $locationTax): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, LocationTax $locationTax): bool
    {
        return false;
    }
}
