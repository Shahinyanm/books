<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Requests\Genre\CreateRequest;
use App\Models\Genre;
use App\Repositories\GenreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;


class GenreController extends Controller
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
        $this->repository = new GenreRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data[ 'genres' ] = $this->repository->all();
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  Genre  $genre
     * @return Response
     */
    public function show(Genre $genre)
    {
        $this->data[ 'genre' ] = $genre;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create author
     *
     * @param  CreateRequest  $request
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Genre    $genre
     * @return Response
     */
    public function update(Request $request, Genre $genre)
    {
        $model = $this->repository->edit($genre, $request->all());
        if ($model) {
            $this->data[ 'genre' ] = $genre;
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre  $genre
     * @return Response
     */
    public function destroy(Genre $genre)
    {
        $model = $this->repository->delete($genre);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['genre'] = "can't_delete_genre";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
