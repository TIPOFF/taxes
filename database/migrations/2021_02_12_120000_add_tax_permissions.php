<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddTaxPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view taxes',
            'create taxes',
            'update taxes',
        ];

        $this->createPermissions($permissions);
    }
}
