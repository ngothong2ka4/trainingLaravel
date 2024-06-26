<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
class ApiProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::with('category')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        if ($products) {
            return $this->success($products, 'Get data product successfully!', 200);
        }

        return $this->error('Data not found', 404);
    }

    public function show(string $id)
    {
        try {
            $product = Product::with('category')->findOrFail($id);

            if ($product) {
                return $this->success($product, 'Get detail product successfully!', 200);
            }
        } catch (\Exception $e) {
            return $this->error('Data not found', 404);
        }

    }
}
