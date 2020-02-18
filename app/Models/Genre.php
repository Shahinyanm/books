<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 *
 * @package App\Models
 */
class Genre extends Model
{
    protected $table = "genres";
    protected $fillable=['genre'];
}
