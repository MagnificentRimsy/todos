<?php

namespace App\Facades;

class TodoFacade {

    public static function __callStatic($method, $arguments)
    {
        return app()['TodoFacade']->$method(...$arguments);
    }
}
