<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Player
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @mixin \Eloquent
 */
class Player extends Model
{
    protected $table = "players";
    protected $fillable = ['first_name', 'last_name', 'team_id'];
    protected $with = ['team'];

    /**
     * Relationship for get player team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
