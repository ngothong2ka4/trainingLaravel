<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageDetailProductController extends Controller
{
    public function show(Request $request)
    {
        $product_id = $request->id;

        try {
            // Lấy ra chi tiết sản phẩm theo id
            $product = Product::with('category')->findOrFail($product_id);

            // Lấy ra sản phẩm liên quan với điều kiện cùng category và bỏ qua sản phẩm hiện tại
            $related_products = Product::where('category_id', $product->category_id)
                ->where('status', 1)
                ->where('id', '!=', $product->id)
                ->latest('updated_at')
                ->paginate(8);

            return view('fe.products.show', compact('product', 'related_products'));
        } catch (\Exception $exception) {
            return redirect()->route('page404')->withErrors('Data not found!');
        }
    }
}
