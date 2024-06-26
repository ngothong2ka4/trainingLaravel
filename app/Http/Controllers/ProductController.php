<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();

        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $image_name = null;
            DB::beginTransaction();
            $product = new Product();
            $product->name = $request->name;

            if ($request->hasFile('image')) {
                $image_name = upload_file('product_images', $request->file('image'));
                $product->image = $image_name;
            }

            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->save();
            DB::commit();

            return redirect()->route('product.index');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            echo $throwable;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $productName = $product->name;
        $categories = Category::select('id','name')->get();

        return view('product.edit',compact('product','productName','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $image_name = null;
            DB::beginTransaction();
            $product = Product::find($id);

            $product->name = $request->name;

            if ($request->hasFile('image')) {
                $oldImageProduct = $product->image;
                delete_file($oldImageProduct);
                $image_name = upload_file('product_images', $request->file('image'));
                $product->image = $image_name;
            } else {
                $image_name = Product::where('id',$id)->value('image');
            }

            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->save();
            DB::commit();

            return redirect()->route('product.index');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            echo $throwable;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
