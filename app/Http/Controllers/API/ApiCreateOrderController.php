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
        //Lấy ra user_id từ request
        $user_id = $request->input('user_id', null);

        //Kiểm tra người dùng đã có bản ghi order hay chưa
        $order = Order::firstOrCreate(
            ['user_id' => $user_id],
            ['price' => 0]
        );

        // Khởi tạo biến lưu trữ mảng chứa các order_item mới,thời gian hiện tại,tổng giá trị đơn hàng
        $new_order_items = [];
        $currentTimestamp = now();
        $totalPrice = $order->price;

        //items là 1 mảng chứa product_id và quantity
        $items = $request->input('items',[]);

        //Sử dụng array_column lấy ra mảng chứa product_id
        $product_ids = array_column($items, 'product_id');

        //Lấy ra bản ghi product tương ứng với product_id lấy bên trên
        $products = Product::whereIn('id', $product_ids)->get();
        $order_items = OrderItem::where('order_id', $order->id)->whereIn('product_id',$product_ids)->get();

        foreach ($items as $key => $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];

            //Lấy ra product và quantity để tính total price
            $product = $products->where('id', $product_id)->first();
            if ($product) {
                $totalPrice += $product->price * $quantity;
            }

            //Kiểm tra product đã có trong bảng order item hay chưa
            $order_item = $order_items->where('product_id', $product_id)->first();

            if ($order_item) {
                //Nếu có rồi thì thực hiện tăng số lượng lên
                $order_item->quantity += $quantity;
                $order_item->save();
            } else {
                //Lưu trữ dữ liệu tạo mới order items
                $new_order_items[] = [
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ];
            }
        }

        //Tạo mới order_items
        if (!empty($new_order_items)) {
            OrderItem::insert($new_order_items);
        }

        //Lưu total price trong orders
        $order->price = $totalPrice;
        $order->save();

        return $this->success($order,'Create order successfully!',200);
    }
}
