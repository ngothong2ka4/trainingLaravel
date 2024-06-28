<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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

    public function cancelOrder(Request $request, $orderId)
    {
        // Lấy user id từ JWT
        $userId = auth()->user()->id;

        // Tìm đơn hàng theo id và user_id
        $order = Order::where('id', $orderId)->where('user_id', $userId)->first();

        if (!$order) {
            return $this->error('Order not found or you do not have permission to cancel this order.', 404);
        }

        // Kiểm tra status_id của đơn hàng
        if ($order->status_id == 1) {
            // Hủy đơn hàng bằng cách cập nhật status_id hoặc xóa đơn hàng
            $order->status_id = 3; // 3 là trạng thái hủy đơn hàng
            $order->save();

            return $this->success(null, 'Order canceled successfully!', 200);
        } else {
            return $this->error('Order cannot be canceled as it is not in a cancellable status.', 400);
        }
    }
}
