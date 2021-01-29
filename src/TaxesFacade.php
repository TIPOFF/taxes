<?php

namespace Tipoff\Taxes;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\Taxes\Taxes
 */
class TaxesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taxes';
    }
}
