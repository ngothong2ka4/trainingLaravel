<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $orderDetails = $this->orderService->getOrderDetails($request);

        return view('order.index', compact('orderDetails'));
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);

        return view('order.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = $this->orderService->cancelOrder($id);

        return redirect()->route('order.index');
    }

    public function done($id)
    {
        $order = $this->orderService->markOrderAsDone($id);

        return redirect()->route('order.index');
    }
}
