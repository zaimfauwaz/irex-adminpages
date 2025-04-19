<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $table = 'chat_sessions';
    protected $primaryKey = 'chat_session_id';

    protected $fillable = [
        'chat_subject',
        'chat_type',
        'chat_priority',
        'chat_status',
        'chat_summary'
    ];

    protected $casts = [
        'chat_priority' => 'integer',
        'chat_status' => 'boolean',
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message', 'message_id', 'message_id');
    }
}
