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
}
