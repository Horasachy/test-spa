<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        return response()->json(
            [
                'products' => Product::with('category')->paginate(50),
                'status' => 'success'
            ], 200);
    }

    public function getProduct($id)
    {
        return response()->json(
            [
                'products' => Product::find($id),
                'status' => 'success'
            ], 200);
    }

    public function store(Product $product, ProductRequest $request)
    {
        if (count($request->validator->errors())){
            return $this->respError($request, 422);
        }
        $product->fill($request->all());
        $product->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function update(Product $product, ProductRequest $request)
    {
        if (count($request->validator->errors())){
            return $this->respError($request, 422);
        }
        $product->fill($request->all());
        $product->update();

        return response()->json(['status' => 'success'], 201);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json(['status' => 'delete'], 204);
    }
}
