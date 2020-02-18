<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\EditRequest;
use App\Models\Book;
use App\Models\Author;
use App\Repositories\BookRepository;
use Response;

class BookController extends Controller
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
        $this->repository = new BookRepository();
    }

    /**
     * Get books list
     *
     * @param Author  $author
     * @return mixed
     */
    public function index(Author $author)
    {

        if ($author) {
            $books = $this->repository->getByAuthorId($author->id);
        } else {
            $books = $this->repository->all();
        }
        $this->data['books'] = $books;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Get one book
     *
     * @param Book  $book
     * @return mixed
     */
    public function show(Book $book)
    {
        $this->data['book'] = $book;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create book
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
     * Edit book
     *
     * @param EditRequest  $request
     * @param Book         $book
     * @return mixed
     */
    public function edit(EditRequest $request, Book $book)
    {
        $model = $this->repository->edit($book, $request->all());
        if ($model) {
            $this->data['book'] = $book;
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Delete book
     *
     * @param Book  $book
     * @return mixed
     */
    public function delete(Book $book)
    {
        $model = $this->repository->delete($book);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['book'] = "can't_delete_book";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
