<?php

namespace App\Http\Controllers;

use App\Category;
use App\Media;
use App\Product;
use App\Tag;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index(){
        return $this->OKResponse(Category::select('ID as id','Category_name as categoryName')->get());
    }


    public function store(Request $request){
        if($request->has('categoryName')){
            $categoryName = $request->get('categoryName');

            if(Category::where('Category_name',$categoryName)->exists()){
                return $this->ForbiddenResponse("Category is existed");
            }

            $category = new Category();
            $category->ID = Category::max('ID') +1 ;
            $category->Category_name = $categoryName;
            $category->save();

            return $this->CreatedResponse(
                Category::select('ID as id', 'Category_name as categoryName')
                ->where('ID',$category->ID)->get()->first()
            );
        }
        return $this->BadResponse();
    }

    public function update(Request $request, $id){
        if($request->has('categoryName')){
            try{

                if(Category::where('Category_name',$request->get('categoryName'))->exists()){
                    return $this->ForbiddenResponse("Category is existed");
                }

                $category = Category::where('ID', $id)->first();

                $category->Category_name = $request->get('categoryName');
                $category->save();
            }catch (Exception $ex)
            {
                return $this->NotFoundResponse();
            }
            return $this->OKResponse(
                Category::select('ID as id','Category_name as categoryName')
                    ->where('ID',$category->ID)->get()->first()
            );
        }
        return $this->BadResponse();
    }


    public function remove(Request $request, $id){
        try{
            $category =Category::where('ID', $id)->get()->first();
            if($category == null){
                return $this->NotFoundResponse();
            }
            $category->delete();
        }catch (Exception $ex){
            return $this->ForbiddenResponse();
        }
        return $this->OKResponse(['message' => 'Removed']);
    }

    public function Filter(Request $request, $products){
        if($request->get('maker') != null && $request->get('maker') != ""){
            $products->where('Maker_name',$request->get('maker'));
        }

        if($request->get('minPrice') != null && $request->get('minPrice') != ""){
            $products->where('Price','>=',$request->get('minPrice'));
        }

        if($request->get('maxPrice') != null && $request->get('maxPrice') != ""){
            $products->where('Price','<=',$request->get('maxPrice'));
        }

        if($request->get('offset') != null && $request->get('offset') != ""){
            $products->offset($request->get('offset'));
        }

        if($request->get('limit') != null && $request->get('limit') != ""){
            $products->limit($request->get('limit'));
        }

        if($request->get('sort') != null && $request->get('sort') != ""){
            $sort = $request->get('sort');
            $sortName = substr($sort,1);
            if($sortName == "ate" || $sortName == '-date')
                $sortName = 'products.updated_at';
            else
                $sortName = 'Price';
            if($sort[0] == '-'){
                $products->orderBy($sortName, 'desc');
            }else{
                $products->orderBy($sortName, 'asc');
            }
        }

        $products = $products->get();

        $os = $this->getFromRequest($request,'os');
        $minRam = $this->getFromRequest($request,'minRam');
        $maxRam = $this->getFromRequest($request,'maxRam');
        $minMem = $this->getFromRequest($request,'minInternalMem');
        $maxMem = $this->getFromRequest($request,'maxInternalMem');
        $minFR = $this->getFromRequest($request,'minFrontCameraRes');
        $maxFR = $this->getFromRequest($request,'maxFrontCameraRes');
        $minBR = $this->getFromRequest($request,'minBackCameraRes');
        $maxBR =$this->getFromRequest($request,'maxBackCameraRes');
        $minPin = $this->getFromRequest($request,'minPinCapacity');
        $maxPin =$this->getFromRequest($request,'maxPinCapacity');
        $minScreenSize =$this->getFromRequest($request,'minScreenSize');
        $maxScreenSize =$this->getFromRequest($request,'maxScreenSize');
        $minHdd =$this->getFromRequest($request,'minHddSize');
        $maxHdd =$this->getFromRequest($request,'maxHddSize');
        $minSize =$this->getFromRequest($request,'minSize');
        $maxSize =$this->getFromRequest($request,'maxSize');
        $type =$this->getFromRequest($request,'type');



        //dd($products);
        $result = [];
        foreach($products as $product){
            $jsonD = json_decode($product->details);
            //dd($jsonD->os);
            if($os != null && $jsonD->os != null  && strpos(strtolower($jsonD->os),strtolower($os)) === false){
                continue;
            }

            if($type != null && $jsonD->type != null  && strpos(strtolower($jsonD->type),strtolower($type)) === false){
                continue;
            }

            if($minRam != null && $jsonD->ram != null && $jsonD->ram < $minRam){
                continue;
            }

            if($maxRam != null && $jsonD->ram != null && $jsonD->ram > $maxRam){
                continue;
            }

            if($minMem != null && $jsonD->internalMemSize != null && $jsonD->internalMemSize < $minMem){
                continue;
            }

            if($maxMem != null && $jsonD->internalMemSize != null && $jsonD->internalMemSize > $maxMem){
                continue;
            }

            if($minFR != null && $jsonD->frontCameraRes != null && $jsonD->frontCameraRes < $minFR){
                continue;
            }

            if($maxFR != null && $jsonD->frontCameraRes != null && $jsonD->frontCameraRes > $maxFR){
                continue;
            }

            if($minBR != null && $jsonD->backCameraRes != null && $jsonD->backCameraRes < $minBR){
                continue;
            }

            if($maxBR != null && $jsonD->backCameraRes != null && $jsonD->backCameraRes > $maxBR){
                continue;
            }

            if($minPin != null && $jsonD->pinCapacity != null && $jsonD->pinCapacity < $minPin){
                continue;
            }

            if($maxPin != null && $jsonD->pinCapacity != null && $jsonD->pinCapacity > $maxPin){
                continue;
            }

            if($minScreenSize != null && $jsonD->screenSize != null && floatval($jsonD->screenSize) < floatval($minScreenSize)){
                continue;
            }

            if($maxScreenSize != null && $jsonD->screenSize != null && floatval($jsonD->screenSize) > floatval($maxScreenSize)){
                continue;
            }

            if($minHdd != null && $jsonD->hddSize != null && floatval($jsonD->hddSize) < floatval($minHdd)){
                continue;
            }

            if($maxHdd != null && $jsonD->hddSize != null && floatval($jsonD->hddSize) > floatval($maxHdd)){
                continue;
            }

            if($minSize != null && $jsonD->size != null && floatval($jsonD->size) < floatval($minSize)){
                continue;
            }

            if($maxSize != null && $jsonD->size != null && floatval($jsonD->size) > floatval($maxSize)){
                continue;
            }

            array_push($result,$product);
        }

        return $result;
    }

    public function getFromRequest(Request $request, $name){
        if($request->get($name) != null && $request->get($name) != ""){
            return $request->get($name);
        }
        return null;
    }

    public function show(Request $request, $id){
        try{
            $products = Product::select('products.ID as id',
                'Product_name as productName',
                'Detail as details',
                'Price as price',
                'Quantity as quantity',
                'Category_name as categoryName',
                'Maker_name as makerName',
                'Media_set as media',
                'ID_TAG as tags')
                ->whereRaw('LOWER("Category_name") = ?', [strtolower($id)])
                ->join('categories', 'categories.ID', 'products.ID_CATEGORY')
                ->join('makers', 'makers.ID', 'products.ID_MAKER');




            $products = $this->Filter($request, $products);

            $offset = $request->get('offset') == null? 0: (int)$request->get('offset');
            $limit = $request->get('limit') == null? 0 : (int)$request->get('limit');

            $count = count($products) - ($offset + $limit);

            if($products == null){
                return $this->NotFoundResponse();
            }

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
        return $this->OKResponse($products,["remaining" => $count]);
    }
}
