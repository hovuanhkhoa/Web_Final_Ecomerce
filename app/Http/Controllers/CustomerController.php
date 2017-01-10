<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class CustomerController extends Controller
{
    //
    public function index(Request $request){
        $user = $request->user();
        $me = User::select('users.ID as id',
            'Username as username',
            'Customer_name as customerName',
            'Email as email',
            'Identify_number as identifyNumber',
            'Phone as phone',
            'Address as address'
            )->where('users.ID',$user->ID)
            ->join('customers','customers.ID','users.ID_CUSTOMER')
            ->first();

        return $this->OKResponse($me);
    }


    public function UpdateProfile(Request $request){
        if($request->has('customerName')
            && $request->has('identifyNumber')
            && $request->has('phone')
            && $request->has('email')
            && $request->has('address')) {
            try{
                $user = $request->user();
                $me = Customer::select('customers.*')
                    ->join('users','customers.ID','users.ID_CUSTOMER')
                    ->groupBy('customers.ID')
                    ->where('users.ID',$user->ID)->first();

                if($me == null){
                    $this->NotFoundResponse();
                }

                $me->Customer_name = $request->get('customerName');
                $me->Identify_number = $request->get('identifyNumber');
                $me->Phone = $request->get('phone');
                $me->Email = $request->get('email');
                $me->Address = $request->get('address');
                $me->save();

                return $this->OKResponse(User::select('users.ID as id',
                    'Username as username',
                    'Customer_name as customerName',
                    'Email as email',
                    'Identify_number as identifyNumber',
                    'Phone as phone',
                    'Address as address')->where('users.ID',$user->ID)
                    ->join('customers','customers.ID','users.ID_CUSTOMER')
                    ->first());
            }catch (Exception $ex){
                return $this->NotFoundResponse();
            }
        }
        return $this->BadResponse();
    }
}
