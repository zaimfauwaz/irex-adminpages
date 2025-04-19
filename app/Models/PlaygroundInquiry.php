<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaygroundInquiry extends Model
{
    use softDeletes;
    protected $table = 'playgroundinquiries';
    protected $primaryKey = 'inquiry_id';
    protected $fillable = [
        'playground_id',
        'prompt',
        'result'
    ];

    public function playground(){
        return $this->belongsTo(Playground::class, 'playground_id');
    }
}
