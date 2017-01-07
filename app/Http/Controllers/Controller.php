<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function BadResponse($message = null){
        if($message == null){
            $message = 'Parameter is wrong';
        }
        return response()->json(['message' => $message], 400);
    }

    public function ForbiddenResponse($message = null){
        if($message == null){
            $message = 'Something went wrong!';
        }
        return response()->json(['message' => $message], 403);
    }

    public function CreatedResponse($data = null){
        return response()->json($data, 201);
    }

    public function OKResponse($data = null,$header = [])
    {
        return response()->json($data, 200,$header);
    }

    public function NotFoundResponse($message = null){
        if($message == null){
            $message = 'Not found!';
        }
        return response()->json(['message' => $message], 404);
    }

    public function UnAuthentication($message = null){
        if($message == null){
            $message = 'UnAuthentication!';
        }
        return response()->json(['message' => $message], 401);
    }
}
