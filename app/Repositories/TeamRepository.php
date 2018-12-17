<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository extends Repository
{
    /**
     * TeamRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Team());
    }
}
