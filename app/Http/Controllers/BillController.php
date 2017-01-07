<?php

namespace App\Http\Controllers;

use App\Bill;
use Exception;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //

    public function index(){
        try {
            $bills = Bill::select('ID as id')->get();
            $result = [];
            foreach ($bills as $bill) {
                array_push($result, $bill->show($bill->id));
            }
            return $this->OKResponse($result);
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
    }

    public  function show($id){
        try{
            $bill = Bill::select('bills.ID as id')
                ->where('bills.ID', $id)->first();
            if($bill == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($bill->show());
    }

    public  function update(Request $request, $id){
        if($request->has('state')) {
            try {
                $state = (int)$request->get('state');
                if($state<1 ||$state>4)
                    return $this->BadResponse();

                $bill = Bill::select('bills.ID as id')
                    ->where('bills.ID', $id)->first();
                if($bill == null) return $this->NotFoundResponse();

                $bill->State = $state;
                $bill->save();
                if ($bill == null) {
                    return $this->NotFoundResponse();
                }
            } catch (Exception $ex) {
                return $this->NotFoundResponse();
            }
            return $this->OKResponse($bill->show());
        }
        return $this->BadResponse();
    }

    public  function remove($id){
        try {
            $bill = Bill::select('bills.ID as id')
                ->where('bills.ID', $id)->first();

            if($bill == null) return $this->NotFoundResponse();

            $bill->delete();
            if ($bill == null) {
                return $this->NotFoundResponse();
            }
        } catch (Exception $ex) {
            return $this->NotFoundResponse();
        }
        return $this->OKResponse(['message'=>'Removed']);
    }


    public function indexMe(Request $request){
        try {
            $user = $request->user();
            $bills = Bill::select('bills.ID as id')
                ->where('users.ID', $user->ID)
                ->join('users', 'users.ID_CUSTOMER', 'bills.ID_CUSTOMER')->get();
            $result = [];
            foreach ($bills as $bill) {
                array_push($result, $bill->show($bill->id));
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($result);
    }


    public function showMe(Request $request, $id){
        try {
            $user = $request->user();
            $bill = Bill::select('bills.ID as id')
                ->where('users.ID', $user->ID)
                ->where('bills.ID', $id)
            ->join('users', 'users.ID_CUSTOMER', 'bills.ID_CUSTOMER')->first();
            if($bill == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($bill->show());
    }





}
