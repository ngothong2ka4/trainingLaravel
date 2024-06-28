<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
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

        $products = $productQuery->where('status', 1)->paginate(12);
        
        $categories = Category::all();
        return view('index',compact('products','categories'));
    }
}
