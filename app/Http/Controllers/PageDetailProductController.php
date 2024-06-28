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
            //Lấy ra chi tiết sản phẩm theo id
            $product = Product::with('category')->findOrFail($product_id);

            //Lấy ra sản phẩm liên quan với điều kiện cùng category
            $related_products = Product::where('category_id', $product->category_id)
                ->where('status', 1)->get();

            //Lấy danh sách sản phẩm liên quan mà bỏ qua sản phẩm hiện tại đang hiển thị
            $related_products = $related_products->except($product->id);

            return view('fe.products.show',compact('product','related_products'));
        } catch (\Exception $exception) {
            return redirect()->route('page404')->withErrors('Data not found!');
        }
    }
}
