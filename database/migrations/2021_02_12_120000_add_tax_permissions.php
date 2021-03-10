<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddTaxPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view taxes' => ['Owner', 'Staff'],
            'create taxes' => ['Owner'],
            'update taxes' => ['Owner'],
            'view location taxes' => ['Owner', 'Staff'],
            'create location taxes' => ['Owner'],
            'update location taxes' => ['Owner'],
        ];

        $this->createPermissions($permissions);
    }
}
