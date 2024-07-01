<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ApiTransactionHistoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        // Lấy user id từ JWT
        $userId = auth()->user()->id;

        $orders = null;
        //Kiểm tra id người dùng nếu đúng thì thực hiện lấy ra lịch sử giao dịch
        if ($userId) {
            $orders = Order::where('user_id', $userId)
                ->with(['orderItem.apiProduct', 'status', 'apiUser'])
                ->get();
        }

        return $this->success($orders,'Get transaction history successfully!',200);
    }
    public function cancelOrder($id)
    {
        try {
            DB::beginTransaction();

            // Lấy thông tin order item và đơn đặt hàng liên quan
            $orderItem = OrderItem::findOrFail($id);
            $order = Order::findOrFail($orderItem->order_id);

            // Tính lại tổng giá trị đơn đặt hàng sau khi xóa mặt hàng
            $order->price -= $orderItem->product->price * $orderItem->quantity;

            // Xóa order item
            $orderItem->delete();

            // lấy ra toàn bộ bản ghi
            $orderItems = OrderItem::where('order_id',$order->id)->count();

            if ($orderItems == 0) {
                $order->delete();
            } else {
                $order->save();
            }

            DB::commit();

            return $this->success(null, 'Order canceled successfully!', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // Debug lỗi
            dd($e->getMessage());
            return $this->error('Failed to delete order item!.', 500);
        }
    }
}
