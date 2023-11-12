<?php

namespace App\Http\Controllers\Admin\TermOfOffer;

use App\Http\Controllers\Controller;
use App\Models\SystemTermOfOffer;
use Illuminate\Http\Request;

class TermOfOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $term_of_offers = SystemTermOfOffer::all();
        return view('admin.term_of_offer.index', compact('term_of_offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.term_of_offer.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:system_term_of_offers,name',
            'description' => 'required|string',
        ],[
            'name.required' => 'Teklif Şartı Adı alanı zorunludur.',
            'name.unique' => 'Teklif Şartı Adı alanı benzersiz olmalıdır.',
            'description.required' => 'Teklif Şartı Açıklaması alanı zorunludur.',
        ]);

        $term_of_offer = SystemTermOfOffer::create($data);
        if($term_of_offer)
            return redirect()->route('admin.term_of_offer.index')->with('success', 'Teklif Şartı başarıyla kayıt edildi.');
        else
            return back()->with('error', 'Teklif Şartı kayıt edilemedi.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemTermOfOffer $term_of_offer)
    {
        return view('admin.term_of_offer.create-edit', compact('term_of_offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemTermOfOffer $term_of_offer)
    {
        $data = $request->validate([

            'name' => 'required|string|max:255|unique:system_currencies,name,' . $term_of_offer->id,
            'description' => 'required|string',
        ], [
            'name.required' => 'Teklif Şartı adı alanı zorunludur.',
            'name.unique' => 'Teklif Şartı adı alanı daha önce kayıt edilmiş.',
            'description.required' => 'Teklif Şartı Açıklaması alanı zorunludur.',
        ]);

        $update = $term_of_offer->update($data);
        if ($update)
            return redirect()->route('admin.term_of_offer.index')->with('success', 'Teklif Şartı başarıyla güncellendi.');
        else
            return redirect()->back()->with('error', 'Teklif Şartı güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemTermOfOffer $term_of_offer)
    {
        $delete = $term_of_offer->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Teklif Şartı başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Teklif Şartı silinirken bir hata oluştu.']);
    }
}
