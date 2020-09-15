<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function index()
    {
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
            return redirect($products->url($products->lastPage()) . "&per_page=$per_page&search=$search&filter=$filter");
        }

        return $this->successResponse(['products' => $products], 200);
    }

    public function countInfo()
    {
        $products = Product::all();
        $count_active = $products->where('status', true)->count();
        $count_inactive = $products->where('status', false)->count();

        $count_info = [
            'total' => $count_active + $count_inactive,
            'active' => $count_active,
            'inactive' => $count_inactive,
        ];

        return $this->successResponse(['count_info' => $count_info], 200);
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

        $product = Product::create($requested_data);

        return $this->successResponse(['product' => $product], 200);
    }

    public function show(Product $product)
    {
        return $this->successResponse(['product' => $product], 200);
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

        $product->update($requested_data);;

        return $this->successResponse(['product' => $product], 200);
    }

    public function destroy(Request $request)
    {
        $products = Product::whereIn('id', $request->ids);

        foreach ($products->get() as $product) {
            HelperController::imageDelete($product->image);
        }

        $products->delete();

        return $this->successResponse(['product' => ['ids' => $request->ids]], 200);
    }

    public function changeStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);
        return $this->successResponse(['product' => $product], 200);
    }
}
