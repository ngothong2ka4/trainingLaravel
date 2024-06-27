<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

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
        // Return view for creating new category
        return view('categories.create');
    }

    public function store(CategoryRequest $categoryRequest)
    {
        try {
            $category = new Category();
            $category->name = $categoryRequest->name;
            $category->slug = $categoryRequest->slug;
            $category->created_by = auth()->user()->name; // Lấy tên người dùng đang đăng nhập
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));

    }



    public function edit($id)
    {
        // Tìm category theo $id, nếu không tồn tại sẽ trả về null
        $category = Category::find($id);
        // Kiểm tra nếu category không tồn tại
        if (!$category) {
            // Quay lại trang index với thông báo lỗi
            return Redirect::route('categories.index')->with('error', 'Category not found.');
        }

        // Nếu category tồn tại, trả về view categories.edit để chỉnh sửa category
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $categoryUpdateRequest, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->name = $categoryUpdateRequest->name;
            $category->slug = $categoryUpdateRequest->slug;
            $category->save();

            // Chuyển hướng về trang danh sách categories với thông báo thành công
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Nếu không tìm thấy category, quay lại trang index với thông báo lỗi
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
    }


    public function destroy(Category $category)
    {
        // Thực hiện soft delete bằng cách gọi phương thức delete()
        $category->delete();
        // Chuyển hướng về trang danh sách categories với thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

}
