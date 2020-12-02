<?php

namespace App\Repositories;

use App\Facades\TodoFacade;

class TodoRepository extends BaseRepository {

    public function __construct()
    {
        parent::__construct(TodoFacade::class);
    }

     /**
     * Get resources
     *
     * @return mixed
     */
    public function all()
    {
        return $this->facade::all()->myTasks()
        	->orderBy('created_at', 'desc');
    }

}


