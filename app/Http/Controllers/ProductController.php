<?php

namespace App\Http\Controllers;

use App\Category;
use App\Maker;
use App\Media;
use App\Product;
use App\Tag;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    public function index(){
        try {
            $products = Product::select('products.ID as id',
                'Product_name as productName',
                'Detail as details',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
                ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                ->join('makers', 'makers.ID', 'products.ID_MAKER')->get();

            foreach ($products as $product) {

                $tagSet = [];
                $mediaSet = [];

                $mediaArray = explode(',', $product->media);
                foreach ($mediaArray as $media) {
                    $temp = Media::select('Media_name as mediaName', 'Link as link')
                        ->where('Media_name', $product->id . '_' . $media)->get();
                    if ($temp != null) {
                        foreach ($temp as $t) {
                            array_push($mediaSet, $t);
                        }
                    }
                }

                $tagArray = explode(',', $product->tags);
                foreach ($tagArray as $tag) {
                    $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->get();
                    if ($temp != null) {
                        foreach ($temp as $t) {
                            array_push($tagSet, $t);
                        }
                    }
                }

                $product->tags = $tagSet;
                $product->media = $mediaSet;
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($products);
    }

    public function show($id){
        try {
            $product = Product::select('products.ID as id',
                'Product_name as productName',
                'Detail as details',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
                ->where('products.ID',$id)
                ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                ->join('makers', 'makers.ID', 'products.ID_MAKER')->first();

            $tagSet = [];
            $mediaSet = [];

            $mediaArray = explode(',', $product->media);
            foreach ($mediaArray as $media) {
                $temp = Media::select('Media_name as mediaName', 'Link as link')
                    ->where('Media_name', $product->id . '_' . $media)->get();
                if ($temp != null) {
                    foreach ($temp as $t) {
                        array_push($mediaSet, $t);
                    }
                }
            }

            $tagArray = explode(',', $product->tags);
            foreach ($tagArray as $tag) {
                $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->get();
                if ($temp != null) {
                    foreach ($temp as $t) {
                        array_push($tagSet, $t);
                    }
                }
            }

            $product->tags = $tagSet;
            $product->media = $mediaSet;
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($product);
    }

    public function store(Request $request){//need repair
        if($request->has('productName')
            && $request->has('details')
            && $request->has('mediaSet')
            && $request->has('price')
            && $request->has('quantity')
            && $request->has('idMaker')
            && $request->has('idCategory')
            && $request->has('idTag')){
            try {

                $idTag = str_replace(' ', '', $request->get('idTag'));
                $idTagArray = explode(',', $idTag);

                if (Tag::whereIn('ID', $idTagArray)->get()->count() < count($idTagArray))
                    return $this->NotFoundResponse('ID_TAG not found');

                if (!Maker::where('ID', $request->get('idMaker'))->exists())
                    return $this->NotFoundResponse('ID_MAKER not found');

                if (!Category::where('ID', $request->get('idCategory'))->exists())
                    return $this->NotFoundResponse('ID_CATEGORY not found');

                $product = new Product();
                $product->ID = Product::max('ID') + 1;
                $product->Product_name = $request->get('productName');
                $product->Detail = $request->get('details');
                $product->Media_set = $request->get('mediaSet');
                $product->Price = $request->get('price');
                $product->Quantity = $request->get('quantity');
                $product->ID_MAKER = $request->get('idMaker');
                $product->ID_CATEGORY = $request->get('idCategory');
                $product->ID_TAG = $request->get('idTag');
                $product->save();
            }catch (Exception $ex){
                return $this->BadResponse();
            }
            return $this->show($product->ID);
        }
        return $this->BadResponse();
    }


    public function update(Request $request, $id){//need repair
        if($request->has('productName')
            && $request->has('details')
            && $request->has('mediaSet')
            && $request->has('price')
            && $request->has('quantity')
            && $request->has('idMaker')
            && $request->has('idCategory')
            && $request->has('idTag')){
            try {

                $idTag = str_replace(' ', '', $request->get('idTag'));
                $idTagArray = explode(',', $idTag);

                if (Tag::whereIn('ID', $idTagArray)->get()->count() < count($idTagArray))
                    return $this->NotFoundResponse('ID_TAG not found');

                if (!Maker::where('ID', $request->get('idMaker'))->exists())
                    return $this->NotFoundResponse('ID_MAKER not found');

                if (!Category::where('ID', $request->get('idCategory'))->exists())
                    return $this->NotFoundResponse('ID_CATEGORY not found');

                $product = Product::where('ID', $id)->first();
                $product->Product_name = $request->get('productName');
                $product->Detail = $request->get('details');
                $product->Media_set = $request->get('mediaSet');
                $product->Price = $request->get('price');
                $product->Quantity = $request->get('quantity');
                $product->ID_MAKER = $request->get('idMaker');
                $product->ID_CATEGORY = $request->get('idCategory');
                $product->ID_TAG = $request->get('idTag');

                $product->save();
            }catch (Exception $ex){
                return $this->NotFoundResponse();
            }

            return $this->show($id);
        }
        return $this->BadResponse();
    }

    public function remove($id){
        try{
            $product = Product::where('ID', $id)->first();
            if($product == null){
                return $this->NotFoundResponse();
            }
            $product->delete();
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse(['message'=> 'Removed']);
    }


    public function search(Request $request){
        if($request->has('q')){
            $query = $request->get('q');

            //$productID = Product::select('ID')->where("Product_name",'LIKE',$query)->pluck('ID')->toArray();

            $productID =[];
            $queryArray = explode(' ',$query);
            //dd($queryArray);
            foreach($queryArray as $q){
                $productID = array_merge($productID,
                    Product::whereRaw('LOWER("Product_name") like ?', ['%' . strtolower($q) . '%'])
                    ->pluck('ID')->toArray());
            }

            if(count($productID) >0) {
                $products = Product::select('products.ID as id',
                    'Product_name as productName',
                    'Detail as details',
                    'Price as price',
                    'Quantity as quantity',
                    'Category_name as categoryName',
                    'Maker_name as makerName',
                    'Media_set as media',
                    'ID_TAG as tags')
                    ->whereIn('products.ID', $productID)
                    ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                    ->join('makers', 'makers.ID', 'products.ID_MAKER')->get();

                foreach ($products as $product) {

                    $tagSet = [];
                    $mediaSet = [];

                    $mediaArray = explode(',', $product->media);
                    foreach ($mediaArray as $media) {
                        $temp = Media::select('Media_name as mediaName', 'Link as link')
                            ->where('Media_name', $product->id . '_' . $media)->get();
                        if ($temp != null) {
                            foreach ($temp as $t) {
                                array_push($mediaSet, $t);
                            }
                        }
                    }

                    $tagArray = explode(',', $product->tags);
                    foreach ($tagArray as $tag) {
                        $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->get();
                        if ($temp != null) {
                            foreach ($temp as $t) {
                                array_push($tagSet, $t);
                            }
                        }
                    }

                    $product->tags = $tagSet;
                    $product->media = $mediaSet;
                }
                return $this->OKResponse($products);
            }
        }
        return $this->NotFoundResponse();
    }


    public function FeatureProducts(Request $request){
        try {
            $start = Carbon::now();

            $end = $start->copy()->addDays(-1);

            $products = Product::select('products.ID as id',
                'Product_name as productName',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
                ->where('products.created_at','>=',$end)
                ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                ->join('makers', 'makers.ID', 'products.ID_MAKER')->get();


            $result = [];

            foreach ($products as $product) {

                $tagSet = [];
                $mediaSet = [];
                $flag = true;

                $tagArray = explode(',', $product->tags);
                foreach ($tagArray as $tag) {
                    $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->first();
                    if(strtolower($temp->tagName) == strtolower('Main Product'))
                        $flag = false;
                    array_push($tagSet, $temp);
                }


                if($flag) continue;


                $mediaArray = explode(',', $product->media);
                foreach ($mediaArray as $media) {
                    $temp = Media::select('Media_name as mediaName', 'Link as link')
                        ->where('Media_name', $product->id . '_' . $media)->get();
                    if ($temp != null) {
                        foreach ($temp as $t) {
                            array_push($mediaSet, $t);
                        }
                    }
                }

                $product->tags = $tagSet;
                $product->media = $mediaSet;
                array_push($result, $product);
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($result);
    }


    public function FeatureAccessories(Request $request){
        try {
            $start = Carbon::now();

            $end = $start->copy()->addDays(-1);

            $products = Product::select('products.ID as id',
                'Product_name as productName',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
                ->where('products.created_at','>=',$end)
                ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                ->join('makers', 'makers.ID', 'products.ID_MAKER')->get();


            $result = [];

            foreach ($products as $product) {

                $tagSet = [];
                $mediaSet = [];
                $flag = true;

                $tagArray = explode(',', $product->tags);
                foreach ($tagArray as $tag) {
                    $temp = Tag::select('Tag_name as tagName')->where('ID', $tag)->first();
                    if(strtolower($temp->tagName) == strtolower('Accessory'))
                        $flag = false;
                    array_push($tagSet, $temp);
                }

                if($flag) continue;

                $mediaArray = explode(',', $product->media);
                foreach ($mediaArray as $media) {
                    $temp = Media::select('Media_name as mediaName', 'Link as link')
                        ->where('Media_name', $product->id . '_' . $media)->get();
                    if ($temp != null) {
                        foreach ($temp as $t) {
                            array_push($mediaSet, $t);
                        }
                    }
                }

                $product->tags = $tagSet;
                $product->media = $mediaSet;
                array_push($result, $product);
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($result);
    }


    public function RelatedProduct($id){
        try{

        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
    }

    public function RelatedAccessory($id){
        try{

        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }



    }





}
