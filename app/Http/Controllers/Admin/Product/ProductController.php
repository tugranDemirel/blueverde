<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\CategoryTag;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'productTag')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryTags = CategoryTag::all();
        $productTags = ProductTag::all();
        return view('admin.products.create', compact('categoryTags', 'productTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $create = Product::create($data);
        if ($create) {
            return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla eklendi.');
        }
        return back()->with('error', 'Ürün eklenirken bir hata oluştu.');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        $categoryTags = CategoryTag::all();
        $productTags = ProductTag::all();
        return view('admin.products.edit', compact('product', 'categories', 'categoryTags', 'productTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $update = $product->update($data);
        if ($update) {
            return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla güncellendi.');
        }
        return back()->with('error', 'Ürün güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete())
        {
            return response()->json(['success' => true, 'message' => 'Ürün başarıyla silindi.']);
        }
        else
            return response()->json(['success' => false, 'message' => 'Ürün silinirken bir hata oluştu.']);
    }
}
