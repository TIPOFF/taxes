<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddTaxPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view taxes' => ['Owner', 'Executive', 'Staff'],
            'create taxes' => ['Owner', 'Executive'],
            'update taxes' => ['Owner', 'Executive'],
        ];

        $this->createPermissions($permissions);
    }
}
