<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date',
        'time',
        'customer_name',
        'phone_number',
        'email',
        'total',
        'address',
    ];
    
    public function dishes()
    {
        return $this->belongsToMany('App\Model\Dish')->withPivot('qty')->withTimestamps();
    }
}
