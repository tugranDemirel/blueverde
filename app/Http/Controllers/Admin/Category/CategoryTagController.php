<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryTagController extends Controller
{
    public function index()
    {
        $categoryTags = CategoryTag::all();
        return view('admin.category.tag.index', compact('categoryTags'));
    }

    public function create()
    {
        return view('admin.category.tag.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|max:50'], ['name.required' => 'Etiket adı boş bırakılamaz.', 'name.max' => 'Etiket adı en fazla 50 karakter olabilir.']);
        $data['slug'] = Str::slug($data['name']);
        $create = CategoryTag::create($data);
        if ($create) {
            return redirect()->route('admin.category.tag.index')->with('success', 'Etiket başarıyla eklendi.');
        } else {
            return redirect()->route('admin.category.tag.index')->with('error', 'Etiket eklenirken bir hata oluştu.');
        }
    }

    public function edit(CategoryTag $categoryTag)
    {
        return view('admin.category.tag.edit', compact('categoryTag'));
    }

    public function update(Request $request, CategoryTag $categoryTag)
    {
        $data = $request->validate([
            'name' => 'required|unique:category_tags,name,' . $categoryTag->id . ',id',
        ], [
            'name.required' => 'Etiket adı boş bırakılamaz.',
            'name.unique' => 'Bu etiket adı zaten mevcut.',

        ]);

        $data['slug'] = Str::slug($data['name']);

        $update = $categoryTag->update($data);
        if ($update)
            return redirect()->route('admin.category.tag.index')->with('success', 'Etiket başarıyla eklendi.');

        return redirect()->route('admin.category.tag.index')->with('error', 'Etiket eklenirken bir hata oluştu.');
    }

    public function destroy(CategoryTag $categoryTag)
    {
        $categories = Category::where('tag_id', $categoryTag->id)->get();
        if ($categories->count() > 0)
        {
            $categories->each(function ($item){
                $item->delete();
            });
        }
        $delete = $categoryTag->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Kategori Etiketi ve Kategori Etiketine ait kategoriler başarıyla silindi.']);
        return response()->json(['status' => false, 'message' => 'Kategori Etiketi silinirken bir hata oluştu.']);

    }

}
