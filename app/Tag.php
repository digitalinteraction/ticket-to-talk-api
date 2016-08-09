<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsToMany('App\Ticket', 'ticket_tag');
    }

    /**
     * Gets all users that have used this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'tag_user');
    }

    /**
     * check if the tag already exists.
     *
     * @return mixed
     */
    public function checkForExistingTag()
    {
        $stored = DB::table('tags')->where('text', $this->text)->first();
        if ($stored)
        {
            return $stored;
        }
    }
}
