<?php

namespace App\Services;
use App\Models\Todo;


public class TodoService extends BaseService {


    /**
     * Constructor
     *
    */
    public function __construct() {
        parent::__construct(Todo::class);
    }
}
