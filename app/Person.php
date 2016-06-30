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
}
