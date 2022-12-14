<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    public $timestamps = false;
    protected $fillable=[
        'customer_id',
        'flight_id',
        'ticket_qty'
    ];

    protected $with= ['flight'];
    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }
}
