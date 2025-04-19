<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = ['name', 'phone', 'country', 'total_sessions'];

    protected $casts = ['total_sessions' => 'integer'];

    public function session(){
        return $this->hasMany('App\Models\Session', 'customer_id', 'customer_id');
    }
}
