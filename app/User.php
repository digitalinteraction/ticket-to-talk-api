<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Many to many relationship for all users' areas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function areas()
    {
        return $this->belongsToMany('App\Area');
    }

    /**
     * Get all tickets attached to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket')->withPivot('user_type');
    }

    /**
     * Get all people attached to the user's account
     *
     * @return $this
     */
    public function people()
    {
        return $this->belongsToMany('App\People')->withPivot('user_type');
    }

    /**
     * Get all of the user's articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    ///TODO: create pivot table with extra column.
    public function sharedArticles()
    {
        return $this->belongsToMany('App\User')->withPivot('sender');
    }
}
