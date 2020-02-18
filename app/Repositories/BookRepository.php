<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BookRepository
 *
 * @package App\Repositories
 */
class BookRepository extends Repository
{
    /**
     * BookRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Book());
    }

    /**
     * Get book by book
     *
     * @param $authorId
     * @return \Eloquent[]|Collection
     */
    public function getByAuthorId($authorId)
    {
        return $this->model->where(['author_id' => $authorId])->orderBy('id', 'desc')->get();
    }

    /**
     * Get book by genre
     *
     * @param $genreId
     * @return mixed
     */
    public function getByGenreId($genreId)
    {
        return $this->model->where(['genre_id' => $genreId])->orderBy('id', 'desc')->get();
    }
}
