<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Cart;
use App\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function MyCart(Request $request){
        try {
            $user = $request->user();
            $cart = User::select('carts.ID as id', 'carts.Detail as details')
                ->where('users.ID', $user->ID)
                ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
            if($cart == null)
                return $this->NotFoundResponse();

            $detailArray = [];
            if ($cart->details != "") {
                $detail = $cart->details;
                $productArray = explode('|', $detail);
                foreach ($productArray as $product) {
                    $pos1 = strpos($product,',');
                    $idProduct = substr($product,0, $pos1);
                    $quantityProduct = substr($product,$pos1 + 1 ,strlen($product)-1 - $pos1);

                    $temp = Product::select('products.ID as id',
                        'Category_name as categoryName',
                        'Maker_name as makerName',
                        'Product_name as productName',
                        'Detail as details',
                        'Price as price',
                        'Quantity as quantity')->where('products.ID', $idProduct)
                        ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                        ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();
                    $temp->quantity = $quantityProduct;
                    array_push($detailArray, $temp);
                }
            }
            $cart->details = $detailArray;
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
        return $this->OKResponse($cart);
    }

    public function MyItemsInCart(Request $request){
        try {
            $user = $request->user();
            $cart = User::select('carts.ID as id', 'carts.Detail as details')
                ->where('users.ID', $user->ID)
                ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
            if($cart == null)
                return $this->NotFoundResponse();

            $detailArray = [];
            if ($cart->details != "") {
                $detail = $cart->details;
                $productArray = explode('|', $detail);
                foreach ($productArray as $product) {
                    $pos1 = strpos($product,',');
                    $idProduct = substr($product,0, $pos1);
                    $quantityProduct = substr($product,$pos1 +1,strlen($product) -1 - $pos1);

                    $temp = Product::select('products.ID as id',
                        'Category_name as categoryName',
                        'Maker_name as makerName',
                        'Product_name as productName',
                        'Detail as details',
                        'Price as price',
                        'Quantity as quantity')->where('products.ID', $idProduct)
                        ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                        ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();
                    $temp->quantity = $quantityProduct;
                    array_push($detailArray, $temp);
                }
            }
            return $this->OKResponse($detailArray);
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }

    }

    public function MyItemInCart(Request $request, $id){
        try {
            $user = $request->user();
            $cart = User::select('carts.ID as id', 'carts.Detail as details')
                ->where('users.ID', $user->ID)
                ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
            if ($cart == null)
                return $this->NotFoundResponse();

            $temp = '';
            $pos1 = strpos($cart->details, $id . ',');
            if ($cart->details != "" && $pos1 !== false) {
                $pos2 = strpos($cart->details, '|', $pos1 + 1);
                if ($pos2 === false) $pos2 = strlen($cart->details);
                $quantityProduct = substr($cart->details,
                    $pos1 + strlen($id . ','),
                    $pos2 - $pos1 - strlen($id . ','));

                $temp = Product::select('products.ID as id',
                    'Category_name as categoryName',
                    'Maker_name as makerName',
                    'Product_name as productName',
                    'Detail as details',
                    'Price as price',
                    'Quantity as quantity')->where('products.ID', $id)
                    ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                    ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();

                $temp->quantity = $quantityProduct;
                return $this->OKResponse($temp);
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->NotFoundResponse();
    }


    public function AddItemToCart(Request $request){ ////// need repair
        if($request->has('id') && $request->has('quantity')) {
            try {
                $user = $request->user();
                $cart = Cart::select('carts.*')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'carts.ID_CUSTOMER')
                    ->join('users', 'users.ID_CUSTOMER', 'customers.ID')
                    ->first();
                if ($cart == null)
                    return $this->NotFoundResponse();

                if((int)$request->get('quantity') <= 0)
                    return $this->MyItemsInCart($request);

                $idProduct = $request->get('id');
                $start = strpos($cart->Detail,$idProduct . ',');
                if($start !== false) {
                    $start +=  + strlen($idProduct . ',');
                    $flag = strpos($cart->Detail, '|', $start);
                    $end = $flag !== false ? $flag : strlen($cart->Detail);
                    $quantity = (int)substr($cart->Detail, $start, $end - $start) + (int)$request->get('quantity');
                    $product = Product::where('ID',$idProduct)->first();
                    if($quantity > $product->Quantity) $quantity = $product->Quantity;

                    $cart->Detail = substr_replace($cart->Detail, $quantity . '', $start, $end - $start);
                }
                else{
                    $cart->Detail .= '|' . $idProduct . ',' . $request->get('quantity');
                }
                $cart->save();
                return $this->MyItemsInCart($request);
            } catch (Exception $ex) {
                return $this->ForbiddenResponse();
            }
        }
        return $this->NotFoundResponse();
    }

    public function RemoveItemFromCart(Request $request, $id){ ////// need repair
        try {
            $user = $request->user();
            $cart = Cart::select('carts.*')
                ->where('users.ID', $user->ID)
                ->where('carts.ID', $request->get('id'))
                ->join('customers', 'customers.ID', 'carts.ID_CUSTOMER')
                ->join('users', 'users.ID_CUSTOMER', 'customers.ID')
                ->first();

            if ($cart == null)
                return $this->NotFoundResponse();

            $idProduct = $id;
            $start = strpos($cart->Detail,$idProduct . ',');
            $start = $start > 0 ? $start - 1 : $start;
            $flag = strpos($cart->Detail,'|',$start + 1);
            $end = $flag !== false ? $flag + 1 : strlen($cart->Detail);

            $cart->Detail = substr_replace($cart->Detail, '', $start, $end - $start);
            $cart->save();

            return $this->MyItemsInCart($request);
        } catch (Exception $ex) {
            return $this->ForbiddenResponse();
        }
    }

    public function UpdateItemInCart(Request $request, $id){ // new check quantity = 0;
        if($request->has('quantity')) {
            try {
                $user = $request->user();
                $cart = Cart::select('carts.*')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'carts.ID_CUSTOMER')
                    ->join('users', 'users.ID_CUSTOMER', 'customers.ID')
                    ->first();
                if ($cart == null)
                    return $this->NotFoundResponse();
                if((int)$request->get('quantity') <= 0)
                    return $this->MyItemInCart($request,$id);

                $idProduct = $id;
                $start = strpos($cart->Detail,$idProduct . ',');
                if($start !== false) {
                    $start +=  + strlen($idProduct . ',');
                    $flag = strpos($cart->Detail, '|', $start);
                    $end = $flag !== false ? $flag : strlen($cart->Detail);
                    $quantity = (int)substr($cart->Detail, $start, $end - $start) + (int)$request->get('quantity');
                    $product = Product::where('ID',$idProduct)->first();
                    if($quantity > $product->Quantity) $quantity = $product->Quantity;


                    $cart->Detail = substr_replace($cart->Detail, $quantity . '', $start, $end - $start);
                    $cart->save();
                    return $this->MyItemInCart($request,$id);
                }
            } catch (Exception $ex) {
                return $this->ForbiddenResponse();
            }
        }
        return $this->BadResponse();
    }


    public function checkout(Request $request){
        if($request->has('receiverName')
        && $request->has('receiverPhone')
        && $request->has('receiverAddress')){
            //try{
                $user = $request->user();
                $cart = Cart::select('carts.*')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'carts.ID_CUSTOMER')
                    ->join('users', 'users.ID_CUSTOMER', 'customers.ID')
                    ->first();

                if ($cart == null)
                    return $this->NotFoundResponse();
                if($cart->Detail == "")
                    return $this->ForbiddenResponse('Cart is empty!');

                $bill = new Bill();
                $bill->ID = Bill::max('ID') + 1 ;
                $bill->ID_CUSTOMER = $cart->ID_CUSTOMER;
                $bill->Receiver_name = $request->get('receiverName');
                $bill->Receiver_phone = $request->get('receiverPhone');
                $bill->Receiver_address = $request->get('receiverAddress');
                $bill->Detail = $cart->Detail;
                $bill->State = 1;
                $bill->save();

                $cart->Detail = '';
                $cart->save();

                return $this->OKResponse($bill->show($bill->ID));
            //}catch (Exception $ex){
            //    return $this->ForbiddenResponse();
           // }
        }
        return $this->BadResponse();
    }



}
