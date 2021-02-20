<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddLocationTaxPermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            foreach ([
                'view location taxes',
                'create location taxes',
                'update location taxes',
                'delete location taxes'
            ] as $name) {
                app(Permission::class)::findOrCreate($name, null);
            };
        }
    }
}
