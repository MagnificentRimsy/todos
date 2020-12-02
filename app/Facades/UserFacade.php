<?php

namespace App\Facades;

class UserFacade {

    public static function __callStatic($method, $arguments)
    {
        return app()['UserFacade']->$method(...$arguments);
    }
}
