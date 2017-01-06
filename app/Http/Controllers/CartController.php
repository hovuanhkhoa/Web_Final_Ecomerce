<?php

namespace App\Http\Controllers;

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
            $cart = User::select('carts.ID as id', 'carts.Detail as detail')
                ->where('users.ID', $user->ID)
                ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
            if($cart == null)
                return $this->NotFoundResponse();

            $detailArray = [];
            if ($cart->detail != "") {
                $detail = $cart->detail;
                $productArray = explode('|', $detail);
                foreach ($productArray as $product) {
                    $idProduct = $product[0];
                    $quantityProduct = $product[2];

                    $temp = Product::select('products.ID as id',
                        'Category_name as categoryName',
                        'Maker_name as makerName',
                        'Product_name as productName',
                        'Detail as detail',
                        'Price as price',
                        'Quantity as quantity')->where('products.ID', $idProduct)
                        ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                        ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();
                    $temp->quantity = $quantityProduct;
                    array_push($detailArray, $temp);
                }
            }
            $cart->detail = $detailArray;
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
        return $this->OKResponse($cart);
    }

    public function MyItemInCart(Request $request){
        try {
            $user = $request->user();
            $cart = User::select('carts.ID as id', 'carts.Detail as detail')
                ->where('users.ID', $user->ID)
                ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
            if($cart == null)
                return $this->NotFoundResponse();

            $detailArray = [];
            if ($cart->detail != "") {
                $detail = $cart->detail;
                $productArray = explode('|', $detail);
                foreach ($productArray as $product) {
                    $idProduct = $product[0];
                    $quantityProduct = $product[2];

                    $temp = Product::select('products.ID as id',
                        'Category_name as categoryName',
                        'Maker_name as makerName',
                        'Product_name as productName',
                        'Detail as detail',
                        'Price as price',
                        'Quantity as quantity')->where('products.ID', $idProduct)
                        ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                        ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();
                    $temp->quantity = $quantityProduct;
                    array_push($detailArray, $temp);
                }
            }
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
        return $this->OKResponse($detailArray);
    }


    public function AddItemToCart(Request $request){ ////// need repair
        if($request->has('')) {
            try {
                $user = $request->user();
                $cart = User::select('carts.ID as id', 'carts.Detail as detail')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                    ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
                if ($cart == null)
                    return $this->NotFoundResponse();

                $detailArray = [];

            } catch (Exception $ex) {
                return $this->ForbiddenResponse();
            }
            return $this->OKResponse($detailArray);
        }
        return $this->BadResponse();
    }

    public function RemoveItemFromCart(Request $request){ ////// need repair
        if($request->has('')) {
            try {
                $user = $request->user();
                $cart = User::select('carts.ID as id', 'carts.Detail as detail')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                    ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
                if ($cart == null)
                    return $this->NotFoundResponse();

                $detailArray = [];

            } catch (Exception $ex) {
                return $this->ForbiddenResponse();
            }
            return $this->OKResponse($detailArray);
        }
        return $this->BadResponse();
    }

    public function UpdateItemInCart(Request $request){ // new check quantity = 0;
        if($request->has('')) {
            try {
                $user = $request->user();
                $cart = User::select('carts.ID as id', 'carts.Detail as detail')
                    ->where('users.ID', $user->ID)
                    ->join('customers', 'customers.ID', 'users.ID_CUSTOMER')
                    ->join('carts', 'carts.ID_CUSTOMER', 'customers.ID')->first();
                if ($cart == null)
                    return $this->NotFoundResponse();

                $detailArray = [];

            } catch (Exception $ex) {
                return $this->ForbiddenResponse();
            }
            return $this->OKResponse($detailArray);
        }
        return $this->BadResponse();
    }



}
