<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    //
    public function conversationLog()
    {
        return $this->belongsTo('App\ConversationLog');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
