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
            $product = Product::with('category')->findOrFail($product_id);

            $related_products = Product::where('category_id', $product->category_id)
                ->where('status', 1)->get();

            return view('fe.products.show',compact('product','related_products'));
        } catch (\Exception $exception) {
            return redirect()->route('page404')->withErrors('Data not found!');
        }
    }
}
