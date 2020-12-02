<?php

namespace App\Facades;

class TaskFacade {

    public static function __callStatic($method, $arguments)
    {
        return app()['TaskFacade']->$method(...$arguments);
    }
}
