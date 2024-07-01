<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('categories.index', compact('categories'));
    }


    public function create()
    {

        return view('categories.create');
    }

    public function store(CategoryRequest $categoryRequest)
    {
        try {
            $category = new Category();
            $category->name = $categoryRequest->name;
            $category->slug = $categoryRequest->slug;
            $category->created_by = auth()->user()->name;
            $category->save();

            return redirect()->route('categories.index')->with('msg', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'Error saving category!');
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));

    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {

            return redirect()->route('categories.index');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $categoryUpdateRequest, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->name = $categoryUpdateRequest->name;
            $category->slug = $categoryUpdateRequest->slug;
            $category->save();

            return redirect()->route('categories.index')->with('msg', 'Category updated successfully.');

        } catch (ModelNotFoundException $e) {

            return redirect()->route('categories.index');
        }
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('categories.index')->with('msg', 'Category deleted successfully.');
        } catch (\Exception $exception) {
            return redirect()->route('dashboard')->withErrors('Data not found!');
        }
    }

}
