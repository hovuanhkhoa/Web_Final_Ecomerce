<?php

namespace App\Http\Controllers;

use App\User;
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
}
