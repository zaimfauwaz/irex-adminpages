<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs'; // Pastikan nama table betul
    protected $fillable = ['action', 'description', 'writer', 'method']; // Allow mass assignment

    protected $dates = [
        'timestamp' => 'datetime', // Cast as Carbon instance
    ];

    public function getTimestampAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function employee(){
        return $this->belongsTo(User::class, 'employee_id');
    }
}

