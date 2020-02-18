<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\CreateRequest;
use App\Http\Requests\Author\EditRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Response;

class AuthorController extends Controller
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
        $this->repository = new AuthorRepository();
    }

    /**
     * Get all authors
     *
     * @return mixed
     */
    public function index()
    {
        $this->data['authors'] = $this->repository->all();
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Get one author
     *
     * @param Author  $author
     * @return mixed
     */
    public function show(Author $author)
    {
        $this->data['author'] = $author;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create author
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
     * Edit author
     *
     * @param EditRequest  $request
     * @param Author       $author
     * @return mixed
     */
    public function edit(EditRequest $request, Author $author)
    {
        $model = $this->repository->edit($author, $request->all());
        if ($model) {
            $this->data['author'] = $author;
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Delete author
     *
     * @param Author  $author
     * @return mixed
     */
    public function delete(Author $author)
    {
        $model = $this->repository->delete($author);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['author'] = "can't_delete_team";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
