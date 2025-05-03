<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /** this is only access admin */
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
    public function destroy(Product $product)
    {
        try {
            if(!$product){
                throw new ModelNotFoundException('Invalid Product');
            }
            $product->delete();
            return $this->successResponse([], 'product Delete successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Invalid Product Id', 404);
        } catch (Exception $e) {
            return $this->errorResponse('server error', 500);
        }
    }
}
