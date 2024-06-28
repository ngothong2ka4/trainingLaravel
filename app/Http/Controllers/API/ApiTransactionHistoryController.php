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

        // Truy vấn dữ liệu từ bảng orders với status là done
        $orders = Order::where('user_id', $userId)
            ->where('status_id', 2) // Status id 2 là done
            ->with('orderItem.product') // Lấy thông tin sản phẩm từ order_items
            ->get();

        return $this->success($orders,'Get transaction history successfully!',200);
    }
}
