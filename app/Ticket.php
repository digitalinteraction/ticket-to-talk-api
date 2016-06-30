<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model representing a Ticket
 *
 * Class Ticket
 * @package App
 */
class Ticket extends Model
{
    protected $fillable = [
        'title', 'description', 'mediaType', 'year'
    ];

    /**
     * Get all of the tickets attached users.
     *
     * @return $this
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_type');
    }

    /**
     * Get all attached tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get tag's area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function person ()
    {
        return $this->belongsTo('App\Person');
    }
}
