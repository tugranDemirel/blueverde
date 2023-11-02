<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productTags = ProductTag::all();
        return view('admin.products.tag.index', compact('productTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:product_tags,name',
        ]);
        $create = ProductTag::create($data);
        if ($create) {
            return redirect()->route('admin.product.tag.index')->with('success', 'Etiket başarıyla eklendi.');
        } else {
            return redirect()->route('admin.product.tag.index')->with('error', 'Etiket eklenirken bir hata oluştu.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTag $productTag)
    {
        return view('admin.products.tag.edit', compact('productTag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTag $productTag)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:product_tags,name,' . $productTag->id,
        ]);
        $update = $productTag->update($data);
        if ($update) {
            return redirect()->route('admin.product.tag.index')->with('success', 'Etiket başarıyla güncellendi.');
        } else {
            return redirect()->route('admin.product.tag.index')->with('error', 'Etiket güncellenirken bir hata oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTag $productTag)
    {
        $products = $productTag->products()->get();
        $delete = $productTag->delete();
        if ($delete) {
            $products->each(function ($item){
               $item->delete();
            });
            return response()->json([
                'status' => true,
                'message' => 'Etiket başarıyla silindi.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Etiket silinirken bir hata oluştu.'
            ]);
        }
    }
}
