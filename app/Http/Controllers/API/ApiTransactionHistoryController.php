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
}
