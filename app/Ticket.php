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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
        return $this->belongsToMany('App\Tag', 'ticket_tag');
    }
//
//    /**
//     * Get tag's area.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function area()
//    {
//        return $this->belongsTo('App\Area');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person ()
    {
        return $this->belongsTo('App\Person');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period()
    {
        return $this->belongsTo('App\Ticket');
    }

    /**
     * Get all of the conversations this ticket is used in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conversations()
    {
        return $this->belongsToMany('App\Conversation', 'conversation_ticket');
    }
}
