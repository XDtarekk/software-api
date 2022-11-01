<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
        public function index(){
            $flight= Flight::all();
    }

    //        'from',
//        'destination',
//        'departOn',
//        'returnOn',
//        'seatClass',
//        'numberOfStops',
//        'RorO',
//        'numberOfTickets'

    public function store(Request $request){
        $flight= new Flight;
        $flight->from =$request->input('from');
        $flight->destination =$request->input('destination');
        $flight->departOn =$request->input('departOn');
        $flight->returnOn =$request->input('returnOn');
        $flight->seatClass =$request->input('seatClass');
        $flight->numberOfStops =$request->input('numberOfStops');
        $flight->RorO =$request->input('RorO');
        $flight->numberOfTickets =$request->input('numberOfTickets');
        $flight->save();
    }
}
