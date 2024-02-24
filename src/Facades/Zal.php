<?php

namespace arashrasoulzadeh\Zal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \arashrasoulzadeh\Zal\Zal
 */
class Zal extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \arashrasoulzadeh\Zal\Zal::class;
    }
}
