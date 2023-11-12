<?php

namespace App\Http\Controllers\Admin\Currency;

use App\Http\Controllers\Controller;
use App\Models\SystemCurrency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = SystemCurrency::all();
        return view('admin.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.currency.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:system_currencies,name',
            'code' => 'required|string|max:255|unique:system_currencies,code',
            'symbol' => 'required|string|max:255|unique:system_currencies,symbol',
        ], [
            'name.required' => 'Para birimi adı alanı zorunludur.',
            'name.unique' => 'Para birimi adı alanı daha önce kayıt edilmiş.',
            'code.required' => 'Para birimi kodu alanı zorunludur.',
            'code.unique' => 'Para birimi kodu alanı daha önce kayıt edilmiş.',
            'symbol.required' => 'Para birimi simgesi alanı zorunludur.',
            'symbol.unique' => 'Para birimi simgesi alanı daha önce kayıt edilmiş.',
        ]);

        $create = SystemCurrency::create($data);
        if ($create)
            return redirect()->route('admin.currency.index')->with('success', 'Para birimi başarıyla eklendi.');
        else
            return redirect()->back()->with('error', 'Para birimi eklenirken bir hata oluştu.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemCurrency $currency)
    {
        return view('admin.currency.create-edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemCurrency $currency)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:system_currencies,name,' . $currency->id,
            'code' => 'required|string|max:255|unique:system_currencies,code,' . $currency->id,
            'symbol' => 'required|string|max:255|unique:system_currencies,symbol,' . $currency->id,
        ], [
            'name.required' => 'Para birimi adı alanı zorunludur.',
            'name.unique' => 'Para birimi adı alanı daha önce kayıt edilmiş.',
            'code.required' => 'Para birimi kodu alanı zorunludur.',
            'code.unique' => 'Para birimi kodu alanı daha önce kayıt edilmiş.',
            'symbol.required' => 'Para birimi simgesi alanı zorunludur.',
            'symbol.unique' => 'Para birimi simgesi alanı daha önce kayıt edilmiş.',
        ]);

        $update = $currency->update($data);
        if ($update)
            return redirect()->route('admin.currency.index')->with('success', 'Para birimi başarıyla güncellendi.');
        else
            return redirect()->back()->with('error', 'Para birimi güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemCurrency $currency)
    {
        $delete = $currency->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Para Birimi silinirken bir hata oluştu.']);
    }
}
