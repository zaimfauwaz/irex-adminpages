<?php

namespace App\Models;

use App\Services\OpenAI\TaggerService;
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
        'faq_tags' => 'array'
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($faqlist)
        {
            $faqlist->faq_tags = self::generateTags($faqlist->faq_question, $faqlist->faq_answer);
        });

        static::updating(function ($faqlist){
            if ($faqlist->isDirty('faq_question')|| $faqlist->isDirty('faq_answer')) {
                $faqlist->faq_tags = self::generateTags($faqlist->faq_question, $faqlist->faq_answer);
            }
        });
    }

    private static function generateTags($faq_question, $faq_answer){
        $tagger = app(TaggerService::class);
        $tags = $tagger->generateFaqTags($faq_question, $faq_answer);

        return array_map(function ($tag) {
            return str_replace('\\', '', $tag);
        }, $tags ?? []);
    }
}
