<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApiCreateOrderController extends Controller
{
    use ApiResponse;
    public function store(ApiStoreOrderRequest $request)
    {
        $totalPrice = 0;

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $totalPrice += $product->price * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'status_id' => $request->status_id,
            'price' => $totalPrice
        ]);

        // Create order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quatity' => $item['quantity']
            ]);
        }

        return $this->success($order,'Create order successfully!',200);
    }
}
