<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model representing an area.
 *
 * Class Area
 * @package App
 */
class Area extends Model
{
    //
    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'townCity', 'county', 'country'
    ];
}
