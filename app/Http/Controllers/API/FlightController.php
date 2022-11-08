<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
        public function index(){
            $flight= Flight::all();
            return response()->json($flight);
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
        $flight->departON =$request->input('departON');
        $flight->returnOn =$request->input('returnOn');
        $flight->seatClass =$request->input('seatClass');
        $flight->numberOfStops =$request->input('numberOfStops');
        $flight->RorO =$request->input('RorO');
        $flight->numberOfTickets =$request->input('numberOfTickets');
        $flight->save();

        return response()->json($flight);
    }

    public function update(Request $request, $id)
    {
        $flight=Flight::find($id);
        $flight->update($request->all());
        return response()->json($flight);
    }

    public function destroy($id){
        $flight=Flight::destroy($id);
        return response()->json($flight);
    }
}
