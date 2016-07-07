<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class that represents a person.
 *
 * Class Person
 * @package App
 */
class Person extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birthPlace', 'birthYear'
    ];

    /**
     * Get all users that have access to this person
     *
     * @return $this
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_type', 'relation');
    }

    /**
     * Get all tickets associated with this person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * Get the person's address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Area');
    }
    
    public function invited() 
    {
        return $this->belongsToMany('App\User', 'invitations')->withPivot('inviter_id', "user_type");
    }
}
