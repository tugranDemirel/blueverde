<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Models\SystemDeliveryMethod;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = SystemDeliveryMethod::all();
        return view('admin.delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.delivery.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:system_delivery_methods,name',
            'code' => 'required|string|max:255|unique:system_delivery_methods,code',
        ],[
            'name.required' => 'Teslimat şekli adı alanı zorunludur.',
            'name.unique' => 'Teslimat şekli adı alanı daha önce kayıt edilmiş.',
            'code.required' => 'Teslimat şekli kodu alanı zorunludur.',
            'code.unique' => 'Teslimat şekli kodu alanı daha önce kayıt edilmiş.',

        ]);

        $create = SystemDeliveryMethod::create($data);

        if($create){
            return redirect()->route('admin.delivery.index')->with('success', 'Teslimat şekli başarıyla kayıt edildi.');
        }else{
            return back()->with('error', 'Teslimat şekli kayıt edilemedi.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemDeliveryMethod $delivery)
    {
        return view('admin.delivery.create-edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemDeliveryMethod $delivery)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:system_currencies,name,' . $delivery->id,
            'code' => 'required|string|max:255|unique:system_currencies,code,' . $delivery->id,
        ], [
            'name.required' => 'Para birimi adı alanı zorunludur.',
            'name.unique' => 'Para birimi adı alanı daha önce kayıt edilmiş.',
            'code.required' => 'Para birimi kodu alanı zorunludur.',
            'code.unique' => 'Para birimi kodu alanı daha önce kayıt edilmiş.',
        ]);
        $update = $delivery->update($data);
        if ($update)
            return redirect()->route('admin.delivery.index')->with('success', 'Para birimi başarıyla güncellendi.');
        else
            return redirect()->back()->with('error', 'Para birimi güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( SystemDeliveryMethod $delivery)
    {
        $delete = $delivery->delete();
        if ($delete)
            return response()->json(['status' => true, 'message' => 'Para Birimi başarıyla silindi.']);
        else
            return response()->json(['status' => false, 'message' => 'Para Birimi silinirken bir hata oluştu.']);
    }
}
