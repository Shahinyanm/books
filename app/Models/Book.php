<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Book
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $table = "books";
    protected $fillable = ['author_id', 'genre_id', 'title','published_at'];
    protected $with = ['author','genre'];
    public $timestamps =['published_at'];
    /**
     * Relationship for get book author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function genre()
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }

    /**
     * @return string
     */
    public function getPublishedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

}
