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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
     * Get all articles shared with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sharedArticles()
    {
        return $this->belongsToMany('App\Article', 'article_share')->withPivot('sender_id');
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

    /**
     * Get all of the user's invitations.
     * 
     * @return mixed
     */
    public function invitations()
    {
        return $this->belongsToMany('App\Person', 'invitations')->withPivot("inviter_id", "user_type");
    }
}
