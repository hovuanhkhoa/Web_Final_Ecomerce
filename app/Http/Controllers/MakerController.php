<?php

namespace App\Http\Controllers;

use App\Maker;
use Exception;
use Illuminate\Http\Request;

class MakerController extends Controller
{
    //

    public function index(){
        return $this->OKResponse(Maker::select('ID as id', 'Maker_name as makerName')->get());
    }

    public function show($id){
        try{
            $maker =Maker::select('ID as id','Maker_name as makerName')
                ->where('ID', $id)->get()->first();
            if($maker == null){
                return $this->NotFoundResponse();
            }
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse($maker);
    }

    public function store(Request $request){
        if($request->has('makerName')){
            $makerName = $request->get('makerName');
            if(Maker::where('Maker_name',$makerName)->exists()){
                return $this->ForbiddenResponse('Maker is existed!');
            }
            $maker = new Maker();
            $maker->ID = Maker::max('ID') + 1;
            $maker->Maker_name = $makerName;
            $maker->save();
            return $this->CreatedResponse(
                Maker::select('ID as id', 'Maker_name as makerName')
                    ->where('ID',$maker->ID)->first());
        }
        return $this->BadResponse();
    }

    public function update(Request $request, $id){
        if($request->has('makerName')){
            try{
                $makerName = $request->get('makerName');
                $maker = Maker::where('ID',$id)->first();
                if($maker == null){
                    return $this->NotFoundResponse();
                }
                $maker->Maker_name = $makerName;
                $maker->save();
            }catch (Exception $ex){
                return $this->NotFoundResponse();
            }

            return $this->OKResponse(Maker::select('ID as id','Maker_name as makerName')
                ->where('ID',$maker->ID)->first()
            );
        }
        return $this->BadResponse();
    }

    public function remove($id){
        try{
            $maker = Maker::where('ID',$id)->first();

            if($maker == null){
                return $this->NotFoundResponse();
            }

            $maker->delete();
        }catch (Exception $ex){
            return $this->NotFoundResponse();
        }
        return $this->OKResponse(['message'=>'Removed']);
    }
}
