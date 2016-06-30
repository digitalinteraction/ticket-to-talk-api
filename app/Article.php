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
        'title', 'link', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sharedArticles()
    {
        return $this->belongsToMany('App\User')->withPivot('sender');
    }
}
