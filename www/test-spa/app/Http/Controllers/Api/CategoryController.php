<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return response()->json(
            [
                'categories' => Category::paginate(5),
                'status' => 'success'
            ], 200);
    }
    public function allCategories()
    {
        return response()->json(
            [
                'categories' => Category::get(),
                'status' => 'success'
            ], 200);
    }
    public function store(Category $category, CategoryRequest $request)
    {
        if (count($request->validator->errors())){
            return $this->respError($request, 422);
        }
        $category->fill($request->all());
        $category->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        if (count($request->validator->errors())){
            return $this->respError($request, 422);
        }
        $category->fill($request->all());
        $category->update();

        return response()->json(['status' => 'success'], 201);
    }

    public function delete(Category $category)
    {
        $this->deleteCategoryProducts($category->id);
        $category->delete();
        return response()->json(['status' => 'delete'], 204);
    }

    public function deleteCategoryProducts($category_id)
    {
        Product::where('category_id', $category_id)->delete();
    }
}
