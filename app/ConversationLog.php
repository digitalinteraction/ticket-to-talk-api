<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationLog extends Model
{
    //

    public function ticketLogs()
    {
        return $this->hasMany('App\TicketLog');
    }

    public function conversation()
    {
        return $this->belongsTo('App\Conversation');
    }
}
