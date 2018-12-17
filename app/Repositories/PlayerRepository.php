<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository extends Repository
{
    /**
     * PlayerRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Player());
    }

    /**
     * Get players by team id
     *
     * @param $teamId
     * @return \Eloquent[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByTeamId($teamId)
    {
        return $this->model->where(['team_id' => $teamId])->orderBy('id', 'desc')->get();
    }
}
