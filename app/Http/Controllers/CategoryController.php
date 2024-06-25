<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
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

        $category = new Category();
        $category->name = $categoryRequest->name;
        $category->slug = $categoryRequest->slug;
        $category->created_by = auth()->user()->name; // Lấy tên người dùng đang đăng nhập

        $category->save();

        // Redirect back to index page with success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');;
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $categoryUpdateRequest, $id)
    {
        // Tìm category theo id hoặc trả về lỗi nếu không tìm thấy
        $category = Category::findOrFail($id);
        // Cập nhật các trường của category từ request
        $category->name = $categoryUpdateRequest->name;
        $category->slug = $categoryUpdateRequest->slug;

        // Lưu lại category đã cập nhật
        $category->save();

        // Chuyển hướng về trang danh sách categories với thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        // Thực hiện soft delete bằng cách gọi phương thức delete()
        $category->delete();

        // Chuyển hướng về trang danh sách categories với thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

}
