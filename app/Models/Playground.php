<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playground extends Model
{
    use softDeletes;
    protected $table = 'playgrounds';
    protected $primaryKey = 'playground_id';

    protected $fillable = [
        'employee_id'
    ];

    public function inquiries()
    {
        return $this->hasMany(PlaygroundInquiry::class, 'playground_id');
    }

    public function latestInquiry(){
        return $this->hasOne(PlaygroundInquiry::class, 'playground_id')->latestOfMany('inquiry_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'employee_id');
    }
}
