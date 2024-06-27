<?php

namespace App\Http\Controllers\API\UserAPI;

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
        dd($request->all());
    // Lọc và sắp xếp theo các tiêu chí khác nhau
    $sortableFields = ['price', 'sold', 'created_at'];
    
    foreach ($sortableFields as $field) {
        if ($request->has($field)) {
            $order = $request->input($field) === 'asc' ? 'asc' : 'desc';
            $productQuery->orderBy($field, $order);
        }
    }

    $products = $productQuery->paginate(12);
    $categories = Category::all();

    if ($products && $categories) {
        return $this->success(['products' => $products, 'categories' => $categories], 'Get data product successfully!', 200);
    }

    return $this->error('Data not found', 404);
    }
}
