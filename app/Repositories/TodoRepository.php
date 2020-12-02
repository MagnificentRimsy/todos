<?php

namespace App\Repositories;

use App\Facades\TaskFacade;

class TodoRepository extends BaseRepository {

    public function __construct()
    {
        parent::__construct(TaskFacade::class);
    }
}
