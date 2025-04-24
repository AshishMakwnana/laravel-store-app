<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Http\Requests\CartRequest;
use App\Models\CartItem;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $items = auth()->user()->cartItems()->with('product')->get();
            return $this->successResponse($items);
        } catch (Exception $e) {
           return $this->errorResponse('Failed to fetch cart items', 500, $e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        try {
            $cartItem = CartItem::updateOrCreate(
                ['user_id' => auth()->id(), 'product_id' => $request->product_id],
                ['quantity' => DB::raw("quantity + {$request->quantity}")]
            );
            return $this->successResponse($cartItem, 'Item added to cart successfully');
        } catch (Exception $e) {
            $this->errorResponse('Failed to add item to cart', 500, $e->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try{
           $validator = Validator::make($request->all(),[
                'quantity' => 'required|integer|min:1'
            ]);
            if($validator->fails()){
                return $this->errorResponse('Validation error',422,$validator->errors());
            }
            $item = CartItem::where('id',$id)->where('user_id',auth()->id())->firstOrFail();
            $item->update($validator->validated());
            return $this->successResponse($item,'cart item updated succssfully',200);
        }catch(ModelNotFoundException $e){
            return $this->errorResponse('Cart Item Not Found',404,$e->getMessage());
        }catch(Exception $e){
            return $this->errorResponse('server error',500,$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        try{
            $cartItem->delete();
            return $this->successResponse('Item remove form the cart');
        }catch(Exception $e){
            return $this->errorResponse();
        }
    }
}
