<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $fields= $request->validate([
                'name'=>'required|string',
                'dateOfBirth'=>'required|string',
                'email'=>'required|string|unique:customers,email',
                'number'=>'required|string',
                'county'=>'required|string',
                'city'=>'required|string',
                'address'=>'required|string',
                'password'=>'required|string|confirmed'
            ]
        );

        $customer= Customer::create([
                'name'=>$fields['name'],
                'dateOfBirth'=>$fields['dateOfBirth'],
                'email'=>$fields['email'],
                'number'=>$fields['number'],
                'county'=>$fields['county'],
                'city'=>$fields['city'],
                'address'=>$fields['address'],
                'password'=>bcrypt($fields['password'])
            ]
        );

        $token=$customer->createToken('myapptolen')->plainTextToken;

        $response=[
            'customer'=>$customer,
            'token'=>$token
        ];

        return response($response,201);
    }

    public function login(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $fields= $request->validate([
                'email'=>'required|string',
                'password'=>'required|string'
            ]
        );

        $customer= Customer::Where('email', $fields['email'])->first();

        if (!$customer || !Hash::check($fields['password'], $customer->password)){
            return response([
                'message'=>'wrong email or password'
                ],401
            );
        }

        $token=$customer->createToken('myapptolen')->plainTextToken;

        $response=[
            'customer'=>$customer,
            'token'=>$token
        ];

        return response($response,201);
    }
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
