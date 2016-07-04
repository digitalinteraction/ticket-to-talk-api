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
        return $this->belongsToMany('App\Person')->withPivot('user_type', "relation");
    }

    /**
     * Get all of the user's articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

    /**
     * Get all articles the user has shared.
     *
     * @return $this
     */
    public function sharedArticles()
    {
        return $this->belongsToMany('App\User', 'article_share')->withPivot('sender');
    }

    /**
     * Get all of the user's tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_user');
    }
}
