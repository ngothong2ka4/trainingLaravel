<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $orderCount = [
            'title' => 'Total number of orders',
            'count' => Order::whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->count(),
            'name' => 'Orders',
            'bg-color' => 'bg-primary',
        ];
        
        $totalRevenue = [
            'title' => 'Total revenue of completed orders',
            'count' =>  number_format(Order::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $currentMonth)
                        ->whereHas('status', function ($query) {
                            $query->where('name', 'done');
                        })
                        ->sum('price')
                        , 0, '.', ','),
            'name' => 'VNĐ',
            'bg-color' => 'bg-warning',
        ];
        
        $totalUsers = [
            'title' => 'Total number of users',
            'count' => User::count(),
            'name'  => 'Users',
            'bg-color' => 'bg-danger',
        ];
        
        $totalProducts = [
            'title' => 'Total number of products',
            'count' => Product::where('status', 'active')->count(),
            'name'  => 'Products',
            'bg-color' => 'bg-info',
        ];

        $totalCategories = [
            'title' => 'Total number of categories',
            'count' => Category::count(),
            'name'  => 'Categories' ,
            'bg-color' => 'bg-success',
        ];
        
        $data = [
            $orderCount,
            $totalRevenue,
            $totalUsers,
            $totalProducts,
            $totalCategories,
        ];

        return view('home', compact('data') );
    }
}
