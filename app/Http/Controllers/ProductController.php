<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?: 1;
        $keyword = request()->q;

        $products = new Product();

        if ($keyword){
            $products = $products->where('name', 'like', '%'.$keyword.'%');
        }

        $products = $products->latest()->paginate($perPage);

        return HelperController::formattedResponse(true, 200, null, $products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'sometimes|max:955',
            'price' => 'required'
        ]);

        // upload image
        if (isset($request->img)) {
            try {
                $image = HelperController::imageUpload('img');
                $request['image'] = $image;
            } catch (Exception $e) {
                return HelperController::formattedResponse(false, 500, $e->getMessage());
            }
        }

        try {
            $product = Product::create($request->all());
        } catch (Exception $e) {
            return HelperController::formattedResponse(false, 500, $e->getMessage());
        }

        return HelperController::formattedResponse(true, 200, null, $product);
    }

    public function show(Product $product)
    {
        return HelperController::formattedResponse(true, 200, null, $product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255|unique:products,name,'.$product->id,
            'description' => 'sometimes|max:955',
            'price' => 'required'
        ]);

        if (isset($request->img)) {

            //upload image
            try {
                $image = HelperController::imageUpload('img');
                $request['image'] = $image;
            } catch (Exception $e) {
                return HelperController::formattedResponse(false, 500, $e->getMessage());
            }

            //check old image exits and delete
            if (isset($product->image)){
                try {
                    HelperController::imageDelete($product->image);
                } catch (Exception $e) {
                    return HelperController::formattedResponse(false, 500, $e->getMessage());
                }
            }
        }

        try {
            $product->update($request->all());;
        } catch (Exception $e) {
            return HelperController::formattedResponse(false, 500, $e->getMessage());
        }

        return HelperController::formattedResponse(true, 200, null, $product);
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Exception $e) {
            return HelperController::formattedResponse(false, 500, $e->getMessage());
        }

        return HelperController::formattedResponse(
            true, 200, null, ['id' => $product->id]
        );
    }
}
