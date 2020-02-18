<?php

namespace App\Repositories;

use App\Models\Genre;

/**
 * Class GenreRepository
 *
 * @package App\Repositories
 */
class GenreRepository extends Repository
{
    /**
     * GenreRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Genre());
    }
}
