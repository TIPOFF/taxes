<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Unit\Policies;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Tests\TestCase;
use Tipoff\TestSupport\Models\User;

class LocationTaxPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        /** @var User $authorizedUser */
        $authorizedUser = self::createPermissionedUser('view location taxes', true);

        /** @var User $unauthorizedUser */
        $unauthorizedUser = self::createPermissionedUser('view location taxes', false);

        $this->assertTrue($authorizedUser->can('viewAny', LocationTax::class));
        $this->assertFalse($unauthorizedUser->can('viewAny', LocationTax::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $location_tax = LocationTax::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $location_tax));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => ['view', self::createPermissionedUser('view location taxes', true), true],
            'view-false' => ['view', self::createPermissionedUser('view location taxes', false), false],
            'create-true' => ['create', self::createPermissionedUser('create location taxes', true), true],
            'create-false' => ['create', self::createPermissionedUser('create location taxes', false), false],
            'update-true' => ['update', self::createPermissionedUser('update location taxes', true), true],
            'update-false' => ['update', self::createPermissionedUser('update location taxes', false), false],
            'delete-true' => ['delete', self::createPermissionedUser('delete location taxes', true), false],
            'delete-false' => ['delete', self::createPermissionedUser('delete location taxes', false), false],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $location_tax = LocationTax::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $location_tax));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
