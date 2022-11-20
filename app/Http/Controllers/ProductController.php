<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return response()->json($products);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);

        $imageName = 'product_' .time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/product'), $imageName);

        $product = Product::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $imageName,
        ]);

        return response()->json($product);
    }

    public function show(Product $product)
    {
    }

    public function edit(Product $product)
    {
    }

    public function update(Request $request, Product $product)
    {
        // return $request->all();
        $product = $product->update($request->all());
        return response($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(true);
    }
}
