<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Period
 * @package App
 */
class Period extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'text',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * Check if the period exists in the database.
     *
     * @param Period $period
     * @return null
     */
    public function checkPeriodExists(Period $period)
    {
        $stored = DB::table('period')->where('text', $period->text)->get();
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
