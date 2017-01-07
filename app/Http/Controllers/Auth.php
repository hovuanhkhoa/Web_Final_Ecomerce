<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Customer;
use App\User;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



class Auth extends Controller
{
    //
    public function Login(Request $request){
        //dd($request);
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
            return $this->BadResponse();
        }
    }

    public function LoginFacebook(Request $request){
        if($request->has('code')) {
            $clientID = '1363475290332214';
            $redirect_uri = 'http://localhost:8001/Web_Final_Ecomerce/public/api/facebook/login';
            $client_secret = 'cb551b6f00ee87959d1ecbad0b36556f';
            $code = $request->get('code');

            $facebook_access_token_uri = "https://graph.facebook.com/v2.8/oauth/access_token?client_id=$clientID&redirect_uri=$redirect_uri&client_secret=$client_secret&code=$code";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);
            // Get access token
            $aResponse = json_decode($response);
            $access_token = $aResponse->access_token;
            //return $access_token;

            if ($access_token == null) {
                return $this->UnAuthentication();
            }

            $facebook_access_token_uri = "https://graph.facebook.com/me?access_token=$access_token";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);
            $aResponse = json_decode($response);

            $fbid = $aResponse->id;
            $fbName = $aResponse->name;
            if($fbName == null) $fbName = $fbid;

            if(!User::where('Username',$fbid)->exists()) {
                //echo "qweqweqwe";
                $body1 = json_encode([
                    "username" => $fbid ,
                    "password" => "@#@$$fbid@#@",
                    "customerName" => $fbName]);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, App::make('url')->to('/') . '/api/register');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_exec($ch);
                curl_close($ch);
            }
            //echo "123123123";
            $body = json_encode([
                "grant_type" => "password",
                "client_id" => 2,
                "client_secret" => "4jIxZ3fjI0UNQrRFQ0esspZVtIMmFfXHIw9GI7SD",
                "username" => $fbid,
                "password" => "@#@$$fbid@#@"]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, App::make('url')->to('/') . '/api/login');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
        }
        return $this->BadResponse();
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
            return $this->BadResponse();
        }
    }

    public function Register(Request $request){
        try {
            //echo $request->has('username');
            if ($request->has('username')
                && $request->has('password')
                && $request->has('customerName')
                //&& $request->has('identifyNumber')
                //&& $request->has('phone')
                //&& $request->has('address')
            ) {
                if (User::where('Username', $request->get('username'))->exists())
                    return $this->ForbiddenResponse('Username is existed');

                //if (Customer::where('Identify_number', $request->get('identifyNumber'))->exists())
                //    return $this->ForbiddenResponse('Identify_number is existed');

                $customer = new Customer();
                $customer->ID = Customer::max('ID') + 1;
                $customer->Customer_name = $request->get('customerName');
                $customer->Identify_number = 'Need fill ' . $request->get('username');
                $customer->Phone = 'Need fill ' . $request->get('username');
                $customer->Email = 'Need fill ' . $request->get('username');
                $customer->Address = 'Need fill ' . $request->get('username');
                $customer->save();

                $cart = new Cart();
                $cart->ID = Cart::max('ID') + 1;
                $cart->ID_CUSTOMER = $customer->ID;
                $cart->Detail = '';
                $cart->save();


                $user = new User;
                $user->ID = User::max('ID') + 1;
                $user->ID_CUSTOMER = $customer->ID;
                $user->Username = $request->get('username');
                $user->Password = Hash::make($request->get('password'));
                $user->ID_ROLE = 2;

                $user->save();
                return $this->CreatedResponse(['message' => 'Created']);
            }
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
        return $this->BadResponse();
    }


    public function CheckRole($username){
        $role =  DB::table('users')
            ->join('roles','users.ID_ROLE','roles.ID')
            ->select('roles.Role_name as name')
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
