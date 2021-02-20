<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Tipoff\Taxes\Tests\TestCase;

class PermissionsMigrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function permissions_seeded()
    {
        $this->assertTrue(Schema::hasTable('permissions'));

        $seededPermissions = app(Permission::class)->whereIn('name', [
            'view taxes',
            'create taxes',
            'update taxes',
            'delete taxes',
            'view location taxes',
            'create location taxes',
            'update location taxes',
            'delete location taxes'
        ])->pluck('name');

        $this->assertCount(8, $seededPermissions);
    }
}
