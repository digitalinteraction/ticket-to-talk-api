<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    /**
     * Many to many relationship for all areas' users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get all tickets associated with this area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * Get all people at this area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function checkAreaExists(Area $area)
    {
        $stored = DB::table('areas')->where('townCity', $area->townCity)->get();
        if ($stored)
        {
            return $stored[0];
        }
        else
        {
            return null;
        }
    }
}
