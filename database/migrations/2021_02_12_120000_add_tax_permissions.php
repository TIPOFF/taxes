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
        ];

        $this->createPermissions($permissions);
    }
}
