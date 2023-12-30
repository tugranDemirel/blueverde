<?php

namespace App\Http\Controllers\Admin;

use App\Enum\Customer\CustomerPersonalTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferStoreRequest;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\SystemDeliveryMethod;
use App\Models\SystemTermOfOffer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::with(['customer', 'delivery', 'productTag'])->get();
        return view('admin.offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productTags = ProductTag::all();
        $term_of_offers = SystemTermOfOffer::all();
        $deliveries = SystemDeliveryMethod::all();
        return view('admin.offer.create', compact('productTags', 'term_of_offers', 'deliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->except('_token');
        if (isset($data['products']))
        {
            $products = [];
            foreach($data['products']['name'] as $key => $name)
            {
                $products[$key]['id'] = $data['products']['id'][$key];
                $products[$key]['name'] = $name;
                $products[$key]['category'] = $data['products']['category'][$key];
                $products[$key]['product_tag'] = $data['products']['product_tag'][$key];
                $products[$key]['code'] = $data['products']['code'][$key];
                $products[$key]['quantity'] = $data['products']['quantity'][$key];
                $products[$key]['price'] = $data['products']['price'][$key];
            }
            $data['products'] = $products;
        }
        $create = Offer::create($data);
        if ($create)
            return redirect()->route('admin.offer.index')->with('success', 'Teklif başarıyla eklendi.');
        else
            return redirect()->back()->with('error', 'Teklif eklenirken bir hata oluştu.');
    }

    public function show(Offer $offer)
    {
        $offer->load(['customer', 'delivery', 'productTag']);
        return view('admin.offer.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {

        $productTags = ProductTag::all();
        $term_of_offers = SystemTermOfOffer::all();
        $deliveries = SystemDeliveryMethod::all();
        $customers = Customer::where('personal_type', $offer->customer->personal_type)->get();
        $products = Product::where('product_tag_id', $offer->product_tag_id)->get();
        //dd($offer->products);
        return view('admin.offer.edit', compact('offer', 'productTags', 'term_of_offers', 'deliveries', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $data = $request->except('_token');
        if (isset($data['products']))
        {
            $products = [];
            foreach($data['products']['name'] as $key => $name)
            {
                $products[$key]['id'] = $data['products']['id'][$key];
                $products[$key]['name'] = $name;
                $products[$key]['category'] = $data['products']['category'][$key];
                $products[$key]['product_tag'] = $data['products']['product_tag'][$key];
                $products[$key]['code'] = $data['products']['code'][$key];
                $products[$key]['quantity'] = $data['products']['quantity'][$key];
                $products[$key]['price'] = $data['products']['price'][$key];
            }
            $data['products'] = $products;
        }
        $update = $offer->update($data);
        if ($update)
            return redirect()->route('admin.offer.index')->with('success', 'Teklif başarıyla güncellendi.');
        else
            return redirect()->back()->with('error', 'Teklif güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        if ($offer->delete())
            return response()->json(['status' => true, 'message' => 'Teklif başarıyla silindi.']);
        return response()->json(['status' => false, 'message' => 'Teklif silinirken bir hata oluştu.']);
    }

    /**
     * get customer
     */
    public function getCustomer(Request $request)
    {
        $data = $request->validate([
            'offer_type' => ['required', new Enum(CustomerPersonalTypeEnum::class)]
        ]);
        $customer = Customer::where('personal_type', $data['offer_type'])->get();

        if (!$customer) {
            return response()->json(['status' => false,'message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    /**
     * get product
     */
    public function getProduct(Request $request)
    {
        $data = $request->validate([
            'product_tag' => ['required', 'exists:product_tags,id']
        ]);
        $products = Product::where('product_tag_id', $data['product_tag'])
                    ->with(['category' ,'productTag'])
                    ->get();

        if (!$products) {
            return response()->json(['status' => false,'message' => 'Product not found'], 404);
        }
        return response()->json($products);
    }
}
