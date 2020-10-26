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
        return $this->belongsToMany('App\Models\Product')
            ->withPivot('count', 'id')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
