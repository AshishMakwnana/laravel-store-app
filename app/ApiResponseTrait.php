<?php

namespace App;

trait ApiResponseTrait
{
    public function successResponse($data = [],$message = "success" ,$code=200){
        return response()->json([
            'status'=>true,
            'message'=>$message,
            'data' => $data
        ],$code);
    }

    public function errorResponse($message = "somthing went wrong",$code=500, $errors =[]){
        return response()->json([
            'status'=>false,
            'message'=> $message,
            'errors'=> $errors
        ],$code);
    }
}
