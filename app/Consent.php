<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    //
    protected $fillable = [
      'core',
      'subscribed',
      'research',
      'googleAnalytics'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
