<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqList extends Model
{
    protected $table = 'faqlists';
    protected $primaryKey = 'faq_id';

    protected $fillable = [
        'faq_question',
        'faq_answer',
        'faq_category',
        'faq_status',
        'faq_tags'
    ];

    protected $casts = [
        'faq_status' => 'boolean',
        'faq_tags' => 'json'
    ];

}
