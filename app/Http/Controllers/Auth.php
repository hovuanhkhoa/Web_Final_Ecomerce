<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
//use Laravel\Socialite\Facades\Socialite;


class Auth extends Controller
{
    //
    public function Login(Request $request){
        if($request->has('grant_type')
            && $request->has('client_id')
            && $request->has('client_secret')
            && $request->has('username')
            && $request->has('password')
        ){

            $role = $this->CheckRole($request->get('username'));

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
            return response()->json([
                'message' => 'Parameter is wrong'
            ], 400);
        }
    }


    public function RefreshToken(Request $request){
        if($request->has('grant_type')
            && $request->has('client_id')
            && $request->has('client_secret')
            && $request->has('refresh_token')
        ){
            $request->request->add(['scope' => '']);
            $tokenRequest = Request::create(
                '/oauth/token',
                'post'
            );

            return  Route::dispatch($tokenRequest);
        }
        else{
            return response()->json([
                'message' => 'Parameter is wrong'
            ], 400);
        }
    }

    public function Register(Request $request){
        if($request->has('username')
            && $request->has('password')
            //&& $request->has('name')
        ){
            $user = new User;
            $user->ID = User::max('ID') + 1 ;
            $user->ID_CUSTOMER = 1; ////////////////////DUMMY
            $user->Username = $request->get('username');
            $user->Password = Hash::make($request->get('password'));
            $user->ID_ROLE = 2;

            if(User::where('Username',$user->Username)->exists())
                return response()->json([
                    'message' => 'Username is existed'
                ], 403);

            $user->save();
            return  response()->json([
                'username' => $user->Username
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Parameter is wrong'
            ], 400);
        }
    }


    public function CheckRole($username){
        $role =  DB::table('users')
            ->join('ROLES','users.ID_ROLE','ROLES.ID')
            ->select('ROLES.Role_name as name')
            ->where('Username',$username)
            ->first();
        if($role === null){
            $role = 'guest';
        }
        else{
            $role = $role->name;
        }
        return $role;
    }


}
