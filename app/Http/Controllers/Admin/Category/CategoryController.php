<?php

namespace App\Http\Controllers\Admin\Category;

use App\Enum\Category\CategoryTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();
        if($request->filled('category'))
        {
            $categories->where('parent_id', $request->category);
        }
        if(!$request->filled('category'))
        {
            $categories->where('parent_id', 0);
        }
        if ($request->filled('type'))
        {
            switch ($request->type)
            {
                case 'all':
                    break;
                case 'domestic':
                    $categories->where('type', CategoryTypeEnum::TR_CATEGORY);
                    break;
                case 'overseas':
                    $categories->where('type', CategoryTypeEnum::OTHER_CATEGORY);
                    break;
            }
        }
        if ($request->filled('parent'))
        {
            switch ($request->parent)
            {
                case 'all':
                    break;
                case 'main':
                    $categories->where('parent_id', 0);
                    break;
                case 'sub':
                    $categories->where('parent_id', '!=', 0);
                    break;
                default:
                    $categories->where('parent_id', $request->parent);
                    break;
            }
        }
        if ($request->filled('tag'))
        {
            if ($request->tag != 'all')
            {
                $categories->where('tag_id', $request->tag);
            }
        }
        $categories = $categories->orderBy('parent_id', 'asc')->get();
        $categoryTags = CategoryTag::all();
        return view('admin.category.index', compact('categories', 'categoryTags'));
    }

    public function create()
    {
        $categoryTags = CategoryTag::all();
        return view('admin.category.create', compact('categoryTags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:1,2',
            'tag_id' => 'required|in:1,2'
        ], [
            'name.required' => 'Kategori adı alanı zorunludur.',
            'name.unique' => 'Bu kategori adı daha önce kullanılmıştır.',
            'parent_id.exists' => 'Kategori bulunamadı.',
            'type.required' => 'Kategori tipi alanı zorunludur.',
            'type.in' => 'Kategori tipi alanı hatalıdır.'
        ]);
        if ($request->parent_id == null ) {
            $data['parent_id'] = 0;
        }
        if (!isset($data['type']))
            return redirect()->back()->withInput()->withErrors(['type' => 'Kategori tipi alanı zorunludur.']);
        $data['slug'] = Str::slug($data['name']);

        $create = Category::create($data);
        if ($create) {
            return redirect()->route('admin.category.index')->with('success', 'Kategori başarıyla eklendi.');
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Kategori eklenirken bir hata oluştu.']);
    }

    public function edit(Category $category)
    {
        $categoryTags = CategoryTag::all();
        $categories = Category::where('type', $category->type)->get();
        return view('admin.category.edit', compact('category', 'categories', 'categoryTags'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:1,2',
            'tag_id' => 'required|in:1,2',
            'name' => 'required|unique:categories,name,' . $category->id . ',id',
        ], [
            'name.required' => 'Kategori adı alanı zorunludur.',
            'name.unique' => 'Bu kategori adı daha önce kullanılmıştır.',
            'parent_id.exists' => 'Kategori bulunamadı.',
            'type.required' => 'Kategori tipi alanı zorunludur.',
            'type.in' => 'Kategori tipi alanı hatalıdır.'
        ]);
        if ($request->parent_id == null ) {
            $data['parent_id'] = 0;
        }
        if (!isset($data['type']))
            return redirect()->back()->withInput()->withErrors(['type' => 'Kategori tipi alanı zorunludur.']);
        $data['slug'] = Str::slug($data['name']);

        $update = $category->update($data);
        if ($update) {
            return redirect()->route('admin.category.index')->with('success', 'Kategori başarıyla güncellendi.');
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Kategori güncellenirken bir hata oluştu.']);
    }

    public function destroy(Request $request, Category $category)
    {
        if ($category->parent_id == 0)
        {
            $subCategories = Category::where('parent_id', $category->id)->get();
            if ($subCategories->count() > 0) {
                $subCategories->each(function ($item) {
                    $item->delete();
                });
            }
            if ($category->delete())
                return response()->json(['status' => true, 'message' => 'Kategori başarıyla silindi.']);
            return response()->json(['status' => false, 'message' => 'Kategori silinirken bir hata oluştu.']);
        }
        if ($category->delete())
            return response()->json(['status' => true, 'message' => 'Kategori başarıyla silindi.']);
        return response()->json(['status' => false, 'message' => 'Kategori silinirken bir hata oluştu.']);
    }


    public function getCategory(Request $request)
    {
        $type = $request->validate([
            'type' => 'required|in:1,2',
            'tag_id' => 'nullable|exists:category_tags,id'
        ]);
        $categories = Category::query();
        if (!is_null($type['tag_id']))
        {
            $categories->where('tag_id', $type['tag_id']);
        }
        $categories = $categories->where('type', $type['type'])->get();
        if ($categories->count() == 0) {
            return response()->json(['status' => false, 'message' => 'Alt kategori bulunamadı.']);
        }
        return response()->json($categories);
    }
}
