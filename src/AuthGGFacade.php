<?php

namespace Deko96\AuthGG;

use Illuminate\Support\Facades\Facade;


class AuthGGFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'auth-gg';
    }
}
