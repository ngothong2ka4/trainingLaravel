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
    public function index(Request $request)
    {
        $name = $request->input('name', null);
        $category_id = $request->input('category_id', null);
        $price = $request->input('price',null);
        $sold = $request->input('sold',null);

        $products = Product::query();

        if ($name){
            $products->where('name', 'like', '%' . $name . '%');
        }

        if ($category_id) {
            $products->where('category_id', $category_id);
        }

        if ($price) {
            $products->orderBy('price', $price);
        }

        if ($sold) {
            $products->orderBy('sold', $sold);
        }

        $products = $products->latest('updated_at')
            ->paginate(10);
        $categories = Category::select('id', 'name')->get();

        return view('product.index', compact(
            'category_id',
            'categories',
            'products',
            'price',
            'name',
            'sold'
        ));
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
            $id_product = $request->input('id',null);
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $image_name = upload_file('product_images', $request->file('image'));
            } elseif ($id_product != null) {
                $image_name = Product::where('id',$id_product)->value('image');
            }

            Product::updateOrCreate(
                ['id' => $id_product],
                [
                    'name' => $request->input('name', null),
                    'image' => $image_name,
                    'category_id' => $request->input('category_id', null),
                    'price' => $request->input('price', null),
                    'description' => $request->input('description', null),
                    'status' => $request->input('status', null),
                ]
            );

            DB::commit();

            return $id_product != null ?
                redirect()->route('product.index')->with('msg','Update product successfully!') :
                redirect()->route('product.index')->with('mgs','Create product successfully!');

        } catch (\Throwable $throwable) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error saving product!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with('category')->findOrFail($id);

            return view('product.show',compact('product'));
        } catch (\Exception $exception) {
            return redirect()->route('dashboard')->withErrors('Data not found!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $categories = Category::select('id','name')->get();

            return view('product.edit',compact('product','categories'));
        } catch (\Exception $exception) {
            return redirect()->route('dashboard')->withErrors('Data not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('product.index')->with('msg','Delete product successfully!');
        } catch (\Exception $exception) {
            return redirect()->route('dashboard')->withErrors('Data not found!');
        }

    }
}
