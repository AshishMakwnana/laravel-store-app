<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $orders = auth()->user()->orders()->with('items.product')->get();
            return $this->successResponse($orders,'order fetched',200);
        }catch(Exception $e){
            return $this->errorResponse('server error',500,$e->getMessage());
        }
    }
    /**
     * Store a newly created place order store resource in storage.
     */
    public function store()
    {
        try{
            $user = auth()->user();
            $cartItems = $user->cartItems()->with('product')->get();
            Log::info(['cartItems'=>$cartItems->toArray()]);

            if($cartItems->isEmpty()){
                $this->errorResponse('Cart is empty',400);
            }

            $totalPrice = 0;
            foreach($cartItems as $item){
                $totalPrice += $item->product->price * $item->quantity;
            }

            Log::info(['totalPrice'=>$totalPrice]);

            $order = $user->orders()->create([
                'total_price'=>$totalPrice,
            ]);

            foreach($cartItems as $item){
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // clear the cart
            $user->cartItems()->delete();
            return $this->successResponse('Order Placed successfuly',200);

        }catch(Exception $e){
            return $this->errorResponse('server error',500,$e->getMessage());
        }
    }
}
