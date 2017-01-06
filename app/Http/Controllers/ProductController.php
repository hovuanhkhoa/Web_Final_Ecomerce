<?php

namespace App\Http\Controllers;

use App\Media;
use App\Product;
use App\Tag;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(){
        try {
            $products = Product::select('products.ID as id',
                'Product_name as productName',
                'Detail as detail',
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
                'Detail as detail',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
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
        return $this->ForbiddenResponse();
        if($request->has('tagName')){
            if(Tag::where('Tag_name',$request->get('tagName'))->exists()){
                return $this->ForbiddenResponse("Tag_name is existed");
            }

            $tag = new Tag();
            $tag->ID = Tag::max('ID') + 1;
            $tag->Tag_name = $request->get('tagName');

            $tag->save();
            return $this->OKResponse(Tag::select('ID as id','Tag_name as tagName')
                ->where('ID',$tag->ID)->first());
        }
        return $this->BadResponse();
    }


    public function update(Request $request, $id){//need repair
        return $this->ForbiddenResponse();
        if($request->has('tagName')){
            try {
                $tag = Tag::where('ID', $id)->first();
                if ($tag == null) {
                    $this->NotFoundResponse();
                }

                if(Tag::where('Tag_name',$request->get('tagName'))->exists()){
                    return $this->ForbiddenResponse("Tag_name is existed");
                }

                $tag->Tag_name = $request->get('tagName');

                $tag->save();
            }catch (Exception $ex){
                return $this->NotFoundResponse();
            }
            return $this->OKResponse(Tag::select('ID as id','Tag_name as tagName')
                ->where('ID',$tag->ID)->first());
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

}
