<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Enum;

use MabeEnum\Enum;

/**
 * @method static TaxCode PRODUCT()
 * @method static TaxCode BOOKING()
 * @psalm-immutable
 */
class TaxCode extends Enum
{
    const PRODUCT = 'product';
    const BOOKING = 'booking';
}
