<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $primaryKey = 'ID';

    public function show($id){
        $bill = Bill::select('bills.ID as id',
            'Receiver_name as receiverName',
            'Receiver_address as receiverAddress',
            'Receiver_phone as receiverPhone',
            'Detail as details',
            'Customer_name as customerName',
            'Address as customerAddress',
            'Phone as customerPhone',
            'Identify_number as customerIdentifyNumber',
            'State as state')
            ->where('bills.ID',$id)
            ->join('customers','customers.ID','bills.ID_CUSTOMER')->first();
        $total = 0;
        $detailArray = [];
        if ($bill->details != "") {
            $detail = $bill->details;
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
                $total += $quantityProduct * $temp->price;
                array_push($detailArray, $temp);
            }
        }
        $bill->details = $detailArray;
        $bill->total = $total;
        return $bill;
    }
}
