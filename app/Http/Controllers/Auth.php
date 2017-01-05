<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


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
            && $request->has('name')
        ){
            $user = new User;
            $user->id = User::max('id') + 1 ;
            $user->name = $request->get('name');
            $user->email = $request->get('username');
            $user->password = Hash::make($request->get('password'));

            if(User::where('email',$user->email)->exists())
                return response()->json([
                    'message' => 'Email is existed'
                ], 403);

            $user->save();
            return  response()->json([
                'username' => $user->email
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Parameter is wrong'
            ], 400);
        }
    }


    public function CheckRole($email){
        $role =  DB::table('users')
            ->join('roles','users.role','roles.id')
            ->select('roles.name as name')
            ->where('email',$email)
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
