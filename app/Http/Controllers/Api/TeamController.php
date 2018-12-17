<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateRequest;
use App\Http\Requests\Team\EditRequest;
use App\Models\Team;
use App\Repositories\TeamRepository;
use Response;

class TeamController extends Controller
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
        $this->repository = new TeamRepository();
    }

    /**
     * Get all teams
     *
     * @return mixed
     */
    public function index()
    {
        $this->data['teams'] = $this->repository->all();
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Get one team
     *
     * @param Team $team
     * @return mixed
     */
    public function show(Team $team)
    {
        $this->data['team'] = $team;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create team
     *
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $model = $this->repository->create($request->all());
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Edit team
     *
     * @param EditRequest $request
     * @param Team $team
     * @return mixed
     */
    public function edit(EditRequest $request, Team $team)
    {
        $model = $this->repository->edit($team, $request->all());
        if ($model) {
            $this->data['team'] = $team;
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Delete team
     *
     * @param Team $team
     * @return mixed
     */
    public function delete(Team $team)
    {
        $model = $this->repository->delete($team);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['team'] = "can't_delete_team";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
