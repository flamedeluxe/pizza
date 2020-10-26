<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'address',
        'payment_id',
        'delivery_id',
        'status_id',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')
            ->withPivot('count', 'price', 'id')
            ->withTimestamps();
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Delivery');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
