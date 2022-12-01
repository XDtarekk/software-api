<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $table = 'flights';
    public $timestamps = false;
    protected $fillable=[
        'from',
        'destination',
        'departON',
        'returnOn',
        'seatClass',
        'numberOfStops',
        'RorO',
        'numberOfTickets',
        'price',
        'image'
    ];
}
