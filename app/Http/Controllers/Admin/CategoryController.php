<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:1,2'
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

    public function getCategory(Request $request)
    {
        $type = $request->validate([
            'type' => 'required|in:1,2'
        ]);
        $categories = Category::where('type', $type)->get();
        if ($categories->count() == 0) {
            return response()->json(['status' => false, 'message' => 'Alt kategori bulunamadı.']);
        }
        return response()->json($categories);
    }
}
