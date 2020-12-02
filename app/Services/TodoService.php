<?php

namespace App\Services;
use App\Models\Todo;


class TodoService extends BaseService {


    /**
     * Constructor
     *
    */
    public function __construct() {
        parent::__construct(Todo::class);
    }

    public function markAsComplete($id) {
    	$todo = $this->update($id, ['status' => 'completed']);

    	return $todo->fresh();
    }
}
