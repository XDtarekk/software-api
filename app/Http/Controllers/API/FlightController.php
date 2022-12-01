<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
        public function index(){
            $flight= Flight::all();
            return response()->json(['flight'=>$flight]);
    }

    public function show(Flight $flight){
            $flight=Flight::find($flight->id);
            return response()->json(['flight'=>$flight]);
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
//        $flight= new Flight;
//        $flight->from =$request->input('from');
//        $flight->destination =$request->input('destination');
//        $flight->departON =$request->input('departON');
//        $flight->returnOn =$request->input('returnOn');
//        $flight->seatClass =$request->input('seatClass');
//        $flight->numberOfStops =$request->input('numberOfStops');
//        $flight->RorO =$request->input('RorO');
//        $flight->numberOfTickets =$request->input('numberOfTickets');
//        $flight->numberOfTickets =$request->input('image');
//        $flight->save();
        $fields= $request->validate([
                'from'=>'required|string',
                'destination'=>'required|string',
                'departON'=>'required|string',
                'returnOn'=>'required|string',
                'seatClass'=>'required|string',
                'numberOfStops'=>'required|string',
                'RorO'=>'required|string',
                'numberOfTickets'=>'required',
                'price'=>'required|string',
                'image' => 'string|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );

        if($fields->fails())
        {
            return response()->json([
                'errors'=>$fields->messages(),
            ]);
        }
        else
        {
            $flight= new Flight;
            $flight->from =$request->input('from');
            $flight->destination =$request->input('destination');
            $flight->departON =$request->input('departON');
            $flight->returnOn =$request->input('returnOn');
            $flight->seatClass =$request->input('seatClass');
            $flight->numberOfStops =$request->input('numberOfStops');
            $flight->RorO =$request->input('RorO');
            $flight->numberOfTickets =$request->input('numberOfTickets');
            $flight->price =$request->input('price');
            //$flight->numberOfTickets =$request->input('image');
            if ($request->hasFile('image'))
            {
                $file=$request->file('image');
                $extension= $file->getClientOriginalExtension();
                $filename= time() .'.'.$extension;
                $file->move('uploads/flight', $filename);
                $flight->image= 'uploads/flight'.$filename;
            }
            $flight->save();
            return response()->json(['status'=>200,
                'message'=>'added successfully']);
        }


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
