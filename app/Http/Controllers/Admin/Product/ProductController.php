<?php

namespace App\Http\Controllers\Admin\Product;

use App\Helpers\ImageHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Imports\Product\AddProductExcel;
use App\Models\Category;
use App\Models\CategoryTag;
use App\Models\MediaProducts;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\SystemCurrency;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private string $_path = 'product/';
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
        $currencies = SystemCurrency::all();
        return view('admin.products.create', compact('categoryTags', 'productTags', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        if (!is_null('image') && $request->hasFile('image'))
        {
            $data['image'] = ImageHelpers::upload($data['image'], $this->_path);
        }
        if (isset($data['images']))
        {
            $images = [];
            foreach ($data['images'] as $image)
            {
                $images[] = ImageHelpers::upload($image, $this->_path);
            }
            unset($data['images']);
        }
        else
            unset($data['images']);

        $create = Product::create($data);
        if ($create) {
            if (isset($images))
            {
                foreach ($images as $image)
                {
                    MediaProducts::create([
                        'product_id' => $create->id,
                        'path' => $image
                    ]);
                }
            }
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
        $currencies = SystemCurrency::all();
        $product = $product->load('productTag', 'category', 'medias');
        return view('admin.products.edit', compact('product', 'categories','currencies', 'categoryTags', 'productTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if (isset($data['image']))
        {
            $data['image'] = ImageHelpers::upload($data['image'], $this->_path, $product->image);
        }
        else
            unset($data['image']);

        if (isset($data['images']))
        {
            $images = [];
            foreach ($data['images'] as $image)
            {
                $images[] = ImageHelpers::upload($image, $this->_path);
            }
            unset($data['images']);
        }
        else
            unset($data['images']);
        $update = $product->update($data);
        if ($update) {
            if (isset($images))
            {
                foreach ($images as $image)
                {
                    MediaProducts::create([
                        'product_id' => $product->id,
                        'path' => $image
                    ]);
                }
            }
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
            ImageHelpers::delete($product->image);
            $medias = MediaProducts::where('product_id', $product->id)->get();
            foreach ($medias as $media)
            {
                ImageHelpers::delete($media->path);
            }
            MediaProducts::where('product_id', $product->id)->delete();
            return response()->json(['success' => true, 'message' => 'Ürün başarıyla silindi.']);
        }
        else
            return response()->json(['success' => false, 'message' => 'Ürün silinirken bir hata oluştu.']);
    }


    public function deleteSingleImage(Request $request)
    {
        $id = $request->validate([
            'id' => 'required|integer|exists:media_products,id'
        ]);

        $image = MediaProducts::find($id['id']);
        if ($image->delete())
        {
            ImageHelpers::delete($image->path);
            return response()->json(['success' => true, 'message' => 'Resim başarıyla silindi.'], 200);
        }
        else
            return response()->json(['success' => false, 'message' => 'Resim silinirken bir hata oluştu.'], 401);
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new AddProductExcel, $file);
        return redirect()->back();
    }
}
