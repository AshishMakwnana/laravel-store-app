<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function apiTest()
    {
        return response()->json([
            'message' => 'API test successful',
            'status' => 200,
        ]);
    }
}
