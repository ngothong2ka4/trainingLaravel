<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::orderBy('updated_at', 'desc')
            ->paginate(10);

        if ($categories) {
            return $this->success($categories, 'Get data product successfully!', 200);
        }

        return $this->error('Data not found', 404);
    }
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $this->success($category, 'Category data retrieved successfully!', 200);
        } catch (\Exception $e) {

            return $this->error('Category not found', 404);
        }
    }

}
