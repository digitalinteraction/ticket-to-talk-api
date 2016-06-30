<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model representing a tag.
 *
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
    ];

    /**
     * Get all tickets attached to tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
