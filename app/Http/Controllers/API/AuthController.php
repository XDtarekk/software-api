<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(){
        $customer= Customer::all();
        return response()->json(['customer'=>$customer]);
    }

    public function show(Request $request){
        $customer = auth('sanctum')->user()->all();
        //$flight=Flight::find($flight->id);
        return response()->json(['customer'=>$customer]);
    }

    public function getId(){
        //$customerID=Auth::user()->id;
        $customerID = auth('sanctum')->user()->id;
        return response(
            [//'status'=>200,
                'customer1'=>$customerID,
                //'token'=>$token
            ]
        );
    }
    public function register(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $fields= $request->validate([
                'name'=>'required|string',
                'dateOfBirth'=>'required|string',
                'email'=>'required|string|unique:customers,email',
                'number'=>'required|string',
                'country'=>'required|string',
                'city'=>'required|string',
                'address'=>'required|string',
                'password'=>'string|required',
                'pass_conf' => 'string|required'
            ]
        );

        $customer= Customer::create(array(
                'name'=>$fields['name'],
                'dateOfBirth'=>$fields['dateOfBirth'],
                'email'=>$fields['email'],
                'number'=>$fields['number'],
                'country'=>$fields['country'],
                'city'=>$fields['city'],
                'address'=>$fields['address'],
                'password'=>bcrypt($fields['password']),
                'pass_conf'=>bcrypt($fields['pass_conf'])   ,
            )
        );
        if ( $fields['password']== $fields['pass_conf']){

            $token=$customer->createToken('myapptolen')->plainTextToken;

//            $response=[
//                'customer'=>$customer->email,
//                'token'=>$token
//            ];

            return response(
                ['status'=>200,
                    'customer'=>$customer->email,
                    'token'=>$token]
                    );
        }else{
            return response([
                'message'=>'password confirmation is incorrect'
            ],401
            );
        }
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
            'status'=>200,
            'message' => 'Logged out',
        ];
    }
}
