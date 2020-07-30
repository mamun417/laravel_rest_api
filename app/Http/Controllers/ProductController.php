<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?? 1;
        $keyword = request()->q;

        $products = new Product();

        if ($keyword) {
            $products = $products->where('name', 'like', '%' . $keyword . '%');
        }

        $products = $products->latest()->get();

        return HelperController::apiResponse(200, '', 'products', $products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'sometimes|max:955',
            'price' => 'required|numeric'
        ]);

        $requested_data = $request->only(['name', 'description', 'price']);

        //upload image
        if (isset($request->image)) {
            $image = HelperController::imageUpload('image');
            $requested_data['image'] = $image;
        }

        try {
            $product = Product::create($requested_data);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        return HelperController::apiResponse(200, '', 'product', $product);
    }

    public function show(Product $product)
    {
        return HelperController::apiResponse(200, '', 'product', $product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255|unique:products,name,' . $product->id,
            'description' => 'sometimes|max:955',
            'price' => 'required|numeric'
        ]);

        $requested_data = $request->only(['name', 'description', 'price']);

        if (isset($request->image)) {

            $image = HelperController::imageUpload('image');
            $requested_data['image'] = $image;

            if (isset($product->image)) {
                HelperController::imageDelete($product->image);
            }
        }

        try {
            $product->update($requested_data);;
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        return HelperController::apiResponse(200, null, 'product', $product);
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            HelperController::imageDelete($product->image);
        } catch (Exception $e) {
            return HelperController::apiResponse(500, $e->getMessage());
        }

        return HelperController::apiResponse(200, null, 'product', ['id' => $product->id]);
    }

    public function changeStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);
        return HelperController::apiResponse(200, '', 'product', $product);
    }
}
