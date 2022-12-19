<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function place(Request $request)
    {
        if (auth('sanctum')->check()) {
            $validator= Validator::make($request->all(),[
                    //'customer_id'=>'max:200',
                    //'name'=>'required|string',
                    //'email'=>'required|string|unique:customers,email',
                    //'number'=>'required|string',
                    //'country'=>'required|string',
                    //'city'=>'required|string',
                    //'address'=>'required|string',
                    'payment_id'=>'string|required',
                    'payment_mode' => 'string|required'
                ]
            );
            if ($validator->fails())
            {
                return response()->json([
                    'status'=>422,
                    'errors'=>$validator->messages()]);
            }
            else
            {
                //$customer_id = auth('sanctum')->user()->id;
                $customer_id=Auth::user()->id;
                $order = new Order;
                $order->customer_id= $customer_id;
//                $order->name= $request->name;
//                $order->email= $request->email;
//                $order->number= $request->number;
//                $order->country= $request->country;
//                $order->city= $request->city;
//                $order->address= $request->address;
                $order->payment_id= $request->payment_id;
                $order->payment_mode= $request->payment_mode;
                $order->save();

                $cart= Cart::where('customer_id', $customer_id)->get();

                $orderitems=[];
                foreach ($cart as $item)
                {
                    $orderitems[]=[
                        //'order_id'=>$item->order_id,
                        'flight_id'=>$item->flight_id,
                        'ticket_qty'=>$item->ticket_qty,
                        'price'=>$item->flight->price,
                    ];
                    $item->flight->update([
                       'numberOfTickets'=>$item->flight->numberOfTickets -$item->ticket_qty
                    ]);
                }
                $order->orderitems()->createMany($orderitems);
                //$order->orderitems()->createMany($orderitems);
                Cart::destroy($cart);

                return response()->json([
                    'status'=>200,
                    'message'=>'success']);
            }
        }
        else
        {
            return response()->json([
                'status'=>401,
                'message'=>'not logged in']);
        }
    }
}
