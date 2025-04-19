<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'message_id';

    protected $fillable = [
        'message',
        'sender'
    ];

    public function session(){
        return $this->belongsTo('App\Models\Session', 'session_id', 'session_id');
    }
}
