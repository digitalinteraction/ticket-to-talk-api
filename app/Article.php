<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model representing an article
 *
 * Class Article
 * @package App
 */
class Article extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'link', 'notes', 'user_id'
    ];

    /**
     * Get the users using this article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the users this article has been shared with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sharedArticles()
    {
        return $this->belongsToMany('App\User', 'article_share')->withPivot('sender_id');
    }
}
