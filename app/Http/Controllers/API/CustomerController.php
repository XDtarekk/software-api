<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
//    public function index(){
//        $customer= Customer::all();
//    }


    public function store(Request $request){
        $customer= new Customer;
        $customer->name =$request->input('name');
        $customer->dateOfBirth =$request->input('dateOfBirth');
        $customer->email =$request->input('email');
        $customer->number =$request->input('number');
        $customer->county =$request->input('county');
        $customer->city =$request->input('city');
        $customer->address =$request->input('address');
        $customer->password =$request->input('password');
        $customer->save();
    }
}
