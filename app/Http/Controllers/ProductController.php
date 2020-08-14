<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        info('ok');

        $per_page = request()->per_page ?? 2;
        $search = request()->search;
        $filter = request()->filter;

        $products = new Product();

        if ($search) {
            $search = '%' . $search . '%';
            $products = $products->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        }

        if ($filter) {
            $products = $products->where('status', $filter === 'active');
        }

        $products = $products->latest()->paginate($per_page);

        if (request()->page > $products->lastPage()) {
            return redirect($products->url($products->lastPage())."&search=$search&filter=$filter");
        }

        return HelperController::apiResponse(200, '', 'products', $products);
    }

    public function countInfo()
    {
        $products = Product::all();
        $count_active = $products->where('status',true)->count();
        $count_inactive = $products->where('status',false)->count();

        $count_info = [
            'total' => $count_active+$count_inactive,
            'active' => $count_active,
            'inactive' => $count_inactive,
        ];

        return HelperController::apiResponse(200, '', 'count_info', $count_info);
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
