<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    public function apiTest(HttpRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }
        return response()->json([
            'message' => "hello $request->name",
            'status' => 200,
        ]);
    }
}
