<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;

class ProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            return $this->successResponse($products, 'All Products', 200);
        } catch (Exception $e) {
            return $this->errorResponse('server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->all());
            return $this->successResponse($product, 'product create successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse('Server Error', 500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->successResponse($product, 'Prdouct Found', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Product not Found', 404);
        } catch (Exception $e) {
            return $this->errorResponse('Server Error', 500);
        }
    }

    /* Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            // first check the product id is valid or not
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return $this->successResponse($product, 'Product updated Successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Invalid Product Id', 404);
        } catch (Exception $e) {
            return $this->errorResponse('server error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->successResponse([], 'product Delete successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Invalid Product Id', 404);
        } catch (Exception $e) {
            return $this->errorResponse('server error', 500);
        }
    }
}
