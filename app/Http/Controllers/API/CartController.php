<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Flight;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request){
        if (auth('sanctum')->check()) {
            $customer_id = auth('sanctum')->user()->id;
            $flight_id = $request->flight_id;
            $ticket_qty = $request->ticket_qty;

            $flight_check = Flight::where('id', $flight_id)->first();
            if ($flight_check) {

                if (Cart::where('flight_id',$flight_id)->where('customer_id', $customer_id)->exists())
                {
                    return response()->json([
                        'status' => 409,
                        'message' => 'already in cart']);
                }
                else{
                    $cartitem= new Cart;
                    $cartitem->customer_id= $customer_id;
                    $cartitem->flight_id= $flight_id;
                    $cartitem->ticket_qty= $ticket_qty;
                    $cartitem->save();
                    return response()->json([
                        'status' => 201,
                        'message' => 'added to cart']);
                }


            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'flight not found']);

            }

        }
        else
        {
            return response()->json([
                'status'=>401,
                'message'=>'not in cart']);
        }
    }
}
