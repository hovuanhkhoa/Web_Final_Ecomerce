<?php

namespace App\Http\Controllers;

use App\Media;
use Exception;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //

    public function index(){
        return $this->OKResponse(Media::select('ID as id','Media_name as mediaName', 'Link as link')->get());
    }

    public function show($id){
        try{
            $media = Media::select('ID as id','Media_name as mediaName', 'Link as link')
                ->where('ID',$id)->first();
            if($media == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($media);
    }

    public function store(Request $request){
        if($request->has('mediaName') && $request->has('link')){
            $media = new Media();
            $media->ID = Media::max('ID') + 1;
            $media->Media_name = $request->get('mediaName');
            $media->Link = $request->get('link');

            $media->save();
            return $this->OKResponse(Media::select('ID as id','Media_name as mediaName', 'Link as link')
                ->where('ID',$media->ID)->first());
        }
        return $this->BadResponse();
    }


    public function update(Request $request, $id){
        if($request->has('mediaName') && $request->has('link')){
            try {
                $media = Media::where('ID', $id)->first();
                if ($media == null) {
                    $this->NotFoundResponse();
                }
                $media->Media_name = $request->get('mediaName');
                $media->Link = $request->get('link');

                $media->save();
            }catch (Exception $ex){
                return $this->NotFoundResponse();
            }
            return $this->OKResponse(Media::select('ID as id','Media_name as mediaName', 'Link as link')
                ->where('ID',$media->ID)->first());
        }
        return $this->BadResponse();
    }

    public function remove($id){
        try{
            $media = Media::where('ID', $id)->first();
            if($media == null){
                return $this->NotFoundResponse();
            }
            $media->delete();
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse(['message'=> 'Removed']);
    }
}
