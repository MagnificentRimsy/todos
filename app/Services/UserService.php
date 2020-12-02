<?php

namespace App\Services;
use App\Models\User;


class UserService extends BaseService {


    /**
     * Constructor
     *
    */
    public function __construct() {
        parent::__construct(User::class);
    }
}
