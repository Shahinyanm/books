<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\EditRequest;
use App\Models\Player;
use App\Models\Team;
use App\Repositories\PlayerRepository;
use Response;

class PlayerController extends Controller
{
    private $statusCode;
    private $success;
    private $data;
    private $errors;
    private $repository;

    public function __construct()
    {
        $this->statusCode = StatusCodeHelper::HTTP_BAD_REQUEST;
        $this->success = false;
        $this->data = [];
        $this->errors = [];
        $this->repository = new PlayerRepository();
    }

    /**
     * Get players list
     *
     * @param Team $team
     * @return mixed
     */
    public function index(Team $team)
    {
        if (isset($team->id)) {
            $players = $this->repository->getByTeamId($team->id);
        } else {
            $players = $this->repository->all();
        }
        $this->data['players'] = $players;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Get one player
     *
     * @param Player $player
     * @return mixed
     */
    public function show(Player $player)
    {
        $this->data['player'] = $player;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create player
     *
     * @param EditRequest $request
     * @return mixed
     */
    public function create(EditRequest $request)
    {
        $model = $this->repository->create($request->all());
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Edit player
     *
     * @param EditRequest $request
     * @param Player $player
     * @return mixed
     */
    public function edit(EditRequest $request, Player $player)
    {
        $model = $this->repository->edit($player, $request->all());
        if ($model) {
            $this->data['player'] = $player;
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Delete player
     *
     * @param Player $player
     * @return mixed
     */
    public function delete(Player $player)
    {
        $model = $this->repository->delete($player);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['player'] = "can't_delete_player";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
