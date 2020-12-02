<?php

namespace App\Repositories;

use App\Facades\TodoFacade;

class TodoRepository extends BaseRepository {

    public function __construct()
    {
        parent::__construct(TodoFacade::class);
    }
}
