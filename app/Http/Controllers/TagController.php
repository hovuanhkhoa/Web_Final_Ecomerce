<?php

namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index(){
        return $this->OKResponse(Tag::select('ID as id','Tag_name as tagName')->get());
    }

    public function show($id){
        try{
            $tag = Tag::select('ID as id','Tag_name as tagName')
                ->where('ID',$id)->first();
            if($tag == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($tag);
    }

    public function store(Request $request){
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


    public function update(Request $request, $id){
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
            $tag = Tag::where('ID', $id)->first();
            if($tag == null){
                return $this->NotFoundResponse();
            }
            $tag->delete();
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse(['message'=> 'Removed']);
    }

}
