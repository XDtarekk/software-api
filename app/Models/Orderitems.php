<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitems extends Model
{
    use HasFactory;
    protected $table='orderitems';
    public $timestamps=false;
    protected $fillable=[
        'order_id',
        'flight_id',
        'ticket_qty',
        'price'
    ];
}
