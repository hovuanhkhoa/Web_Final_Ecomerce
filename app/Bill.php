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
            'State as state',
            'bills.created_at as orderDate')
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

                $kk = Product::select('products.ID as id',
                    'Category_name as categoryName',
                    'Maker_name as makerName',
                    'Product_name as productName',
                    'Detail as details',
                    'Price as price',
                    'Quantity as quantity',
                    'ID_TAG as tags',
                    'Media_set as media')->where('products.ID', $idProduct)
                    ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                    ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();


                $tagSet = [];
                $mediaSet = [];

                $tagArray = explode(',', $kk->tags);
                foreach ($tagArray as $tag) {
                    $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->first();
                    array_push($tagSet, $temp);
                }

                $mediaArray = explode(',', $kk->media);
                foreach ($mediaArray as $media) {
                    $temp = Media::select('Media_name as mediaName', 'Link as link')
                        ->where('Media_name', $kk->id . '_' . $media)->get();
                    if ($temp != null) {
                        foreach ($temp as $t) {
                            array_push($mediaSet, $t);
                        }
                    }
                }

                $kk->tags = $tagSet;
                $kk->media = $mediaSet;

                $kk->quantity = $quantityProduct;
                $total += (int)$quantityProduct * (int)$kk->price;
                array_push($detailArray, $kk);
            }
        }
        $bill->details = $detailArray;
        $bill->total = $total;
        $stateArray = ['','Chờ giao hàng','Đã giao hàng thành công','Hủy đơn hàng','Đơn hàng bị hoàn trả'];
        $bill->stateDetail = $stateArray[$bill->state];
        return $bill;
    }
}
