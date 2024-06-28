<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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


        // Gọi API từ một URL bên ngoài
        // $response = Http::get('http://127.0.0.1:8000/');

        // // Kiểm tra xem request có thành công hay không
        // if ($response->successful()) {
        //     // Lấy dữ liệu từ phản hồi JSON
        //     $data = $response->json();
        //     dd($data);

        //     // Xử lý dữ liệu ở đây, ví dụ:
        //     return view('index', ['data' => $data]);
        // } else {
        //     // Xử lý khi gọi API không thành công
        //     return redirect()->back()->withErrors('Failed to fetch data from API.');
        // }
    }
}
