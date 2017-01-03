<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Auth extends Controller
{
    //
    public function Login(Request $request){
        if($request->has('grant_type')
            && $request->has('client_id')
            && $request->has('client_secret')
            && $request->has('username')
            && $request->has('password')){

            $role = CheckRole($request->get('username'));

            if($role === 'admin') {
                $request->request->add(['scope' => 'admin']);
            }
            else if ($role === 'user'){
                $request->request->add(['scope' => 'user']);
            }
            else{
                $request->request->add(['scope' => 'guest']);
            }

            $tokenRequest = Request::create(
                '/oauth/token',
                'post'
            );

            return  Route::dispatch($tokenRequest);
        }
        else{
            return json_encode('parameter is not correct');
        }
    }

    public function CheckRole($email)
    {
        $role =  DB::table('users')
            ->join('roles','users.role','roles.id')
            ->select('roles.name as name')
            ->where('email',$email)
            ->first();
        if($role === null){
            $role = 'guest';
        }
        return $role;
    }
}
