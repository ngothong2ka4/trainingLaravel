<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getOrderDetails($request)
    {
        $query = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->join('status', 'orders.status_id', '=', 'status.id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('orders.id', 'users.name as user_name', 'status.id as status_id', 'status.name as status_name', 'order_items.product_id',
                'order_items.quantity', 'products.image', 'products.name as product_name', 'orders.created_at',
                'orders.updated_at');

//        $request->input('product_name');

        if ($request->has('product_name') && $request->product_name != '') {
            $query->where('products.name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status.id', $request->status);
        }

        if ($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') {
            $query->whereBetween('orders.created_at', [$request->from_date, $request->to_date]);
        }
        $orderDetails = $query->get();

        return $orderDetails;
    }

    public function getOrderById($id)
    {
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->join('status', 'orders.status_id', '=', 'status.id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.id', $id)
            ->select('orders.id', 'orders.user_id', 'orders.status_id', 'orders.created_at', 'orders.updated_at',
                'users.name as user_name', 'status.name as status_name', 'order_items.product_id',
                'order_items.quantity', 'products.image', 'products.name as product_name', 'products.price',
                'products.sold', 'products.description', 'products.category_id',
                'categories.name as category_name',
                DB::raw('SUM(order_items.quantity * products.price) as total_amount'))
            ->groupBy('orders.id', 'orders.user_id', 'orders.status_id', 'orders.created_at', 'orders.updated_at',
                'users.name', 'status.name', 'order_items.product_id',
                'order_items.quantity', 'products.image', 'products.name', 'products.price',
                'products.sold', 'products.description', 'products.category_id',
                'categories.name')
            ->firstOrFail();

        return $order;
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status_id = 4; // Assuming 'Admin Cancel' status id
        $order->save();

        return $order;
    }

    public function markOrderAsDone($id)
    {
        $order = Order::findOrFail($id);
        $order->status_id = 2; // Assuming 'Done' status id
        $order->save();

        return $order;
    }
}
