<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApiHomeController extends Controller
{
    use ApiResponse;
    
    public function index(Request $request)
    {
        $productQuery = Product::with('category');
        

        if ($request->has('price')) {
            $order = $request->input('price') === 'asc' ? 'asc' : 'desc';
            $productQuery->orderBy('price', $order);
        }

        if ($request->has('sold')) {
            $order = $request->input('sold') === 'asc' ? 'asc' : 'desc';
            $productQuery->orderBy('sold', $order);
        }

        if ($request->has('created_at')) {
            $order = $request->input('created_at') === 'asc' ? 'asc' : 'desc';
            $productQuery->orderBy('created_at', $order);
        }

        $products = $productQuery->paginate(12);
        
        $categories = Category::all();

        if ($products && $categories) {
            return $this->success(['products' => $products, 'categories' => $categories], 'Get data product successfully!', 200);
        }

        return $this->error('Data not found', 404);
        }
}
