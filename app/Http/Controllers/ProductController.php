<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try{
           $product = Product::create($request->all());
            return $this->successResponse($product,'product create successfully',201);
        }catch(Exception $e){
            return $this->errorResponse('Server Error',500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
