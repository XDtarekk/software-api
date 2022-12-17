<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table= 'orders';
    protected $fillable=[
        'customer_id',
//        'name',
//        'email',
//        'number',
//        'country',
//        'city',
//        'address',
        'payment_id',
        'payment_mode'
    ];

    public function orderitems(){
        return $this->hasMany(Orderitems::class, 'order_id', 'id');
    }
}
