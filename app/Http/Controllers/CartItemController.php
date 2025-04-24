<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Http\Requests\CartRequest;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\Request;

class CartItemController extends Controller
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
    public function store(CartRequest $request)
    {
        try{
            $cartItem = CartItem::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
            return $this->successResponse($cartItem,'Item added to cart successfully');
        }catch(Exception $e){
            $this->errorResponse('Failed to add item to cart',500,$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
