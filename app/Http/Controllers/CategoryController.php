<?php

namespace App\Http\Controllers;

use App\Category;
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

    public function show($id){
        try{
            $category =Category::select('ID as id','Category_name as categoryName')
                ->where('ID', $id)->get()->first();
            if($category == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($category);
    }
}
